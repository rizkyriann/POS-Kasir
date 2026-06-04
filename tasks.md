# Roadmap Pengerjaan POS Kasir Cafe Laravel

## Phase 1: Setup Laravel

- [ ] Install PHP versi yang sesuai dengan Laravel terbaru
- [ ] Install Composer
- [ ] Install Node.js dan NPM
- [ ] Buat project Laravel baru
- [ ] Masuk ke folder project
- [ ] Copy file `.env.example` menjadi `.env`
- [ ] Generate application key
- [ ] Buat database MySQL baru
- [ ] Konfigurasi database di file `.env`
- [ ] Jalankan migration awal Laravel
- [ ] Jalankan server lokal Laravel
- [ ] Pastikan halaman Laravel berhasil dibuka di browser
- [ ] Inisialisasi Git repository
- [ ] Buat struktur folder mengikuti standar Laravel

---

## Phase 2: Install dan Setup Laravel Breeze

- [ ] Install Laravel Breeze
- [ ] Pilih Breeze Blade stack
- [ ] Install dependency frontend
- [ ] Jalankan build asset
- [ ] Jalankan migration Breeze
- [ ] Pastikan halaman login berjalan
- [ ] Pastikan halaman register berjalan
- [ ] Pastikan user bisa login
- [ ] Pastikan user bisa logout
- [ ] Sesuaikan tampilan auth dengan kebutuhan POS Cafe
- [ ] Nonaktifkan register publik jika aplikasi hanya dibuat oleh owner/admin
- [ ] Pastikan redirect setelah login sesuai role

---

## Phase 3: Install dan Setup Livewire

- [ ] Install Livewire
- [ ] Pastikan Livewire terdaftar di Laravel
- [ ] Setup asset Livewire di layout Blade
- [ ] Tambahkan directive Livewire styles
- [ ] Tambahkan directive Livewire scripts
- [ ] Buat komponen Livewire percobaan
- [ ] Pastikan komponen Livewire berjalan
- [ ] Pastikan update data Livewire berjalan tanpa reload halaman
- [ ] Buat aturan penggunaan Livewire untuk halaman POS
- [ ] Buat aturan penggunaan Livewire untuk order status
- [ ] Buat aturan penggunaan Livewire untuk laporan
- [ ] Pastikan pagination Livewire dapat digunakan
- [ ] Pastikan validasi Livewire dapat digunakan

Livewire wajib digunakan untuk:

- [ ] Halaman POS kasir
- [ ] Keranjang transaksi
- [ ] Filter kategori menu di POS
- [ ] Pagination menu di POS
- [ ] Perhitungan subtotal, grand_total, paid_amount, dan change_amount
- [ ] Filter order berdasarkan status jika dibutuhkan
- [ ] Filter laporan jika dibutuhkan

---

## Phase 4: Authentication dan Role

- [ ] Tambahkan kolom role pada tabel users
- [ ] Tentukan value role: owner, admin, kasir
- [ ] Update model User agar role bisa digunakan
- [ ] Buat seeder user owner
- [ ] Buat seeder user admin
- [ ] Buat seeder user kasir
- [ ] Buat middleware role
- [ ] Daftarkan middleware role di Laravel
- [ ] Batasi halaman owner hanya untuk owner
- [ ] Batasi halaman admin untuk owner dan admin
- [ ] Batasi halaman kasir untuk owner, admin, dan kasir
- [ ] Buat redirect login berdasarkan role
- [ ] Pastikan kasir tidak bisa mengakses manajemen user
- [ ] Pastikan kasir tidak bisa mengakses manajemen kategori menu
- [ ] Pastikan kasir tidak bisa mengakses manajemen menu
- [ ] Pastikan kasir tidak bisa mengakses laporan owner

---

## Phase 5: Dashboard Layout

