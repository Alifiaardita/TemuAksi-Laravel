@extends('layouts.app')
@section('content')

<!-- HERO -->
<section class="max-w-6xl mx-auto px-6 mt-6 mb-8">
    <div class="bg-cornflower rounded-3xl px-10 py-8 flex items-center justify-between relative overflow-hidden">
        <div class="absolute right-64 top-[-40px] w-64 h-64 bg-white/5 rounded-full"></div>
        <div class="absolute right-40 top-[-20px] w-48 h-48 bg-white/5 rounded-full"></div>

        {{-- Left: Text --}}
        <div class="relative z-10">
            <p class="text-white/60 text-sm font-medium uppercase tracking-widest mb-2">
                {{ strtoupper(now()->translatedFormat('l, d F Y')) }}
            </p>
            <h2 class="text-3xl font-bold text-white mb-2">
                Selamat Datang, {{ $user->companyProfile->nama_perusahaan ?? 'Perusahaan Anda' }} 👋
            </h2>
            <p class="text-white/70 text-sm leading-relaxed">
                Kelola sponsorship, tinjau proposal masuk,<br>
                dan pantau program volunteer perusahaan.
            </p>
        </div>

        {{-- Right: Buttons --}}
        <div class="flex items-center gap-3 relative z-10 shrink-0">
            <a href="{{ route('perusahaan.proposal.index') }}" 
            class="flex items-center gap-3 bg-white text-cornflower px-5 py-3 rounded-2xl font-semibold hover:bg-gray-50 transition shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Lihat Proposal
            </a>
            <a href="{{ route('volunteer.index') }}" 
            class="flex items-center gap-3 bg-white/10 text-white px-5 py-3 rounded-2xl font-semibold hover:bg-white/20 transition border border-white/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Buka Volunteer
            </a>
        </div>
    </div>
</section>

