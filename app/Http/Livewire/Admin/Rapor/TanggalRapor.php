<?php

namespace App\Http\Livewire\Admin\Rapor;

use App\Models\TanggalRapor as ModelsTanggalRapor;
use Livewire\Component;
use Livewire\WithPagination;

class TanggalRapor extends Component
{
    use WithPagination;
    //model 
    public $tanggal;
    public $tahun;
    public $semester;

    //array

    protected $paginationTheme = 'bootstrap';
    protected $rules = [
        'tanggal' => 'required',
        'tahun' => 'required',
        'semester' => 'required'
    ];
    protected $listeners = [
        'delete' => 'delete'
    ];
    public function render()
    {

        return view(
            'livewire.admin.rapor.tanggal-rapor',
            [
                'list_tanggal' => ModelsTanggalRapor::orderBy('tahun', 'desc')->paginate(5)
            ]
        );
    }

    public function mount()
    {

        $this->tanggal = gmdate('Y-m-d');
        $tahunIni = gmdate('Y');
        $bulanIni = gmdate('m');
        if ($bulanIni <= 6) {
            $this->tahun = (intval($tahunIni) - 1) . ' / ' . intval($tahunIni);
        } else {
            $this->tahun = intval($tahunIni) . ' / ' . (intval($tahunIni) + 1);
        }
    }

    public function simpan()
    {
        $this->validate();
        ModelsTanggalRapor::create(
            [
                'tanggal' => $this->tanggal,
                'tahun' => $this->tahun,
                'semester' => $this->semester
            ]
            );
        $this->dispatchBrowserEvent('notyf', [
            'type' => 'success',
            'message' => 'Berhasil Mengatur Tanggal Rapor'
        ]);
    }

    public function confirm($id)
    {
        $this->dispatchBrowserEvent('confirm',
        [
            'title' => 'Menghapus Tanggal Rapor',
            'text' => 'Anda Yakin Menghapus Data Tanggal Rapor ?',
            'id' => $id
        ]);
    }
    public function delete($id)
    {
        ModelsTanggalRapor::find($id)->delete();
        $this->dispatchBrowserEvent('notyf', [
            'type' => 'error',
            'message' => 'Berhasil Menghapus Data Tanggal Rapor'
        ]);
    }
}
