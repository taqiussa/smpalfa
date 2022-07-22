<div>
    <x-slot name="header">
        <h4>Daftar Nilai Per Mapel</h4>
    </x-slot>
    <div class="row my-2">
        <div class="col-md-12">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
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
                            <select wire:model='kelas' id="kelas" class="form-select">
                                <option value="">Pilih Kelas</option>
                                @foreach ($list_kelas as $kelas)
                                    <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                @endforeach
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
                            <small wire:loading wire:target="tahun">Memuat Data... <i class="fas fa-spin fa-spinner"></i></small>
                            <small wire:loading wire:target="semester">Memuat Data... <i class="fas fa-spin fa-spinner"></i></small>
                            <small wire:loading wire:target="kelas">Memuat Data... <i class="fas fa-spin fa-spinner"></i></small>
                            <small wire:loading wire:target="mata_pelajaran">Memuat Data... <i class="fas fa-spin fa-spinner"></i></small>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('guru.rapor.daftar-nilai-guru-print',
                        [
                            'tahun' => $tahun,
                            'semester' => $semester,
                            'id_kelas' => $id_kelas,
                            'mata_pelajaran'=> $mata_pelajaran
                        ]) }}" target="__blank" class="btn btn-success" role="button"><i class="fas fa-file-alt"></i> Print</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
