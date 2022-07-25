<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Skor Kelas</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
        }
    </style>
</head>

<body>
    @foreach ($list_siswa as $siswa)
        <div style="page-break-before: always"></div>
        <table align="center"
            style="border-bottom: 5px solid #000; padding:5px; text-align:center;line-height:5px;width:100%">
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
            <h4>LAPORAN PERHITUNGAN SKOR SISWA</h4>
        </div>
        <table align="center">
            <thead>
                @php
                    $total_Skor = App\Models\PenilaianSkor::where('nis', $siswa->nis)
                        ->where('tahun', $tahun)
                        ->sum('skor');
                @endphp
                <tr>
                    <td>Nama</td>
                    <td width="1%">:</td>
                    <td>{{ $siswa->name }}</td>
                    <td>Kelas</td>
                    <td width="1%">:</td>
                    <td>{{ $nama_kelas }}</td>
                    <td>Tahun</td>
                    <td width="1%">:</td>
                    <td>{{ $tahun }}</td>
                    <td>Total Skor</td>
                    <td width="1%">:</td>
                    <td>
                        @php
                            $hitung_skor = App\Models\PenilaianSkor::where('nis', $siswa->nis)
                                ->where('tahun', $tahun)
                                ->sum('skor');
                            $total_skor = $hitung_skor;
                        @endphp
                        {{ $total_skor }}
                    </td>
                </tr>
            </thead>
        </table>
        <table style="width: 100%;border:#000 solid 1px;border-collapse:collapse">
            <thead>
                <tr>
                    <th style="border:#000 solid 1px;">#</th>
                    <th style="border:#000 solid 1px;">Tanggal</th>
                    <th style="border:#000 solid 1px;">Nama</th>
                    <th style="border:#000 solid 1px;">Keterangan</th>
                    <th style="border:#000 solid 1px;">Skor</th>
                    <th style="border:#000 solid 1px;">Guru</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $list_skor = App\Models\PenilaianSkor::with('skors')
                        ->where('penilaian_skors.nis', $siswa->nis)
                        ->where('penilaian_skors.tahun', $tahun)
                        ->join('users', 'users.id', '=', 'penilaian_skors.user_id')
                        ->select('users.name as nama_guru', 'penilaian_skors.tanggal as tanggal', 'penilaian_skors.skor_id as skor_id', 'penilaian_skors.skor as skor')
                        ->orderBy('penilaian_skors.created_at')
                        ->get();
                @endphp
                @foreach ($list_skor as $skor)
                    <tr>
                        <td style="border:#000 solid 1px;padding-left:10px;">{{ $loop->iteration }}</td>
                        <td style="border:#000 solid 1px;padding-left:10px;">
                            {{ date('d M Y', strtotime($skor->tanggal)) }}</td>
                        <td style="border:#000 solid 1px;padding-left:10px;">{{ $siswa->name }}</td>
                        <td style="border:#000 solid 1px;padding-left:10px;">{{ $skor->skors->keterangan }}</td>
                        <td style="border:#000 solid 1px;text-align:center;">{{ $skor->skor }}</td>
                        <td style="border:#000 solid 1px;padding-left:10px;">{{ $skor->nama_guru }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br><br>
        <table style="padding-left: 25px;text-align:center" width="100%">
            <tr>
                <td colspan="2"></td>
                <td style="text-align:center">
                    Ngampel, {{ Carbon\Carbon::parse(gmdate('Y-m-d'))->translatedFormat('d F Y') }}
                </td>
            </tr>
            <tr>
                <td style="text-align:center">Waka.Ur Kesiswaan I</td>
                <td style="width: 35%"></td>
                <td style="text-align:center">Guru BK</td>
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
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align:center">Mengetahui :</td>
            </tr>
            <tr>
                <td style="text-align:center">Kepala SMP Al Musyaffa'</td>
                <td style="width: 35%"></td>
                <td style="text-align:center">Waka.Ur Kesiswaan II</td>
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
                        {{ $kepala_sekolah[0]->name }}
                    </b>
                </td>
                <td></td>
                <td style="text-align:center">
                    <b>
                        {{ $kesiswaan[1]->name }}
                    </b>
                </td>
            </tr>
        </table>
    @endforeach
</body>

</html>
