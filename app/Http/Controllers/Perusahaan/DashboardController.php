<?php
namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Sponsor;
use App\Models\Proposal;
use App\Models\KategoriEvent;
use App\Models\VolunteerKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
{
    $userId = Auth::id();
    $user = User::with('companyProfile')->find($userId);

    // Base query: proposal yang masuk ke sponsor milik perusahaan ini
    $proposalQuery = Proposal::whereHas('sponsor', function ($q) use ($userId) {
        $q->where('user_id', $userId);
    });

    $totalProposal     = $proposalQuery->count();
    $proposalMingguIni = (clone $proposalQuery)
                            ->whereBetween('created_at', [now()->startOfWeek(), now()])
                            ->count();
    $proposalMenunggu  = (clone $proposalQuery)
                            ->where('status', 'terkirim')
                            ->count();
    $totalDisalurkan   = (clone $proposalQuery)
                            ->whereIn('status', ['pendanaan', 'selesai'])
                            ->sum('target_dana');
    $proposalTerbaru   = (clone $proposalQuery)
                            ->with('sponsor')
                            ->latest()
                            ->take(4)
                            ->get();

    $totalSponsor = Sponsor::where('user_id', $userId)->count();

    $volunteerAktifList = VolunteerKegiatan::withCount('volunteerPendaftaran')
                            ->where('status', 'aktif')
                            ->latest()
                            ->take(4)
                            ->get();

    $programBerjalan = VolunteerKegiatan::where('status', 'aktif')->count();

    $volunteerAktif  = \App\Models\VolunteerPendaftaran::whereHas('volunteerKegiatan', function ($q) {
                            $q->where('status', 'aktif');
                        })->count();

    return view('perusahaan.dashboard', compact(
        'user',
        'totalSponsor',
        'totalProposal',
        'proposalMingguIni',
        'proposalMenunggu',
        'totalDisalurkan',
        'proposalTerbaru',
        'volunteerAktifList',   // ← list untuk section bawah
        'volunteerAktif',       // ← angka di card ringkasan
        'programBerjalan',      // ← angka program di card ringkasan
    ));
}

    public function addSponsor()
    {
        $kategori = KategoriEvent::all();
        return view('perusahaan.form_sponsor', compact('kategori'));
    }

    public function storeSponsor(Request $request)
    {
        $request->validate([
            'nama'        => 'required|string|max:150',
            'industri'    => 'nullable|string|max:100',
            'deskripsi'   => 'required|string',
            'kategori_id' => 'required|exists:kategori_event,id',
            'min_dana'    => 'required|integer|min:0',
            'max_dana'    => 'required|integer|min:0',
            'lokasi'      => 'nullable|string|max:100',
        ]);

        Sponsor::create([
            'user_id'     => Auth::id(),
            'nama'        => $request->nama,
            'industri'    => $request->industri,
            'deskripsi'   => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
            'min_dana'    => $request->min_dana,
            'max_dana'    => $request->max_dana,
            'lokasi'      => $request->lokasi,
        ]);

        return redirect()
            ->route('perusahaan.dashboard')
            ->with('success', 'Sponsorship berhasil dibuat!');
    }
}