<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Siswa;

class LandingController extends Controller
{
    public function detail()
    {
        $data = [
            'post' => Post::with('user')->where('slug', request('slug'))->first(),
            'siswa_kelas7' => $this->siswa_kelas7(),
            'siswa_kelas8' => $this->siswa_kelas8(),
            'siswa_kelas9' => $this->siswa_kelas9(),
            'percent_kelas7' => ((intval($this->siswa_kelas7()) / intval($this->total_siswa())) * 100 ) + 30,
            'percent_kelas8' => ((intval($this->siswa_kelas8()) / intval($this->total_siswa())) * 100 ) + 30,
            'percent_kelas9' => ((intval($this->siswa_kelas9()) / intval($this->total_siswa())) * 100 ) + 30,
        ];
        return view('post.detail',$data);
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
