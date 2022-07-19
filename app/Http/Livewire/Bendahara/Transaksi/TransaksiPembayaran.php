<?php

namespace App\Http\Livewire\Bendahara\Transaksi;

use App\Models\Siswa;
use App\Traits\GetData;
use Livewire\Component;
use App\Models\Gunabayar;
use App\Models\Pembayaran;
use App\Models\Transaksi;
use App\Models\WajibBayar;

class TransaksiPembayaran extends Component
{
    use GetData;

    //model
    public $siswa;
    public $tahun;
    public $tanggal;
    public $tingkat;
    public $kelas;
    public $nis;
    public $total = 0;
    public $format_total = 0;

    //array
    public $list_siswa = [];
    public $data_siswa = [];
    public $list_transaksi = [];
    public $list_pembayaran = [];
    public $list_data_pembayaran = [];
    public $list_gunabayar = [];
    public $list_jumlah = [];
    public $list_tanggal = [];
    public $list_bendahara = [];
    public function render()
    {
        return view('livewire.bendahara.transaksi.transaksi-pembayaran');
    }
    public function mount()
    {
        $this->tanggal = gmdate('Y-m-d');
        $this->get_tahun();
        $this->list_siswa = Siswa::where('tahun', $this->tahun)->with(['user', 'kelas'])->get();
        $this->list_gunabayar = Gunabayar::orderBy('semester')->get();
    }

    public function simpan()
    {
        try {
            $trans = Transaksi::create(
                [
                    'tanggal' => $this->tanggal,
                    'tahun' => $this->tahun,
                    'tingkat' => $this->tingkat,
                    'nis' => $this->siswa,
                    'kelas_id' => $this->kelas,
                    'jumlah' => $this->total,
                    'user_id' => auth()->user()->id
                ]
            );
            foreach ($this->list_transaksi as $key => $transaksi) {
                $trans->pembayarans()->create(
                    [
                        'tanggal' => $this->tanggal,
                        'tahun' => $this->tahun,
                        'tingkat' => $this->tingkat,
                        'nis' => $this->siswa,
                        'kelas_id' => $this->kelas,
                        'kategori_pemasukan_id' => 1,
                        'gunabayar_id' => $transaksi['gunabayar_id'],
                        'jumlah' => $transaksi['jumlah'],
                        'user_id' => auth()->user()->id
                    ]
                );
            }
            $this->dispatchBrowserEvent('notyf', ['type' => 'success', 'message' => 'Berhasil Simpan Pembayaran']);
            $this->get_data_pembayaran();
            $this->reset('list_transaksi','total','format_total');
            $this->get_list_pembayaran();
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('notyf', ['type' => 'error', 'message' => 'Koneksi Terputus, Ulangi']);
        }
    }

    public function updated($property)
    {
        // $this->nis = $this->siswa;
        $this->get_data_siswa();
        $this->get_list_pembayaran();
        $this->get_data_pembayaran();
    }
    public function hydrate()
    {
        // $this->nis = $this->siswa;
        $this->get_data_siswa();
        $this->get_list_pembayaran();
        $this->get_data_pembayaran();
    }
    // public function pilih()
    // {
    //     $this->nis = $this->siswa;
    //     $this->get_data_siswa();
    //     $this->get_list_pembayaran();
    // }
    public function tambah($id)
    {
        $this->tingkat = Siswa::where('nis', $this->siswa)
            ->where('tahun', $this->tahun)
            ->value('tingkat');
        $this->kelas = Siswa::where('nis', $this->siswa)
            ->where('tahun', $this->tahun)
            ->value('kelas_id');
        $wajibbayar = WajibBayar::where('tingkat', $this->tingkat)->where('tahun', $this->tahun)->value('jumlah');
        $jumlah = $wajibbayar / 12;
        $format_jumlah = 'Rp ' . number_format($jumlah, 0, ",", ".");
        $gunabayar = Gunabayar::find($id)->nama;
        $this->list_transaksi[] = [
            'gunabayar_id' => $id,
            'gunabayar' => $gunabayar,
            'jumlah' => $jumlah,
            'format_jumlah' => $format_jumlah
        ];
        $this->total = array_sum(array_column($this->list_transaksi, 'jumlah'));
        $this->format_total = 'Rp ' . number_format($this->total, 0, ",", ".");
    }
    public function hapus($key)
    {
        unset($this->list_transaksi[$key]);
        $this->list_transaksi = array_values($this->list_transaksi);
        $this->total = array_sum(array_column($this->list_transaksi, 'jumlah'));
        $this->format_total = 'Rp ' . number_format($this->total, 0, ",", ".");
    }
    private function get_data_siswa()
    {
        $this->data_siswa = Siswa::where('nis', $this->siswa)->where('tahun', $this->tahun)
            ->with(
                [
                    'user',
                    'kelas',
                    'alamat'
                ]
            )
            ->get();
    }
    private function get_list_pembayaran()
    {
        $this->list_pembayaran = [];
        foreach ($this->list_gunabayar as $key => $gunabayar) {
            $jumlah = Pembayaran::where('tahun', $this->tahun)
                ->where('nis', $this->siswa)
                ->where('gunabayar_id', $gunabayar->id)
                ->sum('jumlah');
            $this->list_jumlah[$key] = $jumlah;
            $tanggal = Pembayaran::where('tahun', $this->tahun)
                ->where('nis', $this->siswa)
                ->where('gunabayar_id', $gunabayar->id)
                ->value('tanggal');
            $this->list_tanggal[$key] = $tanggal;
            $bendahara =  Pembayaran::where('pembayarans.tahun', $this->tahun)
                ->where('pembayarans.nis', $this->siswa)
                ->where('pembayarans.gunabayar_id', $gunabayar->id)
                ->join('users', 'users.id', '=', 'pembayarans.user_id')
                ->value('users.name');
            $this->list_bendahara[$key] = $bendahara;
        }
    }
    private function get_data_pembayaran()
    {
        $this->list_data_pembayaran = [];
        $this->list_data_pembayaran = Transaksi::join('users as siswa', 'siswa.nis', '=', 'transaksis.nis')
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
        ->where('transaksis.nis', $this->siswa)
        ->where('transaksis.tahun', $this->tahun)
        ->orderBy('transaksis.created_at', 'desc')
        ->get();
    }
}
