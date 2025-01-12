## Resong Residence Web App
Whats New ?

- Done Login Form (17 February 2024)
    - Run php artisan migrate
    - run php artisan db:seed SuperuserSeed
    - npm install && npm run dev
- login with default SUPERADMIN user
    - username : super.user
    - password : 123qweasd

##Next Progress Payroll Karyawan
- Edit Komponen gaji
- Process Payroll per Karyawan
- Disbursment Proccess


update note 4/01/2025
5. show daftar hadir not work (Elan) (untuk ini sepertinya perlu naik ke staging dengan data asli dari device fingerprint biar tau dimana masalahnya, karna dari branch maulana aman)✅
6. transaksi asset keluar error : SQLSTATE[23000]: Integrity constraint violation: 1048 Column 'supplier_asset_id' cannot be null (elan) (harus isi supplier, kategori, nama asste dulu, baru transaksi)✅
7. gagal upload gambar menu (Elan) kemungkinan masalah permission (tambahkan storage link dan FILESYSTEM_DRIVER=public di env)✅
8. menu breakfast null exception (Elan) (sudah di tambahkan validasi jika checkbox kosong)✅
9. tambahkan email di daftar karyawan(Elan) ✅
