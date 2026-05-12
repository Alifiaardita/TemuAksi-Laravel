@extends('layouts.app')

@section('title', 'Kategori Sponsor')

@section('content')

<main class="max-w-7xl mx-auto px-6 py-8">

    <h1 class="text-3xl font-bold mb-6">
        Sponsor Kategori: {{ $kategori->nama_kategori ?? '' }}
    </h1>

    <div class="grid md:grid-cols-3 gap-6">

        @forelse ($sponsors as $s)

            <div class="bg-white p-4 rounded-2xl shadow hover:shadow-lg transition">

                <h3 class="font-bold text-lg">
                    {{ $s->nama }}
                </h3>

                <p class="text-gray-600">
                    {{ $s->industri }}
                </p>

                <p class="text-gray-500 text-sm mt-2">
                    {{ $s->deskripsi }}
                </p>

                <a href="{{ route('explore.sponsor', $s->id) }}"
                   class="bg-cornflower text-white px-4 py-2 rounded-xl block mt-4 text-center hover:opacity-90">
                    Selengkapnya
                </a>

            </div>

        @empty

            <p class="text-gray-500 col-span-3 text-center">
                Tidak ada sponsor di kategori ini.
            </p>

        @endforelse

    </div>

</main>

@endsection
