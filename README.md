# 🏛️ Dinkop UMTK Kota Kediri - Management System
Sistem informasi modern untuk mendata kunjungan masyarakat dan mengelola konten digital pada Dinas Koperasi & UMTK Kota Kediri. Dibangun dengan penuh semangat buat ngebantu pelayanan publik jadi lebih sat-set-das-des! 🚀

---

## 🌟 Key Features
Bukan sekadar sistem biasa, ini fitur-fitur "Executive" yang udah kita tanem:
- **Admin Executive Dashboard** 🖥️: Tampilan dashboard premium pakai Tailwind CSS (Jakarta Sans font).
- **Dynamic Carousel Management** 🖼️: Upload dan ganti banner promo di halaman depan lewat dashboard, nggak perlu nyentuh kodingan!
- **Digital Guestbook** 📖: Pendataan masyarakat yang dateng lengkap dengan filter wilayah (Kecamatan/Kelurahan).
- **Layanan Management** 🛠️: Kelola daftar layanan publik secara dinamis (CRUD).
- **Security Auth** 🔒: Diproteksi sistem autentikasi Laravel Breeze, aman dari tangan jahil.

---

## 🛠️ Tech Stack
Daftar "senjata" yang dipake buat bangun project ini:
- **Framework:** [Laravel 11](https://laravel.com/) (The PHP Framework for Web Artisans)
- **UI/UX:** [Tailwind CSS](https://tailwindcss.com/) & [Bootstrap 5](https://getbootstrap.com/)
- **Icons:** Bootstrap Icons
- **Animation:** Animate.css
- **Database:** MySQL

---

## 📂 Database Structure (ERD)
Sistem ini punya 5 tabel utama yang saling kerja sama:
1. `users` - Data sang Admin.
2. `layanans` - Master data layanan dinas.
3. `buku_tamus` - Log kunjungan masyarakat (Relasi ke tabel Layanan).
4. `carousels` - Manajemen konten visual di beranda.
5. `settings` - Pengaturan status sistem (Aktif/Tutup).

---

## 🚀 How to Run?
Mau nyobain di laptop lain? Ikuti langkah gampang ini:

1. **Clone Repo**
   ```bash
   git clone https://github.com/Ivan-Farrel/koperasi.git

2. **Install Library**
composer install
npm install && npm run dev

3. **Setup Environment**
cp .env.example .env
php artisan key:generate

4. **Migrasi Database & Link Storage**
php artisan migrate --seed
php artisan storage:link

5. **Jalankan Aplikasi**
php artisan serve