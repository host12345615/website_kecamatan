<?php
$conn = mysqli_connect("localhost","DB_USER","DB_PASSWORD","arsip_kabaena");
session_start();

# counter pengunjung
mysqli_query($conn,"UPDATE counter SET jumlah=jumlah+1 WHERE id=1");
$dataCounter = mysqli_fetch_assoc(mysqli_query($conn,"SELECT jumlah FROM counter WHERE id=1"));
?>

<!DOCTYPE html>
<html>
<head>
<title>Arsip Digital Kec. Kabaena Barat</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>

body{
background:#f5f5f5;
}

.header{
background:#004080;
color:white;
padding:15px;
}

.footer{
background:#222;
color:white;
padding:10px;
text-align:center;
}

.logo{
height:70px;
}

</style>

</head>

<body>

<div class="header">
<div class="container d-flex align-items-center">
<img src="https://upload.wikimedia.org/wikipedia/commons/3/34/Lambang_Kabupaten_Bombana.png" class="logo me-3">
<h3>Arsip Digital Kec. Kabaena Barat</h3>
</div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container">

<button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="menu">
<ul class="navbar-nav">
<li class="nav-item"><a class="nav-link" href="?page=beranda">Beranda</a></li>
<li class="nav-item"><a class="nav-link" href="?page=data">Data</a></li>
<li class="nav-item"><a class="nav-link" href="?page=galeri">Galeri</a></li>
<li class="nav-item"><a class="nav-link" href="?page=about">About Us</a></li>
</ul>
</div>

</div>
</nav>

<div class="container mt-4">

<?php
$page = $_GET['page'] ?? 'beranda';

if($page=="beranda"){
?>

<img src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=800"
class="img-fluid rounded">

<h4 class="mt-3">Selamat Datang</h4>
<p>Website Arsip Digital Kecamatan Kabaena Barat digunakan untuk pengelolaan arsip digital masyarakat secara online.</p>

<?php
}

elseif($page=="data"){
?>

<h4>Input Data Arsip</h4>

<form method="POST" enctype="multipart/form-data">

<input class="form-control mb-2" name="nama" placeholder="Nama Pengirim" required>

<textarea class="form-control mb-2" name="alamat" placeholder="Alamat" required></textarea>

<textarea class="form-control mb-2" name="ket" placeholder="Keterangan" required></textarea>

<input type="file" class="form-control mb-2" name="file" required>

<button class="btn btn-primary" name="upload">Kirim Data</button>

</form>

<hr>

<?php

if(isset($_POST['upload'])){

$nama=$_POST['nama'];
$alamat=$_POST['alamat'];
$ket=$_POST['ket'];

$file=$_FILES['file']['name'];
$tmp=$_FILES['file']['tmp_name'];

move_uploaded_file($tmp,"upload/".$file);

mysqli_query($conn,"INSERT INTO data_arsip
(nama_pengirim,alamat,keterangan,file_upload)
VALUES('$nama','$alamat','$ket','$file')");

mysqli_query($conn,"INSERT INTO galeri(gambar) VALUES('$file')");

echo "<div class='alert alert-success'>Data berhasil dikirim</div>";

}

?>

<h4>Data Arsip</h4>

<table class="table table-bordered">

<tr>
<th>Nama</th>
<th>Alamat</th>
<th>Keterangan</th>
<th>File</th>
</tr>

<?php

$data=mysqli_query($conn,"SELECT * FROM data_arsip");

while($d=mysqli_fetch_array($data)){

echo "
<tr>
<td>$d[nama_pengirim]</td>
<td>$d[alamat]</td>
<td>$d[keterangan]</td>
<td><a href='upload/$d[file_upload]' target='_blank'>Download</a></td>
</tr>
";

}

?>

</table>

<?php
}

elseif($page=="galeri"){
?>

<h4>Galeri Upload Pengunjung</h4>

<div class="row">

<?php

$galeri=mysqli_query($conn,"SELECT * FROM galeri");

while($g=mysqli_fetch_array($galeri)){

echo "
<div class='col-md-3 mb-3'>
<img src='upload/$g[gambar]' class='img-fluid rounded'>
</div>
";

}

?>

</div>

<?php
}

elseif($page=="about"){
?>

<h4>About Us</h4>

<p>Website Arsip Digital Kecamatan Kabaena Barat Kabupaten Bombana.</p>

<h5>Media Sosial</h5>

<ul>
<li>WhatsApp</li>
<li>Email</li>
<li>Instagram</li>
<li>Facebook</li>
<li>Twitter</li>
</ul>

<h5>Lokasi</h5>

<iframe
src="https://maps.google.com/maps?q=kabaena%20barat%20bombana&t=&z=13&ie=UTF8&iwloc=&output=embed"
width="100%" height="300"></iframe>

<?php
}
?>

</div>

<div class="footer mt-4">
Jumlah Pengunjung : <?php echo $dataCounter['jumlah']; ?>
<br>
Desain By Admin hostdesa.blogspot.com
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
