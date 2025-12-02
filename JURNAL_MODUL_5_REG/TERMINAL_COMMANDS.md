# 🖥️ SEMUA TERMINAL COMMANDS - DARI AWAL HINGGA AKHIR

## ⚠️ PENTING: Copy-paste commands satu per satu, jangan sekaligus!

---

## TAHAP 1: SETUP PROJECT (Jalankan Sekali)

### Command 1: Masuk Folder Project
```powershell
cd "E:\KULI AH\Semester\Semester 7\Pengembangan Aplikasi Website\Praktikum\JURNAL_MODUL_5_REG\JURNAL_MODUL_5_REG"
```
**Output yang diharapkan:**
```
PS E:\KULI AH\Semester\Semester 7\Pengembangan Aplikasi Website\Praktikum\JURNAL_MODUL_5_REG\JURNAL_MODUL_5_REG>
```

---

### Command 2: Verifikasi Folder
```powershell
Get-ChildItem -Name | head -20
```
**Output yang diharapkan:**
```
artisan
composer.json
composer.lock
app
bootstrap
config
database
...
```

---

### Command 3: Install Dependencies (TUNGGU SAMPAI SELESAI!)
```powershell
composer install
```
**Status yang diharapkan:**
```
Loading composer repositories with package information
Installing dependencies from lock file
...
(Tunggu 2-5 menit, jangan close terminal!)
```

**Tanda selesai:**
```
Generating autoload files
...
```

---

### Command 4: Copy Environment File
```powershell
copy .env.example .env
```
**Output yang diharapkan:**
```
(Tidak ada output, tapi file .env sudah ter-copy)
```

**Verifikasi:**
```powershell
Test-Path .env
```
**Harus output:** `True`

---

### Command 5: Generate Application Key
```powershell
php artisan key:generate
```
**Output yang diharapkan:**
```
   INFO  Application key set successfully.
```

---

### Command 6: Buat Database File
```powershell
New-Item -Path "database/database.sqlite" -ItemType File -Force
```
**Output yang diharapkan:**
```
    Directory: E:\...\database

Mode                 LastWriteTime         Length Name
----                 -------------         ------ ----
-a---          12/3/2025  XX:XX:XX          0      database.sqlite
```

---

### Command 7: Jalankan Database Migrations
```powershell
php artisan migrate
```

**Pertanyaan yang muncul:**
```
Would you like to create it? (yes/no) [no]: yes
```
**Jawab:** `yes` lalu tekan Enter

**Pertanyaan berikutnya:**
```
Do you want to continue? (yes/no) [no]:
```
**Jawab:** `yes` lalu tekan Enter

**Output yang diharapkan:**
```
Migrating: 0001_01_01_000000_create_users_table
Migrated:  0001_01_01_000000_create_users_table (X.XXs)

Migrating: 0001_01_01_000001_create_cache_table
Migrated:  0001_01_01_000001_create_cache_table (X.XXs)

Migrating: 0001_01_01_000002_create_jobs_table
Migrated:  0001_01_01_000002_create_jobs_table (X.XXs)

Migrating: 2025_05_12_125336_create_mahasiswas_table
Migrated:  2025_05_12_125336_create_mahasiswas_table (X.XXs)

Migrating: 2025_05_12_125339_create_mata_kuliahs_table
Migrated:  2025_05_12_125339_create_mata_kuliahs_table (X.XXs)

Migrating: 2025_05_12_135701_create_personal_access_tokens_table
Migrated:  2025_05_12_135701_create_personal_access_tokens_table (X.XXs)
```

✅ **SETUP SELESAI!**

---

## TAHAP 2: JALANKAN SERVER

### Command 8: Start Development Server
```powershell
php artisan serve
```

**Output yang diharapkan:**
```
INFO  Server running on [http://127.0.0.1:8000].

   GET|POST|PUT|PATCH|DELETE|HEAD /
   POST /api/register
   POST /api/login
   Middleware: web

   GET http://127.0.0.1:8000
```