- [ ] Buat layout dashboard utama
- [ ] Buat sidebar navigasi
- [ ] Buat topbar
- [ ] Buat menu navigasi berdasarkan role
- [ ] Buat dashboard owner
- [ ] Buat dashboard admin
- [ ] Buat dashboard kasir
- [ ] Tampilkan ringkasan transaksi hari ini
- [ ] Tampilkan ringkasan omzet hari ini
- [ ] Tampilkan ringkasan order pending
- [ ] Tampilkan ringkasan order processing
- [ ] Tampilkan link cepat ke halaman POS
- [ ] Tampilkan link cepat ke daftar order
- [ ] Pastikan tampilan responsif
- [ ] Pastikan sidebar nyaman digunakan di mobile

---

## Phase 6: Manajemen Kategori Menu

- [ ] Membuat migration `menu_categories`
- [ ] Membuat model `MenuCategory`
- [ ] Membuat controller atau Livewire component untuk kategori menu
- [ ] Membuat halaman daftar kategori menu
- [ ] Membuat halaman tambah kategori menu
- [ ] Membuat halaman edit kategori menu
- [ ] Membuat fitur hapus/nonaktifkan kategori menu
- [ ] Membuat field `name`
- [ ] Membuat field `description`
- [ ] Membuat field `is_active`
- [ ] Validasi `name` wajib diisi
- [ ] Validasi `name` maksimal 255 karakter
- [ ] Tampilkan badge aktif/nonaktif
- [ ] Buat tombol aktif/nonaktif kategori
- [ ] Batasi CRUD kategori menu hanya untuk admin dan owner
- [ ] Kasir tidak boleh mengakses halaman kategori menu
- [ ] Kategori aktif digunakan sebagai filter halaman POS
- [ ] Kategori nonaktif tidak tampil di filter POS
- [ ] Pastikan kategori yang masih dipakai menu tidak dihapus permanen
- [ ] Gunakan nonaktifkan kategori sebagai opsi aman

---

## Phase 7: Manajemen Menu

- [ ] Membuat migration `menus`
- [ ] Membuat model `Menu`
- [ ] Pastikan `menus` memiliki `menu_category_id`
- [ ] Buat relasi `MenuCategory hasMany Menu`
- [ ] Buat relasi `Menu belongsTo MenuCategory`
- [ ] Buat CRUD menu
- [ ] Buat halaman daftar menu
- [ ] Buat halaman tambah menu
- [ ] Buat halaman edit menu
- [ ] Buat halaman detail menu jika diperlukan
- [ ] Batasi CRUD menu hanya untuk admin dan owner
- [ ] Tambah fitur upload gambar menu
- [ ] Tambah fitur status menu tersedia/tidak tersedia
- [ ] Tambahkan field `name`
- [ ] Tambahkan field `price`
- [ ] Tambahkan field `image`
- [ ] Tambahkan field `description`
- [ ] Tambahkan field `is_available`
- [ ] Validasi `menu_category_id` wajib diisi saat membuat menu
- [ ] Validasi nama menu wajib diisi
- [ ] Validasi harga menu wajib angka
- [ ] Validasi harga menu minimal 0
- [ ] Validasi gambar menu bertipe image
- [ ] Simpan gambar menu ke storage public
- [ ] Tampilkan preview gambar menu
- [ ] Kasir tidak boleh mengakses halaman tambah menu
- [ ] Kasir tidak boleh mengakses halaman edit menu
- [ ] Kasir tidak boleh menghapus menu
- [ ] Menu yang tidak tersedia tidak tampil di POS
- [ ] Menu yang tidak tersedia tetap tampil di halaman manajemen menu

---

## Phase 8: Transaksi POS dengan Livewire

