<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Laba Rugi</title>
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

        /* table {
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
        } */

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
    <h2>LAPORAN LABA RUGI<br>AR4N GROUP <br>
        {{ $bulan ? \Carbon\Carbon::parse($bulan)->translatedFormat('F Y') : 'Semua Periode' }}</h2>

    <table style="width:100%; border-collapse:collapse;">
        @foreach ($pendapatanFinal as $item)
            <tr>
                <td style="padding:6px 0;">{{ $item['nama_perkiraan'] }}</td>
                <td style="text-align:right;">Rp. {{ number_format($item['total'], 0, ',', '.') }}</td>
            </tr>
        @endforeach
        <tr style="font-weight:bold; border-top:1px solid #ccc;">
            <td>Total Pendapatan</td>
            <td style="text-align:right;">Rp. {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
        </tr>
    </table>
    <table style="width:100%; border-collapse:collapse;">
        @foreach ($biayaFinal as $item)
            <tr>
                <td style="padding:6px 0;">{{ $item['nama_perkiraan'] }}</td>
                <td style="text-align:right;">Rp. {{ number_format($item['total'], 0, ',', '.') }}</td>
            </tr>
        @endforeach
        <tr style="font-weight:bold; border-top:1px solid #ccc;">
            <td>Total Biaya</td>
            <td style="text-align:right;">Rp. {{ number_format($totalBiaya, 0, ',', '.') }}</td>
        </tr>
    </table>
    <p style="text-align:right; font-weight:bold; font-size:18px;">Rp. {{ number_format($totalLabaRugi, 0, ',', '.') }}
    </p>
    <div class="footer">
        <p>Dicetak oleh,<br>{{ $role }} - {{ $admin }}</p>
        <p style="margin-top: 70px">{{ \Carbon\Carbon::parse($tanggalCetak)->translatedFormat('d F Y') }}</p>
    </div>
</body>

</html>
