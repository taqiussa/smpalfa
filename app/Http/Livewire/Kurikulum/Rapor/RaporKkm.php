<?php

namespace App\Http\Livewire\Kurikulum\Rapor;

use App\Models\Kkm as ModelsKkm;
use App\Models\MataPelajaran;
use Livewire\Component;
use Livewire\WithPagination;

class RaporKkm extends Component
{
    use WithPagination;

    //model
    public $mata_pelajaran;
    public $tingkat;
    public $tahun;
    public $kkm;

    //array
    public $list_mata_pelajaran = [];

    protected $paginationTheme = 'bootstrap';
    protected $rules = [
        'mata_pelajaran' => 'required',
        'tingkat' => 'required',
        'tahun' => 'required',
        'kkm' => 'required|numeric'
    ];
    protected $listeners = [
        'delete' => 'delete'
    ];
    public function render()
    {
        return view(
            'livewire.kurikulum.rapor.rapor-kkm',
            [

                // 'list_kkm' => ModelsKkm::with(['mapel' =>
                // fn ($query) =>
                // $query->orderBy('nama')])
                //     ->orderBy('tahun', 'desc')
                //     ->orderBy('tingkat')
                //     ->paginate(10)
                'list_mapel' => MataPelajaran::with(['kkm' => fn ($query) => $query->where('tahun', $this->tahun)])->orderBy('kelompok')->paginate(10)
            ]
        );
    }

    public function mount()
    {
        $this->list_mata_pelajaran = MataPelajaran::orderBy('kelompok')->get();
        $tahunIni = gmdate('Y');
        $bulanIni = gmdate('m');
        if ($bulanIni <= 6) {
            $this->tahun = (intval($tahunIni) - 1) . ' / ' . intval($tahunIni);
        } else {
            $this->tahun = intval($tahunIni) . ' / ' . (intval($tahunIni) + 1);
        }
    }
    public function updated($property)
    {
        $this->get_mata_pelajaran();
    }
    public function confirm($id)
    {
        $this->dispatchBrowserEvent(
            'confirm',
            [
                'title' => 'Menghapus KKM',
                'text' => 'Anda Yakin Menghapus Nilai KKM ?',
                'id' => $id
            ]
        );
    }
    public function delete($id)
    {
        ModelsKkm::find($id)->delete();
        $this->dispatchBrowserEvent(
            'notyf',
            [
                'type' => 'error',
                'message' => 'Berhasil Menghapus Nilai KKM'
            ]
        );
    }
    public function simpan()
    {
        $this->validate();
        ModelsKkm::create([
            'mata_pelajaran_id' => $this->mata_pelajaran,
            'tahun' => $this->tahun,
            'tingkat' => $this->tingkat,
            'kkm' => $this->kkm
        ]);
        $this->dispatchBrowserEvent('notyf', [
            'type' => 'success',
            'message' => 'Berhasil Mengatur Nilai KKM',
        ]);
        $this->resetExcept('tahun', 'list_mata_pelajaran');
    }
    private function get_mata_pelajaran()
    {
        $id_kkm = ModelsKkm::where('tingkat', $this->tingkat)->where('tahun', $this->tahun)->pluck('mata_pelajaran_id');
        $this->list_mata_pelajaran = MataPelajaran::whereNotIn('id', $id_kkm)->orderBy('kelompok')->get();
    }
}
