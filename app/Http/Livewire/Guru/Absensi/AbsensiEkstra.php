<?php

namespace App\Http\Livewire\Guru\Absensi;

use App\Models\AbsensiEkstra as ModelsAbsensiEkstra;
use App\Models\Kelas;
use App\Traits\GetData;
use Livewire\Component;
use App\Models\Ekstrakurikuler;
use App\Models\Kehadiran;

class AbsensiEkstra extends Component
{
    use GetData;

    //model
    public $tanggal;
    public $tahun;
    public $semester;
    public $kelas;
    public $siswa;
    public $ekstrakurikuler;
    public $kehadiran;
    public $is_edit;
    public $is_disabled;
    public $id_absensi_ekstra;

    //array
    public $list_ekstra = [];
    public $list_siswa = [];
    public $list_kelas = [];
    public $list_kehadiran = [];
    public $list_absensi_ekstra = [];

    protected $rules = [
        'tanggal' => 'required',
        'tahun' => 'required',
        'semester' => 'required',
        'kelas' => 'required',
        'siswa' => 'required',
        'ekstrakurikuler' => 'required',
        'kehadiran' => 'required'
    ];
    protected $listeners = ['delete' => 'delete'];

    public function render()
    {
        $this->get_list_siswa();
        $this->list_absensi_ekstra = [];
        $this->list_absensi_ekstra = $this->cek_absen_ekstra();
        return view('livewire.guru.absensi.absensi-ekstra');
    }

    public function mount()
    {
        $this->tanggal = gmdate('Y-m-d');
        $this->get_tahun();
        $this->get_semester();
        $this->list_ekstra = Ekstrakurikuler::orderBy('nama')->get();
        $this->list_kehadiran = Kehadiran::get();
        $this->list_kelas = Kelas::get();

    }

    public function simpan()
    {
        $this->validate();
        if ($this->is_edit) {
            ModelsAbsensiEkstra::updateOrCreate(
                [
                    'id' => $this->id_absensi_ekstra
                ],
                [
                    'kehadiran_id' => $this->kehadiran,
                ]
            );
            $this->dispatchBrowserEvent(
                'notyf',
                [
                    'type' => 'success',
                    'message' => 'Berhasil Update Absensi Ekstrakurikuler'
                ]
            );
        } else {

            ModelsAbsensiEkstra::create([
                'tanggal' => $this->tanggal,
                'ekstrakurikuler_id' => $this->ekstrakurikuler,
                'nis' => $this->siswa,
                'tahun' => $this->tahun,
                'semester' => $this->semester,
                'kehadiran_id' => $this->kehadiran,
                'kelas_id' => $this->kelas
            ]);
            $this->dispatchBrowserEvent(
                'notyf',
                [
                    'type' => 'success',
                    'message' => 'Berhasil Simpan Absensi Ekstrakurikuler'
                ]
            );
        }
        $this->kelas = '';
        $this->siswa = '';
        $this->kehadiran = '';
        $this->list_siswa = [];
        $this->is_edit = false;
        $this->is_disabled = '';
    }
    public function edit($id)
    {
        $this->is_edit = true;
        $this->is_disabled = 'disabled';
        $this->id_absensi_ekstra = $id;
        $cari = ModelsAbsensiEkstra::find($id);
        $this->tanggal = $cari->tanggal;
        $this->tahun = $cari->tahun;
        $this->semester = $cari->semester;
        $this->ekstrakurikuler = $cari->ekstrakurikuler_id;
        $this->kelas = $cari->kelas_id;
        $this->siswa = $cari->nis;
        $this->kehadiran = $cari->kehadiran_id;
    }
    public function batal()
    {
        $this->kelas = '';
        $this->siswa = '';
        $this->kehadiran = '';
        $this->is_edit = false;
        $this->is_disabled = '';
        $this->id_absensi_ekstra = '';
    }
    public function confirm($id)
    {
        $this->dispatchBrowserEvent(
            'confirm',
            [
                'title' => 'Menghapus Absensi Ekstra Siswa',
                'text' => 'Anda Yakin Menghapus Absensi Ekstra Siswa ?',
                'id' => $id
            ]
        );
    }
    public function delete($id)
    {
        ModelsAbsensiEkstra::find($id)->delete();
        $this->dispatchBrowserEvent(
            'notyf',
            [
                'type' => 'error',
                'message' => 'Berhasil Menghapus Absensi Ekstra'
            ]
        );
    }
    public function hydrate()
    {
        $this->list_siswa = [];
        $this->get_list_siswa();
        $this->list_absensi_ekstra = [];
        $this->list_absensi_ekstra = $this->cek_absen_ekstra();
    }
    public function updated($property)
    {
        $this->list_siswa = [];
        $this->get_list_siswa();
        $this->list_absensi_ekstra = [];
        $this->list_absensi_ekstra = $this->cek_absen_ekstra();
    }
}
