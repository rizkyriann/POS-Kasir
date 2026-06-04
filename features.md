# Daftar Fitur POS Kasir Cafe

## 1. MVP Features

MVP adalah fitur inti yang wajib dibuat terlebih dahulu agar aplikasi bisa digunakan untuk operasional dasar cafe.

Fitur MVP:

- Login dan logout
- Role owner, admin, kasir
- Dashboard sesuai role
- Manajemen kategori menu
- Manajemen menu cafe
- Status menu tersedia/tidak tersedia
- Halaman POS kasir menggunakan Livewire
- Menu tampil dalam card grid
- Filter menu berdasarkan kategori
- Pagination daftar menu di POS
- Keranjang transaksi responsif
- Transaksi dine in dan takeaway
- Nomor meja untuk dine in
- Nama pelanggan opsional
- Catatan item pesanan
- Payment method cash dan qris
- Cetak struk
- Status order: pending, processing, completed, cancelled
- Halaman daftar order
- Laporan penjualan harian
- Laporan penjualan bulanan
- Settings cafe sederhana

---

## 2. Future Features

Fitur ini boleh dibuat nanti setelah MVP selesai dan stabil.

Future features:

- Export laporan ke PDF
- Export laporan ke Excel
- Grafik penjualan
- Analisis menu terlaris
- Filter laporan lebih detail
- Customer database sederhana
- Riwayat pembelian customer
- Template struk yang bisa dikustomisasi
- Backup database otomatis
- Dark mode dashboard
- Notifikasi order sederhana
- Printer thermal integration
- Hak akses yang lebih detail

Catatan:

Future features tidak boleh melanggar batasan utama aplikasi.

Tetap tidak boleh membuat:

- Inventori
- Multi cabang
- Diskon
- Pajak
- Service charge
- Payment gateway
- Metode pembayaran selain cash dan qris

Kecuali ada permintaan perubahan scope secara eksplisit.

---

## 3. Not Included Features

Fitur berikut tidak termasuk dalam aplikasi:

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
- Tracking bahan baku
- Kitchen Display System kompleks
- Multi cabang
- Manajemen cabang/outlet
- Diskon
- Pajak
- Service charge
- Payment gateway
- Pembayaran online otomatis
- QRIS otomatis
- Metode pembayaran selain cash dan qris
- React
- Vue
- Inertia

---

## 4. Detail Fitur per Role

## Owner

Owner memiliki akses tertinggi.

Owner bisa:

- Melihat dashboard owner
- Mengelola user
- Mengelola kategori menu
- Menambah kategori menu
- Mengedit kategori menu
- Menghapus/nonaktifkan kategori menu
- Mengelola menu
- Menambah menu
- Mengedit menu
- Menghapus/nonaktifkan menu
- Mengatur status menu tersedia/tidak tersedia
- Melihat semua transaksi
- Melihat semua laporan
- Melihat semua status order
- Melihat order pending
- Melihat order processing
- Melihat order completed
- Melihat order cancelled
- Mengubah pengaturan cafe

---

## Admin

Admin membantu owner mengelola operasional aplikasi.

Admin bisa:

- Melihat dashboard admin
- Mengelola kategori menu
- Menambah kategori menu
- Mengedit kategori menu
- Menghapus/nonaktifkan kategori menu
- Mengelola menu
- Menambah menu
- Mengedit menu
- Menghapus/nonaktifkan menu
- Mengatur status menu tersedia/tidak tersedia
- Mengelola kasir
- Melihat semua transaksi
- Melihat laporan penjualan
- Melihat semua order
- Mengubah status order

---

## Kasir

Kasir fokus pada transaksi dan proses pesanan.

Kasir bisa:

- Membuka halaman POS kasir
- Melihat daftar menu dalam bentuk card
- Filter menu berdasarkan kategori
- Memilih menu untuk transaksi
- Mengatur qty menu yang akan dipesan
- Menambahkan catatan item pesanan
- Membuat transaksi
- Mencetak struk
- Melihat riwayat transaksi sendiri
- Melihat daftar order
- Mengubah status order dari pending ke processing
- Mengubah status order dari processing ke completed

