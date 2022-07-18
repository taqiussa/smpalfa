<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Penilaian Alquran</title>
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
    @foreach ($list_siswa as $siswa)
        <div style="page-break-before: always"></div>
        <table align="center"
            style="border-bottom: 5px solid #000; padding:5px; text-align:center;line-height:5px;width:100%">
            <tbody>
                <tr>
                    <td tyle="text-align: left"><img src="{{ asset('images/logoalfahp.png') }}" alt="logo"
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
            <h4>LAPORAN PENILAIAN AL QUR'AN</h4>
            <div style="display: flex;justify-content:space-between">
                <span>Nama : {{ $siswa->name }}</span>
                <span>Kelas : {{ $kelas }}</span>
                <span>Tahun : {{ $tahun }}</span>
            </div>
        </div>
        <div style="display:flex;justify-content:space-around">
        <b>Bilghoib</b>
        <b>Binnadzor</b>
        </div>
        <div style="display: flex; flex-direction:row;">
            <table border="1" style="width: 100%;border-collapse:collapse;margin:5px">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Surah</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list_bilghoib as $bilghoib)
                        <tr>
                            <td align="center">{{ $loop->iteration }}</td>
                            <td style="text-align: left;padding-left:10px;">{{ $bilghoib->nama }}</td>
                            <td align="center">
                                @php
                                    $nilai = App\Models\PenilaianAlquran::where('nis', $siswa->nis)
                                    ->where('jenis_alquran_id', $bilghoib->id)
                                    ->value('nilai')
                                @endphp
                                {{ $nilai }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <table border="1" style="width: 100%;border-collapse:collapse;margin:5px">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Juz</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list_binnadzor as $binnadzor)
                        <tr>
                            <td align="center">{{ $loop->iteration }}</td>
                            <td style="text-align: left;padding-left:10px;">{{ $binnadzor->nama }}</td>
                            <td align="center">
                                @php
                                    $nilai = App\Models\PenilaianAlquran::where('nis', $siswa->nis)
                                    ->where('jenis_alquran_id', $binnadzor->id)
                                    ->value('nilai')
                                @endphp
                                {{ $nilai }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <table align="right">
            <tr>
                <td><b>Kendal, {{ Carbon\Carbon::parse(gmdate('Y-m-d'))->translatedFormat('d F Y') }}</b></td>
            </tr>
            <tr>
                <td style="text-align: center"><b>Guru Al Qur'an</b></td>
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
            <tr>
                <td style="text-align: center"><b>{{ auth()->user()->name }}</b></td>
            </tr>
        </table>
    @endforeach
</body>

</html>
