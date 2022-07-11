<?php

namespace App\Http\Livewire\Bendahara\Transaksi;

use App\Models\KategoriPengeluaran;
use App\Models\Pengeluaran as ModelsPengeluaran;
use App\Traits\GetData;
use Livewire\Component;


class Pengeluaran extends Component
{
    use GetData;

    //model
    public $tanggal;
    public $tahun;
    public $kategori;
    public $jumlah;
    public $keterangan;
    public $is_edit;
    public $is_disabled;
    public $id_pengeluaran;

    //array
    public $list_kategori = [];
    protected $rules =
    [
        'tanggal' => 'required',
        'tahun' => 'required',
        'kategori' => 'required',
        'jumlah' => 'required|numeric',
        'keterangan' => 'required'
    ];
    protected $listeners = ['delete' => 'delete'];
    public function render()
    {
        return view('livewire.bendahara.transaksi.pengeluaran',
    [
        'list_pengeluaran' => ModelsPengeluaran::join('kategori_pengeluarans', 'kategori_pengeluarans.id', '=' ,'pengeluarans.kategori_pengeluaran_id')
        ->join('users', 'users.id', '=', 'pengeluarans.user_id')
        ->select(
            'kategori_pengeluarans.nama as nama',
            'users.name as name',
            'pengeluarans.id as id',
            'pengeluarans.tahun as tahun',
            'pengeluarans.tanggal as tanggal',
            'pengeluarans.keterangan as keterangan',
            'pengeluarans.jumlah as jumlah'
        )
        ->orderBy('pengeluarans.created_at', 'desc')
        ->take(10)
        ->get()
    ]);
    }

    public function mount()
    {
        $this->tanggal = gmdate('Y-m-d');
        $this->get_tahun();
        $this->list_kategori = KategoriPengeluaran::orderBy('nama')->get();
    }

    public function simpan()
    {
        $this->validate();
        try {
            if ($this->is_edit) {
                ModelsPengeluaran::updateOrCreate(
                    [
                        'id' => $this->id_pengeluaran,
                        'kategori_pengeluaran_id' => $this->kategori,
                        'tahun' => $this->tahun,
                        'tanggal' => $this->tanggal,
                    ],
                    [
                        'keterangan' => $this->keterangan,
                        'jumlah' => $this->jumlah,
                        'user_id' => auth()->user()->id,
                    ]
                );
                $this->dispatchBrowserEvent(
                    'notyf',
                    [
                        'type' => 'success',
                        'message' => 'Berhasil Update pengeluaran'
                    ]
                );
            } else {
                ModelsPengeluaran::create(
                    [
                        'tanggal' => $this->tanggal,
                        'tahun' => $this->tahun,
                        'kategori_pengeluaran_id' => $this->kategori,
                        'keterangan' => $this->keterangan,
                        'jumlah' => $this->jumlah,
                        'user_id' => auth()->user()->id
                    ]
                );
                $this->dispatchBrowserEvent(
                    'notyf',
                    [
                        'type' => 'success',
                        'message' => 'Berhasil Simpan pengeluaran'
                    ]
                );
            }
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent(
                'notyf',
                [
                    'type' => 'error',
                    'message' => 'Koneksi Ke Server Terputus, Silahkan Ulangi'
                ]
            );
        }
        $this->resetExcept('list_kategori', 'tanggal', 'tahun');
    }

    public function edit($id)
    {
        $this->is_edit = true;
        $this->is_disabled = 'disabled';
        $cari = ModelsPengeluaran::find($id);
        $this->id_pengeluaran = $id;
        $this->tanggal = $cari->tanggal;
        $this->tahun = $cari->tahun;
        $this->kategori = $cari->kategori_pengeluaran_id;
        $this->keterangan = $cari->keterangan;
        $this->jumlah  = $cari->jumlah;
    }
    public function batal()
    {
        $this->resetExcept('list_kategori', 'tanggal', 'tahun');

    }
    public function confirm($id)
    {
        $this->dispatchBrowserEvent('confirm',['title' => 'Hapus Data pengeluaran', 'text' => 'Anda Yakin Hapus Data pengeluaran ?', 'id' => $id]);
    }
    public function delete($id)
    {
        ModelsPengeluaran::find($id)->delete();
        $this->dispatchBrowserEvent('notyf', ['type' => 'error', 'message' => 'Berhasil Menghapus Data pengeluaran']);
    }
}
