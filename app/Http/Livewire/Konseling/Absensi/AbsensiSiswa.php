<?php

namespace App\Http\Livewire\Konseling\Absensi;

use App\Models\Absensi;
use App\Models\Kehadiran;
use App\Models\Kelas;
use App\Models\Siswa;
use Livewire\Component;

class AbsensiSiswa extends Component
{
    // wire model
    public $tanggal;
    public $kelas;
    public $tahun;
    public $jam;
    public $kehadiran = [];
    public $semester;

    // array
    public $list_siswa = [];
    public $list_kelas;
    public $list_kehadiran;

    //checking


    protected $rules = [
        'kehadiran.*.kehadiran' => 'required',
        'jam' => 'required',
        'tanggal' => 'required',
        'kelas' => 'required',
        'tahun' => 'required',
    ];
    protected $messages = [
        'kehadiran.*.kehadiran.required' => 'Silahkan Pilih Kehadiran'
    ];
    public function render()
    {
        return view('livewire.konseling.absensi.absensi-siswa');
    }
    public function simpan()
    {
        //validation
        $this->validate();

        //cek apakah kelas sudah di absen
        $cek_absen = Absensi::where('tanggal', $this->tanggal)
            ->where('jam', $this->jam)
            ->where('kelas_id', $this->kelas)
            ->where('tahun', $this->tahun)
            ->get();

        //jika kelas belum di absen
        if (blank($cek_absen)) {
            //buat list siswa baru
            foreach ($this->list_siswa as $key => $siswa) {
                //simpan absen baru
                Absensi::create([
                    'tanggal' => $this->tanggal,
                    'jam' => $this->jam,
                    'kelas_id' => $this->kelas,
                    'tahun' => $this->tahun,
                    'semester' => $this->semester,
                    'nis' => $siswa->nis,
                    'kehadiran_id' => $this->kehadiran[$key]['kehadiran'],
                ]);
            }
            $this->dispatchBrowserEvent('notyf', [
                'type' => 'success',
                'message' => 'Berhasil Simpan Kehadiran Siswa'
            ]);
            $this->jam = '';
            $this->kelas = '';
            $this->list_siswa = [];
        } else {
            //jika kelas sudah di absen , update atau buat baru (jika ada array kosong) dari daftar absensi kehadiran
            foreach ($this->list_siswa as $key => $siswa) {
                Absensi::updateOrCreate(
                    [
                        'tanggal' => $this->tanggal,
                        'jam' => $this->jam,
                        'kelas_id' => $this->kelas,
                        'tahun' => $this->tahun,
                        'nis' => $siswa->nis,
                    ],
                    [
                        'kehadiran_id' => $this->kehadiran[$key]['kehadiran']
                    ]
                );
            }
            $this->dispatchBrowserEvent('notyf', [
                'type' => 'success',
                'message' => 'Berhasil Simpan Kehadiran Siswa'
            ]);
            $this->jam = '';
            $this->kelas = '';
            $this->list_siswa = [];
        }
    }
    public function mount()
    {
        $this->get_semester();
        $this->tanggal = gmdate('Y-m-d');
        $this->list_kelas = Kelas::get();
        $tahunIni = gmdate('Y');
        $bulanIni = gmdate('m');
        if ($bulanIni <= 6) {
            $this->tahun = (intval($tahunIni) - 1) . ' / ' . intval($tahunIni);
        } else {
            $this->tahun = intval($tahunIni) . ' / ' . (intval($tahunIni) + 1);
        }
        $this->list_kehadiran = Kehadiran::get();
    }
    public function hydrate()
    {
        $this->get_semester();
        $this->get_list_siswa();
    }
    public function updated($property)
    {
        $this->get_semester();
        $this->get_list_kehadiran();
    }
    private function get_list_siswa()
    {
        $this->list_siswa = Siswa::join('users', 'siswas.nis', '=', 'users.nis')
            ->where('siswas.kelas_id', $this->kelas)
            ->where('siswas.tahun', $this->tahun)
            ->select(
                'users.name as name',
                'siswas.nis as nis',
            )
            ->orderBy('users.name')
            ->get();
    }
    private function get_list_kehadiran()
    {
        $this->resetErrorBag();
        if (!empty($this->tanggal) && !empty($this->jam) && !empty($this->kelas) && !empty($this->tahun)) {
            $this->list_siswa = [];
            $this->get_list_siswa();
            $data_absensi = Absensi::join('users', 'absensis.nis', '=', 'users.nis')
                ->where('tanggal', $this->tanggal)
                ->where('jam', $this->jam)
                ->where('kelas_id', $this->kelas)
                ->where('tahun', $this->tahun)
                ->select(
                    'users.name as name',
                    'absensis.id as id',
                    'absensis.jam as jam',
                    'absensis.kehadiran_id as kehadiran_id',
                )
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
        if (empty($this->tanggal) || empty($this->jam) || empty($this->kelas) || empty($this->tahun)) {
            $this->list_siswa = [];
        }
    }
    private function get_semester()
    {
        $bulanIni = gmdate('m');
        if ($bulanIni <= 6) {
            $this->semester = 2;
        } else {
            $this->semester = 1;
        }
    }
}
