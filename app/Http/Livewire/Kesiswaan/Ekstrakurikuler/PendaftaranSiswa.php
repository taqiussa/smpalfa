<?php

namespace App\Http\Livewire\Kesiswaan\Ekstrakurikuler;

use App\Models\Ekstrakurikuler;
use App\Models\Kelas;
use App\Models\SiswaEkstra;
use App\Traits\GetData;
use Livewire\Component;

class PendaftaranSiswa extends Component
{
    use GetData;

    // model
    public $tahun;
    public $siswa;
    public $kelas;
    public $ekstra;
    public $is_edit = false;
    public $id_ekstra;
    public $is_disabled = '';
    //array
    public $list_kelas = [];
    public $list_siswa = [];
    public $list_ekstra = [];
    public $list_siswa_ekstra = [];

    protected $rules = [
        'tahun' => 'required',
        'kelas' => 'required',
        'siswa' => 'required',
        'ekstra' => 'required'
    ];
    protected $listeners = ['delete' => 'delete'];
    public function render()
    {
        $this->get_siswa_ekstra();
        $this->list_ekstra = Ekstrakurikuler::orderBy('nama')->get();
        return view('livewire.kesiswaan.ekstrakurikuler.pendaftaran-siswa');
    }

    public function mount()
    {
        $this->get_tahun();
        $this->list_kelas = Kelas::get();
        $this->list_ekstra = Ekstrakurikuler::orderBy('nama')->get();
    }
    
    public function simpan()
    {
        $this->validate();
        try {
            if ($this->is_edit) {
                SiswaEkstra::createOrUpdate(
                    [
                        'tahun' => $this->tahun,
                        'kelas_id' => $this->kelas,
                        'nis' => $this->siswa
                    ],
                    [
                        'ekstrakurikuler_id' => $this->ekstra
                    ]
                );
                $this->dispatchBrowserEvent('notyf', ['type' => 'success', 'message' => 'Berhasil Update Daftar Ekstra Siswa']);
            } else {
                SiswaEkstra::create(
                    [
                        'tahun' => $this->tahun,
                        'kelas_id' => $this->kelas,
                        'nis' => $this->siswa,
                        'ekstrakurikuler_id' => $this->ekstra
                    ]
                );
                $this->dispatchBrowserEvent('notyf', ['type' => 'success', 'message' => 'Berhasil Simpan Daftar Ekstra Siswa ']);
            }
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('notyf', ['type' => 'error', 'message' => 'Koneksi Terputus,Silahkan ulangi']);
        }
        $this->resetExcept('list_kelas', 'tahun', 'list_ekstra');
    }
    public function edit($id)
    {
        $this->is_edit = true;
        $this->is_disabled = 'disabled';
        $this->id_ekstra = $id;
        $cari = SiswaEkstra::find($id);
        $this->siswa = $cari->nis;
        $this->kelas = $cari->kelas_id;
        $this->tahun = $cari->tahun;
        $this->ekstra = $cari->ekstrakurikuler_id;
    }
    public function confirm($id)
    {
        $this->dispatchBrowserEvent('confirm', ['title' => 'Hapus Data Ekstra', 'text' => 'Anda Yakin Menghapus Siswa dari Ekstra ?', 'id' => $id]);
    }
    public function delete($id)
    {
        try {
            SiswaEkstra::find($id)->delete();
            $this->dispatchBrowserEvent('notyf', ['type' => 'error', 'message' => 'Berhasil Menghapus Siswa']);
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('notyf', ['type' => 'error', 'message' => 'Koneksi Terputus,Silahkan ulangi']);
        }
    }
    public function updated($property)
    {
        $this->get_list_siswa();
        $this->get_siswa_ekstra();
    }
    public function get_siswa_ekstra()
    {
        $this->list_siswa_ekstra = SiswaEkstra::where('ekstrakurikuler_id', $this->ekstra)
            ->where('tahun', $this->tahun)
            ->with(
                [
                    'siswa',
                    'kelas',
                ]
            )
            ->get();
    }
}
