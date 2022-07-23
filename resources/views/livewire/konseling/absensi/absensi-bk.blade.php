<div>
    <x-slot name='header'>
        <h4>
            Absensi Cara BK
            </h4>
        </x-slot>
    <div class="card rounded-md">
        <div class="card-body">
            <div class="row my-2">
                <div class="col-md-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input wire:model="tanggal" type="date" id="tanggal" class="form-control" {{ $is_disabled }}>
                </div>
                <div class="col-md-3">
                    <label for="jam" class="form-label">Jam</label>
                    <select wire:model="jam" id="jam" class="form-select" {{ $is_disabled }}>
                        <option value="">Pilih Jam</option>
                        <option value="1-2">1-2</option>
                        <option value="3-4">3-4</option>
                        <option value="5-6">5-6</option>
                        <option value="7-8">7-8</option>
                    </select>
                    @error('jam')
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
                <div class="col-md-3">
                    <label for="tahun" class="form-label">Tahun</label>
                    <select wire:model="tahun" id="tahun" class="form-select" {{ $is_disabled }}>
                        <option value="">Pilih Tahun</option>
                        @for ($i = 2017; $i < gmdate('Y'); $i++)
                            <option value="{{ $i + 1 . ' / ' . ($i + 2) }}">{{ $i + 1 . ' / ' . ($i + 2) }}</option>
                        @endfor
                    </select>
                    @error('tahun')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="row my-2">
                <div class="col-md-4">
                    <label for="siswa" class="form-label">Siswa</label>
                    <select wire:model="siswa" id="siswa" class="form-select">
                        <option value="">Pilih Siswa</option>
                        @foreach ($list_siswa as $siswa)
                            <option value="{{ $siswa->nis }}">{{ $siswa->name }}</option>
                        @endforeach
                    </select>
                    @error('siswa')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="kehadiran" class="form-label">Kehadiran</label>
                    <select wire:model="kehadiran" id="kehadiran" class="form-select">
                        <option value="">Pilih Kehadiran</option>
                        @foreach ($list_kehadiran as $kehadiran)
                            <option value="{{ $kehadiran->id }}">{{ $kehadiran->nama }}</option>
                        @endforeach
                    </select>
                    @error('kehadiran')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div>
                <span wire:loading wire:target="tanggal">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                <span wire:loading wire:target="jam">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                <span wire:loading wire:target="kelas">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                <span wire:loading wire:target="tahun">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                <span wire:loading wire:target="siswa">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                <span wire:loading wire:target="kehadiran">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
            </div>
            <div class="row my-2 d-flex justify-content-end px-2">
                <button wire:click.prevent="tambah" wire:loading.class="disabled" wire:target="tambah" class="btn btn-success w-auto">Tambah <i wire:loading wire:target="tambah" class="fas fa-spin fa-spinner"></i></button>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kelas</th>
                            <th>Nama</th>
                            <th>Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelompok_siswa as $key => $siswa)
                            <tr>
                                <td>
                                    <div>
                                        <input wire:model="kelompok_siswa.{{ $key }}.id_kelas" type="hidden"
                                            class="form-control-plaintext">
                                        <input wire:model="kelompok_siswa.{{ $key }}.nama_kelas"
                                            type="text" class="form-control-plaintext">
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <input wire:model="kelompok_siswa.{{ $key }}.nis_siswa" type="hidden"
                                            class="form-control-plaintext">
                                        <input wire:model="kelompok_siswa.{{ $key }}.nama_siswa"
                                            type="text" class="form-control-plaintext">
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <input wire:model="kelompok_siswa.{{ $key }}.id_kehadiran"
                                            type="hidden" class="form-control-plaintext">
                                        <input wire:model="kelompok_siswa.{{ $key }}.nama_kehadiran"
                                            type="text" class="form-control-plaintext">
                                    </div>
                                </td>
                                <td>
                                    <button wire:click.prevent="hapus({{ $key }})" class="btn btn-danger"><i
                                            class="fas fa-times"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        @error('kelompok_siswa')
                            <tr>
                                <td colspan="4"><small class="text-danger">{{ $message }}</small></td>
                            </tr>
                        @enderror
                    </tbody>
                </table>
            </div>
            <div class="row my-2 justify-content-end">
                <button wire:loading.class="disabled" wire:click.prevent="simpan" class="btn btn-primary w-auto">
                    Simpan
                    <i wire:loading wire:target="simpan" class="fas fa-spinner fa-spin"></i>
                </button>
            </div>
        </div>
    </div>
</div>
