<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit();
}

$laporan = "SELECT * FROM laporan_harian";
$perintahlaporan = mysqli_query($koneksi, $laporan);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Harian</title>
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/laporan.css">
</head>
<body>
<div class="navbar">
  <div class="nav-container">
    <div class="brand">Point of Sales</div>
    <div class="nav-links">
      <a href="home.php">Beranda</a>
      <a href="transaksi.php">Transaksi</a>
      <a href="produk.php">Produk</a>
      <a href="laporan_harian.php" class="active">Laporan Harian</a>
      <a href="laporan_bulanan.php">Laporan Bulanan</a>
      <a href="companyprofile.php">Profil</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>
</div>
    <div class="laporanharian">
        <h3 class="judulharian">Laporan Harian</h3>
        <table border="1">
            <thead>
                <tr>
                    <th>ID Laporan Harian</th>
                    <th>Total Penjualan</th>
                    <th>Tanggal Penjualan</th>
                    <th>Nama Kasir</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php while ($tampilkanlaporan = mysqli_fetch_assoc($perintahlaporan)) { ?>
                        <td><?= $tampilkanlaporan['id_laporan_harian']; ?></td>
                        <td>Rp. <?= $tampilkanlaporan['total_penjualan']; ?></td>
                        <td><?= $tampilkanlaporan['tanggal_penjualan']; ?></td>
                        <td><?= $tampilkanlaporan['nama_kasir']; ?></td>
                </tr>
            </tbody>
        <?php } ?>
        </table>

        <button onclick='window.location.href="./struklaporanharian.php"'>Cetak Laporan Harian</button>
        <?php
        $subtotal = "SELECT SUM(total_penjualan) AS total FROM laporan_harian";
        $perintahsub = mysqli_query($koneksi, $subtotal);
        $mintasub = mysqli_fetch_assoc($perintahsub);

        ?>
        <!-- SubTotal Harga -->
        <p>Subtotal: Rp. <?= number_format($mintasub['total'], 0, 2) ?></p>
        <?php
        if (isset($_POST['inputlaporanbulanan'])) {
            $insertlap = "INSERT INTO laporan_bulanan (nama_kasir, bulan_penjualan, total_penjualan) VALUES ('$_POST[nama_kasir]', '$_POST[tanggal_penjualan]', '$mintasub[total]')";
            $perintahlap = mysqli_query($koneksi, $insertlap);
        }
        ?>
        <div class="laporan_bulanan"></div>
        <h3 class="judulbulan">Laporan Bulanan</h3>
        <form action="" method="post">
            <input type="text" name="nama_kasir" placeholder="Nama Kasir">
            <input type="date" name="tanggal_penjualan"><br>
            <button type="submit" name="inputlaporanbulanan">Input Laporan</button>
        </form>
    </div>
</body>

</html>