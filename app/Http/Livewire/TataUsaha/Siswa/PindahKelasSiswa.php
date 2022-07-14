<?php

namespace App\Http\Livewire\TataUsaha\Siswa;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Traits\GetData;
use Livewire\Component;

class PindahKelasSiswa extends Component
{
    use GetData;

    // model
    public $tahun;
    public $kelas;
    public $siswa;
    public $kelas_tujuan;

    //array
    public $list_kelas = [];
    public $list_siswa = [];

    protected $rules = [
        'tahun' => 'required',
        'kelas' => 'required',
        'siswa' => 'required',
        'kelas_tujuan' => 'required',
    ];
    public function render()
    {
        return view('livewire.tata-usaha.siswa.pindah-kelas-siswa');
    }
    public function mount()
    {
        $this->get_tahun();
        $this->list_kelas = Kelas::get();
    }
    
    public function updated($property)
    {
        $this->list_siswa = [];
        $this->get_list_siswa();
    }
    
    public function pindah()
    {
        $this->validate();
        try {
            Siswa::where('tahun', $this->tahun)
            ->where('nis', $this->siswa)
            ->update(['kelas_id' => $this->kelas_tujuan]);
            $this->dispatchBrowserEvent('notyf', ['type' => 'success', 'message' => 'Berhasil Memindah Siswa']);
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('notyf', ['type' => 'error', 'message' => 'Koneksi Terputus, Ulangi Lagi']);
        }
        $this->resetExcept('list_kelas','tahun');
    }
}
