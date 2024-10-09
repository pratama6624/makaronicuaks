# Alur Otentikasi (Auth Flow)

## 1. Overview
Sistem otentikasi ini diwajibkan bagi user yang ingin melakukan transaksi seperti memesan makanan. User harus **mendaftar** sebelum dapat melakukan pemesanan, dan harus **login** untuk mengakses fitur seperti manajemen pesanan. Proses pendaftaran dan login mencakup berbagai validasi untuk memastikan keamanan user dan integritas sistem.

---

## 2. Alur Pendaftaran

### Proses
1. **Pengisian Formulir Pendaftaran**:
   - User mengakses halaman pendaftaran dan mengisi informasi yang dibutuhkan.
   
2. **Field yang Wajib Diisi**:
   - `nama`: Nama lengkap user.
   - `email`: Email yang unik dan akan digunakan untuk login.
   - `nomor_telepon`: Nomor telepon yang unik untuk keperluan pemulihan akun dan komunikasi.
   - `password`: Harus memenuhi standar keamanan minimum.
   - `konfirmasi_password`: User harus mengonfirmasi password.

3. **Validasi yang Dilakukan**:
   - **Email Unik**: Sistem memeriksa apakah email sudah terdaftar sebelumnya.
   - **Nomor Telepon Unik**: Memastikan bahwa nomor telepon belum digunakan oleh user lain.
   - **Keamanan Password**: 
     - Password harus memiliki minimal 8 karakter.
     - Terdapat kombinasi huruf, angka, dan karakter khusus untuk meningkatkan keamanan.
   - **Konfirmasi Password**: Password dan konfirmasi password harus sesuai.

4. **Verifikasi SMTP**:
   - Setelah pendaftaran berhasil, sistem akan mengirimkan email verifikasi ke email user menggunakan **SMTP**.
   - User harus mengklik link verifikasi yang dikirimkan melalui email untuk mengaktifkan akun.
   - Proses ini memastikan bahwa email yang digunakan adalah valid dan membantu menghindari spam atau akun palsu.

5. **Aktivasi Akun**:
   - User tidak dapat login sebelum akun diverifikasi melalui email.
   - Setelah verifikasi email berhasil, akun user diaktifkan, dan user bisa login ke sistem.

---

## 3. Alur Login

### Proses
1. **Pengisian Formulir Login**:
   - User mengakses halaman login dan mengisi email serta password.

2. **Field yang Wajib Diisi**:
   - `email`: Email yang terdaftar dan telah diverifikasi.
   - `password`: Password yang sesuai dengan akun user.

3. **Validasi yang Dilakukan**:
   - **Validasi Email**: Sistem memeriksa apakah email terdaftar dan sudah diverifikasi.
   - **Validasi Password**: Password diperiksa apakah sesuai dengan hash yang disimpan di database.
   
4. **Login Berhasil**:
   - Jika email dan password benar, serta akun telah diverifikasi, user akan berhasil login ke sistem.

5. **Login Gagal**:
   - Jika email atau password salah, akan muncul pesan kesalahan.
   - Jika email belum diverifikasi, user akan diminta untuk memverifikasi email terlebih dahulu.

---

## 4. Keamanan dengan Soft Delete

### Soft Delete pada Backend
- **Soft Delete** digunakan di sistem untuk menghindari kehilangan data yang tidak disengaja atau karena pelanggaran kebijakan. Ketika akun user dihapus, datanya tidak akan benar-benar hilang dari database. Sebaliknya, akun tersebut akan memiliki status **nonaktif** sementara, sehingga dapat diaktifkan kembali di kemudian hari.
- **Field Status Nonaktif**: Sebuah field khusus disimpan di database yang akan menandai apakah akun user aktif atau nonaktif.
- Data tetap terjaga dan bisa diaktifkan kembali oleh admin saat diperlukan.

---

## 5. Pemulihan Akun

### Pemulihan Akun untuk User yang Terhapus
1. **User Terhapus Mencoba Login**:
   - Jika user mencoba login dengan akun yang telah dihapus, user akan diarahkan ke halaman pemulihan akun.
   
2. **User Terhapus Mencoba Mendaftar Ulang**:
   - Jika user mencoba mendaftar ulang dengan email atau nomor telepon yang sama, sistem akan mengarahkan user untuk melakukan pemulihan akun alih-alih membuat akun baru, guna menghindari duplikasi data.

3. **Proses Pemulihan Akun**:
   - User akan mengirim permintaan pemulihan akun melalui halaman pemulihan.
   - Permintaan tersebut akan dikirim ke admin melalui dua metode:
     - **Halaman Admin**: Permintaan ditampilkan di halaman pemulihan akun admin.
     - **WhatsApp**: Notifikasi otomatis dikirim ke admin melalui **API Twilio** untuk memastikan admin segera merespons.
   - Proses pemulihan akan dipercepat dengan notifikasi ganda ini, memungkinkan admin segera menyetujui atau menolak permintaan.

### Opsi Pemulihan
- **Menggunakan Password Lama**: Jika user masih mengingat password lamanya, user bisa menggunakan password tersebut untuk memulihkan akun.
- **Link Reset Password**: Jika user tidak mengingat password, user bisa meminta link reset password yang akan dikirim melalui email setelah admin menyetujui permintaan pemulihan akun.

---

## 6. Validasi dan Pesan Kesalahan

### Kesalahan Saat Mendaftar
- **Email Duplikat**: "Email yang Anda masukkan sudah terdaftar. Silakan gunakan email lain."
- **Nomor Telepon Duplikat**: "Nomor telepon yang Anda masukkan sudah terdaftar. Silakan gunakan nomor lain."
- **Konfirmasi Password Salah**: "Password dan konfirmasi password tidak cocok."
- **Password Lemah**: "Password harus memiliki minimal 8 karakter dan mengandung huruf, angka, dan karakter khusus."

### Kesalahan Saat Login
- **Email atau Password Salah**: "Email atau password yang Anda masukkan salah."
- **Email Belum Diverifikasi**: "Akun Anda belum diverifikasi. Silakan periksa email Anda untuk memverifikasi akun."