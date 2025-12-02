# 📖 DOKUMENTASI PROJECT JURNAL MODUL 5

## 📋 Daftar File Dokumentasi

Saya telah membuat 5 file dokumentasi untuk memudahkan Anda:

### 1. **STEP_BY_STEP.md** ⭐ START HERE!
   - Panduan langkah demi langkah dari setup hingga testing
   - Paling detail dengan screenshot mental
   - **Rekomendasi: Baca ini terlebih dahulu**

### 2. **QUICK_START.md**
   - Versi ringkas dari STEP_BY_STEP.md
   - Cocok untuk yang sudah familiar dengan Laravel
   - Tips dan troubleshooting singkat

### 3. **SETUP_DAN_TESTING.md**
   - Panduan paling lengkap dengan semua response example
   - Reference lengkap untuk setiap endpoint
   - Format response JSON untuk setiap request

### 4. **JURNAL_MODUL_5_API.postman_collection.json**
   - File collection siap import ke Postman
   - Sudah berisi semua request (auth + mahasiswa + matakuliah)
   - Tinggal import dan langsung bisa test

### 5. **setup.ps1**
   - Script PowerShell untuk setup otomatis
   - Jalankan: `.\setup.ps1`
   - Menghandle semua setup tasks sekaligus

---

## 🎯 REKOMENDASI URUTAN PEMBACAAN

### Jika Anda BARU dengan Laravel:
1. ✅ Baca **STEP_BY_STEP.md** (20 menit)
2. ✅ Jalankan **setup.ps1** (2-5 menit)
3. ✅ Ikuti testing section dengan Postman (15 menit)
4. ✅ Refer ke **SETUP_DAN_TESTING.md** jika ada error

### Jika Anda SUDAH FAMILIAR dengan Laravel:
1. ✅ Baca **QUICK_START.md** (5 menit)
2. ✅ Jalankan setup manual atau script (2-5 menit)
3. ✅ Import **JURNAL_MODUL_5_API.postman_collection.json** (1 menit)
4. ✅ Test semua endpoint (10 menit)

---

## 📱 TESTING WORKFLOW

```
┌─────────────────────────────────────┐
│ 1. Setup Project (sekali)           │
│    ✓ composer install               │
│    ✓ .env configuration             │
│    ✓ Database migration             │
└──────────────┬──────────────────────┘
               │
               ▼
┌─────────────────────────────────────┐
│ 2. Run Server                       │
│    php artisan serve                │
│    (jangan ditutup)                 │
└──────────────┬──────────────────────┘
               │
               ▼
┌─────────────────────────────────────┐
│ 3. Buka Postman                     │
│    ✓ Import collection              │
│    ✓ Setup variables                │
└──────────────┬──────────────────────┘
               │
               ▼
┌─────────────────────────────────────┐
│ 4. Test Endpoints                   │
│    ✓ Register → Login → Logout      │
│    ✓ CRUD Mahasiswa                 │
│    ✓ CRUD Matakuliah                │
└─────────────────────────────────────┘
```

---

## 🚀 QUICK COMMANDS

### Setup (jalankan sekali)
```powershell
# Option 1: Otomatis
.\setup.ps1

# Option 2: Manual
composer install
copy .env.example .env
php artisan key:generate
New-Item -Path "database/database.sqlite" -ItemType File -Force
php artisan migrate
```

### Run Development
```powershell
php artisan serve
```

### Reset Database
```powershell
php artisan migrate:fresh
```

### Check Dependencies
```powershell
composer update
```

---

## 📚 ENDPOINT SUMMARY

### Authentication
- `POST /api/register` - Register user baru
- `POST /api/login` - Login dan dapatkan token
- `POST /api/logout` - Logout (butuh token)

### Mahasiswa (Semua butuh token)
- `GET /api/mahasiswa` - Lihat semua
- `GET /api/mahasiswa/{id}` - Lihat detail
- `POST /api/mahasiswa` - Tambah data
- `PUT /api/mahasiswa/{id}` - Update data
- `DELETE /api/mahasiswa/{id}` - Hapus data

### Matakuliah (Semua butuh token)
- `GET /api/matakuliah` - Lihat semua
- `GET /api/matakuliah/{id}` - Lihat detail
- `POST /api/matakuliah` - Tambah data
- `PUT /api/matakuliah/{id}` - Update data
- `DELETE /api/matakuliah/{id}` - Hapus data

---

## 🔑 IMPORTANT NOTES

