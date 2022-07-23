<div>
    <x-slot name="header">
        <h4>Pindah Kelas Siswa</h4>
    </x-slot>
    <div class="row my-2">
        <div class="col">
            <x-card>
                <div class="row my-2">
                    <div class="col-md-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        <select wire:model='tahun' id="tahun" class="form-select">
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
                        <label for="kelas" class="form-label">Kelas Awal</label>
                        <select wire:model='kelas' id="kelas" class="form-select">
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
                    <div class="col-md-3">
                        <label for="kelas_tujuan" class="form-label">Kelas Tujuan</label>
                        <select wire:model='kelas_tujuan' id="kelas_tujuan" class="form-select">
                            <option value="">Pilih Kelas Tujuan</option>
                            @foreach ($list_kelas as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                            @endforeach
                        </select>
                        @error('kelas_tujuan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div>
                    <span wire:loading wire:target="tahun">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                    <span wire:loading wire:target="kelas">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                    <span wire:loading wire:target="siswa">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                    <span wire:loading wire:target="kelas_tujuan">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                </div>
                <div class="d-flex justify-content-end">
                    <button wire:click.prevent="pindah" wire:loading.class="disabled" wire:target="pindah" class="btn btn-primary">Pindahkan <i wire:loading wire:target="pindah" class="fas fa-spin fa-spinner"></i></button>
                </div>
            </x-card>
        </div>
    </div>
</div>
