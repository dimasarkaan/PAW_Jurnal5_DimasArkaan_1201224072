# 📄 PRINT-FRIENDLY GUIDE (Gunakan Ini Untuk Print)

> Format ini cocok untuk di-print atau di-save sebagai PDF

---

# JURNAL MODUL 5 - API TESTING GUIDE

**Tanggal**: December 3, 2025
**Project**: JURNAL_MODUL_5_REG
**Status**: ✅ SEMUA KODE SUDAH SELESAI

---

## BAGIAN 1: APA YANG SUDAH DIKERJAKAN

### Models (3 file) ✅
- User.php: HasApiTokens + trait use
- Mahasiswa.php: fillable = ['nim', 'nama', 'alamat']
- MataKuliah.php: fillable = ['kode', 'nama', 'sks']

### Database Migrations (2 file) ✅
- create_mahasiswas_table: id, nim(unique), nama, alamat, timestamps
- create_mata_kuliahs_table: id, kode(unique), nama, sks, timestamps

### Controllers (3 file) ✅
- AuthController: register, login, logout
- MahasiswaController: index, show, store, update, destroy
- MataKuliahController: index, show, store, update, destroy

### Routes (api.php) ✅
- POST /api/register
- POST /api/login
- POST /api/logout (protected)
- /api/mahasiswa (CRUD, protected)
- /api/matakuliah (CRUD, protected)

---

## BAGIAN 2: SETUP PROJECT (JALANKAN SEKALI)

### Step 1: Buka PowerShell
```
Tekan: Windows + R
Ketik: powershell
Tekan: Enter
```

### Step 2: Masuk Folder Project
```powershell
cd "e:\KULI AH\Semester\Semester 7\Pengembangan Aplikasi Website\Praktikum\JURNAL_MODUL_5_REG\JURNAL_MODUL_5_REG"
```

### Step 3: Setup (PILIH SALAH SATU)

#### OPSI A: OTOMATIS (Recommended)
```powershell
.\setup.ps1
```
Tunggu sampai selesai (2-5 menit)

#### OPSI B: MANUAL
```powershell
# 1. Install
composer install

# 2. Setup env
copy .env.example .env

# 3. Generate key
php artisan key:generate

# 4. Database
New-Item -Path "database/database.sqlite" -ItemType File -Force

# 5. Migrations
php artisan migrate
```

**Jika ditanya "Do you want to continue?", ketik: yes**

✅ Setup selesai!

---

## BAGIAN 3: MENJALANKAN SERVER

### Terminal 1 (JANGAN DITUTUP!)
```powershell
php artisan serve
```

Output harus menunjukkan:
```
INFO  Server running on [http://127.0.0.1:8000].
```

### Terminal 2 (Buka terminal baru untuk testing)
```powershell
# Jangan jalankan apa-apa di sini
# Cukup buka untuk reference/testing
```

---

## BAGIAN 4: SETUP POSTMAN

### Step 1: Download Postman
https://www.postman.com/downloads/

### Step 2: Buka Postman

### Step 3: Import Collection
1. Klik **Import** (atas kiri)
2. Pilih tab **File**
3. Cari: `JURNAL_MODUL_5_API.postman_collection.json`
4. Klik **Import**

### Step 4: Setup Variables
1. Di Collection, klik **Variables**
2. Lihat sudah ada:
   - base_url = `http://127.0.0.1:8000/api`
   - token = (kosong, nanti diisi)

✅ Postman siap!

---

## BAGIAN 5: TESTING STEP BY STEP

### TEST 1: REGISTER USER

**URL**: POST {{base_url}}/register

**Body (raw JSON)**:
```json
{
    "name": "Andi Wijaya",
    "email": "andi@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```

**Expected**: Status 201, dapat token

**SIMPAN TOKEN INI!**

---

### TEST 2: LOGIN USER

**URL**: POST {{base_url}}/login

**Body (raw JSON)**:
```json
{
    "email": "andi@example.com",
    "password": "password123"
}
```

**Expected**: Status 200, dapat token baru

---

### TEST 3: SET TOKEN

