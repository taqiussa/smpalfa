<div>
    <x-slot name="header">
        <h4>Daftar Nilai Kelas</h4>
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
                        <label for="kelas" class="form-label">Kelas</label>
                        <select wire:model='kelas' id="kelas" class="form-select" disabled>
                            <option value="">Anda Bukan WaliKelas</option>
                            @foreach ($list_kelas as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <span wire:loading wire:target="tahun">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                    <span wire:loading wire:target="semester">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('guru.wali-kelas.daftar-nilai-kelas-print',
                    [
                        'tahun' => $tahun,
                        'semester' => $semester,
                        'id_kelas' => $id_kelas,
                    ]) }}" target="__blank" class="btn btn-success" role="button"><i class="fas fa-file-alt"></i>Print</a>
                </div>
            </x-card>
        </div>
    </div>
</div>
