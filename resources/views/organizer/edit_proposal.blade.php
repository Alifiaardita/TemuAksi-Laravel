@extends('layouts.app')

@section('title', 'Edit Proposal')

@section('content')

@php
    $kategori = \App\Models\KategoriEvent::all();
@endphp

<section class="min-h-screen flex items-center justify-center px-4 py-10 bg-canvas">

    <div class="w-full max-w-2xl bg-white rounded-3xl shadow-lg p-8">

        <h2 class="text-2xl font-bold text-cornflower mb-6">
            ✏️ Edit Proposal
        </h2>

        <form method="POST" action="{{ route('proposal.update', $proposal->id) }}" class="space-y-4">
            @csrf

            <!-- JUDUL -->
            <div>
                <label class="text-sm font-semibold text-cornflower">Judul</label>
                <input type="text" name="judul"
                       value="{{ $proposal->judul }}"
                       class="w-full mt-1 px-4 py-2 border rounded-xl">
            </div>

            <!-- KATEGORI -->
            <div>
                <label class="text-sm font-semibold text-cornflower">Kategori</label>

                <select name="kategori"
                        class="w-full mt-1 px-4 py-2 border rounded-xl">

                    @foreach($kategori as $k)
                        <option value="{{ $k->nama_kategori }}"
                            {{ $proposal->kategori == $k->nama_kategori ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach

                </select>
            </div>

            <!-- DESKRIPSI -->
            <div>
                <label class="text-sm font-semibold text-cornflower">Deskripsi</label>
                <textarea name="deskripsi"
                          class="w-full mt-1 px-4 py-2 border rounded-xl">{{ $proposal->deskripsi }}</textarea>
            </div>

            <!-- LOKASI -->
            <div>
                <label class="text-sm font-semibold text-cornflower">Lokasi</label>
                <input type="text" name="lokasi"
                       value="{{ $proposal->lokasi }}"
                       class="w-full mt-1 px-4 py-2 border rounded-xl">
            </div>

            <!-- TANGGAL -->
            <div>
                <label class="text-sm font-semibold text-cornflower">Tanggal</label>
                <input type="date" name="tanggal"
                       value="{{ $proposal->tanggal?->format('Y-m-d') }}"
                       class="w-full mt-1 px-4 py-2 border rounded-xl">
            </div>

            <!-- TARGET DANA -->
            <div>
                <label class="text-sm font-semibold text-cornflower">Target Dana</label>
                <input type="number" name="target_dana"
                       value="{{ $proposal->target_dana }}"
                       class="w-full mt-1 px-4 py-2 border rounded-xl">
            </div>

            <!-- BUTTON -->
            <button class="w-full bg-cornflower text-white py-3 rounded-xl font-semibold">
                Update Proposal
            </button>

        </form>

    </div>

</section>

@endsection
