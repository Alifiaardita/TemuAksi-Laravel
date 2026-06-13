@extends('layouts.app')
@section('title', 'Laporan Pengeluaran Sponsorship')
@section('content')

<div class="min-h-screen bg-canvas p-6 md:p-10">
    <div class="max-w-3xl mx-auto space-y-5">
        {{-- Header --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="h-1.5 bg-gradient-to-r from-cornflower via-cornflower/70 to-cornflower/30"></div>
            <div class="p-6 md:p-8">
                <div class="flex items-start justify-between gap-4 flex-wrap">
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Laporan pengeluaran sponsorship</p>
                        <h1 class="text-xl font-bold text-gray-900">{{ auth()->user()->nama_perusahaan }}</h1>
                        <p class="text-sm text-gray-400 mt-1">
                            Periode:
                            @if($periodeAwal && $periodeAkhir)
                                {{ \Carbon\Carbon::parse($periodeAwal)->translatedFormat('F Y') }} —
                                {{ \Carbon\Carbon::parse($periodeAkhir)->translatedFormat('F Y') }}
                            @else
                                Semua waktu
                            @endif
                        </p>
                    </div>
                    <div class="text-right shrink-0">
                        <p class="text-xs text-gray-400 mb-0.5">Total dikeluarkan</p>
                        <p class="text-2xl font-bold text-cornflower">
                            Rp {{ number_format($totalDana, 0, ',', '.') }}
                        </p>
                        <p class="text-xs text-gray-400 mt-0.5">dari {{ $totalAcara }} acara yang didanai</p>
                    </div>
                </div>

                {{-- Filter periode --}}
                <form method="GET" action="{{ route('perusahaan.laporan-pengeluaran.index') }}"
                    class="flex items-center gap-2 mt-5 pt-5 border-t border-gray-100">
                    <label class="text-xs text-gray-500 shrink-0">Periode</label>
                    <input type="month" name="dari" value="{{ request('dari') }}"
                        class="px-3 py-1.5 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-cornflower/30 focus:border-cornflower transition">
                    <span class="text-gray-300 text-xs">—</span>
                    <input type="month" name="sampai" value="{{ request('sampai') }}"
                        class="px-3 py-1.5 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-cornflower/30 focus:border-cornflower transition">
                    <button type="submit"
                        class="px-3.5 py-1.5 bg-cornflower text-white text-xs rounded-xl hover:bg-cornflower/90 transition">
                        Terapkan
                    </button>
                    @if(request('dari') || request('sampai'))
                    <a href="{{ route('perusahaan.laporan-pengeluaran.index') }}"
                        class="px-3 py-1.5 border border-gray-200 text-xs text-gray-500 rounded-xl hover:bg-gray-50 transition">
                        Reset
                    </a>
                    @endif
                </form>
            </div>
        </div>

        {{-- Stat Cards --}}
        <div class="grid grid-cols-3 gap-3">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex flex-col gap-3">
                <div class="w-8 h-8 rounded-xl bg-cornflower/8 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-cornflower" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900 leading-none">{{ $totalAcara }}</p>
                    <p class="text-xs text-gray-400 mt-1">acara didanai</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex flex-col gap-3">
                <div class="w-8 h-8 rounded-xl bg-green-50 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900 leading-none">{{ $acaraSelesai }}</p>
                    <p class="text-xs text-gray-400 mt-1">sudah selesai</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex flex-col gap-3">
                <div class="w-8 h-8 rounded-xl bg-amber-50 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-amber-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900 leading-none">{{ $acaraBerlangsung }}</p>
                    <p class="text-xs text-gray-400 mt-1">sedang berjalan</p>
                </div>
            </div>
        </div>

        {{-- Realisasi per Program --}}
        @if($perProgram->isNotEmpty())
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 md:p-8">
            <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wide flex items-center gap-2 mb-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"/>
                </svg>
                Realisasi anggaran per program
            </h2>

            <div class="space-y-4">
                @foreach($perProgram as $program)
                @php
                    $persen = $totalDana > 0 ? round(($program->total / $totalDana) * 100) : 0;
                @endphp
                <div>
                    <div class="flex justify-between items-baseline mb-1.5">
                        <span class="text-sm text-gray-700 truncate max-w-xs">{{ $program->nama_program }}</span>
                        <span class="text-sm font-semibold text-gray-900 shrink-0 ml-4">
                            Rp {{ number_format($program->total, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-cornflower rounded-full transition-all duration-500"
                            style="width: {{ $persen }}%"></div>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">{{ $persen }}% dari total · {{ $program->jumlah_acara }} acara</p>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Rincian Per Acara --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 md:p-8">
            <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wide flex items-center gap-2 mb-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
                </svg>
                Rincian per acara
            </h2>

            @if($riwayat->isEmpty())
            <div class="text-center py-10 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto mb-2 opacity-40" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                </svg>
                <p class="text-sm">Belum ada pengeluaran sponsorship</p>
            </div>
            @else
            <div class="divide-y divide-gray-100">
                @foreach($riwayat as $item)
                <div class="flex items-center gap-4 py-3.5 first:pt-0 last:pb-0">

                    {{-- Nomor urut --}}
                    <span class="text-xs text-gray-300 font-mono w-5 text-right shrink-0">{{ $loop->iteration }}</span>

                    {{-- Info acara --}}
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ $item->proposal->judul }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">
                            {{ $item->proposal->lokasi ?? '—' }} ·
                            {{ \Carbon\Carbon::parse($item->proposal->tanggal)->translatedFormat('d M Y') }}
                        </p>
                    </div>

                    {{-- Program --}}
                    <span class="text-xs text-gray-400 hidden md:block max-w-[140px] truncate">
                        {{ $item->proposal->sponsor->nama ?? '—' }}
                    </span>

                    {{-- Status --}}
                    @php
                        $tgl = \Carbon\Carbon::parse($item->proposal->tanggal);
                        $isSelesai = $tgl->isPast();
                    @endphp
                    @if($isSelesai)
                    <span class="text-xs font-medium px-2.5 py-1 rounded-full bg-green-50 text-green-700 border border-green-100 shrink-0">
                        Selesai
                    </span>
                    @else
                    <span class="text-xs font-medium px-2.5 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-100 shrink-0">
                        Berlangsung
                    </span>
                    @endif

                    {{-- Dana --}}
                    <p class="text-sm font-semibold text-gray-900 shrink-0 text-right min-w-[110px]">
                        Rp {{ number_format($item->jumlah_dana, 0, ',', '.') }}
                    </p>

                </div>
                @endforeach
            </div>

            {{-- Total baris --}}
            <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-100">
                <span class="text-sm text-gray-500">Total pengeluaran</span>
                <span class="text-base font-bold text-cornflower">
                    Rp {{ number_format($totalDana, 0, ',', '.') }}
                </span>
            </div>
            @endif
        </div>

        <p class="text-center text-xs text-gray-400 pb-4">
            Data diperbarui otomatis · Terakhir sync {{ now()->translatedFormat('d F Y, H:i') }} WIB
        </p>

    </div>
</div>

@endsection