@extends('layouts.admin')

@section('title', 'Kelola Perusahaan')

@section('content')

<h1 class="text-3xl font-bold mb-6 text-cornflower">
    🏢 Kelola Perusahaan
</h1>

<div class="bg-white rounded-2xl shadow overflow-hidden">

    <table class="w-full text-left">

        <thead class="bg-blue-100">
            <tr>
                <th class="p-4">No</th>
                <th>Nama Perusahaan</th>
                <th>Email</th>
                <th>Total Dana Tersalurkan</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

        @foreach($perusahaan as $i => $item)
            <tr class="border-t hover:bg-gray-50">

                {{-- NO --}}
                <td class="p-4">
                    {{ $i + 1 }}
                </td>

                {{-- NAMA PERUSAHAAN --}}
                <td>
                    {{ $item->companyProfile->nama_perusahaan ?? '-' }}
                </td>

                {{-- EMAIL --}}
                <td>
                    {{ $item->email }}
                </td>

                {{-- TOTAL DANA --}}
                <td class="text-green-600 font-semibold">
                    Rp {{ number_format($item->total_dana ?? 0, 0, ',', '.') }}
                </td>

                {{-- AKSI --}}
                <td>
                    <a href="{{ route('admin.company.show', $item->id) }}"
                       class="text-blue-600 hover:underline">
                        Detail
                    </a>
                </td>

            </tr>
        @endforeach

        </tbody>

    </table>

</div>

@endsection