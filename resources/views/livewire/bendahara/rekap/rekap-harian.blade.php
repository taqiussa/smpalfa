<div>
    <x-slot name="header">
        <h4>Pemasukan Harian</h4>
    </x-slot>
    <div class="row my-2">
        <div class="col-md-6">
            <x-card>
                <div class="row my-2">
                    <div class="col-md-6">
                        <label for="tanggalawal" class="form-label">Tanggal Awal</label>
                        <input wire:model="tanggalawal" type="date" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="tanggalakhir" class="form-label">Tanggal Akhir</label>
                        <input wire:model="tanggalakhir" type="date" class="form-control">
                    </div>
                </div>
                <div>
                    <span wire:loading wire:target="tanggalawal">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                    <span wire:loading wire:target="tanggalakhir">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('bendahara.rekap-pemasukan.rekap-harian-pemasukan-print',[
                        'tanggalawal' => $tanggalawal,
                        'tanggalakhir' => $tanggalakhir
                    ]) }}" target="__blank" class="btn btn-success mx-2 my-2"><i class="fas fa-file-alt"></i> Print Versi Detail</a>
                    <a href="{{ route('bendahara.rekap-pemasukan.rekap-harian-pemasukan-print-simple',[
                        'tanggalawal' => $tanggalawal,
                        'tanggalakhir' => $tanggalakhir
                    ]) }}" target="__blank" class="btn btn-danger mx-2 my-2"><i class="fas fa-file-alt"></i> Print Versi Simple</a>
                </div>
            </x-card>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-12">
            <x-card>
                <h4>Rekap Pembayaran Siswa</h4>
                <div class="table-responsive my-2">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Siswa</th>
                                <th>Kelas</th>
                                <th>Gunabayar</th>
                                <th>Tahun</th>
                                <th>Bendahara</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_pembayaran as $pembayaran)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date('d M Y', strtotime($pembayaran->tanggal)) }}</td>
                                    <td>{{ $pembayaran->siswa->name }}</td>
                                    <td>{{ $pembayaran->kelas->nama }}</td>
                                    <td>{{ $pembayaran->gunabayar->nama }}</td>
                                    <td>{{ $pembayaran->tahun }}</td>
                                    <td>{{ $pembayaran->bendahara->name }}</td>
                                    <td>{{ 'Rp ' . number_format($pembayaran->jumlah, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="6" style="font-weight: bold">Subtotal</td>
                                <td colspan="2" style="font-weight: bold;text-align:right">
                                    {{ 'Rp ' . number_format($subtotal_pembayaran, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    {{ $list_pembayaran->links() }}
                </div>
            </x-card>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-12">
            <x-card>
                <h4>Rekap Pemasukan</h4>
                <div class="table-responsive my-2">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Kategori Pemasukan</th>
                                <th>Keterangan</th>
                                <th>Bendahara</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_pemasukan as $pemasukan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date('d M Y', strtotime($pemasukan->tanggal)) }}</td>
                                    <td>{{ $pemasukan->kategori->nama }}</td>
                                    <td>{{ $pemasukan->keterangan }}</td>
                                    <td>{{ $pemasukan->user->name }}</td>
                                    <td>{{ 'Rp ' . number_format($pemasukan->jumlah, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" style="font-weight: bold">Subtotal</td>
                                <td colspan="2" style="font-weight: bold;text-align:right">
                                    {{ 'Rp ' . number_format($subtotal_pemasukan, 0, ',', '.') }}
                                </td>
                            </tr>
                            <tr class="text-success fs-5">
                                <td colspan="4" style="font-weight: bold">Total</td>
                                <td colspan="2" style="font-weight: bold;text-align:right">{{ 'Rp ' . number_format($total, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    {{ $list_pemasukan->links() }}
                </div>
            </x-card>
        </div>
    </div>
</div>
