#!/usr/bin/env pwsh

# ========================================
# Script Setup Otomatis Laravel Project
# ========================================

Write-Host "
╔═══════════════════════════════════════════════════╗
║         SETUP OTOMATIS LARAVEL PROJECT            ║
║        JURNAL MODUL 5 API Development             ║
╚═══════════════════════════════════════════════════╝
" -ForegroundColor Cyan

# Warna untuk output
$success = @{ ForegroundColor = 'Green' }
$error = @{ ForegroundColor = 'Red' }
$info = @{ ForegroundColor = 'Yellow' }
$warning = @{ ForegroundColor = 'Magenta' }

# ========================================
# 1. Cek PHP sudah terinstall
# ========================================
Write-Host "`n[1] Checking PHP Installation..." -ForegroundColor Cyan

if (Get-Command php -ErrorAction SilentlyContinue) {
    $phpVersion = php -v
    Write-Host "✓ PHP sudah terinstall" @success
    Write-Host "$phpVersion" -ForegroundColor Gray
} else {
    Write-Host "✗ PHP tidak ditemukan! Silakan install PHP terlebih dahulu" @error
    exit 1
}

# ========================================
# 2. Cek Composer sudah terinstall
# ========================================
Write-Host "`n[2] Checking Composer Installation..." -ForegroundColor Cyan

if (Get-Command composer -ErrorAction SilentlyContinue) {
    Write-Host "✓ Composer sudah terinstall" @success
} else {
    Write-Host "✗ Composer tidak ditemukan! Silakan install Composer terlebih dahulu" @error
    exit 1
}

# ========================================
# 3. Install Dependencies
# ========================================
Write-Host "`n[3] Installing Dependencies dengan Composer..." -ForegroundColor Cyan
Write-Host "⏳ Ini memerlukan waktu 2-5 menit..." -ForegroundColor Yellow

if (Test-Path "vendor") {
    Write-Host "✓ Vendor folder sudah ada, skip composer install" @info
} else {
    composer install
    if ($LASTEXITCODE -eq 0) {
        Write-Host "✓ Composer install berhasil" @success
    } else {
        Write-Host "✗ Composer install gagal!" @error
        exit 1
    }
}

# ========================================
# 4. Setup .env File
# ========================================
Write-Host "`n[4] Setting up .env File..." -ForegroundColor Cyan

if (-not (Test-Path ".env")) {
    if (Test-Path ".env.example") {
        Copy-Item ".env.example" ".env"
        Write-Host "✓ File .env berhasil dibuat dari .env.example" @success
    } else {
        Write-Host "✗ File .env.example tidak ditemukan!" @error
        exit 1
    }
} else {
    Write-Host "✓ File .env sudah ada" @info
}

# ========================================
# 5. Generate Application Key
# ========================================
Write-Host "`n[5] Generating Application Key..." -ForegroundColor Cyan

php artisan key:generate
if ($LASTEXITCODE -eq 0) {
    Write-Host "✓ Application key berhasil di-generate" @success
} else {
    Write-Host "⚠ Mungkin key sudah ada sebelumnya" @warning
}

# ========================================
# 6. Setup Database SQLite
# ========================================
Write-Host "`n[6] Setting up SQLite Database..." -ForegroundColor Cyan

$dbPath = "database/database.sqlite"
if (-not (Test-Path $dbPath)) {
    New-Item -Path $dbPath -ItemType File -Force | Out-Null
    Write-Host "✓ File database.sqlite berhasil dibuat" @success
} else {
    Write-Host "✓ Database file sudah ada" @info
}

# ========================================
# 7. Run Migrations
# ========================================
Write-Host "`n[7] Running Database Migrations..." -ForegroundColor Cyan
Write-Host "⚠ Jika ditanya, ketik 'yes' dan tekan Enter" @warning

php artisan migrate

if ($LASTEXITCODE -eq 0) {
    Write-Host "✓ Migrations berhasil dijalankan" @success
} else {
    Write-Host "✗ Migrations gagal!" @error
    exit 1
}

# ========================================
# Summary
# ========================================
Write-Host "
╔═══════════════════════════════════════════════════╗
║              ✓ SETUP BERHASIL!                   ║
╚═══════════════════════════════════════════════════╝
" -ForegroundColor Green

Write-Host "
📋 LANGKAH SELANJUTNYA:

1️⃣  Jalankan Server:
   php artisan serve

2️⃣  Test di Terminal Baru:
   curl http://127.0.0.1:8000/api/login

3️⃣  Buka Postman dan import requests

✅ Semua siap untuk testing!

" -ForegroundColor Green

Write-Host "📖 Lihat SETUP_DAN_TESTING.md untuk panduan lengkap" -ForegroundColor Cyan
