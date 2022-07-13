<div>
    <div class="row my-2">
        <div class="col-md-8">
            <x-card>
                <div class="row my-2">
                    <div class="col-md-6">
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
                    <div class="col-md-6">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select wire:model="kelas" id="kelas" class="form-select">
                            <option value="">Pilih Kelas</option>
                            @foreach ($list_kelas as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('guru.alquran.print-nilai-print', [
                        'tahun' => $tahun,
                        'kelas' => $idkelas,
                    ]) }}"
                        target="__blank" class="btn btn-success" role="button"><i class="fas fa-file-alt"></i> Print
                        Perkelas</a>
                </div>
            </x-card>
        </div>
    </div>
    <div class="row my-2">
        <div class="col">
            <x-card>
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
                                        Rencana Print Siswa
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-card>
        </div>
    </div>
</div>
