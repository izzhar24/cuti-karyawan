# Aplikasi Pengelolaan Cuti Pegawai (Laravel 7)

Aplikasi ini dibuat untuk mengelola data **admin**, **pegawai**, dan **cuti pegawai**. Admin dapat melakukan login, CRUD data pegawai dan cuti, serta memvalidasi pengajuan cuti berdasarkan sejumlah aturan bisnis.

---

## 🔧 Spesifikasi

- Laravel 7
- PHP 7.4
- MySQL
- Bootstrap 4
- SweetAlert 2 Notification

---

## ⚙️ Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/izzhar24/cuti-karyawan.git
cd cuti-karyawan
```

### 2. Install Dependency
```bash
composer install
npm install && npm run dev
```
### 3. Buat File Environment
```bash
cp .env.example .env
```

- Edit .env lalu sesuaikan konfigurasi database:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cuti_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Key & Jalankan Migrasi
```bash
php artisan key:generate
php artisan migrate
php artisan db:seed
```
- Seeder akan membuat 1 admin default:
```bash
Email: admin@mail.com
Password: password
```

runnig serve 
```bash
php artisan serve
```

📝 Fitur Validasi Cuti
Durasi cuti hanya 1 hari.

Tanggal mulai cuti harus ≥ 3 hari dari hari ini.

Tidak boleh mengambil cuti lebih dari 12 hari dalam satu tahun.

Cuti hanya bisa diambil 1 kali dalam bulan yang sama.

Tanggal selesai ≥ tanggal mulai.

🧩 Komponen Khusus
Aplikasi dilengkapi dengan komponen Blade seperti:

<x-form.input> – Input text dinamis dengan validasi

<x-form.radio> – Input radio (jenis kelamin)

<x-form.select> – Dropdown dinamis

<x-form.password-toggle> – Input password dengan show/hide

📦 Ekstra
Validasi error ditampilkan menggunakan Laravel validation & SweetAlert.

Form register dinonaktifkan.

Tersedia fitur edit profil untuk admin.