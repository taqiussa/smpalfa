<?php

namespace App\Http\Livewire\Kurikulum\Kurikulum;

use App\Models\Kurikulum;
use App\Models\KurikulumMapel;
use App\Models\MataPelajaran as ModelsMataPelajaran;
use Livewire\Component;

class MataPelajaran extends Component
{
    //model
    public $kurikulum;
    public $tahun;
    public $is_edit;
    public $mata_pelajaran;
    public $tingkat;

    //array
    public $list_kurikulum;
    public $list_kurikulum_mata_pelajaran = [];
    public $list_mata_pelajaran;

    protected $listeners =
    [
        'delete' => 'delete'
    ];
    protected $rules = [
    'kurikulum' => 'required',
    'tahun' => 'required',
    'tingkat' => 'required',
    'mata_pelajaran' => 'required'
    ];
    public function render()
    {
        return view('livewire.kurikulum.kurikulum.mata-pelajaran');
    }

    public function mount()
    {
        $tahunIni = gmdate('Y');
        $bulanIni = gmdate('m');
        if ($bulanIni <= 6) {
            $this->tahun = (intval($tahunIni) - 1) . ' / ' . intval($tahunIni);
        } else {
            $this->tahun = intval($tahunIni) . ' / ' . (intval($tahunIni) + 1);
        }
        $this->kurikulum = 1;
        $this->list_kurikulum = Kurikulum::orderBy('nama')->get();
        $this->list_mata_pelajaran = ModelsMataPelajaran::orderBy('kelompok')->orderBy('nama')->get();
        $this->list_kurikulum_mata_pelajaran = Kurikulum::find($this->kurikulum)->mapels($this->tahun, $this->tingkat)->get();
        $id_mata_pelajaran = KurikulumMapel::where('kurikulum_id', $this->kurikulum)
            ->where('tahun', $this->tahun)
            ->where('tingkat', $this->tingkat)
            ->pluck('mata_pelajaran_id');
        $this->list_mata_pelajaran = ModelsMataPelajaran::whereNotIn('id', $id_mata_pelajaran)->get();
    }
    public function updatedKurikulum()
    {
        $this->get_kurikulum();
    }
    public function updatedTahun()
    {
        $this->get_kurikulum();
    }
    public function updatedTingkat()
    {
        $this->get_kurikulum();
    }
    public function simpan()
    {
        $this->validate();
        $kurikulum = Kurikulum::find($this->kurikulum);
        $kurikulum->mapels($this->tahun, $this->tingkat)->attach($this->mata_pelajaran, ['tahun' => $this->tahun, 'tingkat' => $this->tingkat]);
        $this->dispatchBrowserEvent('notyf', [
            'type' => 'success',
            'message' => 'Berhasil Mengatur Kurikulum'
        ]);
        $this->get_kurikulum();
    }
    public function confirm($id)
    {
        $this->dispatchBrowserEvent(
            'confirm',
            [
                'title' => 'Menghapus Mata Pelajaran',
                'text' => 'Apakah Anda Yakin Menghapus Mata Pelajaran ?',
                'id' => $id
            ]
        );
    }
    public function delete($id)
    {
        $kurikulum = Kurikulum::find($this->kurikulum);
        $kurikulum->mapels($this->tahun, $this->tingkat)->detach($id, ['tahun' => $this->tahun, 'tingkat' => $this->tingkat]);
        $this->dispatchBrowserEvent('notyf', [
            'type' => 'success',
            'message' => 'Berhasil Menghapus Mata Pelajaran'
        ]);
        $this->get_kurikulum();
    }
    private function get_kurikulum()
    {

        $id_mata_pelajaran = KurikulumMapel::where('kurikulum_id', $this->kurikulum)
            ->where('tahun', $this->tahun)
            ->where('tingkat', $this->tingkat)
            ->pluck('mata_pelajaran_id');
        $this->list_mata_pelajaran = ModelsMataPelajaran::whereNotIn('id', $id_mata_pelajaran)->get();
        $kurikulum = Kurikulum::find($this->kurikulum)->mapels($this->tahun, $this->tingkat)->get();
        $this->list_kurikulum_mata_pelajaran = $kurikulum;
    }
}
