@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')

{{-- HEADER --}}
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-medium text-gray-800">Dashboard Admin</h1>
        <p class="text-sm text-gray-500 mt-0.5">
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }} — TemuAksi Admin Panel
        </p>
    </div>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit"
            class="flex items-center gap-2 border border-gray-200 rounded-xl px-4 py-2 text-sm bg-white hover:bg-gray-50 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1"/>
            </svg>
            Logout
        </button>
    </form>
</div>

{{-- STATISTIK --}}
<div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-3 mb-6">

    <div class="bg-white rounded-2xl border border-gray-100 p-4">
        <p class="text-xs text-gray-500 mb-1">👤 Akun Aktif</p>
        <h2 class="text-3xl font-medium">{{ $akunAktif }}</h2>
        <span class="inline-block mt-2 text-xs px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-600">
            {{ $akunAktif - $perusahaanAktif }} organizer
        </span>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 p-4">
        <p class="text-xs text-gray-500 mb-1">🏢 Perusahaan Aktif</p>
        <h2 class="text-3xl font-medium">{{ $perusahaanAktif }}</h2>
        <span class="inline-block mt-2 text-xs px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-600">Sponsor</span>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 p-4">
        <p class="text-xs text-gray-500 mb-1">💰 Pendanaan Tersalurkan</p>
        <h2 class="text-3xl font-medium">{{ $pendanaanTersalurkan }}</h2>
        <span class="inline-block mt-2 text-xs px-2.5 py-0.5 rounded-full bg-gray-100 text-gray-500">Transaksi</span>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 p-4">
        <p class="text-xs text-gray-500 mb-1">📊 Total Dana Tersalurkan</p>
        <h2 class="text-xl font-medium text-blue-600">Rp {{ number_format($totalDana, 0, ',', '.') }}</h2>
        <span class="inline-block mt-2 text-xs px-2.5 py-0.5 rounded-full bg-green-50 text-green-600">Tersalurkan</span>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 p-4">
        <p class="text-xs text-gray-500 mb-1">🤝 Volunteer Dibuka</p>
        <h2 class="text-3xl font-medium">{{ $volunteerOpen }}</h2>
        <span class="inline-block mt-2 text-xs px-2.5 py-0.5 rounded-full bg-orange-50 text-orange-600">Slot aktif</span>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 p-4">
        <p class="text-xs text-gray-500 mb-1">🎫 Skema Sponsor Dibuka</p>
        <h2 class="text-3xl font-medium text-yellow-500">{{ $openSponsor }}</h2>
        <span class="inline-block mt-2 text-xs px-2.5 py-0.5 rounded-full bg-pink-50 text-pink-600">Skema Aktif</span>
    </div>

</div>

{{-- CHARTS --}}
<div class="grid lg:grid-cols-2 gap-4 mb-6">
    <div class="bg-white rounded-2xl border border-gray-100 p-5">
        <h2 class="text-base font-medium mb-4">Kegiatan Volunteer dibuka per bulan</h2>
        <div style="position: relative; height: 250px;">
            <canvas id="barChart"></canvas>
        </div>
    </div>
    <div class="bg-white rounded-2xl border border-gray-100 p-5">
        <h2 class="text-base font-medium mb-4">Status Proposal</h2>
        <div style="position: relative; height: 250px;">
            <canvas id="donutChart"></canvas>
        </div>
    </div>
</div>

