@extends('layouts.app')

@section('title', 'Edit Proposal')

@section('content')

@php
    $kategori = \App\Models\KategoriEvent::all();
@endphp

<section class="min-h-screen flex items-center justify-center px-4 py-12 bg-canvas">
<div class="w-full max-w-2xl">

    {{-- Header --}}
    <div class="mb-6">
        <a
    href="{{ url()->previous() }}"
    class="relative z-50 inline-flex items-center gap-1.5 text-sm text-gray-400 hover:text-gray-600 transition-colors mb-5"
>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>

        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-cornflower flex items-center justify-center shadow-md">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wide font-medium mb-0.5">Proposal</p>
                <h1 class="text-2xl font-bold text-gray-900">Edit Proposal</h1>
            </div>
        </div>
    </div>

    {{-- Card --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">

        <form method="POST" action="{{ route('proposal.update', $proposal->id) }}" class="space-y-5">
            @csrf

            {{-- Judul --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Judul Proposal <span class="text-red-400">*</span>
                </label>
                <input
                    type="text"
                    name="judul"
                    value="{{ $proposal->judul }}"
                    placeholder="Judul kegiatan atau proposal"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-cornflower focus:border-transparent transition"
                >
            </div>

            {{-- Kategori --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Kategori</label>
                <div class="relative">
                    <select
                        name="kategori"
                        class="w-full appearance-none border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-cornflower focus:border-transparent transition bg-white pr-10"
                    >
                        @foreach($kategori as $k)
                            <option value="{{ $k->nama_kategori }}" {{ $proposal->kategori == $k->nama_kategori ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Deskripsi <span class="text-red-400">*</span>
                </label>
                <textarea
                    name="deskripsi"
                    rows="4"
                    placeholder="Jelaskan tujuan dan gambaran kegiatan..."
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-cornflower focus:border-transparent transition resize-none"
                >{{ $proposal->deskripsi }}</textarea>
            </div>

            {{-- Lokasi --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Lokasi</label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <input
                        type="text"
                        name="lokasi"
                        value="{{ $proposal->lokasi }}"
                        placeholder="Kota / Alamat kegiatan"
                        class="w-full border border-gray-200 rounded-xl pl-10 pr-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-cornflower focus:border-transparent transition"
                    >
                </div>
            </div>

            {{-- Tanggal --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Tanggal <span class="text-red-400">*</span>
                </label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <input
                        type="date"
                        name="tanggal"
                        value="{{ $proposal->tanggal?->format('Y-m-d') }}"
                        class="w-full border border-gray-200 rounded-xl pl-10 pr-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-cornflower focus:border-transparent transition"
                    >
                </div>
            </div>

            {{-- Target Dana --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Target Dana</label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                        <span class="text-sm text-gray-400 font-medium">Rp</span>
                    </div>
                    <input
                        type="number"
                        name="target_dana"
                        value="{{ $proposal->target_dana }}"
                        placeholder="0"
                        class="w-full border border-gray-200 rounded-xl pl-10 pr-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-cornflower focus:border-transparent transition"
                    >
                </div>
            </div>

            {{-- Divider --}}
            <div class="border-t border-gray-100 pt-2"></div>

            {{-- Submit --}}
            <button
                type="submit"
                class="flex items-center justify-center gap-2 w-full bg-cornflower hover:opacity-90 active:opacity-80 text-white py-3 rounded-xl font-medium text-sm transition-opacity"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Perubahan
            </button>

        </form>
    </div>

</div>
</section>

@endsection
