<div>
    <x-slot name="header">
        <h4>Rekap Bimbingan dan Konseling</h4>
    </x-slot>
    <div class="card rounded-md">
        <div class="card-body">
            <div class="row my-2">
                {{-- <div class="col-md-4">
                    <label for="mulai" class="form-label">Tanggal Mulai</label>
                    <input wire:model="mulai" type="date" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="akhir" class="form-label">Tanggal Akhir</label>
                    <input wire:model="akhir" type="date" class="form-control">
                </div> --}}
                <div class="col-md-3">
                    <label for="tahun" class="form-label">Tahun</label>
                    <select wire:model='tahun' id="tahun" class="form-select">
                        <option value="">Pilih Tahun</option>
                        @for ($i = 2017; $i < gmdate('Y'); $i++)
                            <option value="{{ $i + 1 . ' / ' . ($i + 2) }}">{{ $i + 1 . ' / ' . ($i + 2) }}</option>
                        @endfor
                    </select>
                    @error('tahun')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="search" class="form-label">Search</label>
                    <input wire:model.debounce.500ms="search" type="text" class="form-control">
                </div>
            </div>
            <div>
                <span wire:loading wire:target="tahun">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                <span wire:loading wire:target="search">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Kelas</th>
                            <th>Nama</th>
                            <th>Bentuk Bimbingan</th>
                            <th>Permasalahan</th>
                            <th>Tindak Lanjut</th>
                            <th>Guru Bk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_rekap as $key => $rekap)
                        <tr>
                            <td>
                                {{ $list_rekap->firstItem() + $key }}    
                            </td>
                            <td>{{ date('d M Y',strtotime($rekap->tanggal)) }}</td>
                            <td>
                                {{ $rekap->kelas }}
                            </td>
                            <td>
                                {{ $rekap->siswa }}
                            </td>
                            <td>{{ $rekap->bentuk_bimbingan }}</td>
                            <td>{{ $rekap->permasalahan }}</td>
                            <td>{{ $rekap->tindak_lanjut }}</td>
                            <td>{{ $rekap->guru->name }}</td>
                            <td class="text-nowrap">
                                <a href="{{ route('konseling.layanan.detail-bimbingan', $rekap->slug) }}" class="btn btn-primary mx-1 my-1" role="button">Detail</a>
                                <button wire:click.prevent="confirm({{ $rekap->id }})" class="btn btn-danger mx-1 my-1">Hapus</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row my-2">
                <div>
                    {{ $list_rekap->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
