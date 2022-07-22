<div>
    <x-slot name="header">
        <h4>Kas Bulanan</h4>
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
                    <div class="col-md-6">
                        <label for="bulan" class="form-label">Bulan</label>
                        <select wire:model="bulan" id="bulan" class="form-select">
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                </div>
                <div>
                    <span wire:loading wire:target="tahun">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                    <span wire:loading wire:target="bulan">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                </div>
                <div>
                    <a href="{{ route('bendahara.kas.kas-bulanan-print', [
                        'tahun' => $tahun,
                        'bulan' => $bulan,
                    ]) }}"
                        target="__blank" class="btn btn-success" role="button"><i class="fas fa-file-alt"></i>
                        Print</a>
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
                            @foreach ($list_pemasukan as $pemasukan)
                                <tr>
                                    <td>{{ $loop->iteration + 1 }}</td>
                                    <td>{{ $pemasukan->kategori->nama }}</td>
                                    <td>{{ 'Rp ' . number_format($pemasukan->jumlah, 0, ',', '.') }}</td>
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
                            @foreach ($list_pengeluaran as $pengeluaran)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pengeluaran->kategori->nama }}</td>
                                <td>{{ 'Rp ' . number_format($pengeluaran->jumlah, 0, ',', '.') }}</td>
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
                                <th>Total Pemasukan Bulan
                                    {{ Carbon\Carbon::parse(date('Y-m-d', mktime(0, 0, 0, $bulan, 1, 2000)))->translatedFormat('F') }}
                                    Tahun {{ $tahun }}</th>
                                <th>{{ 'Rp ' . number_format($total_pemasukan, 0, ',', '.') }}</th>
                            </tr>
                            <tr>
                                <th>Total Pengeluaran Bulan
                                    {{ Carbon\Carbon::parse(date('Y-m-d', mktime(0, 0, 0, $bulan, 1, 2000)))->translatedFormat('F') }}
                                    Tahun {{ $tahun }}</th>
                                <th>{{ 'Rp ' . number_format($total_pengeluaran, 0, ',', '.') }}</th>
                            </tr>
                            <tr>
                                <th>Saldo Akhir Bulan
                                    {{ Carbon\Carbon::parse(date('Y-m-d', mktime(0, 0, 0, $bulan, 1, 2000)))->translatedFormat('F') }}
                                    Tahun {{ $tahun }}</th>
                                <th>{{ 'Rp ' . number_format($saldo, 0, ',', '.') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </x-card>
        </div>
    </div>
</div>
