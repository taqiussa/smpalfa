<?php

namespace App\Http\Livewire\Landing;

use App\Models\Post;
use App\Models\Siswa;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public function render()
    {
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
        return Siswa::where('tahun', '2021 / 2022')
        ->where('tingkat', 7)
        ->count();
    }
    private function siswa_kelas8()
    {
        return Siswa::where('tahun', '2021 / 2022')
        ->where('tingkat', 8)
        ->count();
    }
    private function siswa_kelas9()
    {
        return Siswa::where('tahun', '2021 / 2022')
        ->where('tingkat', 9)
        ->count();
    }
    private function total_siswa()
    {
        return Siswa::where('tahun', '2021 / 2022')->count();
    }
}
