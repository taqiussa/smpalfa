<?php

namespace App\Http\Livewire\Sarpras\Inventaris;

use App\Models\Sarpras;
use Livewire\Component;
use Livewire\WithPagination;

class DataInventaris extends Component
{
    use WithPagination;
    
    //model
    public $show;
    public $nama, $kode, $kategori, $ruang, $keterangan, $jumlah;

    
    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'delete' => 'delete'
    ];
    protected $rules = [
        'nama' => 'required',
        'kode' => 'required|unique:sarpras',
        'kategori' => 'required',
        'ruang' => 'required',
        'keterangan' => 'required',
        'jumlah' => 'required',
    ];
    public function render()
    {
        return view('livewire.sarpras.inventaris.data-inventaris',
    [
        'list_barang' => Sarpras::orderBy('nama')->paginate(10)
    ]);
    }

    public function confirm($id)
    {
        $this->dispatchBrowserEvent('confirm',[
            'title' => 'Hapus Data Barang',
            'text' => 'Anda Yakin Menghapus Data Barang Ini ?',
            'id' => $id
        ]);
    }
    public function delete($id)
    {
        Sarpras::find($id)->delete();
        $this->dispatchBrowserEvent('notyf',[
            'type' => 'error',
            'message' => 'Berhasil Menghapus Data Barang'
        ]);
    }
    public function simpan()
    {
        $this->validate();
        Sarpras::create([
            'nama' => $this->nama,
            'kode' => $this->kode,
            'kategori' => $this->kategori,
            'ruang' => $this->ruang,
            'keterangan' => $this->keterangan,
            'jumlah' => $this->jumlah
        ]);
        $this->nama = '';
        $this->kode = '';
        $this->kategori = '';
        $this->ruang = '';
        $this->keterangan = '';
        $this->jumlah = '';
        $this->dispatchBrowserEvent('notyf',
        [
            'type' => 'success',
            'message' => 'Berhasil Simpan Data Inventaris'
        ]);
    }
}
