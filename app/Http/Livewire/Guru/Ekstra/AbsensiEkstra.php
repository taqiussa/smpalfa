<?php

namespace App\Http\Livewire\Guru\Ekstra;

use App\Models\AbsensiEkstra as ModelsAbsensiEkstra;
use App\Models\Ekstrakurikuler;
use App\Models\Kehadiran;
use App\Models\SiswaEkstra;
use App\Traits\GetData;
use Livewire\Component;

class AbsensiEkstra extends Component
{
    use GetData;

    // model
    public $tanggal;
    public $ekstra;
    public $tahun;
    public $kehadiran = [];
    public $semester;

    //array
    public $list_kehadiran = [];
    public $list_siswa = [];
    public $list_ekstra = [];

    protected $rules = [
        'kehadiran.*.kehadiran' => 'required',
        'ekstra' => 'required',
        'tanggal' => 'required',
        'tahun' => 'required',
    ];
    protected $messages = [
        'kehadiran.*.kehadiran.required' => 'Silahkan Pilih Kehadiran'
    ];
    public function render()
    {
        return view('livewire.guru.ekstra.absensi-ekstra');
    }
    public function mount()
    {
        $this->get_tahun();
        $this->get_semester();
        $this->tanggal = gmdate('Y-m-d');
        $this->list_ekstra = Ekstrakurikuler::orderBy('nama')->get();
        $this->list_kehadiran = Kehadiran::get();
    }
    public function hydrate()
    {
        $this->get_semester();
        $this->get_list_siswa();
    }
    public function updatedTanggal()
    {
        $this->get_list_kehadiran();
    }
    public function updatedTahun()
    {
        $this->get_list_kehadiran();
    }
    public function updatedEkstra()
    {
        $this->get_list_kehadiran();
    }
    public function simpan()
    {
        //validation
        $this->validate();

        //cek apakah kelas sudah di absen
        $cek_absen = ModelsAbsensiEkstra::where('tanggal', $this->tanggal)
            ->where('ekstrakurikuler_id', $this->ekstra)
            ->where('tahun', $this->tahun)
            ->get();

        //jika kelas belum di absen
        if (blank($cek_absen)) {
            //buat list siswa baru
            foreach ($this->list_siswa as $key => $siswa) {
                //simpan absen baru
                ModelsAbsensiEkstra::create([
                    'tanggal' => $this->tanggal,
                    'semester' => $this->semester,
                    'kelas_id' => $siswa->kelas_id,
                    'tahun' => $this->tahun,
                    'ekstrakurikuler_id' => $this->ekstra,
                    'nis' => $siswa->nis,
                    'user_id' => auth()->user()->id,
                    'kehadiran_id' => $this->kehadiran[$key]['kehadiran'],
                ]);
            }
            $this->dispatchBrowserEvent('notyf', [
                'type' => 'success',
                'message' => 'Berhasil Simpan Kehadiran Ekstra'
            ]);
            $this->ekstra = '';
            $this->list_siswa = [];
        } else {
            //jika kelas sudah di absen , update atau buat baru (jika ada array kosong) dari daftar absensi kehadiran
            foreach ($this->list_siswa as $key => $siswa) {
                ModelsAbsensiEkstra::updateOrCreate(
                    [
                        'tanggal' => $this->tanggal,
                        'ekstrakurikuler_id' => $this->ekstra,
                        'tahun' => $this->tahun,
                        'kelas_id' => $siswa->kelas_id,
                        'nis' => $siswa->nis,
                    ],
                    [
                        'kehadiran_id' => $this->kehadiran[$key]['kehadiran']
                    ]
                );
            }
            $this->dispatchBrowserEvent('notyf', [
                'type' => 'success',
                'message' => 'Berhasil Update Kehadiran Ekstra'
            ]);
            $this->ekstra = '';
            $this->list_siswa = [];
        }
    }
    private function get_list_kehadiran()
    {
        if (!empty($this->tanggal) && !empty($this->ekstra) && !empty($this->tahun)) {
            $this->list_siswa = [];
            $this->get_list_siswa();
            $data_absensi = ModelsAbsensiEkstra::join('users', 'absensi_ekstras.nis', '=', 'users.nis')
                ->join('ekstrakurikulers', 'absensi_ekstras.ekstrakurikuler_id', '=', 'ekstrakurikulers.id')
                ->join('kelas', 'absensi_ekstras.kelas_id', '=', 'kelas.id')
                ->where('tanggal', $this->tanggal)
                ->where('tahun', $this->tahun)
                ->where('ekstrakurikuler_id', $this->ekstra)
                ->select(
                    'users.name as name',
                    'kelas.nama as kelas',
                    'ekstrakurikulers.nama as ekstra',
                    'absensi_ekstras.id as id',
                    'absensi_ekstras.tanggal as tanggal',
                    'absensi_ekstras.kehadiran_id as kehadiran_id',
                    'absensi_ekstras.kelas_id as kelas_id',
                )
                ->orderBy('kelas.nama')
                ->orderBy('users.name')
                ->get();
            if (blank($data_absensi)) {
                foreach ($this->list_siswa as $key => $siswa) {
                    $this->kehadiran[$key] = [
                        'kehadiran' => ''
                    ];
                }
            } else {
                foreach ($data_absensi as $key => $absensi) {
                    $this->kehadiran[$key] = [
                        'kehadiran' => $absensi->kehadiran_id
                    ];
                }
            }
        }
        if (empty($this->tanggal)  || empty($this->ekstra) || empty($this->tahun)) {
            $this->list_siswa = [];
        }
    }
    private function get_list_siswa()
    {
        $this->list_siswa = SiswaEkstra::join('users', 'siswa_ekstras.nis', '=', 'users.nis')
            ->join('ekstrakurikulers', 'siswa_ekstras.ekstrakurikuler_id', '=', 'ekstrakurikulers.id')
            ->join('kelas', 'siswa_ekstras.kelas_id', '=', 'kelas.id')
            ->where('siswa_ekstras.ekstrakurikuler_id', $this->ekstra)
            ->where('siswa_ekstras.tahun', $this->tahun)
            ->select(
                'users.name as name',
                'kelas.nama as kelas',
                'ekstrakurikulers.nama as ekstra',
                'siswa_ekstras.nis as nis',
                'siswa_ekstras.kelas_id as kelas_id',
            )
            ->orderBy('kelas.nama')
            ->orderBy('users.name')
            ->get();
    }
}
