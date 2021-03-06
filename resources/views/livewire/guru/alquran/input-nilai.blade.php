<div>
    <x-slot name="header">
        <h4>Input Nilai Al-Qur'an</h4>
    </x-slot>
    <div class="row my-2">
        <div class="col-md-8">
            <x-card>
                <form wire:submit.prevent="simpan">
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
                        <div class="col-md-6">
                            <label for="siswa" class="form-label">Siswa</label>
                            <select wire:model="siswa" id="siswa" class="form-select" {{ $is_disabled }}>
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
                        <div class="col-md-3">
                            <label for="kategori" class="form-label">Kategori Penilaian</label>
                            <select wire:model="kategori" id="kategori" class="form-select" {{ $is_disabled }}>
                                <option value="">Pilih Kategori</option>
                                @foreach ($list_kategori as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                            @error('kategori')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="jenis" class="form-label">Surah / Juz</label>
                            <select wire:model.defer="jenis" id="jenis" class="form-select" {{ $is_disabled }}>
                                <option value="">Pilih Surah / Juz</option>
                                @foreach ($list_jenis as $jenis)
                                    <option value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
                                @endforeach
                            </select>
                            @error('jenis')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="nilai" class="form-label">Nilai</label>
                            <input wire:model.defer="nilai" type="text" class="form-control">
                            @error('nilai')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <span wire:loading wire:target="tahun">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                        <span wire:loading wire:target="kelas">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                        <span wire:loading wire:target="siswa">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                        <span wire:loading wire:target="kategori">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button wire:click.prevent="simpan" wire:loading.class="disabled" wire:target="simpan"
                            class="btn btn-primary" type="submit">Simpan <i wire:loading wire:target="simpan"
                                class="fas fa-spin fa-spinner"></i></button>
                    </div>
                </form>
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
                                <th>Tanggal</th>
                                <th>Surah / Juz</th>
                                <th>Nilai</th>
                                <th>Guru</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_jenis as $key => $jenis)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $list_tanggal[$key] }}</td>
                                    <td>{{ $jenis->nama }}</td>
                                    <td>{{ $list_nilai[$key] }}</td>
                                    <td>{{ $list_guru[$key] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-card>
        </div>
    </div>
</div>
