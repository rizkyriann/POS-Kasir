# Rules Pengembangan Proyek POS Kasir Cafe

## 1. Tujuan Aplikasi

Aplikasi ini adalah **POS Kasir Cafe berbasis Laravel** untuk 1 outlet saja.

Aplikasi digunakan untuk:

- Mengelola transaksi kasir cafe
- Mencatat pesanan dine in dan takeaway
- Mengelola menu cafe
- Mengelola kategori menu
- Mencetak struk transaksi
- Melihat laporan penjualan
- Melihat dan mengubah status proses pesanan

Aplikasi ini **bukan**:

- POS minimarket
- Warehouse Management System
- Aplikasi inventori
- Aplikasi multi cabang
- Aplikasi bahan baku cafe
- Kitchen Display System kompleks

---

## 2. Stack yang Digunakan

Stack utama:

- Laravel versi terbaru
- MySQL
- Laravel Breeze untuk authentication
- Blade template
- Tailwind CSS
- Livewire
- Struktur Laravel standar

Stack yang tidak digunakan:

- React
- Vue
- Inertia
- Payment gateway
- QRIS otomatis

---

## 3. Aturan Penggunaan Livewire

Livewire digunakan untuk halaman yang membutuhkan interaksi cepat tanpa reload halaman.

Livewire wajib digunakan untuk:

- Halaman POS kasir
- Keranjang transaksi
- Perhitungan subtotal, grand total, paid amount, dan change amount
- Filter menu berdasarkan kategori
- Pagination daftar menu di halaman POS
- Filter order berdasarkan status
- Filter laporan jika diperlukan

CRUD sederhana boleh menggunakan:

- Blade biasa
- Controller Laravel
- Livewire

Pilih pendekatan yang paling rapi dan mudah dikelola.

---

## 4. Aturan Penamaan

### Model

Gunakan nama model singular dan jelas:

- User
- Menu
- MenuCategory
- Transaction
- TransactionItem
- Setting

Dilarang menggunakan nama model:

- Product
- Branch
- Inventory
- Stock
- Supplier
- Warehouse
- RawMaterial

Produk dalam aplikasi ini harus disebut **Menu**, bukan **Product**.

---

### Controller

Gunakan nama controller sesuai resource:

- DashboardController
- MenuCategoryController
- MenuController
- TransactionController
- OrderController
- ReportController
- SettingController

---

### Migration

Gunakan nama migration Laravel standar:

- create_menu_categories_table
- create_menus_table
- create_transactions_table
- create_transaction_items_table
- create_settings_table

Dilarang membuat migration:

- create_branches_table
- create_inventory_table
- create_stocks_table
- create_stock_movements_table
- create_suppliers_table
- create_purchases_table
- create_purchase_items_table
- create_warehouses_table
- create_raw_materials_table

---

### Route

Gunakan route resource jika memungkinkan:

- menu-categories
- menus
- transactions
- orders
- reports
- settings

Contoh struktur route:

- /dashboard
- /pos
- /orders
- /transactions
- /reports
- /settings
- /menu-categories
- /menus

---

### Blade View

Gunakan struktur Blade yang rapi:

```text
resources/views/
├── dashboard/
├── pos/
├── orders/
├── transactions/
├── reports/
├── settings/
├── menu-categories/
└── menus/
```

---

### Livewire Component

Gunakan nama komponen yang jelas:

- PosCashier
- OrderList
- SalesReport
- MenuCategoryFilter
- TransactionCart

Contoh lokasi:

```text
app/Livewire/PosCashier.php
resources/views/livewire/pos-cashier.blade.php
```

---

## 5. Aturan Coding Laravel

- Gunakan struktur Laravel standar.
- Gunakan migration untuk membuat tabel.
- Gunakan model Eloquent.
- Gunakan relationship antar model.
- Gunakan controller untuk proses CRUD sederhana.
- Gunakan middleware untuk membatasi akses role.
- Gunakan Form Request jika validasi mulai kompleks.
- Gunakan database transaction saat menyimpan transaksi dan transaction items.
- Jangan menulis logic bisnis terlalu banyak di Blade.
- Jangan membuat fitur di luar scope MVP.
- Jangan menambahkan fitur inventori.
- Jangan menambahkan fitur multi cabang.
- Jangan menambahkan fitur diskon, pajak, atau service charge.
- Jangan menambahkan payment gateway.

---

## 6. Aturan Database

Database utama:

- users
- menu_categories
- menus
- transactions
- transaction_items
- settings

Dilarang membuat tabel:

- branches
- inventory
- stocks
- stock_movements
- suppliers
- purchases
- purchase_items
- warehouses
- raw_materials

Dilarang membuat kolom:

