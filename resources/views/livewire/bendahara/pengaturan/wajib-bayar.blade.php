<div>
    <x-slot name="header">
        <h4>Wajib Bayar</h4>
    </x-slot>
    <div class="row my-2">
        <div class="col-md-8">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <form wire:submit.prevent="simpan">
                    <div class="row my-2">
                        <div class="col-md-4">
                            <label for="tahun" class="form-label">Tahun</label>
                            <select wire:model='tahun' id="tahun" class="form-select" {{ $is_disabled }}>
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
                            <label for="tingkat" class="form-label">Tingkat</label>
                            <select wire:model="tingkat" id="tingkat" class="form-select" {{ $is_disabled }}>
                                <option value="">Pilih Tingkat</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="jumlah" class="form-label">Wajib Bayar</label>
                            <input wire:model.defer="jumlah" type="number" class="form-control">
                            @error('jumlah')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Simpan <i wire:loading wire:target="simpan" class="fas fa-spin fa-spinner"></i></button>
                    </div>
                </form>
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
                                    <th>Tahun</th>
                                    <th>Tingkat</th>
                                    <th>Wajib Bayar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_wajib_bayar as $key => $list)
                                <tr>
                                    <td>{{ $list_wajib_bayar->firstItem() + $key }}</td>
                                    <td>{{ $list->tahun }}</td>
                                    <td>{{ $list->tingkat }}</td>
                                    <td>{{ 'Rp ' . number_format($list->jumlah, 2, ",", "."); }}</td>
                                    <td>
                                        <a wire:click.prevent="edit({{ $list->id }})" class="badge text-primary mx-2 my-2" role="button">
                                        <i class="fas fa-edit"></i>
                                        </a>
                                        <a wire:click.prevent="confirm({{ $list->id }})" class="badge text-danger mx-2 my-2" role="button">
                                        <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        {{ $list_wajib_bayar->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
