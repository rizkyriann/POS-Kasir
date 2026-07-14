# POS-Kasir

Aplikasi Point of Sale (Kasir) berbasis **Laravel 13** dan **Livewire 4**, dilengkapi dengan manajemen menu, transaksi, dan multi-role (Owner, Admin, Kasir).

## Persyaratan

- PHP ^8.3
- Composer
- Node.js & npm

## Instalasi

1. **Clone / salin repository**

   ```bash
   git clone <repo-url> POS-Kasir
   cd POS-Kasir
   ```

2. **Install dependency PHP**

   ```bash
   composer install
   ```

3. **Install dependency JavaScript**

   ```bash
   npm install
   ```

4. **Siapkan file environment**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Konfigurasi database**

   Secara default aplikasi menggunakan **SQLite**. Pastikan file database ada:

   ```bash
   touch database/database.sqlite
   ```

   Jika ingin menggunakan MySQL, ubah `DB_CONNECTION` di file `.env` dan isi `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.

6. **Migrasi & seed database**

   ```bash
   php artisan migrate --seed
   ```

   Perintah di atas membuat tabel sekaligus mengisi data user default dan menu contoh.

7. **Build asset (production) atau jalankan dev server**

   Untuk production:

   ```bash
   npm run build
   ```

   Untuk development (jalankan di terminal terpisah):

   ```bash
   npm run dev
   ```

8. **Jalankan aplikasi**

   ```bash
   php artisan serve
   ```

   Buka <http://localhost:8000> di browser.

## Akun Default

| Role  | Email              | Password  |
|-------|--------------------|-----------|
| Owner | owner@cafe.test    | password  |
| Admin | admin@cafe.test    | password  |
| Kasir | kasir@cafe.test    | password  |

## Perintah Berguna

- `composer setup` — menjalankan install, generate key, migrate, npm install & build secara berurutan.
- `php artisan migrate:fresh --seed` — reset database dan mengisi ulang data seeder.
- `npm run dev` — menjalankan Vite dev server dengan hot reload.
- `php artisan test` — menjalankan test.

## Struktur Singkat

- `app/Http/Controllers/AuthController.php` — login & logout.
- `app/Livewire/` — komponen Livewire (POS, daftar order, dll).
- `database/seeders/DatabaseSeeder.php` — data user & menu awal.
- `resources/views/auth/login.blade.php` — halaman login.
