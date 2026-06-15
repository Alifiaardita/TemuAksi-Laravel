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

    $totalProposal      = $proposalQuery->count();
    $proposalMingguIni  = (clone $proposalQuery)
                            ->whereBetween('created_at', [now()->startOfWeek(), now()])
                            ->count();
    $proposalMenunggu   = (clone $proposalQuery)
                            ->where('status', 'terkirim')
                            ->count();
    $totalDisalurkan    = \App\Models\Pendanaan::where('perusahaan_id', $userId)
                            ->whereMonth('created_at', now()->month)
                            ->whereYear('created_at', now()->year)
                            ->sum('jumlah_dana');
    $proposalTerbaru    = (clone $proposalQuery)
                            ->with('sponsor')
                            ->latest()
                            ->take(4)
                            ->get();

    $totalSponsor = Sponsor::where('user_id', $userId)->count();
    $sponsorList = Sponsor::where('user_id', $userId)->orderBy('id', 'desc')->take(4)->get();

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
        'sponsorList',
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

public function sponsorIndex()
{
    $user = auth()->user();

    $sponsorList = Sponsor::where('user_id', $user->id)
    ->with('kategori')
    ->orderBy('id', 'desc')
    ->paginate(10);
    return view('perusahaan.list_sponsor', compact('sponsorList'));
}
    public function addSponsor()
    {
        $kategori = KategoriEvent::all();
        return view('perusahaan.form_sponsor', compact('kategori'));
    }


    public function storeSponsor(Request $request)
    {
        $request->merge([
            'min_dana' => (int) str_replace('.', '', $request->min_dana),
            'max_dana' => (int) str_replace('.', '', $request->max_dana),
        ]);
        $request->validate([
            'nama'        => 'required|string|max:150',
            'industri'    => 'nullable|string|max:100',
            'deskripsi'   => 'required|string',
            'kategori_id' => 'required|exists:kategori_event,id',
            'min_dana'    => 'required|integer|min:0',
            'max_dana'    => 'required|integer|min:0',
            'lokasi'      => 'nullable|string|max:100',
            'tanggal_buka'  => 'nullable|date',
            'tanggal_tutup' => 'nullable|date|after_or_equal:tanggal_buka',
            'wilayah'  => 'nullable|string|max:100',
            'syarat_text'   => 'nullable|string',
            'dokumen_text'  => 'nullable|string',
            'benefit_text'  => 'nullable|string',
        ]);

        Sponsor::create([
            'user_id'       => Auth::id(),
            'nama'          => $request->nama,
            'industri'      => $request->industri,
            'deskripsi'     => $request->deskripsi,
            'kategori_id'   => $request->kategori_id,
            'min_dana'      => $request->min_dana,
            'max_dana'      => $request->max_dana,
            'lokasi'        => $request->lokasi,
            'tanggal_buka'  => $request->tanggal_buka,
            'tanggal_tutup' => $request->tanggal_tutup,
            'wilayah'  => $request->wilayah,
            'syarat'   => array_values(array_filter(explode("\n", str_replace("\r", "", $request->syarat_text)))),
            'dokumen'  => array_values(array_filter(explode("\n", str_replace("\r", "", $request->dokumen_text)))),
            'benefit'  => array_values(array_filter(explode("\n", str_replace("\r", "", $request->benefit_text)))),
        ]);

        return redirect()
            ->route('perusahaan.dashboard')
            ->with('success', 'Sponsorship berhasil dibuat!');
    }

    public function editSponsor($id)
{
    $user = auth()->user();

    $sponsor = Sponsor::where('user_id', $user->id)->findOrFail($id);
    $kategoriList = KategoriEvent::all();

    $proposals = Proposal::with('user')
        ->where('sponsor_id', $sponsor->id)
        ->latest()
        ->get();

    return view('perusahaan.edit_sponsor', compact('sponsor', 'kategoriList', 'proposals'));
}

public function updateSponsor(Request $request, $id)
{
    $user = auth()->user();

    $sponsor = Sponsor::where('user_id', $user->id)->findOrFail($id);

    $sponsor->update($request->validate([
        'nama'          => 'required|string|max:255',
        'industri'      => 'required|string|max:255',
        'deskripsi'     => 'required|string',
        'kategori_id'   => 'required|integer',
        'min_dana'      => 'required|numeric',
        'max_dana'      => 'required|numeric',
        'lokasi'        => 'nullable|string|max:255',
        'tanggal_buka'  => 'nullable|date',
        'tanggal_tutup' => 'nullable|date|after_or_equal:tanggal_buka',
        'wilayah'  => 'nullable|string|max:100',
        'syarat'   => 'nullable|array',
        'dokumen'  => 'nullable|array',
        'benefit'  => 'nullable|array',
    ]));

    return redirect()->route('perusahaan.sponsor.index')->with('success', 'Sponsor berhasil diperbarui.');
}


}