<div>
    <x-slot name="header">
        <h4>List Kd untuk Rapor</h4>
    </x-slot>
    <div class="row my-2">
        <div class="col-md-3">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <button wire:click.prevent="$toggle('show')" wire:loading.class="disabled" wire:target="$toggle"
                        class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah <i wire:loading
                            wire:target="$toggle" class="fas fa-spin fa-spinner"></i></button>
                </div>
            </div>
        </div>
    </div>
    @if ($show)
        <div class="row my-2">
            <div class="col-md-12">
                <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                    <div class="card-body">
                        <div class="row my-2">
                            <div class="col-md-4">
                                <label for="tahun" class="form-label">Tahun</label>
                                <select wire:model.defer='tahun' id="tahun" class="form-select">
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
                            <div class="col-md-4">
                                <label for="tingkat" class="form-label">Tingkat</label>
                                <select wire:model.defer="tingkat" id="tingkat" class="form-select">
                                    <option value="">Pilih Tingkat</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                </select>
                                @error('tingkat')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="semester" class="form-label">Semester</label>
                                <select wire:model.defer="semester" id="semester" class="form-select">
                                    <option value="">Pilih Semester</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                                @error('semester')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-4">
                                <label for="mata_pelajaran" class="form-label">Mata Pelajaran</label>
                                <select wire:model.defer="mata_pelajaran" id="mata_pelajaran" class="form-select">
                                    <option value="">Pilih Mata Pelajaran</option>
                                    @foreach ($list_mata_pelajaran as $mata_pelajaran)
                                        <option value="{{ $mata_pelajaran->id }}">{{ $mata_pelajaran->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('mata_pelajaran')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="kategori_nilai" class="form-label">Kategori Penilaian</label>
                                <select wire:model.defer="kategori_nilai" id="kategori_nilai" class="form-select">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($list_kategori_nilai as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kategori_nilai')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="jenis_penilaian" class="form-label">Jenis Penilaian</label>
                                <select wire:model.defer="jenis_penilaian" id="jenis_penilaian" class="form-select">
                                    <option value="">Jenis Penilaian</option>
                                    @foreach ($list_jenis_penilaian as $jenis)
                                        <option value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
                                    @endforeach
                                </select>
                                @error('jenis_penilaian')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-12">
                                <label for="deskripsi" class="form-label">Deskripsi KD</label>
                                <textarea wire:model.defer="deskripsi" id="deskripsi" rows="3" class="form-control"></textarea>
                                @error('deskripsi')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row my-2 d-flex justify-content-end px-3">
                            <button wire:click.prevent="simpan" wire:loading.class="disabled" wire:target="simpan"
                                class="btn btn-primary w-auto mx-2 my-2">Simpan <i wire:loading wire:target="simpan"
                                    class="fas fa-spin fa-spinner"></i></button>
                            <button wire:click.prevent="batal" wire:loading.class="disabled" wire:target="batal"
                                class="btn btn-secondary w-auto mx-2 my-2">Batal <i wire:loading wire:target="batal"
                                    class="fas fa-spin fa-spinner"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="row my-2">
        <div class="col-md-3">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <label for="tahuntable" class="form-label">Tahun Ajaran</label>
                    <select wire:model="tahuntable" id="tahuntable" class="form-select">
                        <option value="">Pilih Tahun</option>
                        @for ($i = 2017; $i < gmdate('Y'); $i++)
                            <option value="{{ $i + 1 . ' / ' . ($i + 2) }}">
                                {{ $i + 1 . ' / ' . ($i + 2) }}</option>
                        @endfor
                    </select>
                    @error('tahuntable')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <div>
                        <span wire:loading wire:target="tahuntable">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                    </div>
                    </select>
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
                                    <th class=" text-nowrap">Tahun</th>
                                    <th class=" text-nowrap">Semester</th>
                                    <th class=" text-nowrap">Tingkat</th>
                                    <th class=" text-nowrap">Mata Pelajaran</th>
                                    <th class=" text-nowrap">Kategori Penilaian</th>
                                    <th class=" text-nowrap">Jenis Penilaian</th>
                                    <th>Deskripsi</th>
                                    <th class=" text-nowrap">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_kd as $key => $kd)
                                    <tr>
                                        <td class=" text-nowrap">{{ $list_kd->firstItem() + $key }}</td>
                                        <td class=" text-nowrap">{{ $kd->tahun }}</td>
                                        <td class=" text-nowrap">{{ $kd->semester }}</td>
                                        <td class=" text-nowrap">{{ $kd->tingkat }}</td>
                                        <td class=" text-nowrap">{{ $kd->nama_mata_pelajaran }}</td>
                                        <td class=" text-nowrap">{{ $kd->nama_kategori_nilai }}</td>
                                        <td class=" text-nowrap">{{ $kd->nama_jenis_penilaian }}</td>
                                        <td>{{ $kd->deskripsi }}</td>
                                        <td class=" text-nowrap">
                                            <a wire:click.prevent="confirm({{ $kd->id }})"
                                                class="badge text-danger mx-2 my-2" role="button"><i
                                                    class="fas fa-trash-alt"></i></a>
                                            <a wire:click.prevent="edit({{ $kd->id }})"
                                                class="badge text-primary mx-2 my-2" role="button"><i
                                                    class="fas fa-edit"></i></a>
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
    <div class="row my-2">
        <div>
            {{ $list_kd->links() }}
        </div>
    </div>
</div>
