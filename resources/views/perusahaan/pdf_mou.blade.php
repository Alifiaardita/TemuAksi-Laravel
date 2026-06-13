<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>MOU - {{ $proposal->judul }}</title>
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
        .pihak {
            margin-bottom: 16px;
        }
        .pihak table {
            width: 100%;
        }
        .pihak td {
            vertical-align: top;
            padding: 2px 0;
        }
        .label-col {
            width: 140px;
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
        .pasal p, .pasal ul {
            margin: 4px 0;
            text-align: justify;
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
            width: 160px;
            color: #555;
        }
        .target-dana {
            font-size: 14px;
            font-weight: bold;
            color: #081F5C;
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
            padding: 0 20px;
        }
        .ttd-space {
            height: 70px;
        }
        .ttd-name {
            font-weight: bold;
            border-top: 1px solid #1a202c;
            display: inline-block;
            padding-top: 4px;
            min-width: 180px;
        }
        .footer-note {
            margin-top: 30px;
            font-size: 10px;
            color: #888;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Memorandum of Understanding (MOU)</h1>
        <p>Kesepakatan Pendanaan Program / Kegiatan</p>
    </div>

    <div class="nomor">
        Nomor: MOU/{{ str_pad($proposal->id, 5, '0', STR_PAD_LEFT) }}/{{ now()->format('m/Y') }}
    </div>

    <p style="text-align: justify;">
        Pada hari ini, {{ now()->translatedFormat('l, d F Y') }}, telah dicapai kesepakatan kerja sama
        pendanaan program/kegiatan antara pihak-pihak berikut:
    </p>

    {{-- PIHAK PERTAMA --}}
    <div class="pihak">
        <strong>PIHAK PERTAMA (Penyelenggara / Pengaju Proposal)</strong>
        <table>
            <tr>
                <td class="label-col">Nama</td>
                <td>: {{ $proposal->user->userProfile->nama_lengkap ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-col">Email</td>
                <td>: {{ $proposal->user->email ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-col">No. Telepon</td>
                <td>: {{ $proposal->user->userProfile->no_telepon ?? '-' }}</td>
            </tr>
        </table>
    </div>

    {{-- PIHAK KEDUA --}}
    <div class="pihak">
        <strong>PIHAK KEDUA (Perusahaan / Pemberi Dana)</strong>
        <table>
            <tr>
                <td class="label-col">Nama Perusahaan</td>
                <td>: {{ $proposal->sponsor->user->companyProfile->nama_perusahaan ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-col">Alamat</td>
                <td>: {{ $proposal->sponsor->user->companyProfile->alamat ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-col">No. Telepon</td>
                <td>: {{ $proposal->sponsor->user->companyProfile->no_telepon ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-col">Bidang Industri</td>
                <td>: {{ $proposal->sponsor->user->companyProfile->bidang_industri ?? '-' }}</td>
            </tr>
        </table>
    </div>

    {{-- PASAL 1 - DETAIL PROGRAM --}}
    <div class="pasal">
        <h3>Pasal 1 — Detail Program / Kegiatan</h3>
        <table class="detail-table">
            <tr>
                <td class="key">Judul Proposal</td>
                <td>: {{ $proposal->judul }}</td>
            </tr>
            <tr>
                <td class="key">Kategori</td>
                <td>: {{ $proposal->kategori }}</td>
            </tr>
            <tr>
                <td class="key">Lokasi</td>
                <td>: {{ $proposal->lokasi }}</td>
            </tr>
            <tr>
                <td class="key">Tanggal Pelaksanaan</td>
                <td>: {{ \Carbon\Carbon::parse($proposal->tanggal)->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td class="key">Deskripsi</td>
                <td>: {{ $proposal->deskripsi }}</td>
            </tr>
            <tr>
                <td class="key">Target Dana</td>
                <td>: Rp {{ number_format($proposal->target_dana, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    {{-- PASAL 2 - NOMINAL PENDANAAN --}}
    <div class="pasal">
        <h3>Pasal 2 — Nominal Pendanaan yang Disepakati</h3>
        <p>
            PIHAK KEDUA sepakat untuk memberikan dana kepada PIHAK PERTAMA sebesar:
        </p>
        <p class="target-dana">
            Rp {{ number_format(optional($proposal->pendanaan->last())->jumlah_dana ?? 0, 0, ',', '.') }}
        </p>
        <p>
            untuk digunakan sepenuhnya dalam mendukung pelaksanaan program/kegiatan
            sebagaimana dimaksud dalam Pasal 1.
        </p>
    </div>

    {{-- PASAL 3 - KEWAJIBAN --}}
    <div class="pasal">
        <h3>Pasal 3 — Hak dan Kewajiban</h3>
        <p>1. PIHAK PERTAMA berkewajiban menggunakan dana yang diberikan sesuai dengan rencana program/kegiatan yang telah diajukan.</p>
        <p>2. PIHAK PERTAMA berkewajiban menyampaikan laporan pertanggungjawaban penggunaan dana kepada PIHAK KEDUA setelah program/kegiatan selesai dilaksanakan.</p>
        <p>3. PIHAK KEDUA berkewajiban menyalurkan dana sesuai dengan nominal yang disepakati pada Pasal 2.</p>
        <p>4. PIHAK KEDUA berhak memperoleh informasi perkembangan pelaksanaan program/kegiatan dari PIHAK PERTAMA.</p>
    </div>

    {{-- PASAL 4 - PENUTUP --}}
    <div class="pasal">
        <h3>Pasal 4 — Penutup</h3>
        <p>
            Demikian Memorandum of Understanding ini dibuat dengan sebenar-benarnya dan
            ditandatangani oleh kedua belah pihak dalam keadaan sadar tanpa adanya tekanan
            dari pihak manapun, untuk dipergunakan sebagaimana mestinya.
        </p>
    </div>

    {{-- TANDA TANGAN --}}
    <div class="ttd-section">
        <table>
            <tr>
                <td class="ttd-box">
                    <p>PIHAK PERTAMA</p>
                    <div class="ttd-space"></div>
                    <span class="ttd-name">{{ $proposal->user->userProfile->nama_lengkap ?? '-' }}</span>
                </td>
                <td class="ttd-box">
                    <p>PIHAK KEDUA</p>
                    @if(!empty($proposal->sponsor->user->companyProfile->ttd_stempel_url))
                        <img src="{{ public_path('storage/' . $proposal->sponsor->user->companyProfile->ttd_stempel_url) }}"
                             style="height: 70px; margin: 0 auto;">
                    @else
                        <div class="ttd-space"></div>
                    @endif
                    <span class="ttd-name">{{ $proposal->sponsor->user->companyProfile->nama_perusahaan ?? '-' }}</span>
                </td>
            </tr>
        </table>
    </div>

    <div class="footer-note">
        Dokumen ini dibuat secara elektronik oleh sistem TemuAksi pada {{ now()->format('d-m-Y H:i') }}.
    </div>

</body>
</html>