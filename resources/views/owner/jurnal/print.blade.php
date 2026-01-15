<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Jurnal</title>
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
            float: right;
        }
    </style>


</head>

<body>
    <div class="logo-container">
        <img src="{{ public_path('assets/logo-font.png') }}" class="logo" style="width: 150px; height: 40px;">
    </div>
    <h2 style="font-size: 20px; font-weight: bolder; margin-top: 20px;">LAPORAN JURNAL UMUM</h2>
    <div>Dicetak pada: {{ $tanggalCetak }} - {{ $jamCetak }}</div>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Nama Perkiraan</th>
                <th>Kd Akun</th>
                <th>Nama Proyek</th>
                <th>Kd Proyek</th>
                <th>Debet</th>
                <th>Kredit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jurnals as $jurnal)
                <tr>
                    <td>{{ $jurnal->tanggal }}</td>
                    <td>{{ $jurnal->keterangan }}</td>
                    <td>{{ $jurnal->nama_perkiraan }}</td>
                    <td>{{ $jurnal->kode_perkiraan }}</td>
                    <td>{{ $jurnal->nama_proyek }}</td>
                    <td>{{ $jurnal->kode_proyek }}</td>
                    <td>Rp. {{ number_format($jurnal->debit, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($jurnal->kredit, 0, ',', '.') }}</td>
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
