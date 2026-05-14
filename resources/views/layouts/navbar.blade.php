<header class="sticky top-0 bg-pear text-cornflower z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <h1 class="text-2xl font-bold text-cornflower">TemuAksi</h1>
        </div>

        @guest
        <nav class="space-x-8 hidden md:block">
            <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
            <a href="{{ route('login') }}" class="hover:text-white transition">Explore Event</a>
            <a href="{{ route('login') }}" class="hover:text-white transition">Riwayat</a>
            <a href="{{ route('login') }}" class="hover:text-white transition">Volunteer</a>
        </nav>
        @endguest

        @auth
            @if(auth()->user()->isPerusahaan())
                <nav class="space-x-6 hidden md:block">
                    <a href="{{ route('perusahaan.dashboard') }}" class="hover:text-mist">Home</a>
                    <a href="{{ route('perusahaan.proposal.index') }}" class="hover:text-mist">Daftar Proposal</a>
                    <a href="{{ route('volunteer.index') }}" class="hover:text-mist">Volunteer</a>
                    {{-- <a href="{{ route('perusahaan.faq') }}" class="hover:text-mist">FAQ</a> --}}
                </nav>
            @elseif(auth()->user()->isAdmin())
                <nav class="space-x-6 hidden md:block">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-mist">Dashboard</a>
                    <a href="{{ route('admin.users.index') }}" class="hover:text-mist">Users</a>
                    <a href="{{ route('admin.laporan.index') }}" class="hover:text-mist">Laporan</a>
                </nav>
            @else
                <nav class="space-x-8 hidden md:block">
                    <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
                    <a href="{{ route('explore.index') }}" class="hover:text-white transition">Explore Event</a>
                    <a href="{{ route('proposal.riwayat') }}" class="hover:text-white transition">Riwayat</a>
                    <a href="{{ route('volunteer.index') }}" class="hover:text-white transition">Volunteer</a>
                    {{-- <a href="{{ route('faq') }}" class="hover:text-white transition">FAQ</a> --}}
                </nav>
            @endif
        @endauth

        <div class="space-x-4">
            @auth
                <div class="relative">
                    <button onclick="toggleDropdown()"
                        class="flex items-center gap-2 bg-white px-3 py-1 rounded-full shadow hover:bg-pear transition">
                        <img src="https://i.pravatar.cc/40" class="w-8 h-8 rounded-full">
                        <span class="font-semibold text-cornflower">
                            @if(auth()->user()->isPerusahaan())
                                {{ auth()->user()->companyProfile?->nama_perusahaan ?? 'Perusahaan' }}
                            @else
                                Profil
                            @endif
                        </span>
                    </button>
                    <div id="dropdown" class="hidden absolute right-0 mt-2 w-44 bg-white rounded-xl shadow-lg overflow-hidden">
                        @if(auth()->user()->isPerusahaan())
                            <a href="{{ route('perusahaan.profil') }}" class="block px-4 py-2 hover:bg-pear">My Profile</a>
                        @elseif(auth()->user()->isAdmin())
                            <span class="block px-4 py-2 text-gray-400 text-xs">Admin Panel</span>
                        @else
                            <a href="{{ route('profil.index') }}" class="block px-4 py-2 hover:bg-pear">My Profile</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-pear text-red-500">Logout</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="px-4 py-2">Login</a>
                <a href="{{ route('register') }}"
                   class="bg-cornflower text-white px-4 py-2 rounded-lg hover:opacity-90 transition">Register</a>
            @endauth
        </div>
    </div>
</header>
