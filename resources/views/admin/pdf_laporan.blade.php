<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan Sponsorship</title>

    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #1a202c;
            line-height: 1.6;
        }

        .header {
            text-align: center;
            margin-bottom: 24px;
            border-bottom: 2px solid #081F5C;
            padding-bottom: 12px;
        }

        .header h1 {
            font-size: 18px;
            color: #081F5C;
            margin: 0 0 4px;
            text-transform: uppercase;
        }

        .header p {
            font-size: 11px;
            color: #555;
            margin: 0;
        }

        .nomor {
            text-align: center;
            margin-bottom: 20px;
            font-size: 12px;
        }

        .pasal {
            margin-top: 18px;
        }

        .pasal h3 {
            font-size: 13px;
            color: #081F5C;
            margin: 0 0 6px;
            border-bottom: 1px solid #dce6f0;
            padding-bottom: 4px;
        }

        .detail-table {
            width: 100%;
            margin-top: 6px;
            border-collapse: collapse;
        }

        .detail-table td {
            padding: 4px 0;
            vertical-align: top;
        }

        .detail-table .key {
            width: 220px;
            color: #555;
        }

        table.riwayat {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.riwayat th {
            background: #f5f7fa;
            border: 1px solid #dce6f0;
            padding: 8px;
            color: #081F5C;
            font-size: 11px;
            text-align: left;
        }

        table.riwayat td {
            border: 1px solid #dce6f0;
            padding: 8px;
            font-size: 11px;
        }

        .total-row td {
            font-weight: bold;
            background: #f8fafc;
        }

        .ttd-section {
            margin-top: 50px;
            width: 100%;
        }

        .ttd-box {
            width: 50%;
            text-align: center;
            margin-left: auto;
        }

        .ttd-space {
            height: 70px;
        }

        .ttd-name {
            font-weight: bold;
            border-top: 1px solid #1a202c;
            display: inline-block;
            padding-top: 4px;
            min-width: 220px;
        }

        .footer-note {
            margin-top: 30px;
            font-size: 10px;
            color: #888;
            text-align: center;
        }

        .jumlah-besar {
            font-size: 14px;
            font-weight: bold;
            color: #081F5C;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Laporan Keuangan Sponsorship</h1>
    <p>Laporan Rekapitulasi Proposal dan Pendanaan TemuAksi</p>
</div>

<div class="nomor">
    Nomor:
    LKS/{{ now()->format('Y') }}/{{ str_pad(
        count($data['terkirim']) +
        count($data['pendanaan']) +
        count($data['selesai']) +
        count($data['ditolak']),
        3,
        '0',
        STR_PAD_LEFT
    ) }}
</div>

<p style="text-align: justify;">
    Dokumen ini merupakan laporan resmi yang berisi rekapitulasi seluruh
    proposal sponsorship yang diproses melalui sistem TemuAksi. Laporan ini
    digunakan sebagai dokumentasi dan monitoring terhadap aktivitas pengajuan,
    pendanaan, penyelesaian, maupun penolakan proposal sponsorship.
</p>

<div class="pasal">
    <h3>Bagian 1 — Ringkasan Laporan</h3>

    <table class="detail-table">
        <tr>
            <td class="key">Proposal Terkirim</td>
            <td>: {{ count($data['terkirim']) }} Proposal</td>
        </tr>

        <tr>
            <td class="key">Proposal Pendanaan</td>
            <td>: {{ count($data['pendanaan']) }} Proposal</td>
        </tr>

        <tr>
            <td class="key">Proposal Selesai</td>
            <td>: {{ count($data['selesai']) }} Proposal</td>
        </tr>

        <tr>
            <td class="key">Proposal Ditolak</td>
            <td>: {{ count($data['ditolak']) }} Proposal</td>
        </tr>

        <tr>
            <td class="key">Total Dana Tersalurkan</td>
            <td class="jumlah-besar">
                : Rp {{ number_format($totalSelesai ?? 0, 0, ',', '.') }}
            </td>
        </tr>
    </table>
</div>

<div class="pasal">
    <h3>Bagian 2 — Proposal Terkirim</h3>

    @include('admin.partials.table_laporan', [
        'rows' => $data['terkirim'],
        'withTotal' => false
    ])
</div>

<div class="pasal">
    <h3>Bagian 3 — Proposal Pendanaan</h3>

    @include('admin.partials.table_laporan', [
        'rows' => $data['pendanaan'],
        'withTotal' => false
    ])
</div>

<div class="pasal">
    <h3>Bagian 4 — Proposal Selesai</h3>

    @include('admin.partials.table_laporan', [
        'rows' => $data['selesai'],
        'withTotal' => true,
        'total' => $totalSelesai
    ])
</div>

<div class="pasal">
    <h3>Bagian 5 — Proposal Ditolak</h3>

    @include('admin.partials.table_laporan', [
        'rows' => $data['ditolak'],
        'withTotal' => false
    ])
</div>

<div class="pasal">
    <h3>Bagian 6 — Pernyataan</h3>

    <p style="text-align: justify;">
        Dengan diterbitkannya laporan ini, seluruh data proposal sponsorship
        yang tercantum dinyatakan sesuai dengan data yang tersimpan pada sistem
        TemuAksi dan digunakan sebagai bentuk dokumentasi resmi atas aktivitas
        pengajuan, pendanaan, penyelesaian, dan penolakan proposal.
    </p>
</div>

<div class="ttd-section">
    <div class="ttd-box">
        <p>
            Surabaya,
            {{ now()->translatedFormat('d F Y') }}
        </p>

        <div class="ttd-space"></div>

        <span class="ttd-name">
            Administrator TemuAksi
        </span>

        <br>

        <small>Administrator Sistem</small>
    </div>
</div>

<div class="footer-note">
    Dokumen ini dibuat secara elektronik oleh sistem TemuAksi pada
    {{ now()->format('d-m-Y H:i') }}.
</div>

</body>
</html>

