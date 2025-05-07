<?php
include "koneksi.php";
$tampilproduk = "SELECT * FROM produk";
$produktampil = mysqli_query($koneksi, $tampilproduk);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/produk.css">
</head>

<body>
    
<div class="navbar">
  <div class="nav-container">
    <div class="brand">Point of Sales</div>
    <div class="nav-links">
      <a href="home.php">Beranda</a>
      <a href="transaksi.php">Transaksi</a>
      <a href="produk.php" class="active">Produk</a>
      <a href="laporan_harian.php">Laporan Harian</a>
      <a href="laporan_bulanan.php">Laporan Bulanan</a>
      <a href="companyprofile.php">Profil</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>
</div>
    <div class="container-home">
        <div class="daftar_produk">
            <h3 class="judulproduk">Daftar Produk</h3>

            <table border="1">
                <thead>
                    <tr>
                        <th>ID Produk</th>
                        <th>Nama Produk</th>
                        <th>Harga(Pcs)</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php while ($tampil = mysqli_fetch_assoc($produktampil)) { ?>
                            <td><?= $tampil['id_produk']; ?></td>
                            <td><?= $tampil['nama_produk']; ?></td>
                            <td><?= $tampil['harga']; ?></td>
                            <td><?= $tampil['stok']; ?></td>

                    </tr>
                </tbody>
            <?php } ?>
            </table>
        </div>
        <button class="addproduk" onclick='window.location.href="./addproduk.php"'>Add Produk +</button>
</body>

</html>