- [ ] Membuat Livewire component untuk halaman POS
- [ ] Membuat route `/pos`
- [ ] Menampilkan daftar menu yang tersedia
- [ ] Menampilkan daftar menu dalam bentuk card grid
- [ ] Card menu menampilkan gambar menu
- [ ] Card menu menampilkan nama menu
- [ ] Card menu menampilkan harga menu
- [ ] Card menu menampilkan tombol tambah ke keranjang
- [ ] Card menu menampilkan qty menu yang dipesan jika ada di cart
- [ ] Tambahkan pagination pada daftar menu
- [ ] Tambahkan filter menu berdasarkan kategori
- [ ] Filter hanya menampilkan kategori aktif
- [ ] Hanya tampilkan menu dengan `is_available = true`
- [ ] Menambahkan menu ke keranjang tanpa reload halaman
- [ ] Mengubah qty item tanpa reload halaman
- [ ] Menghapus item dari keranjang tanpa reload halaman
- [ ] Qty item tidak boleh kurang dari 1 jika masih ada di cart
- [ ] Jika qty menjadi 0, hapus item dari cart
- [ ] Menambahkan catatan item
- [ ] Memilih `order_type` dine_in atau takeaway
- [ ] Mengisi nomor meja jika dine_in
- [ ] Mengosongkan nomor meja jika takeaway
- [ ] Mengisi nama pelanggan opsional
- [ ] Menghitung subtotal secara otomatis
- [ ] Menghitung grand_total sama dengan subtotal
- [ ] Memilih `payment_method` cash atau qris
- [ ] Jika cash, input `paid_amount`
- [ ] Jika cash, hitung `change_amount`
- [ ] Jika qris, `paid_amount` otomatis sama dengan `grand_total`
- [ ] Jika qris, `change_amount` bernilai 0
- [ ] Validasi cart tidak boleh kosong
- [ ] Validasi payment method hanya cash dan qris
- [ ] Validasi paid_amount untuk cash tidak boleh kurang dari grand_total
- [ ] Generate invoice_number
- [ ] Menyimpan transaksi ke tabel transactions
- [ ] Menyimpan detail item ke tabel transaction_items
- [ ] Simpan menu_name dan price ke transaction_items
- [ ] Gunakan database transaction saat menyimpan transaksi
- [ ] Setelah transaksi berhasil, kosongkan cart
- [ ] Redirect atau tampilkan tombol cetak struk

Phase transaksi POS tidak boleh mencakup:

- [ ] Diskon
- [ ] Pajak
- [ ] Service charge
- [ ] Payment gateway
- [ ] Metode pembayaran selain cash dan qris
- [ ] Stok menu
- [ ] Inventori bahan baku

---

## Phase 9: Status Order

- [ ] Membuat field `order_status` di transactions
- [ ] Gunakan value order_status: pending, processing, completed, cancelled
- [ ] Set default order_status menjadi pending saat transaksi dibuat
- [ ] Membuat halaman daftar order
- [ ] Menampilkan daftar order pending
- [ ] Menampilkan daftar order processing
- [ ] Menampilkan daftar order completed
- [ ] Menampilkan daftar order cancelled
- [ ] Membuat tombol ubah status order
- [ ] Membuat filter berdasarkan order_status
- [ ] Membuat filter berdasarkan tanggal
- [ ] Membuat filter berdasarkan kasir
- [ ] Menampilkan badge status order
- [ ] Boleh menggunakan Livewire agar filter dan update status lebih responsif
- [ ] Kasir bisa ubah pending ke processing
- [ ] Kasir bisa ubah processing ke completed
- [ ] Admin bisa mengubah semua status order
- [ ] Owner bisa melihat semua status order
- [ ] Buat tombol cancel order jika diperlukan
- [ ] Pastikan cancelled tidak dihitung sebagai order aktif
- [ ] Pastikan fitur ini tetap sederhana
- [ ] Jangan membuat Kitchen Display System kompleks

---

## Phase 10: Cetak Struk

- [ ] Buat halaman detail transaksi
- [ ] Buat halaman print struk
- [ ] Tampilkan nama cafe dari settings
- [ ] Tampilkan alamat cafe dari settings
- [ ] Tampilkan invoice_number
- [ ] Tampilkan tanggal transaksi
- [ ] Tampilkan nama kasir
- [ ] Tampilkan order_type
- [ ] Tampilkan nomor meja jika dine_in
- [ ] Tampilkan nama pelanggan jika ada
- [ ] Tampilkan item transaksi
- [ ] Tampilkan qty setiap item
- [ ] Tampilkan harga setiap item
- [ ] Tampilkan subtotal setiap item
- [ ] Tampilkan subtotal transaksi
- [ ] Tampilkan grand_total
- [ ] Tampilkan payment_method
- [ ] Tampilkan paid_amount
- [ ] Tampilkan change_amount
- [ ] Tambahkan tombol print
- [ ] Buat tampilan struk sederhana
- [ ] Pastikan struk bisa dicetak dari browser

