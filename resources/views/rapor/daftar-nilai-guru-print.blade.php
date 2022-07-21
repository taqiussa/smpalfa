<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Daftar Nilai Guru</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif !important;
            font-size: 11pt;
            margin-top: 5px;
            margin-bottom: 5px;
            margin-left: 10px;
            margin-right: 10px;
        }

        @page {
            margin-top: 5px;
            margin-bottom: 5px;
            margin-left: 10px;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    {{-- <table align="center" style="padding:5px; text-align:center;line-height:1px;width:100%">
        <tbody>
            <tr>
                <td style="text-align: right"><img src="{{ asset('images/logoalfahp.png') }}" alt="logo"
                        style="width: 75px"></td>
                <td style="text-align: center;word-wrap:break-word;border-bottom:solid 2px #000">
                    <div style="margin-bottom: 15px"><strong>SMP AL MUSYAFFA' KENDAL</strong></div>
                    <div style="margin-bottom: 15px">Jln. Kampir-Sudipayung, Kec. Ngampel, Kab. Kendal - Jawa Tengah
                    </div>
                    www.smpalmusyaffa.com </div>
                </td>
            </tr>
        </tbody>
    </table> --}}
    <div style="margin-bottom: 5px; text-align:center;border-bottom:2px solid rgb(80, 78, 78);"><strong>Daftar Kumpulan Nilai Informatika</strong></div>
    <table align="center" style="width:100%">
        <tr>
            <td>Kelas</td>
            <td>:</td>
            <td>7.A</td>
            <td style="width: 20%">&nbsp;</td>
            <td>Tahun</td>
            <td>:</td>
            <td>2021 / 2022</td>
        </tr>
        <tr>
            <td>Semester</td>
            <td>:</td>
            <td>1</td>
            <td style="width: 20%">&nbsp;</td>
            <td>Wali Kelas</td>
            <td>:</td>
            <td>Taqius Shofi Albastomi,S.Kom</td>
        </tr>
    </table>
    <table border="1" style="border-collapse:collapse; width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Tugas</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: center">1</td>
            </tr>
        </tbody>
    </table>
    {{-- <table align="left" style="width:40%; padding:5px; font-size:10pt;border-collapse:collapse">
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
    </table> --}}
    <table align="center" style="text-align: center; width:100%">
        <tr>
            <td>Mengetahui</td>
            <td>&nbsp;</td>
            <td>Kendal, {{ Carbon\Carbon::parse(gmdate('Y-m-d'))->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td>Guru Mata Pelajaran</td>
            <td>&nbsp;</td>
            <td>Wali Kelas</td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td><b>{{ auth()->user()->name }}</b></td>
            <td>&nbsp;</td>
            <td><b>Nama Wali Kelas</b></td>
        </tr>
    </table>
</body>

</html>
