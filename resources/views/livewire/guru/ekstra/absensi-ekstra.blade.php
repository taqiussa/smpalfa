<div>
    <div class="row my-2">
        <div class="col-md-8">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <div class="row my-2">
                        <div class="col-md-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input wire:model="tanggal" type="date" class="form-control">
                        </div>
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
                        <div class="col-md-6">
                            <label for="ekstra" class="form-label">Ekstrakurikuler</label>
                            <select wire:model="ekstra" id="ekstra" class="form-select">
                                <option value="">Pilih Ekstrakurikuler</option>
                                @foreach ($list_ekstra as $ekstra)
                                    <option value="{{ $ekstra->id }}">{{ $ekstra->nama }}</option>
                                @endforeach
                            </select>
                            @error('ekstra')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
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
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Kehadiran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_siswa as $key => $siswa)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $siswa->name }}
                                        </td>
                                        <td>{{ $siswa->kelas }}</td>
                                        <td>
                                            <select wire:model.defer='kehadiran.{{ $key }}.kehadiran'
                                                wire:key="{{ $key }}" class="form-select">
                                                <option value="">Pilih Kehadiran</option>
                                                @foreach ($list_kehadiran as $kehadiran)
                                                    <option value='{{ $kehadiran->id }}'>{{ $kehadiran->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('kehadiran.' . $key . '.kehadiran')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex my-2 justify-content-end">
                        <button wire:click.prevent="simpan" wire:loading.class="disabled" wire:target="simpan"
                            class="btn btn-primary mx-2 my-2" type="submit">Simpan <i wire:loading wire:target="simpan"
                                class="fas fa-spin fa-spinner"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
