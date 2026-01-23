<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Progress Proyek</title>
    <style>
        @page { margin: 0.5cm; }
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 11px;
            color: #333;
        }
        .container {
            width: 100vw;
            padding: 20px;
            border: 1px solid #eee;
            border-radius: 8px;
        }
        .header { text-align: center; margin-bottom: 20px; }
        .logo { width: 140px; }
        
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

    <div class="header">
        <img src="{{ public_path('assets/logo-font.png') }}" class="logo">
        <h2 style="margin-top: 10px;">LAPORAN PROGRESS PROYEK</h2>
    </div>

    <div class="container">
        <table>
            <tr>
                <td class="label">Nama Paket</td>
                <td><div class="input-mock">{{ $dataPerusahaan->nama_paket }}</div></td>
            </tr>
            <tr>
                <td class="label">Perusahaan</td>
                <td><div class="input-mock">{{ $dataPerusahaan->perusahaan->nama_perusahaan }}</div></td>
            </tr>
            <tr>
                <td class="label">Pengawas</td>
                <td><div class="input-mock">{{ $dataPerusahaan->pic }}</div></td>
            </tr>
            <tr>
                <td class="label">No Hp</td>
                <td><div class="input-mock">{{ $dataPerusahaan->no_hp }}</div></td>
            </tr>
            <tr>
                <td class="label">MC 0</td>
                <td><div class="input-mock">{{ $dataPerusahaan->mc0 }}</div></td>
            </tr>
            <tr>
                <td class="label">Korlap</td>
                <td><div class="input-mock">{{ $dataPerusahaan->korlap }}</div></td>
            </tr>
            <tr>
                <td class="label">Kontraktor</td>
                <td><div class="input-mock">{{ $dataPerusahaan->kontraktor }}</div></td>
            </tr>
            <tr>
                <td class="label">Kendala</td>
                <td><div class="input-mock">{{ $dataPerusahaan->kendala }}</div></td>
            </tr>
        </table>

        <div class="section-title">Progress</div>

        @foreach ($progres as $p)
        <table style="margin-left: 180px; width: 75%;">
            <tr>
                <td style="width: 80px;">
                    <div style="font-size: 9px; margin-bottom: 5px;">Minggu</div>
                    <div class="progress-box" style="width: 50px;">{{ $p->minggu }}</div>
                </td>
                <td style="width: 100px;">
                    <div style="font-size: 9px; margin-bottom: 5px;">Persentase</div>
                    <div class="progress-box" style="width: 60px;">{{ $p->persen }}%</div>
                </td>
                <td>
                    <div style="font-size: 9px; margin-bottom: 5px;">Keterangan</div>
                    <div class="input-mock" style="min-height: 30px;">{{ $p->keterangan }}</div>
                </td>
            </tr>
        </table>
        @endforeach

        <div style="border-bottom: 1px solid #BEBEBE; margin: 15px 0 15px 180px;"></div>
        
        <div style="text-align: right; font-size: 14px; margin-right: 20px;">
            Total Progress <span style="font-weight: bold;">{{ $totalProgress }}%</span>
        </div>

        <div style="border-bottom: 1px solid #BEBEBE; margin: 15px 0 20px 180px;"></div>

        <div class="checkbox-container">
            <div class="check-item">
                <span style="font-size: 9px; display:inline-block; width: 150px;">Progress Kontraktor (Sudah di serahkan ke admin)</span>
                <div class="box-check">
                    @if($dataPerusahaan->is_kontraktor_admin) <div class="checkmark"></div> @endif
                </div>
            </div>

            <div class="check-item">
                <span style="font-size: 9px; display:inline-block; width: 150px;">Progress Kontraktor (Sudah di ambil kontraktor)</span>
                <div class="box-check">
                    @if($dataPerusahaan->is_kontraktor_kontraktor) <div class="checkmark"></div> @endif
                </div>
            </div>

            <div class="check-item">
                <span style="font-size: 9px; display:inline-block; width: 150px;">RAR Dokumen Konsultan</span>
                <div class="box-check">
                    @if($dataPerusahaan->is_konsultan_kontraktor) <div class="checkmark"></div> @endif
                </div>
            </div>

            <div class="check-item">
                <span style="font-size: 9px; display:inline-block; width: 150px;">Progress Pengawas (Sudah di serahkan ke admin)</span>
                <div class="box-check">
                    @if($dataPerusahaan->is_pengawas_admin) <div class="checkmark"></div> @endif
                </div>
            </div>

            <div class="check-item">
                <span style="font-size: 9px; display:inline-block; width: 150px;">Dokumentasi</span>
                <div class="box-check">
                    @if($dataPerusahaan->is_pho) <div class="checkmark"></div> @endif
                </div>
            </div>

            <div class="check-item">
                <span style="font-size: 9px; display:inline-block; width: 150px;">Gambar</span>
                <div class="box-check">
                    @if($dataPerusahaan->is_gambar) <div class="checkmark"></div> @endif
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="footer-owner">
            <p>Owner</p>
            <p style="margin-top: 70px">Rian Purnama</p>
        </div>
        <div class="footer-admin">
            <p>Admin Kuangan</p>
            <p style="margin-top: 70px">Siska</p>
        </div>
    </div>

</body>
</html>