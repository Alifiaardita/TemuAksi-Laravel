@extends('layouts.app')
@section('title', 'Data User')

@section('content')
<div class="flex">
    @include('layouts.side')
    <main class="flex-1 p-8">
        <h1 class="text-3xl font-bold mb-6 text-cornflower">👤 Manajemen User</h1>

        @if(session('success'))
            <div class="mb-4 bg-green-50 border border-green-200 text-green-800 rounded-xl px-4 py-3 text-sm">{{ session('success') }}</div>
        @endif

        <a href="{{ route('admin.users.create') }}"
           class="bg-cornflower text-white px-4 py-2 rounded-lg shadow inline-block mb-6">+ Tambah User</a>

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
                        <td>{{ $user->nama ?? 'Belum ada nama' }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm">Aktif</span>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                   class="w-8 h-8 flex items-center justify-center bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition">✏️</a>
                                <a href="{{ route('admin.users.destroy', $user->id) }}"
                                   onclick="return confirm('Yakin hapus user ini?')"
                                   class="w-8 h-8 flex items-center justify-center bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition">🗑️</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</div>
@endsection
