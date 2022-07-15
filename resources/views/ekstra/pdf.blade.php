<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Absensi Ekstra</title>
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
        style="border-bottom: 3px solid #000; padding:5px; text-align:center;line-height:5px;width:100%">
        <tbody>
            <tr>
                <td tyle="text-align: left"><img src="{{ asset('images/logoalfa.png') }}" alt="logo"
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
        <h4>LAPORAN ABSENSI EKSTRAKURIKULER</h4>
    </div>
    <table style="width:100%">
        <tr>
            <th style="width: 25%; text-align:left">Nama Ekstrakurikuler</th>
            <th style="width: 1%">:</th>
            <th style="width: 30%; text-align:left">{{ $nama_ekstra }}</th>
            <th style="width: 10%">&nbsp;</th>
            <th style="width: 15%; text-align:left">Tahun</th>
            <th style="width: 1%">:</th>
            <th style="width: 18%; text-align:left">{{ $tahun }}</th>
        </tr>
        <tr>
            <th style="width: 25%; text-align:left">Tanggal Absensi</th>
            <th style="width: 1%">:</th>
            <th style="width: 30%; text-align:left">{{ Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}
            </th>
            <th style="width: 10%">&nbsp;</th>
            <th style="width: 15%; text-align:left">Semester</th>
            <th style="width: 1%">:</th>
            <th style="width: 18%; text-align:left">{{ $semester }}</th>
        </tr>
    </table>
    <table style="width: 100%;border:#000 solid 1px;border-collapse:collapse">
        <thead>
            <tr>
                <th style="border:#000 solid 1px;padding:5px">#</th>
                <th style="border:#000 solid 1px;padding:5px">Nama</th>
                <th style="border:#000 solid 1px;padding:5px">Kelas</th>
                <th style="border:#000 solid 1px;padding:5px">Kehadiran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list_absensi as $absensi)
                <tr>
                    <td style="border:#000 solid 1px;border-collapse:collapse; padding:5px; text-align:center">
                        {{ $loop->iteration }}</td>
                    <td style="border:#000 solid 1px;border-collapse:collapse; padding:5px">{{ $absensi->name }}</td>
                    <td style="border:#000 solid 1px;border-collapse:collapse; padding:5px; text-align:center">
                        {{ $absensi->kelas }}</td>
                    <td style="border:#000 solid 1px;border-collapse:collapse; padding:5px">{{ $absensi->kehadiran }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <div style="padding: 15"></div>
    <table style="padding-left: 25px;text-align:center" width="100%">
        <tr>
            <td colspan="2"></td>
            <td style="text-align:center">
                Ngampel, {{ Carbon\Carbon::parse(gmdate('Y-m-d'))->translatedFormat('d F Y') }}
            </td>
        </tr>
        <tr>
            <td style="text-align:center">Waka.Ur Kesiswaan</td>
            <td style="width: 35%"></td>
            <td style="text-align:center">Pembina Ekstrakurikuler</td>
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
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align:center">
                <b>
                    {{ $kesiswaan[0]->name }}
                </b>
            </td>
            <td></td>
            <td style="text-align:center">
                <b>
                    {{ auth()->user()->name }}
                </b>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:center">Mengetahui :</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:center">Kepala SMP Al Musyaffa'</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:center">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:center">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:center">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:center">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:center">
                <b>
                    @foreach ($kepala_sekolah as $kasek)
                        {{ $kasek->name }}
                    @endforeach
                </b>
            </td>
        </tr>
    </table> --}}
</body>

</html>
