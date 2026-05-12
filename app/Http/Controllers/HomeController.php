<?php

namespace App\Http\Controllers;

use App\Models\KategoriEvent;
use App\Models\Sponsor;
use App\Models\Proposal;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
 public function index()
{
    //   dd(Auth::check());
    // Ambil data untuk ditampilkan di home (guest maupun yang login)
    $kategori = KategoriEvent::orderBy('id', 'desc')->limit(5)->get();

    // Kalau belum login, tampilkan home sebagai guest
    if (!Auth::check()) {
        return view('organizer.index', compact('kategori'));
    }

    $user = Auth::user();

    // Redirect sesuai role
    if ($user->role == 'perusahaan') {
        return redirect()->route('perusahaan.dashboard');
    }

    if ($user->role == 'admin') {
        return redirect()->route('admin.dashboard');
    }

    // Organizer (default)
    $totalSponsor = Sponsor::count();
    $proposalSaya = Proposal::where('user_id', $user->id)->count();
    $proposalDiterima = Proposal::where('user_id', $user->id)
        ->where('status', 'diterima')
        ->count();
    $sponsorBaru = Sponsor::orderBy('id', 'desc')->limit(6)->get();

    return view('organizer.index', compact(
        'kategori',
        'totalSponsor',
        'proposalSaya',
        'proposalDiterima',
        'sponsorBaru'
    ));
}
}
