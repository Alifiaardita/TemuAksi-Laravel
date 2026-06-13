@extends('layouts.app')

@section('title', 'Peserta Volunteer')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-10">

    {{-- HEADER --}}
    <div class="mb-8 flex items-center gap-3">
        <a href="{{ route('perusahaan.dashboard') }}" class="text-gray-400 hover:text-gray-600 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Peserta Volunteer</h1>
            <p class="text-sm text-gray-500 mt-0.5">{{ $kegiatan->judul }}</p>
        </div>
    </div>

    <div class="flex flex-col gap-6">

        {{-- CARD 1: INFORMASI KEGIATAN --}}
        <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
            @if($kegiatan->gambar_url)
            <img src="{{ Storage::url($kegiatan->gambar_url) }}" class="w-full h-48 object-cover">
            @endif
            <div class="p-6">
                <p class="text-xs font-medium text-gray-400 uppercase tracking-widest mb-4">Informasi kegiatan</p>
                <div class="grid grid-cols-2 gap-4 sm:grid-cols-3">
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Status</p>
                        <span class="inline-block px-2.5 py-1 rounded-full text-xs font-medium
                            {{ $kegiatan->status === 'aktif' ? 'bg-green-100 text-green-700' :
                               ($kegiatan->status === 'penuh' ? 'bg-yellow-100 text-yellow-700' :
                               ($kegiatan->status === 'selesai' ? 'bg-blue-100 text-blue-700' : 'bg-red-100 text-red-700')) }}">
                            {{ ucfirst($kegiatan->status) }}
                        </span>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Tanggal</p>
                        <p class="text-sm text-gray-700">
                            {{ $kegiatan->tanggal_mulai?->format('d M Y') }}
                            @if($kegiatan->tanggal_selesai)
                                — {{ $kegiatan->tanggal_selesai->format('d M Y') }}
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Lokasi</p>
                        <p class="text-sm text-gray-700">{{ $kegiatan->lokasi ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Kuota</p>
                        <p class="text-sm text-gray-700">{{ $kegiatan->kuota ?? 'Tidak terbatas' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Deadline daftar</p>
                        <p class="text-sm text-gray-700">{{ $kegiatan->deadline_daftar?->format('d M Y') ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Divisi dibuka</p>
                        <p class="text-sm text-gray-700">{{ $kegiatan->divisi ?? '-' }}</p>
                    </div>
                    @if($kegiatan->jam_mulai || $kegiatan->jam_selesai)
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Jam</p>
                        <p class="text-sm text-gray-700">{{ $kegiatan->jam_mulai ?? '-' }} — {{ $kegiatan->jam_selesai ?? '-' }}</p>
                    </div>
                    @endif
                    @if($kegiatan->kontak)
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Kontak</p>
                        <p class="text-sm text-gray-700">{{ $kegiatan->kontak }}</p>
                    </div>
                    @endif
                    @if($kegiatan->guidebook)
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Guidebook</p>
                        <a href="{{ Storage::url($kegiatan->guidebook) }}" target="_blank"
                            class="text-sm text-cornflower hover:underline">Unduh guidebook</a>
                    </div>
                    @endif
                </div>
                @if($kegiatan->deskripsi)
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <p class="text-xs text-gray-400 mb-1">Deskripsi</p>
                    <p class="text-sm text-gray-700 leading-relaxed">{{ $kegiatan->deskripsi }}</p>
                </div>
                @endif
            </div>
        </div>

        {{-- CARD 2: SEARCH & FILTER --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-widest mb-4">Cari & filter</p>
            <form method="GET" action="{{ route('perusahaan.volunteer.peserta', $kegiatan->id) }}"
                class="flex flex-col sm:flex-row gap-3">
                <input type="text" name="q" value="{{ request('q') }}"
                    placeholder="Cari nama atau email..."
                    class="flex-1 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30">
                <select name="status"
                    class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30">
                    <option value="">Semua status</option>
                    <option value="menunggu" {{ request('status') === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="diterima" {{ request('status') === 'diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="ditolak" {{ request('status') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                <button type="submit"
                    class="px-5 py-2.5 text-sm font-medium bg-cornflower text-white rounded-xl hover:opacity-90 transition">
                    Cari
                </button>
                @if(request()->hasAny(['q', 'status']))
                <a href="{{ route('perusahaan.volunteer.peserta', $kegiatan->id) }}"
                    class="px-5 py-2.5 text-sm text-gray-500 border border-gray-200 rounded-xl hover:bg-gray-50 transition text-center">
                    Reset
                </a>
                @endif
            </form>
        </div>

        {{-- CARD 3: DAFTAR PESERTA --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <div class="flex items-center justify-between mb-4">
                <p class="text-xs font-medium text-gray-400 uppercase tracking-widest">
                    Daftar peserta
                </p>
                <span class="text-xs text-gray-400">{{ $pesertaList->count() }} peserta</span>
            </div>

            @if($pesertaList->isEmpty())
            <div class="text-center py-12">
                <svg class="w-10 h-10 text-gray-200 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <p class="text-sm text-gray-400">Belum ada peserta yang mendaftar</p>
            </div>
            @else
            <div class="flex flex-col gap-3">
                @foreach($pesertaList as $peserta)
                <div class="flex items-center justify-between p-4 border border-gray-100 rounded-xl hover:bg-gray-50 transition">
                    <div class="flex items-center gap-4">
                        <div class="w-9 h-9 rounded-full bg-cornflower/10 flex items-center justify-center text-cornflower font-semibold text-sm">
                            {{ strtoupper(substr($peserta->nama_lengkap, 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-800">{{ $peserta->nama_lengkap }}</p>
                            <p class="text-xs text-gray-400">{{ $peserta->email ?? $peserta->no_telepon }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs px-2.5 py-1 rounded-full font-medium
                            {{ $peserta->status === 'diterima' ? 'bg-green-100 text-green-700' :
                               ($peserta->status === 'menunggu' ? 'bg-yellow-100 text-yellow-700' :
                               ($peserta->status === 'selesai' ? 'bg-blue-100 text-blue-700' : 'bg-red-100 text-red-700')) }}">
                            {{ ucfirst($peserta->status) }}
                        </span>
                        <span class="text-xs text-gray-400">{{ $peserta->created_at->format('d M Y') }}</span>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>

    </div>
</div>
@endsection