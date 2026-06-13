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
        $kategori = KategoriEvent::orderBy('id', 'desc')->limit(5)->get();

        if (!Auth::check()) {
            return view('organizer.index', compact('kategori'));
        }

        $user = Auth::user();

        if ($user->role == 'perusahaan') {
            return redirect()->route('perusahaan.dashboard');
        }

        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Organizer
        $proposalTerbaru = Proposal::with('sponsor')
            ->where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        $stats = [
            'proposal_terkirim' => Proposal::where('user_id', $user->id)->count(),
            'sponsor_diperoleh' => Proposal::where('user_id', $user->id)
                ->whereIn('status', ['pendanaan', 'selesai'])
                ->count(),
        ];

        return view('organizer.index', compact(
            'kategori',
            'stats',
            'proposalTerbaru',
        ));
    }
}
