# Rancangan Database POS Kasir Cafe

## 1. Daftar Tabel Utama

Tabel utama aplikasi:

- users
- menu_categories
- menus
- transactions
- transaction_items
- settings

Aplikasi ini tidak menggunakan:

- Inventory
- Stok barang
- Supplier
- Warehouse
- Multi cabang
- Diskon
- Pajak
- Service charge

---

## 2. Tabel users

Tabel `users` digunakan untuk menyimpan data pengguna aplikasi.

### Kolom

| Kolom | Tipe Data | Keterangan |
|---|---|---|
| id | bigint unsigned | Primary key |
| name | string | Nama user |
| email | string unique | Email login |
| password | string | Password user |
| role | enum/string | owner, admin, kasir |
| created_at | timestamp | Waktu dibuat |
| updated_at | timestamp | Waktu diperbarui |

### Value role

```text
owner
admin
kasir
```

### Catatan

- Owner memiliki akses tertinggi.
- Admin bisa mengelola kategori menu, menu, kasir, transaksi, order, dan laporan.
- Kasir hanya bisa mengakses halaman POS, membuat transaksi, mencetak struk, dan mengubah status order sesuai izin.
- Kasir tidak boleh mengelola kategori menu.
- Kasir tidak boleh mengelola menu.
- Kasir tidak boleh mengelola user.

---

## 3. Tabel menu_categories

Tabel `menu_categories` digunakan untuk mengelompokkan menu/hidangan cafe.

### Kolom

| Kolom | Tipe Data | Keterangan |
|---|---|---|
| id | bigint unsigned | Primary key |
| name | string | Nama kategori |
| description | text nullable | Deskripsi kategori |
| is_active | boolean | Status aktif kategori |
| created_at | timestamp | Waktu dibuat |
| updated_at | timestamp | Waktu diperbarui |

### Contoh kategori

```text
Coffee
Non Coffee
Snack
Main Course
Dessert
```

### Catatan

- Kategori menu digunakan untuk mengelompokkan hidangan.
- Kategori menu hanya bisa dikelola oleh admin dan owner.
- Kasir tidak boleh mengelola kategori menu.
- Kategori aktif digunakan untuk filter di halaman POS.
- Kategori yang tidak aktif tidak ditampilkan di filter POS.
- Kategori yang masih digunakan oleh menu sebaiknya tidak dihapus permanen.
- Gunakan `is_active = false` untuk menonaktifkan kategori.

---

## 4. Tabel menus

Tabel `menus` digunakan untuk menyimpan daftar hidangan yang dijual di cafe.

Produk dalam aplikasi ini disebut **Menu**, bukan **Product**.

### Kolom

| Kolom | Tipe Data | Keterangan |
|---|---|---|
| id | bigint unsigned | Primary key |
| menu_category_id | bigint unsigned | Foreign key ke menu_categories |
| name | string | Nama menu |
| price | decimal(12,2) | Harga menu |
| image | string nullable | Path gambar menu |
| description | text nullable | Deskripsi menu |
| is_available | boolean | Status tersedia/tidak tersedia |
| created_at | timestamp | Waktu dibuat |
| updated_at | timestamp | Waktu diperbarui |

### Relasi

```text
menus.menu_category_id -> menu_categories.id
```

### Catatan

- Setiap menu/hidangan wajib memiliki `menu_category_id`.
- `menu_category_id` berelasi ke tabel `menu_categories`.
- Menu tanpa kategori tidak boleh dibuat.
- Menu yang `is_available = false` tidak tampil sebagai menu aktif di halaman POS.
- Menu tetap boleh muncul di halaman manajemen menu untuk admin/owner.
- Menu hanya bisa dikelola oleh admin dan owner.
- Kasir hanya bisa melihat menu di halaman POS.
- Tidak ada kolom stok pada tabel menus.

---

## 5. Tabel transactions

Tabel `transactions` digunakan untuk menyimpan data transaksi utama.

### Kolom

