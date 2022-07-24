<div>
    <x-slot name="header">
        <h4>Upload Analisis Penilaian</h4>
    </x-slot>
    <div class="row my-2">
        <div class="col-md-12">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <div class="row my-2">
                        <div class="col-md-3">
                            <label for="tahun" class="form-label">Tahun</label>
                            <select wire:model="tahun" id="tahun" class="form-select">
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
                            <label for="mata_pelajaran" class="form-label">Mata Pelajaran</label>
                            <select wire:model="mata_pelajaran" id="mata_pelajaran" class="form-select">
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach ($list_mata_pelajaran as $mata_pelajaran)
                                    <option value="{{ $mata_pelajaran->id }}">{{ $mata_pelajaran->nama }}</option>
                                @endforeach
                            </select>
                            @error('mata_pelajaran')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-md-3">
                            <label for="kategori_nilai" class="form-label">Kategori Penilaian</label>
                            <select wire:model="kategori_nilai" id="kategori_nilai" class="form-select">
                                <option value="">Pilih Kategori</option>
                                @foreach ($list_kategori_nilai as $kategori_nilai)
                                    <option value="{{ $kategori_nilai->id }}">{{ $kategori_nilai->nama }}</option>
                                @endforeach
                            </select>
                            @error('kategori_nilai')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="jenis_penilaian" class="form-label">Jenis Penilaian</label>
                            <select wire:model="jenis_penilaian" id="jenis_penilaian" class="form-select">
                                <option value="">Pilih Kategori</option>
                                @foreach ($list_jenis_penilaian as $jenis_penilaian)
                                    <option value="{{ $jenis_penilaian->id }}">{{ $jenis_penilaian->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jenis_penilaian')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-3">
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
                    </div>
                    <div>
                        <span wire:loading wire:target="tahun">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                        <span wire:loading wire:target="semester">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                        <span wire:loading wire:target="mata_pelajaran">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                        <span wire:loading wire:target="kategori_nilai">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                        <span wire:loading wire:target="jenis_penilaian">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                        <span wire:loading wire:target="kelas">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                    </div>
                    <div class="my-2 d-flex justify-content-end px-3">
                        <a href="{{ route('guru.penilaian.upload-analisis-print',
                        [
                            'tahun' => $tahun,
                            'semester' => $semester,
                            'mata_pelajaran' => $mata_pelajaran,
                            'kategori_nilai' => $kategori_nilai,
                            'jenis_penilaian' => $id_jenis,
                            'kelas' => $id_kelas,
                        ]) }}" target="__blank" class="btn btn-success mx-2 my-2" role="button"><i class="fas fa-file-alt"></i> Print Analisis</a>
                        <button wire:click.prevent="exports" wire:loading.class="disabled" wire:target="exports"
                            class="btn btn-success mx-2 my-2">Download Draft <i wire:loading wire:target="exports"
                                class="fas fa-spin fa-spinner"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-6">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <label for="file_import" class="form-label">Upload Nilai</label>
                    <input wire:model="file_import" id="file_import" type="file" class="form-control">
                    <div wire:loading wire:target="file_import">
                        Membaca File <i class="fas fa-spin fa-spinner"></i>
                    </div>
                    @error('file_import')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <div class="d-flex justify-content-end my-2">
                        <button wire:click.prevent="imports" wire:loading.class="disabled" wire:target="imports" class="btn btn-success">Upload <i wire:loading wire:target="imports" class="fas fa-spin fa-spinner"></i></button>
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
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>No 1</th>
                                    <th>No 2</th>
                                    <th>No 3</th>
                                    <th>No 4</th>
                                    <th>No 5</th>
                                    <th>No 6</th>
                                    <th>No 7</th>
                                    <th>No 8</th>
                                    <th>No 9</th>
                                    <th>No 10</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_siswa as $key => $siswa)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $siswa->nis }}</td>
                                        <td class="text-nowrap">{{ $siswa->name }}</td>
                                        <td>
                                            <input wire:model.defer="nilai.{{ $key }}.no_1" type="text"
                                                class="form-control-plaintext" readonly>
                                        </td>
                                        <td>
                                            <input wire:model.defer="nilai.{{ $key }}.no_2" type="text"
                                                class="form-control-plaintext" readonly>
                                        </td>
                                        <td>
                                            <input wire:model.defer="nilai.{{ $key }}.no_3" type="text"
                                                class="form-control-plaintext" readonly>
                                        </td>
                                        <td>
                                            <input wire:model.defer="nilai.{{ $key }}.no_4" type="text"
                                                class="form-control-plaintext" readonly>
                                        </td>
                                        <td>
                                            <input wire:model.defer="nilai.{{ $key }}.no_5" type="text"
                                                class="form-control-plaintext" readonly>
                                        </td>
                                        <td>
                                            <input wire:model.defer="nilai.{{ $key }}.no_6" type="text"
                                                class="form-control-plaintext" readonly>
                                        </td>
                                        <td>
                                            <input wire:model.defer="nilai.{{ $key }}.no_7" type="text"
                                                class="form-control-plaintext" readonly>
                                        </td>
                                        <td>
                                            <input wire:model.defer="nilai.{{ $key }}.no_8" type="text"
                                                class="form-control-plaintext" readonly>
                                        </td>
                                        <td>
                                            <input wire:model.defer="nilai.{{ $key }}.no_9" type="text"
                                                class="form-control-plaintext" readonly>
                                        </td>
                                        <td>
                                            <input wire:model.defer="nilai.{{ $key }}.no_10" type="text"
                                                class="form-control-plaintext" readonly>
                                        </td>
                                        <td>
                                            <input wire:model.defer="nilai.{{ $key }}.nilai" type="text"
                                                class="form-control-plaintext" readonly>
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
