<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Pembayaran Siswa</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif !important;
            font-size: 11pt;
            margin-top: 15px;
            margin-bottom: 5px;
            margin-left: 10px;
            margin-right: 10px;
        }

        @page {
            margin-top: 15px;
            margin-bottom: 5px;
            margin-left: 10px;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <table align="center" style="padding:5px; text-align:center;line-height:1px;width:100%">
        <tbody>
            <tr>
                <td style="text-align: right"><img src="{{ asset('images/logoalfahp.png') }}" alt="logo"
                        style="width: 75px"></td>
                <td style="text-align: center;word-wrap:break-word;border-bottom:solid 2px #000">
                    <div style="margin-bottom: 15px"><strong>YAYASAN AL MUSYAFFA'</strong></div>
                    <div style="margin-bottom: 15px"><strong>SMP AL MUSYAFFA' KENDAL</strong></div>
                    <div style="margin-bottom: 15px">Jln. Kampir-Sudipayung, Kec. Ngampel, Kab. Kendal - Jawa Tengah
                    </div>
                    <div style="margin-bottom: 15px"> Hp: 0822-8000-1111 E-mail : smpalmusyaffa@gmail.com Website :
                        www.smpalmusyaffa.com </div>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="padding-left: 25px;">
        <thead>
            <tr style="text-align: left">
                <td>Telah Terima Dari :</td>
            </tr>
            <tr style="text-align: left">
                <td>Nama</td>
                <td>:</td>
                <th>{{ $siswa }}</th>
            </tr>
            <tr style="text-align: left">
                <td>Kelas</td>
                <td>:</td>
                <th>{{ $kelas }} - {{ $tahun }}</th>
            </tr>
            <tr style="text-align: left">
                <td>Tanggal Bayar</td>
                <td>:</td>
                <td> {{ Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}</td>
            </tr>
        </thead>
    </table>
    <table align="center" style="border-collapse:collapse;width:40%">
        <tbody>
            <tr>
                <td style="padding-left: 20px">Gunabayar</td>
                <td style="padding-left: 20px">Jumlah</td>
            </tr>
            @foreach ($list_pembayaran as $pembayaran)
                <tr>
                    <td style="padding-left: 20px">{{ $pembayaran->gunabayar->nama }}</td>
                    <td style="padding-left: 20px">{{ 'Rp ' . number_format($pembayaran->jumlah, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td style="padding-left: 20px">Total</td>
                <td style="padding-left: 20px"><b>{{ 'Rp ' . number_format($total, 0, ',', '.') }}</b></td>
            </tr>
        </tbody>
    </table>
    <table align="left" style="width:40%; padding:5px; font-size:10pt;border-collapse:collapse">
        <thead>
            <tr>
                <td colspan="3">Keterangan :</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Administrasi 1 Tahun</td>
                <td>:</td>
                <td>{{ 'Rp ' . number_format($wajibbayar, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Terbayar</td>
                <td>:</td>
                <td>{{ 'Rp ' . number_format($totalbayar, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Kurang Bayar</td>
                <td>:</td>
                <td>{{ 'Rp ' . number_format($kurangbayar, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
    <table align="right" style="padding-right: 30px;">
        <tr>
            <td style="text-align: center">Kendal, {{ Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td style="text-align: center">Bendahara</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align: center"><b>{{ auth()->user()->name }}</b></td>
        </tr>
    </table>
</body>

</html>
