@extends('layouts.app')

@section('content')

@auth

    {{-- ========== WELCOME BANNER (pengganti hero untuk logged-in) ========== --}}
    <section class="relative overflow-hidden" style="background: linear-gradient(135deg, #0f1e45 0%, #1a3a6e 50%, #2d4fa0 100%);">
        <div class="absolute top-0 right-0 w-96 h-96 rounded-full opacity-10" style="background: #4a6cf7; transform: translate(30%, -30%);"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 rounded-full opacity-10" style="background: #4a6cf7; transform: translate(-30%, 30%);"></div>
        <div class="absolute inset-0 opacity-[0.06]"
             style="background-image: radial-gradient(circle, #ffffff 1px, transparent 1px); background-size: 28px 28px;"></div>

        <div class="relative max-w-6xl mx-auto px-6 py-16 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div class="text-white">
                <p class="text-xs uppercase tracking-widest text-white/40 mb-2">
                    {{ strtoupper(now()->translatedFormat('l, d F Y')) }}
                </p>
                <h2 class="text-3xl md:text-4xl font-black mb-2">
                    Selamat Datang, {{ auth()->user()->userProfile?->nama_lengkap ?? auth()->user()->name }}
                </h2>
                <p class="text-white/50 text-sm">
                    Kelola event, ajukan proposal sponsorship, dan rekrut volunteer untuk acaramu.
                </p>
            </div>
            <div class="flex gap-3 shrink-0">
                <a href="{{ route('explore.index') }}"
                   class="flex items-center gap-2 bg-white text-[#0f1e45] font-semibold px-5 py-3 rounded-xl hover:opacity-90 transition text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Lihat Event
                </a>
                <a href="{{ route('volunteer.index') }}"
                   class="flex items-center gap-2 bg-white/10 border border-white/20 text-white font-semibold px-5 py-3 rounded-xl hover:bg-white/20 transition text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Cari Volunteer
                </a>
            </div>
        </div>
    </section>

    {{-- ========== RINGKASAN AKTIVITAS ========== --}}
    <section style="background: linear-gradient(90deg, #0f1e45 0%, #2d4fa0 100%);">
    <div class="max-w-6xl mx-auto px-6 py-8 grid grid-cols-2 md:grid-cols-4 divide-x divide-white/10 text-center">
        <div class="px-6 py-2">
            <p class="text-2xl font-black text-white">0</p>
            <p class="text-xs text-white/50 mt-1">Event Diikuti</p>
        </div>
        <div class="px-6 py-2">
            <p class="text-2xl font-black text-white">{{ $stats['proposal_terkirim'] ?? 0 }}</p>
            <p class="text-xs text-white/50 mt-1">Proposal Terkirim</p>
        </div>
        <div class="px-6 py-2">
            <p class="text-2xl font-black text-white">{{ $stats['sponsor_diperoleh'] ?? 0 }}</p>
            <p class="text-xs text-white/50 mt-1">Sponsor Diperoleh</p>
        </div>
        <div class="px-6 py-2">
            <p class="text-2xl font-black text-white">0</p>
            <p class="text-xs text-white/50 mt-1">Volunteer Terdaftar</p>
        </div>
    </div>
