# 📊 Rangkuman Pengerjaan Web PalmHarvest

**Tanggal:** 16 Januari 2026  
**Framework:** Laravel 11  
**Database:** MySQL  

---

## 🎯 Deskripsi Aplikasi

Aplikasi **PalmHarvest** adalah sistem monitoring panen kelapa sawit yang memungkinkan:
- **Admin** mengelola data blok, petugas, dan verifikasi hasil panen
- **Officer/Petugas** menginput data panen harian

---

## 🗂️ Struktur Database

### Tabel `users`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary Key |
| name | string | Nama pengguna |
| email | string | Email (unique) |
| password | string | Password terenkripsi |
| role | enum | 'admin' atau 'officer' |

### Tabel `blocks`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary Key |
| name | string | Nama divisi |
| code | string | Kode blok (A-01, A-02, dll) |
| area_hectares | decimal | Luas area (Ha) |
| status | enum | 'active' atau 'inactive' |

### Tabel `harvests`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary Key |
| block_id | FK | Referensi ke blocks |
| officer_id | FK | Petugas yang input |
| weight_kg | decimal | Total berat (Kg) |
| harvest_date | date | Tanggal terakhir (opsional) |
| verification_status | enum | 'pending', 'verified', 'rejected' |
| verified_by | FK | Admin yang verifikasi |
| verified_at | timestamp | Waktu verifikasi |
| notes | text | Keterangan |
| image | string | Path gambar |
| no_spk | string | Nomor SPK (bebas input) |

---

## 🔐 Fitur Autentikasi

### Login
- Route: `/login`
- View: `resources/views/auth/login.blade.php`
- Controller: `Auth\AuthenticatedSessionController`

### Register
- Route: `/register`
- View: `resources/views/auth/register.blade.php`
- Controller: `Auth\RegisteredUserController`

### Middleware
- `auth` - Memastikan user sudah login
- `role:admin` - Hanya admin yang bisa akses
- `role:officer` - Hanya officer yang bisa akses

---

## 👨‍💼 Fitur Admin

### 1. Dashboard (`/admin/dashboard`)
- Statistik jumlah data
- Jumlah data verified dan pending
- Controller: `Admin\DashboardController`

### 2. Input BAP / Data QC (`/admin/bap`)
**Fitur:**
- ✅ Daftar semua data QC (sorted by terbaru)
- ✅ Filter by status, blok, tanggal
- ✅ Input data baru dengan form lengkap
- ✅ Upload gambar (max 2MB, JPG/PNG/GIF)
- ✅ Set status OK atau Hold
- ✅ Edit data yang sudah ada
- ✅ Preview/lihat detail data
- ✅ Hapus data
- ✅ No. SPK bebas input (HARIAN, BORONGAN, dll)
- ✅ Tanggal Terakhir opsional (bisa kosong)

**Routes:**
| Method | URI | Action |
|--------|-----|--------|
| GET | /admin/bap | index |
| GET | /admin/bap/create | create |
| POST | /admin/bap | store |
| GET | /admin/bap/{id} | show |
| GET | /admin/bap/{id}/edit | edit |
| PUT | /admin/bap/{id} | update |
| DELETE | /admin/bap/{id} | destroy |

### 3. Hold QC (`/admin/holdqc`)
**Fitur:**
- ✅ Daftar data yang berstatus "Hold/Pending"
- ✅ Approve data (ubah ke verified)
- ✅ Reject data
- ✅ Edit data
- ✅ Preview data
- ✅ Hapus data

**Routes:**
| Method | URI | Action |
|--------|-----|--------|
| GET | /admin/holdqc | index |
| POST | /admin/holdqc/{id}/approve | approve |
| POST | /admin/holdqc/{id}/reject | reject |
| DELETE | /admin/holdqc/{id} | destroy |

### 4. Kelola Blok (`/admin/blocks`)
- CRUD untuk data blok/sektor

### 5. Kelola Petugas (`/admin/officers`)
- CRUD untuk data petugas

