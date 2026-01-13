<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Detail Pinjaman Karyawan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 20px;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 10px;
        }

        .logo {
            width: 100px;
        }

        h2 {
            text-align: center;
            margin: 10px 0;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 10px;
            box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            overflow: hidden;
        }

        th,
        td {
            border: 1px solid rgba(0, 0, 0, 0.2);
            padding: 6px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.95);
        }

        th {
            background-color: rgba(240, 240, 240, 0.95);
        }

        .footer-owner {
            margin-top: 40px;
            font-size: 11px;
            width: 100px;
            /* atau sesuai lebar yang kamu mau */
            text-align: center;
            float: left;
        }
        .footer-admin {
            margin-top: 40px;
            font-size: 11px;
            width: 100px;
            /* atau sesuai lebar yang kamu mau */
            text-align: center;
            float: right;
        }
    </style>
</head>
<body>
    <div class="logo-container">
        <img src="{{ public_path('assets/logo-font.png') }}" class="logo" style="width: 150px; height: 40px;">
    </div>
    <h2 style="font-size: 20px; font-weight: bolder; margin-top: 20px; text-transform: uppercase;">LAPORAN DETAIL PINJAMAN KARYAWAN <br> ({{ $pinjaman->karyawan->nama }})</h2>
    
    <!-- Tabel Pinjaman -->
    <h3>Data Pinjaman</h3>
    <div>Dicetak pada: {{ $tanggalCetak }} - {{ $jamCetak }}</div>
    <table>
        <thead>
            <tr>
                <th>Kontrak</th>
                <th>Tgl Pinjaman</th>
                <th>Tgl Cicilan</th>
                <th>Jumlah Pinjaman</th>
                <th>Cicilan Pinjaman</th>
                <th>Sisa Pinjaman</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pinjamanContents as $item)
                <tr>
                    <td>{{ $item->kontrak }}</td>
                    <td>{{ $item->jenis === 'pinjam' ? $item->tanggal : '-' }}</td>
                    <td>{{ $item->jenis === 'cicil' ? $item->tanggal : '-' }}</td>
                    <td>{{ $item->jenis === 'pinjam' ? 'Rp. '.number_format($item->bayar,0,',','.') : 'Rp. 0' }}</td>
                    <td>{{ $item->jenis === 'cicil' ? 'Rp. '.number_format($item->bayar,0,',','.') : 'Rp. 0' }}</td>
                    <td>Rp. {{ number_format($item->sisa,0,',','.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tabel Kasbon -->
    <h3 style="margin-top:20px;">Data Kasbon</h3>
    <table>
        <thead>
            <tr>
                <th>Kontrak</th>
                <th>Tgl Pinjaman</th>
                <th>Tgl Cicilan</th>
                <th>Jumlah Kasbon</th>
                <th>Cicilan Kasbon</th>
                <th>Sisa Kasbon</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kasbonContents as $item)
                <tr>
                    <td>{{ $item->kontrak }}</td>
                    <td>{{ $item->jenis === 'pinjam' ? $item->tanggal : '-' }}</td>
                    <td>{{ $item->jenis === 'cicil' ? $item->tanggal : '-' }}</td>
                    <td>{{ $item->jenis === 'pinjam' ? 'Rp. '.number_format($item->bayar,0,',','.') : 'Rp. 0' }}</td>
                    <td>{{ $item->jenis === 'cicil' ? 'Rp. '.number_format($item->bayar,0,',','.') : 'Rp. 0' }}</td>
                    <td>Rp. {{ number_format($item->sisa,0,',','.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        <div class="footer-owner">
            <p>Owner</p>
            <p style="margin-top: 70px">Rian Purnama</p>
        </div>
        <div class="footer-admin">
            <p>Admin Kuangan</p>
            <p style="margin-top: 70px">{{ $admin }}</p>
        </div>
    </div>
</body>
</html>
