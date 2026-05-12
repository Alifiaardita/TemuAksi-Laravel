@extends('layouts.app')

@section('title', 'Riwayat Pengajuan')

@section('content')

<main class="max-w-7xl mx-auto px-6 py-8">

    <h1 class="text-3xl font-bold mb-6">
        📄 Riwayat Pengajuan Proposal
    </h1>

    <div class="bg-white rounded-3xl shadow-lg p-6 overflow-x-auto">

        <table class="w-full text-left">

            <thead>
                <tr class="border-b">
                    <th class="p-3">Judul</th>
                    <th class="p-3">Kategori</th>
                    <th class="p-3">Tanggal</th>
                    <th class="p-3">Proposal</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>

            <tbody class="text-gray-700">

                @forelse ($proposals as $row)

                    @php
                        $status = strtolower(trim($row->status ?? 'terkirim'));

                        $badge = match($status) {
                            'terkirim' => 'bg-yellow-500',
                            'pendanaan' => 'bg-blue-500',
                            'selesai' => 'bg-green-500',
                            'ditolak' => 'bg-red-500',
                            default => 'bg-gray-400',
                        };
                    @endphp

                    <tr class="border-b hover:bg-pear transition">

                        <td class="p-3">{{ $row->judul }}</td>

                        <td class="p-3">{{ $row->kategori }}</td>

                        <td class="p-3">{{ $row->tanggal }}</td>

                        {{-- PDF --}}
                        <td class="p-3">
                            @if ($row->file_proposal)
                                <button
                                    type="button"
                                    onclick="lihatPDF('{{ $row->file_proposal }}')"
                                    class="bg-blue-500 text-white px-3 py-1 rounded hover:opacity-80">
                                    Lihat
                                </button>
                            @else
                                -
                            @endif
                        </td>

                        {{-- STATUS --}}
                        <td class="p-3">
                            <span class="px-3 py-1 rounded-lg text-white {{ $badge }}">
                                {{ ucfirst($status) }}
                            </span>
                        </td>

                        {{-- AKSI --}}
                        <td class="p-3 flex gap-3">

                            <button
                                type="button"
                                onclick="lihatDetail(
                                    '{{ $row->id }}',
                                    '{{ $row->sponsor->nama ?? '-' }}',
                                    '{{ addslashes($row->judul) }}',
                                    `{{ addslashes($row->deskripsi) }}`,
                                    '{{ $row->kategori }}',
                                    '{{ $row->lokasi }}',
                                    '{{ $row->tanggal }}',
                                    '{{ number_format($row->target_dana,0,',','.') }}',
                                    '{{ $status }}'
                                )"
                                class="text-blue-600 text-lg">
                                👁
                            </button>

                            <a href="{{ route('proposal.edit', $row->id) }}"
                               class="text-green-600 text-lg">
                                ✏️
                            </a>

                            <a href="{{ route('proposal.destroy', $row->id) }}"
                               onclick="return confirm('Yakin mau hapus proposal ini?')"
                               class="text-red-600 text-lg">
                                🗑
                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="text-center p-6 text-gray-500">
                            Belum ada proposal yang diajukan.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</main>

<div id="modalDetail"
     class="fixed inset-0 bg-black/50 hidden items-center justify-center z-40">

    <div class="bg-white rounded-3xl p-8 w-full max-w-2xl relative">

        <button onclick="closeModal()" class="absolute top-4 right-5 text-xl">
            ×
        </button>

        <h2 class="text-2xl font-bold mb-6">📋 Detail Proposal</h2>

        <div class="space-y-3 text-sm">
            <p><b>Perusahaan:</b> <span id="dPerusahaan"></span></p>
            <p><b>Judul:</b> <span id="dJudul"></span></p>
            <p><b>Deskripsi:</b> <span id="dDeskripsi"></span></p>
            <p><b>Kategori:</b> <span id="dKategori"></span></p>
            <p><b>Lokasi:</b> <span id="dLokasi"></span></p>
            <p><b>Tanggal:</b> <span id="dTanggal"></span></p>
            <p><b>Target:</b> Rp <span id="dTarget"></span></p>
        </div>

        <div id="mouArea" class="mt-6"></div>

    </div>
</div>

<div id="modalPDF"
     class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">

    <div class="bg-white w-11/12 max-w-5xl h-[85vh] rounded-2xl relative p-4">

        <button onclick="closePDF()" class="absolute top-3 right-4 text-2xl">
            ×
        </button>

        <iframe id="pdfFrame" class="w-full h-full rounded-xl"></iframe>

    </div>
</div>

@endsection
