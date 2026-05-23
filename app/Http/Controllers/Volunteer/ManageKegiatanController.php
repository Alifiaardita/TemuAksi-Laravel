<?php
// app/Http/Controllers/Volunteer/ManageKegiatanController.php
namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use App\Models\KategoriEvent;
use App\Models\VolunteerKegiatan;
use App\Models\VolunteerPendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageKegiatanController extends Controller
{
    private function namaPerusahaan(): string
    {
        return Auth::user()->companyProfile->nama_perusahaan ?? 'Perusahaan';
    }

    public function index(Request $request)
    {
        $userId = Auth::id();

        $kegiatanList = VolunteerKegiatan::with('kategori')
            ->withCount([
                'pendaftaran as total_daftar'   => fn($q) => $q->where('status', '!=', 'ditolak'),
                'pendaftaran as total_menunggu' => fn($q) => $q->where('status', 'menunggu'),
                'pendaftaran as total_diterima' => fn($q) => $q->where('status', 'diterima'),
                'pendaftaran as total_selesai'  => fn($q) => $q->where('status', 'selesai'),
            ])
            ->where('created_by', $userId)
            ->latest()
            ->get();

        $kategoriList = KategoriEvent::orderBy('nama_kategori')->get();

        return view('volunteer.manage.index', compact('kegiatanList', 'kategoriList'));
    }

    public function create()
    {
        $kategoriList   = KategoriEvent::orderBy('nama_kategori')->get();
        $namaPerusahaan = $this->namaPerusahaan();
        return view('volunteer.manage.form', compact('kategoriList', 'namaPerusahaan'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'          => 'required|string|max:255',
            'deskripsi'      => 'required|string',
            'penyelenggara'  => 'nullable|string|max:255',
            'lokasi'         => 'nullable|string|max:255',
            'kategori_id'    => 'nullable|exists:kategori_event,id',
            'tanggal_mulai'  => 'required|date',
            'tanggal_selesai'=> 'nullable|date|after_or_equal:tanggal_mulai',
            'jam_mulai'      => 'nullable|date_format:H:i',
            'jam_selesai'    => 'nullable|date_format:H:i',
            'kuota'          => 'nullable|integer|min:1',
            'syarat'         => 'nullable|string',
        ]);

        $data['penyelenggara'] = $data['penyelenggara'] ?: $this->namaPerusahaan();
        $data['created_by']    = Auth::id();
        $data['status']        = 'aktif';

        VolunteerKegiatan::create($data);

        return redirect()->route('volunteer.manage.index')
            ->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    public function edit(int $id)
    {
        $kegiatan = VolunteerKegiatan::where('created_by', Auth::id())
            ->findOrFail($id);

        $kategoriList   = KategoriEvent::orderBy('nama_kategori')->get();
        $namaPerusahaan = $this->namaPerusahaan();

        return view('volunteer.manage.form', compact('kegiatan', 'kategoriList', 'namaPerusahaan'));
    }

    public function update(Request $request, int $id)
    {
        $kegiatan = VolunteerKegiatan::where('created_by', Auth::id())
            ->findOrFail($id);

        $data = $request->validate([
            'judul'          => 'required|string|max:255',
            'deskripsi'      => 'required|string',
            'penyelenggara'  => 'nullable|string|max:255',
            'lokasi'         => 'nullable|string|max:255',
            'kategori_id'    => 'nullable|exists:kategori_event,id',
            'tanggal_mulai'  => 'required|date',
            'tanggal_selesai'=> 'nullable|date|after_or_equal:tanggal_mulai',
            'jam_mulai'      => 'nullable|date_format:H:i',
            'jam_selesai'    => 'nullable|date_format:H:i',
            'kuota'          => 'nullable|integer|min:1',
            'syarat'         => 'nullable|string',
            'status'         => 'required|in:aktif,penuh,selesai,dibatalkan',
        ]);

        $kegiatan->update($data);

        return redirect()->route('volunteer.manage.index')
            ->with('success', 'Kegiatan berhasil diperbarui!');
    }

    public function destroy(int $id)
    {
        VolunteerKegiatan::where('created_by', Auth::id())
            ->findOrFail($id)
            ->delete();

        return redirect()->route('volunteer.manage.index')
            ->with('success', 'Kegiatan berhasil dihapus.');
    }

    public function pendaftaran(Request $request)
    {
        $userId = Auth::id();

        $kegiatanList = VolunteerKegiatan::where('created_by', $userId)
            ->orderBy('judul')
            ->get();

        $query = VolunteerPendaftaran::with('kegiatan')
            ->whereHas('kegiatan', fn($q) => $q->where('created_by', $userId));

        if ($request->filled('kegiatan_id')) {
            $query->where('kegiatan_id', $request->integer('kegiatan_id'));
        }

        if ($request->filled('sp')) {
            $query->where('status', $request->sp);
        }

        $pendaftaranList = $query->latest()->get();

        return view('volunteer.manage.pendaftaran', compact('kegiatanList', 'pendaftaranList'));
    }

    public function updateStatusPendaftaran(Request $request)
    {
        $request->validate([
            'pendaftaran_id' => 'required|integer',
            'status_baru'    => 'required|in:diterima,ditolak,selesai,menunggu',
            'catatan_admin'  => 'nullable|string',
        ]);

        $pendaftaran = VolunteerPendaftaran::whereHas(
                'kegiatan', fn($q) => $q->where('created_by', Auth::id())
            )
            ->findOrFail($request->pendaftaran_id);

        $pendaftaran->update([
            'status'        => $request->status_baru,
            'catatan_admin' => $request->catatan_admin,
        ]);

        return back()->with('success', 'Status volunteer berhasil diperbarui.');
    }
}

?>
