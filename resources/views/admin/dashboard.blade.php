@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')

{{-- HEADER --}}
<div class="flex justify-between items-center mb-8">

    <div>
        <h1 class="text-3xl font-bold text-gray-800">
            Dashboard Admin
        </h1>

        <p class="text-gray-500 mt-1">
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </p>
    </div>

</div>

{{-- STATISTIK --}}
<div class="grid md:grid-cols-3 xl:grid-cols-6 gap-5 mb-8">

    <div class="bg-white p-5 rounded-2xl shadow">
        <p class="text-sm text-gray-500">Akun Aktif</p>
        <h2 class="text-3xl font-bold mt-2">{{ $akunAktif }}</h2>
    </div>

    <div class="bg-white p-5 rounded-2xl shadow">
        <p class="text-sm text-gray-500">Perusahaan Aktif</p>
        <h2 class="text-3xl font-bold mt-2">{{ $perusahaanAktif }}</h2>
    </div>

    <div class="bg-white p-5 rounded-2xl shadow">
        <p class="text-sm text-gray-500">Pendanaan Tersalurkan</p>
        <h2 class="text-2xl font-bold mt-2 text-green-600">
            {{ $pendanaanTersalurkan }}
        </h2>
    </div>

    <div class="bg-white p-5 rounded-2xl shadow">
        <p class="text-sm text-gray-500">Total Dana Tersalurkan</p>
        <h2 class="text-2xl font-bold mt-2 text-cornflower">
            Rp {{ number_format($totalDana, 0, ',', '.') }}
        </h2>
    </div>

    <div class="bg-white p-5 rounded-2xl shadow">
        <p class="text-sm text-gray-500">Volunteer Dibuka</p>
        <h2 class="text-3xl font-bold mt-2">{{ $volunteerOpen }}</h2>
    </div>

    <div class="bg-white p-5 rounded-2xl shadow">
        <p class="text-sm text-gray-500">Open Sponsor</p>
        <h2 class="text-3xl font-bold mt-2 text-yellow-500">{{ $openSponsor }}</h2>
    </div>

</div>

{{-- GRID --}}
<div class="grid lg:grid-cols-2 gap-6">

    {{-- ================= USER ================= --}}
    <div class="bg-white rounded-2xl shadow p-6">

        <h2 class="text-xl font-semibold mb-4">👤 Semua Akun</h2>

        <div class="max-h-96 overflow-y-auto space-y-3">

            @foreach($users as $user)

            <a href="{{ route('admin.user.edit', $user->id) }}"
               class="block border rounded-xl p-4 hover:bg-gray-50 transition">

                <div class="flex justify-between items-center">

                    <div>
                        <h3 class="font-semibold">
                            {{ $user->role === 'perusahaan'
                                ? $user->companyProfile?->nama_perusahaan
                                : ($user->userProfile?->nama_lengkap ?? '-') }}
                        </h3>

                        <p class="text-sm text-gray-500">
                            {{ $user->email }}
                        </p>
                    </div>

                    <span class="
                        px-3 py-1 rounded-full text-sm
                        {{ $user->status == 'aktif'
                            ? 'bg-green-100 text-green-600'
                            : 'bg-red-100 text-red-600' }}
                    ">
                        {{ ucfirst($user->status) }}
                    </span>

                </div>

            </a>

            @endforeach

        </div>

    </div>

    {{-- ================= PERUSAHAAN ================= --}}
    <div class="bg-white rounded-2xl shadow p-6">

        <h2 class="text-xl font-semibold mb-4">🏢 Perusahaan</h2>

        <div class="max-h-96 overflow-y-auto space-y-3">

            @foreach($perusahaan as $item)

            <a href="{{ route('admin.company.show', $item->id) }}"
               class="block border rounded-xl p-4 hover:bg-gray-50 transition">

                <div class="flex justify-between items-center mb-2">

                    <div>
                        <h3 class="font-semibold">
                            {{ $item->companyProfile->nama_perusahaan ?? '-' }}
                        </h3>

                        <p class="text-sm text-gray-500">
                            {{ $item->email }}
                        </p>
                    </div>

                    <span class="text-sm px-3 py-1 rounded-full bg-blue-100 text-blue-600">
                        Aktif
                    </span>

                </div>

                <div class="text-sm text-gray-600">
                    Dana Tersalurkan:
                    <span class="font-bold text-green-600">
                        Rp {{ number_format($item->total_dana ?? 0, 0, ',', '.') }}
                    </span>
                </div>

            </a>

            @endforeach

        </div>

    </div>

</div>

@endsection