### 6. Verifikasi Panen (`/admin/harvests`)
- Daftar semua data panen
- Verifikasi data pending

### 7. Laporan (`/admin/reports`)
- Generate laporan panen

### 8. Profil (`/profile`)
- Edit profil pengguna
- Ubah password

---

## 👷 Fitur Officer

### 1. Dashboard (`/officer/dashboard`)
- Statistik panen hari ini
- Statistik panen bulan ini

### 2. Input Panen (`/officer/harvests/create`)
- Form input data panen

### 3. Riwayat Panen (`/officer/harvests`)
- Daftar panen yang sudah diinput

---

## 🎨 Komponen UI

### Layout Utama
- `resources/views/layouts/palm.blade.php`
- Menggunakan Tailwind CSS
- Google Material Symbols untuk icons

### Komponen Blade
| Komponen | Fungsi |
|----------|--------|
| `palm-sidebar` | Navigasi sidebar |
| `palm-header` | Header halaman |
| `palm-stat-card` | Kartu statistik dashboard |

### Tema Warna
- Primary: Green (`#2d5a27`)
- Surface: Light backgrounds
- Text: Dark grays

---

## 📁 Struktur File Penting

```
palm-harvest/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/
│   │   │   ├── BapController.php       ← Input BAP/QC
│   │   │   ├── HoldQcController.php    ← Hold QC
│   │   │   ├── BlockController.php
│   │   │   ├── OfficerController.php
│   │   │   ├── HarvestController.php
│   │   │   ├── ReportController.php
│   │   │   └── DashboardController.php
│   │   └── Officer/
│   │       ├── DashboardController.php
│   │       └── HarvestController.php
│   └── Models/
│       ├── User.php
│       ├── Block.php
│       └── Harvest.php
├── database/
│   └── migrations/
│       ├── create_users_table.php
│       ├── add_role_to_users_table.php
│       ├── create_blocks_table.php
│       ├── create_harvests_table.php
│       ├── add_image_to_harvests_table.php
│       └── add_no_spk_to_harvests_table.php
├── resources/views/
│   ├── admin/
│   │   ├── bap/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   ├── edit.blade.php
│   │   │   └── show.blade.php
│   │   ├── holdqc/
│   │   │   └── index.blade.php
│   │   ├── blocks/
│   │   ├── officers/
│   │   ├── harvests/
│   │   ├── reports/
│   │   └── dashboard.blade.php
│   ├── officer/
│   ├── components/
│   │   ├── palm-sidebar.blade.php
│   │   ├── palm-header.blade.php
│   │   └── palm-stat-card.blade.php
│   ├── layouts/
│   │   └── palm.blade.php
│   └── auth/
│       ├── login.blade.php
│       └── register.blade.php
├── routes/
│   └── web.php
└── storage/
    └── app/public/harvests/  ← Upload gambar
```

---

## 🚀 Cara Deploy ke Hosting

### 1. Konfigurasi Environment
```bash
# Copy .env.example ke .env
cp .env.example .env

# Generate app key
php artisan key:generate
```

### 2. Update .env dengan Kredensial Hosting
```env
APP_NAME=PalmHarvest
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=your_host
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 3. Jalankan Migrasi
```bash
php artisan migrate --seed
php artisan storage:link
```

### 4. Optimize untuk Production
```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## ✅ Checklist Fitur

| Fitur | Status |
|-------|--------|
| Login/Register | ✅ |
| Role-based Access | ✅ |
| Admin Dashboard | ✅ |
| Input BAP/QC | ✅ |
| Hold QC | ✅ |
| Upload Gambar | ✅ |
| No. SPK Bebas | ✅ |
| Tanggal Opsional | ✅ |
| Preview Data | ✅ |
| Edit Data | ✅ |
| Hapus Data | ✅ |
| Filter & Sorting | ✅ |
| Kelola Blok | ✅ |
| Kelola Petugas | ✅ |
| Officer Dashboard | ✅ |
| Input Panen Officer | ✅ |

---

**Dibuat dengan ❤️ menggunakan Laravel 11**
