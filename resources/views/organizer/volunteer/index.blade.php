@extends('layouts.app')

@section('title', 'Explore Volunteer')

@section('content')

<section class="max-w-7xl mx-auto px-6 py-10">

    {{-- Header --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center shadow-md">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">Explore Volunteer</h1>
        </div>
        <p class="text-gray-500 ml-13">Temukan peluang volunteer yang sesuai dengan minat dan kemampuanmu.</p>
    </div>

    {{-- Filter --}}
    <form method="GET" action="{{ route('volunteer.index') }}"
          class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-8">

        <div class="grid md:grid-cols-3 gap-4">

            {{-- Search --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Cari Volunteer</label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Masukkan judul volunteer..."
                        class="w-full border border-gray-200 rounded-xl pl-10 pr-4 py-3 text-sm focus:ring-2 focus:ring-primary focus:outline-none focus:border-transparent transition"
                    >
                </div>
            </div>

            {{-- Kategori --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Kategori</label>
                <div class="relative">
                    <select
                        name="kategori"
                        class="w-full appearance-none border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary focus:outline-none focus:border-transparent transition bg-white pr-10"
                    >
                        <option value="">Semua Kategori</option>
                        @foreach($kategoriList as $kategori)
                            <option value="{{ $kategori->id }}" @selected(request('kategori') == $kategori->id)>
                                {{ $kategori->nama_kategori }}
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

            {{-- Actions --}}
            <div class="flex items-end gap-2">
                <button
                    type="submit"
                    class="flex-1 flex items-center justify-center gap-2 bg-primary text-white rounded-xl py-3 text-sm font-medium hover:opacity-90 transition"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                    </svg>
                    Filter
                </button>
<a
                    href="{{ route('volunteer.index') }}"
                    class="flex items-center justify-center gap-1.5 px-4 py-3 border border-gray-200 rounded-xl text-sm text-gray-500 hover:bg-gray-50 transition"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Reset
                </a>
            </div>

        </div>
    </form>

    {{-- Jumlah Data --}}
    <div class="mb-5 flex items-center justify-between">
        <p class="text-sm text-gray-500">
            Menampilkan
            <span class="font-semibold text-gray-700">{{ $kegiatanList->count() }}</span>
            kegiatan volunteer
        </p>
    </div>

    {{-- Cards --}}
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">

        @forelse($kegiatanList as $kegiatan)
<a

                href="{{ route('volunteer.detail', $kegiatan->id) }}"
                class="group block bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200"
            >

                {{-- Gambar --}}
                <div class="relative h-48 overflow-hidden">
                    <img
                        src="{{ $kegiatan->gambar_url ? Storage::url($kegiatan->gambar_url) : 'https://placehold.co/600x400?text=Volunteer' }}"
                        alt="{{ $kegiatan->judul }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                        onerror="this.src='https://placehold.co/600x400?text=Volunteer'"
                    >
                    <div class="absolute inset-0 bg-linear-to-t from-black/30 to-transparent"></div>

                    {{-- Status badge overlay --}}
                    <div class="absolute top-3 left-3">
                        <span class="text-xs font-medium px-2.5 py-1 rounded-full
                            @if($kegiatan->status == 'aktif') bg-green-100 text-green-700
                            @elseif($kegiatan->status == 'penuh')
                            @elseif($kegiatan->status == 'selesai')
                            @else @endif
                        ">
                            @if($kegiatan->status == 'aktif')
                                <span class="inline-block w-1.5 h-1.5 rounded-full bg-green-500 mr-1"></span>
                            @endif
                            {{ ucfirst($kegiatan->status) }}
                        </span>
                    </div>

                    {{-- Deadline badge --}}
                    @if($kegiatan->deadline_daftar)
                        <div class="absolute top-3 right-3">
                            <span class="text-xs bg-black/50 backdrop-blur-sm text-white px-2.5 py-1 rounded-full">
                                {{ $kegiatan->deadline_daftar->format('d M Y') }}
                            </span>
                        </div>
                    @endif
                </div>

                <div class="p-5">

                    {{-- Judul --}}
                    <h3 class="font-semibold text-gray-900 text-base leading-snug line-clamp-2 mb-1">
                        {{ $kegiatan->judul }}
                    </h3>

                    {{-- Penyelenggara --}}
                    <p class="text-xs text-gray-400 mb-4">{{ $kegiatan->penyelenggara }}</p>

                    {{-- Info rows --}}
                    <div class="space-y-2 text-sm text-gray-600">

                        <div class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-gray-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="truncate">{{ $kegiatan->lokasi ?: '-' }}</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-gray-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>{{ $kegiatan->tanggal_mulai->format('d M Y') }}</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-gray-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>
                                {{ $kegiatan->jumlah_daftar }}
                                @if($kegiatan->kuota)
                                    / {{ $kegiatan->kuota }}
                                @endif
                                Volunteer
                            </span>

                            {{-- Progress bar kuota --}}
                            @if($kegiatan->kuota)
                                @php $pct = min(100, round(($kegiatan->jumlah_daftar / $kegiatan->kuota) * 100)) @endphp
                                <div class="flex-1 bg-gray-100 rounded-full h-1.5 ml-1">
                                    <div
                                        class="h-1.5 rounded-full {{ $pct >= 100 ? 'bg-red-400' : ($pct >= 70 ? 'bg-amber-400' : 'bg-green-400') }}"
                                        style="width: {{ $pct }}%"
                                    ></div>
                                </div>
                            @endif
                        </div>

                    </div>
                    {{-- Empty state (hidden by default, ditampilkan JS) --}}
<div id="emptyState" class="hidden col-span-full">
    <div class="bg-white rounded-2xl border border-dashed border-gray-200 p-16 text-center">
        <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-800 mb-1">Tidak Ditemukan</h3>
        <p class="text-sm text-gray-400">Coba kata kunci atau filter yang berbeda.</p>
    </div>
</div>

                    {{-- Footer --}}
                    <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-sm text-primary font-medium">Lihat Detail</span>
                        <div class="w-7 h-7 rounded-full bg-gray-100 group-hover:bg-primary flex items-center justify-center transition-colors duration-200">
                            <svg class="w-3.5 h-3.5 text-gray-400 group-hover:text-blue transition-colors duration-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>

                </div>
            </a>

        @empty

            <div class="col-span-full">
                <div class="bg-white rounded-2xl border border-dashed border-gray-200 p-16 text-center">
                    <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Belum Ada Volunteer</h3>
                    <p class="text-sm text-gray-400 max-w-xs mx-auto">
                        Saat ini belum ada kegiatan volunteer yang tersedia. Coba ubah filter pencarianmu.
                    </p>
                </div>
            </div>

        @endforelse

    </div>

</section>

@endsection
