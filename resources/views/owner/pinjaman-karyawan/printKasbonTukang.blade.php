<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Kasbon Tukang</title>
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
    <h2 style="font-size: 20px; font-weight: bolder; margin-top: 20px; text-transform: uppercase;">LAPORAN Persetujuan Pinjaman Tukang</h2>
    <div>Dicetak pada: {{ $tanggalCetak }} - {{ $jamCetak }}</div>
    <table>
        <thead>
            <tr>
                <th>Tgl Pengajuan</th>
                <th>Nama Tukang</th>
                <th>Kontrak</th>
                <th>Ket Owner</th>
                <th>Jumlah Pinjaman</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($kasbons as $kasbon)
                <tr>
                    <td>{{ $kasbon->tanggal }}</td>
                    <td>{{ $kasbon->nama_tukang }}</td>
                    <td>{{ $kasbon->kontrak }}</td>
                    <td>{{ $kasbon->ket_owner }}</td>
                    <td>Rp. {{ number_format($kasbon->bayar, 0, ',', '.') }}</td>
                    @php
                    if ($kasbon->status_owner == "pending") {
                        echo '<td>Pending</td>';
                    } else {
                        if ($kasbon->status_owner == "accept") {
                            echo '<td>Accept</td>';
                        } else {
                            echo '<td>Decline</td>';
                        }
                    }
                    @endphp
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
