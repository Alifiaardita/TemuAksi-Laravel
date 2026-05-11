<aside class="w-64 bg-cornflower text-white min-h-screen p-6">
    <h2 class="text-2xl font-bold mb-8">⚙️ Admin</h2>
    <nav class="space-y-4">
        <a href="{{ route('admin.dashboard') }}"
           class="block px-4 py-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-mist' : 'hover:bg-mist' }}">
            📊 Dashboard
        </a>
        <a href="{{ route('admin.users.index') }}"
           class="block px-4 py-2 rounded-lg {{ request()->routeIs('admin.users*') ? 'bg-mist' : 'hover:bg-mist' }}">
            👤 User
        </a>
        <a href="{{ route('admin.laporan.index') }}"
           class="block px-4 py-2 rounded-lg {{ request()->routeIs('admin.laporan*') ? 'bg-mist' : 'hover:bg-mist' }}">
            💰 Laporan
        </a>
        <form method="POST" action="{{ route('logout') }}" class="mt-10">
            @csrf
            <button type="submit" class="text-red-300 hover:text-white">🚪 Logout</button>
        </form>
    </nav>
</aside>
