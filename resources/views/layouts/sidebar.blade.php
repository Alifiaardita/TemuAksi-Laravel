<aside class="w-64 min-h-screen bg-white shadow-lg border-r">
    <div class="p-6">
        <h1 class="text-2xl font-bold text-cornflower">TemuAksi</h1>
        <p class="text-sm text-gray-500">Admin Panel</p>
    </div>

    <nav class="mt-6 flex flex-col gap-2 px-4">
        <a href="{{ route('admin.dashboard') }}"
           class="px-4 py-3 rounded-xl hover:bg-cornflower hover:text-white transition">
            📊 Dashboard
        </a>

        <a href="{{ route('admin.user.index') }}"
            class="px-4 py-3 rounded-xl hover:bg-cornflower hover:text-white transition">
            👤 Kelola User
        </a>

        <a href="{{ route('admin.company.index') }}"
           class="px-4 py-3 rounded-xl hover:bg-cornflower hover:text-white transition">
            🏢 Kelola Perusahaan
        </a>

        <a href="{{ route('admin.laporan.index') }}"
           class="px-4 py-3 rounded-xl hover:bg-cornflower hover:text-white transition">
            📑 Laporan
        </a>
    </nav>
</aside>