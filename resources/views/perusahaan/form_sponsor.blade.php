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

        <form id="sponsor-form" method="POST" action="{{ route('perusahaan.sponsor.store') }}" class="space-y-5" novalidate>
            @csrf

            {{-- Card 1: Info Program --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
                <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wide flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
                    Informasi program
                </h2>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Nama program <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama" value="{{ old('nama') }}"
                        placeholder="cth: Open Sponsorship Festival Inovasi 2025"
                        class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30 focus:border-cornflower transition">
                    <p id="error-nama" class="text-red-500 text-xs mt-1 hidden">Nama program wajib diisi.</p>
                    @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Kategori acara <span class="text-red-500">*</span>
                        </label>
                        <select name="kategori_id"
                            class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30 focus:border-cornflower transition">
                            <option value="">— Pilih kategori —</option>
                            @foreach($kategori as $k)
                                <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        <p id="error-kategori_id" class="text-red-500 text-xs mt-1 hidden">Kategori acara wajib dipilih.</p>
                        @error('kategori_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
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
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Deskripsi program <span class="text-red-500">*</span>
                    </label>
                    <textarea name="deskripsi" rows="4"
                        placeholder="Jelaskan tujuan program, siapa yang bisa melamar, dan apa yang diharapkan perusahaan dari mitra..."
                        class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30 focus:border-cornflower transition resize-none">{{ old('deskripsi') }}</textarea>
                    <p id="error-deskripsi" class="text-red-500 text-xs mt-1 hidden">Deskripsi program wajib diisi.</p>
                    @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
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
                            class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30 focus:border-cornflower transition">
                        <span class="text-gray-400 text-sm flex-shrink-0">—</span>
                        <input type="text" name="max_dana" value="{{ old('max_dana') }}"
                            placeholder="Maksimal, cth: 50.000.000"
                            class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30 focus:border-cornflower transition">
                    </div>
                    <p id="error-min_dana" class="text-red-500 text-xs mt-1 hidden">Dana minimal wajib diisi.</p>
                    <p id="error-max_dana" class="text-red-500 text-xs mt-1 hidden">Dana maksimal wajib diisi.</p>
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
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Tanggal buka <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal_buka" value="{{ old('tanggal_buka') }}"
                            class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30 focus:border-cornflower transition">
                        <p id="error-tanggal_buka" class="text-red-500 text-xs mt-1 hidden">Tanggal buka wajib diisi.</p>
                        @error('tanggal_buka') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Deadline pengajuan <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal_tutup" value="{{ old('tanggal_tutup') }}"
                            class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30 focus:border-cornflower transition">
                        <p id="error-tanggal_tutup" class="text-red-500 text-xs mt-1 hidden">Deadline pengajuan wajib diisi.</p>
                        @error('tanggal_tutup') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
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
                    Syarat mitra & dokumen
                </h2>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Syarat pengaju</label>
                    <textarea name="syarat_text" rows="3"
                        placeholder="Pisahkan setiap syarat dengan enter..."
                        class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30 focus:border-cornflower transition">{{ old('syarat_text') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Dokumen wajib dilampirkan</label>
                    <textarea name="dokumen_text" rows="3"
                        placeholder="Pisahkan setiap dokumen dengan enter..."
                        class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30 focus:border-cornflower transition">{{ old('dokumen_text') }}</textarea>
                </div>
            </div>

            {{-- Card 5: Benefit --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
                <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wide flex items-center gap-2">
                    Benefit yang diharapkan
                </h2>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Benefit</label>
                    <textarea name="benefit_text" rows="3"
                        placeholder="Pisahkan setiap benefit dengan enter..."
                        class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30 focus:border-cornflower transition">{{ old('benefit_text') }}</textarea>
                </div>
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

<script>
    document.getElementById('sponsor-form').addEventListener('submit', function (e) {
        let isValid = true;

        const requiredFields = [
            { name: 'nama',          label: 'Nama program wajib diisi.' },
            { name: 'kategori_id',   label: 'Kategori acara wajib dipilih.' },
            { name: 'deskripsi',     label: 'Deskripsi program wajib diisi.' },
            { name: 'min_dana',      label: 'Dana minimal wajib diisi.' },
            { name: 'max_dana',      label: 'Dana maksimal wajib diisi.' },
            { name: 'tanggal_buka',  label: 'Tanggal buka wajib diisi.' },
            { name: 'tanggal_tutup', label: 'Deadline pengajuan wajib diisi.' },
        ];

        requiredFields.forEach(function (field) {
            const input = document.querySelector(`[name="${field.name}"]`);
            const errorEl = document.getElementById(`error-${field.name}`);
            if (!input || !input.value.trim()) {
                if (errorEl) errorEl.classList.remove('hidden');
                isValid = false;
            } else {
                if (errorEl) errorEl.classList.add('hidden');
            }
        });

        if (!isValid) {
            e.preventDefault();
            const firstError = document.querySelector('.text-red-500:not(.hidden)');
            if (firstError) firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });
</script>

@endsection