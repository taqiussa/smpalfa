<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tagihan Administrasi Kelas</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif !important;
            font-size: 9pt;
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
    <div style="text-align: center; border-bottom:solid 1px #000;">
        <span style="font-weight: bold">TAGIHAN ADMINISTRASI SISWA TAHUN AJARAN {{ $tahun }}</span
            style="font-weight: bold">
    </div>
    <table align="left">
        <tr>
            <td>Kelas</td>
            <td>:</td>
            <td>{{ $nama_kelas }}</td>
        </tr>
    </table>
    <table align="right" style="margin-right: 30px">
        <tr>
            <td>Wali Kelas</td>
            <td>:</td>
            <td>
                @foreach ($wali_kelas as $wali)
                    {{ $wali->guru->name }}
                @endforeach
            </td>
        </tr>
    </table>
    <table border="1" style="width:100%;border-collapse:collapse;">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                @foreach ($list_gunabayar as $gunabayar)
                    <th>{{ $gunabayar->nama }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($list_siswa as $siswa)
                <tr style="word-wrap:break-word;">
                    <td style="text-align: center">{{ $loop->iteration }}</td>
                    <td style="padding-left: 8px">{{ $siswa->user->name }}</td>
                    @foreach ($list_gunabayar as $key => $gunabayar)
                        <td style="padding-left:5px">
                            @php
                                $jumlah = App\Models\Pembayaran::where('tahun', $tahun)
                                    ->where('gunabayar_id', $gunabayar->id)
                                    ->where('nis', $siswa->nis)
                                    ->value('jumlah');
                            @endphp
                            {{ 'Rp ' . number_format($jumlah, 0, ',', '.') }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="padding:10px"></div>
    <table align="right" style="margin-right: 30px;text-align:center">
        <tr>
            <td style="text-align:center">
                Ngampel, {{ Carbon\Carbon::parse(gmdate('Y-m-d'))->translatedFormat('d F Y') }}
            </td>
        </tr>
        <tr>
            <td style="text-align:center">Bendahara</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align:center">
                <b>
                    {{ auth()->user()->name }}
                </b>
            </td>
        </tr>
    </table>
</body>

</html>
