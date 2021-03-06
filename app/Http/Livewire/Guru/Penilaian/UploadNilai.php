<?php

namespace App\Http\Livewire\Guru\Penilaian;

use App\Exports\ExportNilai;
use App\Imports\ImportNilai;
use App\Models\Kelas;
use App\Models\Siswa;
use Livewire\Component;
use App\Models\GuruMapel;
use App\Models\Penilaian;
use App\Models\KategoriNilai;
use App\Models\JenisPenilaian;
use App\Models\MataPelajaran;
use App\Traits\GetData;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class UploadNilai extends Component
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
        return view('livewire.guru.penilaian.upload-nilai');
    }
    public function exports()
    {
        $this->resetErrorBag();
        $this->validate();
        return Excel::download(new ExportNilai($this->tahun, $this->semester, $this->mata_pelajaran, $this->kategori_nilai, $this->jenis_penilaian, $this->kelas), $this->nama_mapel . '-' . $this->nama_kelas . '-' . $this->nama_kategori . '-' . $this->nama_jenis . '.xlsx');
    }

    public function imports()
    {
        $this->resetErrorBag();
        $this->validateOnly('file_import',['file_import' => 'required|mimes:xls,xlsx']);
        Excel::import(new ImportNilai(), $this->file_import);
        $this->dispatchBrowserEvent('notyf',
        [
            'type' => 'success',
            'message' => 'Berhasil Upload Nilai'
        ]);
        $this->emitSelf('refresh');
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
                foreach ($data_nilai as $key => $nilai) {
                    $this->nilai[$key] = [
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
