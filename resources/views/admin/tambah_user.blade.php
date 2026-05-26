@extends('layouts.admin')

@section('title', 'Tambah User')

@section('content')

    <div class="max-w-md mx-auto bg-white p-8 rounded-2xl shadow">

        {{-- TITLE --}}
        <h1 class="text-2xl font-bold mb-6 text-cornflower">
            + Tambah User
        </h1>

        {{-- ERROR --}}
        @if($errors->any())
            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- FORM --}}
        <form method="POST"
              action="{{ route('admin.user.store') }}"
              class="space-y-5">

            @csrf

            {{-- EMAIL --}}
            <div>
                <label class="block text-sm font-semibold mb-1">
                    Email
                </label>

                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-cornflower focus:outline-none">
            </div>

            {{-- PASSWORD --}}
            <div>
                <label class="block text-sm font-semibold mb-1">
                    Password
                </label>

                <input type="password"
                       name="password"
                       required
                       class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-cornflower focus:outline-none">
            </div>

            {{-- ROLE --}}
            <div>
                <label class="block text-sm font-semibold mb-1">
                    Role
                </label>

                <select name="role"
                        class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-cornflower focus:outline-none">

                    <option value="admin"
                        {{ old('role') == 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>

                    <option value="individu"
                        {{ old('role') == 'individu' ? 'selected' : '' }}>
                        Individu
                    </option>

                    <option value="perusahaan"
                        {{ old('role') == 'perusahaan' ? 'selected' : '' }}>
                        Perusahaan
                    </option>

                </select>
            </div>

            {{-- BUTTON --}}
            <div class="pt-2">
                <button type="submit"
                        class="w-full bg-cornflower hover:bg-mist transition text-white py-3 rounded-xl shadow">

                    Simpan User

                </button>
            </div>

        </form>

    </div>

@endsection