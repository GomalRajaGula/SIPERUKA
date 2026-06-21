# SIPERUKA-PNC 🎓🏢

**Sistem Informasi Perizinan Ruangan Kampus Terintegrasi - Politeknik Negeri Cilacap**

SIPERUKA-PNC adalah platform digital (E-Permit) terpusat untuk mempermudah seluruh siklus perizinan ruangan di lingkungan Politeknik Negeri Cilacap. Melalui platform ini, Organisasi Mahasiswa (Ormawa) dan unit kerja kampus dapat memantau ketersediaan ruangan secara real-time, mengajukan izin tanpa prosedur fisik, serta mencegah risiko tumpang tindih jadwal (*double booking*).

---

## ✨ Fitur Utama

1. **E-Permit Digital**
   Pengajuan tanpa kertas, praktis, dan ramah lingkungan. Semua proses dilakukan secara digital dari awal hingga akhir.
2. **Kalender Real-time**
   Mencegah tumpang tindih jadwal dengan sistem pemantauan ketersediaan ruangan secara langsung.
3. **Verifikasi TTE (Tanda Tangan Elektronik)**
   Pengesahan menggunakan *Tanda Tangan Elektronik* (*QR Code*) untuk keamanan dan validitas dokumen. Satpam dapat langsung melakukan *scan* untuk verifikasi.
4. **Role-Based Access Control**
   Sistem terbagi ke dalam 3 jenis *role* yang saling terintegrasi:
   - **Mahasiswa**: Membuat pengajuan, mengecek status, dan mengunduh Surat Izin (PDF/QR).
   - **BAAK**: Memverifikasi pengajuan, mengatur data ruangan, dan mencetak laporan persetujuan.
   - **Satpam**: Memindai *QR Code* pada Surat Izin untuk memverifikasi validitas jadwal.

---

## 🛠️ Tech Stack

- **Framework**: Laravel 12
- **Frontend**: Blade Templating, Tailwind CSS, Vite
- **Database**: MySQL
- **Environment**: PHP 8.3+

---

## 🚀 Instalasi & Persiapan Menjalankan Secara Lokal

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi secara lokal (dengan menggunakan Laragon atau server lokal lainnya):

### 1. Kloning Repository
```bash
git clone https://github.com/GomalRajaGula/SIPERUKA.git
cd SIPERUKA
```

### 2. Install Dependensi PHP & Node
*(Pastikan Composer dan Node.js sudah terinstal)*
```bash
composer install
npm install
```

### 3. Setup Konfigurasi Environment
Salin file `.env.example` menjadi `.env` lalu sesuaikan konfigurasi database Anda.
```bash
cp .env.example .env
```
Sesuaikan bagian berikut pada `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=siperuka_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate App Key & Migrasi Database
```bash
php artisan key:generate
php artisan migrate:fresh --seed
```
*(Catatan: Seeder akan men-generate data ruangan awal beserta beberapa akun dummy untuk keperluan testing)*

### 5. Jalankan Aplikasi
Jalankan server pengembangan Laravel dan *build tools* Vite secara bersamaan:
```bash
# Terminal 1
php artisan serve

# Terminal 2
npm run dev
```
Aplikasi dapat diakses melalui `http://127.0.0.1:8000`.

---

## 👥 Akun Role (Testing)

Jika Anda menggunakan seeder, Anda dapat mencoba login dengan akun berikut (atau sesuaikan dengan data di database Anda):

| Role | Deskripsi |
| :--- | :--- |
| **Mahasiswa** | Akun pendaftar (registrasi manual) atau akun mahasiswa dummy. |
| **BAAK** | Verifikator izin dan administrator sistem. |
| **Satpam** | Petugas keamanan lapangan yang menscan QR. |

---

## 📝 Catatan Penting

- Aplikasi menggunakan fitur sinkronisasi *real-time* di seluruh *dashboard*. Pastikan Anda *login* ke *role* yang berbeda di tab/browser *incognito* untuk melihat alur sistem (Mahasiswa mengajukan -> BAAK verifikasi -> Satpam cek di lapangan).
- Fitur "Cetak PDF" (*Surat Izin*) menggunakan fitur *native print* bawaan *browser* sehingga tidak memerlukan konfigurasi *package* PDF yang berat.
- Integrasi *QR Code* menggunakan *public API* dari `api.qrserver.com`. Pastikan komputer Anda terhubung ke internet saat mencoba melakukan *scanning*.

---
&copy; 2026 Politeknik Negeri Cilacap - Kelompok 3 UAS PBO.
