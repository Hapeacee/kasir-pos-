<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit();
}

$laporan = "SELECT * FROM laporan_bulanan";
$perintahlaporan = mysqli_query($koneksi, $laporan);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Bulanan</title>
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/laporan.css">
</head>

<body>
<div class="navbar">
  <div class="nav-container">
    <div class="brand">Point of Sales</div>
    <div class="nav-links">
      <a href="home.php" >Beranda</a>
      <a href="transaksi.php">Transaksi</a>
      <a href="produk.php">Produk</a>
      <a href="laporan_harian.php">Laporan Harian</a>
      <a href="laporan_bulanan.php" class="active">Laporan Bulanan</a>
      <a href="companyprofile.php">Profil</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>
</div>
    <div class="laporanharian">
        <h3 class="judulbulan">Laporan Bulanan</h3>
        <table border="1">
            <thead>
                <tr>
                    <th>ID Laporan Bulanan</th>
                    <th>Total Penjualan</th>
                    <th>Tanggal Penjualan</th>
                    <th>Nama Kasir</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php while ($tampilkanlaporan = mysqli_fetch_assoc($perintahlaporan)) { ?>
                        <td><?= $tampilkanlaporan['id_laporan_bulanan']; ?></td>
                        <td><?= $tampilkanlaporan['total_penjualan']; ?></td>
                        <td><?= $tampilkanlaporan['bulan_penjualan']; ?></td>
                        <td><?= $tampilkanlaporan['nama_kasir']; ?></td>
                </tr>
            </tbody>


        <?php } ?>

        </table>
<?php 
$subtotal = "SELECT SUM(total_penjualan) AS total FROM laporan_bulanan";
$perintahsub = mysqli_query($koneksi, $subtotal);
$mintasub = mysqli_fetch_assoc($perintahsub);
?>
<p>Subtotal: Rp. <?= number_format($mintasub['total'], 0, 2) ?></p>
        <button onclick='window.location.href="./struklaporanbulanan.php"'>Cetak Laporan Bulanan</button>
    </div>
</body>

</html>