@extends('layouts.app')

@section('title', 'Buka Sponsorship')

@section('content')
<div class="min-h-screen bg-canvas p-10">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-3xl shadow">
        <h1 class="text-2xl font-bold mb-6">📢 Buka Sponsorship</h1>

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-800 rounded-xl px-4 py-3 text-sm mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('perusahaan.sponsor.store') }}" class="space-y-6">
            @csrf

            <input type="text" name="nama" placeholder="Nama Program / Campaign"
                value="{{ old('nama') }}"
                class="w-full p-3 border rounded-xl" required>

            <input type="text" name="industri" placeholder="Industri (Tech, F&B, dll)"
                value="{{ old('industri') }}"
                class="w-full p-3 border rounded-xl">

            <textarea name="deskripsi" placeholder="Deskripsi sponsorship"
                class="w-full p-3 border rounded-xl" required>{{ old('deskripsi') }}</textarea>

            <select name="kategori_id" class="w-full p-3 border rounded-xl" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $k)
                    <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kategori }}
                    </option>
                @endforeach
            </select>

            <input type="text" name="min_dana" placeholder="Minimal Dana (5000000)"
                value="{{ old('min_dana') }}"
                class="w-full p-3 border rounded-xl" required>

            <input type="text" name="max_dana" placeholder="Maksimal Dana (50000000)"
                value="{{ old('max_dana') }}"
                class="w-full p-3 border rounded-xl" required>

            <input type="text" name="lokasi" placeholder="Lokasi"
                value="{{ old('lokasi') }}"
                class="w-full p-3 border rounded-xl">

            <button type="submit"
                class="w-full bg-cornflower text-white py-3 rounded-xl">
                Publish Sponsorship
            </button>
        </form>
    </div>
</div>
@endsection