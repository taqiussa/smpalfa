<div>
    <div class="row my-2">
        <div class="col-md-12">
            <div class="card shadow rounded-md border-top-0 border-bottom-0 border-end-0 border-3 border-primary">
                <div class="card-body">
                    <form wire:submit.prevent="simpan">
                        <div class="row my-2">
                            <div class="col-md-3 my-2">
                                <div class="input-group">
                                    <span class="input-group-text">Tahun</span>
                                    <select wire:model.defer="tahun" id="tahun" class="form-select">
                                        <option value="">Pilih Tahun</option>
                                        @for ($i = 2017; $i < gmdate('Y'); $i++)
                                            <option value="{{ $i + 1 . ' / ' . ($i + 2) }}">
                                                {{ $i + 1 . ' / ' . ($i + 2) }}</option>
                                        @endfor
                                    </select>
                                </div>
                                @error('tahun')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4 my-2">
                                <div class="input-group">
                                    <span class="input-group-text">Semester</span>
                                    <select wire:model.defer="semester" id="semester" class="form-select">
                                        <option value="">Pilih Semester</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>
                                @error('semester')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 my-2">
                                <div class="input-group">
                                    <span class="input-group-text">Tanggal</span>
                                    <input wire:model.defer="tanggal" type="date" class="form-control">
                                </div>
                                @error('tanggal')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-2 my-2">
                                <button wire:click.prevent="simpan" wire:loading.class="disabled"
                                    wire:target="simpan" class="btn btn-primary">Simpan <i wire:loading
                                        wire:target="simpan" class="fas fa-spin fa-spinner"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-10">
            <div class="card shadow rounded-md border-top-0 border-bottom-0 border-end-0 border-3 border-primary">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Semester</th>
                                    <th>Tanggal Rapor</th>
                                    <th>aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_tanggal as $key => $tanggal)
                                    <tr>
                                        <td>{{ $list_tanggal->firstItem() + $key }}</td>
                                        <td>{{ $tanggal->tahun }}</td>
                                        <td>{{ $tanggal->semester }}</td>
                                        <td>{{ \Carbon\Carbon::parse($tanggal->tanggal)->translatedFormat('d F Y') }}</td>
                                        <td>
                                            <a wire:click.prevent="confirm({{ $tanggal->id }})" class="badge text-danger" role="button"><i class="fas fa-trash-alt"></i></a>
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
    <div>
        {{ $list_tanggal->links() }}
    </div>
</div>
