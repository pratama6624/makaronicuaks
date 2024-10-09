# Dokumentasi API

## 1. SMTP Mail

### Deskripsi
SMTP Mail digunakan untuk berbagai keperluan otentikasi, verifikasi, dan keamanan tambahan pada sistem. Ini mencakup:
- Verifikasi akun user saat pendaftaran.
- Mengirimkan kode konfirmasi untuk aktivasi akun.
- Memastikan email yang digunakan oleh user adalah asli untuk mencegah akun palsu atau spam.
- Digunakan juga untuk proses **pemulihan akun** pada saat penerapan soft delete di backend, di mana user perlu memverifikasi email untuk memulihkan akses akun yang telah di-nonaktifkan.

### Penggunaan API
SMTP Mail API akan dikonfigurasi untuk:
- **Pendaftaran**: Mengirimkan email verifikasi setelah user mendaftar.
- **Pemulihan Akun**: Mengirimkan link atau kode untuk memulihkan akun yang terhapus sementara.
- **Keamanan Tambahan**: Mengirimkan email terkait notifikasi keamanan, seperti perubahan password atau aktivitas mencurigakan.

---

## 2. Twilio API

### Deskripsi
Twilio akan digunakan untuk menghubungkan sistem dengan WhatsApp, dengan tujuan mempercepat proses notifikasi yang membutuhkan respon cepat, seperti:
- Mengirim notifikasi kepada admin saat ada permintaan pemulihan akun dari user, untuk mempercepat penanganan.
- Mengirim pesan kepada user terkait informasi penting seperti **menu baru**, **diskon**, atau **penawaran khusus**.

### Penggunaan API
Twilio API akan diimplementasikan untuk:
- **Pemulihan Akun**: Mengirimkan notifikasi WhatsApp ke admin agar segera memproses permintaan pemulihan akun.
- **Informasi Pengguna**: Mengirimkan pesan kepada user mengenai promo, penawaran khusus, atau pembaruan menu.

#### Contoh Notifikasi
- **Ke Admin**: "User [nama] telah meminta pemulihan akun. Silakan periksa permintaan pemulihan di sistem."
- **Ke User**: "Selamat! Kami memiliki diskon 20% untuk semua menu hari ini. Segera pesan sekarang!"

---

## 3. Midtrans API

### Deskripsi
Midtrans akan digunakan sebagai **payment gateway** untuk menyediakan layanan pembayaran yang lebih sederhana, aman, dan nyaman bagi user. Ini akan memudahkan user dalam melakukan transaksi pembayaran ketika memesan makanan di sistem.

### Penggunaan API
Midtrans API akan digunakan untuk:
- **Transaksi Pembayaran**: Mengelola seluruh proses pembayaran dari user saat mereka melakukan pemesanan di sistem.
- **Konfirmasi Pembayaran**: Menyediakan notifikasi otomatis setelah pembayaran berhasil.
- **Keamanan Pembayaran**: Memastikan semua transaksi berjalan dengan aman dan sesuai standar industri.

#### Fitur Utama
- Mendukung berbagai metode pembayaran (kartu kredit, bank transfer, e-wallet).
- Notifikasi real-time untuk status pembayaran (sukses, pending, gagal).
  
---

## 4. Raja Ongkir API

### Deskripsi
Raja Ongkir digunakan untuk mengelola **pengiriman barang/paket** ke user. Ini termasuk penghitungan ongkos kirim, pilihan kurir, dan melacak pengiriman secara real-time.

### Penggunaan API
Raja Ongkir API akan diimplementasikan untuk:
- **Penghitungan Ongkos Kirim**: Menghitung biaya pengiriman berdasarkan jarak dan lokasi user.
- **Pemilihan Kurir**: Menyediakan berbagai pilihan kurir pengiriman (JNE, TIKI, Pos Indonesia, dll).
- **Pelacakan Pengiriman**: Memberikan nomor resi dan melacak status pengiriman pesanan user.

#### Contoh Alur
1. User melakukan pemesanan.
2. Sistem menghitung biaya pengiriman berdasarkan lokasi user.
3. User memilih kurir yang diinginkan.
4. Setelah pengiriman dilakukan, user dapat melacak status pengirimannya menggunakan nomor resi.

---

## 5. Google Maps API

### Deskripsi
Google Maps API digunakan untuk menampilkan denah lokasi atau petunjuk arah ke **toko offline** atau outlet. Ini memudahkan user dalam menemukan lokasi fisik toko jika mereka ingin melakukan kunjungan langsung.

### Penggunaan API
Google Maps API akan digunakan untuk:
- **Menampilkan Lokasi Toko**: Menampilkan peta dengan lokasi toko yang bisa diakses oleh user.
- **Petunjuk Arah**: Memberikan arahan ke user untuk mencapai lokasi toko atau outlet.
- **Integrasi Layanan Lokasi**: Bisa digunakan untuk fitur pencarian lokasi berdasarkan jarak user dengan toko.

#### Contoh Implementasi
- Pada halaman kontak atau lokasi, user dapat melihat peta interaktif yang menunjukkan posisi toko.
- User dapat memasukkan alamat mereka untuk mendapatkan arah menuju lokasi toko yang terdekat.

---

## 6. Alur Integrasi API

1. **Pendaftaran & Verifikasi Akun (SMTP Mail)**:
   - User mendaftar → Sistem mengirim email verifikasi melalui SMTP → User verifikasi akun.
   
2. **Proses Transaksi (Midtrans)**:
   - User memesan makanan → Sistem menghitung total pembayaran → User melakukan pembayaran via Midtrans → Notifikasi dikirim ke user saat pembayaran berhasil.

3. **Pengiriman Pesanan (Raja Ongkir)**:
   - Sistem menghitung ongkos kirim berdasarkan alamat user → User memilih kurir pengiriman → Pengiriman dilakukan dan user dapat melacak paket melalui Raja Ongkir.

4. **Pemulihan Akun & Notifikasi (Twilio)**:
   - User meminta pemulihan akun → Notifikasi dikirim ke admin melalui WhatsApp via Twilio → Admin memproses pemulihan akun.

5. **Petunjuk Lokasi (Google Maps)**:
   - Sistem menampilkan denah lokasi toko pada halaman khusus menggunakan Google Maps → User dapat mendapatkan petunjuk arah dari lokasi mereka ke toko.
