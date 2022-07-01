<?php

namespace App\Http\Livewire\Guru\Penilaian;

use App\Models\Kelas;
use App\Models\Siswa;
use Livewire\Component;
use App\Models\GuruMapel;
use App\Models\JenisSikap;
use App\Models\KategoriSikap;
use Livewire\WithFileUploads;
use App\Models\PenilaianSikap;
use App\Exports\ExportNilaiSikap;
use App\Imports\ImportNilaiSikap;
use App\Models\MataPelajaran;
use Maatwebsite\Excel\Facades\Excel;

class InputNilaiSikap extends Component
{
    use WithFileUploads;

    //model
    public $tahun;
    public $semester;
    public $kelas;
    public $siswa;
    public $kategori;
    public $jenis_sikap;
    public $mata_pelajaran;
    public $file_import;
    public $nilai = [];

    //array
    public $list_siswa = [];
    public $list_kelas = [];
    public $list_kategori = [];
    public $list_jenis = [];
    public $list_mata_pelajaran = [];

    protected $listeners = ['refresh' => '$refresh'];
    protected $rules = [
        'nilai.*.nilai' => 'required|numeric|max:100',
        'tahun' => 'required',
        'semester' => 'required',
        'kelas' => 'required',
        'mata_pelajaran' => 'required',
        'kategori' => 'required',
        'jenis_sikap' => 'required'
    ];
    protected $messages = [
        'nilai.*.nilai.required' => 'Nilai Tidak Boleh Kosong',
        'nilai.*.nilai.numeric' => 'Nilai Harus Angka',
        'nilai.*.nilai.max' => 'Maksimal Nilai 100',
    ];
    public function render()
    {
        return view('livewire.guru.penilaian.input-nilai-sikap');
    }

    public function mount()
    {
        $this->get_mata_pelajaran();
        $tahunIni = gmdate('Y');
        $bulanIni = gmdate('m');
        if ($bulanIni <= 6) {
            $this->tahun = (intval($tahunIni) - 1) . ' / ' . intval($tahunIni);
            $this->semester = 2;
        } else {
            $this->tahun = intval($tahunIni) . ' / ' . (intval($tahunIni) + 1);
            $this->semester = 1;
        }
        $this->list_kelas = Kelas::get();
        $this->list_kategori = KategoriSikap::get();
    }
    public function simpan()
    {
        $this->validate();

        $cek_nilai = PenilaianSikap::where('tahun', $this->tahun)
        ->where('semester', $this->semester)
        ->where('mata_pelajaran_id', $this->mata_pelajaran)
        ->where('kategori_sikap_id', $this->kategori)
        ->where('jenis_sikap_id', $this->jenis_sikap)
        ->where('kelas_id', $this->kelas)
        ->get();

        if (blank($cek_nilai)) {
            foreach ($this->list_siswa as $key => $siswa) {
                PenilaianSikap::create([
                    'tahun' => $this->tahun,
                    'semester' => $this->semester,
                    'mata_pelajaran_id' => $this->mata_pelajaran,
                    'kategori_sikap_id' => $this->kategori,
                    'jenis_sikap_id' => $this->jenis_sikap,
                    'kelas_id' => $this->kelas,
                    'nis' => $siswa->nis,
                    'nilai' => $this->nilai[$key]['nilai'],
                ]);
            }
            $this->dispatchBrowserEvent('notyf', [
                'type' => 'success',
                'message' => 'Berhasil Simpan Nilai Siswa'
            ]);

        } else {
            foreach ($this->list_siswa as $key => $siswa) {
                PenilaianSikap::updateOrCreate([
                    'tahun' => $this->tahun,
                    'semester' => $this->semester,
                    'mata_pelajaran_id' => $this->mata_pelajaran,
                    'kategori_sikap_id' => $this->kategori,
                    'jenis_sikap_id' => $this->jenis_sikap,
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
                'message' => 'Berhasil Update Nilai Sikap'
            ]);
        }
    }
    public function hydrate()
    {
        $this->get_mata_pelajaran();
        $this->get_semester();
        $this->get_list_siswa();
        $this->get_nilai();
    }
    public function updatedKategori()
    {
        $this->jenis_sikap = '';
        $this->list_jenis = JenisSikap::where('kategori_sikap_id', $this->kategori)->get();
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
    public function updatedKelas()
    {
        $this->get_nilai();
    }
    public function updatedJenisSikap()
    {
        $this->get_nilai();
    }
    public function updatedMataPelajaran()
    {
        $this->get_nilai();
    }
    public function updatedFileImport()
    {
        $this->resetErrorBag();
        $this->validate([
            'file_import' => 'mimes:xls,xlsx'
        ]);
    }
    public function exports()
    {
        $this->validate(
            [
                'tahun' => 'required',
                'semester' => 'required',
                'kelas' => 'required',
                'kategori' => 'required',
                'mata_pelajaran' => 'required'
            ]
        );
        $nama_kelas = Kelas::find($this->kelas)->nama;
        $nama_kategori = KategoriSikap::find($this->kategori)->nama;
        $nama_mapel = MataPelajaran::find($this->mata_pelajaran)->nama;
        return Excel::download(new ExportNilaiSikap($this->tahun, $this->semester, $this->kelas, $this->kategori, $this->mata_pelajaran), 'Nilai-' . $nama_kategori . '-' . $nama_mapel . '-' . $nama_kelas . '.xlsx');
    }

    public function imports()
    {
        $this->validate([
            'file_import' => 'required|mimes:xls,xlsx'
        ]);
        Excel::import(new ImportNilaiSikap(), $this->file_import);
        $this->dispatchBrowserEvent('notyf',
        [
            'type' => 'success',
            'message' => 'Berhasil Upload Nilai Sikap'
        ]);
        $this->emitSelf('refresh', '$refresh');
        $this->file_import = '';
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
        if (!empty($this->tahun) && !empty($this->semester) && !empty($this->kelas) && !empty($this->kategori) && !empty($this->jenis_sikap)) {
            $this->list_siswa = [];
            $this->get_list_siswa();
            $data_nilai = PenilaianSikap::join('users', 'penilaian_sikaps.nis', '=', 'users.nis')
                ->where('tahun', $this->tahun)
                ->where('semester', $this->semester)
                ->where('mata_pelajaran_id', $this->mata_pelajaran)
                ->where('kelas_id', $this->kelas)
                ->where('kategori_sikap_id', $this->kategori)
                ->where('jenis_sikap_id', $this->jenis_sikap)
                ->select(
                    'users.name as name',
                    'penilaian_sikaps.id as id',
                    'penilaian_sikaps.nilai as nilai'
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
                foreach ($data_nilai as $key => $nilai) {
                    $this->nilai[$key] = [
                        'nilai' => $nilai->nilai
                    ];
                }
            }
        }
        if (empty($this->tahun) || empty($this->semester) || empty($this->kelas) || empty($this->kategori) || empty($this->jenis_sikap)) {
            $this->list_siswa = [];
        }
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
