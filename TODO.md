untuk kepentingan upload di hosting
yang perlu di rubah
Index.php di public di sesuaikan vendor/autoload.php
1. Vendor/laravel/ui/auth-backend/AuthenticatesUsers.php {
     public function username()
    {
        $login = request('username');
        if(is_numeric($login)){
            $field = 'nis';
        }else{
            $field = 'email';
        }
        request()->merge([$field => $login]);
        return $field;
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            // $this->username() => [trans('auth.failed')],
            $this->username() => 'Username / Password Salah',
        ]);
    }

     public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/login');
    }

}
2. Spatie Role tambahkan Sluggable
Vendor/spatie/laravel-permission/src/Models/Role.php
3. config/app.php
timezone, locale, faker_local id_ID

5. Karakter Siswa / Keterangan di Bimbingan - print bimbingan siswa
6. Input Skor X jumlah = Kasir
8. Menu  Siswa Kurang  Nilai 
9. Print Skor Per Siswa
11. Jurnal Guru dan Jurnal Wali Kelas - pending akhir tahun
12. Rekap Bimbingan Print
13. Rekap Skor Print - belum selesai, Rekap Skor Per Siswa / Download Per Siswa
14. Set Role Username perbaiki
15. Table User dan Set Role Perbaiki, tambahkan pencarian User
16. rekapan ekstra per kelas - buat print rekap data siswa per ekstra
17. Print data skor per siswa mengacu pada nomor 13
18. Nilai Quran - on going - kurang print per siswa
19. alpha dari skor
20. Tambah Siswa - kurang data alamat dan lain lain
22. Input Nilai Ekstra sesuaikan dengan Input Nilai SUDAH - kalau perlu buat Upload Nilai Ekstra ini belum
24. WALI KELAS DAFTAR EKSTRA SISWA PER KELASNYA
25. Rekap Absensi Bulanan, Semester, Tahun + presentase kehadiran - Menu BK