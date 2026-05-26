<header class="sticky top-0 z-40 {{ auth()->check() && auth()->user()->isPerusahaan() ? 'bg-white border-b border-gray-100 shadow-sm' : 'bg-pear text-cornflower' }}">
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

                {{-- DROPDOWN KONTRIBUSI --}}
                <div class="relative" id="kontribusi-wrapper">
                    <button onclick="toggleKontribusi()"
                        class="flex items-center gap-1 px-4 py-2 rounded-full text-sm font-medium transition
                            {{ request()->routeIs('perusahaan.volunteer.*') || request()->routeIs('perusahaan.sponsor.*') ? 'bg-cornflower text-white' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-100' }}">
                        Kontribusi
                        <svg id="kontribusi-arrow" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div id="kontribusi-dropdown"
                        style="display:none; position:fixed; margin-top:8px; width:192px; background:white; border-radius:12px; box-shadow:0 10px 25px rgba(0,0,0,0.1); border:1px solid #f3f4f6; z-index:9999; overflow:hidden;">
                        <a href="{{ route('perusahaan.volunteer.create') }}"
                            class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition">
                            <svg class="w-4 h-4 text-cornflower flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Open Volunteer
                        </a>
                        <a href="{{ route('perusahaan.sponsor.create') }}"
                            class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition">
                            <svg class="w-4 h-4 text-cornflower flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Open Sponsor
                        </a>
                    </div>
                </div>

                <a href="{{ route('perusahaan.laporan-pengeluaran.index') }}"
                    class="px-4 py-2 rounded-full text-sm font-medium transition
                            {{ request()->routeIs('perusahaan.laporan-pengeluaran.*') ? 'bg-cornflower text-white' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-100' }}">
                    Laporan Pengeluaran
                </a>
                
                <a href="{{ route('perusahaan.faq') }}"
                    class="px-4 py-2 rounded-full text-sm font-medium transition
                            {{ request()->routeIs('perusahaan.faq') ? 'bg-cornflower text-white' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-100' }}">
                    FAQ
                </a>
            </nav>
            @elseif(auth()->user()->isAdmin())
                <nav class="space-x-6 hidden md:block">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-mist">Dashboard</a>
                    <a href="{{ route('admin.user.index') }}" class="hover:text-mist">Users</a>
                    <a href="{{ route('admin.laporan.index') }}" class="hover:text-mist">Laporan</a>
                </nav>
            @else
                <nav class="space-x-8 hidden md:block">
                    <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
                    <a href="{{ route('explore.index') }}" class="hover:text-white transition">Explore Event</a>
                    <a href="{{ route('proposal.riwayat') }}" class="hover:text-white transition">Riwayat</a>
                    <a href="{{ route('volunteer.index') }}" class="hover:text-white transition">Volunteer</a>
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
                    <div id="dropdown" class="hidden absolute right-0 mt-2 w-44 bg-white rounded-xl shadow-lg overflow-hidden z-[9999]">
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

<script>
function toggleKontribusi() {
    const btn = document.querySelector('#kontribusi-wrapper button');
    const dropdown = document.getElementById('kontribusi-dropdown');
    const rect = btn.getBoundingClientRect();
    const isHidden = dropdown.style.display === 'none';

    if (isHidden) {
        dropdown.style.display = 'block';
        dropdown.style.top = (rect.bottom) + 'px';
        dropdown.style.left = rect.left + 'px';
        document.getElementById('kontribusi-arrow').style.transform = 'rotate(180deg)';
    } else {
        dropdown.style.display = 'none';
        document.getElementById('kontribusi-arrow').style.transform = 'rotate(0deg)';
    }
}

document.addEventListener('click', function(e) {
    if (!e.target.closest('#kontribusi-wrapper')) {
        document.getElementById('kontribusi-dropdown').style.display = 'none';
        document.getElementById('kontribusi-arrow').style.transform = 'rotate(0deg)';
    }
});

function toggleDropdown() {
    document.getElementById('dropdown')?.classList.toggle('hidden');
}

window.onclick = function(e) {
    if (!e.target.closest('.relative')) {
        const d = document.getElementById('dropdown');
        if (d) d.classList.add('hidden');
    }
}
</script>