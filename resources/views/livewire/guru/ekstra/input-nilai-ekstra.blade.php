<div>
    <x-slot name="header">
        <h4>Input Nilai</h4>
    </x-slot>
    <div class="row my-2">
        <div class="col-md-12">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <div class="row my-2">
                        <div class="col-md-3">
                            <label for="tahun" class="form-label">Tahun</label>
                            <select wire:model="tahun" id="tahun" class="form-select">
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
                            <label for="ekstra" class="form-label">Ekstrakurikuler</label>
                            <select wire:model="ekstra" id="ekstra" class="form-select">
                                <option value="">Pilih Ekstrakurikuler</option>
                                @foreach ($list_ekstra as $ekstra)
                                    <option value="{{ $ekstra->id }}">{{ $ekstra->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <span wire:loading wire:target="tahun">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                        <span wire:loading wire:target="semester">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                        <span wire:loading wire:target="ekstra">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
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
                                    <th>Kelas</th>
                                    <th>Nama</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_siswa as $key => $siswa)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $siswa->kelas->nama }}</td>
                                        <td>{{ $siswa->siswa->name }}</td>
                                        <td>
                                            <input wire:model.defer="nilai.{{ $key }}.nilai" type="text"
                                                class="form-control">
                                            @error('nilai.' . $key . '.nilai')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if ($list_siswa)
                        <div class="my-2 d-flex justify-content-end">
                            <button wire:click.prevent="simpan" wire:loading.class="disabled" wire:target="simpan"
                                class="btn btn-primary">Simpan <i wire:loading wire:target="simpan"
                                    class="fas fa-spin fa-spinner"></i></button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
