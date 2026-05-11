@extends('layouts.app')
@section('title', 'Edit User')

@section('content')
<div class="flex">
    @include('layouts.side')
    <main class="flex-1 p-8 max-w-xl">
        <h1 class="text-2xl font-bold mb-6 text-cornflower">✏️ Edit User</h1>

        @if($errors->any())
            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="bg-white p-6 rounded-2xl shadow space-y-4">
            @csrf
            <div>
                <label class="text-sm font-semibold">Nama</label>
                <input type="text" name="nama"
                    value="{{ $user->isPerusahaan() ? $user->companyProfile?->nama_perusahaan : $user->userProfile?->nama_lengkap }}"
                    class="w-full border p-2 rounded-lg mt-1">
            </div>
            <div>
                <label class="text-sm font-semibold">Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="w-full border p-2 rounded-lg mt-1">
            </div>
            <div>
                <label class="text-sm font-semibold">Role</label>
                <select name="role" class="w-full border p-2 rounded-lg mt-1">
                    <option value="individu" {{ $user->role === 'individu' ? 'selected' : '' }}>Individu</option>
                    <option value="perusahaan" {{ $user->role === 'perusahaan' ? 'selected' : '' }}>Perusahaan</option>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <button type="submit" class="bg-cornflower text-white px-4 py-2 rounded-lg">Simpan Perubahan</button>
        </form>
    </main>
</div>
@endsection
