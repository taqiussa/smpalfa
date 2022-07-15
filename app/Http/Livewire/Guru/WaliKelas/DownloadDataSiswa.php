<?php

namespace App\Http\Livewire\Guru\WaliKelas;

use App\Exports\ExportDataSiswa;
use App\Models\Kelas;
use App\Traits\GetData;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class DownloadDataSiswa extends Component
{
    use GetData;
    // model
    public $tahun;
    public $kelas;

    // array
    public $list_kelas = [];
    public $list_siswa = [];

    protected $rules =
    [
        'tahun' => 'required',
        'kelas' => 'required'
    ];
    public function render()
    {
        return view('livewire.guru.wali-kelas.download-data-siswa');
    }
    public function mount()
    {
        $this->get_tahun();
        $this->list_kelas = Kelas::get();
    }
    public function updated($property)
    {
        $this->get_list_siswa();
    }
    public function hydrate()
    {
        $this->get_list_siswa();
    }
    public function downloadsiswa()
    {
        $this->validate();
        $nama_kelas = Kelas::find($this->kelas)->nama;
        return Excel::download(new ExportDataSiswa($this->tahun,$this->kelas), $nama_kelas . '.xlsx');
    }
}