Kasir tidak bisa:

- Menambah kategori menu
- Mengedit kategori menu
- Menghapus kategori menu
- Menambah menu
- Mengedit menu
- Menghapus menu
- Mengelola user
- Melihat laporan owner
- Menghapus transaksi

---

## 5. Fitur Manajemen Kategori Menu

Kategori menu digunakan untuk mengelompokkan hidangan cafe.

Contoh kategori:

- Coffee
- Non Coffee
- Snack
- Main Course
- Dessert

Fitur:

- Admin dan owner bisa menambah kategori menu.
- Admin dan owner bisa mengedit kategori menu.
- Admin dan owner bisa menghapus/nonaktifkan kategori menu.
- Kasir tidak bisa mengelola kategori menu.
- Kategori digunakan untuk filter menu di halaman POS.
- Kategori yang nonaktif tidak ditampilkan di filter POS.
- Kategori memiliki status aktif/nonaktif.
- Kategori memiliki nama dan deskripsi.
- Kategori membantu kasir menemukan menu lebih cepat.

Field utama:

- name
- description
- is_active

Batasan:

- Kasir tidak boleh mengakses halaman kategori menu.
- Kategori tidak aktif tidak boleh tampil di halaman POS.
- Kategori yang masih dipakai menu sebaiknya tidak dihapus permanen.

---

## 6. Fitur Manajemen Menu

Menu adalah hidangan yang dijual di cafe.

Fitur:

- Admin dan owner bisa menambah menu.
- Admin dan owner bisa mengedit menu.
- Admin dan owner bisa menghapus/nonaktifkan menu.
- Admin dan owner bisa mengatur status menu tersedia/tidak tersedia.
- Setiap menu wajib memiliki kategori.
- Setiap menu bisa memiliki gambar.
- Menu yang tidak tersedia tidak muncul di halaman POS.
- Menu yang tidak tersedia tetap muncul di halaman manajemen menu.
- Kasir tidak bisa mengelola menu.

Field utama:

- menu_category_id
- name
- price
- image
- description
- is_available

Batasan:

- Produk harus disebut Menu, bukan Product.
- Menu tanpa kategori tidak boleh dibuat.
- Kasir tidak boleh menambah menu.
- Kasir tidak boleh mengedit menu.
- Kasir tidak boleh menghapus menu.
- Tidak ada stok menu.
- Tidak ada bahan baku menu.
- Tidak ada komposisi resep.

---

## 7. Fitur Transaksi POS dengan Livewire

Halaman transaksi POS adalah fitur utama aplikasi.

Fitur:

- Menggunakan Livewire agar keranjang responsif.
- Kasir bisa memilih menu tanpa reload halaman.
- Kasir bisa menambahkan menu ke keranjang.
- Kasir bisa mengubah qty menu tanpa reload.
- Kasir bisa menghapus menu dari keranjang tanpa reload.
- Kasir bisa menambahkan catatan pada item pesanan.
- Kasir bisa memilih tipe pesanan dine in atau takeaway.
- Kasir bisa mengisi nomor meja untuk dine in.
- Kasir bisa mengisi nama pelanggan opsional.
- Kasir bisa memilih metode pembayaran cash atau qris.
- Sistem menghitung subtotal otomatis.
- Sistem menghitung grand total otomatis.
- Sistem menghitung kembalian otomatis untuk cash.
- Sistem menyimpan transaksi dan item transaksi.
- Sistem membuat invoice_number.

Aturan transaksi:

- Subtotal dihitung dari total item.
- Grand total sama dengan subtotal.
- Tidak ada input diskon.
- Tidak ada input pajak.
- Tidak ada input service charge.
- Payment method hanya cash dan qris.
- Jika cash, uang bayar diinput melalui paid_amount.
- Jika cash, kembalian dihitung dari paid_amount - grand_total.
- Jika qris, paid_amount otomatis sama dengan grand_total.
- Jika qris, change_amount bernilai 0.
- QRIS hanya dicatat sebagai metode pembayaran manual.
- Tidak ada payment gateway.

