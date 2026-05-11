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
        $user = Auth::user();

        if ($user->role == 'perusahaan') {
            return redirect()->route('perusahaan.dashboard');
        }

        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $kategori = KategoriEvent::orderBy('id', 'desc')->limit(5)->get();

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
