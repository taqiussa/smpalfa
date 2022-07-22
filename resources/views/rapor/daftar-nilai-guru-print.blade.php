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
    <div style="margin-bottom: 5px; text-align:center;border-bottom:2px solid rgb(80, 78, 78);"><strong>Daftar Kumpulan
            Nilai {{ $nama_mapel }}</strong></div>
    <table align="left">
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
    </table>
    <table border="1" style="border-collapse:collapse; width:100%;font-size:9pt">
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                @foreach ($list_penilaian as $penilaian)
                    <th>{{ $penilaian->jenis_penilaian->nama }}</th>
                @endforeach
                <th>Nilai Rapor Pengetahuan</th>
                <th>Nilai Rapor Keterampilan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list_siswa as $siswa)
                <tr>
                    <td style="text-align: center">{{ $loop->iteration }}</td>
                    <td style="text-align: center">{{ $siswa->nis }}</td>
                    <td style="padding-left:5px; white-space:nowrap">{{ $siswa->user->name }}</td>
                    @foreach ($list_penilaian as $penilaian)
                        <td style="text-align: center">
                            @php
                                $nilai = App\Models\Penilaian::where('tahun', $tahun)
                                    ->where('semester', $semester)
                                    ->where('jenis_penilaian_id', $penilaian->jenis_penilaian_id)
                                    ->where('mata_pelajaran_id', $mata_pelajaran)
                                    ->where('nis', $siswa->nis)
                                    ->value('nilai');
                            @endphp
                            {{ $nilai }}
                        </td>
                    @endforeach
                    <td style="text-align: center">
                        @php
                            $pengetahuan = App\Models\Penilaian::where('tahun', $tahun)
                            ->where('semester', $semester)
                            ->where('kategori_nilai_id', 3)
                            ->where('nis', $siswa->nis)
                            ->pluck('nilai')->avg();
                        @endphp
                        {{ round($pengetahuan) }}
                    </td>
                    <td style="text-align: center">
                        @php
                            $keterampilan = App\Models\Penilaian::where('tahun', $tahun)
                            ->where('semester', $semester)
                            ->where('kategori_nilai_id', 4)
                            ->where('nis', $siswa->nis)
                            ->pluck('nilai')->avg();
                        @endphp
                        {{ round($keterampilan) }}
                    </td>
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
            <td>Wali Kelas</td>
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
                @foreach ($wali_kelas as $wali)
                {{ $wali->guru->name }}
                @endforeach
            </b></td>
            <td>&nbsp;</td>
            <td><b>{{ auth()->user()->name }}</b></td>
        </tr>
    </table>
</body>

</html>