---

## 8. Fitur Halaman POS Card Menu

Halaman POS wajib menggunakan tampilan card grid.

Setiap card menu menampilkan:

- Gambar menu
- Nama menu
- Harga menu
- Tombol tambah ke keranjang
- Qty pesanan jika menu sudah masuk keranjang

Fitur card menu:

- Card responsif untuk desktop dan mobile.
- Card mudah diklik oleh kasir.
- Gambar menu membantu kasir mengenali hidangan.
- Qty tampil langsung jika menu sudah masuk cart.
- Menu bisa ditambahkan ke cart tanpa reload.
- Menu yang tidak tersedia tidak tampil di POS.

---

## 9. Fitur Pagination Menu

Daftar menu di halaman POS wajib menggunakan pagination.

Fitur:

- Pagination menggunakan Livewire.
- Pagination tetap berjalan saat filter kategori aktif.
- Pagination membantu halaman POS tetap ringan.
- Jumlah menu per halaman bisa disesuaikan.
- Cocok untuk cafe dengan banyak menu.

Contoh jumlah item per halaman:

- 8 menu
- 12 menu
- 16 menu

---

## 10. Fitur Filter Menu Berdasarkan Kategori

Filter kategori wajib ada di halaman POS.

Fitur:

- Kasir bisa filter menu berdasarkan kategori.
- Filter kategori mengambil data dari menu_categories.
- Hanya kategori aktif yang tampil di filter.
- Kategori nonaktif tidak tampil di filter.
- Filter berjalan tanpa reload halaman menggunakan Livewire.
- Jika kategori dipilih, hanya menu dari kategori tersebut yang tampil.
- Jika filter dikosongkan, semua menu tersedia tampil.

Batasan:

- Kategori tidak aktif tidak boleh muncul.
- Menu tidak tersedia tidak boleh muncul.
- Kasir hanya bisa memakai filter, bukan mengelola kategori.

---

## 11. Fitur Status Order

Status order digunakan untuk melihat proses pesanan cafe.

Status yang digunakan:

- pending
- processing
- completed
- cancelled

Penjelasan:

- pending: order baru dibuat dan belum diproses.
- processing: order sedang dibuat/disiapkan.
- completed: order sudah selesai.
- cancelled: order dibatalkan.

Fitur:

- Halaman daftar order.
- Filter berdasarkan status order.
- Filter berdasarkan tanggal.
- Filter berdasarkan kasir.
- Tombol ubah status dari pending ke processing.
- Tombol ubah status dari processing ke completed.
- Tombol cancel order jika diperlukan.
- Tampilan badge status order.
- Akses status order berdasarkan role.
- Boleh menggunakan Livewire untuk update status tanpa reload halaman.

Akses:

- Owner bisa melihat semua order.
- Admin bisa melihat semua order.
- Kasir bisa melihat daftar order.
- Kasir bisa memproses order dari pending ke processing.
- Kasir bisa menyelesaikan order dari processing ke completed.

Batasan:

- Fitur ini bukan Kitchen Display System kompleks.
- Untuk MVP cukup halaman daftar order dengan tombol ubah status.
- Tidak perlu tampilan dapur/barista real-time yang kompleks.

---

## 12. Fitur Laporan

Laporan digunakan untuk melihat performa penjualan cafe.

Fitur laporan:

- Laporan harian
- Laporan bulanan
- Total transaksi
- Total omzet
- Menu terlaris
- Metode pembayaran cash/qris
- Filter tanggal
- Filter kasir
- Filter tipe pesanan
- Filter status transaksi
- Tidak ada filter cabang

Data yang dihitung:

- Jumlah transaksi paid
- Total omzet dari transaksi paid
- Menu paling banyak terjual
- Total transaksi cash
- Total transaksi qris
- Total dine in
- Total takeaway

Batasan:

- Transaksi cancelled tidak dihitung sebagai omzet.
- Tidak ada laporan stok.
- Tidak ada laporan bahan baku.
- Tidak ada laporan supplier.
- Tidak ada laporan cabang.

---

## 13. Fitur Struk

