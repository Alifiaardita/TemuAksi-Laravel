@extends('layouts.admin')

@section('title', 'Data User')

@section('content')

    <h1 class="text-3xl font-bold mb-6 text-cornflower">
        👤 Manajemen User
    </h1>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-800 rounded-xl px-4 py-3 text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- BUTTON --}}
    <a href="{{ route('admin.user.create') }}"
       class="bg-cornflower text-white px-4 py-2 rounded-lg shadow inline-block mb-6">

        + Tambah User

    </a>

    {{-- TABLE --}}
<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">

    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
        <h2 class="font-black text-[#0f1e45] text-base">Semua User</h2>
        <span class="text-xs text-gray-400 font-medium">{{ $users->count() }} user</span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-[#f0f2f8]">
                    <th class="px-6 py-3 text-xs font-semibold tracking-widest uppercase text-gray-400">No</th>
                    <th class="px-6 py-3 text-xs font-semibold tracking-widest uppercase text-gray-400">Nama</th>
                    <th class="px-6 py-3 text-xs font-semibold tracking-widest uppercase text-gray-400">Email</th>
                    <th class="px-6 py-3 text-xs font-semibold tracking-widest uppercase text-gray-400">Role</th>
                    <th class="px-6 py-3 text-xs font-semibold tracking-widest uppercase text-gray-400">Status</th>
                    <th class="px-6 py-3 text-xs font-semibold tracking-widest uppercase text-gray-400">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($users as $i => $user)
                @php
                    $statusBadge = $user->status === 'aktif'
                        ? 'bg-green-50 text-green-700 border border-green-200'
                        : 'bg-red-50 text-red-700 border border-red-200';
                    $statusDot = $user->status === 'aktif'
                        ? 'bg-green-500'
                        : 'bg-red-500';
                @endphp
                <tr class="hover:bg-[#f8f9ff] transition group">

                    <td class="px-6 py-4 text-sm text-gray-400">{{ $i + 1 }}</td>

                    <td class="px-6 py-4">
                        <p class="font-semibold text-[#0f1e45] text-sm">
                            {{ $user->role === 'perusahaan'
                                ? $user->companyProfile?->nama_perusahaan
                                : $user->userProfile?->nama_lengkap }}
                        </p>
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-500">{{ $user->email }}</td>

                    <td class="px-6 py-4">
                        <span class="text-xs text-gray-500 bg-[#f0f2f8] px-2.5 py-1 rounded-full font-medium">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>

                    <td class="px-6 py-4">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ $statusBadge }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $statusDot }}"></span>
                            {{ ucfirst($user->status) }}
                        </span>
                    </td>

                    <td class="px-6 py-4">
                        <div class="flex items-center gap-1">

                            {{-- Edit --}}
                            <a href="{{ route('admin.user.edit', $user->id) }}"
                               class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:bg-green-50 hover:text-green-600 transition"
                               title="Edit User">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>

                            {{-- Hapus --}}
                            <form action="{{ route('admin.user.destroy', $user->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin hapus user ini?')"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:bg-red-50 hover:text-red-500 transition"
                                    title="Hapus User">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection