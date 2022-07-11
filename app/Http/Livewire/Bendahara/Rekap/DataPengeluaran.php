<?php

namespace App\Http\Livewire\Bendahara\Rekap;

use App\Models\Pengeluaran;
use Livewire\Component;
use Livewire\WithPagination;

class DataPengeluaran extends Component
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
            'livewire.bendahara.rekap.data-pengeluaran',
            [
                'list_pengeluaran' => Pengeluaran::join('kategori_pengeluarans', 'kategori_pengeluarans.id', '=', 'pengeluarans.kategori_pengeluaran_id')
                    ->join('users', 'users.id', '=', 'pengeluarans.user_id')
                    ->select(
                        'kategori_pengeluarans.nama as kategori',
                        'users.name as name',
                        'pengeluarans.id as id',
                        'pengeluarans.tahun as tahun',
                        'pengeluarans.tanggal as tanggal',
                        'pengeluarans.keterangan as keterangan',
                        'pengeluarans.jumlah as jumlah'
                    )
                    ->where('pengeluarans.keterangan', 'like', '%' . $this->search . '%')
                    ->orWhere('kategori_pengeluarans.nama', 'like', '%' . $this->search . '%')
                    ->orderBy('pengeluarans.created_at', 'desc')
                    ->paginate(10),
            ]
        );
    }

    public function confirm($id)
    {
        $this->dispatchBrowserEvent('confirm', ['title' => 'Hapus Data pengeluaran', 'text' => 'Anda Yakin Menghapus Data ini ?', 'id' => $id]);
    }
    public function delete($id)
    {
        Pengeluaran::find($id)->delete();
        $this->dispatchBrowserEvent('notyf', ['type' => 'error', 'message' => 'Berhasil Hapus Data pengeluaran']);
    }
}
