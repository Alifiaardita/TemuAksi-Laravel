@extends('layouts.app')

@section('content')
<section class="max-w-6xl mx-auto px-6 py-8">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-bold text-gray-900">Program volunteer</h1>
            <p class="text-sm text-gray-400 mt-1">Daftar program volunteer yang dibuka perusahaan</p>
        </div>
        <a href="{{ route('perusahaan.volunteer.create') }}"
           class="inline-flex items-center gap-2 bg-cornflower text-white text-sm font-semibold px-4 py-2 rounded-xl hover:opacity-90">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Buka program baru
        </a>
    </div>

    {{-- Filter --}}
    <div class="bg-white rounded-2xl shadow-sm p-4 mb-6">
        <form method="GET" action="{{ route('perusahaan.volunteer.index') }}"
              class="flex flex-wrap gap-3">
            <div class="relative flex-[2] min-w-[220px]">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35"/>
                </svg>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari nama program volunteer"
                       class="w-full pl-10 pr-3 py-2 text-sm border border-gray-100 bg-gray-50 rounded-xl focus:outline-none focus:ring-2 focus:ring-cornflower">
            </div>

            <select name="kategori"
                    class="flex-1 min-w-[160px] text-sm border border-gray-100 bg-gray-50 rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cornflower">
                <option value="">Semua kategori</option>
                @foreach($kategoriList as $kat)
                    <option value="{{ $kat->id }}" {{ request('kategori') == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama_kategori }}
                    </option>
                @endforeach
            </select>

            <select name="status"
                    class="flex-1 min-w-[160px] text-sm border border-gray-100 bg-gray-50 rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cornflower">
                <option value="">Semua status</option>
                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="tidak_aktif" {{ request('status') == 'tidak_aktif' ? 'selected' : '' }}>Tidak aktif</option>
            </select>

            <button type="submit"
                    class="text-sm font-semibold px-4 py-2 bg-cornflower text-white rounded-xl hover:opacity-90">
                Terapkan
            </button>

            @if(request('search') || request('kategori') || request('status'))
                <a href="{{ route('perusahaan.volunteer.index') }}"
                   class="text-sm font-medium px-4 py-2 text-gray-400 hover:text-gray-600 self-center">
                    Reset
                </a>
            @endif
        </form>
    </div>

    {{-- Tabel --}}
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 text-left text-xs font-semibold text-gray-400 uppercase tracking-wide">
                        <th class="px-6 py-3">Nama volunteer</th>
                        <th class="px-6 py-3">Kategori</th>
                        <th class="px-6 py-3">Kuota</th>
                        <th class="px-6 py-3">Tanggal mulai</th>
                        <th class="px-6 py-3">Deadline daftar</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($volunteerList as $kegiatan)
                        @php
                            $pendaftar = $kegiatan->pendaftaran_count ?? 0;
                            $kuota = $kegiatan->kuota ?? 0;
                            $isAktif = $kegiatan->status === 'aktif';
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-semibold text-gray-800">{{ $kegiatan->judul }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $kegiatan->kategori->nama_kategori ?? '-' }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $pendaftar }} / {{ $kuota }}</td>
                            <td class="px-6 py-4 text-gray-500">
                                {{ $kegiatan->tanggal_mulai ? \Carbon\Carbon::parse($kegiatan->tanggal_mulai)->translatedFormat('d M Y') : '-' }}
                            </td>
                            <td class="px-6 py-4 text-gray-500">
                                {{ $kegiatan->deadline_daftar ? \Carbon\Carbon::parse($kegiatan->deadline_daftar)->translatedFormat('d M Y') : '-' }}
                            </td>
                            <td class="px-6 py-4">
                                @if($isAktif)
                                    <span class="text-xs font-semibold px-3 py-1 rounded-full bg-green-100 text-green-600">Aktif</span>
                                @else
                                    <span class="text-xs font-semibold px-3 py-1 rounded-full bg-gray-100 text-gray-500">Tidak aktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('perusahaan.volunteer.peserta', $kegiatan->id) }}"
                                   class="text-cornflower hover:underline font-medium text-sm">
                                    Lihat peserta
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-gray-400">
                                <p class="text-sm">Belum ada program volunteer.</p>
                                <p class="text-xs mt-1">Coba ubah kata kunci atau filter, atau buka program baru.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $volunteerList->links() }}
    </div>

</section>
@endsection