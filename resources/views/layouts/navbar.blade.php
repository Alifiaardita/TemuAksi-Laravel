<header class="sticky top-0 z-50 {{ auth()->check() && auth()->user()->isPerusahaan() ? 'bg-white border-b border-gray-100 shadow-sm' : 'bg-pear text-cornflower' }}">
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
            <nav class="flex items-center gap-1 hidden md:flex">
                <a href="{{ route('perusahaan.dashboard') }}"
                class="px-4 py-2 rounded-full text-sm font-semibold transition
                        {{ request()->routeIs('perusahaan.dashboard') ? 'bg-cornflower text-white' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-100' }}">
                    Home
                </a>
                <a href="{{ route('perusahaan.proposal.index') }}"
                class="px-4 py-2 rounded-full text-sm font-medium transition
                        {{ request()->routeIs('perusahaan.proposal.*') ? 'bg-cornflower text-white' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-100' }}">
                    Daftar Proposal
                </a>
                <a href="{{ route('volunteer.index') }}"
                class="px-4 py-2 rounded-full text-sm font-medium transition
                        {{ request()->routeIs('volunteer.*') ? 'bg-gray-900 text-white' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-100' }}">
                    Volunteer
                </a>
                <a href="#"
                class="px-4 py-2 rounded-full text-sm font-medium transition text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                    Laporan Impact
                </a>
                <a href="#"
                class="px-4 py-2 rounded-full text-sm font-medium transition text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                    FAQ
                </a>
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

        <div class="flex items-center gap-3">
            @auth
                <div class="relative">
                    <button onclick="toggleDropdown()"
                        class="{{ auth()->user()->isPerusahaan() 
                            ? 'flex items-center gap-2 bg-cornflower text-white px-3 py-2 rounded-full hover:bg-gray-700 transition'
                            : 'flex items-center gap-2 bg-white px-3 py-1 rounded-full shadow hover:bg-pear transition' }}">
                        @if(auth()->user()->isPerusahaan())
                            <div class="w-8 h-8 rounded-full overflow-hidden bg-blue-400 flex items-center justify-center border-2 border-white/30 flex-shrink-0">
                                @if(auth()->user()->companyProfile?->logo)
                                    <img src="{{ asset('storage/' . auth()->user()->companyProfile->logo) }}" 
                                        class="w-full h-full object-cover">
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                                    </svg>
                                @endif
                            </div>
                            <span class="text-sm font-semibold">
                                {{ auth()->user()->companyProfile?->nama_perusahaan ?? 'Perusahaan' }}
                            </span>
                        @else
                            <img src="https://i.pravatar.cc/40" class="w-8 h-8 rounded-full">
                            <span class="font-semibold text-cornflower">Profil</span>
                        @endif
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
