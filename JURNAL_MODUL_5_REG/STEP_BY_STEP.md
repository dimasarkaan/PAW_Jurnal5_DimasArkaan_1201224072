# 🎯 URUTAN LANGKAH LENGKAP (STEP BY STEP)

## BAGIAN 1: SETUP PROJECT (Jalankan Sekali)

### Step 1️⃣ - Buka PowerShell/Terminal
```
Tekan Windows + R, ketik 'powershell', Enter
```

### Step 2️⃣ - Masuk ke Folder Project
```powershell
cd "e:\KULI AH\Semester\Semester 7\Pengembangan Aplikasi Website\Praktikum\JURNAL_MODUL_5_REG\JURNAL_MODUL_5_REG"
```

### Step 3️⃣ - PILIH SALAH SATU:

#### OPSI A: SETUP OTOMATIS (Recommended)
```powershell
.\setup.ps1
```
✅ Semua otomatis, tunggu selesai

#### OPSI B: SETUP MANUAL
```powershell
# A1. Install dependencies (tunggu 2-5 menit)
composer install

# A2. Copy environment file
copy .env.example .env

# A3. Generate application key
php artisan key:generate

# A4. Setup database SQLite
New-Item -Path "database/database.sqlite" -ItemType File -Force

# A5. Jalankan migrations (ketik 'yes' jika ditanya)
php artisan migrate
```

✅ Setelah ini, setup selesai!

---

## BAGIAN 2: MENJALANKAN SERVER (Jalankan Setiap Kali)

### Step 4️⃣ - Jalankan Laravel Development Server
```powershell
php artisan serve
```

Tunggu sampai keluar pesan:
```
   INFO  Server running on [http://127.0.0.1:8000].
```

⚠️ **JANGAN TUTUP TERMINAL INI!** Biarkan berjalan di background

### Step 5️⃣ - BUKA TERMINAL BARU untuk testing (Ctrl+Shift+N atau Terminal Baru)

---

## BAGIAN 3: TEST DI POSTMAN (Step by Step)

### Step 6️⃣ - Download & Buka Postman
https://www.postman.com/downloads/

### Step 7️⃣ - Import Collection
1. **Buka Postman**
2. Klik tombol **Import** (atas kiri)
3. Pilih tab **File**
4. Cari dan pilih: `JURNAL_MODUL_5_API.postman_collection.json`
5. Klik **Import**

### Step 8️⃣ - Setup Environment Variables (PENTING!)

#### Cara 1: Melalui Collection
1. Di Postman, buka Collection `JURNAL_MODUL_5_API`
2. Klik tab **Variables**
3. Verifikasi sudah ada:
   - `base_url` = `http://127.0.0.1:8000/api`
   - `token` = (kosong, nanti diisi)

#### Cara 2: Melalui Environment (Optional)
1. Klik **Environment** (kiri bawah)
2. Klik **Create**
3. Nama: `Jurnal_Modul_5`
4. Tambah variables:
   ```
   base_url: http://127.0.0.1:8000/api
   token: (kosong)
   ```
5. **Save**

---

## BAGIAN 4: TESTING REQUESTS

### TEST 1️⃣ - REGISTER USER
```
📌 PALING PENTING DULU!
```

**Buka request:** Authentication → Register User

**Setup:**
- Method: POST
- URL: `http://127.0.0.1:8000/api/register`

**Body (raw JSON):**
```json
{
    "name": "Andi Wijaya",
    "email": "andi@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```

**Klik SEND**

✅ **Expected Response (201):**
```json
{
    "message": "User berhasil terdaftar",
    "user": {
        "name": "Andi Wijaya",
        "email": "andi@example.com",
        "id": 1,
        "created_at": "...",
        "updated_at": "..."
    },
    "token": "XXXXXX_TOKEN_XXXXXX"
}
```

💾 **SIMPAN TOKEN INI!** Contoh: `1|AbCdEfGhIjKlMnOpQrStUvWxYz...`

---

### TEST 2️⃣ - LOGIN USER

**Buka request:** Authentication → Login User

**Body (raw JSON):**
```json
{
    "email": "andi@example.com",
    "password": "password123"
}
```

**Klik SEND**

✅ **Expected Response (200):**
```json
{
    "message": "Login berhasil",
    "user": {...},
    "token": "NEW_TOKEN_HERE"
}
```

---

### TEST 3️⃣ - SET TOKEN UNTUK REQUEST BERIKUTNYA

**PENTING! Sebelum test request yang butuh token:**

1. Di Postman, cari request yang akan ditest
2. **Klik tab Authorization** (di bawah URL)
3. **Type: Bearer Token**
4. **Token:** Paste token dari register/login

Contoh: `1|AbCdEfGhIjKlMnOpQrStUvWxYz...`

### Atau: Set di Variables
1. Klik **Variables** di collection
2. Paste token ke field `token`
3. Semua request otomatis menggunakan token tersebut

---

### TEST 4️⃣ - CREATE MAHASISWA

**Buka request:** Mahasiswa → Create Mahasiswa

**Authorization:** Bearer Token (sudah setup di Step 3)

**Body (raw JSON):**
```json
{
    "nim": "2301081001",
    "nama": "Budi Santoso",
    "alamat": "Jl. Merdeka No. 123, Jakarta"
}
```

**Klik SEND**

