# 🆘 TROUBLESHOOTING & COMMON ERRORS

## Daftar Error & Solusi

---

## ❌ ERROR 1: PHP Tidak Terinstall

### Gejala
```
'php' is not recognized as an internal or external command, 
operable program or batch file.
```

### Penyebab
PHP belum terinstall atau path belum dikonfigurasi

### Solusi
1. Download PHP dari https://www.php.net/downloads
2. Install PHP
3. Tambahkan PHP ke PATH sistem Windows
4. Restart PowerShell/Terminal
5. Test: `php -v`

---

## ❌ ERROR 2: Composer Tidak Terinstall

### Gejala
```
'composer' is not recognized as an internal or external command
```

### Penyebab
Composer belum terinstall

### Solusi
1. Download dari https://getcomposer.org/download/
2. Install Composer
3. Test: `composer --version`

---

## ❌ ERROR 3: Port 8000 Sudah Dipakai

### Gejala
```
Address already in use [127.0.0.1:8000]
```

### Penyebab
Server Laravel sudah berjalan di port 8000 / port digunakan aplikasi lain

### Solusi
```powershell
# Opsi 1: Gunakan port lain
php artisan serve --port=8001

# Opsi 2: Cari process yang pakai port 8000
netstat -ano | findstr :8000

# Opsi 3: Kill process tersebut
taskkill /PID [PID_NUMBER] /F
```

---

## ❌ ERROR 4: Composer Install Stuck

### Gejala
```
Loading composer repositories dengan lama / stuck
```

### Penyebab
Koneksi internet lambat atau repository composer bermasalah

### Solusi
```powershell
# Opsi 1: Tunggu lebih lama (bisa 5-15 menit)

# Opsi 2: Reset composer cache
composer clear-cache

# Opsi 3: Jalankan ulang
composer install --no-cache

# Opsi 4: Gunakan repository mirror
composer config -g repo.packagist composer https://mirrors.aliyun.com/composer
```

---

## ❌ ERROR 5: "Class Not Found" atau "Autoload Error"

### Gejala
```
Class 'App\Http\Controllers\MahasiswaController' not found
atau
Class not found di file apapun
```

### Penyebab
Autoload cache tidak ter-update setelah ada perubahan file

### Solusi
```powershell
composer dump-autoload

# atau dengan -o flag (optimized)
composer dump-autoload -o
```

---

## ❌ ERROR 6: Database Error "SQLSTATE[HY000]"

### Gejala
```
SQLSTATE[HY000]: General error: 1 no such table: mahasiswas
atau
Could not open database file
```

### Penyebab
1. Database migration belum dijalankan
2. File database.sqlite tidak ada atau error
3. File permissions tidak sesuai

### Solusi
```powershell
# Opsi 1: Jalankan migrations
php artisan migrate

# Opsi 2: Reset database (hati-hati: data akan hilang!)
php artisan migrate:fresh

# Opsi 3: Buat file database manual
New-Item -Path "database/database.sqlite" -ItemType File -Force

# Opsi 4: Check file permissions
icacls "database/database.sqlite" /grant "%USERNAME%:F"
```

---

## ❌ ERROR 7: "Unauthenticated" di Postman

### Gejala
```json
{
    "message": "Unauthenticated."
}
Status: 401
```

### Penyebab
1. Token tidak disertakan
2. Token sudah expired / invalid
3. Format token salah di Authorization

### Solusi
```
1. ✅ Pastikan sudah login/register terlebih dulu
2. ✅ Copy token dari response login/register
3. ✅ Paste token di Authorization tab
4. ✅ Format harus: Bearer YOUR_TOKEN_HERE (dengan spasi)
5. ✅ Login ulang untuk dapatkan token baru
```

### Contoh Format Benar
```
Authorization Type: Bearer Token
Token: 1|AbCdEfGhIjKlMnOpQrStUvWxYzAbCdEfGh

BUKAN:
- Bearer1|AbCdEfGh...  ❌ (tidak ada spasi)
- 1|AbCdEfGh...  ❌ (lupa Bearer)
- Token: 1|AbCdEfGh...  ❌ (salah tipe)
```

---

## ❌ ERROR 8: "Validation Error" saat Register

### Gejala
```json
{
    "email": ["The email has already been taken"]
}
Status: 422
```

### Penyebab
Email sudah terdaftar di database