- branch_id
- discount
- tax
- service_charge
- stock
- supplier_id
- warehouse_id

---

## 7. Aturan Role dan Permission

Role yang digunakan:

- owner
- admin
- kasir

### Owner

Owner boleh:

- Mengelola user
- Mengelola kategori menu
- Mengelola menu
- Melihat semua transaksi
- Melihat semua laporan
- Melihat semua status order
- Melihat dashboard owner

---

### Admin

Admin boleh:

- Mengelola kategori menu
- Mengelola menu
- Mengelola kasir
- Melihat semua transaksi
- Melihat laporan penjualan
- Melihat semua order
- Mengubah status order

---

### Kasir

Kasir boleh:

- Membuka halaman POS kasir
- Melihat menu dalam bentuk card
- Filter menu berdasarkan kategori
- Membuat transaksi
- Mengatur qty menu
- Mencetak struk
- Melihat riwayat transaksi sendiri
- Melihat daftar order
- Mengubah status order dari pending ke processing
- Mengubah status order dari processing ke completed

Kasir tidak boleh:

- Mengelola user
- Menambah kategori menu
- Mengedit kategori menu
- Menghapus kategori menu
- Menambah menu
- Mengedit menu
- Menghapus menu
- Melihat laporan owner
- Menghapus transaksi

---

## 8. Aturan Manajemen Kategori Menu

Kategori menu digunakan untuk mengelompokkan hidangan.

Contoh kategori:

- Coffee
- Non Coffee
- Snack
- Main Course
- Dessert

Aturan kategori:

- Kategori hanya bisa dikelola owner dan admin.
- Kasir tidak boleh mengelola kategori.
- Kategori memiliki field name, description, dan is_active.
- Kategori aktif digunakan sebagai filter di halaman POS.
- Kategori tidak aktif tidak tampil di filter halaman POS.
- Kategori tidak dihapus permanen jika masih digunakan oleh menu.
- Gunakan nonaktifkan kategori untuk keamanan data.

---

## 9. Aturan Manajemen Menu

Menu adalah hidangan yang dijual di cafe.

Aturan menu:

- Produk disebut Menu, bukan Product.
- Setiap menu wajib memiliki kategori.
- Setiap menu memiliki nama, harga, gambar, deskripsi, dan status tersedia/tidak tersedia.
- Menu hanya bisa dikelola owner dan admin.
- Kasir tidak boleh mengelola menu.
- Menu tidak tersedia tidak tampil di halaman POS.
- Menu tidak tersedia tetap boleh tampil di halaman manajemen menu owner/admin.
- Menu boleh dinonaktifkan atau diubah status ketersediaannya.

---

## 10. Aturan Halaman POS Card Grid

Halaman POS wajib menggunakan Livewire.

Tampilan menu wajib berbentuk card grid.

Setiap card menu wajib menampilkan:

- Gambar menu
- Nama menu
- Harga menu
- Tombol tambah ke keranjang
- Qty menu yang dipesan jika menu sudah masuk keranjang

Aturan tampilan:

- Responsif untuk desktop dan mobile
- Card rapi dan mudah diklik
- Menu yang tampil hanya menu dengan is_available = true
- Menu yang tidak tersedia tidak tampil di POS

---

## 11. Aturan Pagination Menu di Halaman POS

- Daftar menu di halaman POS wajib menggunakan pagination.
- Pagination boleh menggunakan Livewire pagination.
- Pagination harus tetap berjalan saat filter kategori digunakan.
- Jumlah item per halaman bisa disesuaikan, misalnya 8, 12, atau 16 menu per halaman.

---

## 12. Aturan Filter Menu Berdasarkan Kategori

- Filter kategori wajib ada di halaman POS.
- Filter kategori menggunakan data dari tabel menu_categories.
- Hanya kategori aktif yang tampil sebagai filter.
- Jika kategori dipilih, daftar menu hanya menampilkan menu dari kategori tersebut.
- Jika filter dikosongkan, semua menu tersedia ditampilkan.

---

## 13. Aturan Transaksi

Setiap transaksi wajib memiliki:

- invoice_number
- cashier_id
- order_type
- order_status
- subtotal
- grand_total
- paid_amount
- change_amount
- payment_method
- transaction_status
- transaction_date

Aturan transaksi:

- Gunakan database transaction saat menyimpan transaksi.
- Simpan data utama ke tabel transactions.
- Simpan detail item ke tabel transaction_items.
- Simpan menu_name dan price di transaction_items.
- Tujuannya agar riwayat transaksi tetap aman meskipun nama atau harga menu berubah.
- subtotal dihitung dari total seluruh item.
- grand_total sama dengan subtotal.
- Tidak ada diskon.
- Tidak ada pajak.
- Tidak ada service charge.

