@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-8">

<h1 class="text-3xl font-bold mb-6">
Selamat Datang, {{ auth()->user()->nama }}
</h1>

<div class="grid grid-cols-3 gap-6 mb-8">

<div class="bg-blue-500 text-white p-6 rounded-xl">
<h2 class="text-xl">Sponsor Tersedia</h2>
<p class="text-3xl font-bold">{{ $totalSponsor }}</p>
</div>

<div class="bg-green-500 text-white p-6 rounded-xl">
<h2 class="text-xl">Proposal Saya</h2>
<p class="text-3xl font-bold">{{ $proposalSaya }}</p>
</div>

<div class="bg-purple-500 text-white p-6 rounded-xl">
<h2 class="text-xl">Proposal Diterima</h2>
<p class="text-3xl font-bold">{{ $proposalDiterima }}</p>
</div>

</div>

<h2 class="text-2xl font-bold mb-4">Sponsor Terbaru</h2>

<div class="grid grid-cols-3 gap-6">

@foreach($sponsorBaru as $item)

<div class="bg-white shadow rounded-xl p-5">
<h3 class="text-xl font-bold">{{ $item->nama_event }}</h3>
<p>{{ $item->kategori }}</p>
<p class="mt-2 text-green-600 font-bold">
Rp {{ number_format($item->nominal) }}
</p>

<a href="/explore/sponsor/{{ $item->id }}"
class="inline-block mt-3 bg-blue-600 text-white px-4 py-2 rounded">
Detail
</a>
</div>

@endforeach

</div>

<div class="mt-10">
<a href="/explore"
class="bg-orange-500 text-white px-6 py-3 rounded-xl">
Explore Semua Sponsor
</a>
</div>

</div>

@endsection
