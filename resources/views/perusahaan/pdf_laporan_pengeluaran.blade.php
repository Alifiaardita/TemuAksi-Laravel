<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pengeluaran Sponsorship</title>
    <style>
        @page {
            margin: 30px 40px;
        }
        * {
            font-family: 'Helvetica', Arial, sans-serif;
            box-sizing: border-box;
        }
        body {
            color: #1a202c;
            font-size: 12px;
        }

        /* Header */
        .header {
            border-bottom: 3px solid #4a6cf7;
            padding-bottom: 14px;
            margin-bottom: 20px;
            overflow: hidden;
        }
        .header-left {
            float: left;
            width: 60%;
        }
        .header-right {
            float: right;
            width: 40%;
            text-align: right;
        }
        .header-title {
            font-size: 10px;
            color: #9baec8;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin: 0 0 4px;
        }
        .header-company {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
            color: #0f1e45;
        }
        .header-periode {
            font-size: 11px;
            color: #718096;
            margin: 4px 0 0;
        }
        .header-total-label {
            font-size: 10px;
            color: #9baec8;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin: 0 0 4px;
        }
        .header-total-value {
            font-size: 20px;
            font-weight: bold;
            color: #4a6cf7;
            margin: 0;
        }
        .header-total-sub {
            font-size: 10px;
            color: #9baec8;
            margin: 2px 0 0;
        }

        /* Summary cards */
        .summary {
            width: 100%;
            margin-bottom: 22px;
        }
        .summary td {
            width: 33.33%;
            padding: 12px 14px;
            border: 1px solid #e8edf2;
            border-radius: 8px;
        }
        .summary-value {
            font-size: 18px;
            font-weight: bold;
            color: #0f1e45;
            margin: 0;
        }
        .summary-label {
            font-size: 10px;
            color: #9baec8;
            margin: 2px 0 0;
        }

        /* Section title */
        .section-title {
            font-size: 11px;
            font-weight: bold;
            color: #9baec8;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin: 0 0 10px;
            padding-bottom: 6px;
            border-bottom: 1px solid #e8edf2;
        }

        /* Program realisasi */
        .program-row {
            margin-bottom: 12px;
        }
        .program-name {
            font-size: 11px;
            color: #2d3748;
        }
        .program-total {
            font-size: 11px;
            font-weight: bold;
            color: #1a202c;
            text-align: right;
        }
        .program-bar-bg {
            background: #edf2f7;
            border-radius: 4px;
            height: 5px;
            margin-top: 4px;
            overflow: hidden;
        }
        .program-bar-fill {
            background: #4a6cf7;
            height: 5px;
        }
        .program-sub {
            font-size: 9px;
            color: #a0aec0;
            margin-top: 3px;
        }

        /* Table */
        table.riwayat {
            width: 100%;
            border-collapse: collapse;
            margin-top: 4px;
        }
        table.riwayat th {
            background: #f7f9fc;
            color: #9baec8;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            text-align: left;
            padding: 8px 10px;
            border-bottom: 1px solid #e8edf2;
        }
        table.riwayat td {
            padding: 8px 10px;
            font-size: 10.5px;
            color: #2d3748;
            border-bottom: 1px solid #f0f2f8;
            vertical-align: top;
        }
        table.riwayat td.num {
            text-align: right;
            font-weight: bold;
            color: #1a202c;
            white-space: nowrap;
        }
        .judul-acara {
            font-weight: bold;
            color: #0f1e45;
        }
        .meta-acara {
            font-size: 9px;
            color: #a0aec0;
        }
        .badge {
            display: inline-block;
            font-size: 9px;
            font-weight: bold;
            padding: 2px 8px;
            border-radius: 9999px;
        }
        .badge-selesai {
            background: #d4edda;
            color: #155724;
        }
        .badge-berlangsung {
            background: #fff3cd;
            color: #856404;
        }

        .total-row td {
            border-top: 2px solid #4a6cf7;
            border-bottom: none;
            font-weight: bold;
            padding-top: 10px;
        }

        .footer {
            margin-top: 24px;
            text-align: center;
            font-size: 9px;
            color: #a0aec0;
        }
    </style>
