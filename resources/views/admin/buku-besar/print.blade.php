<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Buku Besar - {{ $account->nama_akun }}</title>
    <style>
        /* Pengaturan Dasar */
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #1a1a1a;
            margin: 0;
            padding: 0;
            line-height: 1.4;
        }

        /* Header Area */
        .header {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 40px;
        }
        .logo {
            width: 150px; /* Sesuaikan ukuran logo AR4N */
            height: 40px;
            margin-bottom: 20px;
        }
        .title {
            text-transform: uppercase;
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }

        /* Container Tabel dengan efek Rounded */
        .table-container {
            margin: 0 20px;
            border: 1px solid #e0e0e0;
            border-radius: 15px; /* Efek rounded corner di gambar */
            overflow: hidden; /* Supaya isi tabel tidak keluar dari border rounded */
            background-color: #ffffff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        /* Header Tabel */
        thead {
            background-color: #ffffff;
        }
        th {
            padding: 15px 10px;
            font-size: 13px;
            font-weight: bold;
            color: #333;
            border-bottom: 2px solid #f0f0f0;
            text-align: center;
        }

        /* Baris Tabel */
        td {
            padding: 12px 10px;
            font-size: 12px;
            color: #555;
            text-align: center;
            border-bottom: 1px solid #f9f9f9;
        }

        /* Baris Selang-seling (Zebra) */
        tbody tr:nth-child(even) {
            background-color: #f2f2f2; /* Warna abu-abu muda sesuai gambar */
        }

        /* Alignment Khusus */
        .text-left { text-align: left; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }

        /* Footer Cetak */
        .footer-print {
            margin-top: 50px;
            margin-right: 40px;
            text-align: right;
            color: #999;
            font-size: 12px;
        }
        .footer-print .name {
            font-weight: bold;
            color: #666;
            margin-bottom: 30px;
        }

        /* Penanganan Page Break */
        tr { page-break-inside: avoid; }
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ public_path('assets/logo-font.png') }}" class="logo" alt="AR4N Logo">
        <h1 class="title">LAPORAN BUKU BESAR – {{ strtoupper($account->nama_akun) }}</h1>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="15%">Tanggal</th>
                    <th width="35%">Keterangan</th>
                    <th width="15%">Debit</th>
                    <th width="15%">Kredit</th>
                    <th width="15%">Saldo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $index => $trx)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('j/n/Y') }}</td>
                    <td>{{ $trx->keterangan }}</td>
                    <td>
                        {{ $trx->debit > 0 ? 'Rp. ' . number_format($trx->debit, 0, ',', '.') : 0 }}
                    </td>
                    <td>
                        {{ $trx->kredit > 0 ? 'Rp. ' . number_format($trx->kredit, 0, ',', '.') : 0 }}
                    </td>
                    <td class="font-bold">
                        Rp. {{ number_format($trx->saldo_temp, 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer-print">
        <p>Di cetak oleh,</p>
        <p class="name">Admin Keuangan – {{ $admin }}</p>
        <p>{{ $tanggalCetak }}</p>
    </div>

</body>
</html>