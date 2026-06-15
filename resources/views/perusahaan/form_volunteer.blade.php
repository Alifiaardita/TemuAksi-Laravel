@extends('layouts.app')

@section('title', 'Buka Volunteer')

@section('content')
<div class="max-w-2xl mx-auto px-6 py-10">
    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-gray-800">Buka volunteer baru</h1>
        <p class="text-sm text-gray-500 mt-1">Isi detail kegiatan yang membutuhkan volunteer</p>
    </div>

    <form id="volunteer-form" action="{{ route('perusahaan.volunteer.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6" novalidate>
        @csrf

        {{-- FOTO / BANNER --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-widest mb-4">
                Foto / banner kegiatan <span class="text-red-500">*</span>
            </p>
            <div id="drop-area"
                class="border-2 border-dashed border-gray-200 rounded-xl p-8 text-center cursor-pointer bg-gray-50 hover:bg-gray-100 transition relative">
                <input type="file" name="foto" id="foto-input" accept="image/*"
                    class="absolute inset-0 opacity-0 cursor-pointer w-full h-full">
                <div id="foto-preview" class="hidden mb-4">
                    <img id="preview-img" class="max-w-full max-h-52 rounded-xl object-cover mx-auto">
                    <p class="text-xs text-gray-400 mt-2">Klik untuk ganti foto</p>
                </div>
                <div id="foto-placeholder">
                    <svg class="w-10 h-10 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-sm text-gray-500">Klik atau drag foto ke sini</p>
                    <p class="text-xs text-gray-400 mt-1">JPG, PNG — maks 5MB. Rekomendasi 1200×600px</p>
                </div>
            </div>
            <p id="error-foto" class="text-red-500 text-xs mt-1 hidden">Foto kegiatan wajib diisi.</p>
            @error('foto') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- INFORMASI KEGIATAN --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-widest mb-4">Informasi kegiatan</p>
            <div class="flex flex-col gap-4">
                <div>
                    <label class="text-sm text-gray-500 block mb-1">
                        Nama kegiatan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}"
                        placeholder="Contoh: Festival Lingkungan Hidup 2026"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30">
                    <p id="error-nama_kegiatan" class="text-red-500 text-xs mt-1 hidden">Nama kegiatan wajib diisi.</p>
                    @error('nama_kegiatan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="text-sm text-gray-500 block mb-1">Deskripsi kegiatan</label>
                    <textarea name="deskripsi" rows="3" placeholder="Ceritakan tentang kegiatan ini..."
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30 resize-none">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-gray-500 block mb-1">
                            Tanggal mulai <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30">
                        <p id="error-tanggal_mulai" class="text-red-500 text-xs mt-1 hidden">Tanggal mulai wajib diisi.</p>
                        @error('tanggal_mulai') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="text-sm text-gray-500 block mb-1">
                            Tanggal selesai <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30">
                        <p id="error-tanggal_selesai" class="text-red-500 text-xs mt-1 hidden">Tanggal selesai wajib diisi.</p>
                        @error('tanggal_selesai') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-gray-500 block mb-1">
                            Jam mulai <span class="text-red-500">*</span>
                        </label>
                        <input type="time" name="jam_mulai" value="{{ old('jam_mulai') }}"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30">
                        <p id="error-jam_mulai" class="text-red-500 text-xs mt-1 hidden">Jam mulai wajib diisi.</p>
                        @error('jam_mulai') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="text-sm text-gray-500 block mb-1">
                            Jam selesai <span class="text-red-500">*</span>
                        </label>
                        <input type="time" name="jam_selesai" value="{{ old('jam_selesai') }}"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30">
                        <p id="error-jam_selesai" class="text-red-500 text-xs mt-1 hidden">Jam selesai wajib diisi.</p>
                        @error('jam_selesai') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-gray-500 block mb-1">Kategori</label>
                        <select name="kategori"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30">
                            <option value="">Pilih kategori</option>
                            @foreach($kategori as $kat)
                                <option value="{{ $kat->id }}" {{ old('kategori') == $kat->id ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="text-sm text-gray-500 block mb-1">
                            Lokasi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="lokasi" value="{{ old('lokasi') }}"
                            placeholder="Kota / Online"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30">
                        <p id="error-lokasi" class="text-red-500 text-xs mt-1 hidden">Lokasi wajib diisi.</p>
                        @error('lokasi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- KEBUTUHAN VOLUNTEER --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-widest mb-4">Kebutuhan volunteer</p>
            <div class="flex flex-col gap-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-gray-500 block mb-1">
                            Jumlah dibutuhkan <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="jumlah_volunteer" value="{{ old('jumlah_volunteer') }}"
                            placeholder="Contoh: 20" min="1"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30">
                        <p id="error-jumlah_volunteer" class="text-red-500 text-xs mt-1 hidden">Jumlah volunteer wajib diisi.</p>
                        @error('jumlah_volunteer') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="text-sm text-gray-500 block mb-1">
                            Deadline daftar <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="deadline_daftar" value="{{ old('deadline_daftar') }}"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30">
                        <p id="error-deadline_daftar" class="text-red-500 text-xs mt-1 hidden">Deadline daftar wajib diisi.</p>
                        @error('deadline_daftar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div>
                    <label class="text-sm text-gray-500 block mb-1">
                        Divisi / posisi yang dibuka <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="divisi" value="{{ old('divisi') }}"
                        placeholder="Contoh: Dokumentasi, Humas, Acara"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30">
                    <p id="error-divisi" class="text-red-500 text-xs mt-1 hidden">Divisi wajib diisi.</p>
                    @error('divisi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="text-sm text-gray-500 block mb-1">Syarat & kriteria</label>
                    <textarea name="syarat" rows="3" placeholder="Contoh: Usia 18+, bisa bekerja dalam tim..."
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30 resize-none">{{ old('syarat') }}</textarea>
                    @error('syarat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- BENEFIT --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-widest mb-4">Benefit volunteer</p>
            <div class="flex flex-col gap-3">
                <label class="flex items-center gap-3 text-sm text-gray-700 cursor-pointer">
                    <input type="checkbox" name="benefit[]" value="sertifikat" class="rounded"> Sertifikat
                </label>
                <label class="flex items-center gap-3 text-sm text-gray-700 cursor-pointer">
                    <input type="checkbox" name="benefit[]" value="konsumsi" class="rounded"> Konsumsi
                </label>
                <label class="flex items-center gap-3 text-sm text-gray-700 cursor-pointer">
                    <input type="checkbox" name="benefit[]" value="merchandise" class="rounded"> Merchandise
                </label>
                <div>
                    <label class="text-sm text-gray-500 block mb-1">Benefit lainnya</label>
                    <input type="text" name="benefit_lain" value="{{ old('benefit_lain') }}"
                        placeholder="Contoh: networking, uang transport..."
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30">
                </div>
            </div>
        </div>

        {{-- KONTAK & BERKAS --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-widest mb-4">Kontak & Berkas</p>
            <div class="flex flex-col gap-4">
                <div>
                    <label class="text-sm text-gray-500 block mb-1">
                        Kontak person <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="kontak" value="{{ old('kontak') }}"
                        placeholder="Nomor WA / email PIC"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-cornflower/30">
                    <p id="error-kontak" class="text-red-500 text-xs mt-1 hidden">Kontak person wajib diisi.</p>
                    @error('kontak') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="text-sm text-gray-500 block mb-1">
                        Guidebook <span class="text-gray-400">(opsional)</span>
                    </label>
                    <input type="file" name="guidebook" accept=".pdf,.doc,.docx"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-500 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-cornflower/10 file:text-cornflower cursor-pointer focus:outline-none focus:ring-2 focus:ring-cornflower/30">
                    <p class="text-xs text-gray-400 mt-1">Format: PDF, DOC, DOCX</p>
                    @error('guidebook') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- TOMBOL --}}
        <div class="flex justify-end gap-3 pb-6">
            <a href="{{ route('perusahaan.dashboard') }}"
                class="px-6 py-2.5 text-sm text-gray-500 border border-gray-200 rounded-xl hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit"
                class="px-6 py-2.5 text-sm font-medium bg-cornflower text-white rounded-xl hover:opacity-90 transition">
                Kirim
            </button>
        </div>
    </form>
</div>

@push('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("input[name='jam_mulai']", {});
    flatpickr("input[name='jam_selesai']", {});
</script>
<script>
    // Preview foto
    const fotoInput = document.getElementById('foto-input');
    const fotoPreview = document.getElementById('foto-preview');
    const fotoPlaceholder = document.getElementById('foto-placeholder');
    const previewImg = document.getElementById('preview-img');

    fotoInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImg.src = e.target.result;
                fotoPreview.classList.remove('hidden');
                fotoPlaceholder.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

    // JS Validation
    document.getElementById('volunteer-form').addEventListener('submit', function (e) {
        let isValid = true;

        // Field wajib bertipe text/number/date/time
        const requiredFields = [
            { name: 'nama_kegiatan',     label: 'Nama kegiatan wajib diisi.' },
            { name: 'tanggal_mulai',     label: 'Tanggal mulai wajib diisi.' },
            { name: 'tanggal_selesai',   label: 'Tanggal selesai wajib diisi.' },
            { name: 'jam_mulai',         label: 'Jam mulai wajib diisi.' },
            { name: 'jam_selesai',       label: 'Jam selesai wajib diisi.' },
            { name: 'lokasi',            label: 'Lokasi wajib diisi.' },
            { name: 'jumlah_volunteer',  label: 'Jumlah volunteer wajib diisi.' },
            { name: 'deadline_daftar',   label: 'Deadline daftar wajib diisi.' },
            { name: 'divisi',            label: 'Divisi wajib diisi.' },
            { name: 'kontak',            label: 'Kontak person wajib diisi.' },
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

        // Cek foto
        const fotoErrorEl = document.getElementById('error-foto');
        if (!fotoInput.files || fotoInput.files.length === 0) {
            fotoErrorEl.classList.remove('hidden');
            isValid = false;
        } else {
            fotoErrorEl.classList.add('hidden');
        }

        if (!isValid) {
            e.preventDefault();
            // Scroll ke error pertama
            const firstError = document.querySelector('.text-red-500:not(.hidden)');
            if (firstError) firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });
</script>
@endpush
@endsection