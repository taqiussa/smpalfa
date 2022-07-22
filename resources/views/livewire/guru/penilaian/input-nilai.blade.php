<div>
    <x-slot name="header">
        <h4>Input Nilai</h4>
    </x-slot>
    <div class="row my-2">
        <div class="col-md-12">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <div class="row my-2">
                        <div class="col-md-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input wire:model="tanggal" type="date" class="form-control">
                            @error('tanggal')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="tahun" class="form-label">Tahun</label>
                            <select wire:model="tahun" id="tahun" class="form-select">
                                <option value="">Pilih Tahun</option>
                                @for ($i = 2017; $i < gmdate('Y'); $i++)
                                <option value="{{ $i + 1 . ' / ' . ($i + 2) }}">{{ $i + 1 . ' / ' . ($i + 2) }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="semester" class="form-label">Semester</label>
                            <select wire:model="semester" id="semester" class="form-select">
                                <option value="">Pilih Semester</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="mata_pelajaran" class="form-label">Mata Pelajaran</label>
                            <select wire:model="mata_pelajaran" id="mata_pelajaran" class="form-select">
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach ($list_mata_pelajaran as $mata_pelajaran)
                                    <option value="{{ $mata_pelajaran->id }}">{{ $mata_pelajaran->nama }}</option>
                                @endforeach
                            </select>
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
                        </div>
                        <div class="col-md-3">
                            <label for="jenis_penilaian" class="form-label">Jenis Penilaian</label>
                            <select wire:model="jenis_penilaian" id="jenis_penilaian" class="form-select">
                                <option value="">Pilih Jenis Penilaian</option>
                                @foreach ($list_jenis_penilaian as $jenis_penilaian)
                                    <option value="{{ $jenis_penilaian->id }}">{{ $jenis_penilaian->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select wire:model="kelas" id="kelas" class="form-select">
                                <option value="">Pilih Kelas</option>
                                @foreach ($list_kelas as $kelas)
                                    <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <span wire:loading wire:target="tanggal">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                        <span wire:loading wire:target="tahun">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                        <span wire:loading wire:target="semester">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                        <span wire:loading wire:target="mata_pelajaran">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                        <span wire:loading wire:target="kategori_nilai">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                        <span wire:loading wire:target="jenis_penilaian">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                        <span wire:loading wire:target="kelas">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
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
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_siswa as $key => $siswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $siswa->nis }}</td>
                                    <td>{{ $siswa->name }}</td>
                                    <td>
                                        <input wire:model.defer="nilai.{{ $key }}.nilai" type="text" class="form-control">
                                        @error('nilai.' . $key . '.nilai')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if ($list_siswa)
                    <div class="my-2 d-flex justify-content-end">
                        <button wire:click.prevent="simpan" wire:loading.class="disabled" wire:target="simpan" class="btn btn-primary">Simpan <i wire:loading wire:target="simpan" class="fas fa-spin fa-spinner"></i></button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
