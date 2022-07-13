<div>
    <div class="row my-2">
        <div class="col-md-6">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <form wire:submit.prevent="simpan">
                        <div class="row my-2">
                            <div class="col-md-4">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input wire:model.defer="tanggal" type="date" class="form-control"
                                    {{ $is_disabled }}>
                                @error('tanggal')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="tahun" class="form-label">Tahun</label>
                                <select wire:model='tahun' id="tahun" class="form-select" {{ $is_disabled }}>
                                    <option value="">Pilih Tahun</option>
                                    @for ($i = 2017; $i < gmdate('Y'); $i++)
                                        <option value="{{ $i + 1 . ' / ' . ($i + 2) }}">
                                            {{ $i + 1 . ' / ' . ($i + 2) }}
                                        </option>
                                    @endfor
                                </select>
                                @error('tahun')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select wire:model='kelas' id="kelas" class="form-select" {{ $is_disabled }}>
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
                        <div class="row my-2">
                            <div class="col-md-8">
                                <label for="siswa" class="form-label">Siswa</label>
                                <select wire:model="siswa" id="siswa" class="form-select" {{ $is_disabled }}>
                                    <option value="">Pilih Siswa</option>
                                    @foreach ($list_siswa as $siswa)
                                        <option value="{{ $siswa->nis }}">{{ $siswa->name }}</option>
                                    @endforeach
                                </select>
                                @error('siswa')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="gunabayar" class="form-label">Guna Bayar</label>
                                <select wire:model.defer="gunabayar" id="gunabayar" class="form-select"
                                    {{ $is_disabled }}>
                                    <option value="">Pilih</option>
                                    @foreach ($list_gunabayar as $gunabayar)
                                        <option value="{{ $gunabayar->id }}">{{ $gunabayar->nama }}</option>
                                    @endforeach
                                </select>
                                @error('gunabayar')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-8">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input wire:model.defer="jumlah" type="numeric" class="form-control">
                                @error('jumlah')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button wire:click.prevent="simpan" class="btn btn-primary mx-2 my-2"
                                wire:loading.class="disabled" wire:target="simpan">Simpan <i wire:loading
                                    wire:target="simpan" class="fas fa-spin fa-spinner"></i></button>
                            @if ($is_edit)
                                <button wire:click.prevent="batal" class="btn btn-secondary mx-2 my-2"
                                    wire:loading.class="disabled" wire:target="batal">Batal <i wire:loading
                                        wire:target="batal" class="fas fa-spin fa-spinner"></i></button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Pembayaran</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_gunabayar as $key => $gunabayar)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $gunabayar->nama }}</td>
                                        <td>{{ $list_tanggal[$key] }}</td>
                                        <td>{{ 'Rp ' . number_format($sumjumlah[$key], 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-12">
            <x-card>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Guna Bayar</th>
                                <th>Tahun</th>
                                <th>Jumlah</th>
                                <th>Bendahara</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_data_bayar as $key => $data_bayar)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date('d M Y', strtotime($data_bayar->tanggal)) }}</td>
                                    <td>{{ $data_bayar->name }}</td>
                                    <td>{{ $data_bayar->gunabayar }}</td>
                                    <td>{{ $data_bayar->tahun }}</td>
                                    <td>{{ 'Rp ' . number_format($data_bayar->jumlah, 0, ',', '.') }}</td>
                                    <td>{{ $data_bayar->bendahara }}</td>
                                    <td>
                                        <a href="{{ route('bendahara.transaksi.pembayaran-siswa-print',
                                        [
                                            'tanggal' => $data_bayar->tanggal,
                                            'nis' => $data_bayar->nis,
                                            'kelas' => $data_bayar->kelas,
                                            'siswa' => $data_bayar->name,
                                            'tahun' => $data_bayar->tahun
                                        ]) }}" class="badge text-success mx-2 my-2" target="__blank"><i class="fas fa-file-alt"></i></a>
                                        <a wire:click.prevent="edit({{ $data_bayar->id }})"
                                            class="badge text-primary mx-2 my-2" role="button"><i
                                                class="fas fa-edit"></i></a>
                                        <a wire:click.prevent="confirm({{ $data_bayar->id }})"
                                            class="badge text-danger mx-2 my-2" role="button"><i
                                                class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-card>
        </div>
    </div>
</div>
