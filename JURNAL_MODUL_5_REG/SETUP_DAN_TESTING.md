# 📋 PANDUAN SETUP DAN TESTING API

## 🚀 TAHAP 1: SETUP PROJECT

### 1.1 Buka Terminal/PowerShell di Folder Project
```powershell
cd "e:\KULI AH\Semester\Semester 7\Pengembangan Aplikasi Website\Praktikum\JURNAL_MODUL_5_REG\JURNAL_MODUL_5_REG"
```

### 1.2 Install Dependencies
```powershell
composer install
```
⏳ Tunggu hingga proses selesai (bisa 2-5 menit)

### 1.3 Setup Environment File
Jika file `.env` belum ada, buat dari `.env.example`:
```powershell
copy .env.example .env
```

### 1.4 Generate Application Key
```powershell
php artisan key:generate
```

### 1.5 Setup Database SQLite (Opsional, Default sudah SQLite)
Database akan menggunakan SQLite secara default. Pastikan file `database/database.sqlite` ada:
```powershell
# Buat file database jika belum ada
New-Item -Path "database/database.sqlite" -ItemType File -Force
```

### 1.6 Jalankan Migrations
```powershell
php artisan migrate
```
Anda akan ditanya: `Do you want to continue? (yes/no) [no]:` - ketik `yes` dan Enter

✅ Setelah ini, tabel `mahasiswas`, `mata_kuliahs`, dan `users` sudah terbuat

---

## 🎯 TAHAP 2: MENJALANKAN SERVER

### 2.1 Start Development Server
```powershell
php artisan serve
```

Output akan menunjukkan:
```
   INFO  Server running on [http://127.0.0.1:8000].
```

⚠️ **JANGAN TUTUP TERMINAL INI!** Biarkan server tetap berjalan

### 2.2 Test Server Berjalan (Terminal Baru)
Buka terminal PowerShell baru dan jalankan:
```powershell
curl http://127.0.0.1:8000/api/login
```

Jika berhasil, akan menampilkan:
```json
{"message":"Unauthorized"}
```

---

## 📮 TAHAP 3: TESTING DI POSTMAN

### 3.1 Download & Install Postman
- Download dari: https://www.postman.com/downloads/
- Install dan buka aplikasi

### 3.2 Buat Collection Baru
1. Klik **"+ New"** di sebelah kiri
2. Pilih **"Collection"**
3. Beri nama: `JURNAL_MODUL_5_API`
4. Klik **"Create"**

### 3.3 Setup Base URL (Opsional tapi Recommended)
1. Klik 3 titik (•••) di Collection → **Edit**
2. Pergi ke tab **Variables**
3. Tambahkan:
   - **Variable**: `base_url`
   - **Initial Value**: `http://127.0.0.1:8000/api`
   - Klik **Save**

---

## 🔐 TEST 1: REGISTER USER

### Request Detail:
- **Method**: `POST`
- **URL**: `{{base_url}}/register`
- **Body Type**: `raw (JSON)`

### Body (JSON):
```json
{
    "name": "Andi Wijaya",
    "email": "andi@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```

### Expected Response (201):
```json
{
    "message": "User berhasil terdaftar",
    "user": {
        "name": "Andi Wijaya",
        "email": "andi@example.com",
        "id": 1,
        "created_at": "2025-12-03T10:30:00.000000Z",
        "updated_at": "2025-12-03T10:30:00.000000Z"
    },
    "token": "YOUR_TOKEN_HERE"
}
```

💡 **SIMPAN TOKEN INI!** Akan digunakan untuk request selanjutnya

---

## 🔑 TEST 2: LOGIN USER

### Request Detail:
- **Method**: `POST`
- **URL**: `{{base_url}}/login`
- **Body Type**: `raw (JSON)`

### Body (JSON):
```json
{
    "email": "andi@example.com",
    "password": "password123"
}
```

### Expected Response (200):
```json
{
    "message": "Login berhasil",
    "user": {
        "id": 1,
        "name": "Andi Wijaya",
        "email": "andi@example.com",
        ...
    },
    "token": "NEW_TOKEN_HERE"
}
```

---

## 👥 TEST 3: TAMBAH DATA MAHASISWA

### Setup Token di Authorization:
1. Pilih tab **Authorization**
2. Type: `Bearer Token`
3. Token: Paste token dari login/register

### Request Detail:
- **Method**: `POST`
- **URL**: `{{base_url}}/mahasiswa`
- **Body Type**: `raw (JSON)`

### Body (JSON):
```json
{
    "nim": "2301081001",
    "nama": "Budi Santoso",
    "alamat": "Jl. Merdeka No. 123, Jakarta"
}
```

### Expected Response (201):
```json
{
    "success": true,
    "message": "Data Mahasiswa Berhasil Ditambahkan!",
    "data": {
        "id": 1,
        "nim": "2301081001",
        "nama": "Budi Santoso",
        "alamat": "Jl. Merdeka No. 123, Jakarta",
        "created_at": "2025-12-03T10:35:00.000000Z",
        "updated_at": "2025-12-03T10:35:00.000000Z"
    }
}
```

💡 **Tambahkan 2-3 mahasiswa lagi dengan data berbeda untuk testing lengkap**

---

## 📊 TEST 4: LIHAT SEMUA MAHASISWA

