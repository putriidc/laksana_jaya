<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Neraca Lajur</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10px;
            margin: 10px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            width: 140px;
            margin-bottom: 10px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
        }

        .periode {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        /* Styling Header Tabel Berlapis */
        th {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 8px 4px;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
        }

        td {
            border: 1px solid #dee2e6;
            padding: 6px 4px;
            text-align: center;
        }

        /* Zebra Row Effect */
        tbody tr:nth-child(even) {
            background-color: #fafafa;
        }

        .text-left { text-align: left; padding-left: 10px; }
        .text-right { text-align: right; padding-right: 10px; }
        .footer-owner {
            margin-top: 40px;
            font-size: 11px;
            width: 100px;
            /* atau sesuai lebar yang kamu mau */
            text-align: center;
            float: right;
        }


        .clear { clear: both; }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('assets/logo-font.png') }}" class="logo">
        <h1 class="title">Laporan Neraca Lajur</h1>
        <div class="periode">Periode : {{ $periodeLabel }}</div>
    </div>
    <div>Dicetak pada: {{ $tanggalCetak }} - {{ $jamCetak }}</div>
    <table>
        <thead>
            <tr>
                <th rowspan="2" style="width: 8%;">Kode Akun</th>
                <th rowspan="2" style="width: 18%;">Nama Akun</th>
                <th rowspan="2" style="width: 8%;">POST Saldo</th>
                <th colspan="2">Neraca Saldo</th>
                <th rowspan="2" style="width: 10%;">POST Laporan</th>
                <th colspan="2">Laba Rugi</th>
                <th colspan="2">Neraca</th>
            </tr>
            <tr>
                <th style="width: 10%;">Debet</th>
                <th style="width: 10%;">Kredit</th>
                <th style="width: 10%;">Debet</th>
                <th style="width: 10%;">Kredit</th>
                <th style="width: 10%;">Debet</th>
                <th style="width: 10%;">Kredit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assets as $asset)
            <tr>
                <td>{{ $asset->kode_akun }}</td>
                <td class="text-left">{{ $asset->nama_akun }}</td>
                <td>{{ $asset->post_saldo}}</td>
                <td class="text-right">Rp. {{ number_format($asset->post_laporan === 'NERACA' ? $asset->debit_total : 0, 0, ',', '.') }}</td>
                <td class="text-right">Rp. {{ number_format($asset->post_laporan === 'NERACA' ? $asset->kredit_total : 0, 0, ',', '.') }}</td>
                <td>{{ $asset->post_laporan }}</td>
                <td class="text-right">Rp. {{ number_format($asset->post_laporan === 'LABA RUGI' ? $asset->debit_total : 0, 0, ',', '.') }}</td>
                <td class="text-right">Rp. {{ number_format($asset->post_laporan === 'LABA RUGI' ? $asset->kredit_total : 0, 0, ',', '.') }}</td>
                <td class="text-right">Rp. {{ number_format($asset->post_laporan === 'NERACA' ? $asset->debit_total : 0, 0, ',', '.') }}</td>
                <td class="text-right">Rp. {{ number_format($asset->post_laporan === 'NERACA' ? $asset->kredit_total : 0, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        <div class="footer-owner">
            <p>{{ $role }}</p>
            <p style="margin-top: 70px">{{ $owner }}</p>
        </div>
    </div>
</body>

</html>
