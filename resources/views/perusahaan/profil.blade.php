@extends('layouts.app')

@section('title', 'Profil Perusahaan')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
@endpush

@section('content')
<main class="min-h-screen py-10 bg-gray-50">
    <div class="max-w-2xl mx-auto px-4 flex flex-col gap-4">

        @if(session('success'))
            <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl px-4 py-3 text-sm">
                <i class="ti ti-circle-check text-emerald-500 text-lg"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- BANNER --}}
        <div class="relative rounded-2xl overflow-hidden bg-[#0f1f3d] px-7 pt-7 pb-5">

            {{-- dot pattern --}}
            <div class="absolute inset-0"
                style="background-image:radial-gradient(circle,rgba(255,255,255,.06) 1px,transparent 1px);background-size:22px 22px;pointer-events:none"></div>

            {{-- decorative rings --}}
            <div class="absolute -top-12 -right-12 w-44 h-44 rounded-full border border-blue-400/20 pointer-events-none"></div>
            <div class="absolute -top-5 -right-5 w-28 h-28 rounded-full border border-blue-400/10 pointer-events-none"></div>

            {{-- Avatar & badge verifikasi --}}
            <div class="relative flex items-start justify-between mb-5">
                <div class="relative inline-block">
                    @php
                        $avatarName = $company->nama_perusahaan ?? 'Perusahaan';
                        $avatar = 'https://ui-avatars.com/api/?name=' . urlencode($avatarName) . '&background=1e3a6e&color=60a5fa&size=200';
                    @endphp
                    <img src="{{ $avatar }}" alt="Avatar" class="w-20 h-20 rounded-full object-cover border-2 border-white/20">
                    <div class="absolute bottom-0.5 right-0.5 w-6 h-6 rounded-full bg-blue-500 border-2 border-[#0f1f3d] flex items-center justify-center">
                        <i class="ti ti-camera text-white text-[10px]"></i>
                    </div>
                </div>
                <span class="flex items-center gap-1.5 text-xs font-medium text-emerald-400 bg-emerald-400/10 border border-emerald-400/25 rounded-full px-3 py-1.5">
                    <i class="ti ti-circle-check text-sm"></i>Terverifikasi
                </span>
            </div>

            {{-- Nama & email --}}
            <p class="text-white text-xl font-semibold mb-1">{{ $company->nama_perusahaan ?? 'Nama Perusahaan' }}</p>
            <p class="text-white/50 text-sm">{{ $user->email ?? 'email@perusahaan.com' }}</p>

            {{-- Chips --}}
            <div class="flex flex-wrap gap-2 mt-4">
                @if($company->bidang_industri)
                <span class="flex items-center gap-1.5 text-xs text-white/65 bg-white/[.07] border border-white/10 rounded-full px-3.5 py-1.5">
                    <i class="ti ti-building text-white/40 text-sm"></i>{{ $company->bidang_industri }}
                </span>
                @endif
                @if($company->alamat)
                <span class="flex items-center gap-1.5 text-xs text-white/65 bg-white/[.07] border border-white/10 rounded-full px-3.5 py-1.5">
                    <i class="ti ti-map-pin text-white/40 text-sm"></i>{{ $company->alamat }}
                </span>
                @endif
                @if($company->website)
                <span class="flex items-center gap-1.5 text-xs text-white/65 bg-white/[.07] border border-white/10 rounded-full px-3.5 py-1.5">
                    <i class="ti ti-world text-white/40 text-sm"></i>{{ $company->website }}
                </span>
                @endif
            </div>
        </div>

        {{-- CARD: INFORMASI PERUSAHAAN --}}
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">

            {{-- Header kartu --}}
            <div class="flex items-center gap-2.5 px-5 py-4 border-b border-gray-100">
                <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600">
                    <i class="ti ti-building-community text-base"></i>
                </div>
                <span class="text-sm font-medium text-gray-800">Informasi perusahaan</span>
            </div>

            {{-- Grid info --}}
            <div class="grid grid-cols-2 divide-x divide-gray-100 border-b border-gray-100">
                <div class="px-5 py-4">
                    <p class="flex items-center gap-1.5 text-[11px] font-medium tracking-wide text-gray-400 uppercase mb-1.5">
                        <i class="ti ti-id-badge text-[13px]"></i>Nama perusahaan
                    </p>
                    <p class="text-sm text-gray-800">{{ $company->nama_perusahaan ?? 'Belum diisi' }}</p>
                </div>
                <div class="px-5 py-4">
                    <p class="flex items-center gap-1.5 text-[11px] font-medium tracking-wide text-gray-400 uppercase mb-1.5">
                        <i class="ti ti-category text-[13px]"></i>Bidang industri
                    </p>
                    <p class="text-sm text-gray-800">{{ $company->bidang_industri ?? 'Belum diisi' }}</p>
                </div>
            </div>

            <div class="border-b border-gray-100 px-5 py-4">
                <p class="flex items-center gap-1.5 text-[11px] font-medium tracking-wide text-gray-400 uppercase mb-1.5">
                    <i class="ti ti-align-left text-[13px]"></i>Deskripsi
                </p>
                <p class="text-sm text-gray-800 leading-relaxed">{{ $company->deskripsi ?? 'Belum diisi' }}</p>
            </div>

            <div class="grid grid-cols-2 divide-x divide-gray-100 border-b border-gray-100">
                <div class="px-5 py-4">
                    <p class="flex items-center gap-1.5 text-[11px] font-medium tracking-wide text-gray-400 uppercase mb-1.5">
                        <i class="ti ti-phone text-[13px]"></i>No telepon
                    </p>
                    <p class="text-sm text-gray-800">{{ $company->no_telepon ?? 'Belum diisi' }}</p>
                </div>
                <div class="px-5 py-4">
                    <p class="flex items-center gap-1.5 text-[11px] font-medium tracking-wide text-gray-400 uppercase mb-1.5">
                        <i class="ti ti-map-pin text-[13px]"></i>Alamat
                    </p>
                    <p class="text-sm text-gray-800">{{ $company->alamat ?? 'Belum diisi' }}</p>
                </div>
            </div>

            <div class="px-5 py-4">
                <p class="flex items-center gap-1.5 text-[11px] font-medium tracking-wide text-gray-400 uppercase mb-1.5">
                    <i class="ti ti-world text-[13px]"></i>Website
                </p>
                <p class="text-sm text-blue-600 font-medium">{{ $company->website ?? 'Belum diisi' }}</p>
            </div>
        </div>

        {{-- CARD: INFORMASI AKUN --}}
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">

            <div class="flex items-center gap-2.5 px-5 py-4 border-b border-gray-100">
                <div class="w-8 h-8 rounded-lg bg-violet-50 flex items-center justify-center text-violet-600">
                    <i class="ti ti-shield-lock text-base"></i>
                </div>
                <span class="text-sm font-medium text-gray-800">Informasi akun</span>
            </div>

            <div class="grid grid-cols-2 divide-x divide-gray-100">
                <div class="px-5 py-4">
                    <p class="flex items-center gap-1.5 text-[11px] font-medium tracking-wide text-gray-400 uppercase mb-1.5">
                        <i class="ti ti-mail text-[13px]"></i>Email
                    </p>
                    <p class="text-sm text-blue-600 font-medium">{{ $user->email ?? 'Belum diisi' }}</p>
                </div>
                <div class="px-5 py-4">
                    <p class="flex items-center gap-1.5 text-[11px] font-medium tracking-wide text-gray-400 uppercase mb-1.5">
                        <i class="ti ti-lock text-[13px]"></i>Kata sandi
                    </p>
                    <p class="text-base text-gray-400 tracking-widest">••••••••</p>
                </div>
            </div>

            <div class="px-5 py-4 border-t border-gray-100 flex justify-end">
                <button onclick="openModal()"
                    class="inline-flex items-center gap-2 bg-[#0f1f3d] text-white text-sm font-medium px-5 py-2.5 rounded-full hover:bg-[#162850] transition-colors">
                    <i class="ti ti-edit text-base"></i>Edit profil
                </button>
            </div>
        </div>

    </div>
