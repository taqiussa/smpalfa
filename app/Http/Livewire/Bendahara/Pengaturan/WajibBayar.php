<?php

namespace App\Http\Livewire\Bendahara\Pengaturan;

use App\Models\WajibBayar as ModelsWajibBayar;
use App\Traits\GetData;
use Livewire\Component;
use Livewire\WithPagination;

class WajibBayar extends Component
{
    use GetData;
    use WithPagination;

    //model
    public $tahun;
    public $jumlah;
    public $tingkat;
    public $is_edit = false;
    public $is_disabled;

    protected $rules = [
        'tahun' => 'required',
        'jumlah' => 'required|numeric',
        'tingkat' => 'required'
    ];

    protected $listeners = ['delete' => 'delete'];
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        return view(
            'livewire.bendahara.pengaturan.wajib-bayar',
            [
                'list_wajib_bayar' => ModelsWajibBayar::orderBy('tahun', 'desc')->paginate(3)
            ]
        );
    }
    public function mount()
    {
        $this->get_tahun();
    }
    public function simpan()
    {
        $this->validate();
        ModelsWajibBayar::updateOrCreate(
            [
                'tahun' => $this->tahun,
                'tingkat' => $this->tingkat
            ],
            ['jumlah' => $this->jumlah]
        );
        if ($this->is_edit) {
            $this->dispatchBrowserEvent(
                'notyf',
                [
                    'type' => 'success',
                    'message' => 'Berhasil Update Data Wajib Bayar'
                ]
            );
        } else {
            $this->dispatchBrowserEvent(
                'notyf',
                [
                    'type' => 'success',
                    'message' => 'Berhasil Simpan Data Wajib Bayar'
                ]
            );
        }
        $this->reset();
    }

    public function edit($id)
    {
        $this->is_edit = true;
        $this->is_disabled = 'disabled';
        $cari = ModelsWajibBayar::find($id);
        $this->tahun = $cari->tahun;
        $this->tingkat = $cari->tingkat;
        $this->jumlah = $cari->jumlah;
        
    }

    public function confirm($id)
    {
        $this->dispatchBrowserEvent(
            'confirm',
            [
                'title' => 'Menghapus Data Wajib Bayar',
                'text' => 'Anda Yakin Menghapus Data Ini ?',
                'id' => $id
            ]
        );
    }
    public function delete($id)
    {
        ModelsWajibBayar::find($id)->delete();
        $this->dispatchBrowserEvent(
            'notyf',
            [
                'type' => 'error',
                'message' => 'Berhasil Menghapus Data Wajib Bayar'
            ]
        );
    }
}
