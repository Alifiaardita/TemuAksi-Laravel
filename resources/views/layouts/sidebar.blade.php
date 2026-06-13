<aside class="w-60 min-h-screen flex flex-col border-r border-white/10" style="background: #0f1e45;">

    {{-- LOGO --}}
    <div class="px-6 py-5 border-b border-white/10">
        <h1 class="text-xl font-bold text-white">TemuAksi</h1>
        <p class="text-xs mt-0.5" style="color: rgba(255,255,255,0.4);">Admin Panel</p>
    </div>

    {{-- NAV --}}
    <nav class="flex flex-col gap-1 px-3 py-4 flex-1">

        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition"
           style="{{ request()->routeIs('admin.dashboard') ? 'background:#4a6cf7; color:white;' : 'color:rgba(255,255,255,0.6);' }}"
           onmouseover="{{ request()->routeIs('admin.dashboard') ? '' : 'this.style.background=\"rgba(255,255,255,0.08)\"; this.style.color=\"white\"' }}"
           onmouseout="{{ request()->routeIs('admin.dashboard') ? '' : 'this.style.background=\"transparent\"; this.style.color=\"rgba(255,255,255,0.6)\"' }}">
            <i class="ti ti-layout-dashboard" style="font-size:18px;"></i> Dashboard
        </a>

        <a href="{{ route('admin.user.index') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition"
           style="{{ request()->routeIs('admin.user.*') ? 'background:#4a6cf7; color:white;' : 'color:rgba(255,255,255,0.6);' }}"
           onmouseover="{{ request()->routeIs('admin.user.*') ? '' : 'this.style.background=\"rgba(255,255,255,0.08)\"; this.style.color=\"white\"' }}"
           onmouseout="{{ request()->routeIs('admin.user.*') ? '' : 'this.style.background=\"transparent\"; this.style.color=\"rgba(255,255,255,0.6)\"' }}">
            <i class="ti ti-users" style="font-size:18px;"></i> Kelola User
        </a>

        <a href="{{ route('admin.company.index') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition"
           style="{{ request()->routeIs('admin.company.*') ? 'background:#4a6cf7; color:white;' : 'color:rgba(255,255,255,0.6);' }}"
           onmouseover="{{ request()->routeIs('admin.company.*') ? '' : 'this.style.background=\"rgba(255,255,255,0.08)\"; this.style.color=\"white\"' }}"
           onmouseout="{{ request()->routeIs('admin.company.*') ? '' : 'this.style.background=\"transparent\"; this.style.color=\"rgba(255,255,255,0.6)\"' }}">
            <i class="ti ti-building" style="font-size:18px;"></i> Kelola Perusahaan
        </a>

        <a href="{{ route('admin.laporan.index') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition"
           style="{{ request()->routeIs('admin.laporan.*') ? 'background:#4a6cf7; color:white;' : 'color:rgba(255,255,255,0.6);' }}"
           onmouseover="{{ request()->routeIs('admin.laporan.*') ? '' : 'this.style.background=\"rgba(255,255,255,0.08)\"; this.style.color=\"white\"' }}"
           onmouseout="{{ request()->routeIs('admin.laporan.*') ? '' : 'this.style.background=\"transparent\"; this.style.color=\"rgba(255,255,255,0.6)\"' }}">
            <i class="ti ti-file-description" style="font-size:18px;"></i> Laporan
        </a>

    </nav>
</aside>