### Solusi
```
1. ✅ Gunakan email yang berbeda
2. ✅ Reset database: php artisan migrate:fresh
3. ✅ Atau gunakan email yang belum pernah digunakan
```

### Contoh Email Berbeda
```json
{
    "name": "User 2",
    "email": "user2@example.com",  // Berbeda dari sebelumnya
    "password": "password123",
    "password_confirmation": "password123"
}
```

---

## ❌ ERROR 9: "NIM or Kode Already Exists"

### Gejala
```json
{
    "nim": ["The nim field must be unique"]
}
Status: 422
```

### Penyebab
NIM/Kode sudah terdaftar di database

### Solusi
```json
{
    "nim": "2301081002",  // Ganti dengan nilai unik
    "nama": "Budi Santoso",
    "alamat": "..."
}

atau

php artisan migrate:fresh  // Reset database
```

---

## ❌ ERROR 10: ".env File Not Found"

### Gejala
```
Error: .env file not found
atau
Configuration value [APP_NAME] must not be null
```

### Penyebab
File .env belum di-copy dari .env.example

### Solusi
```powershell
# Copy file
copy .env.example .env

# Generate key
php artisan key:generate

# Verify file ada
Test-Path .env
```

---

## ❌ ERROR 11: "Application Key Not Set"

### Gejala
```
RuntimeException: No application encryption key has been specified.
```

### Penyebab
APP_KEY di file .env masih kosong

### Solusi
```powershell
php artisan key:generate

# Verify di .env
cat .env | grep APP_KEY

# Harus terlihat seperti:
# APP_KEY=base64:XxXxXxXx...
```

---

## ❌ ERROR 12: Request Timeout di Postman

### Gejala
```
Request Timed Out: connect ECONNREFUSED 127.0.0.1:8000
atau
Unable to connect to 127.0.0.1:8000
```

### Penyebab
Server Laravel tidak berjalan

### Solusi
```powershell
# Cek apakah server sudah dijalankan
php artisan serve

# Jika error di output, baca error message

# Cek dengan curl (terminal baru)
curl http://127.0.0.1:8000/api/login

# Harus return: {"message":"Unauthorized"}
```

---

## ❌ ERROR 13: Method Not Allowed (405)

### Gejala
```json
{
    "message": "The [METHOD] method is not supported for this route."
}
Status: 405
```

### Penyebab
Menggunakan HTTP method yang salah (POST ke GET endpoint, dll)

### Solusi
```
✅ Verifikasi method di Postman:
- Register/Login/Logout → POST
- Get semua data → GET
- Get detail → GET
- Create → POST
- Update → PUT (bukan POST!)
- Delete → DELETE
```

---

## ❌ ERROR 14: "Column Not Found" di Database

### Gejala
```
SQLSTATE[HY000]: General error: 1 table mahasiswas has no column named nim
```

### Penyebab
Database structure tidak sesuai dengan migration

### Solusi
```powershell
# Reset dan jalankan ulang migrations
php artisan migrate:fresh

# atau jika ingin lihat status migration
php artisan migrate:status

# Jika ada yang belum running, jalankan:
php artisan migrate
```

---

## ❌ ERROR 15: Response Body Masuk "data" bukan "body"

### Gejala
Postman menampilkan response tapi isinya tidak muncul dengan benar

### Penyebab
Tab Body belum diklik atau response type salah

### Solusi
```
1. Klik tab "Body" di response section
2. Pilih format JSON (biasanya auto-detect)
3. Lihat response dalam format yang rapi
4. Atau klik "Pretty" untuk formatting
```

---

## ❌ ERROR 16: Collection Postman Tidak Ter-import

### Gejala
```
Error importing collection
Invalid collection format
```

### Penyebab
File .json rusak atau format salah

### Solusi
```
1. Pastikan file: JURNAL_MODUL_5_API.postman_collection.json
2. File harus di folder project
3. Coba import ulang
4. Atau buat manual requests di Postman
```

---

## ❌ ERROR 17: Setup Script (setup.ps1) Tidak Bisa Dijalankan

### Gejala
```
.\setup.ps1 : File cannot be loaded because running scripts is disabled
```

### Penyebab
PowerShell execution policy melarang menjalankan script

