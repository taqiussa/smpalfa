<?php

namespace App\Http\Livewire\Admin\Rapor;

use Livewire\Component;
use App\Models\JenisPenilaian;
use App\Models\KategoriNilai;
use App\Models\MataPelajaran;
use App\Models\Kd as ModelsKd;
use Livewire\WithPagination;
class Kd extends Component
{
    use WithPagination;
    
    //model
    public $id_kd;
    public $tahun;
    public $tahuntable;
    public $tingkat;
    public $semester;
    public $mata_pelajaran;
    public $kategori_nilai;
    public $jenis_penilaian;
    public $deskripsi;
    public $is_edit;
    public $show;

    //array
    public $list_mata_pelajaran = [];
    public $list_kategori_nilai = [];
    public $list_jenis_penilaian = [];

    protected $paginationTheme = 'bootstrap';
    protected $rules = [
        'mata_pelajaran' => 'required',
        'tingkat' => 'required',
        'tahun' => 'required',
        'semester' => 'required',
        'kategori_nilai' => 'required',
        'jenis_penilaian' => 'required',
        'deskripsi' => 'required'
    ];
    protected $listeners = [
        'delete' => 'delete'
    ];
    public function render()
    {
        return view(
            'livewire.admin.rapor.kd',
            [
                'list_kd' => ModelsKd::joins($this->tahuntable)->paginate(4)
            ]
        );
    }

    public function mount()
    {
        $this->list_mata_pelajaran = MataPelajaran::orderBy('nama')->get();
        $this->list_kategori_nilai = KategoriNilai::get();
        $this->list_jenis_penilaian = JenisPenilaian::get();
        $tahunIni = gmdate('Y');
        $bulanIni = gmdate('m');
        if ($bulanIni <= 6) {
            $this->tahun = (intval($tahunIni) - 1) . ' / ' . intval($tahunIni);
            $this->tahuntable = (intval($tahunIni) - 1) . ' / ' . intval($tahunIni);
        } else {
            $this->tahun = intval($tahunIni) . ' / ' . (intval($tahunIni) + 1);
            $this->tahuntable = intval($tahunIni) . ' / ' . (intval($tahunIni) + 1);
        }
    }

    public function confirm($id)
    {
        $this->dispatchBrowserEvent(
            'confirm',
            [
                'title' => 'Menghapus KD',
                'text' => 'Anda Yakin Menghapus Deskripsi KD ?',
                'id' => $id
            ]
        );
    }
    public function delete($id)
    {
        ModelsKd::find($id)->delete();
        $this->dispatchBrowserEvent(
            'notyf',
            [
                'type' => 'error',
                'message' => 'Berhasil Menghapus Deskripsi KD'
            ]
        );
    }
    public function edit($id)
    {
        $this->show = true;
        $this->is_edit = true;
        $this->id_kd = $id;
        $kd = ModelsKd::find($id);
        $this->tahun = $kd->tahun;
        $this->tingkat = $kd->tingkat;
        $this->semester = $kd->semester;
        $this->mata_pelajaran = $kd->mata_pelajaran_id;
        $this->kategori_nilai = $kd->kategori_nilai_id;
        $this->jenis_penilaian = $kd->jenis_penilaian_id;
        $this->deskripsi = $kd->deskripsi;
    }
    public function batal()
    {
        $this->resetExcept(['tahun', 'list_mata_pelajaran', 'list_kategori_nilai', 'list_jenis_penilaian']);
    }
    public function simpan()
    {
        $this->validate();
        if ($this->is_edit) {
            ModelsKd::updateOrCreate(
                ['id' => $this->id_kd],
                [
                    'mata_pelajaran_id' => $this->mata_pelajaran,
                    'tingkat' => $this->tingkat,
                    'kategori_nilai_id' => $this->kategori_nilai,
                    'jenis_penilaian_id' => $this->jenis_penilaian,
                    'tahun' => $this->tahun,
                    'semester' => $this->semester,
                    'deskripsi' => $this->deskripsi,
                ]
            );
            $this->dispatchBrowserEvent('notyf', [
                'type' => 'success',
                'message' => 'Berhasil Update Data KD'
            ]);
        } else {
            ModelsKd::create([
                'mata_pelajaran_id' => $this->mata_pelajaran,
                'tingkat' => $this->tingkat,
                'kategori_nilai_id' => $this->kategori_nilai,
                'jenis_penilaian_id' => $this->jenis_penilaian,
                'tahun' => $this->tahun,
                'semester' => $this->semester,
                'deskripsi' => $this->deskripsi,
            ]);
            $this->dispatchBrowserEvent('notyf', [
                'type' => 'success',
                'message' => 'Berhasil Menyimpan Data KD'
            ]);
        }
        $this->resetExcept(['tahun', 'list_mata_pelajaran', 'list_kategori_nilai', 'list_jenis_penilaian']);
    }
}
