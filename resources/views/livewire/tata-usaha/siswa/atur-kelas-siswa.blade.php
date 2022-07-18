<div>
    <div class="row my-2">
        <div class="col-md-8">
            <x-card>
                <div class="row my-2">
                    <div class="col-md-4">
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
                    <div class="col-md-4">
                        <label for="nis" class="form-label">NIS</label>
                        <input wire:model="nis" type="text" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select wire:model.defer="kelas" id="kelas" class="form-select">
                            <option value="">Pilih Kelas</option>
                            @foreach ($list_kelas as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button wire:click.prevent="simpan" wire:loading.class="disabled" wire:target="simpan" class="btn btn-primary mx-2 my-2">Simpan <i wire:loading wire:target="simpan" class="fas fa-spin fa-spinner"></i></button>
                    <button wire:click.prevent="batal" wire:loading.class="disabled" wire:target="batal" class="btn btn-secondary mx-2 my-2">Batal <i wire:loading wire:target="batal" class="fas fa-spin fa-spinner"></i></button>
                </div>
            </x-card>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-8">
            <x-card>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_siswa as $siswa)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $siswa->nis }}</td>
                                <td>{{ $siswa->name }}</td>
                                <td>
                                    <button wire:click.prevent="atur({{ $siswa->nis }})"  class="btn btn-primary">Atur kelas</button>
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
