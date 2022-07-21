<div>
    <x-slot name="header">
        <h4>Cek Saldo Skor</h4>
    </x-slot>
    <div class="row my-2">
        <div class="col-md-6">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <div class="row">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-8">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>  
                                    <th>Nama</th>
                                    <th>Saldo Skor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_siswa as $key => $siswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $siswa->name }}</td>
                                    <td>
                                        {{ $total_skor[$key] }}
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