✅ **Expected Response (201):**
```json
{
    "success": true,
    "message": "Data Mahasiswa Berhasil Ditambahkan!",
    "data": {
        "id": 1,
        "nim": "2301081001",
        "nama": "Budi Santoso",
        "alamat": "Jl. Merdeka No. 123, Jakarta",
        "created_at": "...",
        "updated_at": "..."
    }
}
```

---

### TEST 5️⃣ - GET ALL MAHASISWA

**Buka request:** Mahasiswa → Get All Mahasiswa

**Authorization:** Bearer Token

**Klik SEND**

✅ **Expected Response (200):**
```json
{
    "success": true,
    "message": "Data Mahasiswa Berhasil Diambil",
    "data": [
        {
            "id": 1,
            "nim": "2301081001",
            "nama": "Budi Santoso",
            ...
        }
    ]
}
```

---

### TEST 6️⃣ - GET MAHASISWA BY ID (Detail)

**Buka request:** Mahasiswa → Get Mahasiswa by ID

**Authorization:** Bearer Token

**URL:** `{{base_url}}/mahasiswa/1` (atau `/2`, `/3`, dst)

**Klik SEND**

✅ **Expected Response (200):**
```json
{
    "success": true,
    "message": "Data Mahasiswa Berhasil Diambil",
    "data": {
        "id": 1,
        "nim": "2301081001",
        "nama": "Budi Santoso",
        ...
    }
}
```

---

### TEST 7️⃣ - UPDATE MAHASISWA

**Buka request:** Mahasiswa → Update Mahasiswa

**Authorization:** Bearer Token

**URL:** `{{base_url}}/mahasiswa/1`

**Body (raw JSON):**
```json
{
    "nama": "Budi Santoso Updated",
    "alamat": "Jl. Ahmad Yani No. 456, Bandung"
}
```

**Klik SEND**

✅ **Expected Response (200):**
```json
{
    "success": true,
    "message": "Data Mahasiswa Berhasil Diubah!",
    "data": {
        "id": 1,
        "nim": "2301081001",
        "nama": "Budi Santoso Updated",
        "alamat": "Jl. Ahmad Yani No. 456, Bandung",
        ...
    }
}
```

---

### TEST 8️⃣ - DELETE MAHASISWA

**Buka request:** Mahasiswa → Delete Mahasiswa

**Authorization:** Bearer Token

**URL:** `{{base_url}}/mahasiswa/1`

**Klik SEND**

✅ **Expected Response (200):**
```json
{
    "success": true,
    "message": "Data Mahasiswa Berhasil Dihapus!",
    "data": null
}
```

---

### TEST 9️⃣ - MATAKULIAH (Sama seperti Mahasiswa)

Lakukan hal yang sama untuk Matakuliah:

**Create Matakuliah:**
```json
{
    "kode": "MK001",
    "nama": "Pemrograman Web",
    "sks": 3
}
```

**Get All, Get by ID, Update, Delete** → Ikuti pattern yang sama

---

### TEST 🔟 - LOGOUT

**Buka request:** Authentication → Logout User

**Authorization:** Bearer Token

**Klik SEND**

✅ **Expected Response (200):**
```json
{
    "message": "Logout berhasil"
}
```

---

## ❌ TROUBLESHOOTING

### ❌ Error: "Port 8000 already in use"
```powershell
php artisan serve --port=8001
```
Ganti base_url di Postman ke `http://127.0.0.1:8001/api`

### ❌ Error: "Unauthenticated"
- ✅ Pastikan token sudah di-copy dengan benar
- ✅ Format di Postman: `Bearer TOKEN_HERE` (ada spasi)
- ✅ Login ulang untuk token baru

### ❌ Error: "Validation error" di register
- ✅ Email sudah digunakan → gunakan email berbeda
- ✅ Password tidak cocok dengan confirmation

### ❌ Error: "Data tidak ditemukan" di update/delete
- ✅ ID tidak ada di database → cek Get All dulu
- ✅ Gunakan ID yang benar

### ❌ Error: "SQLSTATE" atau database error
```powershell
php artisan migrate:fresh
```

### ❌ Error: "Class not found"
```powershell
composer dump-autoload
```

---

## ✅ FINAL CHECKLIST

Pastikan semua ini berhasil sebelum submit:

- [ ] `php artisan serve` berjalan di port 8000
- [ ] Collection Postman sudah di-import
- [ ] Register user berhasil & dapat token
- [ ] Login user berhasil
- [ ] Create Mahasiswa berhasil (minimal 2 data)
- [ ] Get All Mahasiswa menampilkan semua
- [ ] Get Detail Mahasiswa menampilkan 1 data
- [ ] Update Mahasiswa berhasil
- [ ] Delete Mahasiswa berhasil
- [ ] Create Matakuliah berhasil (minimal 2 data)
- [ ] Get All Matakuliah menampilkan semua
- [ ] Get Detail Matakuliah menampilkan 1 data
- [ ] Update Matakuliah berhasil
- [ ] Delete Matakuliah berhasil
- [ ] Logout user berhasil
- [ ] Error handling: Akses tanpa token ditolak

---

## 🎉 BERHASIL!

Jika semua test berhasil, project sudah siap untuk submission!

Dokumentasi ada di:
- `QUICK_START.md` - Ringkas
- `SETUP_DAN_TESTING.md` - Lengkap
- `JURNAL_MODUL_5_API.postman_collection.json` - Collection Postman

**Semoga sukses! 🚀**
