@extends('layouts.app')
@section('content')

<section class="max-w-3xl mx-auto px-6 mt-6 mb-20">

    <h2 class="text-lg font-bold text-gray-900 mb-6">Edit Program Sponsor</h2>

    @if($errors->any())
    <div class="bg-red-50 text-red-600 text-sm rounded-xl p-4 mb-4">
        <ul class="list-disc pl-5 space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('perusahaan.sponsor.update', $sponsor->id) }}" method="POST" class="bg-white rounded-2xl shadow-sm p-6 space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Program</label>
            <input type="text" name="nama" value="{{ old('nama', $sponsor->nama) }}"
                   class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cornflower focus:outline-none">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Industri</label>
            <input type="text" name="industri" value="{{ old('industri', $sponsor->industri) }}"
                   class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cornflower focus:outline-none">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori</label>
            <select name="kategori_id" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cornflower focus:outline-none">
                @foreach($kategoriList as $kategori)
                    <option value="{{ $kategori->id }}" {{ $sponsor->kategori_id == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Lokasi</label>
            <input type="text" name="lokasi" value="{{ old('lokasi', $sponsor->lokasi) }}"
                   class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cornflower focus:outline-none">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Dana Minimum (Rp)</label>
                <input type="number" name="min_dana" value="{{ old('min_dana', $sponsor->min_dana) }}"
                       class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cornflower focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Dana Maksimum (Rp)</label>
                <input type="number" name="max_dana" value="{{ old('max_dana', $sponsor->max_dana) }}"
                       class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cornflower focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="4"
                      class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cornflower focus:outline-none">{{ old('deskripsi', $sponsor->deskripsi) }}</textarea>
        </div>

        <div class="flex items-center justify-end gap-3 pt-2">
            <a href="{{ route('perusahaan.sponsor.index') }}" class="text-sm text-gray-500 hover:underline">Batal</a>
            <button type="submit" class="bg-cornflower text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:opacity-90 transition">
                Simpan Perubahan
            </button>
        </div>
    </form>

</section>

@endsection