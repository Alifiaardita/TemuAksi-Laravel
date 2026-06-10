@extends('layouts.app')
@section('title', 'Kategori Sponsor')
@section('content')

<main class="max-w-7xl mx-auto px-6 py-10">

    {{-- Header --}}
    <div class="mb-10">
        <a href="{{ url()->previous() }}" class="inline-flex items-center gap-1.5 text-sm text-gray-400 hover:text-gray-600 transition-colors mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>

        <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 rounded-xl bg-cornflower flex items-center justify-center shadow-md">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wide font-medium mb-0.5">Kategori Sponsor</p>
                <h1 class="text-3xl font-bold text-gray-900">{{ $kategori->nama_kategori ?? 'Semua Sponsor' }}</h1>
            </div>
        </div>
        <p class="text-gray-500 ml-[52px]">Temukan sponsor yang sesuai dengan kegiatan atau proposalmu.</p>
    </div>

    {{-- Grid --}}
    <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-5">
        @forelse ($sponsors as $s)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 flex flex-col">

                {{-- Card Header --}}
                <div class="p-6 flex-1">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-11 h-11 rounded-xl bg-cornflower/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-cornflower" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-green-700 bg-green-100 px-2.5 py-1 rounded-full flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                            Aktif
                        </span>
                    </div>

                    <h3 class="font-bold text-gray-900 text-base mb-1">{{ $s->nama }}</h3>

                    <div class="flex items-center gap-1.5 text-xs text-gray-400 mb-3">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        {{ $s->industri }}
                    </div>

                    <p class="text-sm text-gray-500 leading-relaxed line-clamp-3">
                        {{ $s->deskripsi }}
                    </p>

                    {{-- Dana info --}}
                    @if($s->min_dana || $s->max_dana)
                        <div class="mt-4 flex items-center gap-1.5 text-xs text-gray-500 bg-gray-50 rounded-xl px-3 py-2">
                            <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>
                                Rp {{ number_format($s->min_dana,0,',','.') }}
                                @if($s->max_dana)
                                    – Rp {{ number_format($s->max_dana,0,',','.') }}
                                @endif
                            </span>
                        </div>
                    @endif

                    {{-- Lokasi --}}
                    @if($s->lokasi)
                        <div class="mt-2 flex items-center gap-1.5 text-xs text-gray-500">
                            <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $s->lokasi }}
                        </div>
                    @endif
                </div>

                {{-- Divider + CTA --}}
                <div class="border-t border-gray-100 p-4">
<a
                        href="{{ route('explore.sponsor', $s->id) }}"
                        class="flex items-center justify-center gap-2 w-full bg-cornflower hover:opacity-90 active:opacity-80 text-white text-sm font-medium py-2.5 rounded-xl transition-opacity"
                    >
                        Lihat Detail
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

            </div>

        @empty
            <div class="col-span-full">
                <div class="bg-white rounded-2xl border border-dashed border-gray-200 p-16 text-center">
                    <div class="w-14 h-14 rounded-2xl bg-gray-100 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-semibold text-gray-800 mb-1">Belum Ada Sponsor</h3>
                    <p class="text-sm text-gray-400 max-w-xs mx-auto">
                        Tidak ada sponsor yang tersedia di kategori ini saat ini.
                    </p>
                </div>
            </div>
        @endforelse

    </div>
</main>

@endsection
