<?php

namespace App\Http\Livewire\Bendahara\Pengaturan;

use App\Models\KategoriPemasukan as ModelsKategoriPemasukan;
use Livewire\Component;
use Livewire\WithPagination;

class KategoriPemasukan extends Component
{
    use WithPagination;

    //model
    public $kategori;
    public $is_edit;
    public $id_kategori;

    protected $listeners = ['delete' => 'delete'];
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        return view(
            'livewire.bendahara.pengaturan.kategori-pemasukan',
            [
                'list_kategori' => ModelsKategoriPemasukan::orderBy('nama')->paginate(10)
            ]
        );
    }

    public function simpan()
    {
        $this->validate(['kategori' => 'required']);
        if ($this->is_edit) {
            ModelsKategoriPemasukan::updateOrCreate(
                [
                    'id' => $this->id_kategori
                ],
                [
                    'nama' => $this->kategori
                ]
            );
            $this->dispatchBrowserEvent('notyf', ['type' => 'success', 'message' => 'Berhasil Update Kategori']);
        } else {
            ModelsKategoriPemasukan::create(['nama' => $this->kategori]);
            $this->dispatchBrowserEvent('notyf', ['type' => 'success', 'message' => 'Berhasil Simpan Kategori']);
        }
        $this->reset();
    }
    public function batal()
    {
        $this->reset();
    }
    public function edit($id)
    {
        $this->is_edit = true;
        $this->id_kategori = $id;
        $this->kategori = ModelsKategoriPemasukan::find($id)->nama;
    }
    public function confirm($id)
    {
        $this->dispatchBrowserEvent('confirm', ['title' => 'Hapus Kategori', 'text' => 'Anda Yakin Hapus Kategori ?' , 'id' => $id]);
    }
    public function delete($id)
    {
        ModelsKategoriPemasukan::find($id)->delete();
        $this->dispatchBrowserEvent('notyf', ['type' => 'error', 'message' => 'Berhasil Menghapus Kategori']);
    }
}
