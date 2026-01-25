<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $transaksi }}</title>
    <style>
        @page { margin: 0.5cm; }
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 11px;
            color: #333;
        }
        .container {
            width: 100vw;
            padding-left: 20px;
            padding-right: 20px;
            margin-bottom: 10px;
        }
        .header { text-align: center; margin-bottom: 20px; margin-top: 20px; }
        .logo { width: 140px; margin-bottom: 10px; }
        
        /* Layout Tabel Utama */
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        td { padding: 6px 0; vertical-align: middle; }
        
        /* Simulasi Label w-[200px] */
        .label { width: 180px; color: #444; }

        /* Simulasi Input Tailwind: bg-[#D9D9D9]/40 rounded-lg */
        .input-mock {
            background-color: rgba(217, 217, 217, 0.4);
            padding: 8px 15px;
            border-radius: 6px;
            color: #000;
            display: block;
            min-height: 15px;
        }

        .section-title {
            font-weight: bold;
            font-size: 14px;
            margin: 20px 0 10px 180px; /* Alur lurus dengan input */
        }

        /* Progress Row */
        .progress-table { margin-left: 180px; width: auto; }
        .progress-box {
            background-color: rgba(217, 217, 217, 0.4);
            padding: 8px;
            border-radius: 6px;
            text-align: center;
            display: inline-block;
        }

        /* Checkbox Area */
        .checkbox-container {
            margin-left: 180px;
            width: 70%;
        }
        .check-item {
            display: inline-block;
            width: 45%;
            margin-bottom: 15px;
            vertical-align: top;
        }
        .box-check {
            width: 25px;
            height: 25px;
            background-color: rgba(217, 217, 217, 0.4);
            border-radius: 5px;
            display: inline-block;
            position: relative; /* Penting untuk posisi centang */
            vertical-align: middle;
        }
        .checkmark {
            position: absolute;
            left: 9px;
            top: 4px;
            width: 5px;
            height: 10px;
            border: solid #000;
            border-width: 0 2.5px 2.5px 0;
            transform: rotate(45deg);
        }
        .footer {
            width: 90%;
            border-collapse: separate;
            border-spacing: 0;
            box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            overflow: hidden;
            margin: auto;
        }
        .ttd-th,
        .ttd {
            border: 1px solid rgba(0, 0, 0, 0.2);
            padding: 6px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.95);
        }
        .ttd-th {
            background-color: rgba(240, 240, 240, 0.95);
        }

    </style>
</head>
<body>

    <div class="header">
        <img src="{{ public_path('assets/logo-font.png') }}" class="logo">
        <h2 style="margin-top: 10px; text-transform: uppercase">{{ $transaksi }}</h2>
    </div>
    <div class="container">
        <table>
            <tr>
                <td class="label">Tanggal</td>
                <td><div class="input-mock">{{ $tanggalCetak }}</div></td>
            </tr>
            <tr>
                <td class="label">Nama Akun</td>
                <td><div class="input-mock">{{ $nama }}</div></td>
            </tr>
            <tr>
                <td class="label">Keterangan</td>
                <td><div class="input-mock">{{ $ket }}</div></td>
            </tr>
            <tr>
                <td class="label">Nominal</td>
                <td><div class="input-mock">{{ 'Rp. ' . number_format($nominal, 0, ',', '.') }}</div></td>
            </tr>
        </table>
    </div>

    <table class="footer">
        <thead>
            <tr>
                <th class="ttd-th">Owner</th>
                <th class="ttd-th">Admin Keuangan</th>
                <th class="ttd-th">Penerima</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td class="ttd" style="vertical-align: bottom; height: 80px;">
                        <div style="width: 100px;"></div>
                        <span>Rian Purnama</span>
                    </td>
                    <td class="ttd" style="vertical-align: bottom; height: 80px;">
                        <div style="width: 100px;"></div>
                        <span>Siska</span>
                    </td>
                    <td class="ttd" style="vertical-align: bottom; height: 80px;">
                        <div style="width: 100px;"></div>
                        <span>(.............................)</span>
                    </td>
                </tr>
        </tbody>
    </table>

</body>
</html>