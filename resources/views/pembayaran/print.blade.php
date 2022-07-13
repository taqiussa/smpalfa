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
    <table align="center"
        style="padding:5px; text-align:center;line-height:1px;width:100%">
        <tbody>
            <tr>
                <td style="text-align: right"><img src="{{ asset('images/logoalfahp.png') }}" alt="logo"
                        style="width: 75px"></td>
                <td style="text-align: center;word-wrap:break-word;border-bottom:solid 2px #000">
                    <div style="margin-bottom: 15px"><strong>YAYASAN AL MUSYAFFA'</strong></div>
                    <div style="margin-bottom: 15px"><strong>SMP AL MUSYAFFA' KENDAL</strong></div>
                    <div style="margin-bottom: 15px">Jln. Kampir-Sudipayung, Kec. Ngampel, Kab. Kendal - Jawa Tengah </div>
                    <div style="margin-bottom: 15px"> Hp: 0822-8000-1111 E-mail : smpalmusyaffa@gmail.com Website : www.smpalmusyaffa.com </div>
                </td>
            </tr>
        </tbody>
    </table>
    <div style="display: flex;justify-content:space-between">
        <span>Telah Terima Dari</span>
        <span>Tanggal Bayar : Tanggal</span>
    </div>
    <table style="padding-left: 25px;">
        <thead>
            <tr style="text-align: left">
                <td>Nama</td>
                <td>:</td>
                <th>Nama</th>
            </tr>
            <tr style="text-align: left">
                <td>Kelas</td>
                <td>:</td>
                <th>Kelas  Tahun</th>
            </tr>
        </thead>
    </table>
    <table border="1" align="center" style="border-collapse:collapse;width:50%">
        <tbody>
            <tr>
                <td style="padding-left: 20px">Gunabayar</td>
                <td style="padding-left: 20px">Jumlah</td>
            </tr>
            @foreach ($list_pembayaran as $pembayaran)
            <tr>
                <td style="padding-left: 20px">{{ $pembayaran->gunabayar->nama }}</td>
                <td style="padding-left: 20px">{{ 'Rp ' . number_format($pembayaran->jumlah, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr>
                <td style="padding-left: 20px">Total</td>
                <td style="padding-left: 20px"><b>{{ 'Rp ' . number_format($total, 0, ',', '.') }}</b></td>
            </tr>
        </tbody>
    </table>
    <table align="right">
        <tr>
            <td>Kendal, {{ Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}</td>
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
