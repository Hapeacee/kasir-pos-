<?php
include 'koneksi.php';

$profil = "SELECT * FROM akun";
$perintahprofil = mysqli_query($koneksi, $profil);

if (isset($_POST['edit'])) {
    # code...
    $edit = "UPDATE akun SET nama_kasir='$_POST[nama]', email='$_POST[email]', no_hp='$_POST[nohp]', alamat='$_POST[alamat]'";
    $editquery = mysqli_query($koneksi, $edit);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/profil.css">
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

    <form action="" method="post">
        <div class="container">
            <h3>Profil</h3>
            <?php while ($tampilprofil = mysqli_fetch_assoc($perintahprofil)) { ?>
                <input type="text" name="nama" value="<?= $tampilprofil['nama_kasir']; ?>">
                <input type="email" name="email" value="<?= $tampilprofil['email']; ?>">
                <input type="number" name="nohp" value="<?= $tampilprofil['no_hp']; ?>">
                <input type="text" name="alamat" value="<?= $tampilprofil['alamat']; ?>">
                <button type="submit" name="edit" placeholder="edit">Simpan</button>
            <?php } ?>
        </div>
    </form>
</body>

</html>