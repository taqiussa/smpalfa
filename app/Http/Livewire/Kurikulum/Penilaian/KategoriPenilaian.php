<?php

namespace App\Http\Livewire\Kurikulum\Penilaian;

use App\Models\KategoriNilai;
use Livewire\Component;

class KategoriPenilaian extends Component
{
    //model
    public $kategori;
    public $id_kategori = '';
    public $is_edit;

    //array
    public $list_kategori = [];

    protected $listeners =
    [
        'delete' => 'delete'
    ];
    protected $rules =
    [
        'kategori' => 'required'
    ];
    public function render()
    {
        $this->list_kategori = KategoriNilai::get();
        return view('livewire.kurikulum.penilaian.kategori-penilaian');
    }

    public function mount()
    {
        $this->list_kategori = KategoriNilai::get();
    }
    public function edit($id)
    {
        $this->is_edit = true;
        $this->id_kategori = $id;
        $kategori = KategoriNilai::find($id);
        $this->kategori = $kategori->nama;
    }
    public function simpan()
    {
        $this->validate();
        if ($this->is_edit) {

            KategoriNilai::updateOrCreate(
                [
                    'id' => $this->id_kategori
                ],
                [
                    'nama' => $this->kategori
                ]
            );
        } else {
            KategoriNilai::create(['nama' => $this->kategori]);
        }
        $this->dispatchBrowserEvent(
            'notyf',
            [
                'type' => 'success',
                'message' => 'Berhasil Menyimpan Kategori Nilai'
            ]
        );
        $this->reset();
    }
    public function confirm($id)
    {
        $this->dispatchBrowserEvent(
            'confirm',
            [
                'title' => 'Menghapus Kategori',
                'text' => 'Anda Yakin Menghapus Kategori ?',
                'id' => $id
            ]
        );
    }

    public function delete($id)
    {
        KategoriNilai::find($id)->delete();
        $this->dispatchBrowserEvent(
            'notyf',
            [
                'type' => 'success',
                'message' => 'Berhasil Menghapus Kategori'
            ]
        );
    }
}
