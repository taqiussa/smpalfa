<div>
    <x-slot name="header">
        <h4>Input Pemasukan</h4>
    </x-slot>
    <div class="row my-2">
        <div class="col-md-12">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <form wire:submit.prevent="simpan">
                        <div class="row my-2">
                            <div class="col-md-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input wire:model.defer="tanggal" type="date" class="form-control"
                                    {{ $is_disabled }}>
                                @error('tanggal')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="tahun" class="form-label">Tahun</label>
                                <select wire:model.defer='tahun' id="tahun" class="form-select"
                                    {{ $is_disabled }}>
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
                            <div class="col-md-6">
                                <label for="kategori" class="form-label">Kategori Pemasukan</label>
                                <select wire:model.defer="kategori" id="kategori" class="form-select"
                                    {{ $is_disabled }}>
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($list_kategori as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kategori')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-8">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input wire:model.defer="keterangan" type="text" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input wire:model.defer="jumlah" type="numeric" class="form-control">
                                @error('jumlah')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button wire:click.prevent="simpan" class="btn btn-primary mx-2 my-2" wire:loading.class="disabled"
                                wire:target="simpan">Simpan <i wire:loading wire:target="simpan"
                                    class="fas fa-spin fa-spinner"></i></button>
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
                                <th>Tahun</th>
                                <th>Kategori Pemasukan</th>
                                <th>Keterangan</th>
                                <th>Jumlah</th>
                                <th>Bendahara</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_pemasukan as $key => $pemasukan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date('d M Y', strtotime($pemasukan->tanggal)) }}</td>
                                    <td>{{ $pemasukan->tahun }}</td>
                                    <td>{{ $pemasukan->nama }}</td>
                                    <td>{{ $pemasukan->keterangan }}</td>
                                    <td>{{ 'Rp ' . number_format($pemasukan->jumlah, 0, ',', '.') }}</td>
                                    <td>{{ $pemasukan->name }}</td>
                                    <td>
                                        <a wire:click.prevent="edit({{ $pemasukan->id }})"
                                            class="badge text-primary mx-2 my-2" role="button">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a wire:click.prevent="confirm({{ $pemasukan->id }})"
                                            class="badge text-danger mx-2 my-2" role="button">
                                            <i class="fas fa-trash-alt"></i></a>
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
