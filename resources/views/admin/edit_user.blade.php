@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">

        <h1 class="text-2xl font-bold text-cornflower">
            ✏️ Edit User
        </h1>

        <a href="{{ route('admin.user.index') }}"
           class="text-sm text-gray-600 hover:text-cornflower transition">
            ← Kembali
        </a>

    </div>

    {{-- ERROR --}}
    @if($errors->any())
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    {{-- FORM --}}
    <form method="POST"
          action="{{ route('admin.user.update', $user->id) }}"
          class="bg-white p-6 rounded-2xl shadow space-y-5">

        @csrf
        @method('PUT')

        {{-- NAMA --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Nama</label>

            <input type="text"
                   name="nama"
                   value="{{ old('nama', $user->display_name) }}"
                   class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-cornflower focus:outline-none">
        </div>

        {{-- EMAIL --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Email</label>

            <input type="email"
                   name="email"
                   value="{{ old('email', $user->email) }}"
                   class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-cornflower focus:outline-none">
        </div>

        {{-- ROLE --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Role</label>

            <select name="role"
                    class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-cornflower focus:outline-none">

                <option value="individu" {{ $user->role === 'individu' ? 'selected' : '' }}>
                    Individu
                </option>

                <option value="perusahaan" {{ $user->role === 'perusahaan' ? 'selected' : '' }}>
                    Perusahaan
                </option>

                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                    Admin
                </option>

            </select>
        </div>

        {{-- BUTTON --}}
        <div class="pt-2 flex justify-end">
            <button type="submit"
                    class="bg-cornflower hover:bg-mist transition text-white px-5 py-3 rounded-xl shadow">

                Simpan Perubahan

            </button>
        </div>

    </form>

@endsection