@extends('layouts.app')
@section('title', 'Tambah User')

@section('content')
<div class="flex">
    @include('layouts.side')
    <main class="flex-1 p-8">
        <div class="max-w-md mx-auto bg-white p-8 rounded-2xl shadow">
            <h1 class="text-2xl font-bold mb-6 text-cornflower">+ Tambah User</h1>

            @if($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="text-sm font-semibold">Email</label>
                    <input type="email" name="email" required class="w-full border p-2 rounded-lg mt-1">
                </div>
                <div>
                    <label class="text-sm font-semibold">Password</label>
                    <input type="password" name="password" required class="w-full border p-2 rounded-lg mt-1">
                </div>
                <div>
                    <label class="text-sm font-semibold">Role</label>
                    <select name="role" class="w-full border p-2 rounded-lg mt-1">
                        <option value="admin">Admin</option>
                        <option value="individu">Individu</option>
                        <option value="perusahaan">Perusahaan</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-cornflower text-white py-2 rounded-lg hover:bg-mist">Simpan</button>
            </form>
        </div>
    </main>
</div>
@endsection
