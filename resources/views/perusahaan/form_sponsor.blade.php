@extends('layouts.app')
@section('title', 'Buka Sponsorship')
@section('content')

<div class="min-h-screen bg-canvas p-6 md:p-10">
    <div class="max-w-2xl mx-auto space-y-5">

        {{-- Header --}}
        <div class="mb-2">
            <h1 class="text-2xl font-bold text-gray-900">Buka Program Sponsorship</h1>
            <p class="text-sm text-gray-500 mt-1">Program ini akan tampil di halaman mitra dan dapat dilamar dengan proposal</p>
        </div>

        {{-- Error Messages --}}
        @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 rounded-2xl px-4 py-3 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('perusahaan.sponsor.store') }}" class="space-y-5">
            @csrf

            {{-- Card 1: Info Program --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
                <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wide flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
                    Informasi program
                </h2>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama program <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" value="{{ old('nama') }}"
                        placeholder="cth: Open Sponsorship Festival Inovasi 2025"
                        class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30 focus:border-cornflower transition"
                        required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Kategori acara <span class="text-red-500">*</span></label>
                        <select name="kategori_id"
                            class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30 focus:border-cornflower transition"
                            required>
                            <option value="">— Pilih kategori —</option>
                            @foreach($kategori as $k)
                                <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Industri</label>
                        <input type="text" name="industri" value="{{ old('industri') }}"
                            placeholder="cth: Tech, F&B, Retail"
                            class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30 focus:border-cornflower transition">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Lokasi acara yang diterima</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi') }}"
                        placeholder="cth: Surabaya, Jawa Timur"
                        class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30 focus:border-cornflower transition">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi program <span class="text-red-500">*</span></label>
                    <textarea name="deskripsi" rows="4"
                        placeholder="Jelaskan tujuan program, siapa yang bisa melamar, dan apa yang diharapkan perusahaan dari mitra..."
                        class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30 focus:border-cornflower transition resize-none"
                        required>{{ old('deskripsi') }}</textarea>
                </div>
            </div>

            {{-- Card 2: Dana --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
                <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wide flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                    Dana sponsorship
                </h2>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Rentang dana yang dapat diajukan (Rp) <span class="text-red-500">*</span>
                    </label>
                    <div class="flex items-center gap-3">
                        <input type="text" name="min_dana" value="{{ old('min_dana') }}"
                            placeholder="Minimal, cth: 5.000.000"
                            class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30 focus:border-cornflower transition"
                            required>
                        <span class="text-gray-400 text-sm flex-shrink-0">—</span>
                        <input type="text" name="max_dana" value="{{ old('max_dana') }}"
                            placeholder="Maksimal, cth: 50.000.000"
                            class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30 focus:border-cornflower transition"
                            required>
                    </div>
                    <p class="text-xs text-gray-400 mt-1.5">Mitra dapat mengajukan dana di antara rentang ini</p>
                </div>
            </div>

            {{-- Card 3: Periode --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
                <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wide flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/></svg>
                    Periode pendaftaran
                </h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal buka <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_buka" value="{{ old('tanggal_buka') }}"
                            class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30 focus:border-cornflower transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Deadline pengajuan <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_tutup" value="{{ old('tanggal_tutup') }}"
                            class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30 focus:border-cornflower transition">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Wilayah acara yang diterima</label>
                    <select name="wilayah" class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30 focus:border-cornflower transition">
                        <option value="">— Semua wilayah —</option>
                        <option value="Seluruh Indonesia" {{ old('wilayah') == 'Seluruh Indonesia' ? 'selected' : '' }}>Seluruh Indonesia</option>
                        <option value="Jawa" {{ old('wilayah') == 'Jawa' ? 'selected' : '' }}>Jawa</option>
                        <option value="Sumatera" {{ old('wilayah') == 'Sumatera' ? 'selected' : '' }}>Sumatera</option>
                        <option value="Kalimantan" {{ old('wilayah') == 'Kalimantan' ? 'selected' : '' }}>Kalimantan</option>
                        <option value="Sulawesi" {{ old('wilayah') == 'Sulawesi' ? 'selected' : '' }}>Sulawesi</option>
                        <option value="Bali & Nusa Tenggara" {{ old('wilayah') == 'Bali & Nusa Tenggara' ? 'selected' : '' }}>Bali & Nusa Tenggara</option>
                        <option value="Papua & Maluku" {{ old('wilayah') == 'Papua & Maluku' ? 'selected' : '' }}>Papua & Maluku</option>
                    </select>
                </div>
            </div>

            {{-- Card 4: Syarat & Dokumen --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
                <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wide flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"/></svg>
                    Syarat mitra & dokumen
                </h2>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Syarat pengaju</label>
                    <div id="syarat-list" class="space-y-2 mb-2"></div>
                    <button type="button" onclick="addSyarat()"
                        class="inline-flex items-center gap-1.5 text-sm text-cornflower border border-dashed border-cornflower/50 px-3.5 py-2 rounded-xl hover:bg-cornflower/5 transition">
                        + Tambah syarat
                    </button>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Dokumen wajib dilampirkan</label>
                    <div id="dok-list" class="space-y-2 mb-2"></div>
                    <button type="button" onclick="addDok()"
                        class="inline-flex items-center gap-1.5 text-sm text-cornflower border border-dashed border-cornflower/50 px-3.5 py-2 rounded-xl hover:bg-cornflower/5 transition">
                        + Tambah dokumen
                    </button>
                </div>
            </div>

            {{-- Card 5: Benefit yang Diharapkan --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
                <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wide flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/></svg>
                    Benefit yang diharapkan
                </h2>

                <p class="text-xs text-gray-400 -mt-1">Apa yang perusahaan harapkan sebagai timbal balik dari mitra acara</p>

                <div id="benefit-list" class="space-y-2 mb-2"></div>
                <button type="button" onclick="addBenefit()"
                    class="inline-flex items-center gap-1.5 text-sm text-cornflower border border-dashed border-cornflower/50 px-3.5 py-2 rounded-xl hover:bg-cornflower/5 transition">
                    + Tambah benefit
                </button>
            </div>

            {{-- Submit --}}
            <div class="flex gap-3">
                <a href="{{ route('perusahaan.dashboard') }}"
                    class="px-5 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-600 hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit"
                    class="flex-1 bg-cornflower hover:bg-cornflower/90 text-white py-2.5 rounded-xl text-sm font-medium transition flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"/></svg>
                    Publikasikan program
                </button>
            </div>

        </form>
    </div>
</div>

@endsection
@push('scripts')
<script>
    var syarats  = ['Organisasi/komunitas terdaftar resmi', 'Acara dilaksanakan di wilayah Indonesia'];
    var doks     = ['Surat proposal resmi (PDF)', 'Rencana anggaran biaya (RAB)', 'Profil organisasi'];
    var benefits = ['Penempatan logo di materi promosi acara', 'Sebutan sponsor di pembukaan & penutupan acara', 'Laporan pasca acara (dokumentasi & data audiens)'];

    function renderList(items, containerId, removeFn) {
        const arrayName = removeFn === 'removeSyarat' ? 'syarats' : removeFn === 'removeDok' ? 'doks' : 'benefits';
        const el = document.getElementById(containerId);
        el.innerHTML = '';
        items.forEach((val, i) => {
            el.innerHTML += `
                <div class="flex items-center gap-2">
                    <input type="text" value="${val}"
                        oninput="${arrayName}[${i}] = this.value"
                        placeholder="Isi..."
                        class="flex-1 px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30 focus:border-cornflower transition">
                    <button type="button" onclick="${removeFn}(${i})"
                        class="p-2 text-gray-300 hover:text-red-400 hover:bg-red-50 rounded-xl transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                    </button>
                </div>`;
        });
    }

    function addSyarat()   { syarats.push('');   renderList(syarats,   'syarat-list',  'removeSyarat'); }
    function removeSyarat(i) { syarats.splice(i, 1); renderList(syarats, 'syarat-list', 'removeSyarat'); }

    function addDok()      { doks.push('');      renderList(doks,      'dok-list',     'removeDok'); }
    function removeDok(i)  { doks.splice(i, 1);  renderList(doks,      'dok-list',     'removeDok'); }

    function addBenefit()     { benefits.push('');     renderList(benefits, 'benefit-list', 'removeBenefit'); }
    function removeBenefit(i) { benefits.splice(i, 1); renderList(benefits, 'benefit-list', 'removeBenefit'); }

    renderList(syarats,  'syarat-list',  'removeSyarat');
    renderList(doks,     'dok-list',     'removeDok');
    renderList(benefits, 'benefit-list', 'removeBenefit');

    document.querySelector('form').addEventListener('submit', function() {
        syarats.forEach((val, i) => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = `syarat[${i}]`;
            input.value = val;
            this.appendChild(input);
        });
        doks.forEach((val, i) => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = `dokumen[${i}]`;
            input.value = val;
            this.appendChild(input);
        });
        benefits.forEach((val, i) => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = `benefit[${i}]`;
            input.value = val;
            this.appendChild(input);
        });
    });
</script>
@endpush

