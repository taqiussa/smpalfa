<?php

namespace App\Http\Livewire\Bendahara\Rekap;

use App\Models\Pembayaran;
use App\Models\Transaksi;
use Livewire\Component;
use Livewire\WithPagination;

class DataPembayaran extends Component
{
    use WithPagination;

    // model
    public $search;

    protected $listeners = ['delete' => 'delete'];
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        return view('livewire.bendahara.rekap.data-pembayaran',
    [
        'list_pembayaran' => Transaksi::join('users as siswa', 'siswa.nis', '=', 'transaksis.nis')
        ->join('users as bendahara', 'bendahara.id', '=', 'transaksis.user_id')
        ->join('kelas', 'kelas.id', '=', 'transaksis.kelas_id')
        ->select(
            'transaksis.id as id',
            'transaksis.tanggal as tanggal',
            'transaksis.tahun as tahun',
            'transaksis.jumlah as jumlah',
            'siswa.name as siswa',
            'siswa.nis as nis',
            'bendahara.name as bendahara',
            'kelas.nama as kelas',
            'kelas.tingkat as tingkat'
        )
        ->where('siswa.name', 'like', '%'. $this->search . '%')
        ->orderBy('transaksis.created_at', 'desc')
        ->paginate(10),
        // 'list_pembayaran' => Pembayaran::join('gunabayars', 'gunabayars.id', '=', 'pembayarans.gunabayar_id')
        // ->join('users as siswa', 'siswa.nis', '=', 'pembayarans.nis')
        // ->join('users as bendahara', 'bendahara.id', '=', 'pembayarans.user_id')
        // ->join('kelas', 'kelas.id', '=', 'pembayarans.kelas_id')
        // ->select(
        //     'pembayarans.id as id',
        //     'pembayarans.tanggal as tanggal',
        //     'pembayarans.tahun as tahun',
        //     'pembayarans.jumlah as jumlah',
        //     'gunabayars.nama as gunabayar',
        //     'siswa.name as siswa',
        //     'siswa.nis as nis',
        //     'bendahara.name as bendahara',
        //     'kelas.nama as kelas'
        // )
        // ->where('siswa.name', 'like', '%'. $this->search . '%')
        // ->orderBy('pembayarans.created_at', 'desc')
        // ->paginate(10)
    ]);
    }

    public function confirm($id)
    {
        $this->dispatchBrowserEvent('confirm', ['title' => 'Hapus Data Pembayaran', 'text' => 'Anda Yakin Menghapus Data ini ?', 'id' => $id]);
    }
    public function delete($id)
    {
        Pembayaran::find($id)->delete();
        $this->dispatchBrowserEvent('notyf', ['type' => 'error', 'message' => 'Berhasil Hapus Data Pembayaran']);
    }
}
