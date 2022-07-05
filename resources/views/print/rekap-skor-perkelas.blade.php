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
                </tr>
                {{-- <tr>
                    <td>Tahun</td>
                    <td>:</td>
                    <td>{{ $tahun }}</td>
                    <td>Semester</td>
                    <td>:</td>
                    <td>Semester</td>
                </tr> --}}
            </thead>
        </table>
        <table style="width: 100%;border:#000 solid 1px;border-collapse:collapse">
            <thead>
                @php
                    
                @endphp
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
                <tr>
                    <td style="border:#000 solid 1px;padding-left:10px;">1</td>
                    <td style="border:#000 solid 1px;padding-left:10px;">2 Juli</td>
                    <td style="border:#000 solid 1px;padding-left:10px;">Siswa</td>
                    <td style="border:#000 solid 1px;padding-left:10px;">Keterangan</td>
                    <td style="border:#000 solid 1px;text-align:center;">Nilai Skor</td>
                    <td style="border:#000 solid 1px;padding-left:10px;">Oleh Guru</td>
                </tr>
            </tbody>
        </table>
    @endforeach
</body>

</html>
