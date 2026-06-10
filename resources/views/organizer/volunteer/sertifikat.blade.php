@extends('layouts.app')
@section('title', 'Sertifikat Volunteer')
@section('content')
<section class="max-w-7xl mx-auto px-6 py-10">

    {{-- Header --}}
    <div class="mb-10">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center shadow-md">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">Sertifikat Volunteer</h1>
        </div>
        <p class="text-gray-500 ml-13 pl-0.5">
            Kumpulan sertifikat dari kegiatan volunteer yang telah kamu selesaikan.
        </p>
    </div>

    {{-- Grid Cards --}}
    <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-6">
        @forelse($sertifikatList as $sertifikat)
            @php
                $pendaftaran = $sertifikat->pendaftaran;
                $kegiatan = $pendaftaran?->kegiatan;
                $hasFile = !empty($sertifikat->file_url);
            @endphp

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col hover:shadow-md transition-shadow duration-200">

                {{-- Icon + Badge --}}
                <div class="flex items-start justify-between mb-5">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center shadow-md">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    @if($hasFile)
                        <span class="text-xs font-medium text-green-700 bg-green-100 px-2.5 py-1 rounded-full">Tersedia</span>
                    @else
                        <span class="text-xs font-medium text-amber-600 bg-amber-100 px-2.5 py-1 rounded-full">Pending</span>
                    @endif
                </div>

                {{-- Title & Organizer --}}
                <h3 class="font-semibold text-gray-900 text-base leading-snug mb-1">
                    {{ $kegiatan?->judul ?? 'Volunteer' }}
                </h3>
                <p class="text-sm text-gray-400 mb-5">
                    {{ $kegiatan?->penyelenggara }}
                </p>

                {{-- Meta Info --}}
                <div class="space-y-3 text-sm flex-1">

                    <div class="flex items-center gap-2.5 text-gray-600">
                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a0 0 0 010 0 4 4 0 014-4z"/>
                        </svg>
                        <span class="text-gray-400">Kategori:</span>
                        <span class="font-medium text-gray-700">{{ $kegiatan?->kategori?->nama_kategori ?? '-' }}</span>
                    </div>

                    <div class="flex items-center gap-2.5 text-gray-600">
                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="text-gray-400">Terbit:</span>
                        <span class="font-medium text-gray-700">{{ $sertifikat->created_at?->format('d M Y') }}</span>
                    </div>

                    @if(!empty($sertifikat->nomor_sertifikat))
                        <div class="flex items-center gap-2.5 text-gray-600">
                            <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                            </svg>
                            <span class="text-gray-400">No. Sertifikat:</span>
                            <span class="font-medium text-gray-700 truncate">{{ $sertifikat->nomor_sertifikat }}</span>
                        </div>
                    @endif
                </div>

                {{-- Divider --}}
                <div class="border-t border-gray-100 my-5"></div>

                {{-- Action Button --}}
                @if($hasFile)

                        href="{{ asset($sertifikat->file_url) }}"
                        target="_blank"
                        class="flex items-center justify-center gap-2 w-full bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white text-sm font-medium py-2.5 rounded-xl transition-colors duration-150"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Download Sertifikat
                    </a>
                @else
                    <div class="flex items-center justify-center gap-2 w-full bg-gray-50 text-gray-400 text-sm py-2.5 rounded-xl cursor-not-allowed">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Menunggu diterbitkan
                    </div>
                @endif
            </div>

        @empty
            <div class="col-span-full">
                <div class="bg-white rounded-2xl border border-dashed border-gray-200 p-16 text-center">
                    <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Belum Ada Sertifikat</h3>
                    <p class="text-sm text-gray-400 max-w-xs mx-auto">
                        Sertifikat akan muncul setelah kamu menyelesaikan kegiatan volunteer.
                    </p>
                </div>
            </div>
        @endforelse
    </div>
</section>
@endsection