1. Di request apapun, klik **Authorization**
2. Type: **Bearer Token**
3. Token: Paste token dari login

**ATAU** di Collection Variables, set token value

---

### TEST 4: CREATE MAHASISWA

**URL**: POST {{base_url}}/mahasiswa

**Authorization**: Bearer Token

**Body (raw JSON)**:
```json
{
    "nim": "2301081001",
    "nama": "Budi Santoso",
    "alamat": "Jl. Merdeka No. 123, Jakarta"
}
```

**Expected**: Status 201, data tersimpan

---

### TEST 5: GET ALL MAHASISWA

**URL**: GET {{base_url}}/mahasiswa

**Authorization**: Bearer Token

**Expected**: Status 200, array of mahasiswa

---

### TEST 6: GET DETAIL MAHASISWA

**URL**: GET {{base_url}}/mahasiswa/1

**Authorization**: Bearer Token

**Expected**: Status 200, detail mahasiswa id=1

---

### TEST 7: UPDATE MAHASISWA

**URL**: PUT {{base_url}}/mahasiswa/1

**Authorization**: Bearer Token

**Body (raw JSON)**:
```json
{
    "nama": "Budi Santoso Updated"
}
```

**Expected**: Status 200, data terupdate

---

### TEST 8: DELETE MAHASISWA

**URL**: DELETE {{base_url}}/mahasiswa/1

**Authorization**: Bearer Token

**Expected**: Status 200, data terhapus

---

### TEST 9-13: MATAKULIAH (SAMA SEPERTI MAHASISWA)

Ulangi TEST 4-8 untuk Matakuliah dengan:

**Create:**
```json
{
    "kode": "MK001",
    "nama": "Pemrograman Web",
    "sks": 3
}
```

---

### TEST 14: LOGOUT

**URL**: POST {{base_url}}/logout

**Authorization**: Bearer Token

**Expected**: Status 200, token terhapus

---

### TEST 15: ERROR HANDLING

**URL**: GET {{base_url}}/mahasiswa (TANPA TOKEN)

**Authorization**: None

**Expected**: Status 401, message "Unauthenticated"

---

## BAGIAN 6: CHECKLIST FINAL

- [ ] Setup berhasil
- [ ] Server berjalan
- [ ] Register user berhasil
- [ ] Login user berhasil
- [ ] Create Mahasiswa (2x)
- [ ] Get All Mahasiswa
- [ ] Get Detail Mahasiswa
- [ ] Update Mahasiswa
- [ ] Delete Mahasiswa
- [ ] Create Matakuliah (2x)
- [ ] Get All Matakuliah
- [ ] Get Detail Matakuliah
- [ ] Update Matakuliah
- [ ] Delete Matakuliah
- [ ] Logout berhasil
- [ ] Error handling bekerja

**Jika semua checklist ✅, project SELESAI!**

---

## TROUBLESHOOTING CEPAT

### Error: Port 8000 dipakai
```powershell
php artisan serve --port=8001
```

### Error: "Unauthenticated"
- Token belum di-set di Authorization
- Token sudah expired → login ulang

### Error: "Database error"
```powershell
php artisan migrate:fresh
```

### Error: "Class not found"
```powershell
composer dump-autoload
```

### Error: Setup script error
```powershell
powershell -ExecutionPolicy Bypass -File .\setup.ps1
```

---

## QUICK REFERENCE COMMANDS

```powershell
# Start server
php artisan serve

# Setup otomatis
.\setup.ps1

# Manual setup
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate

# Reset database
php artisan migrate:fresh

# Update autoload
composer dump-autoload

# See logs
php artisan pail --timeout=0

# Check port
netstat -ano | findstr :8000
```

---

## FILE DOKUMENTASI

1. **STEP_BY_STEP.md** - Panduan detail (30 min)
2. **QUICK_START.md** - Ringkas (5 min)
3. **VISUAL_GUIDE_POSTMAN.md** - Visual guide (10 min)
4. **SETUP_DAN_TESTING.md** - Reference lengkap
5. **TROUBLESHOOTING.md** - 20+ error & solusi
6. **RINGKASAN_PEKERJAAN.md** - Apa sudah dikerjakan
7. **README_DOCUMENTATION.md** - Penjelasan doc
8. **INDEX.md** - Daftar semua doc

