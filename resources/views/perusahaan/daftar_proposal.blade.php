@extends('layouts.app')

@section('title', 'Daftar Proposal')

@section('content')
<div class="min-h-screen px-8 p-6">
    <div style="max-width: 1100px; margin: 0 auto;">

        {{-- METRIC CARDS --}}
        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-xl p-4 border" style="border-color: #dce6f0;">
                <p class="text-xs uppercase tracking-wide mb-1" style="color: #7096D1;">Total masuk</p>
                <p class="text-3xl font-semibold" style="color: #081F5C;">{{ $totalProposal ?? 0 }}</p>
            </div>
            <div class="bg-white rounded-xl p-4 border" style="border-color: #dce6f0;">
                <p class="text-xs uppercase tracking-wide mb-1" style="color: #7096D1;">Menunggu review</p>
                <p class="text-3xl font-semibold" style="color: #081F5C;">{{ $proposalMenunggu ?? 0 }}</p>
            </div>
            <div class="bg-white rounded-xl p-4 border" style="border-color: #dce6f0;">
                <p class="text-xs uppercase tracking-wide mb-1" style="color: #7096D1;">Didanai</p>
                <p class="text-3xl font-semibold" style="color: #081F5C;">{{ $proposalDidanai ?? 0 }}</p>
            </div>
        </div>
        
        {{-- TABEL --}}
