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
            font-size: 12pt;
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
        style="border-bottom: 5px solid #000; padding:5px; text-align:center;line-height:5px;width:100%">
        <tbody>
            <tr>
                <td tyle="text-align: left"><img src="{{ asset('images/logoalfahp.png') }}" alt="logo"
                        style="width: 100px"></td>
                <td style="text-align: center">
                    <h3>YAYASAN AL MUSYAFFA'</h3>
                    <h2>SMP AL MUSYAFFA' KENDAL</h2>
                    <h5>Jln. Kampir-Sudipayung, Kec. Ngampel, Kab. Kendal - Jawa Tengah </h5>
                    <h6> Hp: 0878 8000 1111, 0822 8000 1111, 0857 8000 1111 E-mail : smpalmusyaffa@yahoo.com Website
                        : www.smpalmusyaffa.sch.id </h6>
                </td>
            </tr>
        </tbody>
    </table>
    <div style="text-align: center">
        <h4>KWITANSI PEMBAYARAN SAH</h4>
    </div>
    <table style="width: 100%; padding-left:150px;">
        <tr>
            <td style="width: 25%">
                <b>
                    Telah diterima dari
                </b>
            </td>
            <td style="width: 5%"><b>:</b></td>
            <td>
                <b>
                    {{ $siswa }}
                </b>
            </td>
        </tr>
        <tr>
            <td style="width: 25%">
                <b>
                    Kelas
                </b>
            </td>
            <td style="width: 5%"><b>:</b></td>
            <td>
                <b>
                    {{ $kelas }}
                </b>
            </td>
        </tr>
        <tr>
            <td style="width: 25%">
                <b>
                    Uang sebesar
                </b>
            </td>
            <td style="width: 5%"><b>:</b></td>
            <td>
                <b>
                    {{ 'Rp ' . number_format($jumlah, 0, ',', '.') }}
                </b>
            </td>
        </tr>

        <tr>
            <td style="width: 25%">
                <b>
                    Guna bayar
                </b>
            </td>
            <td style="width: 5%"><b>:</b></td>
            <td>
                <b>
                    {{ $gunabayar }}
                </b>
            </td>
        </tr>
        <tr>
            <td style="width: 25%">
                <b>
                    Tahun
                </b>
            </td>
            <td style="width: 5%"><b>:</b></td>
            <td>
                <b>
                    {{ $tahun }}
                </b>
            </td>
        </tr>
    </table>
    <table align="right">
        <tr>
            <td><b>Kendal, {{ Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}</b></td>
        </tr>
        <tr>
            <td style="text-align: center"><b>Bendahara</b></td>
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
            <td style="text-align: center"><b>{{ $bendahara }}</b></td>
        </tr>
    </table>
</body>

</html>
