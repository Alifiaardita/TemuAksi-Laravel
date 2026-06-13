@extends('layouts.app')
@section('title', 'Form Pengajuan')
@section('content')
@php
    $kategori = \App\Models\KategoriEvent::all();
@endphp

<section class="max-w-2xl mx-auto py-12 px-4">

    {{-- Header --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 rounded-xl bg-cornflower flex items-center justify-center shadow-md">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">Form Pengajuan Proposal</h1>
        </div>
        <p class="text-gray-500 ml-[52px]">Isi semua data dengan lengkap dan benar.</p>
    </div>

    {{-- Card --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
        <form method="POST" action="{{ route('proposal.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <input type="hidden" name="sponsor_id" value="{{ $sponsor->id }}">

            {{-- Judul --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Judul Proposal
                    <span class="text-red-400">*</span>
                </label>
                <input
                    type="text"
                    name="judul"
                    required
                    placeholder="Contoh: Festival Sosial Surabaya 2025"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-cornflower focus:border-transparent transition"
                >
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Deskripsi
                    <span class="text-red-400">*</span>
                </label>
                <textarea
                    name="deskripsi"
                    required
                    rows="4"
                    placeholder="Jelaskan tujuan dan gambaran kegiatan..."
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-cornflower focus:border-transparent transition resize-none"
                ></textarea>
            </div>

            {{-- Kategori & Lokasi --}}
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Kategori</label>
                    <div class="relative">
                        <select
                            name="kategori"
                            class="w-full appearance-none border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-cornflower focus:border-transparent transition bg-white pr-10"
                        >
                            @foreach($kategori as $k)
                                <option value="{{ $k->nama_kategori }}">{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                </div>

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
                            placeholder="Kota / Alamat"
                            class="w-full border border-gray-200 rounded-xl pl-10 pr-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-cornflower focus:border-transparent transition"
                        >
                    </div>
                </div>
            </div>

            {{-- Tanggal --}}
           <div>
    <label class="block text-sm font-medium text-gray-700 mb-1.5">
        Tanggal Kegiatan <span class="text-red-400">*</span>
    </label>

    <div class="relative">
        <div class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>

        <input
            type="date"
            name="tanggal"
            required
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
                        placeholder="0"
                        class="w-full border border-gray-200 rounded-xl pl-10 pr-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-cornflower focus:border-transparent transition"
                    >
                </div>
            </div>

            {{-- File Upload --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">File Proposal</label>
                <label class="flex flex-col items-center justify-center w-full border-2 border-dashed border-gray-200 rounded-xl px-4 py-6 cursor-pointer hover:border-cornflower hover:bg-blue-50/30 transition-colors group">
                    <div class="w-10 h-10 rounded-xl bg-gray-100 group-hover:bg-cornflower/10 flex items-center justify-center mb-2 transition-colors">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-cornflower transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                    </div>
                    <p class="text-sm text-gray-500 group-hover:text-cornflower transition-colors">Klik untuk upload file</p>
                    <p class="text-xs text-gray-400 mt-1">PDF, DOC, DOCX hingga 10MB</p>
                    <input type="file" name="file_proposal" class="hidden">
                </label>
            </div>

            {{-- Divider --}}
            <div class="border-t border-gray-100 pt-2"></div>

            {{-- Submit --}}
            <button
                type="submit"
                class="flex items-center justify-center gap-2 w-full bg-cornflower hover:opacity-90 active:opacity-80 text-white py-3 rounded-xl font-medium text-sm transition-opacity"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
                Kirim Proposal
            </button>

        </form>
    </div>

</section>
@endsection
