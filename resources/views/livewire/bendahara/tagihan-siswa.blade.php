<div>
    <x-slot name="header">
        <h4>Tagihan Siswa</h4>
    </x-slot>
    <div class="row my-2">
        <div class="col">
            <x-card>
                <div class="row my-2">
                    <div class="col-md-4">
                        <label for="tahun" class="form-label">Tahun</label>
                        <select wire:model='tahun' id="tahun" class="form-select">
                            <option value="">Pilih Tahun</option>
                            @for ($i = 2017; $i < gmdate('Y'); $i++)
                                <option value="{{ $i + 1 . ' / ' . ($i + 2) }}">{{ $i + 1 . ' / ' . ($i + 2) }}</option>
                            @endfor
                        </select>
                        @error('tahun')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select wire:model='kelas' id="kelas" class="form-select">
                            <option value="">Pilih Kelas</option>
                            @foreach ($list_kelas as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                            @endforeach
                        </select>
                        @error('kelas')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="my-2">
                    <span wire:loading wire:target="tahun">Memuat Data ... <i class="fas fa-spinner fa-spin"></i></span>
                    <span wire:loading wire:target="kelas">Memuat Data ... <i class="fas fa-spinner fa-spin"></i></span>
                </div>
                <div class="my-2">
                    <a href="{{ route('bendahara.tagihan-siswa-print',
                    [
                        'tahun' => $tahun,
                        'kelas' => $id_kelas
                    ]) }}" target="__blank" class="btn btn-success" role="button"><i class="fas fa-file-alt"></i> Print</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-nowrap">
                                <th>#</th>
                                <th>Nama</th>
                                @foreach ($list_gunabayar as $gunabayar)
                                    <th>{{ $gunabayar->nama }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_siswa as $key => $siswa)
                                <tr class="text-nowrap">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $siswa->name }}</td>
                                    @foreach ($list_gunabayar as $key => $gunabayar)
                                        <td>
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
                </div>
            </x-card>
        </div>
    </div>
</div>
