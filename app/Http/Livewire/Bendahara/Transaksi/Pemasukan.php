<?php

namespace App\Http\Livewire\Bendahara\Transaksi;

use App\Models\JenisPemasukan;
use App\Models\Kelas;
use App\Models\Pemasukan as ModelsPemasukan;
use App\Traits\GetData;
use Livewire\Component;

class Pemasukan extends Component
{
    use GetData;

    //model
    public $tanggal;
    public $tahun;
    public $kelas;
    public $siswa;
    public $pemasukan;
    public $jumlah;

    //array
    public $list_kelas = [];
    public $list_siswa = [];
    public $list_pemasukan = [];
    public $list_pembayaran = [];

    protected $rules =
    [
        'tanggal' => 'required',
        'tahun' => 'required',
        'kelas' => 'required',
        'siswa' => 'required',
        'pemasukan' => 'required',
        'jumlah' => 'required|numeric'
    ];
    public function render()
    {
        return view('livewire.bendahara.transaksi.pemasukan');
    }

    public function mount()
    {
        $this->tanggal = gmdate('Y-m-d');
        $this->get_tahun();
        $this->list_kelas = Kelas::get();
        $this->list_pemasukan = JenisPemasukan::orderBy('semester')->get();
    }

    public function updated($property)
    {
        $this->get_list_siswa();
        $this->get_list_pembayaran();
    }

    public function simpan()
    {
        $this->validate();
        ModelsPemasukan::create(
            [
                'tanggal' => $this->tanggal,
                'tahun' => $this->tahun,
                'kelas_id' => $this->kelas,
                'nis' => $this->siswa,
                'jenis_pemasukan_id' => $this->pemasukan,
                'jumlah' => $this->jumlah,
            ]
        );
        $this->dispatchBrowserEvent('notyf',
        [
            'type' => 'success',
            'message' => 'Berhasil Simpan Pembayaran'
        ]);
        $this->reset('jumlah', 'pemasukan');
    }

    private function get_list_pembayaran()
    {
        $this->list_pembayaran = [];
        $this->list_pembayaran = ModelsPemasukan::where('tahun', $this->tahun)
                                                    ->where('nis', $this->siswa)
                                                    ->join('jenis_pemasukans', 'jenis_pemasukans.id', '=', 'pemasukans.jenis_pemasukan_id')
                                                    ->select(
                                                        'pemasukans.id as id',
                                                        'pemasukans.tahun as tahun',
                                                        'pemasukans.tanggal as tanggal',
                                                        'pemasukans.jenis_pemasukan_id as jenis_pemasukan_id',
                                                        'pemasukans.jumlah as jumlah',
                                                        'jenis_pemasukans.nama as pembayaran',
                                                    )
                                                    ->get();
    }
}
