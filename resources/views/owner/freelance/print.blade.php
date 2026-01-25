<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Freelance</title>
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
    <h2 style="font-size: 20px; font-weight: bolder; margin-top: 20px;">LAPORAN FREELANCE</h2>
    <div>Dicetak pada: {{ $tanggalCetak }} - {{ $jamCetak }}</div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tgl Mulai</th>
                <th>Tgl Selesai</th>
                <th>Salary</th>
                <th>Day</th>
                <th>Total Salary</th>
                <th>Tambahan</th>
                <th>Jumlah</th>
                <th>Bon</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sampingans as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->tgl_mulai }}</td>
                    <td>{{ $item->tgl_selesai }}</td>
                    <td>Rp. {{ number_format($item->gaji, 0, ',', '.') }}</td>
                    <td>{{ $item->hari }}</td>
                    <td>Rp. {{ number_format($item->gaji * $item->hari, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($item->tambahan ?? 0, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($item->gaji * $item->hari + ($item->tambahan ?? 0), 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($item->kasbon ?? 0, 0, ',', '.') }}</td>
                    <td>Rp.
                        {{ number_format($item->gaji * $item->hari + ($item->tambahan ?? 0) - ($item->kasbon ?? 0), 0, ',', '.') }}
                    </td>
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
