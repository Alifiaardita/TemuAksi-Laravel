@extends('layouts.app')
@section('content')

<section class="max-w-3xl mx-auto px-6 mt-6 mb-20">

    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('perusahaan.sponsor.index') }}"
                class="flex items-center justify-center w-9 h-9 rounded-xl border border-gray-200 text-gray-500 hover:bg-gray-50 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h2 class="text-lg font-bold text-gray-900">Detail Program Sponsor</h2>
        </div>
        <button onclick="document.getElementById('modalEditSponsor').classList.remove('hidden')"
            class="flex items-center gap-2 bg-cornflower text-white text-sm font-semibold px-4 py-2 rounded-xl hover:opacity-90 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Edit
        </button>
    </div>

    @if($errors->any())
    <div class="bg-red-50 text-red-600 text-sm rounded-xl p-4 mb-4">
        <ul class="list-disc pl-5 space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- ===== CARD INFO DETAIL SPONSOR (read-only) ===== --}}
    <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
        <div class="flex items-start justify-between mb-5">
            <div>
                <h3 class="text-xl font-bold text-gray-900">{{ $sponsor->nama }}</h3>
                <p class="text-sm text-gray-400 mt-0.5">{{ $sponsor->industri ?? '—' }}</p>
            </div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200 shrink-0">
                {{ $sponsor->kategori->nama_kategori ?? '—' }}
            </span>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div class="bg-[#f7f9fc] rounded-xl p-4">
                <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Lokasi</p>
                <p class="text-sm font-semibold text-gray-900">{{ $sponsor->lokasi ?? '—' }}</p>
            </div>
            <div class="bg-[#f7f9fc] rounded-xl p-4">
                <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Rentang Dana</p>
                <p class="text-sm font-semibold text-gray-900">
                    Rp {{ number_format($sponsor->min_dana, 0, ',', '.') }} &ndash; Rp {{ number_format($sponsor->max_dana, 0, ',', '.') }}
                </p>
            </div>
            <div class="bg-[#f7f9fc] rounded-xl p-4">
                <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Wilayah</p>
                <p class="text-sm font-semibold text-gray-900">{{ $sponsor->wilayah ?? '—' }}</p>
            </div>
            <div class="bg-[#f7f9fc] rounded-xl p-4">
                <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Periode</p>
                <p class="text-sm font-semibold text-gray-900">
                    {{ $sponsor->tanggal_buka ? \Carbon\Carbon::parse($sponsor->tanggal_buka)->format('d M Y') : '—' }}
                    —
                    {{ $sponsor->tanggal_tutup ? \Carbon\Carbon::parse($sponsor->tanggal_tutup)->format('d M Y') : '—' }}
                </p>
            </div>
        </div>

        <div class="mb-4">
            <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Deskripsi</p>
            <p class="text-sm text-gray-700 leading-relaxed">{{ $sponsor->deskripsi }}</p>
        </div>

        @if(!empty($sponsor->syarat))
        <div class="mb-4">
            <p class="text-xs text-gray-400 uppercase tracking-wide mb-2">Syarat Pengaju</p>
            <ul class="space-y-1">
                @foreach($sponsor->syarat as $item)
                <li class="flex items-start gap-2 text-sm text-gray-700">
                    <span class="text-cornflower mt-0.5">✓</span> {{ $item }}
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(!empty($sponsor->dokumen))
        <div class="mb-4">
            <p class="text-xs text-gray-400 uppercase tracking-wide mb-2">Dokumen Wajib</p>
            <ul class="space-y-1">
                @foreach($sponsor->dokumen as $item)
                <li class="flex items-start gap-2 text-sm text-gray-700">
                    <span class="text-cornflower mt-0.5">📄</span> {{ $item }}
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(!empty($sponsor->benefit))
        <div>
            <p class="text-xs text-gray-400 uppercase tracking-wide mb-2">Benefit yang Diharapkan</p>
            <ul class="space-y-1">
                @foreach($sponsor->benefit as $item)
                <li class="flex items-start gap-2 text-sm text-gray-700">
                    <span class="text-cornflower mt-0.5">★</span> {{ $item }}
                </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    {{-- ===== TABEL PROPOSAL MASUK ===== --}}
    <div class="bg-white rounded-2xl shadow-sm p-6">
        <h3 class="text-base font-bold text-gray-900 mb-4">Proposal Masuk untuk Program Ini</h3>

        @if($proposals->isEmpty())
            <p class="text-sm text-gray-400 text-center py-8">Belum ada proposal masuk untuk program ini.</p>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-[#f0f2f8]">
                        <th class="px-4 py-3 text-xs font-semibold uppercase text-gray-400 rounded-tl-xl">Email</th>
                        <th class="px-4 py-3 text-xs font-semibold uppercase text-gray-400">Judul</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold uppercase text-gray-400">Proposal</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold uppercase text-gray-400 rounded-tr-xl">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($proposals as $row)
                    @php
                        $status = strtolower(trim($row->status));
                        $badge = match($status) {
                            'terkirim'  => 'bg-yellow-50 text-yellow-700 border border-yellow-200',
                            'pendanaan' => 'bg-blue-50 text-blue-700 border border-blue-200',
                            'selesai'   => 'bg-green-50 text-green-700 border border-green-200',
                            'ditolak'   => 'bg-red-50 text-red-700 border border-red-200',
                            default     => 'bg-gray-50 text-gray-600 border border-gray-200',
                        };
                        $label = match($status) {
                            'terkirim'  => 'Menunggu',
                            'pendanaan' => 'Didanai',
                            'selesai'   => 'Selesai',
                            'ditolak'   => 'Ditolak',
                            default     => ucfirst($status)
                        };
                    @endphp
                    <tr class="hover:bg-[#f8f9ff] transition">
                        <td class="px-4 py-3 text-gray-700 truncate max-w-[180px]" title="{{ $row->user->email ?? '-' }}">
                            {{ $row->user->email ?? '-' }}
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-900 truncate max-w-[220px]" title="{{ $row->judul }}">
                            {{ $row->judul }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if(!empty($row->file_proposal))
                                <button onclick="lihatPDF('{{ $row->file_proposal }}')"
                                    class="text-[#4a6cf7] text-xs font-semibold hover:underline">
                                    Lihat PDF
                                </button>
                            @else
                                <span class="text-gray-300 text-xs">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ $badge }}">
                                {{ $label }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    {{-- ===== MODAL EDIT SPONSOR ===== --}}
    <div id="modalEditSponsor" class="hidden fixed inset-0 bg-black/40 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h3 class="text-base font-bold text-gray-900">Edit Program Sponsor</h3>
                <button onclick="document.getElementById('modalEditSponsor').classList.add('hidden')"
                    class="text-gray-400 hover:text-gray-600 text-2xl leading-none">&times;</button>
            </div>

            <form action="{{ route('perusahaan.sponsor.update', $sponsor->id) }}" method="POST" class="p-6 space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Program</label>
                    <input type="text" name="nama" value="{{ old('nama', $sponsor->nama) }}"
                           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cornflower focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Industri</label>
                    <input type="text" name="industri" value="{{ old('industri', $sponsor->industri) }}"
                           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cornflower focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori</label>
                    <select name="kategori_id" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cornflower focus:outline-none">
                        @foreach($kategoriList as $kategori)
                            <option value="{{ $kategori->id }}" {{ $sponsor->kategori_id == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Lokasi</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi', $sponsor->lokasi) }}"
                           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cornflower focus:outline-none">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Dana Minimum (Rp)</label>
                        <input type="number" name="min_dana" value="{{ old('min_dana', $sponsor->min_dana) }}"
                               class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cornflower focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Dana Maksimum (Rp)</label>
                        <input type="number" name="max_dana" value="{{ old('max_dana', $sponsor->max_dana) }}"
                               class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cornflower focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="4"
                              class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cornflower focus:outline-none">{{ old('deskripsi', $sponsor->deskripsi) }}</textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Buka</label>
                        <input type="date" name="tanggal_buka" value="{{ old('tanggal_buka', $sponsor->tanggal_buka) }}"
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cornflower focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Tutup</label>
                        <input type="date" name="tanggal_tutup" value="{{ old('tanggal_tutup', $sponsor->tanggal_tutup) }}"
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cornflower focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Wilayah</label>
                    <select name="wilayah" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cornflower focus:outline-none">
                        <option value="">— Semua wilayah —</option>
                        @foreach(['Seluruh Indonesia','Jawa','Sumatera','Kalimantan','Sulawesi','Bali & Nusa Tenggara','Papua & Maluku'] as $w)
                            <option value="{{ $w }}" {{ old('wilayah', $sponsor->wilayah) == $w ? 'selected' : '' }}>{{ $w }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center justify-end gap-3 pt-2">
                    <button type="button" onclick="document.getElementById('modalEditSponsor').classList.add('hidden')"
                        class="text-sm text-gray-500 hover:underline">
                        Batal
                    </button>
                    <button type="submit" class="bg-cornflower text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:opacity-90 transition">
                        Simpan Perubahan
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

    @push('scripts')
    <script>
    function lihatPDF(file) {
        document.getElementById('pdfFrame').src = '/storage/' + file;
        document.getElementById('modalPDF').style.display = 'flex';
    }
    function closePDF() {
        document.getElementById('pdfFrame').src = '';
        document.getElementById('modalPDF').style.setProperty('display', 'none', 'important');
    }

    // Buka modal edit otomatis jika ada error validasi
    @if($errors->any())
        document.getElementById('modalEditSponsor').classList.remove('hidden');
    @endif
    </script>
    @endpush

</section>

@endsection