<!-- RINGKASAN AKTIVITAS -->
<section class="max-w-6xl mx-auto px-6 mb-8">
    <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-4">Ringkasan Aktivitas</p>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

        {{-- Proposal Masuk --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <p class="text-sm text-gray-500">Proposal Masuk</p>
                <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h7l5 5v11a2 2 0 01-2 2z"/>
                    </svg>
                </div>
            </div>
            <p class="text-4xl font-bold text-gray-900">{{ $totalProposal ?? 0 }}</p>
            <p class="text-xs text-green-500 mt-1">+{{ $proposalMingguIni ?? 0 }} minggu ini</p>
        </div>

        {{-- Menunggu Review --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <p class="text-sm text-gray-500">Menunggu Review</p>
                <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-4xl font-bold text-gray-900">{{ $proposalMenunggu ?? 0 }}</p>
            <p class="text-xs text-amber-500 mt-1 font-medium">Perlu ditindaklanjuti</p>
        </div>

        {{-- Total Disalurkan --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <p class="text-sm text-gray-500">Total Disalurkan</p>
                <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-4xl font-bold text-gray-900">
                {{ $totalDisalurkan >= 1000000 ? number_format($totalDisalurkan / 1000000, 0, ',', '.') . 'M' : number_format($totalDisalurkan ?? 0, 0, ',', '.') }}
            </p>
            <p class="text-xs text-gray-400 mt-1">Rp sepanjang {{ now()->year }}</p>
        </div>

        {{-- Volunteer Aktif --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <p class="text-sm text-gray-500">Volunteer Aktif</p>
                <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
            </div>
            <p class="text-4xl font-bold text-gray-900">{{ $volunteerAktif ?? 0 }}</p>
            <p class="text-xs text-gray-400 mt-1">dari <span class="font-semibold text-gray-600">{{ $programBerjalan ?? 0 }} program</span> berjalan</p>
        </div>

    </div>
</section>

<!-- PROPOSAL TERBARU + AKSI CEPAT -->
<section class="max-w-6xl mx-auto px-6 mb-10 grid md:grid-cols-2 gap-6">

    {{-- Proposal Terbaru --}}
    <div class="bg-white rounded-2xl shadow-sm p-6">
        <div class="flex items-center justify-between mb-5">
            <h3 class="text-lg font-bold text-gray-900">Proposal Terbaru</h3>
            <a href="{{ route('perusahaan.proposal.index') }}" class="text-sm text-cornflower hover:underline">Lihat semua →</a>
        </div>

        <div class="space-y-4">
            @forelse($proposalTerbaru ?? [] as $proposal)
            <div class="flex items-center justify-between gap-3">
                <div class="w-9 h-9 bg-gray-100 rounded-xl flex-shrink-0 flex items-center justify-center">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h7l5 5v11a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-800 truncate">{{ $proposal->judul }}</p>
                    <p class="text-xs text-gray-400 truncate">{{ $proposal->sponsor->nama ?? '-' }} · Rp {{ number_format($proposal->target_dana, 0, ',', '.') }}</p>
                </div>
                @php
                    $status = $proposal->status;
                    $badge = match($status) {
                        'pendanaan' => 'bg-green-100 text-green-600',
                        'selesai'   => 'bg-blue-100 text-blue-600',
                        'ditolak'   => 'bg-gray-100 text-gray-500',
                        default     => 'bg-amber-100 text-amber-600', // terkirim
                    };
                    $label = match($status) {
                        'pendanaan' => 'Didanai',
                        'selesai'   => 'Selesai',
                        'ditolak'   => 'Ditolak',
                        default     => 'Menunggu',
                    };
                @endphp
                <span class="text-xs font-medium px-3 py-1 rounded-full flex-shrink-0 {{ $badge }}">
                    {{ $label }}
                </span>
            </div>
            @empty
            <p class="text-sm text-gray-400 text-center py-6">Belum ada proposal masuk.</p>
            @endforelse
        </div>
    </div>

    {{-- Aksi Cepat --}}
    <div class="bg-white rounded-2xl shadow-sm p-6">
    <h3 class="text-lg font-bold text-gray-900 mb-5">Aksi Cepat</h3>
        <div class="grid grid-cols-2 gap-4">

            <!-- Buat Open Volunteer -->
            <a href="{{ route('volunteer.index') }}"
                class="flex items-start gap-3 p-4 rounded-xl hover:bg-gray-50 transition group">
                <div class="w-10 h-10 bg-cornflower rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-800 group-hover:text-cornflower transition">Buat Open Volunteer</p>
                    <p class="text-xs text-gray-400 mt-0.5">Buka lowongan volunteer baru</p>
                </div>
            </a>

            <!-- Laporan Impact -->
            <a href="#"
                class="flex items-start gap-3 p-4 rounded-xl hover:bg-gray-50 transition group">
                <div class="w-10 h-10 bg-cornflower rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-800 group-hover:text-cornflower transition">Laporan Impact</p>
                    <p class="text-xs text-gray-400 mt-0.5">Pantau dampak event yang didanai</p>
                </div>
            </a>

            <!-- Export Laporan -->
            <a href="#"
                class="flex items-start gap-3 p-4 rounded-xl hover:bg-gray-50 transition group">
                <div class="w-10 h-10 bg-cornflower rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-800 group-hover:text-cornflower transition">Export Laporan</p>
                    <p class="text-xs text-gray-400 mt-0.5">Unduh rekap pendanaan PDF/Excel</p>
                </div>
            </a>

            <!-- Edit Profil -->
            <a href="#"
                class="flex items-start gap-3 p-4 rounded-xl hover:bg-gray-50 transition group">
                <div class="w-10 h-10 bg-cornflower rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-800 group-hover:text-cornflower transition">Edit Profil</p>
                    <p class="text-xs text-gray-400 mt-0.5">Perbarui profil perusahaan</p>
                </div>
            </a>

        </div>
    </div>

</section>

<!-- PROGRAM VOLUNTEER AKTIF + TIPS -->
<section class="max-w-6xl mx-auto px-6 mb-20">
    <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-4">Program Volunteer Aktif</p>

    {{-- Grid Volunteer --}}
    <div class="grid md:grid-cols-2 gap-4 mb-4">
        @forelse($volunteerAktifList ?? [] as $kegiatan)
        @php
            $pendaftar = $kegiatan->volunteer_pendaftaran_count ?? 0;
            $kuota     = $kegiatan->kuota ?? 1;
            $persen    = $kuota > 0 ? min(100, round(($pendaftar / $kuota) * 100)) : 0;
        @endphp
        <div class="bg-white rounded-2xl p-5 shadow-sm">
            <div class="flex items-start justify-between gap-3 mb-4">
                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 bg-gray-100 rounded-xl flex-shrink-0 flex items-center justify-center">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-800">{{ $kegiatan->judul }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">Deadline: {{ \Carbon\Carbon::parse($kegiatan->tanggal_selesai)->translatedFormat('d F Y') }}</p>
                    </div>
                </div>
                <span class="text-xs font-semibold px-3 py-1 rounded-full bg-green-100 text-green-600 flex-shrink-0">Aktif</span>
            </div>

            {{-- Progress Bar --}}
            <div class="w-full bg-gray-100 rounded-full h-2 mb-2">
                <div class="bg-cornflower h-2 rounded-full transition-all duration-500"
                     style="width: {{ $persen }}%"></div>
            </div>
            <div class="flex items-center justify-between">
                <p class="text-xs text-cornflower font-medium">{{ $pendaftar }} / {{ $kuota }} pendaftar</p>
                <p class="text-sm font-bold text-gray-800">{{ $persen }}%</p>
            </div>
        </div>
        @empty
        <div class="md:col-span-2 bg-white rounded-2xl p-6 shadow-sm text-center text-sm text-gray-400">
            Belum ada program volunteer aktif.
        </div>
        @endforelse
    </div>

    {{-- Tips --}}
    <div class="bg-white rounded-2xl p-5 shadow-sm flex items-start gap-4">
        <div class="w-10 h-10 bg-blue-50 rounded-xl flex-shrink-0 flex items-center justify-center">
            <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20A10 10 0 0012 2z"/>
            </svg>
        </div>
        <div>
            <p class="text-sm font-bold text-gray-800 mb-1">Tips untuk Perusahaan</p>
            <p class="text-sm text-gray-400 leading-relaxed">
                Buat profil perusahaan yang profesional dan jelaskan benefit sponsor secara detail
                agar proposal yang masuk lebih berkualitas dan relevan dengan program CSR Anda.
            </p>
        </div>
    </div>
</section>

@endsection