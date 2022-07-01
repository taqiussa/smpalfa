<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RAPOR</title>
    <style type="text/css">
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 14pt;
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

        /* div.footer {
            position: fixed;
            bottom: 0px;
        } */

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

        /* @page {
            margin: 0.1px;
        } */
    </style>
</head>

<body>
    <div style="text-align: center">
        <h4>PENCAPAIAN KOMPETENSI AKADEMIK PESERTA DIDIK</h4>
        <h4>TAHUN PELAJARAN {{ $tahun }}</h4>
    </div>
    <hr>
    <table>
        <tbody>
            <tr>
                <td width="20%">Nama Sekolah</td>
                <td width="1%">:</td>
                <td width="39%">SMP Al Musyaffa Kendal</td>
                <td width="20%">Kelas</td>
                <td width="1%">:</td>
                <td width="19%">{{ $nama_kelas }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>Jl. Kampir Sudipayung, Kec. Ngampel, Kab. Kendal</td>
                <td>Semester</td>
                <td>:</td>
                <td>{{ $semester }}</td>
            </tr>
            <tr>
                <td>Nama Siswa</td>
                <td>:</td>
                <td>{{ $nama_siswa }}</td>
                <td>Tahun Pelajaran</td>
                <td>:</td>
                <td>{{ $tahun }}</td>
            </tr>
            <tr>
                <td>NIS / NISN</td>
                <td>:</td>
                <td>{{ $nis }} / {{ $nisn }}</td>
                <td colspan="3"></td>
            </tr>
        </tbody>
    </table>
    <br>
    <b>A. SIKAP</b>
    <table style="border-collapse: collapse">
        <tbody>
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
                <td width="7%" style="border: solid 1px #000; padding: 10px">{{ $spiritual }}</td>
                <td width="90%" style="border: solid 1px #000; padding: 10px">
                    Terbiasa berdoa sebelum dan sesudah melakukan kegiatan, memelihara hubungan baik dengan sesama umat
                    Ciptaan Tuhan Yang Maha Esa, dan bersyukur kepada Tuhan Yang Maha Esa sebagai bangsa Indonesia
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
                <td width="7%" style="border: solid 1px #000; padding: 10px">{{ $sosial }}</td>
                <td width="90%" style="border: solid 1px #000; padding: 10px">
                    Terbiasa melaksanakan sikap jujur, disiplin, tanggung jawab, santun, percaya diri, peduli, dan
                    toleransi
            </tr>
        </tbody>
    </table>
    <br>
    <b>B. PENGETAHUAN</b>
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
                @if ($mapel->nilai > 90)
                    @php
                        $predikat = 'A';
                        $nama_predikat = 'Sangat Baik';
                    @endphp
                @elseif ($mapel->nilai > 80)
                    @php
                        $predikat = 'B';
                        $nama_predikat = 'Baik';
                    @endphp
                @elseif ($mapel->nilai > 70)
                    @php
                        $predikat = 'C';
                        $nama_predikat = 'Cukup';
                    @endphp
                @else
                    @php
                        $predikat = 'D';
                        $nama_predikat = 'Kurang';
                    @endphp
                @endif
                <tr>
                    <td style="text-align: center">{{ $loop->iteration }}</td>
                    <td style="text-align: left">{{ $mapel->nama }}</td>
                    <td style="text-align: center">{{ $mapel->kkm }}</td>
                    <td style="text-align: center">{{ $mapel->nilai }}</td>
                    <td style="text-align: center">
                        {{ $predikat }}
                    </td>
                    <td style="text-align: justify">
                        @php
                            $list_kd = App\Models\Kd::where('mata_pelajaran_id', $mapel->id)
                                ->where('tingkat', $tingkat)
                                ->where('tahun', $tahun)
                                ->where('kategori_nilai_id', 3)
                                ->get();
                        @endphp
                        @foreach ($list_kd as $kd)
                            Memiliki kemampuan {{ $nama_predikat . ' ' . $kd->deskripsi }}
                        @endforeach
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6" style="text-align: left">Kelompok B</td>
            </tr>
            @foreach ($kelompok_b as $mapel)
                @if ($mapel->nilai > 90)
                    @php
                        $predikat = 'A';
                        $nama_predikat = 'Sangat Baik';
                    @endphp
                @elseif ($mapel->nilai > 80)
                    @php
                        $predikat = 'B';
                        $nama_predikat = 'Baik';
                    @endphp
                @elseif ($mapel->nilai > 70)
                    @php
                        $predikat = 'C';
                        $nama_predikat = 'Cukup';
                    @endphp
                @else
                    @php
                        $predikat = 'D';
                        $nama_predikat = 'Kurang';
                    @endphp
                @endif
                <tr>
                    <td style="text-align: center">{{ $loop->iteration }}</td>
                    <td style="text-align: left">{{ $mapel->nama }}</td>
                    <td style="text-align: center">{{ $mapel->kkm }}</td>
                    <td style="text-align: center">{{ $mapel->nilai }}</td>
                    <td style="text-align: center">
                        {{ $predikat }}
                    </td>
                    <td style="text-align: justify">
                        @php
                            $list_kd = App\Models\Kd::where('mata_pelajaran_id', $mapel->id)
                                ->where('tingkat', $tingkat)
                                ->where('tahun', $tahun)
                                ->where('kategori_nilai_id', 3)
                                ->get();
                        @endphp
                        @foreach ($list_kd as $kd)
                            Memiliki kemampuan {{ $nama_predikat . ' ' . $kd->deskripsi }}
                        @endforeach
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6" style="text-align: left">Kelompok C</td>
            </tr>
            @foreach ($kelompok_c as $mapel)
                @if ($mapel->nilai > 90)
                    @php
                        $predikat = 'A';
                        $nama_predikat = 'Sangat Baik';
                    @endphp
                @elseif ($mapel->nilai > 80)
                    @php
                        $predikat = 'B';
                        $nama_predikat = 'Baik';
                    @endphp
                @elseif ($mapel->nilai > 70)
                    @php
                        $predikat = 'C';
                        $nama_predikat = 'Cukup';
                    @endphp
                @else
                    @php
                        $predikat = 'D';
                        $nama_predikat = 'Kurang';
                    @endphp
                @endif
                <tr>
                    <td style="text-align: center">{{ $loop->iteration }}</td>
                    <td style="text-align: left">{{ $mapel->nama }}</td>
                    <td style="text-align: center">{{ $mapel->kkm }}</td>
                    <td style="text-align: center">{{ $mapel->nilai }}</td>
                    <td style="text-align: center">
                        {{ $predikat }}
                    </td>
                    <td style="text-align: justify">
                        @php
                            $list_kd = App\Models\Kd::where('mata_pelajaran_id', $mapel->id)
                                ->where('tingkat', $tingkat)
                                ->where('tahun', $tahun)
                                ->where('kategori_nilai_id', 3)
                                ->get();
                        @endphp
                        @foreach ($list_kd as $kd)
                            Memiliki kemampuan {{ $nama_predikat . ' ' . $kd->deskripsi }}
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <b>C. KETERAMPILAN</b>
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
                @if ($mapel->nilai > 90)
                    @php
                        $predikat = 'A';
                        $nama_predikat = 'Sangat Baik';
                    @endphp
                @elseif ($mapel->nilai > 80)
                    @php
                        $predikat = 'B';
                        $nama_predikat = 'Baik';
                    @endphp
                @elseif ($mapel->nilai > 70)
                    @php
                        $predikat = 'C';
                        $nama_predikat = 'Cukup';
                    @endphp
                @else
                    @php
                        $predikat = 'D';
                        $nama_predikat = 'Kurang';
                    @endphp
                @endif
                <tr>
                    <td style="text-align: center">{{ $loop->iteration }}</td>
                    <td style="text-align: left">{{ $mapel->nama }}</td>
                    <td style="text-align: center">{{ $mapel->kkm }}</td>
                    <td style="text-align: center">{{ $mapel->nilai }}</td>
                    <td style="text-align: center">
                        {{ $predikat }}
                    </td>
                    <td style="text-align: justify">
                        @php
                            $list_kd = App\Models\Kd::where('mata_pelajaran_id', $mapel->id)
                                ->where('tingkat', $tingkat)
                                ->where('tahun', $tahun)
                                ->where('kategori_nilai_id', 4)
                                ->get();
                        @endphp
                        @foreach ($list_kd as $kd)
                            Memiliki kemampuan {{ $nama_predikat . ' ' . $kd->deskripsi }}
                        @endforeach
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6" style="text-align: left">Kelompok B</td>
            </tr>
            @foreach ($kelompok_b2 as $mapel)
                @if ($mapel->nilai > 90)
                    @php
                        $predikat = 'A';
                        $nama_predikat = 'Sangat Baik';
                    @endphp
                @elseif ($mapel->nilai > 80)
                    @php
                        $predikat = 'B';
                        $nama_predikat = 'Baik';
                    @endphp
                @elseif ($mapel->nilai > 70)
                    @php
                        $predikat = 'C';
                        $nama_predikat = 'Cukup';
                    @endphp
                @else
                    @php
                        $predikat = 'D';
                        $nama_predikat = 'Kurang';
                    @endphp
                @endif
                <tr>
                    <td style="text-align: center">{{ $loop->iteration }}</td>
                    <td style="text-align: left">{{ $mapel->nama }}</td>
                    <td style="text-align: center">{{ $mapel->kkm }}</td>
                    <td style="text-align: center">{{ $mapel->nilai }}</td>
                    <td style="text-align: center">
                        {{ $predikat }}
                    </td>
                    <td style="text-align: justify">
                        @php
                            $list_kd = App\Models\Kd::where('mata_pelajaran_id', $mapel->id)
                                ->where('tingkat', $tingkat)
                                ->where('tahun', $tahun)
                                ->where('kategori_nilai_id', 4)
                                ->get();
                        @endphp
                        @foreach ($list_kd as $kd)
                            Memiliki kemampuan {{ $nama_predikat . ' ' . $kd->deskripsi }}
                        @endforeach
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6" style="text-align: left">Kelompok C</td>
            </tr>
            @foreach ($kelompok_c2 as $mapel)
                @if ($mapel->nilai > 90)
                    @php
                        $predikat = 'A';
                        $nama_predikat = 'Sangat Baik';
                    @endphp
                @elseif ($mapel->nilai > 80)
                    @php
                        $predikat = 'B';
                        $nama_predikat = 'Baik';
                    @endphp
                @elseif ($mapel->nilai > 70)
                    @php
                        $predikat = 'C';
                        $nama_predikat = 'Cukup';
                    @endphp
                @else
                    @php
                        $predikat = 'D';
                        $nama_predikat = 'Kurang';
                    @endphp
                @endif
                <tr>
                    <td style="text-align: center">{{ $loop->iteration }}</td>
                    <td style="text-align: left">{{ $mapel->nama }}</td>
                    <td style="text-align: center">{{ $mapel->kkm }}</td>
                    <td style="text-align: center">{{ $mapel->nilai }}</td>
                    <td style="text-align: center">
                        {{ $predikat }}
                    </td>
                    <td style="text-align: justify">
                        @php
                            $list_kd = App\Models\Kd::where('mata_pelajaran_id', $mapel->id)
                                ->where('tingkat', $tingkat)
                                ->where('tahun', $tahun)
                                ->where('kategori_nilai_id', 4)
                                ->get();
                        @endphp
                        @foreach ($list_kd as $kd)
                            Memiliki kemampuan {{ $nama_predikat . ' ' . $kd->deskripsi }}
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <b>D. EKSTRAKURIKULER</b>
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
            @foreach ($nilai_ekstra as $ekstra)
                <tr>
                    <td class="ctr">{{ $loop->iteration }}</td>
                    <td>{{ $ekstra->ekstra->nama }}</td>
                    <td class="ctr">{{ $ekstra->nilai }}</td>
                    <td>
                        @if ($ekstra->nilai > 90)
                            Sangat Baik
                        @elseif ($ekstra->nilai > 80)
                            Baik
                        @elseif ($ekstra->nilai > 70)
                            Cukup
                        @else
                            Kurang
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <b>E. KETIDAKHADIRAN</b>
    <table class="table">
        <tbody>
            <tr>
                <td width="60%">Sakit</td>
                <td width="40%" class="ctr"> {{ $sakit }} hari</td>
            </tr>
            <tr>
                <td>Izin</td>
                <td class="ctr"> {{ $izin }} hari</td>
            </tr>
            <tr>
                <td>Tanpa Keterangan</td>
                <td class="ctr"> {{ $alpha }} hari</td>
            </tr>
            </tr>
        </tbody>
    </table>
    <br>
    <b>F. PRESTASI</b>
    <table class="table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="30%">Jenis Prestasi</th>
                <th width="55%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list_prestasi as $prestasi)
                <tr>
                    <td width="5%" style="text-align: center">{{ $loop->iteration }}</td>
                    <td width="40%">{{ $prestasi->prestasi }}</th>
                    <td width="55%">{{ $prestasi->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <b>G. CATATAN WALIKELAS</b>
    <table class="table">
        @foreach ($list_catatan as $catatan)
            <tr>
                <td colspan="6" style="border:#000 1px solid">
                    {{ $catatan->catatan }}
                </td>
            </tr>
        @endforeach
    </table>
    <br>
    <b>H. TANGGAPAN ORANGTUA/WALI</b>
    <table style="border-collapse:  collapse; border:#000 1px solid" width="100%">
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
        </tbody>
    </table>
    @if ($semester = 2)
        <p>
            <b>Keputusan</b> berdasarkan pencapaian kompetensi pada semester ke-1 dan ke-2, peserta didik ditetapkan *)
        </p>
        <p>Naik Kelas <br>
            Tinggal Kelas <br>
            *) Coret yang tidak perlu</p>
    @endif
    <table width="100%">
        <tr>
            <td width="5%"></td>
            <td width="20%">
                Mengetahui : <br><br>
                Orang Tua/Wali, <br>
                <br><br><br><br>
                <u>..........................</u>
            </td>
            <td width="15%"></td>
            <td width="25%">
                <br>
                <br>
                Wali Kelas <br>
                <br><br><br><br>
                <u><b>Wali Kelas</b></u><br>
                NIP. -
            </td>
            <td width="5%"></td>
            <td width="30%">
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
    <div class="footer">
        {{ $nama_siswa }}
    </div>
</body>
</html>
