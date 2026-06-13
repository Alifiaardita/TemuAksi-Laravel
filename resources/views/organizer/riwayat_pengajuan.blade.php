@extends('layouts.app')

@section('title', 'Riwayat Pengajuan')

@section('content')

<div class="bg-[#f0f2f8] min-h-screen">

    {{-- ========== HEADER ========== --}}
    <section class="relative overflow-hidden" style="background: linear-gradient(135deg, #0f1e45 0%, #1a3a6e 50%, #2d4fa0 100%);">
        <div class="absolute inset-0 opacity-[0.06]"
             style="background-image: radial-gradient(circle, #ffffff 1px, transparent 1px); background-size: 28px 28px;"></div>
        <div class="relative max-w-6xl mx-auto px-6 py-12">
            <p class="text-xs font-semibold tracking-widest uppercase text-white/40 mb-2">Sponsorship</p>
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-black text-white">Riwayat Pengajuan Proposal</h1>
                    <p class="text-white/50 text-sm mt-1">Pantau status semua proposal sponsorship yang telah kamu kirim.</p>
                </div>
                <a href="{{ route('explore.index') }}"
                   class="flex items-center gap-2 bg-[#4a6cf7] text-white font-semibold px-5 py-3 rounded-xl hover:bg-[#05208b] transition text-sm self-start md:self-auto">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Ajukan Proposal Baru
                </a>
            </div>
        </div>
    </section>

    {{-- ========== TABEL ========== --}}
    <div class="max-w-6xl mx-auto px-6 py-10">
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">

            {{-- Table header --}}
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="font-black text-[#0f1e45] text-base">Semua Proposal</h2>
                <span class="text-xs text-gray-400 font-medium">{{ $proposals->count() }} proposal</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-[#f0f2f8]">
                            <th class="px-6 py-3 text-xs font-semibold tracking-widest uppercase text-gray-400">Judul</th>
                            <th class="px-6 py-3 text-xs font-semibold tracking-widest uppercase text-gray-400">Kategori</th>
                            <th class="px-6 py-3 text-xs font-semibold tracking-widest uppercase text-gray-400">Tanggal</th>
                            <th class="px-6 py-3 text-xs font-semibold tracking-widest uppercase text-gray-400">Proposal</th>
                            <th class="px-6 py-3 text-xs font-semibold tracking-widest uppercase text-gray-400">Status</th>
                            <th class="px-6 py-3 text-xs font-semibold tracking-widest uppercase text-gray-400">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">

                        @forelse ($proposals as $row)
                            @php
                                $status = strtolower(trim($row->status ?? 'terkirim'));
                                $badge = match($status) {
                                    'terkirim'  => 'bg-yellow-50 text-yellow-700 border border-yellow-200',
                                    'pendanaan' => 'bg-blue-50 text-blue-700 border border-blue-200',
                                    'selesai'   => 'bg-green-50 text-green-700 border border-green-200',
                                    'ditolak'   => 'bg-red-50 text-red-700 border border-red-200',
                                    default     => 'bg-gray-50 text-gray-600 border border-gray-200',
                                };
                                $dot = match($status) {
                                    'terkirim'  => 'bg-yellow-400',
                                    'pendanaan' => 'bg-blue-500',
                                    'selesai'   => 'bg-green-500',
                                    'ditolak'   => 'bg-red-500',
                                    default     => 'bg-gray-400',
                                };
                            @endphp
                            <tr class="hover:bg-[#f8f9ff] transition group">

                                <td class="px-6 py-4">
                                    <p class="font-semibold text-[#0f1e45] text-sm">{{ $row->judul }}</p>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="text-xs text-gray-500 bg-[#f0f2f8] px-2.5 py-1 rounded-full font-medium">
                                        {{ $row->kategori }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <p class="text-sm text-gray-500">{{ $row->tanggal->format('d M Y') }}</p>
                                </td>

                                <td class="px-6 py-4">
                                    @if ($row->file_proposal)
                                        <button type="button"
                                            onclick="lihatPDF('{{ $row->file_proposal }}')"
                                            class="flex items-center gap-1.5 text-[#4a6cf7] text-xs font-semibold hover:underline">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            Lihat PDF
                                        </button>
                                    @else
                                        <span class="text-gray-300 text-xs">—</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ $badge }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $dot }}"></span>
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-1">

                                        {{-- Detail --}}
                                        <button type="button"
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
                                            class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:bg-[#e4e8ff] hover:text-[#4a6cf7] transition"
                                            title="Lihat Detail">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </button>

                                        {{-- Edit --}}
                                        <a href="{{ route('proposal.edit', $row->id) }}"
                                           class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:bg-green-50 hover:text-green-600 transition"
                                           title="Edit Proposal">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>

                                        {{-- Hapus --}}
                                        <a href="{{ route('proposal.destroy', $row->id) }}"
                                           onclick="return confirm('Yakin mau hapus proposal ini?')"
                                           class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:bg-red-50 hover:text-red-500 transition"
                                           title="Hapus Proposal">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </a>

                                    </div>
                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-14 h-14 bg-[#f0f2f8] rounded-2xl flex items-center justify-center">
                                            <svg class="w-7 h-7 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <p class="text-sm font-semibold text-gray-400">Belum ada proposal yang diajukan.</p>
                                        <a href="{{ route('explore.index') }}" class="text-xs text-[#4a6cf7] font-semibold hover:underline">
                                            Mulai ajukan proposal →
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


{{-- ========== MODAL DETAIL ========== --}}
<div id="modalDetail" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-40 p-4">
    <div class="bg-white rounded-2xl w-full max-w-lg relative shadow-xl">

        {{-- Modal header --}}
        <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-[#e4e8ff] rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-[#4a6cf7]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h2 class="text-base font-black text-[#0f1e45]">Detail Proposal</h2>
            </div>
            <button onclick="closeModal()"
                class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:bg-gray-100 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Modal body --}}
        <div class="px-6 py-5 space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">Perusahaan</p>
                    <p class="text-sm font-semibold text-[#0f1e45]" id="dPerusahaan"></p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">Kategori</p>
                    <p class="text-sm font-semibold text-[#0f1e45]" id="dKategori"></p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">Tanggal</p>
                    <p class="text-sm font-semibold text-[#0f1e45]" id="dTanggal"></p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">Lokasi</p>
                    <p class="text-sm font-semibold text-[#0f1e45]" id="dLokasi"></p>
                </div>
            </div>
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">Judul</p>
                <p class="text-sm font-semibold text-[#0f1e45]" id="dJudul"></p>
            </div>
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">Deskripsi</p>
                <p class="text-sm text-gray-600 leading-relaxed" id="dDeskripsi"></p>
            </div>
            <div class="bg-[#f0f2f8] rounded-xl px-4 py-3 flex items-center justify-between">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Target Dana</p>
                <p class="text-sm font-black text-[#0f1e45]">Rp <span id="dTarget"></span></p>
            </div>
        </div>

        <div id="mouArea" class="px-6 pb-5"></div>

    </div>
</div>


{{-- ========== MODAL PDF ========== --}}
<div id="modalPDF" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50 p-4">
    <div class="bg-white w-full max-w-5xl h-[88vh] rounded-2xl relative flex flex-col overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100 flex-shrink-0">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-red-50 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="text-sm font-bold text-[#0f1e45]">Dokumen Proposal</span>
            </div>
            <button onclick="closePDF()"
                class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:bg-gray-100 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <iframe id="pdfFrame" class="w-full flex-1"></iframe>
    </div>
</div>

@endsection
