<?php

namespace App\Http\Livewire\Kurikulum\MataPelajaran;

use App\Models\MataPelajaran;
use Livewire\Component;
use Livewire\WithPagination;

class TableMataPelajaran extends Component
{
    use WithPagination;

    //model
    public $show;
    public $id_edit;
    public $nama;
    public $kelompok;
    public $edit;
    public $is_edit;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'delete' => 'delete'
    ];
    protected $rules = [
        'nama' => 'required',
        'kelompok' => 'required'
    ];
    public function render()
    {
        return view(
            'livewire.kurikulum.mata-pelajaran.table-mata-pelajaran',
            [
                'list_mata_pelajaran' => MataPelajaran::orderBy('kelompok')->orderBy('nama')->paginate(10)
            ]
        );
    }

    public function edit($id)
    {
        $this->is_edit = true;
        $this->show = true;
        $this->id_edit = $id;
        $mapel = MataPelajaran::find($id);
        $this->nama = $mapel->nama;
        $this->kelompok = $mapel->kelompok;
    }
    public function batal()
    {
        $this->reset();
    }
    public function simpan()
    {
        $this->validate();
        MataPelajaran::updateOrCreate(
            [
                'id' => $this->id_edit
            ],
            [
                'nama' => $this->nama,
                'kelompok' => $this->kelompok,
            ]
        );
        if($this->is_edit){
            $this->dispatchBrowserEvent('notyf', [
                'type' => 'success',
                'message' => 'Berhasil Ubah Data Mata Pelajaran'
            ]);
        } else {
            $this->dispatchBrowserEvent('notyf', [
                'type' => 'success',
                'message' => 'Berhasil Menambah Data Mata Pelajaran'
            ]);
        }
        $this->reset();
    }

    public function confirm($id)
    {
        $this->dispatchBrowserEvent('confirm', [
            'title' => 'Hapus Mata Pelajaran',
            'text' => 'Anda Yakin Menghapus Data Mata Pelajaran ?',
            'id' => $id
        ]);
    }

    public function delete($id)
    {
        MataPelajaran::find($id)->delete();
        $this->dispatchBrowserEvent('notyf', [
            'type' => 'error',
            'message' => 'Berhasil Hapus Mata Pelajaran'
        ]);
    }
}
