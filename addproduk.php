<?php 
include 'koneksi.php';
if (isset($_POST['inputproduk'])) {
    # code...
    $input = "INSERT INTO produk (id_produk, nama_produk, harga, stok) VALUES ('$_POST[id_produk]', '$_POST[nama_produk]', '$_POST[harga]', '$_POST[stok]')";
    $queryinput = mysqli_query($koneksi, $input);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Produk</title>
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/addproduk.css">
    <link rel="stylesheet" href="css/produk.css">
</head>
<body>

<div class="navbar">
  <div class="nav-container">
    <div class="brand">Point of Sales</div>
    <div class="nav-links">
      <a href="home.php">Beranda</a>
      <a href="transaksi.php">Transaksi</a>
      <a href="produk.php">Produk</a>
      <a href="laporan_harian.php">Laporan Harian</a>
      <a href="laporan_bulanan.php">Laporan Bulanan</a>
      <a href="companyprofile.php">Profil</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>
</div>
    <div class="container">
    <form action="" method="post">
        <h3>Tambah Produk</h3>
        <input type="number" name="id_produk" placeholder="ID Produk">
        <input type="text" name="nama_produk" placeholder="Nama Produk">
        <input type="number" name="harga" placeholder="Harga">
        <input type="number" name="stok" placeholder="Stok">
        <button name="inputproduk">Tambah +</button>
    </form>
    </div>
</body>
</html>