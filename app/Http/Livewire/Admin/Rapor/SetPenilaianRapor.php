<?php

namespace App\Http\Livewire\Admin\Rapor;

use App\Models\JenisPenilaian;
use App\Models\KategoriNilai;
use App\Models\PenilaianRapor;
use Livewire\Component;

class SetPenilaianRapor extends Component
{
    //model
    public $tahun;
    public $semester;
    public $kategori_nilai_id;
    public $jenis_penilaian_id;

    //array
    public $list_kategori_nilai = [];
    public $list_jenis_penilaian = [];
    public $list_rapor = [];

    protected $rules = [
        'tahun' => 'required',
        'semester' => 'required',
        'kategori_nilai_id' => 'required',
        'jenis_penilaian_id' => 'required'
    ];

    protected $listeners =
    [
        'delete' => 'delete'
    ];
    public function render()
    {
        $this->list_rapor = PenilaianRapor::where('tahun', $this->tahun)->where('semester', $this->semester)->with(['kategori', 'jenis_penilaian'])->get();
        return view('livewire.admin.rapor.set-penilaian-rapor');
    }

    public function mount()
    {
        $tahunIni = gmdate('Y');
        $bulanIni = gmdate('m');
        if ($bulanIni <= 6) {
            $this->tahun = (intval($tahunIni) - 1) . ' / ' . intval($tahunIni);
            $this->semester = 2;
        } else {
            $this->tahun = intval($tahunIni) . ' / ' . (intval($tahunIni) + 1);
            $this->semester = 1;
        }
        $this->list_kategori_nilai = KategoriNilai::get();
        $this->list_jenis_penilaian = JenisPenilaian::get();
    }

    public function simpan()
    {
        $this->validate();
        PenilaianRapor::create([
            'tahun' => $this->tahun,
            'semester' => $this->semester,
            'kategori_nilai_id' => $this->kategori_nilai_id,
            'jenis_penilaian_id' => $this->jenis_penilaian_id
        ]);
        $this->dispatchBrowserEvent('notyf',
        [
            'type' => 'success',
            'message' => 'Berhasil Mengatur Penilaian Rapor'
        ]);
    }

    public function confirm($id)
    {
        $this->dispatchBrowserEvent('confirm',
        [
            'title' => 'Menghapus Settingan Rapor',
            'text' => 'Anda Yakin Menghapus Settingan Penilaian Rapor ?',
            'id' => $id
        ]);
    }
    
    public function delete($id)
    {
        PenilaianRapor::find($id)->delete();
        $this->dispatchBrowserEvent('notyf',
        [
            'type' => 'error',
            'message' => 'Berhasil Mengapus Settingan Nilai'
        ]
        );
    }
}
