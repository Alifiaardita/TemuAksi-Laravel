@extends('layouts.app')

@section('title', 'Form Pengajuan')

@section('content')

@php
    $kategori = \App\Models\KategoriEvent::all();
@endphp

<section class="max-w-2xl mx-auto py-12 px-4">

    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-cornflower">
            📋 Form Pengajuan Proposal
        </h1>
        <p class="text-gray-600">Isi data dengan lengkap</p>
    </div>

    <div class="bg-white rounded-3xl p-8 shadow-lg">

        <form method="POST" action="{{ route('proposal.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <input type="hidden" name="sponsor_id" value="{{ $sponsor->id }}">

            <div>
                <label class="font-semibold">Judul</label>
                <input type="text" name="judul" class="w-full border p-3 rounded-xl" required>
            </div>

            <div>
                <label class="font-semibold">Deskripsi</label>
                <textarea name="deskripsi" class="w-full border p-3 rounded-xl" required></textarea>
            </div>

            <div>
                <label class="font-semibold">Kategori</label>
                <select name="kategori" class="w-full border p-3 rounded-xl">
                    @foreach($kategori as $k)
                        <option value="{{ $k->nama_kategori }}">
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="font-semibold">Lokasi</label>
                <input type="text" name="lokasi" class="w-full border p-3 rounded-xl">
            </div>

            <div>
                <label class="font-semibold">Tanggal</label>
                <input type="date" name="tanggal" class="w-full border p-3 rounded-xl">
            </div>

            <div>
                <label class="font-semibold">Target Dana</label>
                <input type="number" name="target_dana" class="w-full border p-3 rounded-xl">
            </div>

            <div>
                <label class="font-semibold">File Proposal</label>
                <input type="file" name="file_proposal" class="w-full border p-3 rounded-xl">
            </div>

            <button class="w-full bg-cornflower text-white py-3 rounded-xl">
                Kirim Proposal
            </button>

        </form>

    </div>

</section>

@endsection
