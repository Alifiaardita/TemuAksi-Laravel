@extends('layouts.app')

@section('title', 'Profil Perusahaan')

@section('content')
<main class="min-h-screen py-10 bg-canvas">
    <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow p-6">
        <h1 class="text-3xl font-bold mb-8 text-cornflower">Account Settings</h1>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 rounded-xl px-4 py-3 text-sm mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- FOTO --}}
        <div class="flex flex-col items-center py-4 border-b">
            @php
                $avatar = 'https://ui-avatars.com/api/?name=Company';
                if (!empty($company->nama_perusahaan)) {
                    $avatar = 'https://ui-avatars.com/api/?name=' . urlencode($company->nama_perusahaan);
                }
            @endphp
            <img src="{{ $avatar }}" class="w-[200px] h-[200px] rounded-full object-cover mb-3">
        </div>

        {{-- BASIC INFO --}}
        <h2 class="text-lg font-semibold text-gray-700 mt-6 mb-4">Basic info</h2>
        <div class="divide-y">
            <div class="flex justify-between py-4 px-2">
                <span class="text-gray-500">Nama Perusahaan</span>
                <span class="text-cornflower">{{ $company->nama_perusahaan ?? 'Belum diisi' }}</span>
            </div>
            <div class="flex py-4 px-2">
                <span class="text-gray-500 w-40">Deskripsi</span>
                <p class="text-cornflower flex-1 text-justify">{{ $company->deskripsi ?? 'Belum diisi' }}</p>
            </div>
            <div class="flex justify-between py-4 px-2">
                <span class="text-gray-500">Bidang Industri</span>
                <span class="text-cornflower">{{ $company->bidang_industri ?? 'Belum diisi' }}</span>
            </div>
            <div class="flex justify-between py-4 px-2">
                <span class="text-gray-500">No Telepon</span>
                <span class="text-cornflower">{{ $company->no_telepon ?? 'Belum diisi' }}</span>
            </div>
            <div class="flex justify-between py-4 px-2">
                <span class="text-gray-500">Alamat</span>
                <span class="text-cornflower">{{ $company->alamat ?? 'Belum diisi' }}</span>
            </div>
            <div class="flex justify-between py-4 px-2">
                <span class="text-gray-500">Website</span>
                <span class="text-cornflower">{{ $company->website ?? 'Belum diisi' }}</span>
            </div>
        </div>

        {{-- ACCOUNT INFO --}}
        <h2 class="text-lg font-semibold text-gray-700 mt-10 mb-4">Account info</h2>
        <div class="divide-y">
            <div class="flex justify-between py-4 px-2">
                <span class="text-gray-500">Email</span>
                <span class="text-cornflower">{{ $user->email ?? 'Belum diisi' }}</span>
            </div>
            <div class="flex justify-between py-4 px-2">
                <span class="text-gray-500">Kata Sandi</span>
                <span class="text-cornflower">••••••••</span>
            </div>
        </div>

        {{-- TOMBOL EDIT --}}
        <div class="mt-10 text-center">
            <button onclick="openModal()"
                class="bg-cornflower text-white px-8 py-3 rounded-full">
                Edit Profil
            </button>
        </div>
    </div>
</main>

{{-- MODAL EDIT --}}
<div id="modal" class="hidden fixed inset-0 bg-black/60 flex justify-center items-start pt-20 z-50">
    <div class="bg-white w-full max-w-2xl rounded-2xl p-8">
        <h2 class="text-2xl font-bold mb-6">Edit Profil Perusahaan</h2>

        <form method="POST" action="{{ route('perusahaan.profil.update') }}">
            @csrf
            <div class="space-y-4">
                <input type="text" name="nama_perusahaan" placeholder="Nama Perusahaan"
                    value="{{ old('nama_perusahaan', $company->nama_perusahaan ?? '') }}"
                    class="w-full border p-3 rounded" required>

                <textarea name="deskripsi" placeholder="Deskripsi"
                    class="w-full border p-3 rounded text-justify">{{ old('deskripsi', $company->deskripsi ?? '') }}</textarea>

                <input type="text" name="bidang_industri" placeholder="Bidang Industri"
                    value="{{ old('bidang_industri', $company->bidang_industri ?? '') }}"
                    class="w-full border p-3 rounded">

                <input type="text" name="no_telepon" placeholder="No Telepon"
                    value="{{ old('no_telepon', $company->no_telepon ?? '') }}"
                    class="w-full border p-3 rounded">

                <input type="text" name="alamat" placeholder="Alamat"
                    value="{{ old('alamat', $company->alamat ?? '') }}"
                    class="w-full border p-3 rounded">

                <input type="text" name="website" placeholder="Website"
                    value="{{ old('website', $company->website ?? '') }}"
                    class="w-full border p-3 rounded">

                <input type="password" name="password" placeholder="Password baru (kosongkan jika tidak diubah)"
                    class="w-full border p-3 rounded">
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="closeModal()"
                    class="px-6 py-2 rounded b