Struk digunakan sebagai bukti transaksi pelanggan.

Fitur struk:

- Cetak struk dari detail transaksi.
- Tampilkan nama cafe.
- Tampilkan alamat cafe.
- Tampilkan nomor telepon cafe jika ada.
- Tampilkan invoice_number.
- Tampilkan tanggal transaksi.
- Tampilkan nama kasir.
- Tampilkan order_type.
- Tampilkan nomor meja jika dine in.
- Tampilkan nama pelanggan jika ada.
- Tampilkan daftar item.
- Tampilkan qty item.
- Tampilkan harga item.
- Tampilkan subtotal item.
- Tampilkan subtotal transaksi.
- Tampilkan grand total.
- Tampilkan metode pembayaran.
- Tampilkan paid_amount.
- Tampilkan change_amount.
- Tampilkan footer struk.

Batasan:

- Struk sederhana untuk MVP.
- Tidak perlu integrasi printer thermal otomatis di awal.
- Cetak bisa menggunakan fitur print browser.

---

## 14. Detail Batasan Aplikasi Cafe Tanpa Inventori

Aplikasi ini tidak memiliki fitur inventori.

Tidak ada:

- Stok barang
- Stok menu
- Stok bahan baku
- Supplier
- Pembelian bahan baku
- Stock movement
- Stok opname
- Warehouse
- Raw material
- Komposisi resep
- Tracking bahan baku

Dampaknya:

- Transaksi tidak mengurangi stok.
- Menu hanya memiliki status tersedia/tidak tersedia.
- Jika menu habis, admin atau owner cukup mengubah `is_available` menjadi false.
- Sistem tidak menghitung sisa bahan baku.

---

## 15. Detail Batasan Aplikasi Tanpa Multi Cabang

Aplikasi ini hanya untuk 1 outlet.

Tidak ada:

- Branch
- Outlet management
- Cabang
- branch_id
- Laporan per cabang
- User per cabang
- Menu per cabang
- Transaksi per cabang

Dampaknya:

- Semua transaksi dianggap milik outlet yang sama.
- Settings cafe hanya untuk satu cafe.
- Tidak perlu filter cabang di laporan.
- Tidak perlu tabel branches.

---

## 16. Detail Batasan Tanpa Diskon, Pajak, dan Service Charge

Aplikasi ini tidak menggunakan:

- Diskon
- Pajak
- Service charge

Dampaknya:

- Tidak ada input discount.
- Tidak ada input tax.
- Tidak ada input service charge.
- Tidak ada kolom discount di transactions.
- Tidak ada kolom tax di transactions.
- Tidak ada kolom service_charge di transactions.

Rumus transaksi:

```text
subtotal = total seluruh item
grand_total = subtotal
change_amount = paid_amount - grand_total
```

---

## 17. Detail Batasan Metode Pembayaran

Metode pembayaran hanya:

- cash
- qris

### Cash

- Kasir memasukkan paid_amount.
- Sistem menghitung change_amount.
- paid_amount harus lebih besar atau sama dengan grand_total.

### QRIS

- QRIS dicatat manual sebagai metode pembayaran.
- paid_amount otomatis sama dengan grand_total.
- change_amount bernilai 0.
- Tidak ada payment gateway.
- Tidak ada validasi pembayaran otomatis.
- Tidak ada integrasi QRIS otomatis.

Metode pembayaran yang tidak dibuat:

- Debit
- Credit card
- Transfer bank
- E-wallet
- Payment gateway
- Midtrans
- Xendit
- Stripe
- PayPal

---

## 18. Kesimpulan Scope MVP

Aplikasi POS Kasir Cafe ini fokus pada:

- Transaksi cepat
- Menu cafe
- Kategori menu
- POS card grid
- Keranjang Livewire
- Pembayaran cash/qris
- Cetak struk
- Status order sederhana
- Laporan penjualan dasar

Aplikasi ini tidak boleh melebar menjadi:

- Sistem inventori
- Sistem multi cabang
- Sistem pembayaran online
- Sistem kitchen display kompleks
- Sistem akuntansi lengkap