---

## ENDPOINTS SUMMARY

### Auth (Public)
- POST /api/register
- POST /api/login

### Auth (Protected)
- POST /api/logout

### Mahasiswa (Protected)
- GET /api/mahasiswa
- GET /api/mahasiswa/{id}
- POST /api/mahasiswa
- PUT /api/mahasiswa/{id}
- DELETE /api/mahasiswa/{id}

### Matakuliah (Protected)
- GET /api/matakuliah
- GET /api/matakuliah/{id}
- POST /api/matakuliah
- PUT /api/matakuliah/{id}
- DELETE /api/matakuliah/{id}

**Total: 15 endpoints**

---

## FORMAT RESPONSE

Semua response mengikuti format:
```json
{
    "success": true/false,
    "message": "String pesan",
    "data": null/object/array
}
```

---

## VALIDATION RULES

### Register
- name: required, string
- email: required, email, unique
- password: required, min 6, confirmed

### Create Mahasiswa
- nim: required, string, unique
- nama: required, string
- alamat: required, string

### Create Matakuliah
- kode: required, string, unique
- nama: required, string
- sks: required, integer

---

## DATABASE SCHEMA

### Mahasiswa Table
- id (PK)
- nim (unique)
- nama
- alamat
- timestamps (created_at, updated_at)

### Matakuliah Table
- id (PK)
- kode (unique)
- nama
- sks
- timestamps

### Users Table
- id (PK)
- name
- email (unique)
- password
- timestamps
- remember_token

---

## AUTHENTICATION

**Type**: Bearer Token (Sanctum)

**Format**:
```
Authorization: Bearer YOUR_TOKEN_HERE
```

**Token diperoleh dari**:
1. Register endpoint
2. Login endpoint

**Token digunakan untuk**:
1. Akses protected endpoints
2. Logout
3. CRUD Mahasiswa
4. CRUD Matakuliah

---

## CONTOH REQUEST CURL

### Register
```powershell
curl -X POST http://127.0.0.1:8000/api/register `
  -H "Content-Type: application/json" `
  -d '{
    "name":"Test","email":"test@ex.com",
    "password":"pass123","password_confirmation":"pass123"
  }'
```

### Login
```powershell
curl -X POST http://127.0.0.1:8000/api/login `
  -H "Content-Type: application/json" `
  -d '{"email":"test@ex.com","password":"pass123"}'
```

### Get Mahasiswa (with token)
```powershell
curl -X GET http://127.0.0.1:8000/api/mahasiswa `
  -H "Authorization: Bearer YOUR_TOKEN"
```

---

## TIPS POSTMAN

1. **Use Variables**: {{base_url}}, {{token}}
2. **Save Examples**: Response → Save as Example
3. **Use Collections**: Organize requests
4. **Tests Tab**: Auto-set token setelah login
5. **Environment**: Manage multiple servers

---

## NEXT STEPS

1. ✅ Baca documentation ini
2. ✅ Setup project dengan setup.ps1
3. ✅ Jalankan php artisan serve
4. ✅ Import Postman collection
5. ✅ Test semua 15 endpoints
6. ✅ Jika semua OK → SELESAI!

---

## INFORMASI KONTAK

Jika ada pertanyaan:
1. Cek **TROUBLESHOOTING.md**
2. Baca **SETUP_DAN_TESTING.md**
3. Lihat logs: `php artisan pail`

---

**✅ SEMUA SIAP! MULAI TESTING SEKARANG!** 🚀

---

## HALAMAN KOSONG UNTUK NOTES

```
NOTES & TODO:
_____________________________________________
_____________________________________________
_____________________________________________
_____________________________________________
_____________________________________________
_____________________________________________
_____________________________________________
_____________________________________________
_____________________________________________
_____________________________________________
```

---

**Printed on**: December 3, 2025
**Project**: JURNAL MODUL 5 API Development
**Status**: ✅ Ready for Testing & Submission
