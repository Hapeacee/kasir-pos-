<?php
include 'koneksi.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['input'])) {
    $produk = "SELECT * FROM produk WHERE id_produk = '$_POST[id_produk]'";
    $perintahproduk = mysqli_query($koneksi, $produk);
    $mintaproduk = mysqli_fetch_assoc($perintahproduk);

    $harga = $mintaproduk['harga'] * $_POST['quantity'];
    $id_produk = $_POST['id_produk'];
    $quantity = $_POST['quantity'];
    $tanggal = date('Y-m-d'); // ambil otomatis hari ini
    $harga = $mintaproduk['harga'] * $quantity;
    
    $insert = "INSERT INTO penjualan (tanggal_penjualan, total_harga, id_produk, quantity)
               VALUES ('$tanggal', '$harga', '$id_produk', '$quantity')";    
    mysqli_query($koneksi, $insert);
}

$tampilan = "SELECT p.id_penjualan, p.tanggal_penjualan, p.quantity, p.total_harga, 
                    pr.nama_produk, pr.harga
             FROM penjualan p
             JOIN produk pr ON p.id_produk = pr.id_produk";
$tampilkanp = mysqli_query($koneksi, $tampilan);

//laporan harian
session_start();
$id_user = $_SESSION['id_user']; // Ambil user_id dari session login

$query_nama_kasir = "SELECT nama_kasir FROM akun WHERE id_user = '$id_user'";
$hasil_nama_kasir = mysqli_query($koneksi, $query_nama_kasir);

// Cek apakah query berhasil
if ($hasil_nama_kasir && mysqli_num_rows($hasil_nama_kasir) > 0) {
    $data_nama_kasir = mysqli_fetch_assoc($hasil_nama_kasir);
    $nama_kasir = $data_nama_kasir['nama_kasir']; // Ambil nama kasir
} else {
    echo "Nama kasir tidak ditemukan!";
    exit();
}

//itung total harga
$subtotal = "SELECT SUM(total_harga) AS total FROM penjualan";
$perintahsub = mysqli_query($koneksi, $subtotal);
$mintasub = mysqli_fetch_assoc($perintahsub);
$total_semua = $mintasub['total'] ?? 0;

$diskon = isset($_POST['diskon']) ? floatval($_POST['diskon']) : 0;
$total_setelah_diskon = $total_semua - $diskon;

$bayar = isset($_POST['bayar']) ? floatval($_POST['bayar']) : 0;
$kembalian = $bayar - $total_setelah_diskon;

// Validasi jika tombol bayar ditekan
if (isset($_POST['submit_bayar'])) {
    if (!is_numeric($_POST['bayar']) || $_POST['bayar'] === "") {
        echo "<script>alert('Silakan masukkan nominal pembayaran terlebih dahulu.');</script>";
    } elseif ($bayar < $total_setelah_diskon) {
        echo "<script>alert('Uang yang dibayarkan kurang!');</script>";
    } else {
        echo "<script>alert('Transaksi berhasil. Kembalian: Rp " . number_format($kembalian, 0, ',', '.') . "');</script>";
    }
     // Input laporan otomatis di sini
     $tanggal = date('Y-m-d');
     $insert_laporan = "INSERT INTO laporan_harian (nama_kasir, tanggal_penjualan, total_penjualan) 
                        VALUES ('$nama_kasir', '$tanggal', '$total_setelah_diskon')";
     mysqli_query($koneksi, $insert_laporan);

     // Hapus isi penjualan setelah disimpan
     $hapus_penjualan = "DELETE FROM penjualan";
     mysqli_query($koneksi, $hapus_penjualan);
}

if (isset($_SESSION['total_setelah_diskon'])) {
    $total_setelah_diskon = $_SESSION['total_setelah_diskon'];
    $bayar = $_SESSION['bayar'];
    $diskon = $_SESSION['diskon'];
}


// if (isset($_POST['inputlaporan'])) {
//     $tanggal = date('Y-m-d');
//     $insert_laporan = "INSERT INTO laporan_harian (nama_kasir, tanggal_penjualan, total_penjualan) 
//                        VALUES ('$nama_kasir', '$tanggal', '$total_setelah_diskon')";
//     mysqli_query($koneksi, $insert_laporan);

//     // Kosongkan tabel penjualan setelah laporan dimasukkan
//     mysqli_query($koneksi, "DELETE FROM penjualan");

//     // Kosongkan session agar transaksi baru bisa mulai dari awal
//     unset($_SESSION['total_setelah_diskon'], $_SESSION['bayar'], $_SESSION['diskon']);

//     echo "<script>alert('Laporan Harian berhasil dimasukkan!');</script>";
// }

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Transaksi - POS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/transaksi.css">    
    <link rel="stylesheet" href="css/navbar.css">    
</head>
<body>
    <div class="navbar">
        <div class="nav-container">
            <div class="brand">Point of Sales</div>
            <div class="nav-links">
                <a href="home.php">Beranda</a>
                <a href="transaksi.php" class="active">Transaksi</a>
                <a href="produk.php">Produk</a>
                <a href="laporan_harian.php">Laporan Harian</a>
                <a href="laporan_bulanan.php">Laporan Bulanan</a>
                <a href="companyprofile.php">Profil</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </div>

    <div class="container">
        <h3>Transaksi</h3>
        <form action="" method="post">
            <input type="number" name="id_produk" placeholder="Kode PLU" required>
            <input type="number" name="quantity" placeholder="Jumlah" required>
            <button type="submit" name="input">Input Produk</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID Penjualan</th>
                    <th>Tanggal</th>
                    <th>Nama Produk</th>
                    <th>Harga Satuan</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($tampilkanp)) { ?>
            <tr>
                <td><?= $row['id_penjualan'] ?></td>
                <td><?= $row['tanggal_penjualan'] ?></td>
                <td><?= $row['nama_produk'] ?></td>
                <td><?= $row['quantity'] ?></td>
                <td>Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
            </tr>
        <?php } ?>
            </tbody>
        </table>

        <form action="" method="post">
            <input type="number" name="diskon" placeholder="Diskon">
            <input type="number" name="bayar" placeholder="Bayar">
            <button type="submit" name="submit_bayar">Bayar</button>
        </form>

        <div class="summary">
            <p><strong>Subtotal:</strong> Rp <?= number_format($total_semua, 0, ',', '.') ?></p>
            <p><strong>Diskon:</strong> Rp <?= number_format($diskon, 0, ',', '.') ?></p>
            <p><strong>Total Setelah Diskon:</strong> Rp <?= number_format($total_setelah_diskon, 0, ',', '.') ?></p>
            <p><strong>Bayar:</strong> Rp <?= number_format($bayar, 0, ',', '.') ?></p>
            <p><strong>Kembalian:</strong> Rp <?= number_format($kembalian < 0 ? 0 : $kembalian, 0, ',', '.') ?></p>
        </div>

        <form action="./struktransaksi.php" method="post">
    <input type="hidden" name="subtotal" value="<?= $total_semua ?>">
    <input type="hidden" name="diskon" value="<?= $diskon ?>">
    <input type="hidden" name="bayar" value="<?= $bayar ?>">
    <input type="hidden" name="total_akhir" value="<?= $total_setelah_diskon ?>">
    <input type="hidden" name="kembalian" value="<?= $kembalian ?>">
    <button class="btn-struk" type="submit">Cetak Struk</button>
</form>



    </div>
</body>
</html>
