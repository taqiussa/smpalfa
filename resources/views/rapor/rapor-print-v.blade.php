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

        .my-table {
            border: 1px solid black;
            border-collapse: collapse;
            color: #222222;
            /* font-family: 'Times New Roman', Times, serif;
            font-size: 12pt; */
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
    <table class="my-table" style="width: 100%">
        <thead style="border: 1px solid #000;">
            <tr class="text-center">
                <td style="border: 1px solid #000;width:3%" class="align-middle" rowspan="2">No</td>
                <td style="border: 1px solid #000;width:20%" class="align-middle" rowspan="2">Mata
                    Pelajaran</td>
                <td style="border: 1px solid #000;width:4%" class="align-middle"rowspan="2">KBM</td>
                <td style="border: 1px solid #000;" colspan="3">Pengetahuan</td>
                <td style="border: 1px solid #000;" colspan="3">Keterampilan</td>
            </tr>
            <tr class="text-center">
                <td style="border: 1px solid #000;width:4%">Nilai</td>
                <td style="border: 1px solid #000;width:6%">Predikat</td>
                <td style="border: 1px solid #000;">Deskripsi</td>
                <td style="border: 1px solid #000;width:4%">Nilai</td>
                <td style="border: 1px solid #000;width:6%">Predikat</td>
                <td style="border: 1px solid #000;">Deskripsi</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="3">
                    <table style="border: #000 1px solid;width: 100%">
                        @foreach ($list_mapela as $mapela)
                            <tr>
                                <td style="border: #000 1px solid;width: 10%" class="text-center">
                                    {{ $loop->iteration }}</td>
                                <td style="border: #000 1px solid; padding-left: 5px">{{ $mapela->nama }}</td>
                                <td style="border: #000 1px solid;width:15%" class="text-center">{{ $mapela->kkm }}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </td>
                <td colspan="3">
                    <table style="border: #000 1px solid;width:100%">
                        @foreach ($nilai_a as $nilai)
                            @if ($nilai->nilai > 90)
                                @php
                                    $predikat = 'A';
                                    $nama_predikat = 'Sangat Baik';
                                @endphp
                            @elseif ($nilai->nilai > 80)
                                @php
                                    $predikat = 'B';
                                    $nama_predikat = 'Baik';
                                @endphp
                            @elseif ($nilai->nilai > 70)
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
                                <td style="border: #000 1px solid; width: 10.8%" class="text-center">
                                    {{ $nilai->nilai }}</td>
                                <td style="border: #000 1px solid; width: 16.8%" class="text-center">
                                    {{ $predikat }}</td>
                                <td style="border: #000 1px solid;" class="text-center">
                                    @php
                                        $list_kd = App\Models\Kd::where('mata_pelajaran_id', $nilai->id)
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
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <div style="page-break-before: always"></div>
</body>

</html>