---

## Phase 11: Laporan Penjualan

- [ ] Buat halaman laporan penjualan
- [ ] Buat laporan penjualan harian
- [ ] Buat laporan penjualan bulanan
- [ ] Tampilkan total transaksi
- [ ] Tampilkan total omzet
- [ ] Tampilkan menu terlaris
- [ ] Tampilkan metode pembayaran cash/qris
- [ ] Buat filter tanggal
- [ ] Buat filter kasir
- [ ] Buat filter metode pembayaran
- [ ] Buat filter tipe pesanan
- [ ] Buat filter status transaksi
- [ ] Gunakan transaction_status paid untuk menghitung omzet
- [ ] Jangan hitung transaksi cancelled sebagai omzet
- [ ] Jangan buat filter cabang
- [ ] Jangan buat laporan stok
- [ ] Jangan buat laporan bahan baku
- [ ] Owner bisa melihat semua laporan
- [ ] Admin bisa melihat laporan penjualan
- [ ] Kasir tidak boleh melihat laporan owner

---

## Phase 12: Settings Cafe

- [ ] Membuat migration `settings`
- [ ] Membuat model `Setting`
- [ ] Buat halaman pengaturan cafe
- [ ] Tambahkan setting nama cafe
- [ ] Tambahkan setting alamat cafe
- [ ] Tambahkan setting nomor telepon cafe
- [ ] Tambahkan setting teks footer struk
- [ ] Tambahkan setting logo cafe jika diperlukan
- [ ] Owner bisa mengubah settings
- [ ] Admin bisa mengubah settings jika diizinkan
- [ ] Kasir tidak boleh mengubah settings
- [ ] Gunakan settings untuk data struk
- [ ] Gunakan settings untuk tampilan aplikasi

---

## Phase 13: Testing

- [ ] Test login owner
- [ ] Test login admin
- [ ] Test login kasir
- [ ] Test middleware role
- [ ] Test kasir tidak bisa akses kategori menu
- [ ] Test kasir tidak bisa akses manajemen menu
- [ ] Test owner bisa mengelola kategori menu
- [ ] Test admin bisa mengelola kategori menu
- [ ] Test owner bisa mengelola menu
- [ ] Test admin bisa mengelola menu
- [ ] Test menu wajib memiliki kategori
- [ ] Test menu tidak tersedia tidak tampil di POS
- [ ] Test filter kategori di POS
- [ ] Test pagination menu di POS
- [ ] Test tambah item ke cart
- [ ] Test ubah qty item di cart
- [ ] Test hapus item dari cart
- [ ] Test transaksi cash
- [ ] Test transaksi qris
- [ ] Test paid_amount cash kurang dari grand_total
- [ ] Test cetak struk
- [ ] Test order_status pending
- [ ] Test ubah order_status ke processing
- [ ] Test ubah order_status ke completed
- [ ] Test laporan harian
- [ ] Test laporan bulanan
- [ ] Test filter laporan
- [ ] Test tidak ada kolom branch_id
- [ ] Test tidak ada kolom discount, tax, service_charge
- [ ] Test tidak ada fitur inventori

---

## Phase 14: Deployment

- [ ] Siapkan environment production
- [ ] Upload project ke server
- [ ] Setup database MySQL production
- [ ] Konfigurasi file `.env` production
- [ ] Jalankan composer install untuk production
- [ ] Jalankan npm build
- [ ] Jalankan migration
- [ ] Jalankan seeder user awal
- [ ] Setup storage link
- [ ] Setup permission folder storage dan bootstrap/cache
- [ ] Setup web server Apache/Nginx
- [ ] Setup domain atau subdomain
- [ ] Aktifkan HTTPS
- [ ] Test login production
- [ ] Test POS production
- [ ] Test cetak struk production
- [ ] Test laporan production
- [ ] Backup database awal
- [ ] Dokumentasikan akun owner awal
