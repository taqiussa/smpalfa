<?php

namespace App\Http\Livewire\Guru\Penilaian;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Traits\GetData;
use Livewire\Component;
use App\Models\GuruMapel;
use App\Models\KategoriNilai;
use App\Models\MataPelajaran;
use Livewire\WithFileUploads;
use App\Models\JenisPenilaian;
use App\Exports\ExportAnalisis;
use App\Imports\ImportAnalisis;
use App\Models\AnalisisPenilaian;
use Maatwebsite\Excel\Facades\Excel;

class UploadAnalisis extends Component
{
    use WithFileUploads;
    use GetData;

    //model
    public $tahun;
    public $semester;
    public $kelas;
    public $mata_pelajaran;
    public $kategori_nilai;
    public $jenis_penilaian;
    public $nilai = [];
    public $file_import;

    //array
    public $list_mata_pelajaran = [];
    public $list_kategori_nilai = [];
    public $list_jenis_penilaian = [];
    public $list_kelas = [];
    public $list_siswa = [];

    //for export
    public $nama_mapel;
    public $nama_kategori;
    public $nama_jenis;
    public $nama_kelas;

    protected $rules = [
        'tahun' => 'required',
        'semester' => 'required',
        'mata_pelajaran' => 'required',
        'kategori_nilai' => 'required',
        'jenis_penilaian' => 'required',
        'kelas' => 'required'
    ];
    protected $listeners = 
    ['refresh' => '$refresh'];
    public function render()
    {
        return view('livewire.guru.penilaian.upload-analisis');
    }
public function mount()
    {
        $this->get_tahun();
        $this->get_semester();
        $this->get_mata_pelajaran();
        $this->list_kategori_nilai = KategoriNilai::orderBy('nama')->get();
        $this->list_kelas = Kelas::orderBy('nama')->get();
        $this->list_jenis_penilaian = JenisPenilaian::whereIn('id', $this->cek_jenis_penilaian())->orderBy('nama')->get();
    }
    public function exports()
    {
        $this->resetErrorBag();
        $this->validate();
        return Excel::download(new ExportAnalisis($this->tahun, $this->semester, $this->mata_pelajaran, $this->kategori_nilai, $this->jenis_penilaian, $this->kelas),
        'Analisis ' . $this->nama_jenis . '-' . $this->nama_kelas . '-' . $this->nama_mapel . '.xlsx');
    }

    public function imports()
    {
        $this->resetErrorBag();
        $this->validateOnly('file_import',['file_import' => 'required|mimes:xls,xlsx']);
        Excel::import(new ImportAnalisis(), $this->file_import);
        $this->dispatchBrowserEvent('notyf',
        [
            'type' => 'success',
            'message' => 'Berhasil Upload Analisis'
        ]);
        $this->emitSelf('refresh');
    }
    public function hydrate()
    {
        $this->get_mata_pelajaran();
        $this->get_list_siswa();
        $this->get_nilai();
        $this->list_jenis_penilaian = JenisPenilaian::whereIn('id', $this->cek_jenis_penilaian())->orderBy('nama')->get();

    }
    public function updated($property)
    {
        $this->get_nilai();
        $this->list_jenis_penilaian = JenisPenilaian::whereIn('id', $this->cek_jenis_penilaian())->orderBy('nama')->get();

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
        if (!empty($this->tahun) && !empty($this->semester) && !empty($this->mata_pelajaran) && !empty($this->kategori_nilai) && !empty($this->jenis_penilaian) && !empty($this->kelas)) {
            $this->nama_mapel = MataPelajaran::find($this->mata_pelajaran)->nama;
            $this->nama_kategori = KategoriNilai::find($this->kategori_nilai)->nama;
            $this->nama_jenis = JenisPenilaian::find($this->jenis_penilaian)->nama;
            $this->nama_kelas = Kelas::find($this->kelas)->nama;
            $this->list_siswa = [];
            $this->get_list_siswa();
            $data_nilai = AnalisisPenilaian::join('users', 'analisis_penilaians.nis', '=', 'users.nis')
                ->where('tahun', $this->tahun)
                ->where('semester', $this->semester)
                ->where('mata_pelajaran_id', $this->mata_pelajaran)
                ->where('kategori_nilai_id', $this->kategori_nilai)
                ->where('jenis_penilaian_id', $this->jenis_penilaian)
                ->where('kelas_id', $this->kelas)
                ->select(
                    'users.name as name',
                    'analisis_penilaians.id as id',
                    'analisis_penilaians.no_1 as no_1',
                    'analisis_penilaians.no_2 as no_2',
                    'analisis_penilaians.no_3 as no_3',
                    'analisis_penilaians.no_4 as no_4',
                    'analisis_penilaians.no_5 as no_5',
                    'analisis_penilaians.no_6 as no_6',
                    'analisis_penilaians.no_7 as no_7',
                    'analisis_penilaians.no_8 as no_8',
                    'analisis_penilaians.no_9 as no_9',
                    'analisis_penilaians.no_10 as no_10',
                    'analisis_penilaians.nilai as nilai'
                )
                ->orderBy('users.name')
                ->get();

            if (blank($data_nilai)) {
                foreach ($this->list_siswa as $key => $siswa) {
                    $this->nilai[$key] = [
                        'no_1' => '',
                        'no_2' => '',
                        'no_3' => '',
                        'no_4' => '',
                        'no_5' => '',
                        'no_6' => '',
                        'no_7' => '',
                        'no_8' => '',
                        'no_9' => '',
                        'no_10' => '',
                        'nilai' => ''
                    ];
                }
            } else {
                foreach ($data_nilai as $key => $nilai) {
                    $this->nilai[$key] = [
                        'no_1' => $nilai->no_1,
                        'no_2' => $nilai->no_2,
                        'no_3' => $nilai->no_3,
                        'no_4' => $nilai->no_4,
                        'no_5' => $nilai->no_5,
                        'no_6' => $nilai->no_6,
                        'no_7' => $nilai->no_7,
                        'no_8' => $nilai->no_8,
                        'no_9' => $nilai->no_9,
                        'no_10' => $nilai->no_10,
                        'nilai' => $nilai->nilai
                    ];
                }
            }
        }

        if (empty($this->tahun) || empty($this->semester) || empty($this->mata_pelajaran) || empty($this->kategori_nilai) || empty($this->jenis_penilaian) || empty($this->kelas)) {
            $this->list_siswa = [];
        }
    }

}