⚠️ **JANGAN TUTUP TERMINAL INI!**
⚠️ **BIARKAN SERVER TETAP BERJALAN DI BACKGROUND!**

---

## TAHAP 3: BUKA TERMINAL BARU UNTUK TESTING

### Di Terminal Baru (Ctrl+Shift+N atau Terminal Baru):

### Command 9: Verifikasi Server Berjalan
```powershell
curl http://127.0.0.1:8000/api/login
```

**Output yang diharapkan:**
```json
{"message":"Unauthorized"}
```

✅ **Server berhasil dijalankan!**

---

## TAHAP 4: POSTMAN TESTING (GUI, tidak ada command terminal)

### Langkah di Postman (tidak ada command, tapi dokumentasikan):

#### 1. Import Collection
- File: `JURNAL_MODUL_5_API.postman_collection.json`
- Klik Import

#### 2. Setup Variables
```
base_url = http://127.0.0.1:8000/api
token = (kosong, nanti diisi)
```

#### 3. TEST 1: Register User
```
POST /api/register

Body (raw JSON):
{
    "name": "Andi Wijaya",
    "email": "andi@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}

Response: 201 Created
{
    "message": "User berhasil terdaftar",
    "user": {...},
    "token": "XXXXX"  ← SIMPAN INI!
}
```

#### 4. TEST 2: Login User
```
POST /api/login

Body (raw JSON):
{
    "email": "andi@example.com",
    "password": "password123"
}

Response: 200 OK
{
    "message": "Login berhasil",
    "user": {...},
    "token": "XXXXX"
}
```

#### 5. Set Token untuk Request Berikutnya
```
Di setiap request, Authorization tab:
Type: Bearer Token
Token: Paste token dari register/login
```

#### 6. TEST 3: Create Mahasiswa
```
POST /api/mahasiswa

Authorization: Bearer Token

Body (raw JSON):
{
    "nim": "2301081001",
    "nama": "Budi Santoso",
    "alamat": "Jl. Merdeka No. 123, Jakarta"
}

Response: 201 Created
```

#### 7. TEST 4: Get All Mahasiswa
```
GET /api/mahasiswa

Authorization: Bearer Token

Response: 200 OK
[
    {
        "id": 1,
        "nim": "2301081001",
        "nama": "Budi Santoso",
        ...
    }
]
```

#### 8. TEST 5: Get Detail Mahasiswa
```
GET /api/mahasiswa/1

Authorization: Bearer Token

Response: 200 OK
```

#### 9. TEST 6: Update Mahasiswa
```
PUT /api/mahasiswa/1

Authorization: Bearer Token

Body (raw JSON):
{
    "nama": "Budi Santoso Updated"
}

Response: 200 OK
```

#### 10. TEST 7: Delete Mahasiswa
```
DELETE /api/mahasiswa/1

Authorization: Bearer Token

Response: 200 OK
```

#### 11. TEST 8-13: Ulangi untuk Matakuliah

#### 14. TEST 14: Logout
```
POST /api/logout

Authorization: Bearer Token

Response: 200 OK
{
    "message": "Logout berhasil"
}
```

#### 15. TEST 15: Error Handling
```
GET /api/mahasiswa

Authorization: NONE (kosong!)

Response: 401 Unauthorized
{
    "message": "Unauthenticated."
}
```

---

## TAHAP 5: COMMAND UTILITY (Jika Ada Error)

### Jika perlu reset database:
```powershell
php artisan migrate:fresh
```

**Pertanyaan:**
```
Do you want to continue? (yes/no) [no]:
```
**Jawab:** `yes`

**Output:**
```
Dropping all tables ...
Dropped all tables successfully

Migrating: ...
```

---

### Jika perlu update autoload:
```powershell
composer dump-autoload
```

---

### Jika perlu lihat logs real-time:
```powershell
php artisan pail --timeout=0
```

**Akan menampilkan logs secara real-time**

---

### Jika port 8000 sudah dipakai:
```powershell
php artisan serve --port=8001
```

**Ganti base_url di Postman ke:** `http://127.0.0.1:8001/api`

