@extends('layouts.app')

@section('title', $sponsor->nama)

@section('content')

<section class="py-12 px-6">
<div class="max-w-4xl mx-auto">

    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ url()->previous() }}" class="inline-flex items-center gap-1.5 text-sm text-gray-400 hover:text-gray-600 transition-colors mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>

        <div class="flex items-start gap-4">
            <div class="w-14 h-14 rounded-2xl bg-cornflower/10 flex items-center justify-center flex-shrink-0">
                <svg class="w-7 h-7 text-cornflower" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $sponsor->nama }}</h1>
                <p class="text-gray-500 mt-1.5 leading-relaxed">{{ $sponsor->deskripsi }}</p>
            </div>
        </div>
    </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

        {{-- Dana Banner --}}
        <div class="bg-cornflower p-8">
            <div class="flex items-center gap-2 mb-5">
                <svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h2 class="text-white font-semibold text-lg">Range Sponsorship</h2>
            </div>

            <div class="grid sm:grid-cols-2 gap-4">
                <div class="bg-white/15 backdrop-blur-sm border border-white/20 p-5 rounded-xl">
                    <p class="text-white/70 text-sm mb-1">Dana Minimum</p>
                    <p class="text-2xl font-bold text-white">Rp {{ number_format($sponsor->min_dana,0,',','.') }}</p>
                </div>
                <div class="bg-white/15 backdrop-blur-sm border border-white/20 p-5 rounded-xl">
                    <p class="text-white/70 text-sm mb-1">Dana Maksimum</p>
                    <p class="text-2xl font-bold text-white">Rp {{ number_format($sponsor->max_dana,0,',','.') }}</p>
                </div>
            </div>
        </div>

        {{-- Detail Info --}}
        <div class="p-8">

            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-4">Informasi Sponsor</h3>

            <div class="grid sm:grid-cols-2 gap-4 mb-6">

                <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-xl">
                    <div class="w-8 h-8 rounded-lg bg-white border border-gray-200 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-0.5">Industri</p>
                        <p class="text-sm font-medium text-gray-800">{{ $sponsor->industri }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-xl">
                    <div class="w-8 h-8 rounded-lg bg-white border border-gray-200 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-0.5">Lokasi</p>
                        <p class="text-sm font-medium text-gray-800">{{ $sponsor->lokasi }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-xl">
                    <div class="w-8 h-8 rounded-lg bg-white border border-gray-200 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-0.5">Status</p>
                        <span class="inline-flex items-center gap-1 text-xs font-medium text-green-700 bg-green-100 px-2 py-0.5 rounded-full">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                            Aktif Menerima Proposal
                        </span>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-xl">
                    <div class="w-8 h-8 rounded-lg bg-white border border-gray-200 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-0.5">Total Range Dana</p>
                        <p class="text-sm font-medium text-gray-800">
                            Rp {{ number_format($sponsor->min_dana,0,',','.') }} – Rp {{ number_format($sponsor->max_dana,0,',','.') }}
                        </p>
                    </div>
                </div>

            </div>

            {{-- Info Box --}}
            <div class="flex items-start gap-3 bg-blue-50 border border-blue-100 rounded-xl p-4 mb-6">
                <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-xs text-blue-700 leading-relaxed">
                    Pastikan proposal kamu sesuai dengan industri dan range dana yang tersedia. Proposal yang tidak sesuai dapat ditolak secara otomatis oleh sistem.
                </p>
            </div>

            {{-- Divider --}}
            <div class="border-t border-gray-100 mb-6"></div>

            {{-- CTA --}}
        <a
            href="{{ route('proposal.create', $sponsor->id) }}"
            class="flex items-center justify-center gap-2 w-full bg-cornflower hover:opacity-90 active:opacity-80 text-white py-3 rounded-xl font-medium text-sm transition-opacity"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Ajukan Proposal ke {{ $sponsor->nama }}
        </a>

        </div>
    </div>

</div>
</section>

@endsection
