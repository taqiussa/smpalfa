<?php

namespace App\Http\Livewire\TataUsaha\Siswa;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use App\Traits\GetData;
use Livewire\Component;

class AturKelasSiswa extends Component
{
    use GetData;

    //model
    public $nis;
    public $kelas;
    public $tahun;

    // array
    public $list_kelas = [];
    public $list_siswa = [];

    protected $rules = [
        'nis' => 'required',
        'kelas' => 'required',
        'tahun' => 'required',
    ];
    public function render()
    {
        return view('livewire.tata-usaha.siswa.atur-kelas-siswa');
    }
    public function mount()
    {
        $this->get_tahun();
        $this->list_kelas = Kelas::get();
        $cek_siswa = Siswa::where('tahun', $this->tahun)->pluck('nis');
        $this->list_siswa = User::whereNotIn('nis', $cek_siswa)->get();
    }
    public function updated($property)
    {
        $cek_siswa = Siswa::where('tahun', $this->tahun)->pluck('nis');
        $this->list_siswa = User::whereNotIn('nis', $cek_siswa)->get();
    }
    public function hydrate()
    {
        $cek_siswa = Siswa::where('tahun', $this->tahun)->pluck('nis');
        $this->list_siswa = User::whereNotIn('nis', $cek_siswa)->get();
    }
    public function atur($nis)
    {
        $this->nis = $nis;
    }
    public function batal()
    {
        $this->nis = '';
    }
    public function simpan()
    {
        $tingkat = Kelas::find($this->kelas)->tingkat;
        try {
            Siswa::create(
                [
                    'nis' => $this->nis,
                    'kelas_id' => $this->kelas,
                    'tahun' => $this->tahun,
                    'tingkat' => $tingkat
                ]
                );
                $this->dispatchBrowserEvent('notyf', ['type' => 'success', 'message' => 'Berhasil Atur Kelas Siswa']);
            } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('notyf', ['type' => 'error', 'message' => 'Koneksi terputus, ulangi']);
        }
        $this->nis = '';
        $this->kelas = '';
        $cek_siswa = Siswa::where('tahun', $this->tahun)->pluck('nis');
        $this->list_siswa = User::whereNotIn('nis', $cek_siswa)->get();
    }
}
