<div>
    <x-slot name="header">
        Cek Kehadiran Siswa
    </x-slot>
    <div class="col-md-3">
        <a href="{{ route('konseling.absensi.rekap-kehadiran') }}" role="button" class="btn btn-primary w-auto"><i
                class="lni lni-chevron-left"></i> Kembali</a>
    </div>
    <div class="row my-2">
        <div class="col-md-6">
            <div class="card rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <div class="row my-2">
                        <div class="col-md-4">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input wire:model="tanggal" type="date" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="jam" class="form-label">Jam</label>
                            <select wire:model="jam" id="jam" class="form-select">
                                <option value="1-2">1-2</option>
                                <option value="3-4">3-4</option>
                                <option value="5-6">5-6</option>
                                <option value="7-8">7-8</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="kehadiran" class="form-label">Kehadiran</label>
                            <select wire:model="kehadiran" id="kehadiran" class="form-select">
                                <option value="">Pilih Kehadiran</option>
                                @foreach ($list_kehadiran as $kehadiran)
                                    <option value="{{ $kehadiran->nama }}">{{ $kehadiran->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <span wire:loading wire:target="jam">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                        <span wire:loading wire:target="tanggal">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                        <span wire:loading wire:target="kehadiran">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-8">
            <div class="card rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($total as $siswa)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $siswa->name }}
                                        </td>
                                        <td>
                                            {{ $siswa->nama }}
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
