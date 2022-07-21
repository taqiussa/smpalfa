<div>
    <x-slot name="header">
        <h4>Form Upload KD Rapor</h4>
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
                            @error('tahun')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-3">
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
                        <div class="col-md-3">
                            <label for="tingkat" class="form-label">Tingkat</label>
                            <select wire:model="tingkat" id="tingkat" class="form-select">
                                <option value="">Pilih Tingkat</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                            </select>
                            @error('tingkat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="kategori_nilai_id" class="form-label">Kategori Penilaian</label>
                            <select wire:model="kategori_nilai_id" id="kategori_nilai_id" class="form-select">
                                <option value="">Pilih Kategori</option>
                                @foreach ($list_kategori_nilai as $kategori_nilai)
                                    <option value="{{ $kategori_nilai->id }}">{{ $kategori_nilai->nama }}</option>
                                @endforeach
                            </select>
                            @error('kategori_nilai')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <label class="form-label">Pilih Jenis Penilaian</label>
                    <div class="row my-2">
                        <div class="col-md-12">
                            @foreach ($list_jenis_penilaian as $key => $jenis_penilaian)
                                <div class="form-check form-check-inline">
                                    <input wire:model.defer="jenis_penilaian_id.{{ $key }}"
                                        id="jenis_penilaian_id.{{ $key }}" class="form-check-input"
                                        type="checkbox" value="{{ $jenis_penilaian->id }}">
                                    <label class="form-check-label" for="jenis_penilaian_id.{{ $key }}">
                                        {{ $jenis_penilaian->nama }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('jenis_penilaian_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="row my-2 d-flex justify-content-end px-3">
                        <button wire:click.prevent="exports" wire:loading.class="disabled" wire:target="exports"
                            class="btn btn-success w-auto">Download Draft <i wire:loading wire:target="exports"
                                class="fas fa-spin fa-spinner"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-6">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <label for="file_import" class="form-label">Upload KD Rapor</label>
                    <input wire:model="file_import" id="file_import" type="file" class="form-control">
                    <div wire:loading wire:target="file_import">
                        Membaca File <i class="fas fa-spin fa-spinner"></i>
                    </div>
                    @error('file_import')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <div class="d-flex justify-content-end my-2">
                        <button wire:click.prevent="imports" wire:loading.class="disabled" wire:target="imports"
                            class="btn btn-success">Upload <i wire:loading wire:target="imports"
                                class="fas fa-spin fa-spinner"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
