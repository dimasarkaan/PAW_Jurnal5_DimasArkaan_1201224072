# ⚡ QUICK START GUIDE

## 🚀 QUICK SETUP (5 menit)

### Opsi 1: Menggunakan Script Setup (RECOMMENDED)
```powershell
# Buka PowerShell, masuk ke folder project, lalu jalankan:
.\setup.ps1
```

### Opsi 2: Setup Manual
```powershell
# 1. Install dependencies
composer install

# 2. Copy .env file
copy .env.example .env

# 3. Generate key
php artisan key:generate

# 4. Create database
New-Item -Path "database/database.sqlite" -ItemType File -Force

# 5. Run migrations
php artisan migrate
```

---

## ▶️ MENJALANKAN SERVER

```powershell
# Terminal 1 (JANGAN DITUTUP!)
php artisan serve
```

Output:
```
   INFO  Server running on [http://127.0.0.1:8000].
```

---

## 📮 TESTING DI POSTMAN

### Step 1: Import Collection
1. Buka Postman
2. Klik **Import** (atas kiri)
3. Pilih file: `JURNAL_MODUL_5_API.postman_collection.json`
4. Klik **Import**

### Step 2: Set Token Variable
Setelah login, copy token dan paste di:
- Postman → Environments/Variables → `{{token}}`

### Step 3: Jalankan Requests
1. **Register** → Dapatkan token
2. **Login** → Test login
3. **Create Mahasiswa** → Tambah data
4. **Get All Mahasiswa** → Lihat semua
5. **Get by ID** → Lihat detail
6. **Update** → Ubah data
7. **Delete** → Hapus data
8. **Logout** → Test logout

---

## 🔍 TESTING CHECKLIST

### Auth Endpoints
- [ ] Register (POST `/api/register`)
- [ ] Login (POST `/api/login`)
- [ ] Logout (POST `/api/logout`) - Butuh token

### Mahasiswa Endpoints (Butuh token)
- [ ] Create (POST `/api/mahasiswa`)
- [ ] Read All (GET `/api/mahasiswa`)
- [ ] Read One (GET `/api/mahasiswa/{id}`)
- [ ] Update (PUT `/api/mahasiswa/{id}`)
- [ ] Delete (DELETE `/api/mahasiswa/{id}`)

### Matakuliah Endpoints (Butuh token)
- [ ] Create (POST `/api/matakuliah`)
- [ ] Read All (GET `/api/matakuliah`)
- [ ] Read One (GET `/api/matakuliah/{id}`)
- [ ] Update (PUT `/api/matakuliah/{id}`)
- [ ] Delete (DELETE `/api/matakuliah/{id}`)

---

## 💡 TIPS POSTMAN

**Otomatis Set Token Setelah Login:**
1. Login → Klik response
2. Lihat bagian **Tests** di request login
3. Tambahkan:
   ```javascript
   var jsonData = pm.response.json();
   pm.environment.set("token", jsonData.token);
   ```
4. Klik **Send** → Token otomatis tersimpan

---

## ⚠️ COMMON ERRORS

| Error | Solusi |
|-------|--------|
| Port 8000 sudah dipakai | `php artisan serve --port=8001` |
| "Unauthenticated" | Pastikan token di Authorization sudah benar |
| Database error | `php artisan migrate:fresh` |
| Class not found | `composer dump-autoload` |
| Token expired | Login ulang untuk mendapat token baru |

---

## 📖 FULL DOCS
Lihat `SETUP_DAN_TESTING.md` untuk panduan lengkap dengan contoh response

**Happy Testing! 🎉**
