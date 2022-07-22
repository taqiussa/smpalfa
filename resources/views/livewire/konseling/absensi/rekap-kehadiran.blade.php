<div>
    <x-slot name="header">
        <h4>
            Rekap Kehadiran
        </h4>
    </x-slot>
    <div class="row my-2">
        <div class="col-md-6">
            <div class="card rounded-md border-end-0 border-top-0 border-bottom-0 border-4 border-primary">
                <div class="card-body">
                    <div class="row my-2">
                        <div class="col-md-4">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input wire:model="tanggal" type="date" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="jam" class="form-label">Jam</label>
                            <select wire:model="jam" id="jam" class="form-select">
                                <option value="">Pilih Jam</option>
                                <option value="1-2">1-2</option>
                                <option value="3-4">3-4</option>
                                <option value="5-6">5-6</option>
                                <option value="7-8">7-8</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="tahun" class="form-label">Tahun</label>
                            <select wire:model="tahun" id="tahun" class="form-select">
                                <option value="">Pilih Tahun</option>
                                @for ($i = 2017; $i < gmdate('Y'); $i++)
                                    <option value="{{ $i + 1 . ' / ' . ($i + 2) }}">{{ $i + 1 . ' / ' . ($i + 2) }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div>
                        <span wire:loading wire:target="tanggal">Memuat Data... <i
                                class="fas fa-spin fa-spinner"></i></span>
                        <span wire:loading wire:target="jam">Memuat Data... <i
                                class="fas fa-spin fa-spinner"></i></span>
                        <span wire:loading wire:target="tahun">Memuat Data... <i
                                class="fas fa-spin fa-spinner"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card my-2 rounded-md border-end-0 border-top-0 border-bottom-0 border-4 border-primary">
        <div class="card-body">
            <div class="row my-2">
                <div class="col-md-3">
                    <div class="icon-card mb-30">
                        <div class="icon success">
                            <i class="lni lni-users"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">Total Hadir</h6>
                            <h3 class="text-bold mb-10">{{ $hadir }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="icon-card mb-30">
                        <div class="icon orange">
                            <i class="lni lni-users"></i>
                        </div>
                        <a
                            href="{{ route('konseling.absensi.list-kehadiran', [
                                'tanggal' => $tanggal,
                                'jam' => $jam,
                                'kehadiran' => 'Sakit',
                            ]) }}">
                            <div class="content">
                                <h6 class="mb-10">Total Sakit</h6>
                                <h3 class="text-bold mb-10">{{ $sakit }}</h3>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="icon-card mb-30">
                        <div class="icon orange">
                            <i class="lni lni-users"></i>
                        </div>
                        <a
                            href="{{ route('konseling.absensi.list-kehadiran', [
                                'tanggal' => $tanggal,
                                'jam' => $jam,
                                'kehadiran' => 'Izin',
                            ]) }}">
                            <div class="content">
                                <h6 class="mb-10">Total Izin</h6>
                                <h3 class="text-bold mb-10">{{ $izin }}</h3>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="icon-card mb-30">
                        <div class="icon orange">
                            <i class="lni lni-users text-danger"></i>
                        </div>
                        <a
                            href="{{ route('konseling.absensi.list-kehadiran', [
                                'tanggal' => $tanggal,
                                'jam' => $jam,
                                'kehadiran' => 'Alpha',
                            ]) }}">
                            <div class="content">
                                <h6 class="mb-10">Total Alpha</h6>
                                <h3 class="text-bold mb-10">{{ $alpha }}</h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row my-2">
                <div class="col-md-3">
                    <div class="icon-card mb-30">
                        <div class="icon orange">
                            <i class="lni lni-users text-danger"></i>
                        </div>
                        <a
                            href="{{ route('konseling.absensi.list-kehadiran', [
                                'tanggal' => $tanggal,
                                'jam' => $jam,
                                'kehadiran' => 'Bolos',
                            ]) }}">
                            <div class="content">
                                <h6 class="mb-10">Total Bolos</h6>
                                <h3 class="text-bold mb-10">{{ $bolos }}</h3>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="icon-card mb-30">
                        <div class="icon">
                            <i class="lni lni-users text-black-50"></i>
                        </div>
                        <a
                            href="{{ route('konseling.absensi.list-kehadiran', [
                                'tanggal' => $tanggal,
                                'jam' => $jam,
                                'kehadiran' => 'Izin Pulang',
                            ]) }}">
                            <div class="content">
                                <h6 class="mb-10">Total Pulang</h6>
                                <h3 class="text-bold mb-10">{{ $pulang }}</h3>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="icon-card mb-30">
                        <div class="icon primary">
                            <i class="lni lni-users text-primary"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">Total Siswa</h6>
                            <h3 class="text-bold mb-10">{{ $siswa }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="icon-card mb-30">
                        <div class="icon primary">
                            <i class="lni lni-users text-primary"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">Total Absensi</h6>
                            <h3 class="text-bold mb-10">{{ $absensi }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
