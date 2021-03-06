<?php

namespace App\Http\Livewire\Konseling\Absensi;

use App\Models\Absensi;
use App\Models\Kehadiran;
use App\Models\Kelas;
use App\Traits\GetData;
use Livewire\Component;

class AbsensiSiswa extends Component
{
    use GetData;
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
        $cek_absen = $this->cek_absen();

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
                    'user_id' => auth()->user()->id,
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
                        'kehadiran_id' => $this->kehadiran[$key]['kehadiran'],
                        'user_id' => auth()->user()->id,
                        'semester' => $this->semester,
                        ]
                );
            }
            $this->dispatchBrowserEvent('notyf', [
                'type' => 'success',
                'message' => 'Berhasil Update Kehadiran Siswa'
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
        $this->get_tahun();
        $this->list_kehadiran = Kehadiran::get();
    }
    public function hydrate()
    {
        $this->get_semester();
        $this->get_list_siswa();
    }
    public function updatedTanggal()
    {
        $this->get_semester();
        $this->get_list_kehadiran();
    }
    public function updatedJam()
    {
        $this->get_semester();
        $this->get_list_kehadiran();
    }
    public function updatedKelas()
    {
        $this->get_semester();
        $this->get_list_kehadiran();
    }
    public function updatedTahun()
    {
        $this->get_semester();
        $this->get_list_kehadiran();
    }

    private function get_list_kehadiran()
    {
        $this->resetErrorBag();
        if (!empty($this->tanggal) && !empty($this->jam) && !empty($this->kelas) && !empty($this->tahun)) {
            $this->list_siswa = [];
            $this->get_list_siswa();
            $data_absensi = $this->data_absensi();
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
}
