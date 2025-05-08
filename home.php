<?php  
include 'koneksi.php';
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit();
}

$produk = "SELECT COUNT(*) AS jumlah_barang FROM produk";
$queryproduk = mysqli_query($koneksi, $produk);

$laporanbulanan = "SELECT * FROM laporan_bulanan";
$perintahlaporan = mysqli_query($koneksi, $laporanbulanan);

$laporanharian = "SELECT * FROM laporan_harian";
$perintahlaporan = mysqli_query($koneksi, $laporanharian);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/navbar.css">   
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/transaksi.php">
</head>
<body>
<div class="navbar">
  <div class="nav-container">
    <div class="brand">Point of Sales</div>
    <div class="nav-links">
      <a href="home.php" class="active">Beranda</a>
      <a href="transaksi.php">Transaksi</a>
      <a href="produk.php">Produk</a>
      <a href="laporan_harian.php">Laporan Harian</a>
      <a href="laporan_bulanan.php">Laporan Bulanan</a>
      <a href="companyprofile.php">Profil</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>
</div>

    <div class="data">
    <div class="card">
        <h4><a href="./produk.php">Produk</a></h4>
        <?php 
        $produk = "SELECT COUNT(*) AS jumlah_barang FROM produk";
        $queryproduk = mysqli_query($koneksi, $produk); 
        $minta = mysqli_fetch_assoc($queryproduk);
        ?>
        <p>Jumlah Produk: <?= $minta['jumlah_barang'] ?></p> 
    </div>

    <div class="card">
        <h4><a href="./laporan_harian.php">Laporan Harian</a></h4>
        <?php 
         $harian= "SELECT COUNT(*) AS jumlah_harian FROM laporan_harian";
         $queryharian = mysqli_query($koneksi, $harian); 
         $mintaharian = mysqli_fetch_assoc($queryharian);
        ?>
        <p>Jumlah Laporan Harian: <?= $mintaharian['jumlah_harian']?></p>
    </div>

    <div class="card">
        <h4><a href="./laporan_bulanan.php">Laporan Bulanan</a></h4>
        <?php 
         $bulanan = "SELECT COUNT(*) AS jumlah_bulanan FROM laporan_bulanan";
         $querybulanan = mysqli_query($koneksi, $bulanan); 
         $mintabulanan = mysqli_fetch_assoc($querybulanan);
        ?>
        <p>Jumlah Laporan Bulanan: <?= $mintabulanan['jumlah_bulanan']?></p>
    </div>
</div>


</body>
</html>