### Solusi
```powershell
# Opsi 1: Jalankan dengan bypass untuk script ini
powershell -ExecutionPolicy Bypass -File .\setup.ps1

# Opsi 2: Ubah policy untuk user saat ini
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser

# Opsi 3: Setup manual (skip script)
composer install
copy .env.example .env
php artisan key:generate
New-Item -Path "database/database.sqlite" -ItemType File -Force
php artisan migrate
```

---

## ❌ ERROR 18: "Too Many Requests" / Rate Limited

### Gejala
```json
{
    "message": "Too Many Requests"
}
Status: 429
```

### Penyebab
Terlalu banyak request dalam waktu singkat

### Solusi
```
1. ✅ Tunggu beberapa menit sebelum request lagi
2. ✅ Kurangi frekuensi test
3. ✅ Atau restart server Laravel
```

---

## ❌ ERROR 19: Syntax Error di File PHP

### Gejala
```
Parse error: syntax error, unexpected...
atau
Call to undefined function...
```

### Penyebab
Ada kesalahan syntax di file PHP yang dimodifikasi

### Solusi
```powershell
# Check syntax error di file spesifik
php -l app/Http/Controllers/MahasiswaController.php

# Output akan menunjukkan line number error
# Fix error tersebut di editor

# Atau gunakan Pylance untuk check errors
```

---

## ❌ ERROR 20: Mixed/Incomplete Response

### Gejala
Response tidak konsisten atau JSON broken

### Penyebab
1. Server shutdown di tengah request
2. Database error
3. Memory limit exceeded

### Solusi
```powershell
# Restart server
1. Ctrl+C di terminal server
2. php artisan serve
3. Coba request ulang

# Jika masih error, check logs
php artisan pail --timeout=0

# atau lihat file log
tail -f storage/logs/laravel.log
```

---

## 🔍 DEBUGGING TIPS

### Tip 1: Enable Debug Mode
```
Edit file .env:
APP_DEBUG=true

Restart server untuk melihat detailed error messages
```

### Tip 2: Check Laravel Logs
```powershell
# Real-time logs (terminal baru)
php artisan pail --timeout=0

# atau lihat file langsung
cat storage/logs/laravel.log

# atau Windows PowerShell
Get-Content storage/logs/laravel.log -Tail 50
```

### Tip 3: Test via curl
```powershell
# Test tanpa Postman
curl -X POST http://127.0.0.1:8000/api/register `
  -H "Content-Type: application/json" `
  -d '{
    "name": "Test",
    "email": "test@example.com",
    "password": "password123",
    "password_confirmation": "password123"
  }'
```

### Tip 4: Check Database
```powershell
# Connect ke SQLite database
sqlite3 database/database.sqlite

# Lihat tabel
.tables

# Lihat struktur tabel
.schema mahasiswas

# Query data
SELECT * FROM mahasiswas;

# Exit
.quit
```

### Tip 5: Check Server Status
```powershell
# Apakah server berjalan?
curl -I http://127.0.0.1:8000

# Test API endpoint
curl http://127.0.0.1:8000/api/login

# Check port usage
netstat -ano | findstr :8000
```

---

## 📞 QUICK REFERENCE

| Error | Command |
|-------|---------|
| Class not found | `composer dump-autoload` |
| Database error | `php artisan migrate:fresh` |
| Port taken | `php artisan serve --port=8001` |
| Check logs | `php artisan pail --timeout=0` |
| Reset APP_KEY | `php artisan key:generate` |
| Check DB connection | `sqlite3 database/database.sqlite` |
| Update .env | `copy .env.example .env` |

---

## ✅ TROUBLESHOOTING CHECKLIST

Jika ada error, coba checklist ini berurutan:

- [ ] Server sedang berjalan? `php artisan serve`
- [ ] .env file sudah ada? `Test-Path .env`
- [ ] APP_KEY sudah di-generate? `php artisan key:generate`
- [ ] Database sudah migrated? `php artisan migrate`
- [ ] Autoload sudah updated? `composer dump-autoload`
- [ ] Cek logs untuk detail error? `php artisan pail`
- [ ] Token valid di Authorization? Bearer Token
- [ ] Method request benar? POST/GET/PUT/DELETE
- [ ] URL benar? {{base_url}}/endpoint
- [ ] Body format JSON valid? `curl test`

---

**Jika masih error, dokumentasikan:**
1. Error message lengkap
2. Screenshot Postman (request + response)
3. Output dari terminal
4. File yang dimodifikasi terakhir

**Good luck! 🚀**
