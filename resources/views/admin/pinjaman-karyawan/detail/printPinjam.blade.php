<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Kontrak Pinjaman Karyawan</title>
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

        .footer-container {
            display: flex;
            justify-content: space-between;
            /* bagi rata kiri–tengah–kanan */
            margin-top: 40px;
            font-size: 11px;
            text-align: center;
        }

        .footer-owner,
        .footer-admin,
        .footer-pinjam {
            width: 100px;
            /* sesuaikan lebar */
        }
    </style>
</head>

<body>
    <div class="logo-container">
        <img src="{{ public_path('assets/logo-font.png') }}" class="logo" style="width: 150px; height: 40px;">
    </div>
    <h2 style="font-size: 20px; font-weight: bolder; margin-top: 20px; text-transform: uppercase;">LAPORAN KONTRAK
        PINJAMAN KARYAWAN <br> ({{ $pinjaman->karyawan->nama }})</h2>

    <!-- Tabel Pinjaman -->
    <h3>Data Pinjaman</h3>
    <div>Dicetak pada: {{ $tanggalCetak }} - {{ $jamCetak }}</div>
    <table>
        <thead>
            <tr>
                <th>Tgl Pinjaman</th>
                <th>Kontrak</th>
                <th>Jangka Waktu (Bulan)</th>
                <th>Angsuran Per Bulan</th>
                <th>Jumlah Pinjaman</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pinjamanContents as $item)
                <tr>
                    <td>{{ $item->jenis === 'pinjam' ? $item->tanggal : '-' }}</td>
                    <td>{{ $item->kontrak }}</td>
                    <td>{{ $item->kontrakPinjam->jangka_waktu }}</td>
                    <td>{{ 'Rp. ' . number_format($item->kontrakPinjam->angsuran, 0, ',', '.') }}</td>
                    <td>{{ $item->jenis === 'pinjam' ? 'Rp. ' . number_format($item->bayar, 0, ',', '.') : 'Rp. 0' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer-container">
        <div class="footer-owner">
            <p>Owner</p>
            <p style="margin-top: 70px">Rian Purnama</p>
        </div>
        <div class="footer-admin">
            <p>Admin Keuangan</p>
            <p style="margin-top: 70px">{{ $admin }}</p>
        </div>
        <div class="footer-pinjam">
            <p>Peminjam</p>
            <p style="margin-top: 70px">{{ $pinjaman->karyawan->nama }}</p>
        </div>
    </div>
</body>

</html>