</head>
<body>

    {{-- Header --}}
    <div class="header">
        <div class="header-left">
            <p class="header-title">Laporan pengeluaran sponsorship</p>
            <p class="header-company">{{ auth()->user()->nama_perusahaan }}</p>
            <p class="header-periode">
                Periode:
                @if($periodeAwal && $periodeAkhir)
                    {{ \Carbon\Carbon::parse($periodeAwal)->translatedFormat('F Y') }} —
                    {{ \Carbon\Carbon::parse($periodeAkhir)->translatedFormat('F Y') }}
                @else
                    Semua waktu
                @endif
            </p>
        </div>
        <div class="header-right">
            <p class="header-total-label">Total dikeluarkan</p>
            <p class="header-total-value">Rp {{ number_format($totalDana, 0, ',', '.') }}</p>
            <p class="header-total-sub">dari {{ $totalAcara }} acara yang didanai</p>
        </div>
    </div>

    {{-- Summary cards --}}
    <table class="summary">
        <tr>
            <td>
                <p class="summary-value">{{ $totalAcara }}</p>
                <p class="summary-label">ACARA DIDANAI</p>
            </td>
            <td>
                <p class="summary-value">{{ $acaraSelesai }}</p>
                <p class="summary-label">SUDAH SELESAI</p>
            </td>
            <td>
                <p class="summary-value">{{ $acaraBerlangsung }}</p>
                <p class="summary-label">SEDANG BERJALAN</p>
            </td>
        </tr>
    </table>

    {{-- Realisasi per program --}}
    @if($perProgram->isNotEmpty())
    <p class="section-title">Realisasi anggaran per program</p>
    @foreach($perProgram as $program)
        @php
            $persen = $totalDana > 0 ? round(($program->total / $totalDana) * 100) : 0;
        @endphp
        <div class="program-row">
            <table style="width:100%;">
                <tr>
                    <td class="program-name">{{ $program->nama_program }}</td>
                    <td class="program-total">Rp {{ number_format($program->total, 0, ',', '.') }}</td>
                </tr>
            </table>
            <div class="program-bar-bg">
                <div class="program-bar-fill" style="width: {{ $persen }}%;"></div>
            </div>
            <p class="program-sub">{{ $persen }}% dari total &middot; {{ $program->jumlah_acara }} acara</p>
        </div>
    @endforeach
    @endif

    {{-- Rincian per acara --}}
    <p class="section-title" style="margin-top: 18px;">Rincian per acara</p>

    @if($riwayat->isEmpty())
        <p style="text-align:center; color:#a0aec0; padding: 20px 0;">Belum ada pengeluaran sponsorship</p>
    @else
    <table class="riwayat">
        <thead>
            <tr>
                <th style="width: 24px;">#</th>
                <th>Acara</th>
                <th style="width: 110px;">Program</th>
                <th style="width: 70px;">Status</th>
                <th style="width: 90px; text-align:right;">Dana</th>
            </tr>
        </thead>
        <tbody>
            @foreach($riwayat as $item)
                @php
                    $tgl = \Carbon\Carbon::parse($item->proposal->tanggal);
                    $isSelesai = $tgl->isPast();
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <p class="judul-acara">{{ $item->proposal->judul }}</p>
                        <p class="meta-acara">
                            {{ $item->proposal->lokasi ?? '—' }} &middot;
                            {{ $tgl->translatedFormat('d M Y') }}
                        </p>
                    </td>
                    <td>{{ $item->proposal->sponsor->nama ?? '—' }}</td>
                    <td>
                        @if($isSelesai)
                            <span class="badge badge-selesai">Selesai</span>
                        @else
                            <span class="badge badge-berlangsung">Berlangsung</span>
                        @endif
                    </td>
                    <td class="num">Rp {{ number_format($item->jumlah_dana, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="4" style="text-align:right; color:#0f1e45;">Total pengeluaran</td>
                <td class="num" style="color:#4a6cf7; font-size:12px;">Rp {{ number_format($totalDana, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
    @endif

    <p class="footer">
        Dokumen dibuat otomatis oleh sistem TemuAksi &middot; {{ now()->translatedFormat('d F Y, H:i') }} WIB
    </p>

</body>
</html>