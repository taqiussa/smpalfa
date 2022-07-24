<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Analisis Penilaian</title>
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
    <div style="margin-bottom: 5px; text-align:center;border-bottom:2px solid rgb(80, 78, 78);"><strong>Analisis
            Penilaian {{ $jenis_penilaian }}</strong></div>
    {{-- <table align="left">
        <thead>
            <tr style="text-align: left">
                <th>Kelas</th>
                <th>:</th>
                <th>{{ $nama_kelas }}</th>
            </tr>
            <tr style="text-align: left">
                <th>Semester</th>
                <th>:</th>
                <th>{{ $semester }}</th>
            </tr>
        </thead>
    </table>
    <table align="right">
        <thead>
            <tr style="text-align: left">
                <th>Tahun</th>
                <th>:</th>
                <th>{{ $tahun }}</th>
            </tr>
            <tr style="text-align: left">
                <th>Wali Kelas</th>
                <th>:</th>
                <th>
                    @foreach ($wali_kelas as $wali)
                        {{ $wali->guru->name }}
                    @endforeach
                </th>
            </tr>
        </thead>
    </table> --}}
    <table border="1" style="border-collapse:collapse; width:100%;font-size:9pt">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">NIS</th>
                <th rowspan="2">Nama</th>
                <th colspan="10">Nomor Soal</th>
                <th rowspan="2">Nilai</th>
                <th colspan="2">Tuntas</th>
            </tr>
            <tr>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
                <th>6</th>
                <th>7</th>
                <th>8</th>
                <th>9</th>
                <th>10</th>
                <th>Ya</th>
                <th>Tidak</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list_analisis as $key => $analisis)
                <tr>
                    <td style="text-align: center">{{ $loop->iteration }}</td>
                    <td style="text-align: center">{{ $analisis->nis }}</td>
                    <td style="padding-left:5px; white-space:nowrap">{{ $analisis->siswa->name }}</td>
                    <td style="text-align: center">{{ $analisis->no_1 }}</td>
                    <td style="text-align: center">{{ $analisis->no_2 }}</td>
                    <td style="text-align: center">{{ $analisis->no_3 }}</td>
                    <td style="text-align: center">{{ $analisis->no_4 }}</td>
                    <td style="text-align: center">{{ $analisis->no_5 }}</td>
                    <td style="text-align: center">{{ $analisis->no_6 }}</td>
                    <td style="text-align: center">{{ $analisis->no_7 }}</td>
                    <td style="text-align: center">{{ $analisis->no_8 }}</td>
                    <td style="text-align: center">{{ $analisis->no_9 }}</td>
                    <td style="text-align: center">{{ $analisis->no_10 }}</td>
                    <td style="text-align: center">{{ $analisis->nilai }}</td>
                    @if ($analisis->nilai > $kkm)
                        <td style="text-align: center">
                            <svg style="width:22px;height:22px" viewBox="0 0 22 22">
                                <path fill="currentColor"
                                    d="M12 2C6.5 2 2 6.5 2 12S6.5 22 12 22 22 17.5 22 12 17.5 2 12 2M10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z" />
                            </svg>
                        </td>
                        <td style="text-align: center"></td>
                    @else
                        <td style="text-align: center"></td>
                        <td style="text-align: center">
                            <svg style="width:22px;height:22px" viewBox="0 0 22 22">
                                <path fill="currentColor"
                                    d="M12 2C6.5 2 2 6.5 2 12S6.5 22 12 22 22 17.5 22 12 17.5 2 12 2M10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z" />
                            </svg>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="padding: 8px"></div>
    <table align="center" style="text-align: center; width:100%">
        <tr>
            <td>Mengetahui</td>
            <td>&nbsp;</td>
            <td>Kendal, {{ Carbon\Carbon::parse(gmdate('Y-m-d'))->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td>Kepala Sekolah</td>
            <td>&nbsp;</td>
            <td>Guru Mata Pelajaran</td>
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
            <td><b>
                    @foreach ($kepala_sekolah as $kasek)
                        {{ $kasek->name }}
                    @endforeach
                </b></td>
            <td>&nbsp;</td>
            <td><b>{{ auth()->user()->name }}</b></td>
        </tr>
    </table>
</body>

</html>
