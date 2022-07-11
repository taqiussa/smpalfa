<?php

namespace App\Http\Livewire\Bendahara\Pengaturan;

use App\Models\KategoriPengeluaran as ModelsKategoriPengeluaran;
use Livewire\Component;
use Livewire\WithPagination;


class KategoriPengeluaran extends Component
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
            'livewire.bendahara.pengaturan.kategori-pengeluaran',
            [
                'list_kategori' => ModelsKategoriPengeluaran::orderBy('nama')->paginate(10)
            ]
        );
    }

    public function simpan()
    {
        $this->validate(['kategori' => 'required']);
        if ($this->is_edit) {
            ModelsKategoriPengeluaran::updateOrCreate(
                [
                    'id' => $this->id_kategori
                ],
                [
                    'nama' => $this->kategori
                ]
            );
            $this->dispatchBrowserEvent('notyf', ['type' => 'success', 'message' => 'Berhasil Update Kategori']);
        } else {
            ModelsKategoriPengeluaran::create(['nama' => $this->kategori]);
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
        $this->kategori = ModelsKategoriPengeluaran::find($id)->nama;
    }
    public function confirm($id)
    {
        $this->dispatchBrowserEvent('confirm', ['title' => 'Hapus Kategori', 'text' => 'Anda Yakin Hapus Kategori ?' , 'id' => $id]);
    }
    public function delete($id)
    {
        ModelsKategoriPengeluaran::find($id)->delete();
        $this->dispatchBrowserEvent('notyf', ['type' => 'error', 'message' => 'Berhasil Menghapus Kategori']);
    }
}
