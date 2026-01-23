<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Persetujuan Pinjaman Tukang</title>
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
    <h2 style="font-size: 20px; font-weight: bolder; margin-top: 20px; text-transform: uppercase;">Laporan Persetujuan Pinjaman Tukang</h2>
    <div style="margin-bottom: -5px;">Dicetak pada: {{ $tanggalCetak }} - {{ $jamCetak }}</div>
    <table>
        <thead>
            <tr>
                <th>Tgl Pengajuan</th>
                <th>Nama Tukang</th>
                <th>Proyek</th>
                <th>Kontrak</th>
                <th>Status</th>
                <th>Jumlah Pinjaman</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pinjamans as $item)
                <tr>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->kasbon->nama_tukang }}</td>
                    <td>{{ $item->kasbon->nama_proyek }}</td>
                    <td>{{ $item->kontrak }}</td>
                    <td>{{ $item->ket_spv }}</td>
                    <td>{{ 'RP. ' . number_format($item->bayar, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        <div class="footer-owner">
            <p>Admin</p>
            <p style="margin-top: 70px">Novi</p>
        </div>
        <div class="footer-admin">
            <p>Supervisor</p>
            <p style="margin-top: 70px">Rudi</p>
        </div>
    </div>
</body>

</html>
