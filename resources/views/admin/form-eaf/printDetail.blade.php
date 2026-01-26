<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rincian Eaf</title>
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
            width: 95%;
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
        <h2 style="margin-top: 10px; text-transform: uppercase">rincian eaf</h2>
    </div>
    <h1 style="font-weight: bold; text-transform: uppercase; font-size: 15px; padding-left: 20px;">Eaf</h1>
    <div class="container">
        <table>
            <tr>
                <td class="label">Nama Proyek</td>
                <td><div class="input-mock">{{ $eaf->nama_proyek }}</div></td>
            </tr>
            <tr>
                <td class="label">Saldo Kas</td>
                <td><div class="input-mock">{{ 'RP. ' . number_format($eaf->nominal, 0, ',', '.') }}</div></td>
            </tr>
        </table>
    </div>
    
    <h1 style="font-weight: bold; text-transform: uppercase; font-size: 15px; padding-left: 20px;">Tabel Rincian</h1>
    <table class="footer">
        <thead>
            <tr>
                <th class="ttd-th">No</th>
                <th class="ttd-th">Tgl relasi</th>
                <th class="ttd-th">Kode Akun</th>
                <th class="ttd-th">Nama Akun</th>
                <th class="ttd-th">Keterangan</th>
                <th class="ttd-th">Debet</th>
                <th class="ttd-th">Kredit</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($eaf->details as $item)
                <tr>
                    <td class="ttd">
                        {{ $no++ }}
                    </td>
                    <td class="ttd">
                        {{ $item->tanggal }}
                    </td>
                    <td class="ttd">
                        {{ $item->kode_akun }}
                    </td>
                    <td class="ttd">
                        {{ $item->nama_akun }}
                    </td>
                    <td class="ttd">
                        {{ $item->keterangan }}
                    </td>
                    <td class="ttd">
                        {{ 'RP. ' . number_format($item->debit, 0, ',', '.') }}
                    </td>
                    <td class="ttd">
                        {{ 'RP. ' . number_format($item->kredit, 0, ',', '.') }}
                    </td>
                    {{-- <td class="ttd" style="vertical-align: bottom; height: 80px;">
                        <div style="width: 100px;"></div>
                        <span>{{ $supplier }}</span>
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>