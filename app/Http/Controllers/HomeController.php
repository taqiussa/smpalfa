<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KurikulumMapel;
use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\User;
use App\Models\Kd;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    // public function pdf()
    // {
    //     return view('livewire.guru.rapor.pdf', [
    //         'kelompok_a' => KurikulumMapel::join('mata_pelajarans', 'kurikulum_mata_pelajaran.mata_pelajaran_id', '=', 'mata_pelajarans.id')
    //             ->join('kkms', 'kkms.mata_pelajaran_id', '=', 'mata_pelajarans.id')
    //             ->join('penilaians', 'penilaians.mata_pelajaran_id', '=', 'mata_pelajarans.id')
    //             ->where('kurikulum_mata_pelajaran.tahun', '2021 / 2022')
    //             ->where('kurikulum_mata_pelajaran.tingkat', 7)
    //             ->where('mata_pelajarans.kelompok', 'A')
    //             ->where('kkms.tingkat', 7)
    //             ->where('kkms.tahun', '2021 / 2022')
    //             ->where('penilaians.tahun', '2021 / 2022')
    //             ->where('penilaians.semester', 1)
    //             ->where('penilaians.nis', 210018)
    //             ->where('penilaians.kelas_id', 1)
    //             ->where('penilaians.kategori_nilai_id', 3)
    //             ->select(
    //                 'mata_pelajarans.nama as nama',
    //                 'mata_pelajarans.id as id',
    //                 'kkms.kkm as kkm',
    //                 DB::raw('round(avg(penilaians.nilai)) as nilai')
    //             )
    //             ->groupBy('nama', 'kkm', 'id')
    //             ->get(),
    //         'kelompok_b' => KurikulumMapel::join('mata_pelajarans', 'kurikulum_mata_pelajaran.mata_pelajaran_id', '=', 'mata_pelajarans.id')
    //             ->join('kkms', 'kkms.mata_pelajaran_id', '=', 'mata_pelajarans.id')
    //             ->join('penilaians', 'penilaians.mata_pelajaran_id', '=', 'mata_pelajarans.id')
    //             ->where('kurikulum_mata_pelajaran.tahun', '2021 / 2022')
    //             ->where('kurikulum_mata_pelajaran.tingkat', 7)
    //             ->where('mata_pelajarans.kelompok', 'B')
    //             ->where('kkms.tingkat', 7)
    //             ->where('kkms.tahun', '2021 / 2022')
    //             ->where('penilaians.tahun', '2021 / 2022')
    //             ->where('penilaians.semester', 1)
    //             ->where('penilaians.nis', 210018)
    //             ->where('penilaians.kelas_id', 1)
    //             ->where('penilaians.kategori_nilai_id', 3)
    //             ->select(
    //                 'mata_pelajarans.nama as nama',
    //                 'mata_pelajarans.id as id',
    //                 'kkms.kkm as kkm',
    //                 DB::raw('round(avg(penilaians.nilai)) as nilai')
    //             )
    //             ->groupBy('nama', 'kkm', 'id')
    //             ->get(),
    //         'kelompok_c' => KurikulumMapel::join('mata_pelajarans', 'kurikulum_mata_pelajaran.mata_pelajaran_id', '=', 'mata_pelajarans.id')
    //             ->join('kkms', 'kkms.mata_pelajaran_id', '=', 'mata_pelajarans.id')
    //             ->join('penilaians', 'penilaians.mata_pelajaran_id', '=', 'mata_pelajarans.id')
    //             ->where('kurikulum_mata_pelajaran.tahun', '2021 / 2022')
    //             ->where('kurikulum_mata_pelajaran.tingkat', 7)
    //             ->where('mata_pelajarans.kelompok', 'C')
    //             ->where('kkms.tingkat', 7)
    //             ->where('kkms.tahun', '2021 / 2022')
    //             ->where('penilaians.tahun', '2021 / 2022')
    //             ->where('penilaians.semester', 1)
    //             ->where('penilaians.nis', 210018)
    //             ->where('penilaians.kelas_id', 1)
    //             ->where('penilaians.kategori_nilai_id', 3)
    //             ->select(
    //                 'mata_pelajarans.nama as nama',
    //                 'mata_pelajarans.id as id',
    //                 'kkms.kkm as kkm',
    //                 DB::raw('round(avg(penilaians.nilai)) as nilai')
    //             )
    //             ->groupBy('nama', 'kkm', 'id')
    //             ->get(),
    //         'kelompok_a2' => KurikulumMapel::join('mata_pelajarans', 'kurikulum_mata_pelajaran.mata_pelajaran_id', '=', 'mata_pelajarans.id')
    //             ->join('kkms', 'kkms.mata_pelajaran_id', '=', 'mata_pelajarans.id')
    //             ->join('penilaians', 'penilaians.mata_pelajaran_id', '=', 'mata_pelajarans.id')
    //             ->where('kurikulum_mata_pelajaran.tahun', '2021 / 2022')
    //             ->where('kurikulum_mata_pelajaran.tingkat', 7)
    //             ->where('mata_pelajarans.kelompok', 'A')
    //             ->where('kkms.tingkat', 7)
    //             ->where('kkms.tahun', '2021 / 2022')
    //             ->where('penilaians.tahun', '2021 / 2022')
    //             ->where('penilaians.semester', 1)
    //             ->where('penilaians.nis', 210018)
    //             ->where('penilaians.kelas_id', 1)
    //             ->where('penilaians.kategori_nilai_id', 4)
    //             ->select(
    //                 'mata_pelajarans.nama as nama',
    //                 'mata_pelajarans.id as id',
    //                 'kkms.kkm as kkm',
    //                 DB::raw('round(avg(penilaians.nilai)) as nilai')
    //             )
    //             ->groupBy('nama', 'kkm', 'id')
    //             ->get(),
    //         'kelompok_b2' => KurikulumMapel::join('mata_pelajarans', 'kurikulum_mata_pelajaran.mata_pelajaran_id', '=', 'mata_pelajarans.id')
    //             ->join('kkms', 'kkms.mata_pelajaran_id', '=', 'mata_pelajarans.id')
    //             ->join('penilaians', 'penilaians.mata_pelajaran_id', '=', 'mata_pelajarans.id')
    //             ->where('kurikulum_mata_pelajaran.tahun', '2021 / 2022')
    //             ->where('kurikulum_mata_pelajaran.tingkat', 7)
    //             ->where('mata_pelajarans.kelompok', 'B')
    //             ->where('kkms.tingkat', 7)
    //             ->where('kkms.tahun', '2021 / 2022')
    //             ->where('penilaians.tahun', '2021 / 2022')
    //             ->where('penilaians.semester', 1)
    //             ->where('penilaians.nis', 210018)
    //             ->where('penilaians.kelas_id', 1)
    //             ->where('penilaians.kategori_nilai_id', 4)
    //             ->select(
    //                 'mata_pelajarans.nama as nama',
    //                 'mata_pelajarans.id as id',
    //                 'kkms.kkm as kkm',
    //                 DB::raw('round(avg(penilaians.nilai)) as nilai')
    //             )
    //             ->groupBy('nama', 'kkm', 'id')
    //             ->get(),
    //         'kelompok_c2' => KurikulumMapel::join('mata_pelajarans', 'kurikulum_mata_pelajaran.mata_pelajaran_id', '=', 'mata_pelajarans.id')
    //             ->join('kkms', 'kkms.mata_pelajaran_id', '=', 'mata_pelajarans.id')
    //             ->join('penilaians', 'penilaians.mata_pelajaran_id', '=', 'mata_pelajarans.id')
    //             ->where('kurikulum_mata_pelajaran.tahun', '2021 / 2022')
    //             ->where('kurikulum_mata_pelajaran.tingkat', 7)
    //             ->where('mata_pelajarans.kelompok', 'C')
    //             ->where('kkms.tingkat', 7)
    //             ->where('kkms.tahun', '2021 / 2022')
    //             ->where('penilaians.tahun', '2021 / 2022')
    //             ->where('penilaians.semester', 1)
    //             ->where('penilaians.nis', 210018)
    //             ->where('penilaians.kelas_id', 1)
    //             ->where('penilaians.kategori_nilai_id', 4)
    //             ->select(
    //                 'mata_pelajarans.nama as nama',
    //                 'mata_pelajarans.id as id',
    //                 'kkms.kkm as kkm',
    //                 DB::raw('round(avg(penilaians.nilai)) as nilai')
    //             )
    //             ->groupBy('nama', 'kkm', 'id')
    //             ->get(),
    //         'kepala_sekolah' => User::role('Kepala Sekolah')->get(),
    //     ]);
    // }
}
