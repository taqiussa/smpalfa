<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Laporan Tahunan</title>
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
        <h4>LAPORAN PER TAHUN PEMASUKAN SEKOLAH (VERSI SIMPLE)</h4>
        <h4>TAHUN {{ $tahun }}</h4>
    </div>
    <h4>Pemasukan</h4>
    <table border="1" style="width:100%;border-collapse: collapse;">
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
            @foreach ($list_kategori as $key => $kategori)
                <tr align="center">
                    <td>{{ $loop->iteration + 1 }}</td>
                    <td align="left" style="padding-left: 5px">{{ $kategori->nama }}</td>
                    <td align="right" style="padding-left: 5px;padding-right: 5px">
                        @php
                            $subtotal_pemasukan = App\Models\Pemasukan::where('tahun', $tahun)
                            ->where('kategori_pemasukan_id', $kategori->id)
                            ->sum('jumlah')
                        @endphp
                        {{ 'Rp ' . number_format($subtotal_pemasukan, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2" style="padding: 5px"><h3>Total</h3></td>
                <td align="right" style="padding: 5px">
                    <h3>{{ 'Rp ' . number_format($total, 0, ',', '.') }}</h3></td>
            </tr>
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
