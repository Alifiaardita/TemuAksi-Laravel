@extends('layouts.app')

@section('title', 'Daftar Proposal')

@section('content')
<main class="p-6 bg-canvas min-h-screen">

    <h1 class="text-2xl font-bold mb-6 text-cornflower">📥 Proposal Masuk</h1>

    <div class="overflow-x-auto bg-white rounded-xl shadow">
        <table class="w-full text-center">
            <thead class="bg-mist text-white">
                <tr>
                    <th class="p-3">Email</th>
                    <th class="p-3">Judul</th>
                    <th class="p-3">Proposal</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($proposals as $row)
                @php
                    $status = strtolower(trim($row->status));
                    $badge = match($status) {
                        'terkirim'  => 'bg-yellow-500',
                        'pendanaan' => 'bg-blue-500',
                        'selesai'   => 'bg-green-500',
                        'ditolak'   => 'bg-red-500',
                        default     => 'bg-gray-400'
                    };
                @endphp
                <tr class="border-b hover:bg-pear/30">
                    <td class="p-3">{{ $row->user->email ?? '-' }}</td>
                    <td class="p-3">{{ $row->judul }}</td>

                    {{-- PDF --}}
                    <td class="p-3">
                        @if(!empty($row->file_proposal))
                            <button onclick="lihatPDF('{{ $row->file_proposal }}')"
                                class="bg-blue-500 text-white px-3 py-1 rounded hover:opacity-80">
                                Lihat
                            </button>
                        @else
                            -
                        @endif
                    </td>

                    {{-- STATUS --}}
                    <td class="p-3">
                        <span class="px-3 py-1 rounded text-white text-sm {{ $badge }}">
                            {{ ucfirst($status) }}
                        </span>
                    </td>

                    {{-- AKSI --}}
                    <td class="p-3">
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
                        )" class="bg-cornflower text-white px-3 py-1 rounded">
                            Detail
                        </button>
                    </td>

                    <form method="POST" action="{{ route('perusahaan.proposal.destroy', $row->id) }}"
                        onsubmit="return confirm('Yakin hapus proposal ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 text-white px-3 py-1 rounded">
                            Hapus
                        </button>
                    </form>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-6 text-gray-400">Belum ada proposal masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</main>

{{-- MODAL DETAIL --}}
<div id="modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-40">
    <div class="bg-white p-6 rounded-xl w-full max-w-md relative">
        <button onclick="closeModal()" class="absolute top-2 right-3 text-xl">×</button>
        <h2 class="text-xl font-bold mb-4">Detail Proposal</h2>
        <div class="space-y-2 text-sm">
            <p><b>Email:</b> <span id="dEmail"></span></p>
            <p><b>Judul:</b> <span id="dJudul"></span></p>
            <p><b>Deskripsi:</b> <span id="dDeskripsi"></span></p>
            <p><b>Kategori:</b> <span id="dKategori"></span></p>
            <p><b>Lokasi:</b> <span id="dLokasi"></span></p>
            <p><b>Tanggal:</b> <span id="dTanggal"></span></p>
            <p><b>Target:</b> Rp <span id="dTarget"></span></p>
        </div>
        <div id="actionArea" class="mt-5 flex gap-2"></div>
    </div>
</div>

{{-- MODAL PDF --}}
<div id="modalPDF" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">
    <div class="bg-white w-11/12 max-w-5xl h-[85vh] rounded-2xl relative p-4 shadow-lg">
        <button onclick="closePDF()" class="absolute top-3 right-4 text-2xl font-bold">×</button>
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