---

### Jika perlu cek port yang berjalan:
```powershell
netstat -ano | findstr :8000
```

---

### Jika perlu kill process di port 8000:
```powershell
$process = Get-NetTCPConnection -LocalPort 8000 -ErrorAction SilentlyContinue
if ($process) { Stop-Process -Id $process.OwningProcess -Force }
```

---

## 📋 URUTAN LENGKAP (COPY PASTE)

### Bagian 1: Setup (Jalankan Sekali)
```powershell
# 1. Masuk folder
cd "E:\KULI AH\Semester\Semester 7\Pengembangan Aplikasi Website\Praktikum\JURNAL_MODUL_5_REG\JURNAL_MODUL_5_REG"

# 2. Verifikasi
Get-ChildItem -Name | head -20

# 3. Install dependencies (tunggu sampai selesai!)
composer install

# 4. Copy .env
copy .env.example .env

# 5. Generate key
php artisan key:generate

# 6. Buat database
New-Item -Path "database/database.sqlite" -ItemType File -Force

# 7. Migrate (jawab: yes, yes)
php artisan migrate
```

---

### Bagian 2: Jalankan Server (Jangan Tutup!)
```powershell
php artisan serve
```

**Tunggu sampai muncul:**
```
INFO  Server running on [http://127.0.0.1:8000].
```

**Biarkan running di background**

---

### Bagian 3: Terminal Baru, Test Server
```powershell
# Verifikasi server berjalan
curl http://127.0.0.1:8000/api/login

# Harus output:
# {"message":"Unauthorized"}
```

---

### Bagian 4: Postman Testing
1. Import collection: `JURNAL_MODUL_5_API.postman_collection.json`
2. Setup variables
3. Test semua 15 endpoints
4. Lihat response untuk setiap endpoint

---

## 🎯 COMMAND RINGKAS

| Perintah | Fungsi | Output |
|----------|--------|--------|
| `composer install` | Install dependencies | Loading composer... |
| `copy .env.example .env` | Copy environment | (Silent) |
| `php artisan key:generate` | Generate key | INFO Application key set successfully |
| `New-Item -Path "database/database.sqlite" -ItemType File -Force` | Buat database | File dibuat |
| `php artisan migrate` | Jalankan migrations | Migrated: ... |
| `php artisan serve` | Jalankan server | Server running on http://127.0.0.1:8000 |
| `curl http://127.0.0.1:8000/api/login` | Test server | {"message":"Unauthorized"} |
| `php artisan migrate:fresh` | Reset database | Dropped all tables... Migrated... |
| `php artisan pail --timeout=0` | Lihat logs | Real-time logs |

---

## ✅ CHECKLIST TERMINAL

- [ ] Command 1: Masuk folder
- [ ] Command 2: Verifikasi folder
- [ ] Command 3: Composer install (tunggu 2-5 min)
- [ ] Command 4: Copy .env
- [ ] Command 5: Generate key
- [ ] Command 6: Buat database
- [ ] Command 7: Migrate (jawab: yes, yes)
- [ ] Command 8: Jalankan server (jangan tutup!)
- [ ] Command 9: Test server di terminal baru
- [ ] Postman: Import collection & test
- [ ] ✅ SELESAI!

---

## 💾 COPY PASTE SIAP PAKAI

### Copy-paste ini ke terminal satu per satu:

**Step 1:**
```
composer install
```
Tunggu selesai!

**Step 2:**
```
copy .env.example .env
```

**Step 3:**
```
php artisan key:generate
```

**Step 4:**
```
New-Item -Path "database/database.sqlite" -ItemType File -Force
```

**Step 5:**
```
php artisan migrate
```
Jawab: `yes` lalu `yes`

**Step 6:**
```
php artisan serve
```
Tunggu sampai: `Server running on http://127.0.0.1:8000`
**JANGAN TUTUP!**

**Step 7 (Terminal Baru):**
```
curl http://127.0.0.1:8000/api/login
```

---

**🚀 Selesai! Sekarang buka Postman dan mulai testing!**
