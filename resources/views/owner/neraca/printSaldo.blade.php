<!DOCTYPE html>
<html>
<head>
    <title>Laporan Neraca</title>
    <style>
        body { font-family: sans-serif; font-size: 10px; color: #333; margin: 0; padding: 0; }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            width: 140px;
            margin-bottom: 10px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
        }

        .periode {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
        
        table { width: 100%; border-collapse: collapse; table-layout: fixed; }
        .bg-gray { background-color: #f2f2f2; font-weight: bold; }
        
        /* Border hanya untuk baris utama */
        td { padding: 4px 6px; vertical-align: top; border: 1px solid #ccc; }
        
        /* Tabel di dalam TD untuk list akun (tanpa border) */
        .inner-table { width: 100%; border: none; }
        .inner-table td { border: none; padding: 2px 0; }
        
        .text-right { text-align: right; }
        .text-bold { font-weight: bold; }
        .footer-section { background-color: #f9f9f9; font-weight: bold; font-size: 11px; }
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

    <div class="header">
        <img src="{{ public_path('assets/logo-font.png') }}" class="logo">
        <h1 class="title">Laporan Neraca Saldo</h1>
        <div class="periode">Periode : {{ $periode }}</div>
    </div>
    <div>Dicetak pada: {{ $tanggalCetak }} - {{ $jamCetak }}</div>
    <table>
        <tr class="bg-gray">
            <td width="30%">ASSET LANCAR</td>
            <td width="20%"></td>
            <td width="30%">KEWAJIBAN/EKUITAS</td>
            <td width="20%"></td>
        </tr>
        <tr>
            <td colspan="2">
                <table class="inner-table">
                    @foreach($kasFinal as $kas)
                        <tr>
                            <td>{{ $kas['nama'] }}</td>
                            <td class="text-right">Rp. {{ number_format($kas['total'], 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    @foreach($lancarFinal as $lancar)
                        <tr>
                            <td>{{ $lancar['nama'] }}</td>
                            <td class="text-right">Rp. {{ number_format($lancar['total'], 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
            <td colspan="2">
                <table class="inner-table">
                    @foreach($kewajibanFinal as $kewajiban)
                        <tr>
                            <td>{{ $kewajiban['nama'] }}</td>
                            <td class="text-right">Rp. {{ number_format($kewajiban['total'], 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>
        <tr class="footer-section">
            <td>JUMLAH AKTIVA LANCAR</td>
            <td class="text-right">Rp. {{ number_format($totalAktivaLancar, 0, ',', '.') }}</td>
            <td>JUMLAH KEWAJIBAN</td>
            <td class="text-right">Rp. {{ number_format($totalKewajiban, 0, ',', '.') }}</td>
        </tr>

        <tr><td colspan="4" style="border: none; padding: 8px;"></td></tr>

        <tr class="bg-gray">
            <td>AKTIVA TETAP</td>
            <td></td>
            <td>MODAL</td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">
                <table class="inner-table">
                    @foreach($tetapFinal as $tetap)
                        <tr>
                            <td>{{ $tetap['nama'] }}</td>
                            <td class="text-right">Rp. {{ number_format($tetap['total'], 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
            <td colspan="2">
                <table class="inner-table">
                    <tr>
                        <td>Modal</td>
                        <td class="text-right">Rp. {{ number_format($modal, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Laba Ditahan</td>
                        <td class="text-right">Rp. {{ number_format($labaDitahan, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Laba Bulan Berjalan</td>
                        <td class="text-right">Rp. {{ number_format($labaTahunBerjalan, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="footer-section">
            <td>JUMLAH AKTIVA TETAP</td>
            <td class="text-right">Rp. {{ number_format($totalAktivaTetap, 0, ',', '.') }}</td>
            <td>JUMLAH MODAL</td>
            <td class="text-right">Rp. {{ number_format($modal + $labaDitahan + $labaTahunBerjalan, 0, ',', '.') }}</td>
        </tr>

        <tr class="bg-gray" style="font-size: 12px; border-top: 1px solid #000;">
            <td>TOTAL AKTIVA</td>
            <td class="text-right">Rp. {{ number_format($totalAktivaLancar + $totalAktivaTetap, 0, ',', '.') }}</td>
            <td>TOTAL PASIVA</td>
            <td class="text-right">Rp. {{ number_format($totalPasiva, 0, ',', '.') }}</td>
        </tr>
    </table>
    <div>
        <div class="footer-owner">
            <p>Owner</p>
            <p style="margin-top: 70px">Rian Purnama</p>
        </div>
    </div>
</body>
</html>