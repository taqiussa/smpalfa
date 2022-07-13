<?php

namespace App\Http\Livewire\Landing;

use App\Models\Post;
use App\Models\Siswa;
use App\Traits\GetData;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{
    use GetData;
    use WithPagination;

    public $tahun;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $this->get_tahun();
        $data = [
            'list_post' => Post::with('user')->orderBy('created_at', 'desc')->paginate(5),
            'siswa_kelas7' => $this->siswa_kelas7(),
            'siswa_kelas8' => $this->siswa_kelas8(),
            'siswa_kelas9' => $this->siswa_kelas9(),
            'percent_kelas7' => ((intval($this->siswa_kelas7()) / intval($this->total_siswa())) * 100 ) + 30,
            'percent_kelas8' => ((intval($this->siswa_kelas8()) / intval($this->total_siswa())) * 100 ) + 30,
            'percent_kelas9' => ((intval($this->siswa_kelas9()) / intval($this->total_siswa())) * 100 ) + 30,
        ];
        return view('livewire.landing.posts', $data)
        ->layout('landing');
    }

    private function siswa_kelas7()
    {
        return Siswa::where('tahun', $this->tahun)
        ->where('tingkat', 7)
        ->count();
    }
    private function siswa_kelas8()
    {
        return Siswa::where('tahun', $this->tahun)
        ->where('tingkat', 8)
        ->count();
    }
    private function siswa_kelas9()
    {
        return Siswa::where('tahun', $this->tahun)
        ->where('tingkat', 9)
        ->count();
    }
    private function total_siswa()
    {
        return Siswa::where('tahun', $this->tahun)->count();
    }
}
