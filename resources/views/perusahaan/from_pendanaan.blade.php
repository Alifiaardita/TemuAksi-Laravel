@extends('layouts.app')

@section('title', 'Form Pendanaan')

@section('content')
<div class="bg-canvas flex justify-center items-center min-h-screen">
    <div class="bg-white p-8 rounded-xl shadow w-96">
        <h2 class="text-xl font-bold mb-2">💰 Form Pendanaan</h2>
        <p class="text-gray-500 text-sm mb-4">
            Proposal: <span class="font-semibold text-cornflower">{{ $proposal->judul }}</span>
        </p>

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-800 rounded-xl px-4 py-3 text-sm mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('perusahaan.pendanaan.store', $proposal->id) }}" class="space-y-4">
            @csrf
            <input type="number" name="jumlah" placeholder="Masukkan jumlah dana"
                class="w-full border p-2 rounded" required min="1">
            <button class="bg-cornflower text-white w-full py-2 rounded">
                Kirim Dana
            </button>
        </form>
    </div>
</div>
@endsection