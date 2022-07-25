<?php

namespace App\Http\Livewire\Bendahara\Rekap;

use App\Models\Pemasukan;
use App\Models\Pembayaran;
use Livewire\Component;
use Livewire\WithPagination;

class RekapHarian extends Component
{
    use WithPagination;

    //model
    public $tanggalawal;
    public $tanggalakhir;
    public $subtotal_pembayaran;
    public $subtotal_pemasukan;
    public $total;

    //array
    // public $list_pembayaran = [];
    // public $list_pemasukan = [];
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.bendahara.rekap.rekap-harian',
    [
        'list_pembayaran' => Pembayaran::whereBetween('tanggal', [$this->tanggalawal, $this->tanggalakhir])
        ->with(['siswa', 'bendahara', 'gunabayar'])
        ->orderBy('created_at', 'desc')
        ->paginate(5),
        'list_pemasukan' => Pemasukan::whereBetween('tanggal', [$this->tanggalawal, $this->tanggalakhir])
        ->with(['kategori', 'user'])
        ->orderBy('created_at', 'desc')
        ->paginate(5),
    ]);
    }

    public function mount()
    {
        $this->tanggalawal = gmdate('Y-m-d');
        $this->tanggalakhir = gmdate('Y-m-d');
        $this->get_list_pembayaran();
        $this->get_list_pemasukan();
        $this->total = $this->subtotal_pembayaran + $this->subtotal_pemasukan;
    }
    
    public function updated($property)
    {
        $this->get_list_pembayaran();
        $this->get_list_pemasukan();
        $this->total = $this->subtotal_pembayaran + $this->subtotal_pemasukan;
    }

    public function download()
    {
        
    }
    private function get_list_pembayaran()
    {
        // $this->list_pembayaran = Pembayaran::join('gunabayars', 'gunabayars.id', '=', 'pembayarans.gunabayar_id')
        // ->join('kelas', 'kelas.id', '=', 'pembayarans.kelas_id')
        // ->join('users as siswa', 'siswa.nis', '=', 'pembayarans.nis')
        // ->join('users as bendahara', 'bendahara.id', '=', 'pembayarans.user_id')
        // ->select(
        //     'pembayarans.id as id',
        //     'pembayarans.tanggal as tanggal',
        //     'pembayarans.tahun as tahun',
        //     'pembayarans.jumlah as jumlah',
        //     'kelas.nama as kelas',
        //     'gunabayars.nama as gunabayar',
        //     'siswa.name as siswa',
        //     'bendahara.name as bendahara',
        // )
        // ->whereBetween('pembayarans.tanggal', [$this->tanggalawal, $this->tanggalakhir])
        // ->orderBy('pembayarans.created_at', 'desc')
        // ->get();
        $this->subtotal_pembayaran = Pembayaran::whereBetween('tanggal', [$this->tanggalawal, $this->tanggalakhir])->sum('jumlah');
    }
    private function get_list_pemasukan()
    {
        // $this->list_pemasukan = Pemasukan::join('kategori_pemasukans', 'kategori_pemasukans.id', '=', 'pemasukans.kategori_pemasukan_id')
        // ->join('users', 'users.id', '=', 'pemasukans.user_id')
        // ->select(
        //     'pemasukans.id as id',
        //     'pemasukans.tanggal as tanggal',
        //     'pemasukans.tahun as tahun',
        //     'pemasukans.jumlah as jumlah',
        //     'pemasukans.keterangan as keterangan',
        //     'kategori_pemasukans.nama as kategori',
        //     'users.name as bendahara',
        // )
        // ->whereBetween('pemasukans.tanggal', [$this->tanggalawal, $this->tanggalakhir])
        // ->orderBy('pemasukans.created_at', 'desc')
        // ->get();
        $this->subtotal_pemasukan = Pemasukan::whereBetween('tanggal', [$this->tanggalawal, $this->tanggalakhir])->sum('jumlah');
    }
}
