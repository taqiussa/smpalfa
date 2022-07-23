<?php

namespace App\Http\Livewire\Guru\Alquran;

use App\Models\JenisAlquran;
use App\Models\KategoriAlquran;
use App\Models\Kelas;
use App\Models\PenilaianAlquran;
use App\Models\User;
use App\Traits\GetData;
use Livewire\Component;

class InputNilai extends Component
{
    use GetData;

    //model
    public $tanggal;
    public $tahun;
    public $kelas;
    public $siswa;
    public $kategori;
    public $jenis;
    public $nilai;
    public $is_edit = false;
    public $is_disabled;
    public $id_jenis;

    //array
    public $list_kelas = [];
    public $list_siswa = [];
    public $list_kategori = [];
    public $list_jenis = [];
    public $list_tanggal = [];
    public $list_nilai = [];
    public $list_guru = [];

    protected $rules = [
        'tanggal' => 'required',
        'tahun' => 'required',
        'kelas' => 'required',
        'siswa' => 'required',
        'nilai' => 'required',
        'kategori' => 'required',
        'jenis' => 'required'
    ];

    protected $listeners = [
        'delete' => 'delete',
        'refresh' => '$refresh'
    ];
    public function render()
    {
        $this->tanggal = gmdate('Y-m-d');
        return view('livewire.guru.alquran.input-nilai');
    }

    public function mount()
    {
        $this->get_tahun();
        $this->list_kelas = Kelas::get();
        $this->list_kategori = KategoriAlquran::get();
    }

    // public function updated($property)
    // {
    //     $this->list_siswa = [];
    //     $this->get_list_siswa();
    //     $this->list_jenis = [];
    //     $this->list_jenis = JenisAlquran::where('kategori_alquran_id', $this->kategori)->get();
    //     $this->get_nilai();
    // }
    public function hydrate()
    {
        $this->list_siswa = [];
        $this->get_list_siswa();
        $this->list_jenis = [];
        $this->list_jenis = JenisAlquran::where('kategori_alquran_id', $this->kategori)->get();
        $this->get_nilai();
    }
    public function updatedTahun()
    {
        $this->list_siswa = [];
        $this->get_list_siswa();
        $this->list_jenis = [];
        $this->list_jenis = JenisAlquran::where('kategori_alquran_id', $this->kategori)->get();
        $this->get_nilai();
    }
    public function updatedKelas()
    {
        $this->list_siswa = [];
        $this->siswa = '';
        $this->get_list_siswa();
        $this->list_jenis = [];
        $this->list_jenis = JenisAlquran::where('kategori_alquran_id', $this->kategori)->get();
        $this->get_nilai();
    }
    public function updatedSiswa()
    {
        $this->get_list_siswa();
        $this->list_jenis = [];
        $this->list_jenis = JenisAlquran::where('kategori_alquran_id', $this->kategori)->get();
        $this->get_nilai();
    }
    public function updatedKategori()
    {
        $this->get_list_siswa();
        $this->list_jenis = [];
        $this->list_jenis = JenisAlquran::where('kategori_alquran_id', $this->kategori)->get();
        $this->get_nilai();
    }
    public function simpan()
    {
        $this->validate();
        try {
            if ($this->is_edit) {
                PenilaianAlquran::updateOrCreate(
                    [
                        'nis' => $this->siswa,
                        'kategori_alquran_id' => $this->kategori,
                        'jenis_alquran_id' => $this->jenis
                    ],
                    [
                        'nilai' => $this->nilai,
                        'user_id' => auth()->user()->id
                    ]
                );
                $this->dispatchBrowserEvent('notyf', ['type' => 'success', 'message' => 'Berhasil Update Nilai Alquran']);
            } else {
                PenilaianAlquran::create([
                    'tanggal' => $this->tanggal,
                    'nis' => $this->siswa,
                    'kelas_id' => $this->kelas,
                    'tahun' => $this->tahun,
                    'kategori_alquran_id' => $this->kategori,
                    'jenis_alquran_id' => $this->jenis,
                    'nilai' => $this->nilai,
                    'user_id' => auth()->user()->id
                ]);
                $this->dispatchBrowserEvent('notyf', ['type' => 'success', 'message' => 'Berhasil Simpan Nilai Alquran']);
            }
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('notyf', ['type' => 'error', 'message' => 'Koneksi Terputus, Ulangi']);
        }
        $this->emitSelf('refresh');
    }
    public function get_nilai()
    {
            foreach ($this->list_jenis as $key => $jenis) {
                $cari = PenilaianAlquran::where('nis', $this->siswa)
                    ->where('jenis_alquran_id', $jenis->id)
                    ->first();
                $this->list_nilai[$key] = $cari->nilai ?? '';
                $this->list_tanggal[$key] = $cari->tanggal ?? '';
                $user = User::find($cari->user_id ?? '');
                $this->list_guru[$key] = $user->name ?? '';
            }
    }
}