</section>

    {{-- ========== AKSI CEPAT ========== --}}
    <section class="py-16 bg-[#f0f2f8]">
        <div class="max-w-6xl mx-auto px-6">
            <div class="mb-10">
                <p class="text-xs font-semibold tracking-widest uppercase text-[#4a6cf7] mb-3">Dashboard</p>
                <h2 class="text-3xl font-black text-[#0f1e45]">Apa yang ingin kamu lakukan?</h2>
            </div>
            <div class="grid md:grid-cols-2 gap-6">

                {{-- Proposal Terbaru --}}
                <div class="bg-white rounded-2xl p-8 border border-gray-100">
    <div class="flex justify-between items-center mb-6">
        <h3 class="font-black text-[#0f1e45] text-lg">Proposal Terbaru</h3>
        <a href="{{ route('proposal.riwayat') }}" class="text-sm text-[#4a6cf7] font-semibold hover:underline">Lihat semua →</a>
    </div>

    @if(isset($proposalTerbaru) && $proposalTerbaru->count() > 0)
        <div class="space-y-3">
            @foreach($proposalTerbaru as $p)
                @php
                    $badge = match($p->status) {
                        'terkirim'  => 'bg-yellow-50 text-yellow-700 border border-yellow-200',
                        'pendanaan' => 'bg-blue-50 text-blue-700 border border-blue-200',
                        'selesai'   => 'bg-green-50 text-green-700 border border-green-200',
                        'ditolak'   => 'bg-red-50 text-red-700 border border-red-200',
                        default     => 'bg-gray-50 text-gray-600 border border-gray-200',
                    };
                @endphp
                <div class="flex items-center justify-between p-4 rounded-xl bg-[#f0f2f8]">
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-bold text-[#0f1e45] truncate">{{ $p->judul }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $p->sponsor->nama ?? '-' }} · {{ $p->tanggal->format('d M Y') }}</p>
                    </div>
                    <span class="ml-3 shrink-0 text-xs font-semibold px-2.5 py-1 rounded-full {{ $badge }}">
                        {{ ucfirst($p->status) }}
                    </span>
                </div>
            @endforeach
        </div>
    @else
        <div class="flex flex-col items-center justify-center py-10 text-center">
            <div class="w-12 h-12 bg-[#f0f2f8] rounded-2xl flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <p class="text-sm text-gray-400">Belum ada proposal yang dikirim.</p>
            <a href="{{ route('explore.index') }}" class="mt-4 text-xs text-[#4a6cf7] font-semibold hover:underline">Mulai kirim proposal →</a>
        </div>
    @endif
</div>

                {{-- Aksi Cepat --}}
                <div class="bg-white rounded-2xl p-8 border border-gray-100">
                    <h3 class="font-black text-[#0f1e45] text-lg mb-6">Aksi Cepat</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <a href="{{ route('explore.index') }}"
                           class="flex items-start gap-3 p-4 rounded-xl bg-[#f0f2f8] hover:bg-[#e4e8ff] transition group">
                            <div class="w-9 h-9 bg-white rounded-xl flex items-center justify-center shrink-0 group-hover:bg-[#4a6cf7] transition">
                                <svg class="w-4 h-4 text-[#4a6cf7] group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-[#0f1e45]">Explore Event</p>
                                <p class="text-xs text-gray-400 mt-0.5">Cari event untuk diikuti</p>
                            </div>
                        </a>
                        <a href="{{ route('volunteer.index') }}"
                           class="flex items-start gap-3 p-4 rounded-xl bg-[#f0f2f8] hover:bg-[#e4e8ff] transition group">
                            <div class="w-9 h-9 bg-white rounded-xl flex items-center justify-center shrink-0 group-hover:bg-[#4a6cf7] transition">
                                <svg class="w-4 h-4 text-[#4a6cf7] group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-[#0f1e45]">Cari Volunteer</p>
                                <p class="text-xs text-gray-400 mt-0.5">Temukan relawan eventmu</p>
                            </div>
                        </a>
                        <a href="{{ route('proposal.riwayat') }}"
                           class="flex items-start gap-3 p-4 rounded-xl bg-[#f0f2f8] hover:bg-[#e4e8ff] transition group">
                            <div class="w-9 h-9 bg-white rounded-xl flex items-center justify-center shrink-0 group-hover:bg-[#4a6cf7] transition">
                                <svg class="w-4 h-4 text-[#4a6cf7] group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-[#0f1e45]">Riwayat Proposal</p>
                                <p class="text-xs text-gray-400 mt-0.5">Pantau status proposalmu</p>
                            </div>
                        </a>
                        <a href="{{ route('organizer.faq') }}"
                           class="flex items-start gap-3 p-4 rounded-xl bg-[#f0f2f8] hover:bg-[#e4e8ff] transition group">
                            <div class="w-9 h-9 bg-white rounded-xl flex items-center justify-center shrink-0 group-hover:bg-[#4a6cf7] transition">
                                <svg class="w-4 h-4 text-[#4a6cf7] group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-[#0f1e45]">FAQ</p>
                                <p class="text-xs text-gray-400 mt-0.5">Bantuan & panduan</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@else

    {{-- ========== HERO ========== --}}
    <section class="relative overflow-hidden" style="background: linear-gradient(135deg, #0f1e45 0%, #1a3a6e 50%, #2d4fa0 100%);">
        <div class="absolute top-0 right-0 w-96 h-96 rounded-full opacity-10" style="background: #4a6cf7; transform: translate(30%, -30%);"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 rounded-full opacity-10" style="background: #4a6cf7; transform: translate(-30%, 30%);"></div>
        <div class="absolute top-1/2 left-1/2 w-150 h-150 rounded-full opacity-5" style="background: #4a6cf7; transform: translate(-50%, -50%);"></div>
        <div class="absolute inset-0 opacity-[0.06]"
             style="background-image: radial-gradient(circle, #ffffff 1px, transparent 1px); background-size: 28px 28px;"></div>

        <div class="relative max-w-6xl mx-auto px-6 py-32 flex flex-col items-center text-center">
            <span class="inline-block text-xs font-semibold tracking-widest uppercase text-[#4a6cf7] bg-white/10 backdrop-blur-sm border border-white/10 px-4 py-1.5 rounded-full mb-8">
                Platform Kolaborasi Event
            </span>
            <h1 class="text-5xl md:text-7xl font-black text-white leading-[1.08] mb-6 max-w-3xl">
                Event Lebih Besar,<br>
                <span class="text-[#7b9fff]">Kolaborasi</span> Lebih Mudah.
            </h1>
            <p class="text-white/60 text-lg leading-relaxed mb-10 max-w-lg">
                TemuAksi menyatukan penyelenggara, sponsor, dan volunteer dalam satu platform — dari proposal hingga hari H.
            </p>
            <div class="flex gap-3 flex-wrap justify-center">
                <a href="{{ route('login') }}"
                   class="bg-[#4a6cf7] text-white font-semibold px-7 py-3.5 rounded-xl hover:bg-[#3a5ce6] transition text-sm shadow-lg">
                    Mulai Jelajahi
                </a>
                <a href="{{ route('register') }}"
                   class="bg-white/10 backdrop-blur-sm border border-white/20 text-white font-semibold px-7 py-3.5 rounded-xl hover:bg-white/20 transition text-sm">
                    Daftar Gratis
                </a>
            </div>
            <div class="mt-16 flex items-center gap-6 flex-wrap justify-center">
                <div class="flex items-center gap-2 bg-white/10 border border-white/10 px-4 py-2 rounded-full text-white/80 text-xs font-medium">
                    <svg class="w-3.5 h-3.5 text-green-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Gratis untuk organizer
                </div>
                <div class="flex items-center gap-2 bg-white/10 border border-white/10 px-4 py-2 rounded-full text-white/80 text-xs font-medium">
                    <svg class="w-3.5 h-3.5 text-[#7b9fff]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    Proposal instan
                </div>
                <div class="flex items-center gap-2 bg-white/10 border border-white/10 px-4 py-2 rounded-full text-white/80 text-xs font-medium">
                    <svg class="w-3.5 h-3.5 text-[#7b9fff]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    2.000+ volunteer aktif
                </div>
            </div>
        </div>
    </section>

@endauth


{{-- ========== STATS BAR ========== --}}
<section style="background: linear-gradient(90deg, #0f1e45 0%, #2d4fa0 100%);">
    <div class="max-w-6xl mx-auto px-6 py-10 grid grid-cols-3 divide-x divide-white/10 text-center">
        <div class="px-6">
            <p class="text-3xl font-black text-white">120+</p>
            <p class="text-sm text-white/50 mt-1">Event Aktif</p>
        </div>
        <div class="px-6">
            <p class="text-3xl font-black text-white">80+</p>
            <p class="text-sm text-white/50 mt-1">Sponsor Terdaftar</p>
        </div>
        <div class="px-6">
            <p class="text-3xl font-black text-white">2.000+</p>
            <p class="text-sm text-white/50 mt-1">Volunteer Siap</p>
        </div>
    </div>
</section>


{{-- ========== KATEGORI EVENT ========== --}}
<section class="py-20 bg-[#f0f2f8]">
    <div class="max-w-6xl mx-auto px-6">
        <div class="mb-10">
            <p class="text-xs font-semibold tracking-widest uppercase text-[#4a6cf7] mb-3">Kategori Event</p>
            <h2 class="text-3xl font-black text-[#0f1e45]">Jelajahi Berdasarkan Minat</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            @foreach($kategori as $k)
            <a href="{{ auth()->check() ? route('explore.kategori', $k->id) : route('login') }}"
               class="group relative rounded-2xl overflow-hidden aspect-3/4">
                <img src="{{ $k->gambar ? Storage::url($k->gambar) : 'https://picsum.photos/300/400?random='.$k->id }}"
                class="w-full h-full object-cover ...">
                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                <div class="absolute inset-0 bg-[#0f1e45]/40 group-hover:bg-[#0f1e45]/60 transition"></div>
                <span class="absolute bottom-4 left-4 text-white font-bold text-sm">{{ $k->nama_kategori }}</span>
            </a>
            @endforeach
        </div>
    </div>
</section>


{{-- ========== LAYANAN ========== --}}
<section class="py-24 bg-white">
    <div class="max-w-6xl mx-auto px-6">
        <div class="mb-14">
            <p class="text-xs font-semibold tracking-widest uppercase text-[#4a6cf7] mb-3">Layanan Kami</p>
            <h2 class="text-4xl font-black text-[#0f1e45] max-w-lg leading-tight">
                Semua yang Kamu Butuhkan, di Satu Tempat
            </h2>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-[#f0f2f8] rounded-2xl p-8 hover:shadow-md transition group">
                <div class="w-11 h-11 bg-[#e4e8ff] rounded-xl flex items-center justify-center mb-6 group-hover:bg-[#4a6cf7] transition">
                    <svg class="w-5 h-5 text-[#4a6cf7] group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <h4 class="text-lg font-bold text-[#0f1e45] mb-2">Jadi Volunteer</h4>
                <p class="text-gray-500 text-sm leading-relaxed mb-6">Temukan kegiatan sosial yang sesuai minat dan jadwalmu.</p>
                <a href="{{ auth()->check() ? route('volunteer.index') : route('login') }}"
                   class="text-[#4a6cf7] text-sm font-semibold hover:underline">Cari Aktivitas →</a>
            </div>

            <div class="bg-[#0f1e45] rounded-2xl p-8 hover:shadow-md transition group">
                <div class="w-11 h-11 bg-white/10 rounded-xl flex items-center justify-center mb-6 group-hover:bg-[#4a6cf7] transition">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h4 class="text-lg font-bold text-white mb-2">Rekrut Volunteer</h4>
                <p class="text-gray-400 text-sm leading-relaxed mb-6">Pasang lowongan volunteer dan temukan relawan terbaik untuk eventmu.</p>
                <a href="{{ auth()->check() ? route('volunteer.index') : route('login') }}"
                   class="text-[#4a6cf7] text-sm font-semibold hover:underline">Lihat Relawan →</a>
            </div>

            <div class="bg-[#f0f2f8] rounded-2xl p-8 hover:shadow-md transition group">
                <div class="w-11 h-11 bg-[#e4e8ff] rounded-xl flex items-center justify-center mb-6 group-hover:bg-[#4a6cf7] transition">
                    <svg class="w-5 h-5 text-[#4a6cf7] group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h4 class="text-lg font-bold text-[#0f1e45] mb-2">Kerjasama CSR</h4>
                <p class="text-gray-500 text-sm leading-relaxed mb-6">Hubungkan eventmu dengan sponsor dan perusahaan yang relevan.</p>
                <a href="{{ auth()->check() ? route('explore.index') : route('login') }}"
                   class="text-[#4a6cf7] text-sm font-semibold hover:underline">Cari Sponsor →</a>
            </div>
        </div>
    </div>
</section>


{{-- ========== FITUR ========== --}}
<section class="py-24 bg-[#f0f2f8]">
    <div class="max-w-6xl mx-auto px-6">
        <div class="mb-14">
            <p class="text-xs font-semibold tracking-widest uppercase text-[#4a6cf7] mb-3">Fitur Platform</p>
            <h2 class="text-4xl font-black text-[#0f1e45] max-w-md leading-tight">
                Toolkit Lengkap untuk Event Sukses
            </h2>
        </div>
        <div class="grid md:grid-cols-2 gap-4">
            <div class="flex gap-5 items-start p-6 rounded-2xl bg-white border border-gray-100">
                <div class="w-10 h-10 bg-[#e4e8ff] rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-[#4a6cf7]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-[#0f1e45] mb-1">Manajemen Event</p>
                    <p class="text-gray-500 text-sm">Buat, edit, dan pantau event dari satu dashboard yang rapi.</p>
                </div>
            </div>
            <div class="flex gap-5 items-start p-6 rounded-2xl bg-white border border-gray-100">
                <div class="w-10 h-10 bg-[#e4e8ff] rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-[#4a6cf7]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-[#0f1e45] mb-1">Sponsorship Proposal</p>
                    <p class="text-gray-500 text-sm">Kirim dan kelola proposal sponsorship langsung ke perusahaan target.</p>
                </div>
            </div>
            <div class="flex gap-5 items-start p-6 rounded-2xl bg-white border border-gray-100">
                <div class="w-10 h-10 bg-[#e4e8ff] rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-[#4a6cf7]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-[#0f1e45] mb-1">Rekrutmen Volunteer</p>
                    <p class="text-gray-500 text-sm">Pasang posisi volunteer dan seleksi pendaftar dengan mudah.</p>
                </div>
            </div>
            <div class="flex gap-5 items-start p-6 rounded-2xl bg-white border border-gray-100">
                <div class="w-10 h-10 bg-[#e4e8ff] rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-[#4a6cf7]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-3 3v-3z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-[#0f1e45] mb-1">Komunikasi Terpusat</p>
                    <p class="text-gray-500 text-sm">Chat dan koordinasi antara organizer, sponsor, dan volunteer.</p>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ========== CTA BOTTOM ========== --}}
<section class="relative overflow-hidden" style="background: linear-gradient(135deg, #0f1e45 0%, #1a3a6e 50%, #2d4fa0 100%);">
    <div class="absolute inset-0 opacity-[0.06]"
         style="background-image: radial-gradient(circle, #ffffff 1px, transparent 1px); background-size: 28px 28px;"></div>
    <div class="relative max-w-xl mx-auto px-6 py-24 text-center">
        <h3 class="text-4xl font-black text-white mb-4 leading-tight">
            Siap Buat Event<br>yang Diingat?
        </h3>
        <p class="text-white/50 mb-10 text-sm leading-relaxed">
            Bergabung dengan ratusan organizer yang sudah menggunakan TemuAksi untuk mengelola event lebih profesional.
        </p>
        <div class="flex gap-3 justify-center flex-wrap">
            @auth
                <a href="{{ route('explore.index') }}"
                   class="bg-[#4a6cf7] text-white font-semibold px-8 py-3.5 rounded-xl hover:bg-[#3a5ce6] transition text-sm">
                    Jelajahi Event Sekarang
                </a>
            @else
                <a href="{{ route('register') }}"
                   class="bg-[#4a6cf7] text-white font-semibold px-8 py-3.5 rounded-xl hover:bg-[#3a5ce6] transition text-sm">
                    Daftar Sekarang — Gratis
                </a>
                <a href="{{ route('explore.index') }}"
                   class="border border-white/20 text-white font-semibold px-8 py-3.5 rounded-xl hover:bg-white/10 transition text-sm">
                    Jelajahi Event
                </a>
            @endauth
        </div>
    </div>
</section>

@endsection
