<div>
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
            </x-card>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-12">
            <x-card>
                <h4>Rekap Pengeluaran</h4>
                <div class="table-responsive my-2">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Kategori Pengeluaran</th>
                                <th>Keterangan</th>
                                <th>Bendahara</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_pengeluaran as $pengeluaran)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date('d M Y', strtotime($pengeluaran->tanggal)) }}</td>
                                    <td>{{ $pengeluaran->kategori }}</td>
                                    <td>{{ $pengeluaran->keterangan }}</td>
                                    <td>{{ $pengeluaran->bendahara }}</td>
                                    <td>{{ 'Rp ' . number_format($pengeluaran->jumlah, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                            <tr class="text-success fs-5">
                                <td colspan="4" style="font-weight: bold">Total</td>
                                <td colspan="2" style="font-weight: bold;text-align:right">{{ 'Rp ' . number_format($total, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </x-card>
        </div>
    </div>
</div>
