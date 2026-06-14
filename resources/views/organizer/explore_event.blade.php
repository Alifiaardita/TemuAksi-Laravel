@extends('layouts.app')
@section('title', 'Explore Event')
@section('content')
@php
    $kategori = \App\Models\KategoriEvent::orderBy('nama_kategori')->get();

    $categoryIcons = [
        'default'    => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>',
        'sosial'     => '<path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>',
        'pendidikan' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>',
        'lingkungan' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
        'kesehatan'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>',
        'seni'       => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>',
        'teknologi'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/>',
        'olahraga'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M16 8v8m-8-5v5m4-9v9M3 12a9 9 0 1118 0 9 9 0 01-18 0z"/>',
    ];

    $categoryColors = [
        'default'    => ['bg' => 'bg-blue-50',   'icon' => 'text-blue-500'],
        'sosial'     => ['bg' => 'bg-rose-50',    'icon' => 'text-rose-500'],
        'pendidikan' => ['bg' => 'bg-amber-50',   'icon' => 'text-amber-500'],
        'lingkungan' => ['bg' => 'bg-green-50',   'icon' => 'text-green-500'],
        'kesehatan'  => ['bg' => 'bg-pink-50',    'icon' => 'text-pink-500'],
        'seni'       => ['bg' => 'bg-purple-50',  'icon' => 'text-purple-500'],
        'teknologi'  => ['bg' => 'bg-sky-50',     'icon' => 'text-sky-500'],
        'olahraga'   => ['bg' => 'bg-orange-50',  'icon' => 'text-orange-500'],
    ];
@endphp

<section class="max-w-7xl mx-auto px-6 py-10">

    {{-- Header --}}
    <div class="mb-10">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 rounded-xl bg-cornflower flex items-center justify-center shadow-md">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">Explore Event</h1>
        </div>
        <p class="text-gray-500 ml-13">Pilih kategori untuk menemukan kegiatan yang sesuai minatmu.</p>
    </div>

    {{-- Grid --}}
    <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-5">
        @foreach ($kategori as $row)
            @php
                $key     = strtolower($row->nama_kategori);
                $matched = collect(array_keys($categoryColors))->first(fn($k) => str_contains($key, $k), 'default');
                $color   = $categoryColors[$matched];
                $icon    = $categoryIcons[$matched] ?? $categoryIcons['default'];
            @endphp

            <a href="{{ route('explore.kategori', $row->id) }}" class="group block">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 overflow-hidden">

                    {{-- Image --}}
                    <div class="relative h-40 overflow-hidden">
                        <img src="{{ $row->gambar ? Storage::url($row->gambar) : 'https://picsum.photos/400/300?random='.$row->id }}"
                            class="w-full h-full object-cover ...">
                        <div class="absolute inset-0 bg-linear-to-t from-black/40 to-transparent"></div>

                        {{-- Badge overlay --}}
                        <div class="absolute bottom-3 left-3">
                            <span class="inline-flex items-center gap-1.5 bg-white/90 backdrop-blur-sm text-gray-700 text-xs font-medium px-2.5 py-1 rounded-full">
                                <svg class="w-3.5 h-3.5 {{ $color['icon'] }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    {!! $icon !!}
                                </svg>
                                {{ $row->nama_kategori }}
                            </span>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="p-5">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl {{ $color['bg'] }} flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4 {{ $color['icon'] }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        {!! $icon !!}
                                    </svg>
                                </div>
                                <h3 class="font-semibold text-gray-800 text-sm">{{ $row->nama_kategori }}</h3>
                            </div>
                            <div class="w-7 h-7 rounded-full bg-gray-100 group-hover:bg-cornflower flex items-center justify-center transition-colors duration-200">
                                <svg class="w-3.5 h-3.5 text-gray-400 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                </div>
            </a>
        @endforeach
    </div>

</section>
@endsection
