<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use App\Models\KategoriEvent;
use App\Models\VolunteerKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VolunteerPerusahaanController extends Controller
{
    // Tampilkan form buat volunteer
    public function create()
    {
        $kategori = KategoriEvent::all();
        return view('perusahaan.form_volunteer', compact('kategori'));
    }

    // Simpan data volunteer baru
    public function store(Request $request)
    {
        \Log::info('Form submitted', $request->all());
        $request->validate([
            'nama_kegiatan'    => 'required|string|max:200',
            'deskripsi'        => 'required|string',
            'tanggal_mulai'    => 'required|date',
            'tanggal_selesai'  => 'nullable|date|after_or_equal:tanggal_mulai',
            'kategori'         => 'nullable|exists:kategori_event,id',
            'lokasi'           => 'nullable|string|max:200',
            'jumlah_volunteer' => 'nullable|integer|min:1',
            'syarat'           => 'nullable|string',
            'divisi'           => 'nullable|string|max:255',
            'kontak'           => 'nullable|string|max:255',
            'benefit'          => 'nullable|array',
            'benefit.*'        => 'string',
            'benefit_lain'     => 'nullable|string|max:255',
            'cara_seleksi'     => 'nullable|in:langsung,berkas,interview',
            'deadline_daftar'  => 'nullable|date|before_or_equal:tanggal_mulai',
            'foto'             => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        // Upload foto
        $gambarUrl = null;
        if ($request->hasFile('foto')) {
            $gambarUrl = $request->file('foto')->store('volunteer', 'public');
        }

        // Gabungkan benefit checkbox + benefit lain
        $benefitList = $request->input('benefit', []);
        if ($request->filled('benefit_lain')) {
            $benefitList[] = $request->benefit_lain;
        }

        VolunteerKegiatan::create([
            'judul'           => $request->nama_kegiatan,
            'deskripsi'       => $request->deskripsi,
            'penyelenggara'   => Auth::user()->companyProfile->nama_perusahaan ?? 'Perusahaan',
            'lokasi'          => $request->lokasi,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'kuota'           => $request->jumlah_volunteer,
            'syarat'          => $request->syarat,
            'divisi'          => $request->divisi,
            'kontak'          => $request->kontak,
            'benefit'         => !empty($benefitList) ? json_encode($benefitList) : null,
            'cara_seleksi'    => $request->cara_seleksi,
            'deadline_daftar' => $request->deadline_daftar,
            'kategori_id'     => $request->kategori ?: null,
            'gambar_url'      => $gambarUrl,
            'status'          => 'aktif',
            'created_by'      => Auth::id(),
        ]);

        return redirect()
            ->route('perusahaan.dashboard')
            ->with('success', 'Kegiatan volunteer berhasil dibuat!');
    }
}