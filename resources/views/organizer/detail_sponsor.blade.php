@extends('layouts.app')

@section('title', $sponsor->nama)

@section('content')

<section class="py-16 px-6">

<div class="max-w-4xl mx-auto">

    <div class="text-center mb-10">
        <h1 class="text-5xl font-bold mb-4">
            {{ $sponsor->nama }}
        </h1>

        <p class="text-gray-600">
            {{ $sponsor->deskripsi }}
        </p>
    </div>

    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

        <div class="bg-cornflower text-white p-10">

            <h2 class="text-2xl mb-6">Range Sponsorship</h2>

            <div class="grid sm:grid-cols-2 gap-4">

                <div class="bg-white/20 p-6 rounded-3xl text-center">
                    <p>Minimum</p>
                    <p class="text-2xl font-bold">
                        Rp {{ number_format($sponsor->min_dana,0,',','.') }}
                    </p>
                </div>

                <div class="bg-white/20 p-6 rounded-3xl text-center">
                    <p>Maksimum</p>
                    <p class="text-2xl font-bold">
                        Rp {{ number_format($sponsor->max_dana,0,',','.') }}
                    </p>
                </div>

            </div>

        </div>

        <div class="p-10 space-y-6">

            <p><b>Industri:</b> {{ $sponsor->industri }}</p>
            <p><b>Lokasi:</b> {{ $sponsor->lokasi }}</p>

            <div class="text-center pt-6">

                <a href="{{ route('proposal.create', $sponsor->id) }}"
                   class="bg-cornflower text-white px-6 py-3 rounded-xl">
                    Ajukan Proposal
                </a>

            </div>

        </div>

    </div>

</div>

</section>

@endsection
