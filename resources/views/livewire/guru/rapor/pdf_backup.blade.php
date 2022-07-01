<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Rapor</title>
    <style type="text/css">
        body {
            font-family: arial;
            font-size: 11pt;
            width: 21cm;
        }

        .table {
            border-collapse: collapse;
            border: solid 1px #999;
            width: 100%
        }

        .table tr td,
        .table tr th {
            border: solid 1px #000;
            padding: 3px;
        }

        .table tr th {
            font-weight: bold;
            text-align: center
        }

        .rgt {
            text-align: right;
        }

        .ctr {
            text-align: center;
        }

        .tbl {
            font-weight: bold
        }

        table tr td {
            vertical-align: top
        }

        .font_kecil {
            font-size: 12px
        }

        @media screen {
            div.footer {
                display: none;
            }
        }

        @media print {
            div.footer {
                position: fixed;
                bottom: 0px;
            }
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <!-- biar bisa ganti lembar otomatis -->
        </thead>

        <tbody>
            <tr>
                <td colspan="6" style="text-align: center; font-weight: bold">
                    <p>
                    <h3>PENCAPAIAN KOMPETENSI AKADEMIK PESERTA DIDIK</h3>
                    </p>
                    <p>
                    <h3>TAHUN PELAJARAN 2021 / 2022</h3>
                    </p>
                </td>
            </tr>
            <tr>
                <td width="20%">Nama Sekolah</td>
                <td width="1%">:</td>
                <td width="39%" class="tbl">SMP Al Musyaffa Kendal</td>
                <td width="20%">Kelas</td>
                <td width="1%">:</td>
                <td width="19%" class="tbl">7.A</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td class="tbl">Jl. Kampir Sudipayung, Kec. Ngampel, Kab. Kendal</td>
                <td>Semester</td>
                <td>:</td>
                <td class="tbl">Semester</td>
            </tr>
            <tr>
                <td>Nama Siswa</td>
                <td>:</td>
                <td class="tbl">Nama Siswa</td>
                <td>Tahun Pelajaran</td>
                <td>:</td>
                <td class="tbl">Tahun Pelajaran</td>
            </tr>
            <tr>
                <td>NIS / NISN</td>
                <td>:</td>
                <td class="tbl">Nis / NISN</td>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td colspan="6"><br><br></td>
            </tr>
            <tr>
                <td colspan="6"><b>A. SIKAP</b></td>
            </tr>
            <tr>
                <td colspan="6">
                    <table style="margin-left: 15px; border-collapse: collapse;">
                        <tr>
                            <td width="3%"><b>1.</b></td>
                            <td width="97%" colspan="2"><b>Sikap Spiritual</b></td>
                        </tr>
                        <tr>
                            <td width="3%"></td>
                            <td width="7%" style="border: solid 1px #000; padding: 10px">Predikat</td>
                            <td width="90%" style="border: solid 1px #000; padding: 10px">Deskripsi</td>
                        </tr>
                        <tr>
                            <td width="3%"></td>
                            <td width="7%" style="border: solid 1px #000; padding: 10px">Baik</td>
                            <td width="90%" style="border: solid 1px #000; padding: 10px">
                                Lorem ipsum dolor sit amet
                                consectetur adipisicing elit. Quam tempore beatae nemo adipisci ipsum architecto? Iste
                                facilis exercitationem est culpa deleniti dolore soluta accusantium, dolorem amet
                                pariatur, nostrum blanditiis magni?
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"><br></td>
                        </tr>
                        <tr>
                            <td width="3%">
                                <b>2.</b>
                            </td>
                            <td width="97%" colspan="2">
                                <b>Sikap Sosial</b>
                            </td>
                        </tr>
                        <tr>
                            <td width="3%"></td>
                            <td width="7%" style="border: solid 1px #000; padding: 10px">Baik</td>
                            <td width="90%" style="border: solid 1px #000; padding: 10px">
                                Lorem ipsum dolor sit amet
                                consectetur adipisicing elit. Harum, perspiciatis officia placeat enim quas inventore
                                amet repellat, nemo cupiditate error, eius facere aperiam! Ad tenetur amet vero, eaque
                                quo consequatur?
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td><br></td>
            </tr>
            <tr>
                <td colspan="6">
                    <b>B. PENGETAHUAN</b>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="25%">Mata Pelajaran</th>
                                <th width="8%">KBM</th>
                                <th width="8%">Nilai</th>
                                <th width="8%">Predikat</th>
                                <th width="46%">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6" style="text-align: left">Kelompok A</td>
                            </tr>
                            @foreach ($kelompok_a as $mapel)
                                <tr>
                                    <td style="text-align: center">{{ $loop->iteration }}</td>
                                    <td style="text-align: left">{{ $mapel->nama }}</td>
                                    <td style="text-align: center">{{ $mapel->kkm }}</td>
                                    <td style="text-align: center">{{ $mapel->nilai }}</td>
                                    <td style="text-align: center">
                                        @if ($mapel->nilai > 90)
                                            A
                                        @elseif ($mapel->nilai > 80)
                                            B
                                        @elseif ($mapel->nilai > 70)
                                            C
                                        @else
                                            D
                                        @endif
                                    </td>
                                    <td style="text-align: justify">
                                        @php
                                            $nilai_kd = App\Models\Penilaian::where('nis', 210018)
                                                ->where('penilaians.tahun', '2021 / 2022')
                                                ->where('penilaians.semester', 1)
                                                ->where('penilaians.kelas_id', 1)
                                                ->where('penilaians.kategori_nilai_id', 3)
                                                ->where('penilaians.mata_pelajaran_id', $mapel->id)
                                                ->join('kds', 'kds.jenis_penilaian_id', '=', 'penilaians.jenis_penilaian_id')
                                                ->where('kds.tahun', '2021 / 2022')
                                                ->where('kds.semester', 1)
                                                ->where('kds.kategori_nilai_id', 3)
                                                ->where('kds.tingkat', 7)
                                                ->where('kds.mata_pelajaran_id', $mapel->id)
                                                ->get();
                                        @endphp
                                        @foreach ($nilai_kd as $nilai)
                                            @if ($nilai->nilai > 90)
                                                @php
                                                    $predikat = 'Sangat Baik';
                                                @endphp
                                            @elseif ($nilai->nilai > 80)
                                                @php
                                                    $predikat = 'Baik';
                                                @endphp
                                            @elseif ($nilai->nilai > 70)
                                                @php
                                                    $predikat = 'Cukup';
                                                @endphp
                                            @else
                                                @php
                                                    $predikat = 'Kurang';
                                                @endphp
                                            @endif
                                            Memiliki kemampuan {{ $predikat . ' dalam ' . $nilai->deskripsi }}
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="6" style="text-align: left">Kelompok B</td>
                            </tr>
                            @foreach ($kelompok_b as $mapel)
                                <tr>
                                    <td style="text-align: center">{{ $loop->iteration }}</td>
                                    <td style="text-align: left">{{ $mapel->nama }}</td>
                                    <td style="text-align: center">{{ $mapel->kkm }}</td>
                                    <td style="text-align: center">{{ $mapel->nilai }}</td>
                                    <td style="text-align: center">
                                        @if ($mapel->nilai > 90)
                                            A
                                        @elseif ($mapel->nilai > 80)
                                            B
                                        @elseif ($mapel->nilai > 70)
                                            C
                                        @else
                                            D
                                        @endif
                                    </td>
                                    <td style="text-align: justify">
                                        @php
                                            $nilai_kd = App\Models\Penilaian::where('nis', 210018)
                                                ->where('penilaians.tahun', '2021 / 2022')
                                                ->where('penilaians.semester', 1)
                                                ->where('penilaians.kelas_id', 1)
                                                ->where('penilaians.kategori_nilai_id', 3)
                                                ->where('penilaians.mata_pelajaran_id', $mapel->id)
                                                ->join('kds', 'kds.jenis_penilaian_id', '=', 'penilaians.jenis_penilaian_id')
                                                ->where('kds.tahun', '2021 / 2022')
                                                ->where('kds.semester', 1)
                                                ->where('kds.kategori_nilai_id', 3)
                                                ->where('kds.tingkat', 7)
                                                ->where('kds.mata_pelajaran_id', $mapel->id)
                                                ->get();
                                        @endphp
                                        @foreach ($nilai_kd as $nilai)
                                            @if ($nilai->nilai > 90)
                                                @php
                                                    $predikat = 'Sangat Baik';
                                                @endphp
                                            @elseif ($nilai->nilai > 80)
                                                @php
                                                    $predikat = 'Baik';
                                                @endphp
                                            @elseif ($nilai->nilai > 70)
                                                @php
                                                    $predikat = 'Cukup';
                                                @endphp
                                            @else
                                                @php
                                                    $predikat = 'Kurang';
                                                @endphp
                                            @endif
                                            Memiliki kemampuan {{ $predikat . ' dalam ' . $nilai->deskripsi }}
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="6" style="text-align: left">Kelompok C</td>
                            </tr>
                            @foreach ($kelompok_b as $mapel)
                                <tr>
                                    <td style="text-align: center">{{ $loop->iteration }}</td>
                                    <td style="text-align: left">{{ $mapel->nama }}</td>
                                    <td style="text-align: center">{{ $mapel->kkm }}</td>
                                    <td style="text-align: center">{{ $mapel->nilai }}</td>
                                    <td style="text-align: center">
                                        @if ($mapel->nilai > 90)
                                            A
                                        @elseif ($mapel->nilai > 80)
                                            B
                                        @elseif ($mapel->nilai > 70)
                                            C
                                        @else
                                            D
                                        @endif
                                    </td>
                                    <td style="text-align: justify">
                                        @php
                                            $nilai_kd = App\Models\Penilaian::where('nis', 210018)
                                                ->where('penilaians.tahun', '2021 / 2022')
                                                ->where('penilaians.semester', 1)
                                                ->where('penilaians.kelas_id', 1)
                                                ->where('penilaians.kategori_nilai_id', 3)
                                                ->where('penilaians.mata_pelajaran_id', $mapel->id)
                                                ->join('kds', 'kds.jenis_penilaian_id', '=', 'penilaians.jenis_penilaian_id')
                                                ->where('kds.tahun', '2021 / 2022')
                                                ->where('kds.semester', 1)
                                                ->where('kds.kategori_nilai_id', 3)
                                                ->where('kds.tingkat', 7)
                                                ->where('kds.mata_pelajaran_id', $mapel->id)
                                                ->get();
                                        @endphp
                                        @foreach ($nilai_kd as $nilai)
                                            @if ($nilai->nilai > 90)
                                                @php
                                                    $predikat = 'Sangat Baik';
                                                @endphp
                                            @elseif ($nilai->nilai > 80)
                                                @php
                                                    $predikat = 'Baik';
                                                @endphp
                                            @elseif ($nilai->nilai > 70)
                                                @php
                                                    $predikat = 'Cukup';
                                                @endphp
                                            @else
                                                @php
                                                    $predikat = 'Kurang';
                                                @endphp
                                            @endif
                                            Memiliki kemampuan {{ $predikat . ' dalam ' . $nilai->deskripsi }}
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td><br></td>
            </tr>
            <tr>
                <td colspan="6">
                    <b>C. KETERAMPILAN</b>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="25%">Mata Pelajaran</th>
                                <th width="8%">KBM</th>
                                <th width="8%">Nilai</th>
                                <th width="8%">Predikat</th>
                                <th width="46%">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6" style="text-align: left">Kelompok A</td>
                            </tr>
                            @foreach ($kelompok_a2 as $mapel)
                                <tr>
                                    <td style="text-align: center">{{ $loop->iteration }}</td>
                                    <td style="text-align: left">{{ $mapel->nama }}</td>
                                    <td style="text-align: center">{{ $mapel->kkm }}</td>
                                    <td style="text-align: center">{{ $mapel->nilai }}</td>
                                    <td style="text-align: center">
                                        @if ($mapel->nilai > 90)
                                            A
                                        @elseif ($mapel->nilai > 80)
                                            B
                                        @elseif ($mapel->nilai > 70)
                                            C
                                        @else
                                            D
                                        @endif
                                    </td>
                                    <td style="text-align: justify">
                                        @php
                                            $nilai_kd = App\Models\Penilaian::where('nis', 210018)
                                                ->where('penilaians.tahun', '2021 / 2022')
                                                ->where('penilaians.semester', 1)
                                                ->where('penilaians.kelas_id', 1)
                                                ->where('penilaians.kategori_nilai_id', 4)
                                                ->where('penilaians.mata_pelajaran_id', $mapel->id)
                                                ->join('kds', 'kds.jenis_penilaian_id', '=', 'penilaians.jenis_penilaian_id')
                                                ->where('kds.tahun', '2021 / 2022')
                                                ->where('kds.semester', 1)
                                                ->where('kds.kategori_nilai_id', 4)
                                                ->where('kds.tingkat', 7)
                                                ->where('kds.mata_pelajaran_id', $mapel->id)
                                                ->get();
                                        @endphp
                                        @foreach ($nilai_kd as $nilai)
                                            @if ($nilai->nilai > 90)
                                                @php
                                                    $predikat = 'Sangat Baik';
                                                @endphp
                                            @elseif ($nilai->nilai > 80)
                                                @php
                                                    $predikat = 'Baik';
                                                @endphp
                                            @elseif ($nilai->nilai > 70)
                                                @php
                                                    $predikat = 'Cukup';
                                                @endphp
                                            @else
                                                @php
                                                    $predikat = 'Kurang';
                                                @endphp
                                            @endif
                                            Memiliki kemampuan {{ $predikat . ' dalam ' . $nilai->deskripsi }}
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="6" style="text-align: left">Kelompok B</td>
                            </tr>
                            @foreach ($kelompok_b2 as $mapel)
                                <tr>
                                    <td style="text-align: center">{{ $loop->iteration }}</td>
                                    <td style="text-align: left">{{ $mapel->nama }}</td>
                                    <td style="text-align: center">{{ $mapel->kkm }}</td>
                                    <td style="text-align: center">{{ $mapel->nilai }}</td>
                                    <td style="text-align: center">
                                        @if ($mapel->nilai > 90)
                                            A
                                        @elseif ($mapel->nilai > 80)
                                            B
                                        @elseif ($mapel->nilai > 70)
                                            C
                                        @else
                                            D
                                        @endif
                                    </td>
                                    <td style="text-align: justify">
                                        @php
                                            $nilai_kd = App\Models\Penilaian::where('nis', 210018)
                                                ->where('penilaians.tahun', '2021 / 2022')
                                                ->where('penilaians.semester', 1)
                                                ->where('penilaians.kelas_id', 1)
                                                ->where('penilaians.kategori_nilai_id', 4)
                                                ->where('penilaians.mata_pelajaran_id', $mapel->id)
                                                ->join('kds', 'kds.jenis_penilaian_id', '=', 'penilaians.jenis_penilaian_id')
                                                ->where('kds.tahun', '2021 / 2022')
                                                ->where('kds.semester', 1)
                                                ->where('kds.kategori_nilai_id', 4)
                                                ->where('kds.tingkat', 7)
                                                ->where('kds.mata_pelajaran_id', $mapel->id)
                                                ->get();
                                        @endphp
                                        @foreach ($nilai_kd as $nilai)
                                            @if ($nilai->nilai > 90)
                                                @php
                                                    $predikat = 'Sangat Baik';
                                                @endphp
                                            @elseif ($nilai->nilai > 80)
                                                @php
                                                    $predikat = 'Baik';
                                                @endphp
                                            @elseif ($nilai->nilai > 70)
                                                @php
                                                    $predikat = 'Cukup';
                                                @endphp
                                            @else
                                                @php
                                                    $predikat = 'Kurang';
                                                @endphp
                                            @endif
                                            Memiliki kemampuan {{ $predikat . ' dalam ' . $nilai->deskripsi }}
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="6" style="text-align: left">Kelompok C</td>
                            </tr>
                            @foreach ($kelompok_c2 as $mapel)
                                <tr>
                                    <td style="text-align: center">{{ $loop->iteration }}</td>
                                    <td style="text-align: left">{{ $mapel->nama }}</td>
                                    <td style="text-align: center">{{ $mapel->kkm }}</td>
                                    <td style="text-align: center">{{ $mapel->nilai }}</td>
                                    <td style="text-align: center">
                                        @if ($mapel->nilai > 90)
                                            A
                                        @elseif ($mapel->nilai > 80)
                                            B
                                        @elseif ($mapel->nilai > 70)
                                            C
                                        @else
                                            D
                                        @endif
                                    </td>
                                    <td style="text-align: justify">
                                        @php
                                            $nilai_kd = App\Models\Penilaian::where('nis', 210018)
                                                ->where('penilaians.tahun', '2021 / 2022')
                                                ->where('penilaians.semester', 1)
                                                ->where('penilaians.kelas_id', 1)
                                                ->where('penilaians.kategori_nilai_id', 4)
                                                ->where('penilaians.mata_pelajaran_id', $mapel->id)
                                                ->join('kds', 'kds.jenis_penilaian_id', '=', 'penilaians.jenis_penilaian_id')
                                                ->where('kds.tahun', '2021 / 2022')
                                                ->where('kds.semester', 1)
                                                ->where('kds.kategori_nilai_id', 4)
                                                ->where('kds.tingkat', 7)
                                                ->where('kds.mata_pelajaran_id', $mapel->id)
                                                ->get();
                                        @endphp
                                        @foreach ($nilai_kd as $nilai)
                                            @if ($nilai->nilai > 90)
                                                @php
                                                    $predikat = 'Sangat Baik';
                                                @endphp
                                            @elseif ($nilai->nilai > 80)
                                                @php
                                                    $predikat = 'Baik';
                                                @endphp
                                            @elseif ($nilai->nilai > 70)
                                                @php
                                                    $predikat = 'Cukup';
                                                @endphp
                                            @else
                                                @php
                                                    $predikat = 'Kurang';
                                                @endphp
                                            @endif
                                            Memiliki kemampuan {{ $predikat . ' dalam ' . $nilai->deskripsi }}
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td><br></td>
            </tr>
            <tr>
                <td colspan="6"><b>D. EKSTRAKURIKULER</b></td>
            </tr>
            <tr>
                <td colspan="6">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="30%">Nama Kegiatan</th>
                                <th width="10%">Nilai</th>
                                <th width="55%">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td class="ctr">No</td>
                                <td>Nama</td>
                                <td class="ctr">Nilai</td>
                                <td>Deskripsi</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td><br></td>
            </tr>
            <tr>
                <td colspan="6"><b>E. KETIDAKHADIRAN</b></td>
            </tr>
            <tr>
                <td colspan="6">
                    <table width="100%">
                        <tr>
                            <td width="40%">
                                <table class="table" width="100%">
                                    <tr>
                                        <td width="60%">Sakit</td>
                                        <td width="40%" class="ctr"> hari</td>
                                    </tr>
                                    <tr>
                                        <td>Izin</td>
                                        <td class="ctr"> hari</td>
                                    </tr>
                                    <tr>
                                        <td>Tanpa Keterangan</td>
                                        <td class="ctr"> hari</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="60%">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td><br></td>
            </tr>
            <tr>
                <td colspan="6"><b>F. PRESTASI</b></td>
            </tr>
            <tr>
                <td colspan="6">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="30%">Jenis Prestasi</th>
                                <th width="55%">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="5%" style="text-align: center">No</td>
                                <td width="40%">Jenis Prestasi</th>
                                <td width="55%">Keterangan</td>
                            </tr>
                            <tr>
                                <td width="5%" style="text-align: center">No</td>
                                <td width="40%">Jenis Prestasi</th>
                                <td width="55%">Keterangan</td>
                            </tr>
                            <tr>
                                <td width="5%" style="text-align: center">No</td>
                                <td width="40%">Jenis Prestasi</th>
                                <td width="55%">Keterangan</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td><br></td>
            </tr>
            <tr>
                <td colspan="6"><b>G. CATATAN WALIKELAS</b></td>
            </tr>
            <tr>
                <td colspan="6" style="border:#000 1px solid">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti a neque ut harum earum maiores
                    mollitia ipsam voluptates numquam? Molestias.
                </td>
            </tr>
            <tr>
                <td><br></td>
            </tr>
            <tr>
                <td colspan="6"><b>H. TANGGAPAN ORANGTUA/WALI</b></td>
            </tr>
            <tr>
                <td colspan="6">
                    <table style="border: #000 1px solid; border-collapse:collapse;" width="100%">
                        <tbody>
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
                                <td>&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td><br></td>
            </tr>
            <tr>
                <td colspan="6"><b>Keputusan</b> Berdasarkan pencapaian kompetensi pada semester ke-1 dan ke-2,
                    peserta didik ditetapkan *)</td>
            </tr>
            <tr>
                <td colspan="6">
                    Naik Kelas
                    <br>
                    Tinggal Kelas
                    <br>
                    *) Coret yang tidak perlu
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <br><br>
                    <table width="100%">
                        <tr>
                            <td width="10%"></td>
                            <td width="20%">
                                Mengetahui : <br><br>
                                Orang Tua/Wali, <br>
                                <br><br><br><br>
                                <u>..........................</u>
                            </td>
                            <td width="8%"></td>
                            <td width="25%">
                                <br>
                                <br>
                                Wali Kelas <br>
                                <br><br><br><br>
                                <u><b>Wali Kelas</b></u><br>
                                NIP. -
                            </td>
                            <td width="8%"></td>
                            <td width="29%">
                                Ngampel, 20 Juni 2022 <br><br>
                                Kepala SMP Al Musyaffa <br>
                                <br><br><br><br>
                                <u><b>
                                        @foreach ($kepala_sekolah as $kasek)
                                            {{ $kasek->name }}
                                        @endforeach
                                    </b></u><br>
                                NIP. -
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="footer">
        NAMA Siswa
    </div>
</body>

</html>
