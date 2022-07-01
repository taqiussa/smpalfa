<?php

namespace App\Http\Livewire\Admin\Kurikulum;

use App\Models\Kurikulum;
use Livewire\Component;
use Livewire\WithPagination;

class TableKurikulum extends Component
{
    use WithPagination;

    //Model 
    public $show;
    public $nama;
    public $id_edit;
    public $is_edit;

    protected $listeners = [
        'delete' => 'delete'
    ];
    protected $rules = [
        'nama' => 'required'
    ];

    public function render()
    {
        return view('livewire.admin.kurikulum.table-kurikulum', [
            'list_kurikulum' => Kurikulum::latest()->paginate(5)
        ]);
    }

    public function edit($id)
    {
        $this->show = true;
        $this->is_edit = true;
        $this->id_edit = $id;
        $kurikulum = Kurikulum::find($id);
        $this->nama = $kurikulum->nama;
    }

    public function batal()
    {
        $this->reset();
    }

    public function simpan()
    {
        $this->validate();
        Kurikulum::updateOrCreate(
            [
                'id' => $this->id_edit
            ],
            [
                'nama' => $this->nama
            ]
        );
        if ($this->is_edit) {
            $this->dispatchBrowserEvent('notyf', [
                'type' => 'success',
                'message' => 'Berhasil Ubah Data Kurikulum'
            ]);
        } else {
            $this->dispatchBrowserEvent('notyf', [
                'type' => 'success',
                'message' => 'Berhasil Simpan Data Kurikulum'
            ]);
        }
        $this->reset();
    }

    public function confirm($id)
    {
        $this->dispatchBrowserEvent('confirm', [
            'title' => 'Hapus Kurikulum',
            'text' => 'Anda Yakin Hapus Data Kurikulum ?',
            'id' => $id
        ]);
    }

    public function delete($id)
    {
        Kurikulum::find($id)->delete();
        $this->dispatchBrowserEvent(
            'notyf',
            [
                'type' => 'success',
                'message' => 'Berhasil Hapus Data Kurikulum'
            ]
        );
    }
}