Rumus:

```text
subtotal = total seluruh transaction_items
grand_total = subtotal
change_amount = paid_amount - grand_total
```

---

## 14. Aturan Metode Pembayaran

Metode pembayaran hanya boleh:

- cash
- qris

Aturan cash:

- paid_amount wajib diisi.
- change_amount dihitung dari paid_amount - grand_total.
- paid_amount tidak boleh lebih kecil dari grand_total.

Aturan QRIS:

- QRIS hanya dicatat sebagai metode pembayaran manual.
- Tidak ada integrasi otomatis QRIS.
- Tidak ada payment gateway.
- paid_amount otomatis sama dengan grand_total.
- change_amount bernilai 0.

Dilarang membuat metode pembayaran:

- debit
- credit_card
- transfer
- e-wallet
- payment_gateway
- midtrans
- xendit
- stripe
- paypal

---

## 15. Aturan Status Order

Status order digunakan untuk proses pesanan cafe.

Nilai order_status:

- pending
- processing
- completed
- cancelled

Penjelasan:

- pending: order baru dibuat dan belum diproses.
- processing: order sedang dibuat/disiapkan.
- completed: order sudah selesai.
- cancelled: order dibatalkan.

Aturan:

- Kasir/Admin bisa melihat daftar order.
- Kasir/Admin bisa mengubah status order.
- Owner bisa melihat semua status order.
- Admin bisa melihat semua status order.
- Kasir bisa memproses order dari pending ke processing.
- Kasir bisa menyelesaikan order dari processing ke completed.
- Fitur ini cukup berupa halaman daftar order dengan tombol ubah status.
- Jangan membuat Kitchen Display System kompleks sebelum diminta.

---

## 16. Perbedaan order_status dan transaction_status

### order_status

Digunakan untuk status proses pesanan cafe.

Contoh:

```text
pending -> processing -> completed
```

### transaction_status

Digunakan untuk status pembayaran/transaksi.

Nilai transaction_status:

- paid
- cancelled
- refunded

Contoh kasus:

```text
Order kopi sudah dibayar:
transaction_status = paid

Namun kopi belum dibuat:
order_status = pending

Saat barista mulai membuat kopi:
order_status = processing

Saat kopi selesai:
order_status = completed
```

---

## 17. Aturan Laporan

Laporan yang dibuat untuk MVP:

- Laporan penjualan harian
- Laporan penjualan bulanan
- Total transaksi
- Total omzet
- Menu terlaris
- Metode pembayaran cash/qris
- Filter tanggal
- Filter kasir
- Filter tipe pesanan
- Filter status transaksi

Dilarang membuat filter cabang karena aplikasi hanya untuk 1 outlet.

---

## 18. Aturan UI

- Gunakan Blade dan Tailwind CSS.
- Gunakan layout yang sederhana dan rapi.
- Halaman POS harus mudah digunakan oleh kasir.
- Tombol transaksi harus jelas.
- Badge status order harus mudah dibedakan.
- Card menu harus responsif.
- Tampilan mobile tetap nyaman digunakan.
- Jangan membuat UI terlalu kompleks untuk MVP.

---

## 19. Fitur yang Tidak Boleh Dibuat

Dilarang membuat fitur:

- Inventori
- Stok barang
- Supplier
- Pembelian bahan baku
- Stock movement
- Stok opname
- Warehouse
- Purchase order
- Komposisi resep
- Manajemen bahan baku
- Kitchen Display System kompleks
- Tracking bahan baku
- Diskon
- Pajak
- Service charge
- Multi cabang
- Manajemen cabang/outlet
- Payment gateway
- Pembayaran online otomatis
- Metode pembayaran selain cash dan qris
- React
- Vue
- Inertia

---

## 20. Aturan Khusus untuk AI Agent

AI Agent wajib mengikuti aturan berikut:

- Jangan menambahkan fitur inventori.
- Jangan membuat tabel stok.
- Jangan membuat kolom stock.
- Jangan membuat fitur multi cabang.
- Jangan membuat tabel branches.
- Jangan membuat kolom branch_id.
- Jangan membuat Kitchen Display System kompleks sebelum diminta.
- Jangan membuat fitur diskon.
- Jangan membuat fitur pajak.
- Jangan membuat fitur service charge.
- Jangan membuat payment gateway.
- Jangan membuat metode pembayaran selain cash dan qris.
- Jangan mengizinkan kasir mengelola kategori menu.
- Jangan mengizinkan kasir mengelola menu.
- Jangan mengganti istilah Menu menjadi Product.
- Jangan menggunakan React, Vue, atau Inertia.
