<div>
    <div class="row my-2">
        <div class="col-md-4">
            <x-card>
                <div class="row my-2">
                    <div class="col-md-8">
                        <label for="tahun" class="form-label">Tahun</label>
                        <select wire:model='tahun' id="tahun" class="form-select">
                            <option value="">Pilih Tahun</option>
                            @for ($i = 2017; $i < gmdate('Y'); $i++)
                                <option value="{{ $i + 1 . ' / ' . ($i + 2) }}">{{ $i + 1 . ' / ' . ($i + 2) }}
                                </option>
                            @endfor
                        </select>
                        @error('tahun')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div>
                    <a href="{{ route('bendahara.kas.kas-tahunan-print',
                    [
                        'tahun' => $tahun
                    ]) }}" target="__blank" class="btn btn-success" role="button"><i class="fas fa-file-alt"></i> Print</a>
                </div>
            </x-card>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-6">
            <x-card>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kategori Pemasukan</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>SPP</td>
                                <td>{{ 'Rp ' . number_format($total_pembayaran, 0, ',', '.') }}</td>
                            </tr>
                            @foreach ($list_kategori_pemasukan as $key => $kategori)
                                <tr>
                                    <td>{{ $loop->iteration + 1 }}</td>
                                    <td>{{ $kategori->nama }}</td>
                                    <td>{{ 'Rp ' . number_format($subtotal_pemasukan[$key], 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-card>
        </div>
        <div class="col-md-6">
            <x-card>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kategori Pengeluaran</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_kategori_pengeluaran as $key => $kategori)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kategori->nama }}</td>
                                    <td>{{ 'Rp ' . number_format($subtotal_pengeluaran[$key], 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-card>
        </div>
    </div>
    <div class="row my-2">
        <div class="col">
            <x-card>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Total Pemasukan Tahun {{ $tahun }}</th>
                                <th>{{ 'Rp ' . number_format($total_pemasukan, 0, ',', '.') }}</th>
                            </tr>
                            <tr>
                                <th>Total Pengeluaran Tahun {{ $tahun }}</th>
                                <th>{{ 'Rp ' . number_format($total_pengeluaran, 0, ',', '.') }}</th>
                            </tr>
                            <tr>
                                <th>Saldo Akhir Tahun {{ $tahun }}</th>
                                <th>{{ 'Rp ' . number_format($saldo, 0, ',', '.') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </x-card>
        </div>
    </div>
</div>
