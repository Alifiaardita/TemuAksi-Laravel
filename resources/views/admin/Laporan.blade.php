@extends('layouts.admin')

@section('content')

<div class="p-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">

        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                📑 Laporan Keuangan
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Data seluruh proposal dan pendanaan
            </p>
        </div>

        <a href="{{ route('admin.laporan.pdf') }}"
           target="_blank"
           class="
                bg-green-600
                hover:bg-green-700
                text-white
                px-5
                py-2
                rounded-xl
                transition
                shadow
           ">

            📄 Generate PDF

        </a>

    </div>


    {{-- CARD TABLE --}}
    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left">

                {{-- TABLE HEADER --}}
                <thead class="bg-blue-100 border-b border-black">

                    <tr>
                        <th class="px-6 py-4">Judul</th>
                        <th class="px-6 py-4">Sponsor</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Dana</th>
                    </tr>

                </thead>


                {{-- TABLE BODY --}}
                <tbody>

                    @forelse($proposals as $proposal)

                    <tr class="border-b border-gray-300 hover:bg-gray-50 transition">

                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ $proposal->judul }}
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $proposal->sponsor->nama ?? '-' }}
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $proposal->tanggal->format('d M Y') }}
                        </td>

                        <td class="px-6 py-4">

                            <span class="
                                text-white
                                text-xs
                                px-3
                                py-1
                                rounded-full
                                {{ $proposal->badgeClass() }}
                            ">

                                {{ ucfirst($proposal->status) }}

                            </span>

                        </td>

                        <td class="px-6 py-4 font-semibold text-gray-700">

                            Rp {{ number_format($proposal->target_dana,0,',','.') }}

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5"
                            class="px-6 py-8 text-center text-gray-500">

                            Belum ada data laporan.

                        </td>

                    </tr>

                    @endforelse

                </tbody>


                {{-- FOOTER --}}
                <tfoot class="bg-gray-50">

                    <tr>

                        <td colspan="4"
                            class="
                                px-6
                                py-4
                                text-right
                                font-bold
                                text-gray-700
                            ">

                            Total Dana (Selesai)

                        </td>

                        <td class="px-6 py-4 font-bold text-green-700">

                            Rp {{ number_format($total,0,',','.') }}

                        </td>

                    </tr>

                </tfoot>

            </table>

        </div>

    </div>

</div>

@endsection