</main>

{{-- MODAL EDIT --}}
<div id="modal" class="hidden fixed inset-0 bg-black/50 z-50 flex justify-center items-start pt-16 px-4">
    <div class="bg-white w-full max-w-lg rounded-2xl border border-gray-100 overflow-hidden">

        <div class="flex items-center justify-between px-5 py-4 bg-gray-50 border-b border-gray-100">
            <div class="flex items-center gap-2 text-sm font-medium text-gray-800">
                <i class="ti ti-edit text-gray-400 text-base"></i>Edit profil perusahaan
            </div>
            <button onclick="closeModal()"
                class="w-7 h-7 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-gray-100 transition">
                <i class="ti ti-x text-[13px]"></i>
            </button>
        </div>

        <form method="POST" action="{{ route('perusahaan.profil.update') }}">
            @csrf
            <div class="p-5 grid grid-cols-2 gap-3">
                <div class="col-span-2 flex flex-col gap-1">
                    <label class="text-[11px] font-medium text-gray-400 tracking-wide uppercase">Nama perusahaan</label>
                    <input type="text" name="nama_perusahaan"
                        value="{{ old('nama_perusahaan', $company->nama_perusahaan ?? '') }}"
                        placeholder="Nama perusahaan"
                        class="border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-800 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition" required>
                </div>

                <div class="col-span-2 flex flex-col gap-1">
                    <label class="text-[11px] font-medium text-gray-400 tracking-wide uppercase">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" placeholder="Deskripsi perusahaan"
                        class="border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-800 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition resize-none">{{ old('deskripsi', $company->deskripsi ?? '') }}</textarea>
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-[11px] font-medium text-gray-400 tracking-wide uppercase">Bidang industri</label>
                    <input type="text" name="bidang_industri"
                        value="{{ old('bidang_industri', $company->bidang_industri ?? '') }}"
                        placeholder="Bidang industri"
                        class="border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-800 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition">
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-[11px] font-medium text-gray-400 tracking-wide uppercase">No telepon</label>
                    <input type="text" name="no_telepon"
                        value="{{ old('no_telepon', $company->no_telepon ?? '') }}"
                        placeholder="No telepon"
                        class="border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-800 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition">
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-[11px] font-medium text-gray-400 tracking-wide uppercase">Alamat</label>
                    <input type="text" name="alamat"
                        value="{{ old('alamat', $company->alamat ?? '') }}"
                        placeholder="Alamat"
                        class="border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-800 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition">
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-[11px] font-medium text-gray-400 tracking-wide uppercase">Website</label>
                    <input type="text" name="website"
                        value="{{ old('website', $company->website ?? '') }}"
                        placeholder="Website"
                        class="border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-800 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition">
                </div>

                <div class="col-span-2 flex flex-col gap-1">
                    <label class="text-[11px] font-medium text-gray-400 tracking-wide uppercase">Password baru</label>
                    <input type="password" name="password"
                        placeholder="Kosongkan jika tidak ingin diubah"
                        class="border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-800 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition">
                </div>
            </div>

            <div class="flex justify-end gap-2 px-5 py-4 border-t border-gray-100">
                <button type="button" onclick="closeModal()"
                    class="inline-flex items-center gap-1.5 text-sm text-gray-500 border border-gray-200 bg-gray-50 px-4 py-2.5 rounded-full hover:bg-gray-100 transition">
                    <i class="ti ti-x text-sm"></i>Batal
                </button>
                <button type="submit"
                    class="inline-flex items-center gap-1.5 text-sm font-medium text-white bg-[#0f1f3d] px-5 py-2.5 rounded-full hover:bg-[#162850] transition">
                    <i class="ti ti-device-floppy text-sm"></i>Simpan perubahan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openModal() { document.getElementById('modal').classList.remove('hidden'); }
    function closeModal() { document.getElementById('modal').classList.add('hidden'); }
    document.getElementById('modal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });
</script>
@endpush
@endsection