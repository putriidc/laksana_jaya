<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Pinjaman Karyawan</title>
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

    <h2>LAPORAN PINJAMAN kARYAWAN<br>AR4N GROUP</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Sisa Pinjaman</th>
                <th>Sisa Kasbon</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pinjamans as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ optional($item->karyawan)->nama ?? '-' }}</td>
                    <td>{{ 'RP. ' . number_format($item->total_pinjam, 0, ',', '.') }}</td>
                    <td>{{ 'RP. ' . number_format($item->total_kasbon, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak oleh,<br>{{ $role }} - {{ $admin }}</p>
        <p style="margin-top: 70px">{{ \Carbon\Carbon::parse($tanggalCetak)->translatedFormat('d F Y') }}</p>
    </div>
</body>

</html>
