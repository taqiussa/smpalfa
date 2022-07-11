<?php

namespace App\Http\Livewire\Bendahara\Rekap;

use App\Models\Pemasukan;
use Livewire\Component;
use Livewire\WithPagination;

class DataPemasukan extends Component
{
    use WithPagination;

    // model
    public $search;

    //array

    protected $listeners = ['delete' => 'delete'];
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        return view(
            'livewire.bendahara.rekap.data-pemasukan',
            [
                'list_pemasukan' => Pemasukan::join('kategori_pemasukans', 'kategori_pemasukans.id', '=', 'pemasukans.kategori_pemasukan_id')
                    ->join('users', 'users.id', '=', 'pemasukans.user_id')
                    ->select(
                        'kategori_pemasukans.nama as kategori',
                        'users.name as name',
                        'pemasukans.id as id',
                        'pemasukans.tahun as tahun',
                        'pemasukans.tanggal as tanggal',
                        'pemasukans.keterangan as keterangan',
                        'pemasukans.jumlah as jumlah'
                    )
                    ->where('pemasukans.keterangan', 'like', '%' . $this->search . '%')
                    ->orWhere('kategori_pemasukans.nama', 'like', '%' . $this->search . '%')
                    ->orderBy('pemasukans.created_at', 'desc')
                    ->paginate(10),
            ]
        );
    }

    public function confirm($id)
    {
        $this->dispatchBrowserEvent('confirm', ['title' => 'Hapus Data Pemasukan', 'text' => 'Anda Yakin Menghapus Data ini ?', 'id' => $id]);
    }
    public function delete($id)
    {
        Pemasukan::find($id)->delete();
        $this->dispatchBrowserEvent('notyf', ['type' => 'error', 'message' => 'Berhasil Hapus Data Pemasukan']);
    }
}
