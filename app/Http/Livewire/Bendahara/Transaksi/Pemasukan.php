<?php

namespace App\Http\Livewire\Bendahara\Transaksi;

use App\Models\KategoriPemasukan;
use App\Models\Pemasukan as ModelsPemasukan;
use App\Traits\GetData;
use Livewire\Component;

class Pemasukan extends Component
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
    public $id_pemasukan;

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
        return view('livewire.bendahara.transaksi.pemasukan',
    [
        'list_pemasukan' => ModelsPemasukan::join('kategori_pemasukans', 'kategori_pemasukans.id', '=' ,'pemasukans.kategori_pemasukan_id')
        ->join('users', 'users.id', '=', 'pemasukans.user_id')
        ->where('kategori_pemasukans.nama', '!=', 'SPP')
        ->select(
            'kategori_pemasukans.nama as nama',
            'users.name as name',
            'pemasukans.id as id',
            'pemasukans.tahun as tahun',
            'pemasukans.tanggal as tanggal',
            'pemasukans.keterangan as keterangan',
            'pemasukans.jumlah as jumlah'
        )
        ->orderBy('pemasukans.created_at', 'desc')
        ->take(10)
        ->get()
    ]);
    }

    public function mount()
    {
        $this->tanggal = gmdate('Y-m-d');
        $this->get_tahun();
        $this->list_kategori = KategoriPemasukan::where('nama', '!=', 'SPP')->get();
    }

    public function simpan()
    {
        $this->validate();
        try {
            if ($this->is_edit) {
                ModelsPemasukan::updateOrCreate(
                    [
                        'id' => $this->id_pemasukan,
                        'kategori_pemasukan_id' => $this->kategori,
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
                        'message' => 'Berhasil Update Pemasukan'
                    ]
                );
            } else {
                ModelsPemasukan::create(
                    [
                        'tanggal' => $this->tanggal,
                        'tahun' => $this->tahun,
                        'kategori_pemasukan_id' => $this->kategori,
                        'keterangan' => $this->keterangan,
                        'jumlah' => $this->jumlah,
                        'user_id' => auth()->user()->id
                    ]
                );
                $this->dispatchBrowserEvent(
                    'notyf',
                    [
                        'type' => 'success',
                        'message' => 'Berhasil Simpan Pemasukan'
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
        $cari = ModelsPemasukan::find($id);
        $this->id_pemasukan = $id;
        $this->tanggal = $cari->tanggal;
        $this->tahun = $cari->tahun;
        $this->kategori = $cari->kategori_pemasukan_id;
        $this->keterangan = $cari->keterangan;
        $this->jumlah  = $cari->jumlah;
    }
    public function batal()
    {
        $this->resetExcept('list_kategori', 'tanggal', 'tahun');

    }
    public function confirm($id)
    {
        $this->dispatchBrowserEvent('confirm',['title' => 'Hapus Data Pemasukan', 'text' => 'Anda Yakin Hapus Data Pemasukan ?', 'id' => $id]);
    }
    public function delete($id)
    {
        ModelsPemasukan::find($id)->delete();
        $this->dispatchBrowserEvent('notyf', ['type' => 'error', 'message' => 'Berhasil Menghapus Data Pemasukan']);
    }
}
