<div>
    <x-slot name="header">
        <h4>Pemasukan Tahunan</h4>
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
                <div class="d-flex justify-content-end">
                    <a href="{{ route('bendahara.rekap-pemasukan.rekap-tahunan-pemasukan-print',
                    [
                        'tahun' => $tahun
                    ]) }}" target="__blank" class="btn btn-success mx-2 my-2" role="button">
                    <i class="fas fa-file-alt"></i>
                        Print Versi Detail
                    </a>
                    <a href="{{ route('bendahara.rekap-pemasukan.rekap-tahunan-pemasukan-print-simple',
                    [
                        'tahun' => $tahun
                    ]) }}" target="__blank" class="btn btn-danger mx-2 my-2" role="button">
                    <i class="fas fa-file-alt"></i>
                        Print Versi Simple
                    </a>
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
                                    <td>{{ $pembayaran->siswa }}</td>
                                    <td>{{ $pembayaran->kelas }}</td>
                                    <td>{{ $pembayaran->gunabayar }}</td>
                                    <td>{{ $pembayaran->tahun }}</td>
                                    <td>{{ $pembayaran->bendahara }}</td>
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
                                    <td>{{ $pemasukan->kategori }}</td>
                                    <td>{{ $pemasukan->keterangan }}</td>
                                    <td>{{ $pemasukan->bendahara }}</td>
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
                                <td colspan="2" style="font-weight: bold;text-align:right">
                                    {{ 'Rp ' . number_format($total, 0, ',', '.') }}</td>
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
