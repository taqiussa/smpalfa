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
}
2. Spatie Role tambahkan Sluggable
Vendor/spatie/laravel-permission/src/Models/Role.php
3. config/app.php
timezone, locale, faker_local id_ID

4. ABSENSI EKSTRA - Print absensi Ekstra - Done
5. Karakter Siswa / Keterangan di Bimbingan - print bimbingan siswa
6. Input Skor X jumlah = Kasir
7. Bendahara Done
8. Siswa
9. Print Skor Per Siswa
10. Rapor Draft Nilai Per Mapel
11. Jurnal Guru dan Jurnal Wali Kelas
12. Rekap Bimbingan Print
13. Rekap Skor Print - belum selesai, tanda tangan , tambahkan lagi sesuai BK yang mengampu
14. Set Role Username perbaiki
15. Table User dan Set Role Perbaiki, tambahkan pencarian User
16. rekapan ekstra per kelas
17. data skor per siswa
18. Nilai Quran - on going
19. alpha dari skor