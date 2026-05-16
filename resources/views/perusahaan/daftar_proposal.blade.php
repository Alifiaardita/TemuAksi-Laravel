@extends('layouts.app')

@section('title', 'Daftar Proposal')

@section('content')
<main class="min-h-screen p-6">

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

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-semibold" style="color: #081F5C;">Proposal Masuk</h1>
        </div>
        <select class="text-sm px-3 py-2 rounded-lg border" style="border-color: #b8cde8; color: #081F5C; background: #fff;">
            <option>Semua status</option>
            <option>Menunggu</option>
            <option>Didanai</option>
            <option>Selesai</option>
            <option>Ditolak</option>
        </select>
    </div>

    {{-- TABEL --}}
    <div class="bg-white rounded-xl overflow-hidden border" style="border-color: #dce6f0;">
        <table class="w-full text-sm">
            <thead>
                <tr style="background: #081F5C;">
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-white">Email</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-white">Judul</th>
                    <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider text-white">Proposal</th>
                    <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider text-white">Status</th>
                    <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider text-white">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y" style="divide-color: #dce6f0;">
                @forelse($proposals as $row)
                @php
                    $status = strtolower(trim($row->status));
                    $badgeStyle = match($status) {
                        'terkirim'  => 'background:#FFF3CD; color:#856404;',
                        'pendanaan' => 'background:#D0E3FF; color:#081F5C;',
                        'selesai'   => 'background:#d4edda; color:#155724;',
                        'ditolak'   => 'background:#f8d7da; color:#721c24;',
                        default     => 'background:#e2e8f0; color:#475569;'
                    };
                    $label = match($status) {
                        'terkirim'  => 'Menunggu',
                        'pendanaan' => 'Didanai',
                        'selesai'   => 'Selesai',
                        'ditolak'   => 'Ditolak',
                        default     => ucfirst($status)
                    };
                @endphp
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 py-3" style="color: #7096D1;">{{ $row->user->email ?? '-' }}</td>
                    <td class="px-4 py-3 font-medium" style="color: #081F5C;">{{ $row->judul }}</td>

                    {{-- PDF --}}
                    <td class="px-4 py-3 text-center">
                        @if(!empty($row->file_proposal))
                            <button onclick="lihatPDF('{{ $row->file_proposal }}')"
                                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-medium text-white transition hover:opacity-80"
                                style="background: #7096D1;">
                                Lihat
                            </button>
                        @else
                            <span style="color: #7096D1;">-</span>
                        @endif
                    </td>

                    {{-- STATUS --}}
                    <td class="px-4 py-3 text-center">
                        <span class="px-3 py-1 rounded-full text-xs font-medium" style="{{ $badgeStyle }}">
                            {{ $label }}
                        </span>
                    </td>

                    {{-- AKSI --}}
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick="lihatDetail(
                                '{{ $row->id }}',
                                '{{ addslashes($row->user->email ?? '') }}',
                                '{{ addslashes($row->judul) }}',
                                '{{ addslashes($row->deskripsi) }}',
                                '{{ addslashes($row->kategori) }}',
                                '{{ addslashes($row->lokasi) }}',
                                '{{ $row->tanggal }}',
                                '{{ number_format($row->target_dana, 0, ',', '.') }}',
                                '{{ $status }}'
                            )" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-medium border transition hover:opacity-80"
                               style="border-color: #b8cde8; color: #081F5C;">
                                Detail
                            </button>

                            <form method="POST" action="{{ route('perusahaan.proposal.destroy', $row->id) }}"
                                onsubmit="return confirm('Yakin hapus proposal ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-2.5 py-1.5 rounded-lg text-xs font-medium border transition"
                                    style="border-color: #f5c2c7; color: #721c24;">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-10 text-center text-sm" style="color: #7096D1;">
                        Belum ada proposal masuk.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</main>

{{-- MODAL DETAIL --}}
<div id="modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-40">
    <div class="bg-white rounded-xl w-full max-w-md relative overflow-hidden">
        <div class="px-6 py-4 text-white" style="background: #081F5C;">
            <h2 class="text-base font-semibold">Detail Proposal</h2>
            <button onclick="closeModal()" class="absolute top-3 right-4 text-white text-xl leading-none">×</button>
        </div>
        <div class="p-6 space-y-3 text-sm">
            <div class="border-b pb-2" style="border-color: #dce6f0;">
                <p class="text-xs uppercase tracking-wide mb-1" style="color: #7096D1;">Email</p>
                <p class="font-medium" style="color: #081F5C;" id="dEmail"></p>
            </div>
            <div class="border-b pb-2" style="border-color: #dce6f0;">
                <p class="text-xs uppercase tracking-wide mb-1" style="color: #7096D1;">Judul</p>
                <p class="font-medium" style="color: #081F5C;" id="dJudul"></p>
            </div>
            <div class="border-b pb-2" style="border-color: #dce6f0;">
                <p class="text-xs uppercase tracking-wide mb-1" style="color: #7096D1;">Kategori</p>
                <p class="font-medium" style="color: #081F5C;" id="dKategori"></p>
            </div>
            <div class="border-b pb-2" style="border-color: #dce6f0;">
                <p class="text-xs uppercase tracking-wide mb-1" style="color: #7096D1;">Lokasi</p>
                <p class="font-medium" style="color: #081F5C;" id="dLokasi"></p>
            </div>
            <div class="border-b pb-2" style="border-color: #dce6f0;">
                <p class="text-xs uppercase tracking-wide mb-1" style="color: #7096D1;">Tanggal</p>
                <p class="font-medium" style="color: #081F5C;" id="dTanggal"></p>
            </div>
            <div class="border-b pb-2" style="border-color: #dce6f0;">
                <p class="text-xs uppercase tracking-wide mb-1" style="color: #7096D1;">Target Dana</p>
                <p class="font-medium" style="color: #081F5C;">Rp <span id="dTarget"></span></p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-wide mb-1" style="color: #7096D1;">Deskripsi</p>
                <p style="color: #7096D1;" id="dDeskripsi"></p>
            </div>
        </div>
        <div id="actionArea" class="px-6 pb-5 flex gap-2"></div>
    </div>
</div>

{{-- MODAL PDF --}}
<div id="modalPDF" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">
    <div class="bg-white w-11/12 max-w-5xl h-[85vh] rounded-2xl relative p-4 shadow-lg">
        <button onclick="closePDF()" class="absolute top-3 right-4 text-2xl font-bold" style="color: #081F5C;">×</button>
        <iframe id="pdfFrame" class="w-full h-full rounded-xl"></iframe>
    </div>
</div>

@endsection

@push('scripts')
<script>
function lihatDetail(id, email, judul, deskripsi, kategori, lokasi, tanggal, target, status) {
    document.getElementById('dEmail').innerText     = email;
    document.getElementById('dJudul').innerText     = judul;
    document.getElementById('dDeskripsi').innerText = deskripsi;
    document.getElementById('dKategori').innerText  = kategori;
    document.getElementById('dLokasi').innerText    = lokasi;
    document.getElementById('dTanggal').innerText   = tanggal;
    document.getElementById('dTarget').innerText    = target;

    const modal = document.getElementById('modal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeModal() {
    const modal = document.getElementById('modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function lihatPDF(file) {
    document.getElementById('pdfFrame').src = '/storage/' + file;
    const modal = document.getElementById('modalPDF');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closePDF() {
    document.getElementById('pdfFrame').src = '';
    const modal = document.getElementById('modalPDF');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
@endpush