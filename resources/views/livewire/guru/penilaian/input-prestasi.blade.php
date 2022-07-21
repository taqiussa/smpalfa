<div>
    <x-slot name="header">
        <h4>Input Prestasi Siswa</h4>
    </x-slot>
    <div class="row my-2">
        <div class="col-md-12">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <form wire:submit.prevent="simpan">
                        <div class="row my-2">
                            <div class="col-md-3">
                                <label for="tahun" class="form-label">Tahun</label>
                                <select wire:model='tahun' id="tahun" class="form-select">
                                    <option value="">Pilih Tahun</option>
                                    @for ($i = 2017; $i < gmdate('Y'); $i++)
                                        <option value="{{ $i + 1 . ' / ' . ($i + 2) }}">
                                            {{ $i + 1 . ' / ' . ($i + 2) }}</option>
                                    @endfor
                                </select>
                                @error('tahun')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="semester" class="form-label">Semester</label>
                                <select wire:model="semester" id="semester" class="form-select">
                                    <option value="">Pilih Semester</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                                @error('semester')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select wire:model="kelas" id="kelas" class="form-select">
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($list_kelas as $kelas)
                                        <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kelas')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="siswa" class="form-label">Siswa</label>
                                <select wire:model.defer="siswa" id="siswa" class="form-select">
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
                        <div class="row my-2">
                            <div class="col-md-6">
                                <label for="prestasi" class="form-label">Prestasi</label>
                                <input wire:model.defer="prestasi" type="text" class="form-control">
                                @error('prestasi')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input wire:model.defer="keterangan" type="text" class="form-control">
                                @error('keterangan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button wire:click.prevent="simpan" wire:loading.class="disabled" wire:target="simpan"
                                class="btn btn-primary mx-2 my-2" type="submit">Simpan <i wire:loading wire:target="simpan"
                                    class="fas fa-spin fa-spinner"></i></button>
                            <button wire:click.prevent="batal" wire:loading.class="disabled" wire:target="batal"
                                class="btn btn-secondary mx-2 my-2">Batal <i wire:loading wire:target="batal"
                                    class="fas fa-spin fa-spinner"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-12">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <div class="table-reponsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Prestasi</th>
                                    <th>Keterangan</th>
                                    <th>
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_prestasi as $prestasi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $prestasi->name }}</td>
                                    <td>{{ $prestasi->nama }}</td>
                                    <td>{{ $prestasi->prestasi }}</td>
                                    <td>{{ $prestasi->keterangan }}</td>
                                    <td>
                                        <a wire:click.prevent="edit({{ $prestasi->id }})" class="badge text-primary mx-2 my-2" role="button">
                                        <i class="fas fa-edit"></i></a>
                                        <a wire:click.prevent="confirm({{ $prestasi->id }})" class="badge text-danger mx-2 my-2" role="button">
                                        <i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
