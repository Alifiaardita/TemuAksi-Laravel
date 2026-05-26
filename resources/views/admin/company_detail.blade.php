@extends('layouts.admin')

@section('title', 'Detail Perusahaan')

@section('content')
<div class="p-8 max-w-6xl mx-auto">

    {{-- HEADER --}}
    <h1 class="text-3xl font-bold text-cornflower mb-6">
        🏢 Detail Perusahaan
    </h1>

    {{-- INFO PERUSAHAAN --}}
    <div class="bg-white p-6 rounded-2xl shadow mb-6">

        <h2 class="text-xl font-semibold mb-2">
            {{ $company->companyProfile->nama_perusahaan ?? '-' }}
        </h2>

        <p class="text-gray-600">
            📍 {{ $company->companyProfile->alamat ?? '-' }}
        </p>

        <p class="text-gray-600 mt-1">
            🏭 {{ $company->companyProfile->bidang_industri ?? '-' }}
        </p>

    </div>

    {{-- STAT CARD --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

        <div class="bg-white p-5 rounded-xl shadow">
            <p class="text-sm text-gray-500">Total Dana Disalurkan</p>
            <h2 class="text-xl font-bold text-green-600">
                Rp {{ number_format($totalDana, 0, ',', '.') }}
            </h2>
        </div>

        <div class="bg-white p-5 rounded-xl shadow">
            <p class="text-sm text-gray-500">Proposal Masuk</p>
            <h2 class="text-xl font-bold">
                {{ $proposalMasuk }}
            </h2>
        </div>

        <div class="bg-white p-5 rounded-xl shadow">
            <p class="text-sm text-gray-500">Proposal Diterima</p>
            <h2 class="text-xl font-bold text-green-600">
                {{ $proposalDiterima }}
            </h2>
        </div>

        <div class="bg-white p-5 rounded-xl shadow">
            <p class="text-sm text-gray-500">Proposal Ditolak</p>
            <h2 class="text-xl font-bold text-red-500">
                {{ $proposalDitolak }}
            </h2>
        </div>

    </div>

    {{-- HISTORY DANA PER BULAN --}}
    <div class="bg-white p-6 rounded-2xl shadow mb-6">

        <h2 class="text-lg font-semibold mb-4">
            📊 Dana Disalurkan (2026)
        </h2>

        <table class="w-full text-left">
            <thead>
                <tr class="border-b">
                    <th class="py-2">Bulan</th>
                    <th>Total Dana</th>
                </tr>
            </thead>

            <tbody>
                @foreach($danaBulanan as $row)
                    <tr class="border-b">
                        <td class="py-2">
                            {{ $row->bulan }}
                        </td>

                        <td>
                            Rp {{ number_format($row->total, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    {{-- BACK BUTTON --}}
    <a href="{{ route('admin.company.index') }}"
       class="text-sm text-gray-600 hover:text-cornflower">
        ← Kembali ke daftar perusahaan
    </a>

</div>
@endsection