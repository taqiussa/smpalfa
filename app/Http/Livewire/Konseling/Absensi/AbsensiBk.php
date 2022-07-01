<?php

namespace App\Http\Livewire\Konseling\Absensi;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Siswa;
use Livewire\Component;
use App\Models\Kehadiran;
use App\Models\User;

class AbsensiBk extends Component
{
    //model
    public $tanggal;
    public $jam;
    public $kelas;
    public $tahun;
    public $siswa;
    public $kehadiran;
    public $semester;

    //array
    public $list_kelas = [];
    public $list_siswa = [];
    public $list_kehadiran = [];
    public $kelompok_siswa = [];

    //condition
    public $is_disabled = '';

    public function render()
    {
        if ($this->kelompok_siswa) {
            $this->is_disabled = 'disabled';
        } else {
            $this->is_disabled = '';
        }
        return view('livewire.konseling.absensi.absensi-bk');
    }
    public function tambah()
    {
        $this->validate([
            'kelas' => 'required',
            'siswa' => 'required',
            'kehadiran' => 'required',
            'jam' => 'required'
        ]);
        $cari_kelas = Kelas::find($this->kelas);
        $cari_siswa = User::where('nis', $this->siswa)->first();
        $cari_kehadiran = Kehadiran::find($this->kehadiran);
        $this->kelompok_siswa[] = [
            'id_kelas' => $cari_kelas->id,
            'nama_kelas' => $cari_kelas->nama,
            'nis_siswa' => $cari_siswa->nis,
            'nama_siswa' => $cari_siswa->name,
            'id_kehadiran' => $cari_kehadiran->id,
            'nama_kehadiran' => $cari_kehadiran->nama
        ];
        $this->siswa = '';
        $this->kehadiran = '';
    }
    public function hapus($key)
    {
        unset($this->kelompok_siswa[$key]);
        $this->kelompok_siswa = array_values($this->kelompok_siswa);
    }
    public function simpan()
    {
        $this->validate(
            [
                'kelompok_siswa' => 'required'
            ],
            [
                'kelompok_siswa.required' => 'Silahkan Pilih Siswa'
            ]
        );
        $cari_siswa = Siswa::where('kelas_id', $this->kelas)
            ->where('tahun', $this->tahun)
            ->get();
        $cari_absensi = Absensi::where('tanggal', $this->tanggal)
            ->where('jam', $this->jam)
            ->where('kelas_id', $this->kelas)
            ->where('tahun', $this->tahun)
            ->get();

        //Jika Belum di absensi, membuat list absen baru dengan kehadiran : hadir
        if (blank($cari_absensi)) {
            foreach ($cari_siswa as $key => $siswa) {
                Absensi::create([
                    'tanggal' => $this->tanggal,
                    'jam' => $this->jam,
                    'kelas_id' => $this->kelas,
                    'tahun' => $this->tahun,
                    'semester' => $this->semester,
                    'nis' => $siswa->nis,
                    'kehadiran_id' => 1,
                ]);
            }
            //kemudian mengupdate kehadiran sesuai yang di input oleh BK
            foreach ($this->kelompok_siswa as $key => $siswa) {
                Absensi::where([
                    'tanggal' => $this->tanggal,
                    'jam' => $this->jam,
                    'kelas_id' => $this->kelas,
                    'tahun' => $this->tahun,
                    'nis' => $siswa['nis_siswa']
                ])
                    ->update([
                        'kehadiran_id' => $siswa['id_kehadiran']
                    ]);
            }
            $this->dispatchBrowserEvent('notyf', [
                'type' => 'success',
                'message' => 'Berhasil Simpan Kehadiran Siswa'
            ]);
            $this->jam = '';
            $this->kelas = '';
            $this->list_siswa = [];
            $this->kelompok_siswa = [];
        } else {
            //jika kelas sudah di absen, mengupdate kehadiran sesuai input dari BK
            foreach ($this->kelompok_siswa as $key => $siswa) {
                Absensi::where([
                    'tanggal' => $this->tanggal,
                    'jam' => $this->jam,
                    'kelas_id' => $this->kelas,
                    'tahun' => $this->tahun,
                    'nis' => $siswa['nis_siswa']
                ])
                    ->update([
                        'kehadiran_id' => $siswa['id_kehadiran']
                    ]);
            }
            $this->dispatchBrowserEvent('notyf', [
                'type' => 'success',
                'message' => 'Berhasil Update Kehadiran Siswa'
            ]);
            $this->jam = '';
            $this->kelas = '';
            $this->list_siswa = [];
            $this->kelompok_siswa = [];
        }
    }
    public function mount()
    {
        $bulan = gmdate('m');
        $tahun = gmdate('Y');
        //make tahun ajaran based on month
        if ($bulan < 7) {
            $this->tahun = ($tahun - 1) . ' / ' . ($tahun);
        } else {
            $this->tahun = $tahun . ' / ' . ($tahun + 1);
        }
        $this->tanggal = gmdate('Y-m-d');
        $this->list_kelas = Kelas::orderBy('nama')->get();
        $this->list_kehadiran = Kehadiran::skip(1)->take(5)->orderBy('id')->get();
        $this->get_semester();
    }
    public function hydrate()
    {
        $this->get_semester();
        $this->get_list_siswa();
    }
    public function updated($property)
    {
        $this->get_semester();
        $this->get_list_siswa();
    }
    private function get_list_siswa()
    {
        if (empty($this->tanggal) || empty($this->jam) || empty($this->kelas) || empty($this->tahun)) {
            $this->list_siswa = [];
        } else {
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
    }
    private function get_semester()
    {
        $bulan = gmdate('m');
        if ($bulan < 7) {
            $this->semester = 2;
        } else {
            $this->semester = 1;
        }
    }
}
