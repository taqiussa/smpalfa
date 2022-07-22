<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Daftar Nilai Kelas</title>
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
            Nilai</strong></div>
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
                <th rowspan="3">No</th>
                <th rowspan="3">NIS</th>
                <th rowspan="3">Nama</th>
                <th colspan="{{ $total_mapel }}">Pengetahuan dan KKM</th>
                <th colspan="{{ $total_mapel }}">Keterampilan dan KKM</th>
                <th style="padding: 5px" colspan="2">Nilai Sikap</th>
                <th style="padding: 5px" colspan="2">Jumlah</th>
                <th style="padding: 5px" rowspan="3">Total Nilai</th>
            </tr>
            <tr>
                {{-- Mapel Pengetahuan --}}
                @foreach ($list_mata_pelajaran as $mata_pelajaran)
                    <th style="padding: 5px">{{ $mata_pelajaran->mapel->nama }}</th>
                @endforeach
                {{-- Mapel Keterampilan --}}
                @foreach ($list_mata_pelajaran as $mata_pelajaran)
                    <th style="padding: 5px">{{ $mata_pelajaran->mapel->nama }}</th>
                @endforeach
                <th style="padding: 5px" rowspan="2">Spiritual</th>
                <th style="padding: 5px" rowspan="2">Sosial</th>
                <th style="padding: 5px" rowspan="2">Pengetahuan</th>
                <th style="padding: 5px" rowspan="2">Keterampilan</th>

            </tr>
            <tr>
                {{-- KKM Pengetahuan --}}
                @foreach ($list_mata_pelajaran as $mata_pelajaran)
                    <th>{{ $mata_pelajaran->kkm }}</th>
                @endforeach
                {{-- KKM Keterampilan --}}
                @foreach ($list_mata_pelajaran as $mata_pelajaran)
                    <th>{{ $mata_pelajaran->kkm }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($list_siswa as $siswa)
                <tr>
                    <td style="text-align: center">{{ $loop->iteration }}</td>
                    <td style="text-align: center">{{ $siswa->nis }}</td>
                    <td style="padding-left:5px; white-space:nowrap">{{ $siswa->user->name }}</td>
                    @foreach ($list_mata_pelajaran as $mata_pelajaran)
                        {{-- penilaian pengetahuan --}}
                        <td style="text-align: center">
                            @php
                                $pengetahuan = App\Models\Penilaian::where('tahun', $tahun)
                                    ->where('semester', $semester)
                                    ->where('kategori_nilai_id', 3)
                                    ->where('mata_pelajaran_id', $mata_pelajaran->mapel->id)
                                    ->where('nis', $siswa->nis)
                                    ->pluck('nilai')
                                    ->avg();
                            @endphp
                            {{ floor($pengetahuan) }}
                        </td>
                    @endforeach
                    @foreach ($list_mata_pelajaran as $mata_pelajaran)
                        {{-- penilaian keterampilan --}}
                        <td style="text-align: center">
                            @php
                                $keterampilan = App\Models\Penilaian::where('tahun', $tahun)
                                    ->where('semester', $semester)
                                    ->where('kategori_nilai_id', 4)
                                    ->where('mata_pelajaran_id', $mata_pelajaran->mapel->id)
                                    ->where('nis', $siswa->nis)
                                    ->pluck('nilai')
                                    ->avg();
                            @endphp
                            {{ floor($keterampilan) }}
                        </td>
                    @endforeach
                    <td style="text-align: center">
                        {{-- Nilai Sikap Spiritual --}}
                        @php
                            $id_mapel = App\Models\GuruMapel::where('user_id', $id_wali_kelas)->pluck('mata_pelajaran_id');
                            $sikap_mapel = App\Models\PenilaianSikap::where('tahun', $tahun)
                                ->where('semester', $semester)
                                ->where('kategori_sikap_id', 1)
                                ->where('nis', $siswa->nis)
                                ->selectRaw('round(avg(nilai)) as nilai')
                                ->value('nilai');
                            $sikap_wali = App\Models\PenilaianSikap::where('tahun', $tahun)
                                ->where('semester', $semester)
                                ->where('kategori_sikap_id', 1)
                                ->where('nis', $siswa->nis)
                                ->whereIn('mata_pelajaran_id', $id_mapel)
                                ->selectRaw('round(avg(nilai)) as nilai')
                                ->value('nilai');
                            $hasil = (intval($sikap_mapel) + intval($sikap_wali)) / 2;
                            if ($hasil > 90) {
                                $predikat_spiritual = 'A';
                            } elseif ($hasil > 80) {
                                $predikat_spiritual = 'B';
                            } elseif ($hasil > 70) {
                                $predikat_spiritual = 'C';
                            } else {
                                $predikat_spiritual = 'D';
                            }
                        @endphp
                        {{ $predikat_spiritual }}
                    </td>
                    <td style="text-align: center">
                        {{-- Nilai Sikap Spiritual --}}
                        @php
                            $id_mapel = App\Models\GuruMapel::where('user_id', $id_wali_kelas)->pluck('mata_pelajaran_id');
                            $sikap_mapel = App\Models\PenilaianSikap::where('tahun', $tahun)
                                ->where('semester', $semester)
                                ->where('kategori_sikap_id', 2)
                                ->where('nis', $siswa->nis)
                                ->selectRaw('round(avg(nilai)) as nilai')
                                ->value('nilai');
                            $sikap_wali = App\Models\PenilaianSikap::where('tahun', $tahun)
                                ->where('semester', $semester)
                                ->where('kategori_sikap_id', 2)
                                ->where('nis', $siswa->nis)
                                ->whereIn('mata_pelajaran_id', $id_mapel)
                                ->selectRaw('round(avg(nilai)) as nilai')
                                ->value('nilai');
                            $hasil = (intval($sikap_mapel) + intval($sikap_wali)) / 2;
                            if ($hasil > 90) {
                                $predikat_sosial = 'A';
                            } elseif ($hasil > 80) {
                                $predikat_sosial = 'B';
                            } elseif ($hasil > 70) {
                                $predikat_sosial = 'C';
                            } else {
                                $predikat_sosial = 'D';
                            }
                        @endphp
                        {{ $predikat_sosial }}
                    </td>
                    <td style="text-align: center">
                        {{-- Jumlah Pengetahuan --}}
                        @php
                            $jumlah_pengetahuan = App\Models\Penilaian::where('tahun', $tahun)
                                ->where('semester', $semester)
                                ->where('kategori_nilai_id', 3)
                                ->where('nis', $siswa->nis)
                                ->groupBy('mata_pelajaran_id')
                                ->selectRaw('mata_pelajaran_id, avg(nilai) as nilai')
                                ->pluck('nilai')
                                ->sum();
                        @endphp
                        {{ floor($jumlah_pengetahuan) }}
                    </td>
                    <td style="text-align: center">
                        {{-- Jumlah keterampilan --}}
                        @php
                            $jumlah_keterampilan = App\Models\Penilaian::where('tahun', $tahun)
                                ->where('semester', $semester)
                                ->where('kategori_nilai_id', 4)
                                ->where('nis', $siswa->nis)
                                ->groupBy('mata_pelajaran_id')
                                ->selectRaw('mata_pelajaran_id, avg(nilai) as nilai')
                                ->pluck('nilai')
                                ->sum();
                        @endphp
                        {{ floor($jumlah_keterampilan) }}
                    </td>
                    <td style="text-align: center">
                        {{-- Total Pengetahuan + Keterampilan --}}
                        @php
                            $total = floor($jumlah_pengetahuan) + floor($jumlah_keterampilan);
                        @endphp
                        {{ $total }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="padding: 8px"></div>
    <table align="right" style="text-align: center;margin-right:30px;padding-right:30px">
        <tr>
            <td>Kendal, {{ Carbon\Carbon::parse(gmdate('Y-m-d'))->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
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
            <td><b>
                    @foreach ($wali_kelas as $wali)
                        {{ $wali->guru->name }}
                    @endforeach
                </b></td>
        </tr>
    </table>
</body>

</html>
