@extends('layouts.app')

@section('content')

<!-- HERO -->
<section class="py-20 bg-white text-gray-800">
    <div class="max-w-6xl mx-auto text-center px-6">

        <h2 class="text-5xl font-bold mb-6">
            Kolaborasi Event Jadi Lebih Mudah
        </h2>

        <p class="text-lg text-gray-600 mb-8">
            TemuAksi menghubungkan penyelenggara event,
            sponsor, dan volunteer dalam satu platform digital.
        </p>

        <div class="space-x-4 mb-14">
            <a href="{{ route('explore.index') }}"
               class="bg-cornflower text-white px-8 py-3 rounded-xl hover:opacity-90 transition inline-block">
                Cari Event
            </a>
        </div>

        <!-- KATEGORI -->
        <div class="flex justify-center gap-6 flex-wrap">

            @foreach($kategori as $k)
                <a href="{{ route('explore.kategori', $k->id) }}">

                    <div class="w-40 h-52 rounded-2xl overflow-hidden relative group">

                        <img src="https://picsum.photos/200/300?random={{ $k->id }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-300">

                        <div class="absolute inset-0 bg-black/30"></div>

                        <div class="absolute bottom-0 p-4 text-white font-semibold">
                            {{ $k->nama_kategori }}
                        </div>

                    </div>

                </a>
            @endforeach

        </div>
    </div>
</section>

<!-- FEATURES -->
<section class="py-16 bg-pear">
    <div class="max-w-6xl mx-auto px-6 text-center">

        <h3 class="text-3xl md:text-4xl font-bold mb-4">
            Kenali layanan TemuAksi
        </h3>

        <p class="text-gray-600 mb-12 max-w-2xl mx-auto">
            Kami hadir untuk menghubungkan penyelenggara event, sponsor,
            dan relawan dalam satu platform.
        </p>

        <div class="grid md:grid-cols-3 gap-8">

            <!-- CARD 1 -->
            <div class="bg-white p-8 rounded-2xl shadow-md text-left">
                <h4 class="text-xl font-semibold mb-3">Jadi Relawan</h4>
                <p class="text-gray-600 mb-6">
                    Cari pengalaman volunteer dan ikut berbagai kegiatan sosial.
                </p>

                <a href="{{ route('volunteer.index') }}"
                   class="bg-cornflower text-white px-5 py-2 rounded-lg hover:opacity-90 transition">
                    Cari Aktivitas
                </a>
            </div>

            <!-- CARD 2 -->
            <div class="bg-white p-8 rounded-2xl shadow-md text-left">
                <h4 class="text-xl font-semibold mb-3">Cari Relawan</h4>
                <p class="text-gray-600 mb-6">
                    Butuh bantuan relawan untuk event kamu? Temukan di sini.
                </p>

                <a href="{{ route('volunteer.index') }}"
                   class="bg-cornflower text-white px-5 py-2 rounded-lg hover:opacity-90 transition">
                    Lihat Relawan
                </a>
            </div>

            <!-- CARD 3 -->
            <div class="bg-white p-8 rounded-2xl shadow-md text-left">
                <h4 class="text-xl font-semibold mb-3">Kerjasama CSR</h4>
                <p class="text-gray-600 mb-6">
                    Hubungkan event dengan sponsor dan perusahaan potensial.
                </p>

                <a href="{{ route('explore.index') }}"
                   class="bg-cornflower text-white px-5 py-2 rounded-lg hover:opacity-90 transition">
                    Cari Sponsor
                </a>
            </div>

        </div>

    </div>
</section>

<!-- FEATURE GRID -->
<section class="py-20 bg-white text-gray-800">
    <div class="max-w-6xl mx-auto px-6">

        <h3 class="text-3xl font-bold text-center mb-16">
            Semua yang Kamu Butuhkan untuk Event Sukses
        </h3>

        <div class="grid md:grid-cols-2 gap-8">

            <div class="bg-mist text-white p-8 rounded-2xl shadow">
                <h4 class="text-xl font-semibold mb-2">Manajemen Event</h4>
                <p>Buat dan kelola event dengan mudah.</p>
            </div>

            <div class="bg-pear p-8 rounded-2xl shadow">
                <h4 class="text-xl font-semibold mb-2">Sponsorship Proposal</h4>
                <p class="text-cornflower">Hubungkan event dengan sponsor potensial.</p>
            </div>

            <div class="bg-pear text-cornflower p-8 rounded-2xl shadow">
                <h4 class="text-xl font-semibold mb-2">Recruit Volunteer</h4>
                <p>Temukan volunteer yang siap membantu event kamu.</p>
            </div>

            <div class="bg-mist text-white p-8 rounded-2xl shadow">
                <h4 class="text-xl font-semibold mb-2">Komunikasi Mudah</h4>
                <p>Kolaborasi lebih cepat antar organizer dan sponsor.</p>
            </div>

        </div>

    </div>
</section>

<!-- CTA -->
<section class="bg-cornflower py-20 text-center text-white">

    <h3 class="text-3xl font-bold mb-6">
        Siap Membuat Event Lebih Besar?
    </h3>

    <p class="mb-8">
        Gabung dengan TemuAksi sekarang.
    </p>

    @guest
        <a href="{{ route('register') }}"
           class="bg-pear text-black px-8 py-3 rounded-xl font-semibold hover:opacity-90 transition">
            Daftar Sekarang
        </a>
    @endguest

</section>


@endsection
