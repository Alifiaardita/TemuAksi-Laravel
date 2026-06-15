```blade
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pengeluaran Sponsorship</title>

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
            width: 180px;
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
            vertical-align: top;
        }

        table.riwayat td.num {
            text-align: right;
        }

        .total-row td {
            font-weight: bold;
            background: #f8fafc;
        }

        .ttd-section {
            margin-top: 50px;
            width: 100%;
        }

        .ttd-section table {
            width: 100%;
        }

        .ttd-box {
            width: 50%;
            text-align: center;
            vertical-align: top;
        }

        .ttd-space {
            height: 70px;
        }

        .ttd-name {
            font-weight: bold;
            border-top: 1px solid #1a202c;
            display: inline-block;
            padding-top: 4px;
            min-width: 200px;
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

    {{-- HEADER --}}
    <div class="header">
        <h1>Laporan Pengeluaran Sponsorship</h1>
        <p>Laporan Pendanaan Program / Kegiatan</p>
    </div>

    <div class="nomor">
        Nomor: LPS/{{ now()->format('Y') }}/{{ str_pad($totalAcara, 3, '0', STR_PAD_LEFT) }}
    </div>

    <p style="text-align: justify;">
        Dokumen ini merupakan laporan resmi pengeluaran dana sponsorship yang telah
        disalurkan kepada berbagai program atau kegiatan melalui platform TemuAksi.
        Laporan ini disusun sebagai bentuk dokumentasi dan pertanggungjawaban atas
        seluruh dana yang telah diberikan selama periode pelaporan.
    </p>

    {{-- BAGIAN 1 --}}
    <div class="pasal">
        <h3>Bagian 1 — Ringkasan Pengeluaran</h3>

        <table class="detail-table">
            <tr>
                <td class="key">Periode Laporan</td>
                <td>
                    :
                    @if($periodeAwal && $periodeAkhir)
                        {{ \Carbon\Carbon::parse($periodeAwal)->translatedFormat('d F Y') }}
                        s/d
                        {{ \Carbon\Carbon::parse($periodeAkhir)->translatedFormat('d F Y') }}
                    @else
                        Semua Periode
                    @endif
                </td>
            </tr>

            <tr>
                <td class="key">Jumlah Acara Didanai</td>
                <td>: {{ $totalAcara }} Acara</td>
            </tr>

            <tr>
                <td class="key">Acara Selesai</td>
                <td>: {{ $acaraSelesai }} Acara</td>
            </tr>

            <tr>
                <td class="key">Acara Berlangsung</td>
                <td>: {{ $acaraBerlangsung }} Acara</td>
            </tr>

            <tr>
                <td class="key">Total Dana Dikeluarkan</td>
                <td class="jumlah-besar">
                    : Rp {{ number_format($totalDana, 0, ',', '.') }}
                </td>
            </tr>
        </table>
    </div>

    {{-- BAGIAN 2 --}}
    <div class="pasal">
        <h3>Bagian 2 — Rincian Pendanaan Program</h3>

        @if($riwayat->isEmpty())
            <p>Belum terdapat data pengeluaran sponsorship.</p>
        @else

        <table class="riwayat">
            <thead>
                <tr>
                    <th style="width:40px;">No</th>
                    <th>Judul Acara</th>
                    <th>Penyelenggara</th>
                    <th>Lokasi</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th style="width:120px;">Dana (Rp)</th>
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
                            {{ $item->proposal->judul }}
                        </td>

                        <td>
                            {{ $item->proposal->user->nama ?? ($item->proposal->penyelenggara ?? '-') }}
                        </td>

                        <td>
                            {{ $item->proposal->lokasi ?? '-' }}
                        </td>

                        <td>
                            {{ $tgl->translatedFormat('d M Y') }}
                        </td>

                        <td>
                            {{ $isSelesai ? 'Selesai' : 'Berlangsung' }}
                        </td>

                        <td class="num">
                            {{ number_format($item->jumlah_dana, 0, ',', '.') }}
                        </td>
                    </tr>

                @endforeach

                <tr class="total-row">
                    <td colspan="6" style="text-align:right;">
                        TOTAL PENGELUARAN
                    </td>

                    <td class="num">
                        {{ number_format($totalDana, 0, ',', '.') }}
                    </td>
                </tr>

            </tbody>
        </table>

        @endif
    </div>

    {{-- BAGIAN 3 --}}
    <div class="pasal">
        <h3>Bagian 3 — Pernyataan</h3>

        <p style="text-align: justify;">
            Dengan diterbitkannya laporan ini, seluruh data pengeluaran sponsorship
            yang tercantum dinyatakan sesuai dengan data yang tersimpan pada sistem
            TemuAksi dan digunakan sebagai bentuk dokumentasi resmi atas aktivitas
            pendanaan yang telah dilakukan.
        </p>
    </div>

    {{-- TANDA TANGAN --}}
    <div class="ttd-section">
        <table>
            <tr>
                <td></td>

                <td class="ttd-box">
                    <p>
                        Surabaya,
                        {{ now()->translatedFormat('d F Y') }}
                    </p>

                    <div class="ttd-space"></div>

                    <span class="ttd-name">
                        {{ auth()->user()->nama ?? auth()->user()->nama_perusahaan }}
                    </span>

                    <br>

                    <small>Perwakilan Perusahaan</small>
                </td>
            </tr>
        </table>
    </div>

    <div class="footer-note">
        Dokumen ini dibuat secara elektronik oleh sistem TemuAksi pada
        {{ now()->format('d-m-Y H:i') }}.
    </div>

</body>
</html>
```
