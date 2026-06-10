@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

<div x-data="{ openEdit: false }" class="max-w-4xl mx-auto px-4 py-10">

    {{-- HEADER CARD --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-6">

        {{-- COVER BANNER --}}
        <div class="h-36 bg-gradient-to-r from-blue-600 via-blue-500 to-cornflower relative">
            <div class="absolute inset-0 opacity-10"
                 style="background-image: radial-gradient(circle at 20% 50%, white 1px, transparent 1px), radial-gradient(circle at 80% 20%, white 1px, transparent 1px); background-size: 40px 40px;">
            </div>
        </div>

        <div class="px-8 pb-7">
            <div class="flex flex-col md:flex-row md:items-end gap-5">

                {{-- AVATAR --}}
                <div class="-mt-12 z-10 flex-shrink-0">
                    <div class="relative inline-block">
                        <img
                            src="{{ $user->userProfile?->avatar_url
                                ? asset('storage/'.$user->userProfile->avatar_url)
                                : 'https://ui-avatars.com/api/?name='.urlencode($user->nama).'&background=dbeafe&color=1d4ed8&size=128'
                            }}"
                            alt="Avatar"
                            class="w-24 h-24 rounded-2xl border-4 border-white bg-white object-cover shadow-md"
                        >
                        @if($user->status === 'aktif')
                            <span class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full bg-green-500 border-2 border-white"></span>
                        @endif
                    </div>
                </div>

                {{-- INFO USER --}}
                <div class="flex-1 min-w-0 pb-1">
                    <h1 class="text-xl font-bold text-gray-900 truncate">
                        {{ $user->userProfile?->nama_lengkap ?? 'Belum diisi' }}
                    </h1>
                    <p class="text-sm text-gray-400 mt-0.5">{{ $user->email }}</p>
                    <div class="flex items-center gap-2 mt-2.5 flex-wrap">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-blue-50 text-blue-700 rounded-full text-xs font-medium">
                            <i class="ti ti-shield-check text-xs"></i>
                            {{ ucfirst($user->role) }}
                        </span>
                        @if($user->is_verified)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-green-50 text-green-700 rounded-full text-xs font-medium">
                                <i class="ti ti-circle-check text-xs"></i>
                                Terverifikasi
                            </span>
                        @endif
                        @if($user->userProfile?->username)
                            <span class="text-xs text-gray-400">@{{ $user->userProfile->username }}</span>
                        @endif
                    </div>
                </div>

                {{-- BUTTON EDIT --}}
                <div class="pb-1">
                    <button
                        type="button"
                        @click="openEdit = true"
                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium transition shadow-sm"
                    >
                        <i class="ti ti-edit text-base"></i>
                        Edit Profil
                    </button>
                </div>

            </div>
        </div>
    </div>

    {{-- INFO GRID --}}
    <div class="grid md:grid-cols-2 gap-5 mb-5">

        {{-- PROFIL --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

            <h2 class="font-semibold text-sm text-gray-400 uppercase tracking-wide mb-5 flex items-center gap-2">
                <i class="ti ti-user-circle text-base"></i>
                Informasi Profil
            </h2>

            <div class="space-y-0">

                @php
                    $profileFields = [
                        ['icon' => 'ti-user',            'label' => 'Nama Lengkap',   'value' => $user->userProfile?->nama_lengkap ?? '-'],
                        ['icon' => 'ti-at',              'label' => 'Username',        'value' => $user->userProfile?->username ? '@'.$user->userProfile->username : '-'],
                        ['icon' => 'ti-phone',           'label' => 'Nomor Telepon',   'value' => $user->userProfile?->no_telepon ?? '-'],
                        ['icon' => 'ti-calendar',        'label' => 'Tanggal Lahir',   'value' => $user->userProfile?->tanggal_lahir ?? '-'],
                        ['icon' => 'ti-gender-bigender', 'label' => 'Jenis Kelamin',   'value' => $user->userProfile?->gender ?? '-'],
                    ];
                @endphp

                @foreach($profileFields as $i => $field)
                    <div class="flex items-start gap-3 py-3.5 {{ $i > 0 ? 'border-t border-gray-50' : '' }}">
                        <div class="w-7 h-7 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="ti {{ $field['icon'] }} text-xs text-gray-500"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 mb-0.5">{{ $field['label'] }}</p>
                            <p class="text-sm font-medium text-gray-800">{{ $field['value'] }}</p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

        {{-- AKUN --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

            <h2 class="font-semibold text-sm text-gray-400 uppercase tracking-wide mb-5 flex items-center gap-2">
                <i class="ti ti-lock text-base"></i>
                Informasi Akun
            </h2>

            <div class="space-y-0">

                <div class="flex items-start gap-3 py-3.5">
                    <div class="w-7 h-7 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class="ti ti-mail text-xs text-gray-500"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-0.5">Email</p>
                        <p class="text-sm font-medium text-gray-800">{{ $user->email }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 py-3.5 border-t border-gray-50">
                    <div class="w-7 h-7 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class="ti ti-shield text-xs text-gray-500"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-0.5">Role</p>
                        <p class="text-sm font-medium text-gray-800">{{ ucfirst($user->role) }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 py-3.5 border-t border-gray-50">
                    <div class="w-7 h-7 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class="ti ti-toggle-right text-xs text-gray-500"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-0.5">Status</p>
                        @if($user->status === 'aktif')
                            <span class="inline-flex items-center gap-1.5 text-sm font-medium text-green-700">
                                <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                {{ ucfirst($user->status) }}
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-500">
                                <span class="w-2 h-2 rounded-full bg-gray-400"></span>
                                {{ ucfirst($user->status) }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class="flex items-start gap-3 py-3.5 border-t border-gray-50">
                    <div class="w-7 h-7 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class="ti ti-circle-check text-xs text-gray-500"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-0.5">Verifikasi Email</p>
                        @if($user->is_verified)
                            <span class="inline-flex items-center gap-1.5 text-sm font-medium text-green-700">
                                <i class="ti ti-check text-xs"></i>
                                Terverifikasi
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 text-sm font-medium text-amber-600">
                                <i class="ti ti-clock text-xs"></i>
                                Belum Verifikasi
                            </span>
                        @endif
                    </div>
                </div>

                <div class="flex items-start gap-3 py-3.5 border-t border-gray-50">
                    <div class="w-7 h-7 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class="ti ti-calendar-plus text-xs text-gray-500"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-0.5">Bergabung Sejak</p>
                        <p class="text-sm font-medium text-gray-800">
                            {{ $user->created_at?->format('d M Y') ?? '-' }}
                        </p>
                    </div>
                </div>

            </div>
        </div>

    </div>

    {{-- AKTIVITAS --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

        <h2 class="font-semibold text-sm text-gray-400 uppercase tracking-wide mb-5 flex items-center gap-2">
            <i class="ti ti-bolt text-base"></i>
            Aktivitas Saya
        </h2>

        <div class="grid md:grid-cols-3 gap-4">

            <a href="{{ route('volunteer.my') }}"
               class="flex items-start gap-4 border border-gray-100 rounded-xl p-5 hover:border-blue-200 hover:bg-blue-50/30 transition-all duration-150 group">
                <div class="w-10 h-10 rounded-xl bg-blue-50 group-hover:bg-blue-100 flex items-center justify-center flex-shrink-0 transition-colors">
                    <i class="ti ti-users text-xl text-blue-600"></i>
                </div>
                <div class="min-w-0">
                    <h3 class="text-sm font-semibold text-gray-800 group-hover:text-blue-600 transition-colors">Volunteer Saya</h3>
                    <p class="text-xs text-gray-400 mt-0.5 leading-relaxed">Kegiatan yang pernah didaftarkan.</p>
                </div>
            </a>

            <a href="{{ route('volunteer.sertifikat') }}"
               class="flex items-start gap-4 border border-gray-100 rounded-xl p-5 hover:border-amber-200 hover:bg-amber-50/30 transition-all duration-150 group">
                <div class="w-10 h-10 rounded-xl bg-amber-50 group-hover:bg-amber-100 flex items-center justify-center flex-shrink-0 transition-colors">
                    <i class="ti ti-award text-xl text-amber-600"></i>
                </div>
                <div class="min-w-0">
                    <h3 class="text-sm font-semibold text-gray-800 group-hover:text-amber-600 transition-colors">Sertifikat</h3>
                    <p class="text-xs text-gray-400 mt-0.5 leading-relaxed">Download sertifikat kegiatan.</p>
                </div>
            </a>

            <a href="{{ route('proposal.riwayat') }}"
               class="flex items-start gap-4 border border-gray-100 rounded-xl p-5 hover:border-green-200 hover:bg-green-50/30 transition-all duration-150 group">
                <div class="w-10 h-10 rounded-xl bg-green-50 group-hover:bg-green-100 flex items-center justify-center flex-shrink-0 transition-colors">
                    <i class="ti ti-file-description text-xl text-green-600"></i>
                </div>
                <div class="min-w-0">
                    <h3 class="text-sm font-semibold text-gray-800 group-hover:text-green-600 transition-colors">Proposal Saya</h3>
                    <p class="text-xs text-gray-400 mt-0.5 leading-relaxed">Riwayat proposal sponsorship.</p>
                </div>
            </a>

        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div
        x-show="openEdit"
        x-transition.opacity
        class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4"
        style="display:none"
    >
        <div
            @click.away="openEdit = false"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            class="bg-white rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto shadow-2xl"
        >
            {{-- Modal Header --}}
            <div class="flex justify-between items-center px-8 py-5 border-b border-gray-100">
                <h2 class="text-base font-semibold text-gray-900 flex items-center gap-2">
                    <i class="ti ti-edit text-gray-400"></i>
                    Edit Profil
                </h2>
                <button
                    type="button"
                    @click="openEdit = false"
                    class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition"
                >
                    <i class="ti ti-x text-lg"></i>
                </button>
            </div>

            <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data" class="px-8 py-6 space-y-4">
                @csrf

                {{-- Avatar Upload --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5 flex items-center gap-1.5">
                        <i class="ti ti-camera text-sm text-gray-400"></i>
                        Foto Profil
                    </label>
                    <label class="flex items-center gap-3 w-full border border-dashed border-gray-200 rounded-xl px-4 py-3 cursor-pointer hover:border-blue-400 hover:bg-blue-50/30 transition-colors group">
                        <div class="w-8 h-8 rounded-lg bg-gray-100 group-hover:bg-blue-100 flex items-center justify-center flex-shrink-0 transition-colors">
                            <i class="ti ti-upload text-sm text-gray-400 group-hover:text-blue-500"></i>
                        </div>
                        <span class="text-sm text-gray-400 group-hover:text-blue-500 transition-colors">Klik untuk upload foto</span>
                        <input type="file" name="avatar" accept="image/*" class="hidden">
                    </label>
                </div>

                <div class="grid md:grid-cols-2 gap-4">

                    {{-- Nama Lengkap --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap"
                               value="{{ $user->userProfile?->nama_lengkap }}"
                               placeholder="Nama lengkap"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition">
                    </div>

                    {{-- Username --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Username</label>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-gray-400 text-sm">@</span>
                            <input type="text" name="username"
                                   value="{{ $user->userProfile?->username }}"
                                   placeholder="username"
                                   class="w-full border border-gray-200 rounded-xl pl-7 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition">
                        </div>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                        <input type="email" name="email"
                               value="{{ $user->email }}"
                               placeholder="Alamat email"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition">
                    </div>

                    {{-- No Telepon --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nomor Telepon</label>
                        <input type="text" name="no_telepon"
                               value="{{ $user->userProfile?->no_telepon }}"
                               placeholder="08xx xxxx xxxx"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition">
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir"
                               value="{{ $user->userProfile?->tanggal_lahir }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition">
                    </div>

                    {{-- Gender --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Jenis Kelamin</label>
                        <div class="relative">
                            <select name="gender"
                                    class="w-full appearance-none border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition bg-white pr-10">
                                <option value="">Pilih jenis kelamin</option>
                                <option value="Laki-laki" @selected(($user->userProfile?->gender ?? '') == 'Laki-laki')>Laki-laki</option>
                                <option value="Perempuan" @selected(($user->userProfile?->gender ?? '') == 'Perempuan')>Perempuan</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                <i class="ti ti-chevron-down text-xs text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Password Baru
                        <span class="text-gray-400 font-normal">(opsional)</span>
                    </label>
                    <input type="password" name="password"
                           placeholder="Kosongkan jika tidak ingin mengubah"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition">
                </div>

                {{-- Actions --}}
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="button" @click="openEdit = false"
                            class="inline-flex items-center gap-2 px-5 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-600 hover:bg-gray-50 transition">
                        <i class="ti ti-x text-sm"></i>
                        Batal
                    </button>
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-medium transition shadow-sm">
                        <i class="ti ti-check text-sm"></i>
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection
