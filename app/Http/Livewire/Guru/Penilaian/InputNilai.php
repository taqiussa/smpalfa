<?php

namespace App\Http\Livewire\Guru\Penilaian;

use App\Models\Kelas;
use App\Models\Siswa;
use Livewire\Component;
use App\Models\GuruMapel;
use App\Models\KategoriNilai;
use App\Models\JenisPenilaian;
use App\Models\Penilaian;

class InputNilai extends Component
{
    //model
    public $tanggal;
    public $tahun;
    public $semester;
    public $kelas;
    public $mata_pelajaran;
    public $kategori_nilai;
    public $jenis_penilaian;
    public $nilai = [];

    //array
    public $list_mata_pelajaran = [];
    public $list_kategori_nilai = [];
    public $list_jenis_penilaian = [];
    public $list_kelas = [];
    public $list_siswa = [];

    protected $rules = [
        'nilai.*.nilai' => 'required|numeric|max:100',
        'tanggal' => 'required',
        'tahun' => 'required',
        'semester' => 'required',
        'kelas' => 'required',
        'mata_pelajaran' => 'required',
        'kategori_nilai' => 'required',
        'jenis_penilaian' => 'required'
    ];
    protected $messages = [
        'nilai.*.nilai.required' => 'Nilai Tidak Boleh Kosong',
        'nilai.*.nilai.numeric' => 'Nilai Harus Angka',
        'nilai.*.nilai.max' => 'Maksimal Nilai 100',
    ];
    public function render()
    {
        return view('livewire.guru.penilaian.input-nilai');
    }
    public function simpan()
    {
        $this->validate();

        $cek_nilai = Penilaian::where('tahun', $this->tahun)
        ->where('semester', $this->semester)
        ->where('mata_pelajaran_id', $this->mata_pelajaran)
        ->where('kategori_nilai_id', $this->kategori_nilai)
        ->where('jenis_penilaian_id', $this->jenis_penilaian)
        ->where('kelas_id', $this->kelas)
        ->get();

        if (blank($cek_nilai)) {
            foreach ($this->list_siswa as $key => $siswa) {
                Penilaian::create([
                    'tanggal' => $this->tanggal,
                    'tahun' => $this->tahun,
                    'semester' => $this->semester,
                    'mata_pelajaran_id' => $this->mata_pelajaran,
                    'kategori_nilai_id' => $this->kategori_nilai,
                    'jenis_penilaian_id' => $this->jenis_penilaian,
                    'kelas_id' => $this->kelas,
                    'nis' => $siswa->nis,
                    'nilai' => $this->nilai[$key]['nilai'],
                    'user_id' => auth()->user()->id
                ]);
            }
            $this->dispatchBrowserEvent('notyf', [
                'type' => 'success',
                'message' => 'Berhasil Simpan Nilai Siswa'
            ]);

        } else {
            foreach ($this->list_siswa as $key => $siswa) {
                Penilaian::updateOrCreate([
                    'tahun' => $this->tahun,
                    'semester' => $this->semester,
                    'mata_pelajaran_id' => $this->mata_pelajaran,
                    'kategori_nilai_id' => $this->kategori_nilai,
                    'jenis_penilaian_id' => $this->jenis_penilaian,
                    'kelas_id' => $this->kelas,
                    'nis' => $siswa->nis,
                ],
                [
                    'nilai' => $this->nilai[$key]['nilai']
                ]);
            }
            $this->dispatchBrowserEvent('notyf', 
            [
                'type' => 'success',
                'message' => 'Berhasil Update Nilai Siswa'
            ]);
        }
    }
    public function mount()
    {
        $this->get_mata_pelajaran();
        $this->tanggal = gmdate('Y-m-d');
        $this->list_kategori_nilai = KategoriNilai::orderBy('nama')->get();
        $this->list_jenis_penilaian = JenisPenilaian::orderBy('nama')->get();
        $this->list_kelas = Kelas::orderBy('nama')->get();
        $tahunIni = gmdate('Y');
        $bulanIni = gmdate('m');
        if ($bulanIni <= 6) {
            $this->tahun = (intval($tahunIni) - 1) . ' / ' . intval($tahunIni);
        } else {
            $this->tahun = intval($tahunIni) . ' / ' . (intval($tahunIni) + 1);
        }
    }
    public function hydrate()
    {
        $this->get_mata_pelajaran();
        $this->get_list_siswa();
        $this->get_nilai();
    }
    public function updatedTanggal()
    {
        $this->get_nilai();
    }
    public function updatedTahun()
    {
        $this->get_nilai();
    }
    public function updatedSemester()
    {
        $this->get_nilai();
    }
    public function updatedMataPelajaran()
    {
        $this->get_nilai();
    }
    public function updatedKategoriNilai()
    {
        $this->get_nilai();
    }
    public function updatedJenisPenilaian()
    {
        $this->get_nilai();
    }
    public function updatedKelas()
    {
        $this->get_nilai();
    }
    private function get_mata_pelajaran()
    {
        //list mata pelajaran berdasarkan User Login
        $this->list_mata_pelajaran = GuruMapel::join('mata_pelajarans', 'mata_pelajarans.id', '=', 'guru_mata_pelajaran.mata_pelajaran_id')
            ->where('user_id', auth()->user()->id)
            ->select(
                'guru_mata_pelajaran.mata_pelajaran_id as id',
                'mata_pelajarans.nama as nama'
            )
            ->get();
        //atur supaya otomatis mengambil id mata pelajaran , supaya tidak null(bug livewire)
        // $this->mata_pelajaran = $this->list_mata_pelajaran[0]->id;
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
    private function get_nilai()
    {
        $this->resetErrorBag();
        if(!empty($this->tanggal) && !empty($this->tahun) && !empty($this->semester) && !empty($this->mata_pelajaran) && !empty($this->kategori_nilai) && !empty($this->jenis_penilaian) && !empty($this->kelas))
        {
            $this->list_siswa = [];
            $this->get_list_siswa();
            $data_nilai = Penilaian::join('users', 'penilaians.nis', '=', 'users.nis')
            ->where('tahun', $this->tahun)
            ->where('semester', $this->semester)
            ->where('mata_pelajaran_id', $this->mata_pelajaran)
            ->where('kategori_nilai_id', $this->kategori_nilai)
            ->where('jenis_penilaian_id', $this->jenis_penilaian)
            ->where('kelas_id', $this->kelas)
            ->select(
                'users.name as name', 
                'penilaians.id as id',
                'penilaians.nilai as nilai'
            )
            ->orderBy('users.name')
            ->get();

            if (blank($data_nilai)) {
                foreach ($this->list_siswa as $key => $siswa) {
                    $this->nilai[$key] = [
                        'nilai' => ''
                    ];
                }
            } else {
                foreach ($data_nilai as $key => $nilai)
                {
                    $this->nilai[$key] = [
                        'nilai' => $nilai->nilai
                    ];
                }
            }
        }

        if(empty($this->tanggal) || empty($this->tahun) || empty($this->semester) || empty($this->mata_pelajaran) || empty($this->kategori_nilai) || empty($this->jenis_penilaian) || empty($this->kelas))
        {
            $this->list_siswa = [];
        }
    }
}
