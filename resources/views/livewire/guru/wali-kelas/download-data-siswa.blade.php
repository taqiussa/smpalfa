<div>
    <x-slot name="header">
        <h4>Data Siswa</h4>
    </x-slot>
    <div class="row my-2">
        <div class="col-md-6">
            <x-card>
                <div class="row my-2">
                    <div class="col-md-6">
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
                    <div class="col-md-6">
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
                    <span wire:loading wire:target="kelas">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                </div>
                <div class="d-flex justify-content-end">
                    <button wire:click.prevent="downloadsiswa" wire:loading.class="disabled" wire:target="downloadsiswa" class="btn btn-primary">Download Data <i wire:loading wire:target="downloadsiswa" class="fas fa-spin fa-spinner"></i></button>
                </div>
            </x-card>
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
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Ayah</th>
                                <th>Ibu</th>
                                <th>Wali</th>
                                <th>Desa</th>
                                <th>Kontak</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_siswa as $siswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $siswa->nis }}</td>
                                    <td>{{ $siswa->user->name }}</td> 
                                    <td>{{ $siswa->orangtua->nama_ayah }}</td> 
                                    <td>{{ $siswa->orangtua->nama_ibu }}</td> 
                                    <td>{{ $siswa->wali->nama_wali ?? '-'}}</td>
                                    <td>{{ $siswa->alamat->desa }}</td>
                                    <td>{{ $siswa->biodata->telepon }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-card>
        </div>
    </div>
</div>