### 1. Token Management
- Token didapat setelah register/login
- Token digunakan untuk semua request protected
- Format: `Authorization: Bearer YOUR_TOKEN_HERE`
- Jangan share token ke orang lain

### 2. Database
- Project ini menggunakan SQLite
- File database: `database/database.sqlite`
- Dibuat otomatis saat migration
- Data hilang jika `php artisan migrate:fresh`

### 3. Environment
- File `.env` berisi konfigurasi
- Generated dari `.env.example`
- Jangan upload `.env` ke git

### 4. Validation
- NIM mahasiswa: unique, string, required
- Email user: unique, email, required
- Kode matakuliah: unique, string, required

---

## 💡 TIPS POSTMAN

### Auto-Set Token
Tambahkan ke tab **Tests** di request login:
```javascript
var jsonData = pm.response.json();
pm.environment.set("token", jsonData.token);
```

### Save Request Response
Klik **Save as Example** untuk simpan response

### Use Variables
- `{{base_url}}` = http://127.0.0.1:8000/api
- `{{token}}` = Token dari login/register

---

## ⚠️ COMMON MISTAKES

1. ❌ **Lupa set Authorization token**
   - ✅ Pastikan token ada di tab Authorization

2. ❌ **Port 8000 sudah dipakai**
   - ✅ Gunakan port lain: `php artisan serve --port=8001`

3. ❌ **Email duplicate saat register**
   - ✅ Gunakan email berbeda atau bersihkan database

4. ❌ **NIM duplicate saat create mahasiswa**
   - ✅ Gunakan NIM berbeda

5. ❌ **Database error**
   - ✅ Jalankan: `php artisan migrate:fresh`

---

## 📞 TROUBLESHOOTING

Jika ada masalah:

1. **Cek server berjalan:**
   ```powershell
   curl http://127.0.0.1:8000/api/login
   ```
   Harus return: `{"message":"Unauthorized"}`

2. **Reset database:**
   ```powershell
   php artisan migrate:fresh
   ```

3. **Refresh Postman:**
   - Tutup dan buka ulang Postman
   - Pastikan collection sudah di-import

4. **Check Laravel logs:**
   ```powershell
   # Terminal baru, di folder project
   php artisan pail --timeout=0
   ```

---

## 🎓 LEARNING RESOURCES

- Laravel Official: https://laravel.com/docs
- Laravel Sanctum: https://laravel.com/docs/sanctum
- API Resource: https://laravel.com/docs/eloquent-resources
- RESTful API Best Practices: https://restfulapi.net

---

## 📝 FILE STRUCTURE

```
JURNAL_MODUL_5_REG/
├── 📄 STEP_BY_STEP.md                    ⭐ Baca ini dulu
├── 📄 QUICK_START.md                     Ringkas
├── 📄 SETUP_DAN_TESTING.md               Lengkap
├── 📄 JURNAL_MODUL_5_API.postman_collection.json   Import ini
├── 🐚 setup.ps1                          Script setup
│
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php            ✅ Sudah selesai
│   │   ├── MahasiswaController.php       ✅ Sudah selesai
│   │   └── MataKuliahController.php      ✅ Sudah selesai
│   ├── Models/
│   │   ├── User.php                      ✅ Sudah selesai
│   │   ├── Mahasiswa.php                 ✅ Sudah selesai
│   │   └── MataKuliah.php                ✅ Sudah selesai
│   └── Http/Resources/
│       ├── MahasiswaResource.php
│       └── MatakuliahResource.php
│
├── database/
│   ├── migrations/
│   │   ├── create_users_table.php
│   │   ├── create_mahasiswas_table.php   ✅ Sudah selesai
│   │   └── create_mata_kuliahs_table.php ✅ Sudah selesai
│   └── database.sqlite                   (dibuat otomatis)
│
├── routes/
│   └── api.php                           ✅ Sudah selesai
│
└── ...
```

---

## ✅ FINAL CHECKLIST

Sebelum submit:
- [ ] Semua 4 dokumentasi sudah dibaca
- [ ] Setup project berhasil
- [ ] Server berjalan di port 8000
- [ ] Collection Postman sudah di-import
- [ ] Semua 15 test endpoint berhasil
- [ ] Response sesuai dengan dokumentasi
- [ ] Token management berfungsi
- [ ] Error handling teruji

---

## 🎉 SELESAI!

Jika semua langkah sudah selesai, project siap untuk:
- ✅ Presentasi
- ✅ Testing
- ✅ Submission
- ✅ Production deployment

**Good luck! 🚀**
