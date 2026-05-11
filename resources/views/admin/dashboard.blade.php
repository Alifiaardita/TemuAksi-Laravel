@extends('layouts.app')
@section('title', 'Dashboard Admin')
@push('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')
<div class="flex">
    @include('layouts.side')
    <main class="flex-1 p-8">
        <h1 class="text-3xl font-bold mb-8 text-cornflower">📊 Dashboard Admin</h1>

        {{-- Card Lama --}}
        <div class="grid md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white p-6 rounded-2xl shadow">
                <h3 class="text-gray-500 text-sm">Total User</h3>
                <p class="text-3xl font-bold">{{ $totalUser }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow">
                <h3 class="text-gray-500 text-sm">Total Proposal</h3>
                <p class="text-3xl font-bold">{{ $totalProposal }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow">
                <h3 class="text-gray-500 text-sm">Proposal Terkirim</h3>
                <p class="text-3xl font-bold text-yellow-500">{{ $terkirim }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow">
                <h3 class="text-gray-500 text-sm">Proposal Selesai</h3>
                <p class="text-3xl font-bold text-green-500">{{ $selesai }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow">
                <h3 class="text-gray-500 text-sm">Total Sponsor</h3>
                <p class="text-3xl font-bold">{{ $totalSponsor }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow">
                <h3 class="text-gray-500 text-sm">Total Pendanaan</h3>
                <p class="text-3xl font-bold text-purple-600">{{ $totalPendanaan }}</p>
            </div>
        </div>

        {{-- Card Baru --}}
        <div class="grid md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white p-5 rounded-2xl shadow">
                <p class="text-gray-500 text-sm">Proposal Selesai (Progress)</p>
                <h2 class="text-2xl font-bold">{{ $proposalProgress['selesai'] }} / {{ $proposalProgress['total'] }}</h2>
            </div>
            <div class="bg-white p-5 rounded-2xl shadow">
                <p class="text-gray-500 text-sm">Pendanaan vs Selesai</p>
                <h2 class="text-2xl font-bold">{{ $pendanaanVsSelesai['pendanaan'] }} / {{ $pendanaanVsSelesai['selesai'] }}</h2>
            </div>
            <div class="bg-white p-5 rounded-2xl shadow">
                <p class="text-gray-500 text-sm">Total Dana</p>
                <h2 class="text-2xl font-bold text-green-600">Rp {{ number_format($totalDana, 0, ',', '.') }}</h2>
            </div>
        </div>

        {{-- Chart Perusahaan --}}
        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Grafik Perusahaan</h2>
            @foreach($perusahaan as $p)
                <div class="mb-10">
                    <h3 class="font-bold mb-2">{{ $p->companyProfile?->nama_perusahaan ?? $p->email }}</h3>
                    <canvas id="chart{{ $p->id }}" height="100"></canvas>
                </div>
                @push('scripts')
                <script>
                (function(){
                    const data = {!! json_encode($chartData[$p->id]) !!};
                    const bulanMap = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
                    new Chart(document.getElementById('chart{{ $p->id }}'), {
                        type: 'line',
                        data: {
                            labels: data.map(d => bulanMap[d.bulan - 1]),
                            datasets: [
                                { label:'Didanai', data: data.map(d => d.didanai), borderColor:'#3b82f6' },
                                { label:'Selesai', data: data.map(d => d.selesai), borderColor:'#22c55e' },
                                { label:'Ditolak', data: data.map(d => d.ditolak), borderColor:'#ef4444' },
                            ]
                        },
                        options: { responsive: true, plugins: { legend: { display: true } } }
                    });
                })();
                </script>
                @endpush
            @endforeach
        </div>
    </main>
</div>
@endsection
