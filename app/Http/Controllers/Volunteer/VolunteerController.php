<?php
// app/Http/Controllers/Volunteer/VolunteerController.php
namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use App\Models\KategoriEvent;
use App\Models\VolunteerKegiatan;
use App\Models\VolunteerPendaftaran;
use App\Models\VolunteerSertifikat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VolunteerController extends Controller
{
    public function index(Request $request)
    {
        $query = VolunteerKegiatan::with('kategori')
            ->withCount([
                'pendaftaran as jumlah_daftar' => fn($q) => $q->where('status', '!=', 'ditolak'),
            ]);

        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->integer('kategori'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        } else {
            $query->where('status', '!=', 'dibatalkan');
        }

        if ($request->filled('q')) {
            $kw = $request->q;
            $query->where(function ($q) use ($kw) {
                $q->where('judul', 'like', "%$kw%")
                  ->orWhere('deskripsi', 'like', "%$kw%")
                  ->orWhere('penyelenggara', 'like', "%$kw%")
                  ->orWhere('lokasi', 'like', "%$kw%")
                  ->orWhere('syarat', 'like', "%$kw%");
            });
        }

        $kegiatanList  = $query->orderBy('tanggal_mulai')->get();
        $kategoriList  = KategoriEvent::orderBy('nama_kategori')->get();

        return view('volunteer.index', compact('kegiatanList', 'kategoriList'));
    }

    public function detail(Request $request, int $id)
    {
        $kegiatan = VolunteerKegiatan::with('kategori')
            ->withCount([
                'pendaftaran as jumlah_daftar' => fn($q) => $q->where('status', '!=', 'ditolak'),
            ])
            ->findOrFail($id);

        $sudahDaftar    = false;
        $pendaftaranSaya = null;

        if (Auth::check()) {
            $pendaftaranSaya = VolunteerPendaftaran::where('user_id', Auth::id())
                ->where('kegiatan_id', $id)
                ->first();
            $sudahDaftar = (bool) $pendaftaranSaya;
        }

        return view('volunteer.detail', compact('kegiatan', 'sudahDaftar', 'pendaftaranSaya'));
    }

    public function daftar(Request $request, int $id)
    {
        $kegiatan = VolunteerKegiatan::findOrFail($id);

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_telepon'   => 'required|string|max:20',
            'email'        => 'nullable|email|max:255',
            'motivasi'     => 'required|string',
            'pengalaman'   => 'nullable|string',
        ]);

        if ($kegiatan->status !== 'aktif') {
            return back()->withErrors(['Pendaftaran untuk kegiatan ini sudah ditutup.']);
        }

        $sudahDaftar = VolunteerPendaftaran::where('user_id', Auth::id())
            ->where('kegiatan_id', $id)
            ->exists();

        if ($sudahDaftar) {
            return back()->withErrors(['Kamu sudah mendaftar pada kegiatan ini.']);
        }

        if ($kegiatan->kuota) {
            $total = VolunteerPendaftaran::where('kegiatan_id', $id)->count();
            if ($total >= $kegiatan->kuota) {
                return back()->withErrors(['Maaf, kuota sudah penuh.']);
            }
        }

        VolunteerPendaftaran::create([
            'user_id'     => Auth::id(),
            'kegiatan_id' => $id,
            'nama_lengkap'=> $request->nama_lengkap,
            'no_telepon'  => $request->no_telepon,
            'email'       => $request->email,
            'motivasi'    => $request->motivasi,
            'pengalaman'  => $request->pengalaman,
            'status'      => 'menunggu',
        ]);

        if ($kegiatan->kuota) {
            $total = VolunteerPendaftaran::where('kegiatan_id', $id)->count();
            if ($total >= $kegiatan->kuota) {
                $kegiatan->update(['status' => 'penuh']);
            }
        }

        return redirect()->route('volunteer.detail', $id)
            ->with('success', 'Pendaftaran berhasil!');
    }

    public function myVolunteer()
    {
        $pendaftaranList = VolunteerPendaftaran::with(['kegiatan.kategori', 'sertifikat'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $groups = [
            'diterima' => $pendaftaranList->where('status', 'diterima')->values(),
            'menunggu' => $pendaftaranList->where('status', 'menunggu')->values(),
            'selesai'  => $pendaftaranList->where('status', 'selesai')->values(),
            'ditolak'  => $pendaftaranList->where('status', 'ditolak')->values(),
        ];

        return view('volunteer.my', compact('pendaftaranList', 'groups'));
    }

    public function sertifikat()
    {
        $sertifikatList = VolunteerSertifikat::with(['pendaftaran.kegiatan.kategori'])
            ->whereHas('pendaftaran', fn($q) => $q->where('user_id', Auth::id()))
            ->latest()
            ->get();

        return view('volunteer.sertifikat', compact('sertifikatList'));
    }

    public function ajukanSertifikat(Request $request)
    {
        $request->validate([
            'pendaftaran_id' => 'required|exists:volunteer_pendaftaran,id',
        ]);

        $pendaftaran = VolunteerPendaftaran::where('id', $request->pendaftaran_id)
            ->where('user_id', Auth::id())
            ->where('status', 'selesai')
            ->firstOrFail();

        VolunteerSertifikat::firstOrCreate(['pendaftaran_id' => $pendaftaran->id]);

        return back()->with('success', 'Pengajuan sertifikat berhasil.');
    }
}

?>
