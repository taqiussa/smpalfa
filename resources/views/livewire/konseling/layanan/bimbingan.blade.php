<div>
    <x-slot name="header">
        <h4>Bimbingan dan Konseling</h4>
    </x-slot>
    <div class="card rounded-md">
        <div class="card-body">
            <form wire:submit.prevent="simpan">
                @csrf
                <div class="row my-2">
                    <div class="col-md-4">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input wire:model="tanggal" type="date" id="tanggal" class="form-control">
                        @error('tanggal')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="jenis_bimbingan" class="form-label">Jenis Bimbingan</label>
                        <select wire:model.defer="jenis_bimbingan" id="jenis_bimbingan" class="form-select">
                            <option value="">Pilih Jenis Bimbingan</option>
                            <option value="Belajar">Belajar</option>
                            <option value="Karir">Karir</option>
                            <option value="Pribadi">Pribadi</option>
                            <option value="Sosial">Sosial</option>
                        </select>
                        @error('jenis_bimbingan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="bentuk_bimbingan" class="form-label">Bentuk Bimbingan</label>
                        <select wire:model="bentuk_bimbingan" id="bentuk_bimbingan" class="form-select">
                            <option value="">Pilih Bentuk Bimbingan</option>
                            <option value="Individu">Individu</option>
                            <option value="Kelompok">Kelompok</option>
                            <option value="Kelas">Kelas</option>
                        </select>
                        @error('bentuk_bimbingan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                @switch($bentuk_bimbingan)
                    @case('Individu')
                        <div class="row my-2">
                            <label class="form-label text-bold fs-4">INDIVIDU</label>
                            <div class="col-md-4">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select wire:model="kelas" id="kelas" class="form-select">
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($list_kelas as $kelas)
                                        <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kelas')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
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
                                @error('tahun')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="siswa" class="form-label">Siswa</label>
                                <select wire:model.defer="siswa" id="siswa" class="form-select">
                                    <option value="">Pilih Siswa</option>
                                    @foreach ($list_siswa as $siswa)
                                        <option value="{{ $siswa->nis }}">{{ $siswa->name }}</option>
                                    @endforeach
                                </select>
                                @error('siswa')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="row my-2">
                            <div class="col-md-12">
                                <label for="karakter" class="form-label">Karakter Individual Siswa</label>
                                <input wire:model.defer="karakter" type="text" class="form-control">
                            </div>
                        </div> --}}
                    @break

                    @case('Kelompok')
                        <label class="form-label text-bold fs-4">KELOMPOK</label>
                        <div class="row my-2">
                            <div class="col-md-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select wire:model="kelas" id="kelas" class="form-select">
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($list_kelas as $kelas)
                                        <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kelas')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
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
                            <div class="col-md-4">
                                <label for="siswa" class="form-label">Siswa</label>
                                <select wire:model.defer="siswa" id="siswa" class="form-select">
                                    <option value="">Pilih Siswa</option>
                                    @foreach ($list_siswa as $siswa)
                                        <option value="{{ $siswa->nis }}">{{ $siswa->name }}</option>
                                    @endforeach
                                </select>
                                @error('siswa')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">&nbsp;</label>
                                <button wire:click.prevent="tambah" class="btn btn-primary form-control">
                                    Tambah
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kelas</th>
                                        <th>Nama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kelompok_siswa as $key => $siswa)
                                        <tr>
                                            <td>
                                                <div>
                                                    <input wire:model="kelompok_siswa.{{ $key }}.id_kelas"
                                                        type="hidden">
                                                    <input wire:model="kelompok_siswa.{{ $key }}.nama_kelas"
                                                        type="text" class="form-control-plaintext">
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <input wire:model="kelompok_siswa.{{ $key }}.nis_siswa"
                                                        type="hidden">
                                                    <input wire:model="kelompok_siswa.{{ $key }}.nama_siswa"
                                                        type="text" class="form-control-plaintext">
                                                </div>
                                            </td>
                                            <td>
                                                <button wire:click.prevent="hapus({{ $key }})" class="btn btn-danger"><i
                                                        class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @break

                    @case('Kelas')
                        <label class="form-label text-bold fs-4">1 KELAS</label>
                        <div class="row my-2">
                            <div class="col-md-4">
                                <label class="form-label">Kelas</label>
                                <select wire:model.defer="kelas" class="form-select">
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($list_kelas as $kelas)
                                        <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kelas')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="tahun" class="form-label">Tahun</label>
                                <select wire:model.defer="tahun" id="tahun" class="form-select">
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
                        </div>
                    @break

                    @default
                @endswitch
                <div class="row my-2">
                    <div class="col-md-6">
                        <label for="permasalahan" class="form-label">Permasalahan</label>
                        <textarea wire:model.defer="permasalahan" id="permasalahan" cols="30" rows="3" class="form-control"></textarea>
                        @error('permasalahan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="penyelesaian" class="form-label">Penyelesaian</label>
                        <textarea wire:model.defer="penyelesaian" id="penyelesaian" cols="30" rows="3" class="form-control"></textarea>
                        @error('penyelesaian')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-md-12">
                        <label for="tindak_lanjut" class="form-label">Tindak Lanjut</label>
                        <textarea wire:model.defer="tindak_lanjut" id="tindak_lanjut" cols="30" rows="3" class="form-control"></textarea>
                    </div>
                    @error('tindak_lanjut')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="row my-2">
                    <div class="col-md-6 my-1">
                        <label for="foto" class="form-label">Foto</label>
                        <div class="input-group">
                            <input wire:model="foto" type="file" class="form-control">
                            <button wire:click.prevent="$set('foto','')" class="input-group-text">Batal</button>
                        </div>
                        <div wire:loading wire:target="foto">
                            Uploading...
                        </div>
                        @error('foto')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    @if ($foto)
                        <div class="col-md-6 my-1">
                            <img src="{{ $foto->temporaryUrl() }}" alt="foto" class="img img-thumbnail">
                        </div>
                    @endif
                </div>
                <div class="row my-2">
                    <div class="col-md-6 my-1">
                        <label for="foto_dokumen" class="form-label">Foto Dokumen</label>
                        <div class="input-group">
                            <input wire:model="foto_dokumen" type="file" class="form-control">
                            <button wire:click.prevent="$set('foto_dokumen','')" class="input-group-text">Batal</button>
                        </div>
                        <div wire:loading wire:target="foto_dokumen">
                            Uploading...
                        </div>
                        @error('foto_dokumen')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    @if ($foto_dokumen)
                        <div class="col-md-6 my-1">
                            <img src="{{ $foto_dokumen->temporaryUrl() }}" alt="foto_dokumen"
                                class="img img-thumbnail">
                        </div>
                    @endif
                </div>
                <div class="row my-2 px-3 justify-content-end">
                    <button wire:loading.class="disabled" wire:click.prevent="simpan" class="btn btn-primary w-auto" type="submit">Simpan
                        <i wire:loading wire:target="simpan" class="fas fa-spinner fa-spin"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
