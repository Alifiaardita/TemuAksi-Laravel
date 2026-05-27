<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>Laporan Keuangan</title>

    <style>

        body{
            font-family: sans-serif;
            font-size: 14px;
        }

        h2,h3{
            margin-bottom: 10px;
        }

        table{
            width:100%;
            border-collapse: collapse;
            margin-bottom:20px;
        }

        table, th, td{
            border:1px solid #000;
        }

        th{
            background:#eee;
        }

        th, td{
            padding:8px;
        }

        .text-center{
            text-align:center;
        }

    </style>
</head>

<body>

    <h2 class="text-center">
        LAPORAN KEUANGAN
    </h2>

    <p class="text-center">
        Dicetak pada:
        {{ now()->timezone('Asia/Jakarta')->format('d-m-Y H:i:s') }} WIB
    </p>

    <hr>

    {{-- 1. TERKIRIM --}}
    <h3>1. Proposal Terkirim</h3>

    @include('admin.partials.table_laporan', [
        'rows' => $data['terkirim'],
        'withTotal' => false
    ])


    {{-- 2. PENDANAAN --}}
    <h3>2. Proposal Pendanaan</h3>

    @include('admin.partials.table_laporan', [
        'rows' => $data['pendanaan'],
        'withTotal' => false
    ])


    {{-- 3. SELESAI --}}
    <h3>3. Proposal Selesai</h3>

    @include('admin.partials.table_laporan', [
        'rows' => $data['selesai'],
        'withTotal' => true,
        'total' => $totalSelesai
    ])


    {{-- 4. DITOLAK --}}
    <h3>4. Proposal Ditolak</h3>

    @include('admin.partials.table_laporan', [
        'rows' => $data['ditolak'],
        'withTotal' => false
    ])

</body>
</html>