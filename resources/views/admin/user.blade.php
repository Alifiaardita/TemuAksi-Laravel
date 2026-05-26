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
    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <table class="w-full text-left">

            <thead class="bg-blue-100">
                <tr>
                    <th class="p-4">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @foreach($users as $i => $user)
                <tr class="border-t hover:bg-gray-50">

                    <td class="p-4">{{ $i + 1 }}</td>

                    <td>
                        {{ $user->role === 'perusahaan'
                            ? $user->companyProfile?->nama_perusahaan
                            : $user->userProfile?->nama_lengkap }}
                    </td>

                    <td>{{ $user->email }}</td>

                    <td>{{ ucfirst($user->role) }}</td>

                    <td>
                        <span class="px-3 py-1 rounded-full text-sm
                            {{ $user->status === 'aktif'
                                ? 'bg-green-100 text-green-600'
                                : 'bg-red-100 text-red-600' }}">

                            {{ ucfirst($user->status) }}

                        </span>
                    </td>

                    <td class="p-4 flex gap-2">

                        {{-- EDIT --}}
                        <a href="{{ route('admin.user.edit', $user->id) }}"
                           class="w-8 h-8 flex items-center justify-center bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200">

                            ✏️

                        </a>

                        {{-- DELETE --}}
                        <form action="{{ route('admin.user.destroy', $user->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin hapus user ini?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="w-8 h-8 flex items-center justify-center bg-red-100 text-red-600 rounded-lg hover:bg-red-200">

                                🗑️

                            </button>

                        </form>

                    </td>

                </tr>
                @endforeach

            </tbody>

        </table>

    </div>

@endsection