{{-- BOTTOM GRID --}}
<div class="grid lg:grid-cols-2 gap-4">

    {{-- SEMUA AKUN --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-5">
        <h2 class="text-base font-medium mb-3">👤 Semua akun</h2>
        <div class="flex gap-2 mb-4">
            <a href="{{ route('admin.dashboard', ['role' => 'organizer']) }}"
            class="text-xs px-3 py-1 rounded-full {{ $roleFilter == 'organizer' ? 'bg-blue-600 text-white' : 'bg-blue-50 text-blue-600' }}">
                {{ $jumlahOrganizer }} Organizer
            </a>

            <a href="{{ route('admin.dashboard', ['role' => 'perusahaan']) }}"
            class="text-xs px-3 py-1 rounded-full {{ $roleFilter == 'perusahaan' ? 'bg-red-500 text-white' : 'bg-red-100 text-gray-600' }}">
                {{ $jumlahPerusahaan }} Perusahaan
            </a>

            <a href="{{ route('admin.dashboard', ['role' => 'admin']) }}"
            class="text-xs px-3 py-1 rounded-full {{ $roleFilter == 'admin' ? 'bg-green-600 text-white' : 'bg-green-100 text-green-600' }}">
                {{ $jumlahAdmin }} Admin 
            </a>

            <a href="{{ route('admin.dashboard') }}"
            class="text-xs px-3 py-1 rounded-full bg-slate-100 text-slate-600">
                Semua
            </a>
        </div>
        <div class="space-y-2 max-h-80 overflow-y-auto">
            @foreach($users as $user)
                @php
                    $nama = $user->role === 'perusahaan'
                        ? ($user->companyProfile?->nama_perusahaan ?? '-')
                        : ($user->userProfile?->nama_lengkap ?? '-');
                    $initials = collect(explode(' ', $nama))->take(2)->map(fn($w) => strtoupper($w[0] ?? ''))->implode('');
                    $colors = ['bg-blue-50 text-blue-600','bg-green-50 text-green-600','bg-purple-50 text-purple-600','bg-pink-50 text-pink-600'];
                    $color = $colors[$loop->index % 4];
                @endphp
                <a href="{{ route('admin.user.edit', $user->id) }}"
                   class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 hover:bg-gray-50 transition">
                    <div class="w-9 h-9 rounded-full flex items-center justify-center text-xs font-medium {{ $color }} flex-shrink-0">
                        {{ $initials }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium truncate">{{ $nama }}</p>
                        <p class="text-xs text-gray-500 capitalize">{{ $user->role }}</p>
                    </div>
                    <span class="text-xs px-2.5 py-1 rounded-full
                        {{ $user->status == 'aktif' ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-500' }}">
                        {{ ucfirst($user->status) }}
                    </span>
                </a>
            @endforeach
        </div>
    </div>

    {{-- PERUSAHAAN + AKTIVITAS --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-5">
        <h2 class="text-base font-medium mb-4">🏢 Perusahaan & sponsor</h2>
        <div class="divide-y divide-gray-100">
            @foreach($perusahaan as $item)
                <a href="{{ route('admin.company.show', $item->id) }}" class="block py-3 hover:bg-gray-50 transition rounded-lg px-1">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium">{{ $item->companyProfile->nama_perusahaan ?? '-' }}</p>
                            <p class="text-xs text-gray-500">{{ $item->email }}</p>
                        </div>
                        <span class="text-xs px-2.5 py-1 rounded-full bg-green-50 text-green-600">Aktif</span>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">
                        Dana: <span class="font-medium text-green-600">Rp {{ number_format($item->total_dana ?? 0, 0, ',', '.') }}</span>
                    </p>
                </a>
            @endforeach
        </div>

        {{-- AKTIVITAS --}}
        <div class="mt-5">
            <h3 class="text-sm font-medium mb-3">〰 Aktivitas terbaru</h3>
            <div class="space-y-3">
                @foreach($aktivitas ?? [] as $act)
                    <div class="flex items-start gap-3">
                        <div class="w-2 h-2 rounded-full mt-1.5 flex-shrink-0
                            {{ $act->type === 'organizer' ? 'bg-green-500' : 'bg-blue-500' }}"></div>
                        <div>
                            <p class="text-sm">{{ $act->description }}</p>
                            <p class="text-xs text-gray-400">{{ $act->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const textColor = '#9ca3af';
    const gridColor = 'rgba(0,0,0,0.05)';

    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartLabels ?? ['Jan','Feb','Mar','Apr','Mei','Jun']) !!},
            datasets: [{
                data: {!! json_encode($chartData ?? [0,0,0,0,0,0]) !!},
                backgroundColor: '#4a6cf7',
                borderRadius: 6,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false }, ticks: { color: textColor, font: { size: 11 } } },
                y: { grid: { color: gridColor }, ticks: { color: textColor, font: { size: 11 }, stepSize: 1 }, beginAtZero: true }
            }
        }
    });

    new Chart(document.getElementById('donutChart'), {
        type: 'doughnut',
        data: {
            labels: ['Terkirim', 'Pendanaan', 'Selesai', 'Ditolak'],
            datasets: [{
                data: [
                    {{ $proposalTerkirim }},
                    {{ $proposalPendanaan }},
                    {{ $proposalSelesai }},
                    {{ $proposalDitolak }}
                ],
                backgroundColor: [
                    '#facc15', // kuning
                    '#4a6cf7', // biru
                    '#a5d6a7', // hijau
                    '#ef4444'  // merah
                ],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '60%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { color: textColor, font: { size: 12 }, padding: 16, boxWidth: 12 }
                }
            }
        }
    });
});
</script>
@endpush