### Request Detail:
- **Method**: `GET`
- **URL**: `{{base_url}}/mahasiswa`
- **Authorization**: Bearer Token (gunakan token dari login)

### Expected Response (200):
```json
{
    "success": true,
    "message": "Data Mahasiswa Berhasil Diambil",
    "data": [
        {
            "id": 1,
            "nim": "2301081001",
            "nama": "Budi Santoso",
            "alamat": "Jl. Merdeka No. 123, Jakarta",
            ...
        },
        ...
    ]
}
```

---

## 🔍 TEST 5: LIHAT DETAIL MAHASISWA (ID=1)

### Request Detail:
- **Method**: `GET`
- **URL**: `{{base_url}}/mahasiswa/1`
- **Authorization**: Bearer Token

### Expected Response (200):
```json
{
    "success": true,
    "message": "Data Mahasiswa Berhasil Diambil",
    "data": {
        "id": 1,
        "nim": "2301081001",
        "nama": "Budi Santoso",
        "alamat": "Jl. Merdeka No. 123, Jakarta",
        ...
    }
}
```

---

## ✏️ TEST 6: UPDATE DATA MAHASISWA (ID=1)

### Request Detail:
- **Method**: `PUT`
- **URL**: `{{base_url}}/mahasiswa/1`
- **Authorization**: Bearer Token
- **Body Type**: `raw (JSON)`

### Body (JSON):
```json
{
    "nama": "Budi Santoso Updated",
    "alamat": "Jl. Ahmad Yani No. 456, Bandung"
}
```

### Expected Response (200):
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

## 🗑️ TEST 7: HAPUS DATA MAHASISWA (ID=1)

### Request Detail:
- **Method**: `DELETE`
- **URL**: `{{base_url}}/mahasiswa/1`
- **Authorization**: Bearer Token

### Expected Response (200):
```json
{
    "success": true,
    "message": "Data Mahasiswa Berhasil Dihapus!",
    "data": null
}
```

---

## 📚 TEST 8-13: MATAKULIAH (Sama dengan Mahasiswa)

### TAMBAH MATAKULIAH - POST `{{base_url}}/matakuliah`
```json
{
    "kode": "MK001",
    "nama": "Pemrograman Web",
    "sks": 3
}
```

### LIHAT SEMUA - GET `{{base_url}}/matakuliah`

### LIHAT DETAIL - GET `{{base_url}}/matakuliah/1`

### UPDATE - PUT `{{base_url}}/matakuliah/1`
```json
{
    "nama": "Pemrograman Web Advanced",
    "sks": 4
}
```

### HAPUS - DELETE `{{base_url}}/matakuliah/1`

---

## 🚪 TEST LOGOUT

### Request Detail:
- **Method**: `POST`
- **URL**: `{{base_url}}/logout`
- **Authorization**: Bearer Token

### Expected Response (200):
```json
{
    "message": "Logout berhasil"
}
```

---

## ⚠️ ERROR HANDLING TEST

### Test: Akses tanpa Token
- **Method**: `GET`
- **URL**: `{{base_url}}/mahasiswa`
- **Tanpa Authorization**

Expected: **401 Unauthorized**
```json
{
    "message": "Unauthenticated."
}
```

### Test: Register dengan Email Duplikat
- **Method**: `POST`
- **URL**: `{{base_url}}/register`
- **Body**:
```json
{
    "name": "Andi Wijaya 2",
    "email": "andi@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```

Expected: **422 Unprocessable Entity**
```json
{
    "email": ["The email field must be a valid email address."]
}
```

---

## 📝 CHECKLIST TESTING LENGKAP

- [ ] Server berjalan di `http://127.0.0.1:8000`
- [ ] Register user berhasil & mendapat token
- [ ] Login user berhasil
- [ ] Tambah Mahasiswa berhasil
- [ ] Lihat semua Mahasiswa
- [ ] Lihat detail Mahasiswa
- [ ] Update Mahasiswa
- [ ] Hapus Mahasiswa
- [ ] Tambah Matakuliah
- [ ] Lihat semua Matakuliah
- [ ] Lihat detail Matakuliah
- [ ] Update Matakuliah
- [ ] Hapus Matakuliah
- [ ] Logout berhasil
- [ ] Akses tanpa token ditolak

---

## 🔧 TROUBLESHOOTING

### Error: `Port 8000 already in use`
```powershell
php artisan serve --port=8001
```

### Error: `SQLSTATE[HY000]: General error`
```powershell
# Reset database
php artisan migrate:fresh
# atau hapus database.sqlite dan jalankan migrate lagi
```

### Error: `Class not found`
```powershell
composer dump-autoload
```

### Token tidak valid
- Pastikan token di Authorization tab sudah benar
- Cek format: `Bearer YOUR_TOKEN_HERE`
- Login ulang untuk mendapat token baru

---

## 📧 RESOURCES / RESPONSE FORMAT

Semua response menggunakan format:
```json
{
    "success": true/false,
    "message": "String pesan",
    "data": null/object/array
}
```

Format ini didefinisikan di `app/Http/Resources/MahasiswaResource.php` dan `MatakuliahResource.php`

---

**🎉 Selamat Testing! Jika ada error, screenshot dan bagikan di chat.**
