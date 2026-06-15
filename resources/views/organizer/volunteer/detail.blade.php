@extends('layouts.app')

@section('title', $kegiatan->judul)

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

<section class="max-w-7xl mx-auto px-6 py-10">

    {{-- Breadcrumb --}}
    <div class="mb-6">
        <a href="{{ route('volunteer.index') }}"
           class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-blue-600 transition">
            <i class="ti ti-arrow-left" aria-hidden="true"></i>
            Kembali ke Explore Volunteer
        </a>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">

        {{-- Konten Utama --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Card Utama --}}
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm">

                {{-- Gambar --}}
                <div class="relative">
                    <img
                        src="{{ $kegiatan->gambar_url ? asset('storage/'.$kegiatan->gambar_url) : 'https://placehold.co/1200x500?text=Volunteer' }}"
                        alt="{{ $kegiatan->judul }}"
                        class="w-full h-72 object-cover"
                    >
                    {{-- Overlay badges --}}
                    <div class="absolute top-4 left-4 flex gap-2">
                        <span class="px-3 py-1 rounded-full bg-white/90 text-blue-700 text-xs font-medium shadow-sm">
                            {{ $kegiatan->kategori?->nama_kategori }}
                        </span>
                        <span class="px-3 py-1 rounded-full text-xs font-medium shadow-sm
                            @if($kegiatan->status == 'aktif') bg-green-500 text-white
                            @elseif($kegiatan->status == 'penuh') bg-amber-500 text-white
                            @elseif($kegiatan->status == 'selesai') bg-blue-500 text-white
                            @else bg-red-500 text-white
                            @endif">
                            {{ ucfirst($kegiatan->status) }}
                        </span>
                    </div>
                </div>

                <div class="p-8">

                    {{-- Judul --}}
                    <h1 class="text-2xl font-bold text-gray-900 mb-6">
                        {{ $kegiatan->judul }}
                    </h1>

                    {{-- Info Grid --}}
                    <div class="grid md:grid-cols-2 gap-4 mb-8">

                        <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-xl">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center shrink-0">
                                <i class="ti ti-building text-blue-600 text-sm" aria-hidden="true"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-0.5">Penyelenggara</p>
                                <p class="text-sm font-medium text-gray-800">{{ $kegiatan->penyelenggara }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-xl">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center shrink-0">
                                <i class="ti ti-map-pin text-blue-600 text-sm" aria-hidden="true"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-0.5">Lokasi</p>
                                <p class="text-sm font-medium text-gray-800">{{ $kegiatan->lokasi ?: '-' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-xl">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center shrink-0">
                                <i class="ti ti-calendar text-blue-600 text-sm" aria-hidden="true"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-0.5">Tanggal</p>
                                <p class="text-sm font-medium text-gray-800">
                                    {{ \Carbon\Carbon::parse($kegiatan->tanggal_mulai)->format('d M Y') }}
                                    @if($kegiatan->tanggal_selesai)
                                        &ndash; {{ \Carbon\Carbon::parse($kegiatan->tanggal_selesai)->format('d M Y') }}
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-xl">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center shrink-0">
                                <i class="ti ti-clock text-blue-600 text-sm" aria-hidden="true"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-0.5">Jam</p>
                                <p class="text-sm font-medium text-gray-800">
                                    {{ $kegiatan->jam_mulai }} &ndash; {{ $kegiatan->jam_selesai }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-xl">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center shrink-0">
                                <i class="ti ti-layout-list text-blue-600 text-sm" aria-hidden="true"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-0.5">Divisi</p>
                                <p class="text-sm font-medium text-gray-800">{{ $kegiatan->divisi ?: '-' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-xl">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center shrink-0">
                                <i class="ti ti-users text-blue-600 text-sm" aria-hidden="true"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-0.5">Kuota</p>
                                <p class="text-sm font-medium text-gray-800">
                                    {{ $kegiatan->jumlah_daftar }}
                                    @if($kegiatan->kuota) / {{ $kegiatan->kuota }} @endif
                                    peserta
                                </p>
                            </div>
                        </div>

                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-8">
                        <h3 class="text-base font-semibold text-gray-900 mb-3 flex items-center gap-2">
                            <i class="ti ti-align-left text-gray-400" aria-hidden="true"></i>
                            Deskripsi Kegiatan
                        </h3>
                        <div class="text-sm text-gray-600 whitespace-pre-line leading-relaxed">
                            {{ $kegiatan->deskripsi }}
                        </div>
                    </div>

                    <hr class="border-gray-100 mb-8">

                    {{-- Syarat --}}
                    <div class="mb-8">
                        <h3 class="text-base font-semibold text-gray-900 mb-3 flex items-center gap-2">
                            <i class="ti ti-checklist text-gray-400" aria-hidden="true"></i>
                            Syarat Volunteer
                        </h3>
                        <div class="text-sm text-gray-600 whitespace-pre-line leading-relaxed">
                            {{ $kegiatan->syarat ?: '-' }}
                        </div>
                    </div>

                    <hr class="border-gray-100 mb-8">

                    {{-- Benefit --}}
                    <div class="mb-8">
                        <h3 class="text-base font-semibold text-gray-900 mb-3 flex items-center gap-2">
                            <i class="ti ti-gift text-gray-400" aria-hidden="true"></i>
                            Benefit
                        </h3>
                        <div class="text-sm text-gray-600 whitespace-pre-line leading-relaxed">
                            @if($kegiatan->benefit)
                                @php $benefits = is_array($kegiatan->benefit) ? $kegiatan->benefit : json_decode($kegiatan->benefit, true); @endphp
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach($benefits as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            @else
                                -
                            @endif
                        </div>
                    </div>

                    <hr class="border-gray-100 mb-8">

                    {{-- Cara Seleksi --}}
                    <div>
                        <h3 class="text-base font-semibold text-gray-900 mb-3 flex items-center gap-2">
                            <i class="ti ti-filter text-gray-400" aria-hidden="true"></i>
                            Cara Seleksi
                        </h3>
                        <div class="text-sm text-gray-600 whitespace-pre-line leading-relaxed">
                            {{ $kegiatan->cara_seleksi ?: '-' }}
                        </div>
                    </div>

                </div>

            </div>

        </div>

        {{-- Sidebar --}}
        <div>

            <div class="bg-white rounded-2xl shadow-sm p-6 sticky top-24">

                <h3 class="font-semibold text-base text-gray-900 mb-5 flex items-center gap-2">
                    <i class="ti ti-clipboard-list text-gray-400" aria-hidden="true"></i>
                    Informasi Pendaftaran
                </h3>

                <div class="space-y-4 mb-6">

                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center shrink-0">
                            <i class="ti ti-calendar-off text-red-500 text-sm" aria-hidden="true"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 mb-0.5">Deadline Pendaftaran</p>
                            <p class="text-sm font-medium text-gray-800">
                                {{ $kegiatan->deadline_daftar
                                    ? \Carbon\Carbon::parse($kegiatan->deadline_daftar)->format('d M Y')
                                    : '-'
                                }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center shrink-0">
                            <i class="ti ti-phone text-green-600 text-sm" aria-hidden="true"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 mb-0.5">Kontak PIC</p>
                            <p class="text-sm font-medium text-gray-800">{{ $kegiatan->kontak ?: '-' }}</p>
                        </div>
                    </div>

                </div>

                <hr class="border-gray-100 mb-6">

                @if($sudahDaftar)

                    <div class="bg-green-50 border border-green-100 rounded-xl p-4">
                        <div class="flex items-center gap-2 mb-2">
                            <i class="ti ti-circle-check text-green-600" aria-hidden="true"></i>
                            <p class="text-sm font-semibold text-green-800">Kamu sudah terdaftar</p>
                        </div>
                        <p class="text-xs text-green-700">
                            Status:
                            <span class="font-semibold">{{ ucfirst($pendaftaranSaya->status) }}</span>
                        </p>
                    </div>

                @else

                    <form action="{{ route('volunteer.daftar', $kegiatan->id) }}" method="POST" class="space-y-3">
                        @csrf

                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Nama Lengkap</label>
                            <input
                                type="text"
                                name="nama_lengkap"
                                placeholder="Nama lengkap kamu"
                                required
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-100 focus:border-blue-400 focus:outline-none transition"
                            >
                        </div>

                        <div>
                            <label class="block text-xs text-gray-500 mb-1">No Telepon</label>
                            <input
                                type="text"
                                name="no_telepon"
                                placeholder="08xxxxxxxxxx"
                                required
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-100 focus:border-blue-400 focus:outline-none transition"
                            >
                        </div>

                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Email</label>
                            <input
                                type="email"
                                name="email"
                                placeholder="email@kamu.com"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-100 focus:border-blue-400 focus:outline-none transition"
                            >
                        </div>

                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Motivasi</label>
                            <textarea
                                name="motivasi"
                                rows="3"
                                placeholder="Apa motivasimu mengikuti volunteer ini?"
                                required
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-100 focus:border-blue-400 focus:outline-none transition resize-none"
                            ></textarea>
                        </div>

                        <div>
                            <label class="block text-xs text-gray-500 mb-1">
                                Pengalaman
                                <span class="text-gray-300">(opsional)</span>
                            </label>
                            <textarea
                                name="pengalaman"
                                rows="3"
                                placeholder="Pengalaman organisasi / volunteer sebelumnya"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-100 focus:border-blue-400 focus:outline-none transition resize-none"
                            ></textarea>
                        </div>

                        <button
                            type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white py-2.5 rounded-xl text-sm font-medium transition flex items-center justify-center gap-2"
                        >
                            <i class="ti ti-send" aria-hidden="true"></i>
                            Daftar Volunteer
                        </button>

                    </form>

                @endif

            </div>

        </div>

    </div>

</section>

@endsection
