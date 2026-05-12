@extends('layouts.app')

@section('title', 'Explore Event')

@section('content')

@php
    $kategori = \App\Models\KategoriEvent::orderBy('nama_kategori')->get();
@endphp

<section class="max-w-7xl mx-auto px-6 py-10">

    <h1 class="text-3xl font-bold mb-8 text-center">
        Pilih Kategori Event
    </h1>

    <div class="grid md:grid-cols-3 gap-6">

        @foreach ($kategori as $row)
            <a href="{{ route('explore.kategori', $row->id) }}">
                <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">

                    <img src="https://picsum.photos/400/300?random={{ $row->id }}"
                         class="w-full h-40 object-cover">

                    <div class="p-4 text-center">
                        <h3 class="font-bold text-lg">
                            {{ $row->nama_kategori }}
                        </h3>
                    </div>

                </div>
            </a>
        @endforeach

    </div>

</section>

@endsection
