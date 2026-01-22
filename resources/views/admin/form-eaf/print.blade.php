<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Form EAF</title>
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
    <h2 style="font-size: 20px; font-weight: bolder; margin-top: 20px;">LAPORAN FORM EAF</h2>
    <div>Dicetak pada: {{ $tanggalCetak }} - {{ $jamCetak }}</div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tgl Pengajuan</th>
                <th>Nama Proyek</th>
                <th>PIC</th>
                <th>Nominal</th>
                <th>Detail Biaya</th>
                <th>Status</th>
                <th>Ket Owner</th>
                <th>Ket SPV</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($eaf as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->nama_proyek }}</td>
                    <td>{{ $item->pic }}</td>
                    <td>{{ 'RP. ' . number_format($item->nominal, 0, ',', '.') }}</td>
                    <td><textarea name="" id="" cols="30" rows="10">{{ $item->detail_biaya }}</textarea></td>
                    <td>Owner: {{ $item->acc_owner }}<br>SPV: {{ $item->acc_spv }}</td>
                    <td><textarea name="" id="" cols="30" rows="10">{{ $item->ket_owner }}</textarea></td>
                    <td><textarea name="" id="" cols="30" rows="10">{{ $item->ket_spv }}</textarea></td>
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