| Kolom | Tipe Data | Keterangan |
|---|---|---|
| id | bigint unsigned | Primary key |
| invoice_number | string unique | Nomor invoice transaksi |
| cashier_id | bigint unsigned | Foreign key ke users |
| order_type | enum/string | dine_in atau takeaway |
| order_status | enum/string | pending, processing, completed, cancelled |
| table_number | string nullable | Nomor meja untuk dine in |
| customer_name | string nullable | Nama pelanggan opsional |
| subtotal | decimal(12,2) | Total sebelum grand total |
| grand_total | decimal(12,2) | Total akhir |
| paid_amount | decimal(12,2) | Jumlah uang dibayar |
| change_amount | decimal(12,2) | Uang kembalian |
| payment_method | enum/string | cash atau qris |
| transaction_status | enum/string | paid, cancelled, refunded |
| transaction_date | datetime/date | Tanggal transaksi |
| created_at | timestamp | Waktu dibuat |
| updated_at | timestamp | Waktu diperbarui |

### Kolom yang Tidak Boleh Ada

Tabel `transactions` tidak boleh memiliki kolom:

- branch_id
- discount
- tax
- service_charge

### Relasi

```text
transactions.cashier_id -> users.id
```

### Value order_type

```text
dine_in
takeaway
```

### Value order_status

```text
pending
processing
completed
cancelled
```

### Value transaction_status

```text
paid
cancelled
refunded
```

### Value payment_method

```text
cash
qris
```

### Catatan

- `invoice_number` wajib unik.
- `cashier_id` digunakan untuk mencatat kasir yang membuat transaksi.
- `order_type` digunakan untuk membedakan dine in dan takeaway.
- `table_number` wajib diisi jika `order_type = dine_in`.
- `customer_name` opsional.
- `order_status` digunakan untuk status proses pesanan.
- `transaction_status` digunakan untuk status pembayaran/transaksi.
- `payment_method` hanya boleh cash dan qris.
- `grand_total` selalu sama dengan `subtotal`.
- Tidak ada diskon.
- Tidak ada pajak.
- Tidak ada service charge.
- Tidak ada branch_id karena aplikasi hanya untuk 1 outlet.

---

## 6. Tabel transaction_items

Tabel `transaction_items` digunakan untuk menyimpan detail item pada transaksi.

### Kolom

| Kolom | Tipe Data | Keterangan |
|---|---|---|
| id | bigint unsigned | Primary key |
| transaction_id | bigint unsigned | Foreign key ke transactions |
| menu_id | bigint unsigned nullable | Foreign key ke menus |
| menu_name | string | Nama menu saat transaksi |
| price | decimal(12,2) | Harga menu saat transaksi |
| quantity | integer | Jumlah item |
| note | text nullable | Catatan item pesanan |
| subtotal | decimal(12,2) | price x quantity |
| created_at | timestamp | Waktu dibuat |
| updated_at | timestamp | Waktu diperbarui |

### Relasi

```text
transaction_items.transaction_id -> transactions.id
transaction_items.menu_id -> menus.id
```

### Catatan

- `menu_name` wajib disimpan agar riwayat transaksi tetap aman meskipun nama menu berubah.
- `price` wajib disimpan agar riwayat transaksi tetap aman meskipun harga menu berubah.
- `subtotal` item dihitung dari `price * quantity`.
- `note` digunakan untuk catatan item, misalnya "less sugar", "no ice", atau "extra spicy".
- Tidak ada relasi ke stok.
- Tidak ada pengurangan stok.
- Tidak ada bahan baku.

---

## 7. Tabel settings

Tabel `settings` digunakan untuk menyimpan pengaturan sederhana aplikasi.

### Kolom

| Kolom | Tipe Data | Keterangan |
|---|---|---|
| id | bigint unsigned | Primary key |
| key | string unique | Nama setting |
| value | text nullable | Isi setting |
| created_at | timestamp | Waktu dibuat |
| updated_at | timestamp | Waktu diperbarui |

### Contoh key

