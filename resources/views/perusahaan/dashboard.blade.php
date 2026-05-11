@extends('layouts.app')

@section('content')

<!-- HERO -->
<section class="py-16 text-center bg-canvas text-cornflower">
    <div class="max-w-6xl mx-auto px-6">

        <h2 class="text-4xl font-bold mb-4">
            Selamat Datang 👋
        </h2>

        <p class="text-xl font-semibold">
            {{ $company->nama_perusahaan ?? 'Perusahaan Anda' }}
        </p>

        <p class="text-gray-500 mt-2">
            Kelola sponsorship dan lihat proposal yang masuk
        </p>

    </div>
</section>

<!-- STATS -->
<section class="max-w-5xl mx-auto px-6 grid md:grid-cols-2 gap-6 mb-16">

    <!-- TOTAL EVENT -->
    <div class="bg-white p-8 rounded-3xl shadow text-center hover:scale-105 transition">
        <h3 class="text-lg text-gray-500">Event Dibuka</h3>

        <p class="text-4xl font-bold mt-2 text-cornflower">
            {{ $totalSponsor ?? 0 }}
        </p>
    </div>

    <!-- TOTAL PROPOSAL -->
    <div class="bg-white p-8 rounded-3xl shadow text-center hover:scale-105 transition">
        <h3 class="text-lg text-gray-500">Proposal Masuk</h3>

        <p class="text-4xl font-bold mt-2 text-cornflower">
            {{ $totalProposal ?? 0 }}
        </p>
    </div>

</section>

<!-- ACTION -->
<section class="max-w-5xl mx-auto px-6 grid md:grid-cols-2 gap-6 mb-20">

    <!-- LIHAT PROPOSAL -->
    <a href="{{ route('perusahaan.proposal.index') }}"
       class="bg-white p-10 rounded-3xl shadow hover:bg-pear transition text-center">

        <h3 class="text-2xl font-bold mb-2">
            📄 Lihat Proposal
        </h3>

        <p>
            Cek pengajuan dari organizer
        </p>

    </a>

    <!-- TAMBAH EVENT -->
    <a href="{{ route('perusahaan.sponsor.create') }}"
       class="bg-white p-10 rounded-3xl shadow hover:bg-pear transition text-center">

        <h3 class="text-2xl font-bold mb-2">
            ➕ Buka Sponsor
        </h3>

        <p>
            Buat campaign sponsorship baru
        </p>

    </a>

</section>

<!-- INFO -->
<section class="max-w-5xl mx-auto px-6 mb-20">

    <div class="bg-white p-8 rounded-3xl shadow">

        <h3 class="text-xl font-semibold mb-3">
            Tips
        </h3>

        <p class="text-gray-600 text-sm leading-relaxed">
            Buat profil perusahaan yang profesional dan jelaskan benefit sponsor
            agar proposal yang masuk lebih berkualitas.
        </p>

    </div>

</section>



@endsection
