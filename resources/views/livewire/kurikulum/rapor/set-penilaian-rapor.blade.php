<div>
    <div class="row my-2">
        <div class="col-md-12">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <div class="row my-2">
                        <div class="col-md-2">
                            <label for="tahun" class="form-label">Tahun</label>
                            <select wire:model="tahun" id="tahun" class="form-select">
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
                        <div class="col-md-3">
                            <label for="kategori_nilai_id" class="form-label">Kategori Penilaian</label>
                            <select wire:model.defer="kategori_nilai_id" id="kategori_nilai_id" class="form-select">
                                <option value="">Pilih Kategori</option>
                                @foreach ($list_kategori_nilai as $kategori_nilai)
                                    <option value="{{ $kategori_nilai->id }}">{{ $kategori_nilai->nama }}</option>
                                @endforeach
                            </select>
                            @error('kategori_nilai_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="jenis_penilaian_id" class="form-label">Jenis Penilaian</label>
                            <select wire:model.defer="jenis_penilaian_id" id="jenis_penilaian_id" class="form-select">
                                <option value="">Pilih Jenis</option>
                                @foreach ($list_jenis_penilaian as $jenis_penilaian)
                                    <option value="{{ $jenis_penilaian->id }}">{{ $jenis_penilaian->nama }}</option>
                                @endforeach
                            </select>
                            @error('jenis_penilaian_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button wire:click.prevent="simpan" wire:loading.class="disabled" wire:target="simpan"
                            class="btn btn-primary">Tambah <i wire:loading wire:target="simpan"
                                class="fas fa-spinner fa-spin"></i></button>
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
                                    <th>Tahun</th>
                                    <th>Semester</th>
                                    <th>Kategori Penilaian</th>
                                    <th>Jenis Penilaian</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_rapor as $rapor)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $rapor->tahun }}</td>
                                    <td>{{ $rapor->semester }}</td>
                                    <td>{{ $rapor->kategori->nama }}</td>
                                    <td>{{ $rapor->jenis_penilaian->nama }}</td>
                                    <td>
                                        <a wire:click.prevent="confirm({{ $rapor->id }})" class="badge text-danger" role="button"><i class="fas fa-trash-alt"></i></a>
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
