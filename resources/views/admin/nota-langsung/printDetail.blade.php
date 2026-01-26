<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Nota Langsung</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 20px;
            text-transform: uppercase;
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
            margin-top: -230px;
            font-size: 11px;
            width: 100px;
            /* atau sesuai lebar yang kamu mau */
            text-align: center;
            float: right;
        }
        .footer-finance {
            margin-top: 40px;
            font-size: 11px;
            width: 100px;
            text-align: center;
            /* Hapus float: right, gunakan margin auto untuk posisi tengah */
            margin-left: auto;
            margin-right: auto;
            display: block;
        }
    </style>


</head>

<body>
    <div class="logo-container">
        <img src="{{ public_path('assets/logo-font.png') }}" class="logo" style="width: 150px; height: 40px;">
    </div>
    <h2 style="font-size: 20px; font-weight: bolder; margin-top: 20px;">NOTA LANGSUNG</h2>
    <div>Dicetak pada: {{ $tanggalCetak }} - {{ $jamCetak }}</div>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Proyek</th>
                <th>PIC</th>
                <th>Nominal</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>{{ Carbon\Carbon::parse($tanggal)->format('d-m-Y') }}</td>
                    <td>{{ $proyek }}</td>
                    <td>{{ $pic }}</td>
                    <td>{{ 'RP. ' . number_format($nominal, 0, ',', '.') }}</td>
                </tr>
        </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <th>Detail Biaya</th>
                <th>Owner</th>
                <th>Admin</th>
                <th>PIC</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td><textarea name="" id="" cols="60" rows="60" style="text-align: left; padding: 10px; height: auto; font-size: 10px; font-family: Arial, Helvetica, sans-serif">{{ $detailBiaya }}</textarea></td>
                    <td style="vertical-align: bottom; height: 80px;">
                        <div style="width: 100px;"></div>
                        <span>Rian Purnama</span>
                    </td>
                    <td style="vertical-align: bottom; height: 80px;">
                        <div style="width: 100px;"></div>
                        <span>{{ $admin }}</span>
                    </td>
                    <td style="vertical-align: bottom; height: 80px;">
                        <div style="width: 100px;"></div>
                        <span>{{ $pic }}</span>
                    </td>
                </tr>
        </tbody>
    </table>
    {{-- <div>
        <div class="footer-owner">
            <p>Admin</p>
            <p style="margin-top: 70px">Novi</p>
        </div>
        <div class="footer-finance">
            <p>Finance</p>
            <p style="margin-top: 70px">Siska</p>
        </div>
        <div class="footer-admin">
            <p>PIC</p>
            <p style="margin-top: 70px">{{ $eaf->first()->pic }}</p>
        </div>
    </div> --}}
</body>

</html>
