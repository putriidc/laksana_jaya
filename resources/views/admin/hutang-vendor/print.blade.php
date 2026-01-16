<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Hutang Vendor</title>
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
            width: 150px;
            height: 40px;
        }

        h2 {
            text-align: center;
            margin: 10px 0;
            font-size: 18px;
            font-weight: bolder;
            text-transform: uppercase;
        }

        .meta-data {
            margin-top: 20px;
            font-style: italic;
        }

        table {
            width: 100%;
            border-collapse: collapse; /* Lebih aman untuk PDF daripada 'separate' */
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid rgba(0, 0, 0, 0.2);
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        .footer-container {
            margin-top: 50px;
            width: 100%;
        }

        .footer-owner {
            float: left;
            width: 200px;
            text-align: center;
        }

        .footer-admin {
            float: right;
            width: 200px;
            text-align: center;
        }

        .signature-space {
            margin-top: 70px;
        }
    </style>
</head>

<body>
    <div class="logo-container">
        {{-- public_path digunakan agar DomPDF bisa menemukan file di server --}}
        <img src="{{ public_path('assets/logo-font.png') }}" class="logo">
    </div>

    <h2>LAPORAN HUTANG VENDOR</h2>

    <div class="meta-data">
        Dicetak pada: {{ date('d/m/Y') }} - {{ date('H:i:s') }} WIB
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 20%">Nama Supplier</th>
                <th style="width: 15%">Tgl Hutang</th>
                <th style="width: 20%">Keterangan</th>
                <th style="width: 15%">Nominal</th>
                <th style="width: 20%">Nama Proyek</th>
                <th style="width: 10%">Jatuh Tempo</th>
                <th style="width: 10%">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hutangVendors as $index => $item)
                @php
                    $today = \Carbon\Carbon::today();
                    $jatuhTempo = \Carbon\Carbon::parse($item->tgl_jatuh_tempo);
                    $selisihHari = $today->diffInDays($jatuhTempo, false);
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->supplier?->nama ?? '-' }}</td>
                    <td>{{ $item->tgl_hutang }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                    <td>{{ $item->proyek?->nama_proyek ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tgl_jatuh_tempo)->format('d/m/Y') }}</td>
                    <td>
                        @if ($item->tgl_bayar)
                            Sudah Dibayar
                        @elseif ($selisihHari > 2)
                            Masih Jauh
                        @elseif ($selisihHari > 0)
                            Mendekati
                        @else
                            Lewat/Hari H
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer-container">
        <div class="footer-owner">
            <p>Owner</p>
            <p class="signature-space">Rian Purnama</p>
        </div>
        <div class="footer-admin">
            <p>Admin Keuangan</p>
            {{-- Mengambil nama user yang sedang login --}}
            <p class="signature-space">{{ auth()->user()->name }}</p>
        </div>
    </div>
</body>

</html>