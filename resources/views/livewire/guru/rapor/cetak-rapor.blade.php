<div>
    <x-slot name="header">
        Cetak Rapor
    </x-slot>
    @if ($informasi)
        <div class="row my-2">
            <div class="col-md-8">
                <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-danger">
                    <div class="card-body">
                        <h4 class="text-danger">{{ $informasi }}</h4>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row my-2">
        <div class="col-md-7">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <div class="row my-2">
                        <div class="col-md-4">
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
                        <div class="col-md-4">
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
                        <div class="col-md-4">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select wire:model='kelas' id="kelas" class="form-select" disabled>
                                @foreach ($list_kelas as $kelas)
                                    <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                @endforeach
                            </select>
                            @error('kelas')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-10">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_siswa as $siswa)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $siswa->nis }}</td>
                                        <td>{{ $siswa->name }}</td>
                                        <td>
                                            <a wire:click.prevent="download({{ $siswa->nis }})"
                                                wire:loading.class="disabled"
                                                wire:target="download({{ $siswa->nis }})"
                                                class="btn btn-danger mx-2 my-2">Download <i wire:loading
                                                    wire:target="download({{ $siswa->nis }})"
                                                    class="fas fa-spin fa-spinner"></i></a>
                                            {{-- <a wire:click.prevent="downloadv({{ $siswa->nis }})"
                                                wire:loading.class="disabled"
                                                wire:target="downloadv({{ $siswa->nis }})"
                                                class="btn btn-danger mx-2 my-2">Download V <i wire:loading
                                                    wire:target="downloadv({{ $siswa->nis }})"
                                                    class="fas fa-spin fa-spinner"></i></a>
                                                    
                                                    <a href="{{ route('guru.rapor.rapor-print', 
                                                    [
                                                        'tahun' => $tahun,
                                                        'nis' => $siswa->nis,
                                                        'kelas' => $idkelas,
                                                        'semester' => $semester
                                                    ]) }}" class="btn btn-success mx-2 my-2" role="button" target="__blank">
                                                    Print</a> --}}
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
