<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Detail Pinjaman Tukang</title>
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

        .footer {
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
        <img src="{{ public_path('assets/ar4anSmallLogo.png') }}" class="logo">
    </div>
    <h2>LAPORAN DETAIL PINJAMAN TUKANG  ({{ $pinjaman->nama_tukang }})<br>AR4N GROUP</h2>


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



    <div class="footer">
        <p>Dicetak oleh,<br>{{ $role }} - {{ $admin }}</p>
        <p style="margin-top: 70px">{{ $tanggalCetak }}</p>
    </div>
</body>
</html>
