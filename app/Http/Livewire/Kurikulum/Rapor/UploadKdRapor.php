<?php

namespace App\Http\Livewire\Kurikulum\Rapor;

use App\Exports\ExportKdRapor;
use App\Imports\ImportKdRapor;
use App\Models\JenisPenilaian;
use App\Models\KategoriNilai;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class UploadKdRapor extends Component
{
    use WithFileUploads;
    //model
    public $tahun;
    public $semester;
    public $tingkat;
    public $kategori_nilai_id;
    public $file_import;
    public $jenis_penilaian_id;

    //array
    public $list_kategori_nilai = [];
    public $list_jenis_penilaian = [];

    protected $rules = [
        'tahun' => 'required',
        'semester' => 'required',
        'tingkat' => 'required',
        'kategori_nilai_id' => 'required',
        'jenis_penilaian_id' => 'required'
    ];
    public function render()
    {
        return view('livewire.kurikulum.rapor.upload-kd-rapor');
    }

    public function mount()
    {
        $tahunIni = gmdate('Y');
        $bulanIni = gmdate('m');
        if ($bulanIni <= 6) {
            $this->tahun = (intval($tahunIni) - 1) . ' / ' . intval($tahunIni);
        } else {
            $this->tahun = intval($tahunIni) . ' / ' . (intval($tahunIni) + 1);
        }
        $this->list_kategori_nilai = KategoriNilai::get();
        $this->list_jenis_penilaian = JenisPenilaian::get();
    }

    public function exports()
    {
        $this->resetErrorBag();
        $this->validate();
        $nama_kategori = KategoriNilai::find($this->kategori_nilai_id)->nama;
        return Excel::download(new ExportKdRapor($this->tahun, $this->semester, $this->tingkat, $this->kategori_nilai_id, $this->jenis_penilaian_id), 'Kd-semester'. $this->semester. '-' . $this->tingkat . '-' . $nama_kategori . '.xlsx' );
    }

    public function imports()
    {
        $this->resetErrorBag();
        $this->validateOnly('file_import',['file_import' => 'required|mimes:xls,xlsx']);
        Excel::import(new ImportKdRapor(), $this->file_import);
        $this->dispatchBrowserEvent('notyf',
        [
            'type' => 'success',
            'message' => 'Berhasil Upload KD Rapor'
        ]);
        $this->resetExcept('list_jenis_penilaian', 'list_kategori_nilai');
    }
}
