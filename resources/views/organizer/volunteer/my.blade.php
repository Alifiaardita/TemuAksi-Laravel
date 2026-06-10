@extends('layouts.app')

@section('title', 'Volunteer Saya')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

<section class="max-w-7xl mx-auto px-6 py-10">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Volunteer Saya</h1>
        <p class="text-gray-500 mt-2">
            Kelola dan pantau seluruh pendaftaran volunteer yang pernah kamu ikuti.
        </p>
    </div>

    <div x-data="{ tab: 'menunggu' }" class="bg-white rounded-2xl shadow-sm overflow-hidden">

        {{-- Tabs --}}
        <div class="border-b border-gray-100">
            <div class="flex overflow-x-auto">

                <button
                    @click="tab='menunggu'"
                    :class="tab==='menunggu' ? 'border-b-2 border-amber-500 text-amber-600' : 'text-gray-400 hover:text-gray-600'"
                    class="px-6 py-4 text-sm font-medium whitespace-nowrap transition"
                >
                    <i class="ti ti-clock mr-1.5" aria-hidden="true"></i>
                    Menunggu
                    <span class="ml-1.5 px-2 py-0.5 rounded-full text-xs bg-amber-50 text-amber-600">
                        {{ $groups['menunggu']->count() }}
                    </span>
                </button>

                <button
                    @click="tab='diterima'"
                    :class="tab==='diterima' ? 'border-b-2 border-green-500 text-green-600' : 'text-gray-400 hover:text-gray-600'"
                    class="px-6 py-4 text-sm font-medium whitespace-nowrap transition"
                >
                    <i class="ti ti-circle-check mr-1.5" aria-hidden="true"></i>
                    Diterima
                    <span class="ml-1.5 px-2 py-0.5 rounded-full text-xs bg-green-50 text-green-600">
                        {{ $groups['diterima']->count() }}
                    </span>
                </button>

                <button
                    @click="tab='selesai'"
                    :class="tab==='selesai' ? 'border-b-2 border-purple-500 text-purple-600' : 'text-gray-400 hover:text-gray-600'"
                    class="px-6 py-4 text-sm font-medium whitespace-nowrap transition"
                >
                    <i class="ti ti-trophy mr-1.5" aria-hidden="true"></i>
                    Selesai
                    <span class="ml-1.5 px-2 py-0.5 rounded-full text-xs bg-purple-50 text-purple-600">
                        {{ $groups['selesai']->count() }}
                    </span>
                </button>

                <button
                    @click="tab='ditolak'"
                    :class="tab==='ditolak' ? 'border-b-2 border-red-500 text-red-600' : 'text-gray-400 hover:text-gray-600'"
                    class="px-6 py-4 text-sm font-medium whitespace-nowrap transition"
                >
                    <i class="ti ti-circle-x mr-1.5" aria-hidden="true"></i>
                    Ditolak
                    <span class="ml-1.5 px-2 py-0.5 rounded-full text-xs bg-red-50 text-red-500">
                        {{ $groups['ditolak']->count() }}
                    </span>
                </button>

            </div>
        </div>

        {{-- MENUNGGU --}}
        <div x-show="tab === 'menunggu'" class="p-6 space-y-4">

            @forelse($groups['menunggu'] as $item)
                <div class="border border-gray-100 rounded-xl p-5 hover:bg-gray-50 transition">
                    <div class="flex justify-between items-start gap-4">
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-gray-900">
                                {{ $item->kegiatan->judul }}
                            </h3>
                            <p class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                                <i class="ti ti-building" aria-hidden="true"></i>
                                {{ $item->kegiatan->penyelenggara }}
                            </p>
                            <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
                                <i class="ti ti-map-pin" aria-hidden="true"></i>
                                {{ $item->kegiatan->lokasi ?: '-' }}
                            </p>
                        </div>
                        <span class="shrink-0 inline-flex items-center gap-1 bg-amber-50 text-amber-700 px-3 py-1 rounded-full text-xs font-medium">
                            <i class="ti ti-clock text-xs" aria-hidden="true"></i>
                            Menunggu
                        </span>
                    </div>
                </div>
            @empty
                <div class="text-center py-16">
                    <div class="w-14 h-14 rounded-2xl bg-amber-50 flex items-center justify-center mx-auto mb-4">
                        <i class="ti ti-clock text-2xl text-amber-400" aria-hidden="true"></i>
                    </div>
                    <p class="text-sm text-gray-400">Belum ada volunteer yang menunggu konfirmasi.</p>
                </div>
            @endforelse

        </div>

        {{-- DITERIMA --}}
        <div x-show="tab === 'diterima'" class="p-6 space-y-4">

            @forelse($groups['diterima'] as $item)
                <div class="border border-gray-100 rounded-xl p-5 hover:bg-gray-50 transition">
                    <div class="flex justify-between items-start gap-4">
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-gray-900">
                                {{ $item->kegiatan->judul }}
                            </h3>
                            <p class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                                <i class="ti ti-building" aria-hidden="true"></i>
                                {{ $item->kegiatan->penyelenggara }}
                            </p>
                            <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
                                <i class="ti ti-map-pin" aria-hidden="true"></i>
                                {{ $item->kegiatan->lokasi ?: '-' }}
                            </p>
                        </div>
                        <span class="shrink-0 inline-flex items-center gap-1 bg-green-50 text-green-700 px-3 py-1 rounded-full text-xs font-medium">
                            <i class="ti ti-circle-check text-xs" aria-hidden="true"></i>
                            Diterima
                        </span>
                    </div>
                </div>
            @empty
                <div class="text-center py-16">
                    <div class="w-14 h-14 rounded-2xl bg-green-50 flex items-center justify-center mx-auto mb-4">
                        <i class="ti ti-circle-check text-2xl text-green-400" aria-hidden="true"></i>
                    </div>
                    <p class="text-sm text-gray-400">Belum ada volunteer yang diterima.</p>
                </div>
            @endforelse

        </div>

        {{-- SELESAI --}}
        <div x-show="tab === 'selesai'" class="p-6 space-y-4">

            @forelse($groups['selesai'] as $item)
                <div class="border border-gray-100 rounded-xl p-5 hover:bg-gray-50 transition">
                    <div class="flex justify-between items-start gap-4">
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-gray-900">
                                {{ $item->kegiatan->judul }}
                            </h3>
                            <p class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                                <i class="ti ti-building" aria-hidden="true"></i>
                                {{ $item->kegiatan->penyelenggara }}
                            </p>
                            <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
                                <i class="ti ti-map-pin" aria-hidden="true"></i>
                                {{ $item->kegiatan->lokasi ?: '-' }}
                            </p>
                        </div>
                        <div class="shrink-0 text-right space-y-2">
                            <span class="inline-flex items-center gap-1 bg-purple-50 text-purple-700 px-3 py-1 rounded-full text-xs font-medium">
                                <i class="ti ti-trophy text-xs" aria-hidden="true"></i>
                                Selesai
                            </span>
                            @if($item->sertifikat)
                                <div>

                                        href="{{ route('volunteer.sertifikat') }}"
                                        class="inline-flex items-center gap-1 text-xs text-blue-600 hover:text-blue-700 font-medium"
                                    >
                                        <i class="ti ti-award text-xs" aria-hidden="true"></i>
                                        Lihat Sertifikat
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-16">
                    <div class="w-14 h-14 rounded-2xl bg-purple-50 flex items-center justify-center mx-auto mb-4">
                        <i class="ti ti-trophy text-2xl text-purple-400" aria-hidden="true"></i>
                    </div>
                    <p class="text-sm text-gray-400">Belum ada volunteer yang selesai.</p>
                </div>
            @endforelse

        </div>

        {{-- DITOLAK --}}
        <div x-show="tab === 'ditolak'" class="p-6 space-y-4">

            @forelse($groups['ditolak'] as $item)
                <div class="border border-gray-100 rounded-xl p-5 hover:bg-gray-50 transition">
                    <div class="flex justify-between items-start gap-4">
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-gray-900">
                                {{ $item->kegiatan->judul }}
                            </h3>
                            <p class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                                <i class="ti ti-building" aria-hidden="true"></i>
                                {{ $item->kegiatan->penyelenggara }}
                            </p>
                            <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
                                <i class="ti ti-map-pin" aria-hidden="true"></i>
                                {{ $item->kegiatan->lokasi ?: '-' }}
                            </p>
                        </div>
                        <span class="shrink-0 inline-flex items-center gap-1 bg-red-50 text-red-600 px-3 py-1 rounded-full text-xs font-medium">
                            <i class="ti ti-circle-x text-xs" aria-hidden="true"></i>
                            Ditolak
                        </span>
                    </div>
                </div>
            @empty
                <div class="text-center py-16">
                    <div class="w-14 h-14 rounded-2xl bg-red-50 flex items-center justify-center mx-auto mb-4">
                        <i class="ti ti-circle-x text-2xl text-red-400" aria-hidden="true"></i>
                    </div>
                    <p class="text-sm text-gray-400">Belum ada volunteer yang ditolak.</p>
                </div>
            @endforelse

        </div>

    </div>

</section>

@endsection
