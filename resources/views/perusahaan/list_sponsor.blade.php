@extends('layouts.app')
@section('content')

<section class="max-w-6xl mx-auto px-6 mt-6 mb-20">

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-bold text-gray-900">Program Sponsor</h2>
        <a href="{{ route('perusahaan.sponsor.create') }}"
           class="bg-cornflower text-white px-4 py-2 rounded-xl text-sm font-semibold hover:opacity-90 transition">
            + Buka Sponsor Baru
        </a>
    </div>

    <div class="grid md:grid-cols-2 gap-4 mb-6">
        @forelse($sponsorList as $sponsor)
        <div class="bg-white rounded-2xl p-5 shadow-sm">
            <div class="flex items-start justify-between gap-3 mb-4">
                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 bg-gray-100 rounded-xl flex-shrink-0 flex items-center justify-center">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-800">{{ $sponsor->nama }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $sponsor->kategori->nama_kategori ?? '-' }} · {{ $sponsor->lokasi ?? 'Semua lokasi' }}</p>
                    </div>
                </div>
                <span class="text-xs font-semibold px-3 py-1 rounded-full bg-blue-100 text-blue-600 flex-shrink-0">Aktif</span>
            </div>

            <div class="flex items-center justify-between mb-3">
                <p class="text-xs text-gray-400">Dana yang dapat diajukan</p>
                <p class="text-sm font-bold text-gray-800">
                    Rp {{ number_format($sponsor->min_dana, 0, ',', '.') }} – {{ number_format($sponsor->max_dana, 0, ',', '.') }}
                </p>
            </div>

            <div class="pt-3 border-t border-gray-100 flex items-center justify-between">
                <a href="{{ route('perusahaan.sponsor.edit', $sponsor->id) }}" class="text-xs text-cornflower hover:underline font-medium">
                    Edit detail
                </a>
            </div>
        </div>
        @empty
        <div class="md:col-span-2 bg-white rounded-2xl p-6 shadow-sm text-center text-sm text-gray-400">
            Belum ada program sponsor.
        </div>
        @endforelse
    </div>

    {{ $sponsorList->links() }}

</section>

@endsection