<?php

namespace App\Http\Controllers;

use App\Models\KategoriEvent;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($user->role == 'perusahaan') {
            return redirect()->route('perusahaan.dashboard');
        }

        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $kategori = KategoriEvent::latest()->limit(5)->get();

        return view('organizer.index', compact('kategori'));
    }
}
