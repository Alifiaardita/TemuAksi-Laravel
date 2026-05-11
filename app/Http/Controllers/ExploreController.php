<?php

namespace App\Http\Controllers;

use App\Models\KategoriEvent;
use App\Models\Sponsor;

class ExploreController extends Controller
{
    public function index()
    {
        $kategori = KategoriEvent::all();
        return view('organizer.explore_event', compact('kategori'));
    }

    public function kategori(int $id)
    {
        $kategori = KategoriEvent::findOrFail($id);
        $sponsors = Sponsor::where('kategori_id', $id)->get();
        return view('organizer.kategori', compact('kategori', 'sponsors'));
    }

    public function detailSponsor(int $id)
    {
        $sponsor = Sponsor::with('kategori')->findOrFail($id);
        return view('organizer.detail_sponsor', compact('sponsor'));
    }
}
