<?php

namespace App\Http\Livewire\Bendahara\Transaksi;

use App\Models\Gunabayar;
use App\Models\KategoriPemasukan;
use App\Models\Kelas;
use App\Models\Pembayaran;
use App\Traits\GetData;
use Livewire\Component;

class PembayaranSiswa extends Component
{
    use GetData;

    //model
    public $tanggal;
    public $tahun;
    public $kelas;
    public $siswa;
    public $gunabayar;
    public $jumlah;
    public $kategori;
    public $is_edit;
    public $is_disabled;
    public $id_pembayaran;

    //array
    public $list_kelas = [];
    public $list_siswa = [];
    public $list_gunabayar = [];
    public $list_pembayaran = [];
    public $sumjumlah = [];
    public $list_tanggal = [];
    protected $rules =
    [
        'tanggal' => 'required',
        'tahun' => 'required',
        'kelas' => 'required',
        'siswa' => 'required',
        'gunabayar' => 'required',
        'jumlah' => 'required|numeric'
    ];
    protected $listeners = ['delete' => 'delete'];
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $this->get_list_pembayaran();
        $this->kategori = KategoriPemasukan::where('nama', 'SPP')->value('id');
        return view(
            'livewire.bendahara.transaksi.pembayaran-siswa',
            [
                'list_data_bayar' => Pembayaran::join('kategori_pemasukans', 'kategori_pemasukans.id', '=', 'pembayarans.kategori_pemasukan_id')
                    ->join('gunabayars', 'gunabayars.id', '=', 'pembayarans.gunabayar_id')
                    ->join('users as siswa', 'siswa.nis', '=', 'pembayarans.nis')
                    ->join('users as bendahara', 'bendahara.id', '=', 'pembayarans.user_id')
                    ->join('kelas', 'kelas.id', '=', 'pembayarans.kelas_id')
                    ->where('kategori_pemasukans.nama', '=', 'SPP')
                    ->select(
                        'pembayarans.id as id',
                        'pembayarans.tanggal as tanggal',
                        'pembayarans.tahun as tahun',
                        'pembayarans.jumlah as jumlah',
                        'gunabayars.nama as gunabayar',
                        'siswa.name as name',
                        'bendahara.name as bendahara',
                        'kelas.nama as kelas',
                    )
                    ->orderBy('pembayarans.created_at','desc')
                    ->take(10)
                    ->get()
            ]
        );
    }

    public function mount()
    {
        $this->tanggal = gmdate('Y-m-d');
        $this->get_tahun();
        $this->list_kelas = Kelas::get();
        $this->list_gunabayar = Gunabayar::orderBy('semester')->get();
    }

    public function updated($property)
    {
        $this->get_list_siswa();
        $this->get_list_pembayaran();
    }

    public function simpan()
    {
        $this->validate();
        try {
            if ($this->is_edit) {
                Pembayaran::updateOrCreate(
                    [
                        'id' => $this->id_pembayaran,
                        'tanggal' => $this->tanggal,
                        'tahun' => $this->tahun,
                        'kelas_id' => $this->kelas,
                        'nis' => $this->siswa,
                        'kategori_pemasukan_id' => $this->kategori,
                        'gunabayar_id' => $this->gunabayar,
                        'user_id' => auth()->user()->id,
                    ],
                    [
                        'jumlah' => $this->jumlah,
                    ]
                );
                $this->dispatchBrowserEvent(
                    'notyf',
                    [
                        'type' => 'success',
                        'message' => 'Berhasil Update Pembayaran'
                    ]
                );
                $this->resetExcept('list_gunabayar','tahun', 'tanggal','list_kelas');
            } else {
                Pembayaran::create(
                    [
                        'tanggal' => $this->tanggal,
                        'tahun' => $this->tahun,
                        'kelas_id' => $this->kelas,
                        'nis' => $this->siswa,
                        'kategori_pemasukan_id' => $this->kategori,
                        'gunabayar_id' => $this->gunabayar,
                        'jumlah' => $this->jumlah,
                        'user_id' => auth()->user()->id,
                    ]
                );
                $this->dispatchBrowserEvent(
                    'notyf',
                    [
                        'type' => 'success',
                        'message' => 'Berhasil Simpan Pembayaran'
                    ]
                );
                $this->reset('jumlah', 'gunabayar');
            }
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent(
                'notyf',
                [
                    'type' => 'error',
                    'message' => 'Koneksi Terputus, Silahkan Ulangi'
                ]
            );
        }
    }

    public function edit($id)
    {
        
        $this->is_edit = true;
        $this->is_disabled = 'disabled';
        $this->id_pembayaran = $id;
        $cari = Pembayaran::find($id);
        $this->tanggal = $cari->tanggal;
        $this->tahun = $cari->tahun;
        $this->kelas = $cari->kelas_id;
        $this->get_list_siswa();
        $this->siswa = $cari->nis;
        $this->gunabayar = $cari->gunabayar_id;
        $this->jumlah = $cari->jumlah;
    }
    public function batal()
    {
        $this->resetExcept('tahun','list_kelas', 'list_gunabayar','tanggal');
    }
    public function confirm($id)
    {
        $this->dispatchBrowserEvent('confirm', ['title' => 'Hapus Pembayaran Siswa', 'text' => 'Anda Yakin Menghapus Pembayaran Siswa ?', 'id' => $id]);
    }
    public function delete($id)
    {
        Pembayaran::find($id)->delete();
        $this->dispatchBrowserEvent('notyf', ['type' => 'error', 'message' => 'Berhasil Hapus Pembayaran Siswa']);
    }
    private function get_list_pembayaran()
    {
        $this->list_pembayaran = [];
        foreach ($this->list_gunabayar as $key => $gunabayar) {
            $jumlah = Pembayaran::where('tahun', $this->tahun)
                ->where('nis', $this->siswa)
                ->where('gunabayar_id', $gunabayar->id)
                ->sum('jumlah');
            $this->sumjumlah[$key] = $jumlah;
            $tanggal = Pembayaran::where('tahun', $this->tahun)
                ->where('nis', $this->siswa)
                ->where('gunabayar_id', $gunabayar->id)
                ->value('tanggal');
            $this->list_tanggal[$key] = $tanggal;
        }
    }
}
