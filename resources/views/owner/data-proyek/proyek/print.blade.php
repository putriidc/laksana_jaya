<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Proyek {{ $kategori }}</title>
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
    @foreach ($proyeks as $nama_perusahaan => $listProyek)
    <h2 style="font-size: 20px; font-weight: bolder; margin-top: 20px;">{{  $nama_perusahaan }}</h2>
    <div>Dicetak pada: {{ $tanggalCetak }} - {{ $jamCetak }}</div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tgl Mulai</th>
                <th>Tgl Selesai</th>
                <th>Nama Proyek</th>
                <th>No Kontrak</th>
                <th>Jenis Pekerjaan</th>
                <th>Nilai Kontrak</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listProyek as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->tgl_mulai }}</td>
                    <td>{{ $item->tgl_selesai }}</td>
                    <td>{{ $item->nama_proyek }}</td>
                    <td>{{ $item->no_kontrak }}</td>
                    <td>{{ $item->jenis }}</td>
                    <td>Rp. {{ number_format($item->nilai_kontrak, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endforeach
    <div>
        <div class="footer-owner">
            <p>Owner</p>
            <p style="margin-top: 70px">Rian Purnama</p>
        </div>
        <div class="footer-admin">
            <p>Admin</p>
            <p style="margin-top: 70px">Siska</p>
        </div>
    </div>
</body>

</html>
