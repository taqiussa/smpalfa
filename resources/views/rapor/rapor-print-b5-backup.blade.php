<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RAPOR</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <style type="text/css">
        body {
            font-family: 'Times New Roman', Times, serif !important;
            font-size: 12pt;
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
    <div class="text-center border border-5 border-top-0 border-end-0 border-start-0">
        <h4>PENCAPAIAN KOMPETENSI AKADEMIK PESERTA DIDIK</h4>
        <h4>TAHUN PELAJARAN {{ $tahun }}</h4>
    </div>
    </div>
    <table class="table table-borderless">
        <tbody>
            <tr>
                <td>Nama Sekolah</td>
                <td>:</td>
                <td>SMP Al Musyaffa Kendal</td>
                <td>Kelas</td>
                <td>:</td>
                <td>{{ $nama_kelas }}</td>
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
                <td>NIS / NISN</td>
                <td>:</td>
                <td>{{ $nis }} / {{ $nisn }}</td>
                <td colspan="3"></td>
            </tr>
        </tbody>
    </table>
    <h5>A. SIKAP</h5>
    <br>
    <h6>1. Sikap Spiritual</h6>
    <table class="table table-bordered border-dark">
        <thead>
            <tr>
                <th style="width: 15%">Predikat</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $spiritual }}</td>
                <td class="text-justify">
                    Terbiasa berdoa sebelum dan sesudah melakukan kegiatan, memelihara hubungan baik dengan sesama umat
                    Ciptaan Tuhan Yang Maha Esa, dan bersyukur kepada Tuhan Yang Maha Esa sebagai bangsa Indonesia
                </td>
            </tr>
        </tbody>
    </table>
    <h6>2. Sikap Sosial</h6>
    <table class="table table-bordered border-dark">
        <thead>
            <tr>
                <th style="width: 15%">Predikat</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $sosial }}</td>
                <td class="text-justify">
                    Terbiasa melaksanakan sikap jujur, disiplin, tanggung jawab, santun, percaya diri, peduli, dan
                    toleransi
                </td>
            </tr>
        </tbody>
    </table>
    <h5>B. PENGETAHUAN</h5>
    <table class="table table-bordered border-dark">
        <thead>
            <tr class="text-center">
                <td style="width: 5%;">No</td>
                <td style="width: 25%;">Mata Pelajaran</td>
                <td style="width: 8%;">KBM</td>
                <td style="width: 8%;">Nilai</td>
                <td style="width: 8%;">Predikat</td>
                <td style="width: 46%;">Deskripsi</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="6">Kelompok A</td>
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
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $mapel->nama }}</td>
                    <td class="text-center">{{ $mapel->kkm }}</td>
                    <td class="text-center">{{ $mapel->nilai }}</td>
                    <td class="text-center">
                        {{ $predikat }}
                    </td>
                    <td class="text-justify">
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
                <td colspan="6">Kelompok B</td>
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
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $mapel->nama }}</td>
                    <td class="text-center">{{ $mapel->kkm }}</td>
                    <td class="text-center">{{ $mapel->nilai }}</td>
                    <td class="text-center">
                        {{ $predikat }}
                    </td>
                    <td class="text-justify">
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
                <td colspan="6">Kelompok C</td>
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
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $mapel->nama }}</td>
                    <td class="text-center">{{ $mapel->kkm }}</td>
                    <td class="text-center">{{ $mapel->nilai }}</td>
                    <td class="text-center">
                        {{ $predikat }}
                    </td>
                    <td class="text-justify">
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
    <div style="page-break-before: always"></div>
    <h6>C. KETERAMPILAN</h6>
    <table class="table table-bordered border-dark">
        <thead>
            <tr class="text-center">
                <td style="width: 5%;">No</td>
                <td style="width: 25%;">Mata Pelajaran</td>
                <td style="width: 8%;">KBM</td>
                <td style="width: 8%;">Nilai</td>
                <td style="width: 8%;">Predikat</td>
                <td style="width: 46%;">Deskripsi</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="6">Kelompok A</td>
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
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $mapel->nama }}</td>
                    <td class="text-center">{{ $mapel->kkm }}</td>
                    <td class="text-center">{{ $mapel->nilai }}</td>
                    <td class="text-center">
                        {{ $predikat }}
                    </td>
                    <td class="text-justify">
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
                <td colspan="6">Kelompok B</td>
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
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $mapel->nama }}</td>
                    <td class="text-center">{{ $mapel->kkm }}</td>
                    <td class="text-center">{{ $mapel->nilai }}</td>
                    <td class="text-center">
                        {{ $predikat }}
                    </td>
                    <td class="text-justify">
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
                <td colspan="6">Kelompok C</td>
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
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $mapel->nama }}</td>
                    <td class="text-center">{{ $mapel->kkm }}</td>
                    <td class="text-center">{{ $mapel->nilai }}</td>
                    <td class="text-center">
                        {{ $predikat }}
                    </td>
                    <td class="text-justify">
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
    <div style="page-break-before: always;"></div>
    <h6>D. EKSTRAKURIKULER</h6>
    <table class="table table-bordered border-dark">
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 30%">Nama Kegiatan</th>
                <th style="width: 10%">Nilai</th>
                <th style="width: 55%">Keterangan</th>
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
    <h6>E. KETIDAKHADIRAN</h6>
    <table class="table table-bordered border-dark">
        <tbody>
            <t6>
                <td style="width: 60%">Sakit</td>
                <td style="width: 40%" class="text-center"> {{ $sakit }} hari</td>
            </t6>
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
    <h6>F. PRESTASI</h6>
    <table class="table table-bordered border-dark">
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 40%">Jenis Prestasi</th>
                <th style="width: 55%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list_prestasi as $prestasi)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-justify">{{ $prestasi->prestasi }}</th>
                    <td class="text-justify">{{ $prestasi->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h6>G. CATATAN WALIKELAS</h6>
    <table class="table table-bordered border-dark">
        @foreach ($list_catatan as $catatan)
            <tr>
                <td colspan="6" style="border:#000 1px solid">
                    {{ $catatan->catatan }}
                </td>
            </tr>
        @endforeach
    </table>
    <h6>H. TANGGAPAN ORANGTUA/WALI</h6>
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
    <br>
    @if ($semester = 2)
        <p>
            <b>Keputusan</b> berdasarkan pencapaian kompetensi pada semester ke-1 dan ke-2, peserta didik ditetapkan *)
        </p>
        <p>Naik Kelas <br>
            Tinggal Kelas <br>
            *) Coret yang tidak perlu</p>
    @endif
    <br>
    <table class="table table-borderless">
        <tr>
            <td style="width: 5%"></td>
            <td style="width: 20%">
                Mengetahui : <br><br>
                Orang Tua/Wali, <br>
                <br><br><br><br>
                <u>..........................</u>
            </td>
            <td style="width: 15%"></td>
            <td style="width: 25%">
                <br>
                <br>
                Wali Kelas <br>
                <br><br><br><br>
                <u><b>Wali Kelas</b></u><br>
                NIP. -
            </td>
            <td style="width: 5%"></td>
            <td style="width: 30%">
                Ngampel, {{ Carbon\Carbon::parse($tanggal_rapor)->translatedFormat('d F Y') }} <br><br>
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
