<?php

namespace App\Http\Controllers;

use App\Models\KategoriEvent;
use App\Models\Sponsor;

class ExploreController extends Controller
{
    // HALAMAN EXPLORE
    public function index()
    {
        $kategori = KategoriEvent::orderBy('nama_kategori')->get();

        return view('organizer.explore_event', compact('kategori'));
    }

    // HALAMAN KATEGORI → LIST SPONSOR
    public function kategori($id)
    {

        $kategori = KategoriEvent::findOrFail($id);

        $sponsors = Sponsor::where('kategori_id', $id)->get();

        return view('organizer.kategori', compact('kategori', 'sponsors'));
    }

    // HALAMAN SPONSOR (LIST / DETAIL RINGKAS)
    public function sponsor($id)
    {
        $sponsor = Sponsor::findOrFail($id);

        return view('organizer.sponsor', compact('sponsor'));
    }

    // DETAIL SPONSOR LENGKAP
    public function detailSponsor($id)
    {
        $sponsor = Sponsor::with('kategori')->findOrFail($id);

        return view('organizer.detail_sponsor', compact('sponsor'));
    }
}
