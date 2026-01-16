<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Management</title>
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
    <h2 style="font-size: 20px; font-weight: bolder; margin-top: 20px; text-transform: uppercase;">LAPORAN Data management</h2>
    <div>Dicetak pada: {{ $tanggalCetak }} - {{ $jamCetak }}</div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Proyek</th>
                <th>Nilai Kontrak</th>
                <th>DPP</th>
                <th>PPN</th>
                <th>PPh</th>
                <th>Sisa Potong Pajak</th>
                <th>Fee Dinas</th>
                <th>Dana Target</th>
                <th>Keuntungan</th>
                <th>Real Untung</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
           @foreach ($kontraks as $kontrak)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $kontrak->nama_proyek }}</td>
                    <td>Rp. {{ number_format($kontrak->nilai_kontrak, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($kontrak->dpp, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($kontrak->ppn, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($kontrak->pph, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($kontrak->sisa_potong_pajak, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($kontrak->fee_dinas, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($kontrak->net, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($kontrak->keuntungan, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($kontrak->real_untung, 0, ',', '.') }}</td>
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
