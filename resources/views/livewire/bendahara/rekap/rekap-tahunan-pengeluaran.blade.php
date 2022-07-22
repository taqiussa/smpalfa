<div>
    <x-slot name="header">
        <h4>Pengeluaran Tahunan</h4>
    </x-slot>
    <div class="row my-2">
        <div class="col-md-6">
            <x-card>
                <div class="row my-2">
                    <div class="col-md-6">
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
                    <span wire:loading wire:target="tahun">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                </div>
                <div>
                    <a href="{{ route('bendahara.rekap-pengeluaran.rekap-tahunan-pengeluaran-print',
                    [
                        'tahun' => $tahun
                    ]) }}" target="__blank" class="btn btn-success mx-2 my-2" role="button">
                    <i class="fas fa-file-alt"></i> Print Versi Detail</a>
                    <a href="{{ route('bendahara.rekap-pengeluaran.rekap-tahunan-pengeluaran-print-simple',
                    [
                        'tahun' => $tahun
                    ]) }}" target="__blank" class="btn btn-danger mx-2 my-2" role="button">
                    <i class="fas fa-file-alt"></i> Print Versi Simple</a>
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
                                <th>Tanggal Nota</th>
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
                                    <td>{{ date('d M Y', strtotime($pengeluaran->tanggal_nota)) }}</td>
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
