<?php

namespace App\Http\Livewire\Guru\WaliKelas;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\SiswaEkstra;
use App\Traits\GetData;
use Livewire\Component;

class DataEkstraSiswa extends Component
{
    use GetData;

    // model
    public $tahun;
    public $kelas;
    
    // array
    public $list_kelas = [];
    public $list_siswa = [];
    public function render()
    {
        return view('livewire.guru.wali-kelas.data-ekstra-siswa');
    }

    public function mount()
    {
        $this->get_tahun();
        $this->list_kelas = Kelas::get();
    }
    public function download()
    {
        
    }
    public function updated($property)
    {
        $this->list_siswa = [];
        $this->list_siswa = Siswa::where('tahun', $this->tahun)
        ->where('kelas_id', $this->kelas)
        ->with(['user','ekstra'])
        ->get()
        ->sortBy('user.name');
    }
    public function hydrate()
    {
        $this->list_siswa = [];
        $this->list_siswa = Siswa::where('tahun', $this->tahun)
        ->where('kelas_id', $this->kelas)
        ->with(['user','ekstra'])
        ->get()
        ->sortBy('user.name');
    }
}