<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">

    {{-- Table header --}}
    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
        <h2 class="font-black text-[#0f1e45] text-base">Proposal Masuk</h2>
        <select class="text-xs px-3 py-1.5 rounded-lg border border-gray-200 text-gray-500 bg-white">
            <option>Semua status</option>
            <option>Menunggu</option>
            <option>Didanai</option>
            <option>Selesai</option>
            <option>Ditolak</option>
        </select>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left" style="table-layout: fixed;">
            <colgroup>
                <col style="width: 26%;">
                <col style="width: 30%;">
                <col style="width: 13%;">
                <col style="width: 15%;">
                <col style="width: 16%;">
            </colgroup>
            <thead>
                <tr class="bg-[#f0f2f8]">
                    <th class="px-6 py-3 text-xs font-semibold tracking-widest uppercase text-gray-400">Email</th>
                    <th class="px-6 py-3 text-xs font-semibold tracking-widest uppercase text-gray-400">Judul</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold tracking-widest uppercase text-gray-400">Proposal</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold tracking-widest uppercase text-gray-400">Status</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold tracking-widest uppercase text-gray-400">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($proposals as $row)
                @php
                    $status = strtolower(trim($row->status));
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
                    $label = match($status) {
                        'terkirim'  => 'Menunggu',
                        'pendanaan' => 'Didanai',
                        'selesai'   => 'Selesai',
                        'ditolak'   => 'Ditolak',
                        default     => ucfirst($status)
                    };
                @endphp
                <tr class="hover:bg-[#f8f9ff] transition group">

                    {{-- Email --}}
                    <td class="px-6 py-4 text-sm text-[#0f1e45] overflow-hidden text-ellipsis whitespace-nowrap"
                        title="{{ $row->user->email ?? '-' }}">
                        {{ $row->user->email ?? '-' }}
                    </td>

                    {{-- Judul --}}
                    <td class="px-6 py-4 overflow-hidden text-ellipsis whitespace-nowrap"
                        title="{{ $row->judul }}">
                        <p class="font-semibold text-[#0f1e45] text-sm">{{ $row->judul }}</p>
                    </td>

                    {{-- PDF --}}
                    <td class="px-6 py-4 text-center">
                        @if(!empty($row->file_proposal))
                            <button onclick="lihatPDF('{{ $row->file_proposal }}')"
                                class="flex items-center gap-1.5 text-[#4a6cf7] text-xs font-semibold hover:underline mx-auto">
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

                    {{-- Status --}}
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ $badge }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $dot }}"></span>
                            {{ $label }}
                        </span>
                    </td>

                    {{-- Aksi --}}
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-1">
                            {{-- Lihat MOU --}}
                                @if(in_array($status, ['pendanaan', 'selesai']))
                                    <a href="{{ route('perusahaan.proposal.mou', $row->id) }}" target="_blank"
                                        class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:bg-green-50 hover:text-green-600 transition"
                                        title="Lihat MOU">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </a>
                                @endif
                            {{-- Detail --}}
                            <button
                                data-id="{{ $row->id }}"
                                data-email="{{ e($row->user->email ?? '-') }}"
                                data-judul="{{ e($row->judul) }}"
                                data-deskripsi="{{ e($row->deskripsi) }}"
                                data-kategori="{{ e($row->kategori) }}"
                                data-lokasi="{{ e($row->lokasi) }}"
                                data-tanggal="{{ $row->tanggal }}"
                                data-target="{{ number_format($row->target_dana, 0, ',', '.') }}"
                                data-status="{{ $status }}"
                                data-route-setujui="{{ route('perusahaan.proposal.setujui', $row->id) }}"
                                data-route-tolak="{{ route('perusahaan.proposal.tolak', $row->id) }}"
                                onclick="bukaDetailProposal(this)"
                                class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:bg-[#e4e8ff] hover:text-[#4a6cf7] transition"
                                title="Lihat Detail">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>

                            {{-- Hapus --}}
                            <form method="POST" action="{{ route('perusahaan.proposal.destroy', $row->id) }}"
                                onsubmit="return confirm('Yakin hapus proposal ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:bg-red-50 hover:text-red-500 transition"
                                    title="Hapus Proposal">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-20 text-center">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-14 h-14 bg-[#f0f2f8] rounded-2xl flex items-center justify-center">
                                <svg class="w-7 h-7 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <p class="text-sm font-semibold text-gray-400">Belum ada proposal masuk.</p>
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

{{-- MODAL DETAIL --}}
<div id="modal" class="fixed inset-0" style="display:none; align-items:center; justify-content:center; background:rgba(0,0,0,0.4); z-index:9999;">
    <div style="background:white; border-radius:16px; width:100%; max-width:460px; box-shadow:0 10px 40px rgba(0,0,0,0.15); display:flex; flex-direction:column;">

        {{-- Header --}}
        <div style="background:#4A6FA5; padding:16px 24px; border-radius:16px 16px 0 0; display:flex; align-items:center; justify-content:space-between; flex-shrink:0;">
            <h2 style="color:white; font-size:15px; font-weight:600; margin:0;">Detail proposal</h2>
            <button 
                onclick="closeModal()" 
                type="button"
                style="background:none; border:none; color:white; font-size:28px; cursor:pointer; line-height:1; padding:0; width:32px; height:32px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                &times;
            </button>
        </div>

        {{-- Body --}}
        <div style="padding:20px 24px; display:flex; flex-direction:column; gap:14px; font-size:14px; overflow-y:auto; max-height:65vh;">
            <div style="border-bottom:1px solid #e8edf2; padding-bottom:12px;">
                <p style="color:#9baec8; font-size:11px; text-transform:uppercase; letter-spacing:0.08em; margin:0 0 4px;">Email</p>
                <p style="color:#2d3748; margin:0;" id="dEmail"></p>
            </div>
            <div style="border-bottom:1px solid #e8edf2; padding-bottom:12px;">
                <p style="color:#9baec8; font-size:11px; text-transform:uppercase; letter-spacing:0.08em; margin:0 0 4px;">Judul</p>
                <p style="color:#1a202c; font-weight:600; margin:0;" id="dJudul"></p>
            </div>
            <div style="border-bottom:1px solid #e8edf2; padding-bottom:12px;">
                <p style="color:#9baec8; font-size:11px; text-transform:uppercase; letter-spacing:0.08em; margin:0 0 4px;">Kategori</p>
                <p style="color:#1a202c; font-weight:600; margin:0;" id="dKategori"></p>
            </div>
            <div style="border-bottom:1px solid #e8edf2; padding-bottom:12px;">
                <p style="color:#9baec8; font-size:11px; text-transform:uppercase; letter-spacing:0.08em; margin:0 0 4px;">Lokasi</p>
                <p style="color:#1a202c; font-weight:600; margin:0;" id="dLokasi"></p>
            </div>
            <div style="border-bottom:1px solid #e8edf2; padding-bottom:12px;">
                <p style="color:#9baec8; font-size:11px; text-transform:uppercase; letter-spacing:0.08em; margin:0 0 4px;">Tanggal</p>
                <p style="color:#1a202c; font-weight:600; margin:0;" id="dTanggal"></p>
            </div>
            <div style="border-bottom:1px solid #e8edf2; padding-bottom:12px;">
                <p style="color:#9baec8; font-size:11px; text-transform:uppercase; letter-spacing:0.08em; margin:0 0 4px;">Target Dana</p>
                <p style="color:#1a202c; font-weight:600; margin:0;">Rp <span id="dTarget"></span></p>
            </div>
            <div style="border-bottom:1px solid #e8edf2; padding-bottom:12px;">
                <p style="color:#9baec8; font-size:11px; text-transform:uppercase; letter-spacing:0.08em; margin:0 0 4px;">Status</p>
                <span id="dStatusBadge"></span>
            </div>
            <div>
                <p style="color:#9baec8; font-size:11px; text-transform:uppercase; letter-spacing:0.08em; margin:0 0 4px;">Deskripsi</p>
                <p style="color:#4a5568; margin:0;" id="dDeskripsi"></p>
            </div>
        </div>

        {{-- Action --}}
        <div id="actionArea" style="padding:16px 24px; display:flex; gap:12px; flex-shrink:0; border-top:1px solid #e8edf2;"></div>

    </div>
</div>

{{-- MODAL PENDANAAN --}}
<div id="modalPendanaan" class="fixed inset-0" style="display:none; align-items:center; justify-content:center; background:rgba(0,0,0,0.4); z-index:9999;">
    <div style="background:white; border-radius:16px; width:100%; max-width:460px; box-shadow:0 10px 40px rgba(0,0,0,0.15); display:flex; flex-direction:column;">
        
        <div style="background:#4A6FA5; padding:16px 24px; border-radius:16px 16px 0 0; display:flex; align-items:center; justify-content:space-between;">
            <h2 style="color:white; font-size:15px; font-weight:600; margin:0;">Form Pendanaan</h2>
            <button onclick="closePendanaan()" type="button"
                style="background:none; border:none; color:white; font-size:28px; cursor:pointer; line-height:1; padding:0; width:32px; height:32px; display:flex; align-items:center; justify-content:center;">
                &times;
            </button>
        </div>

        <form id="formPendanaan" method="POST" style="padding:24px; display:flex; flex-direction:column; gap:16px;">
            <input type="hidden" name="_token" id="pendanaanToken">
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="proposal_id" id="pendanaanProposalId">

            <div>
                <label style="font-size:12px; color:#9baec8; text-transform:uppercase; letter-spacing:0.08em; display:block; margin-bottom:6px;">Jumlah Dana Disetujui (Rp)</label>
                <input type="number" name="jumlah_dana" required
                    style="width:100%; padding:10px 12px; border:1px solid #dce6f0; border-radius:10px; font-size:14px; color:#1a202c; outline:none; box-sizing:border-box;"
                    placeholder="Contoh: 1000000">
            </div>

            <div>
                <label style="font-size:12px; color:#9baec8; text-transform:uppercase; letter-spacing:0.08em; display:block; margin-bottom:6px;">Catatan (opsional)</label>
                <textarea name="catatan" rows="3"
                    style="width:100%; padding:10px 12px; border:1px solid #dce6f0; border-radius:10px; font-size:14px; color:#1a202c; outline:none; resize:none; box-sizing:border-box;"
                    placeholder="Tambahkan catatan untuk pengaju..."></textarea>
            </div>

            <div style="display:flex; gap:12px; margin-top:4px;">
                <button type="button" onclick="closePendanaan()"
                    style="flex:1; padding:12px; border-radius:12px; border:1px solid #dce6f0; color:#475569; background:#fff; cursor:pointer; font-size:14px;">
                    Batal
                </button>
                <button type="submit"
                    style="flex:1; padding:12px; border-radius:12px; border:none; color:white; background:#4A6FA5; cursor:pointer; font-size:14px; font-weight:500;">
                    Konfirmasi Pendanaan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL PDF --}}
