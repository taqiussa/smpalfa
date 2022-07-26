<?php

namespace App\Http\Livewire\Siswa;

use App\Models\KurikulumMapel;
use App\Models\PenilaianRapor;
use App\Models\Siswa;
use App\Traits\GetData;
use Livewire\Component;

class Nilai extends Component
{
    use GetData;

    // model
    public $tahun;
    public $semester;
    public $kelas;
    public $tingkat;

    // array
    public $list_mata_pelajaran = [];
    public $list_penilaian = [];
    public function render()
    {
        return view('livewire.siswa.nilai');
    }
    public function mount()
    {
        $this->get_tahun();
        $this->get_semester();
        $this->tingkat = Siswa::where('tahun', $this->tahun)
        ->where('nis', auth()->user()->nis)
        ->value('tingkat');
        $this->list_penilaian = PenilaianRapor::where('tahun', $this->tahun)
        ->where('semester', $this->semester)
        ->with(['jenis_penilaian'])
        ->get();
        $this->list_mata_pelajaran = KurikulumMapel::where('tahun', $this->tahun)
        ->where('tingkat', $this->tingkat)
        ->with(['mapel'])
        ->get();
    }
}
