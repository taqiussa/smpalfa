<div>
    @if ($informasi)
        <div class="row my-2">
            <div class="col-md-8">
                <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-danger">
                    <div class="card-body">
                        <h4 class="text-danger">{{ $informasi }}</h4>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row my-2">
        <div class="col-md-12">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <div class="row my-2">
                        <div class="col-md-3">
                            <label for="tahun" class="form-label">Tahun</label>
                            <select wire:model='tahun' id="tahun" class="form-select" {{ $is_disabled }}>
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
                        <div class="col-md-2">
                            <label for="semester" class="form-label">Semester</label>
                            <select wire:model="semester" id="semester" class="form-select" {{ $is_disabled }}>
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
                            <select wire:model="kelas" id="kelas" class="form-select" disabled>
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
                    <div class="row my-2">
                        <div class="col-md-12">
                            <label for="catatan" class="form-label">Catatan Wali Kelas</label>
                            <textarea wire:model.defer="catatan" id="catatan" rows="2" class="form-control"></textarea>
                            @error('catatan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex my-2 justify-content-end">
                        <button wire:click.prevent="simpan" wire:loading.class="disabled" wire:target="simpan"
                            class="btn btn-primary mx-2 my-2">Simpan <i wire:loading wire:target="simpan"
                                class="fas fa-spin fa-spinner"></i></button>
                        @if ($is_edit)
                            <button wire:click.prevent="batal" wire:loading.class="disabled" wire:target="batal"
                                class="btn btn-secondary mx-2 my-2">Batal <i wire:loading wire:target="batal"
                                    class="fas fa-spin fa-spinner"></i></button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-12">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Catatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_catatan as $catatan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-nowrap">{{ $catatan->name }}</td>
                                        <td>{{ $catatan->catatan }}</td>
                                        <td class="text-nowrap">
                                            <a wire:click.prevent="edit({{ $catatan->id }})"
                                                class="badge text-primary mx-2 my-2" role="button">
                                                <i class="fas fa-edit"></i></a>
                                            <a wire:click.prevent="confirm({{ $catatan->id }})"
                                                class="badge text-danger mx-2 my-2" role="button">
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