<div id="modalPDF" class="fixed inset-0 z-50" style="display:none; align-items:center; justify-content:center; background:rgba(0,0,0,0.6);">
    <div class="bg-white w-11/12 max-w-5xl h-[85vh] rounded-2xl relative p-4 shadow-lg">
        <button onclick="closePDF()" class="absolute top-3 right-4 text-2xl font-bold" style="color: #081F5C;">×</button>
        <iframe id="pdfFrame" class="w-full h-full rounded-xl"></iframe>
    </div>
</div>

@endsection

@push('scripts')
<script>
let currentRouteSetujui = '';
function bukaDetailProposal(btn) {
    document.getElementById('dEmail').innerText     = btn.dataset.email;
    document.getElementById('dJudul').innerText     = btn.dataset.judul;
    document.getElementById('dDeskripsi').innerText = btn.dataset.deskripsi;
    document.getElementById('dKategori').innerText  = btn.dataset.kategori;
    document.getElementById('dLokasi').innerText    = btn.dataset.lokasi;
    document.getElementById('dTanggal').innerText   = btn.dataset.tanggal;
    document.getElementById('dTarget').innerText    = btn.dataset.target;
    currentRouteSetujui = btn.dataset.routeSetujui;

    const status = btn.dataset.status;
    const badgeMap = {
        'terkirim':  { label: 'Menunggu', style: 'background:#FFF3CD; color:#856404;' },
        'pendanaan': { label: 'Didanai',  style: 'background:#D0E3FF; color:#0C447C;' },
        'selesai':   { label: 'Selesai',  style: 'background:#d4edda; color:#155724;' },
        'ditolak':   { label: 'Ditolak',  style: 'background:#f8d7da; color:#721c24;' },
    };
    const badge = badgeMap[status] ?? { label: status, style: 'background:#e2e8f0; color:#475569;' };
    const badgeEl = document.getElementById('dStatusBadge');
    badgeEl.innerText = badge.label;
    badgeEl.setAttribute('style', badge.style + ' padding:4px 12px; border-radius:9999px; font-size:12px; font-weight:500;');

    const actionArea = document.getElementById('actionArea');
    const proposalId = btn.dataset.id;

    if (status === 'terkirim') {
        actionArea.innerHTML = `
            <button type="button" onclick="bukaPendanaan(${proposalId})"
                style="flex:1; padding:12px; border-radius:12px; border:1px solid #c3e6cb; color:#155724; background:#d4edda; cursor:pointer; font-size:14px; font-weight:500;">
                &#10003; Setujui
            </button>
            <form method="POST" action="/perusahaan/proposal/${proposalId}/tolak" style="flex:1;"
                onsubmit="return confirm('Yakin ingin menolak proposal ini?')">
                <input type="hidden" name="_token" value="${document.querySelector('meta[name=csrf-token]').content}">
                <input type="hidden" name="_method" value="PATCH">
                <button type="submit"
                    style="width:100%; padding:12px; border-radius:12px; border:1px solid #f5c2c7; color:#721c24; background:#f8d7da; cursor:pointer; font-size:14px; font-weight:500;">
                    &#10007; Tolak
                </button>
            </form>
        `;
    } else {
        actionArea.innerHTML = '';
    }

    document.getElementById('modal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('modal').style.setProperty('display', 'none', 'important');
}

function bukaPendanaan(proposalId) {
    // tutup modal detail dulu
    closeModal();

    // set proposal id dan token ke form pendanaan
    document.getElementById('pendanaanProposalId').value = proposalId;
    document.getElementById('pendanaanToken').value = document.querySelector('meta[name="csrf-token"]').content;
    
    // set action form ke route setujui
    document.getElementById('formPendanaan').action = currentRouteSetujui;

    document.getElementById('modalPendanaan').style.display = 'flex';
}

function closePendanaan() {
    document.getElementById('modalPendanaan').style.setProperty('display', 'none', 'important');
}


function lihatPDF(file) {
    document.getElementById('pdfFrame').src = '/storage/' + file;
    document.getElementById('modalPDF').style.display = 'flex';
}

function closePDF() {
    document.getElementById('pdfFrame').src = '';
    document.getElementById('modalPDF').style.setProperty('display', 'none', 'important');
}
</script>
@endpush