<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KategoriController extends Controller
{
    public function index()
{
    $kategori = KategoriEvent::orderBy('id', 'desc')->get();
    return view('admin.kategori.index', compact('kategori'));
}

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'gambar'        => 'nullable|image|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('kategori', 'public');
        }

        KategoriEvent::create([
            'nama_kategori' => $request->nama_kategori,
            'gambar'        => $path,
        ]);

        return back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, KategoriEvent $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'gambar'        => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($kategori->gambar) {
                Storage::disk('public')->delete($kategori->gambar);
            }
            $kategori->gambar = $request->file('gambar')->store('kategori', 'public');
        }

        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();

        return back()->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(KategoriEvent $kategori)
    {
        if ($kategori->gambar) {
            Storage::disk('public')->delete($kategori->gambar);
        }
        $kategori->delete();

        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}
