<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Laporan Kehadiran</title>
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
    <div style="margin-bottom: 5px; text-align:center;border-bottom:2px solid rgb(80, 78, 78);"><strong>Laporan Kehadiran Siswa</strong></div>
    <table align="left">
        <thead>
            <tr style="text-align: left">
                <th>Kelas</th>
                <th>:</th>
                <th>{{ $nama_kelas }}</th>
            </tr>
            <tr style="text-align: left">
                <th>Tanggal</th>
                <th>:</th>
                <th>{{ Carbon\Carbon::parse($tanggalawal)->translatedFormat('l, d F Y') }}</th>
            </tr>
        </thead>
    </table>
    <table align="right">
        <thead>
            <tr style="text-align: left">
                <th>Wali Kelas</th>
                <th>:</th>
                <th>
                    @foreach ($wali_kelas as $wali)
                    {{ $wali->guru->name }}
                    @endforeach
                </th>
            </tr>
            <tr style="text-align: left">
                <th>Sampai Tanggal</th>
                <th>:</th>
                <th>{{ Carbon\Carbon::parse($tanggalakhir)->translatedFormat('l, d F Y') }}</th>
            </tr>
        </thead>
    </table>
    <table border="1" style="border-collapse:collapse; width:100%;font-size:9pt">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">NIS</th>
                <th rowspan="2">Nama</th>
                <th colspan="7">Kehadiran</th>
            </tr>
            <tr>
                <th>H</th>
                <th>I</th>
                <th>S</th>
                <th>A</th>
                <th>B</th>
                <th>P</th>
                <th>Presentase</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list_siswa as $key => $siswa)
                <tr>
                    <td style="text-align: center">{{ $loop->iteration }}</td>
                    <td style="text-align: center">{{ $siswa->nis }}</td>
                    <td style="padding-left:5px; white-space:nowrap">{{ $siswa->user->name }}</td>
                    <td style="text-align: center">{{ $list_hadir[$key] }}</td>
                    <td style="text-align: center">{{ $list_izin[$key] }}</td>
                    <td style="text-align: center">{{ $list_sakit[$key] }}</td>
                    <td style="text-align: center">{{ $list_alpha[$key] }}</td>
                    <td style="text-align: center">{{ $list_bolos[$key] }}</td>
                    <td style="text-align: center">{{ $list_pulang[$key] }}</td>
                    <td style="text-align: center">{{ $list_present[$key] . ' %' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="padding: 8px"></div>
    <table align="right" style="text-align: center;margin-right:30px">
        <tr>
            <td>Kendal, {{ Carbon\Carbon::parse(gmdate('Y-m-d'))->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td>Guru Bimbingan dan Konseling</td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td><b>{{ auth()->user()->name }}</b></td>
        </tr>
    </table>
</body>

</html>