```text
cafe_name
cafe_address
cafe_phone
receipt_footer_text
cafe_logo
```

### Catatan

- Settings dapat digunakan untuk data struk.
- Settings dapat digunakan untuk nama cafe di dashboard.
- Settings tidak berhubungan dengan cabang.
- Settings hanya untuk 1 outlet.

---

## 8. Relasi Antar Tabel

### menu_categories dan menus

```text
menu_categories has many menus
menus belongs to menu_categories
```

### users dan transactions

```text
users has many transactions melalui cashier_id
transactions belongs to users melalui cashier_id
```

### transactions dan transaction_items

```text
transactions has many transaction_items
transaction_items belongs to transactions
```

### menus dan transaction_items

```text
menus has many transaction_items
transaction_items belongs to menus
```

---

## 9. Enum / Value yang Digunakan

### role

```text
owner
admin
kasir
```

### order_type

```text
dine_in
takeaway
```

### order_status

```text
pending
processing
completed
cancelled
```

### transaction_status

```text
paid
cancelled
refunded
```

### payment_method

```text
cash
qris
```

---

## 10. Perbedaan order_status dan transaction_status

### order_status

`order_status` digunakan untuk status proses pesanan cafe.

Contoh alur:

```text
pending -> processing -> completed
```

Penjelasan:

- pending: pesanan baru dibuat dan belum diproses.
- processing: pesanan sedang dibuat/disiapkan.
- completed: pesanan sudah selesai.
- cancelled: pesanan dibatalkan.

---

### transaction_status

`transaction_status` digunakan untuk status pembayaran/transaksi.

Value:

```text
paid
cancelled
refunded
```

Contoh:

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

## 11. Aturan Perhitungan Transaksi

Rumus:

```text
subtotal = total seluruh transaction_items
grand_total = subtotal
change_amount = paid_amount - grand_total
```

Aturan:

- Tidak ada diskon.
- Tidak ada pajak.
- Tidak ada service charge.
- `grand_total` selalu sama dengan `subtotal`.

---

## 12. Aturan Payment Method

Metode pembayaran hanya boleh:

```text
cash
qris
```

### Cash

- `paid_amount` wajib diisi.
- `paid_amount` harus lebih besar atau sama dengan `grand_total`.
- `change_amount = paid_amount - grand_total`.

### QRIS

- QRIS hanya dicatat sebagai metode pembayaran manual.
- Tidak ada payment gateway.
- Tidak ada validasi otomatis QRIS.
- `paid_amount` otomatis sama dengan `grand_total`.
- `change_amount` bernilai 0.

---

## 13. Tabel yang Dilarang Dibuat

Karena aplikasi tidak memakai inventori, dilarang membuat tabel:

- inventory
- stocks
- stock_movements
- suppliers
- purchases
- purchase_items
- warehouses
- raw_materials

Karena aplikasi tidak memakai multi cabang, dilarang membuat tabel:

- branches

---

## 14. Kolom yang Dilarang Dibuat

Dilarang membuat kolom:

- branch_id
- discount
- tax
- service_charge
- stock
- supplier_id
- warehouse_id

Kolom ini tidak boleh dibuat di tabel mana pun kecuali ada permintaan baru secara eksplisit.

---

## 15. Catatan Penting untuk AI Agent

AI Agent wajib mengikuti aturan berikut:

- Jangan membuat fitur inventori.
- Jangan membuat tabel stok.
- Jangan membuat kolom stock.
- Jangan membuat fitur supplier.
- Jangan membuat fitur pembelian bahan baku.
- Jangan membuat fitur warehouse.
- Jangan membuat fitur multi cabang.
- Jangan membuat tabel branches.
- Jangan membuat kolom branch_id.
- Jangan membuat fitur diskon.
- Jangan membuat kolom discount.
- Jangan membuat fitur pajak.
- Jangan membuat kolom tax.
- Jangan membuat fitur service charge.
- Jangan membuat kolom service_charge.
- Jangan membuat payment gateway.
- Jangan membuat metode pembayaran selain cash dan qris.
