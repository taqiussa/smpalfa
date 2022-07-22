<?php

namespace App\Http\Livewire\Guru\Ekstra;

use App\Models\Ekstrakurikuler;
use App\Models\PenilaianEkstrakurikuler;
use App\Models\SiswaEkstra;
use App\Traits\GetData;
use Livewire\Component;

class InputNilaiEkstra extends Component
{
    use GetData;

    // model
    public $tahun;
    public $semester;
    public $ekstra;
    public $nilai = [];

    // array
    public $list_ekstra = [];
    public $list_siswa = [];

    protected $rules =
    [
        'nilai.*.nilai' => 'required|numeric|max:100',
        'tahun' => 'required',
        'semester' => 'required',
        'ekstra' => 'required',
    ];
    protected $messages = [
        'nilai.*.nilai.required' => 'Nilai Tidak Boleh Kosong',
        'nilai.*.nilai.numeric' => 'Nilai Harus Angka',
        'nilai.*.nilai.max' => 'Maksimal Nilai 100',
    ];
    public function render()
    {
        return view('livewire.guru.ekstra.input-nilai-ekstra');
    }
    public function mount()
    {
        $this->get_tahun();
        $this->get_semester();
        $this->list_ekstra = Ekstrakurikuler::orderBy('nama')->get();
    }
    public function hydrate()
    {
        $this->get_nilai_ekstra();
    }
    public function updatedTahun()
    {
        $this->get_nilai_ekstra();
    }
    public function updatedSemester()
    {
        $this->get_nilai_ekstra();
    }
    public function updatedEkstra()
    {
        $this->get_nilai_ekstra();
    }
    public function simpan()
    {
        $this->validate();
        $cek_nilai = PenilaianEkstrakurikuler::where('tahun', $this->tahun)
            ->where('semester', $this->semester)
            ->where('ekstrakurikuler_id', $this->ekstra)
            ->get();

        if (blank($cek_nilai)) {
            foreach ($this->list_siswa as $key => $siswa) {
                PenilaianEkstrakurikuler::create(
                    [
                        'tahun' => $this->tahun,
                        'semester' => $this->semester,
                        'ekstrakurikuler_id' => $this->ekstra,
                        'nis' => $siswa->nis,
                        'kelas_id' => $siswa->kelas_id,
                        'nilai' => $this->nilai[$key]['nilai']
                    ]
                );
            }
            $this->dispatchBrowserEvent('notyf', [
                'type' => 'success',
                'message' => 'Berhasil Simpan Nilai Ekstra'
            ]);
        } else {
            foreach ($this->list_siswa as $key => $siswa) {
                PenilaianEkstrakurikuler::updateOrCreate(
                    [
                        'tahun' => $this->tahun,
                        'semester' => $this->semester,
                        'ekstrakurikuler_id' => $this->ekstra,
                        'nis' => $siswa->nis,
                        'kelas_id' => $siswa->kelas_id,
                    ],
                    [
                        'nilai' => $this->nilai[$key]['nilai']
                    ]
                );
            }
            $this->dispatchBrowserEvent('notyf', 
        [
            'type' => 'success',
            'message' => 'Berhasil Update Nilai Ekstra'
        ]);
        }
    }
    private function get_list_siswa_ekstra()
    {
        $this->list_siswa = [];
        $this->list_siswa = SiswaEkstra::where('tahun', $this->tahun)
            ->where('ekstrakurikuler_id', $this->ekstra)
            ->with(['siswa', 'kelas'])
            ->get();
    }
    private function get_nilai_ekstra()
    {
        if (!empty($this->tahun) && !empty($this->semester) && !empty($this->ekstra)) {
            $this->get_list_siswa_ekstra();
            $data_nilai = PenilaianEkstrakurikuler::where('tahun', $this->tahun)
                ->where('semester', $this->semester)
                ->where('ekstrakurikuler_id', $this->ekstra)
                ->with(['siswa'])
                ->get();

            if (blank($data_nilai)) {
                foreach ($this->list_siswa as $key => $siswa) {
                    $this->nilai[$key] = ['nilai' => ''];
                }
            } else {
                foreach ($data_nilai as $key => $nilai) {
                    $this->nilai[$key] = ['nilai' => $nilai->nilai];
                }
            }
        }
        if (empty($this->tahun) || empty($this->semester) || empty($this->ekstra)) {
            $this->list_siswa = [];
        }
    }
}
