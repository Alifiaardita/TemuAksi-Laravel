<header class="sticky top-0 z-40 bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-6xl mx-auto px-6 py-3 flex justify-between items-center">

        {{-- LOGO --}}
        <a href="{{ route('home') }}" class="text-xl font-black text-[#0f1e45]">
            Temu<span class="text-[#4a6cf7]">Aksi</span>
        </a>

        {{-- NAV LINKS --}}
        @guest
            <nav class="hidden md:flex items-center gap-1">
                <a href="{{ route('home') }}"
                   class="px-4 py-2 rounded-full text-sm font-medium text-gray-500 hover:text-[#0f1e45] hover:bg-[#f0f2f8] transition">
                    Home
                </a>
                <a href="{{ route('login') }}"
                   class="px-4 py-2 rounded-full text-sm font-medium text-gray-500 hover:text-[#0f1e45] hover:bg-[#f0f2f8] transition">
                    Explore Event
                </a>
                <a href="{{ route('login') }}"
                   class="px-4 py-2 rounded-full text-sm font-medium text-gray-500 hover:text-[#0f1e45] hover:bg-[#f0f2f8] transition">
                    Volunteer
                </a>
                <a href="{{ route('login') }}"
                   class="px-4 py-2 rounded-full text-sm font-medium text-gray-500 hover:text-[#0f1e45] hover:bg-[#f0f2f8] transition">
                    FAQ
                </a>
            </nav>
        @endguest

        @auth
            @if(auth()->user()->isPerusahaan())
                <nav class="hidden md:flex items-center gap-1">
                    <a href="{{ route('perusahaan.dashboard') }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition
                       {{ request()->routeIs('perusahaan.dashboard') ? 'bg-[#0f1e45] text-white' : 'text-gray-500 hover:text-[#0f1e45] hover:bg-[#f0f2f8]' }}">
                        Home
                    </a>
                    <a href="{{ route('perusahaan.proposal.index') }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition
                       {{ request()->routeIs('perusahaan.proposal.*') ? 'bg-[#0f1e45] text-white' : 'text-gray-500 hover:text-[#0f1e45] hover:bg-[#f0f2f8]' }}">
                        Daftar Proposal
                    </a>

                    {{-- DROPDOWN KONTRIBUSI --}}
                    <div class="relative" id="kontribusi-wrapper">
                        <button onclick="toggleKontribusi()"
                            class="flex items-center gap-1 px-4 py-2 rounded-full text-sm font-medium transition
                            {{ request()->routeIs('perusahaan.volunteer.*') || request()->routeIs('perusahaan.sponsor.*') ? 'bg-[#0f1e45] text-white' : 'text-gray-500 hover:text-[#0f1e45] hover:bg-[#f0f2f8]' }}">
                            Kontribusi
                            <svg id="kontribusi-arrow" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div id="kontribusi-dropdown"
    style="display:none; position:absolute; top:100%; right:0; left:auto; margin-top:8px; width:192px; background:white; border-radius:12px; box-shadow:0 10px 25px rgba(0,0,0,0.08); border:1px solid #e5e7eb; z-index:9999; overflow:hidden;">
                            <a href="{{ route('perusahaan.volunteer.create') }}"
                               class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-[#f0f2f8] transition">
                                <svg class="w-4 h-4 text-[#4a6cf7] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Open Volunteer
                            </a>
                            <a href="{{ route('perusahaan.sponsor.create') }}"
                               class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-[#f0f2f8] transition">
                                <svg class="w-4 h-4 text-[#4a6cf7] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Open Sponsor
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('perusahaan.laporan-pengeluaran.index') }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition
                       {{ request()->routeIs('perusahaan.laporan-pengeluaran.*') ? 'bg-[#0f1e45] text-white' : 'text-gray-500 hover:text-[#0f1e45] hover:bg-[#f0f2f8]' }}">
                        Laporan
                    </a>
                    <a href="{{ route('perusahaan.faq') }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition
                       {{ request()->routeIs('perusahaan.faq') ? 'bg-[#0f1e45] text-white' : 'text-gray-500 hover:text-[#0f1e45] hover:bg-[#f0f2f8]' }}">
                        FAQ
                    </a>
                </nav>

            @elseif(auth()->user()->isAdmin())
                <nav class="hidden md:flex items-center gap-1">
                    <a href="{{ route('admin.dashboard') }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition
                       {{ request()->routeIs('admin.dashboard') ? 'bg-[#0f1e45] text-white' : 'text-gray-500 hover:text-[#0f1e45] hover:bg-[#f0f2f8]' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.user.index') }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition
                       {{ request()->routeIs('admin.user.*') ? 'bg-[#0f1e45] text-white' : 'text-gray-500 hover:text-[#0f1e45] hover:bg-[#f0f2f8]' }}">
                        Users
                    </a>
                    <a href="{{ route('admin.laporan.index') }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition
                       {{ request()->routeIs('admin.laporan.*') ? 'bg-[#0f1e45] text-white' : 'text-gray-500 hover:text-[#0f1e45] hover:bg-[#f0f2f8]' }}">
                        Laporan
                    </a>
                </nav>

            @else
                <nav class="hidden md:flex items-center gap-1">
                    <a href="{{ route('home') }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition
                       {{ request()->routeIs('home') ? 'bg-[#0f1e45] text-white' : 'text-gray-500 hover:text-[#0f1e45] hover:bg-[#f0f2f8]' }}">
                        Home
                    </a>
                    <a href="{{ route('explore.index') }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition
                       {{ request()->routeIs('explore.*') ? 'bg-[#0f1e45] text-white' : 'text-gray-500 hover:text-[#0f1e45] hover:bg-[#f0f2f8]' }}">
                        Explore Event
                    </a>
                    <a href="{{ route('proposal.riwayat') }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition
                       {{ request()->routeIs('proposal.riwayat') ? 'bg-[#0f1e45] text-white' : 'text-gray-500 hover:text-[#0f1e45] hover:bg-[#f0f2f8]' }}">
                        Riwayat
                    </a>
                    <a href="{{ route('volunteer.index') }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition
                       {{ request()->routeIs('volunteer.*') ? 'bg-[#0f1e45] text-white' : 'text-gray-500 hover:text-[#0f1e45] hover:bg-[#f0f2f8]' }}">
                        Volunteer
                    </a>
                    <a href="{{ route('organizer.faq') }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition
                       {{ request()->routeIs('organizer.faq') ? 'bg-[#0f1e45] text-white' : 'text-gray-500 hover:text-[#0f1e45] hover:bg-[#f0f2f8]' }}">
                        FAQ
                    </a>
                </nav>
            @endif
        @endauth

        {{-- RIGHT: AUTH BUTTONS / USER DROPDOWN --}}
        <div class="flex items-center gap-3">
            @auth
                <div class="relative">
                    <button onclick="toggleDropdown()"
                        class="flex items-center gap-2 bg-[#f0f2f8] text-[#0f1e45] px-3 py-2 rounded-full hover:bg-[#e4e8ff] transition">

                        {{-- Avatar --}}
                        <div class="w-7 h-7 rounded-full overflow-hidden bg-[#4a6cf7] flex items-center justify-center flex-shrink-0">
                            @if(auth()->user()->isPerusahaan() && auth()->user()->companyProfile?->logo)
                                <img src="{{ asset('storage/' . auth()->user()->companyProfile->logo) }}" class="w-full h-full object-cover">
                            @elseif(!auth()->user()->isPerusahaan() && !auth()->user()->isAdmin() && auth()->user()->userProfile?->avatar_url)
                                <img src="{{ asset('storage/' . auth()->user()->userProfile->avatar_url) }}" class="w-full h-full object-cover">
                            @else
                                <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                                </svg>
                            @endif
                        </div>

                        <span class="text-sm font-semibold max-w-[120px] truncate">
                            @if(auth()->user()->isPerusahaan())
                                {{ auth()->user()->companyProfile?->nama_perusahaan ?? 'Perusahaan' }}
                            @elseif(auth()->user()->isAdmin())
                                Admin
                            @else
                                {{ auth()->user()->userProfile?->nama_lengkap ?? auth()->user()->name }}
                            @endif
                        </span>

                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div id="dropdown" class="hidden absolute right-0 mt-2 w-44 bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden z-[9999]">
                        @if(auth()->user()->isPerusahaan())
                            <a href="{{ route('perusahaan.profil') }}" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-[#f0f2f8] transition">
                                Profile
                            </a>
                        @elseif(auth()->user()->isAdmin())
                            <span class="block px-4 py-2.5 text-xs text-gray-400">Admin Panel</span>
                        @else
                            <a href="{{ route('profil.index') }}" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-[#f0f2f8] transition">
                                Profile
                            </a>
                        @endif
                        <div class="border-t border-gray-100"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>

            @else
                <a href="{{ route('login') }}"
                   class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-[#0f1e45] transition">
                    Login
                </a>
                <a href="{{ route('register') }}"
                   class="bg-[#0f1e45] text-white text-sm font-semibold px-5 py-2 rounded-xl hover:bg-[#1a2f5e] transition">
                    Register
                </a>
            @endauth
        </div>

    </div>
</header>

<script>
function toggleKontribusi() {
    const btn = document.querySelector('#kontribusi-wrapper button');
    const dropdown = document.getElementById('kontribusi-dropdown');
    const isHidden = dropdown.style.display === 'none' || dropdown.style.display === '';
    if (isHidden) {
        dropdown.style.display = 'block';
        document.getElementById('kontribusi-arrow').style.transform = 'rotate(180deg)';
    } else {
        dropdown.style.display = 'none';
        document.getElementById('kontribusi-arrow').style.transform = 'rotate(0deg)';
    }
}

document.addEventListener('click', function(e) {
    if (!e.target.closest('#kontribusi-wrapper')) {
        const d = document.getElementById('kontribusi-dropdown');
        if (d) d.style.display = 'none';
        const arrow = document.getElementById('kontribusi-arrow');
        if (arrow) arrow.style.transform = 'rotate(0deg)';
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
