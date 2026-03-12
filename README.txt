
PETUNJUK INSTALASI WEBSITE

1. Upload semua file ke folder public_html hosting Anda.
2. Buat database MySQL dengan nama: arsip_kabaena
3. Import file database.sql melalui phpMyAdmin.
4. Edit file index.php dan ubah bagian koneksi database:

$conn = mysqli_connect("localhost","DB_USER","DB_PASSWORD","arsip_kabaena");

Ganti DB_USER dan DB_PASSWORD sesuai database hosting Anda.

5. Pastikan folder 'upload' memiliki permission 755 atau 777.

Website siap digunakan.
