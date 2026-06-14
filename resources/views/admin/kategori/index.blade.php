@extends('layouts.admin')
@section('title', 'Kelola Kategori')
@section('content')

<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-medium text-gray-800">Kelola Kategori</h1>
        <p class="text-sm text-gray-500 mt-0.5">Tambah, edit, dan hapus kategori event.</p>
    </div>
    <button onclick="document.getElementById('modalTambah').classList.remove('hidden')"
        class="flex items-center gap-2 bg-[#4a6cf7] text-white text-sm px-4 py-2 rounded-xl hover:bg-[#3a5ce6] transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Kategori
    </button>
</div>

{{-- Alert --}}
@if(session('success'))
    <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl">
        {{ session('success') }}
    </div>
@endif

{{-- Tabel --}}
<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
            <tr>
                <th class="px-5 py-3 text-left">#</th>
                <th class="px-5 py-3 text-left">Foto</th>
                <th class="px-5 py-3 text-left">Nama Kategori</th>
                <th class="px-5 py-3 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($kategori as $k)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-5 py-4 text-gray-400">{{ $loop->iteration }}</td>
                <td class="px-5 py-4">
                    @if($k->gambar)
                        <img src="{{ Storage::url($k->gambar) }}"
                             class="w-14 h-10 object-cover rounded-lg">
                    @else
                        <div class="w-14 h-10 bg-gray-100 rounded-lg flex items-center justify-center text-gray-300 text-xs">
                            No img
                        </div>
                    @endif
                </td>
                <td class="px-5 py-4 font-medium text-gray-800">{{ $k->nama_kategori }}</td>
                <td class="px-5 py-4 text-right">
                    <div class="flex gap-2 justify-end">
                        {{-- Tombol Edit --}}
                        <button
                            onclick="openEdit({{ $k->id }}, '{{ $k->nama_kategori }}', '{{ $k->gambar ? Storage::url($k->gambar) : '' }}')"
                            class="text-xs px-3 py-1.5 rounded-lg border border-gray-200 hover:bg-gray-50 transition">
                            Edit
                        </button>
                        {{-- Tombol Hapus --}}
                        <form action="{{ route('admin.kategori.destroy', $k->id) }}" method="POST"
                              onsubmit="return confirm('Hapus kategori {{ $k->nama_kategori }}?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="text-xs px-3 py-1.5 rounded-lg border border-red-200 text-red-500 hover:bg-red-50 transition">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-5 py-10 text-center text-gray-400 text-sm">
                    Belum ada kategori.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- ===== MODAL TAMBAH ===== --}}
<div id="modalTambah" class="hidden fixed inset-0 bg-black/40 z-50 flex items-center justify-center">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md mx-4 shadow-xl">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Tambah Kategori</h2>
        <form action="{{ route('admin.kategori.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="text-sm text-gray-600 mb-1 block">Nama Kategori</label>
                <input type="text" name="nama_kategori" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4a6cf7]">
            </div>
            <div class="mb-6">
                <label class="text-sm text-gray-600 mb-1 block">Foto Kategori</label>
                <input type="file" name="gambar" accept="image/*"
                    class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-[#f0f2f8] file:text-[#4a6cf7] file:font-medium">
            </div>
            <div class="flex gap-3 justify-end">
                <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')"
                    class="text-sm px-4 py-2 rounded-xl border border-gray-200 hover:bg-gray-50 transition">
                    Batal
                </button>
                <button type="submit"
                    class="text-sm px-4 py-2 rounded-xl bg-[#4a6cf7] text-white hover:bg-[#3a5ce6] transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ===== MODAL EDIT ===== --}}
<div id="modalEdit" class="hidden fixed inset-0 bg-black/40 z-50 flex items-center justify-center">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md mx-4 shadow-xl">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Edit Kategori</h2>
        <form id="formEdit" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="mb-4">
                <label class="text-sm text-gray-600 mb-1 block">Nama Kategori</label>
                <input type="text" id="editNama" name="nama_kategori" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4a6cf7]">
            </div>
            <div class="mb-2">
                <label class="text-sm text-gray-600 mb-1 block">Foto Kategori</label>
                <img id="editPreview" src="" alt="" class="w-full h-32 object-cover rounded-xl mb-2 hidden">
                <input type="file" name="gambar" accept="image/*"
                    class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-[#f0f2f8] file:text-[#4a6cf7] file:font-medium">
                <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengganti foto.</p>
            </div>
            <div class="flex gap-3 justify-end mt-6">
                <button type="button" onclick="document.getElementById('modalEdit').classList.add('hidden')"
                    class="text-sm px-4 py-2 rounded-xl border border-gray-200 hover:bg-gray-50 transition">
                    Batal
                </button>
                <button type="submit"
                    class="text-sm px-4 py-2 rounded-xl bg-[#4a6cf7] text-white hover:bg-[#3a5ce6] transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openEdit(id, nama, gambarUrl) {
    document.getElementById('editNama').value = nama;
    document.getElementById('formEdit').action = `/admin/kategori/${id}`;

    const preview = document.getElementById('editPreview');
    if (gambarUrl) {
        preview.src = gambarUrl;
        preview.classList.remove('hidden');
    } else {
        preview.classList.add('hidden');
    }

    document.getElementById('modalEdit').classList.remove('hidden');
}
</script>
@endpush
