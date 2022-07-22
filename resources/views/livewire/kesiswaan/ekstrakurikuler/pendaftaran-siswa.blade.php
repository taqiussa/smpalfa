<div>
    <x-slot name="header">
        <h4>Pendaftaran Siswa ke Ekstrakurikuler</h4>
    </x-slot>
    <div class="row my-2">
        <div class="col-md-12">
            <x-card>
                <div class="row my-2">
                    <div class="col-md-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        <select wire:model="tahun" id="tahun" class="form-select" {{ $is_disabled }}>
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
                    <div class="col-md-3">
                        <label for="ekstra" class="form-label">Ekstrakurikuler</label>
                        <select wire:model="ekstra" id="ekstra" class="form-select">
                            <option value="">Pilih Ekstra</option>
                            @foreach ($list_ekstra as $ekstra)
                                <option value="{{ $ekstra->id }}">{{ $ekstra->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select wire:model="kelas" id="kelas" class="form-select" {{ $is_disabled }}>
                            <option value="">Pilih Kelas</option>
                            @foreach ($list_kelas as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                            @endforeach
                        </select>
                        @error('kelas')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="siswa" class="form-label">Siswa</label>
                        <select wire:model.defer="siswa" id="siswa" class="form-select" {{ $is_disabled }}>
                            <option value="">Pilih Siswa</option>
                            @foreach ($list_siswa as $siswa)
                                <option value="{{ $siswa->nis }}">{{ $siswa->name }}</option>
                            @endforeach
                        </select>
                        @error('siswa')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div>
                    <span wire:loading wire:target="tahun">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                    <span wire:loading wire:target="kelas">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                    <span wire:loading wire:target="ekstra">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                </div>
                <div class="d-flex justify-content-end">
                    <button wire:click.prevent="simpan" wire:loading.class="disabled" wire:target="simpan" class="btn btn-primary">Simpan</button>
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
                                <th>#</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_siswa_ekstra as $siswa_ekstra)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $siswa_ekstra->siswa->name }}</td>
                                    <td>{{ $siswa_ekstra->kelas->nama }}</td>
                                    <td>
                                        <a wire:click.prevent="edit({{ $siswa_ekstra->id }})" class="badge text-primary mx-2 my-2" role="button">
                                        <i class="fas fa-edit"></i></a>
                                        <a wire:click.prevent="confirm({{ $siswa_ekstra->id }})" class="badge text-danger mx-2 my-2" role="button">
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
