<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print KAS Bulanan</title>
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
        <h4>Laporan KAS</h4>
        <h4>Bulan {{ Carbon\Carbon::parse(date('Y-m-d',mktime(0,0,0,$bulan,1,2000)))->translatedFormat('F') }} Tahun {{ $tahun }}</h4>
    </div>
    <div style="display: flex;justify-content:space-evenly">
        <h3>Pemasukan</h3>
        <h3>Pengeluaran</h3>
    </div>
    <div style="display: flex; flex-direction:row;">
        <table border="1" style="width:100%;border-collapse: collapse;margin:5px">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kategori Pemasukan</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align="center">1</td>
                    <td align="left" style="padding-left: 5px">Pembayaran SPP Siswa</td>
                    <td align="right" style="padding-left: 5px;padding-right: 5px">
                        {{ 'Rp ' . number_format($subtotal_pembayaran, 0, ',', '.') }}
                    </td>
                </tr>
                @foreach ($list_kategori_pemasukan as $key => $kategori)
                    <tr align="center">
                        <td>{{ $loop->iteration + 1 }}</td>
                        <td align="left" style="padding-left: 5px">{{ $kategori->nama }}</td>
                        <td align="right" style="padding-left: 5px;padding-right: 5px">
                            @php
                                $subtotal_pemasukan = App\Models\Pemasukan::where('tahun', $tahun)
                                    ->whereMonth('tanggal', $bulan)
                                    ->where('kategori_pemasukan_id', $kategori->id)
                                    ->sum('jumlah');
                            @endphp
                            {{ 'Rp ' . number_format($subtotal_pemasukan, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2" style="padding: 5px">
                        <h3>Total Pemasukan</h3>
                    </td>
                    <td align="right" style="padding: 5px">
                        <h3>{{ 'Rp ' . number_format($totalpemasukan, 0, ',', '.') }}</h3>
                    </td>
                </tr>
            </tbody>
        </table>
        <table border="1" style="width:100%;border-collapse: collapse;margin:5px">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kategori Pengeluaran</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list_kategori_pengeluaran as $key => $kategori)
                    <tr align="center">
                        <td>{{ $loop->iteration }}</td>
                        <td align="left" style="padding-left: 5px">{{ $kategori->nama }}</td>
                        <td align="right" style="padding-left: 5px;padding-right: 5px">
                            @php
                                $subtotal_pengeluaran = App\Models\Pengeluaran::where('tahun', $tahun)
                                    ->whereMonth('tanggal', $bulan)
                                    ->where('kategori_pengeluaran_id', $kategori->id)
                                    ->sum('jumlah');
                            @endphp
                            {{ 'Rp ' . number_format($subtotal_pengeluaran, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2" style="padding: 5px">
                        <h3>Total Pengeluaran</h3>
                    </td>
                    <td align="right" style="padding: 5px">
                        <h3>{{ 'Rp ' . number_format($totalpengeluaran, 0, ',', '.') }}</h3>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <table border="1" style="width: 100%; border-collapse:collapse">
        <thead>
            <tr>
                <th>Total Pemasukan Bulan {{ Carbon\Carbon::parse(date('Y-m-d',mktime(0,0,0,$bulan,1,2000)))->translatedFormat('F') }} Tahun {{ $tahun }}</th>
                <th>{{ 'Rp ' . number_format($totalpemasukan, 0, ',', '.') }}</th>
            </tr>
            <tr>
                <th>Total Pengeluaran Bulan {{ Carbon\Carbon::parse(date('Y-m-d',mktime(0,0,0,$bulan,1,2000)))->translatedFormat('F') }} Tahun {{ $tahun }}</th>
                <th>{{ 'Rp ' . number_format($totalpengeluaran, 0, ',', '.') }}</th>
            </tr>
            <tr>
                <th>Saldo Akhir Bulan {{ Carbon\Carbon::parse(date('Y-m-d',mktime(0,0,0,$bulan,1,2000)))->translatedFormat('F') }} Tahun {{ $tahun }}</th>
                <th>{{ 'Rp ' . number_format($saldo, 0, ',', '.') }}</th>
            </tr>
        </thead>
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
            <td style="text-align:center">Kepala SMP Al Musyaffa'</td>
            <td style="width: 35%"></td>
            <td style="text-align:center">Bendahara</td>
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
                    {{ auth()->user()->name }}
                </b>
            </td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:center">Mengetahui :</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:center">Ketua Yayasan Al Musyaffa'</td>
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
            <td colspan="3" style="text-align:center">
                <b>
                    KH. Muchlis Musyaffa'
                </b>
            </td>
        </tr>
    </table>
</body>

</html>
