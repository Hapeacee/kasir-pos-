<?php
include 'koneksi.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ambil data yang dikirim dari form transaksi
$subtotal   = $_POST['subtotal'] ?? 0;
$diskon     = $_POST['diskon'] ?? 0;
$bayar      = $_POST['bayar'] ?? 0;
$totalakhir = $_POST['total_akhir'] ?? 0;
$kembali    = $_POST['kembalian'] ?? 0;

// Ambil data transaksi
$tampilan = "SELECT p.id_penjualan, p.tanggal_penjualan, p.quantity, p.total_harga, 
                    pr.nama_produk, pr.harga
             FROM penjualan p
             JOIN produk pr ON p.id_produk = pr.id_produk";
$tampilkanp = mysqli_query($koneksi, $tampilan);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Transaksi</title>
    <style>
        body {
            font-family: monospace;
        }

        h3, h5 {
            text-align: center;
            margin: 0;
        }

        p {
            margin: 5px 0;
        }

        .line {
            text-align: center;
        }

        .item {
            display: flex;
            justify-content: space-between;
        }

        .summary {
            margin-top: 20px;
        }

        .summary p {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body onload="window.print()">

    <h3>Print Laporan Harian</h3>
    <h5>POS UP RPL</h5>
    <h5>Jl. Villa Indah Permai</h5>
    <p class="line">===============================================</p>

    <?php while ($row = mysqli_fetch_assoc($tampilkanp)) { ?>
        <div class="item">
            <span><?= $row['nama_produk'] ?> (x<?= $row['quantity'] ?>)</span>
            <span>Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></span>
        </div>
    <?php } ?>

    <div class="summary">
        <p><strong>Subtotal:</strong> Rp <?= number_format($subtotal, 0, ',', '.') ?></p>
        <p><strong>Diskon:</strong> Rp <?= number_format($diskon, 0, ',', '.') ?></p>
        <p><strong>Total:</strong> Rp <?= number_format($totalakhir, 0, ',', '.') ?></p>
        <p><strong>Bayar:</strong> Rp <?= number_format($bayar, 0, ',', '.') ?></p>
        <p><strong>Kembalian:</strong> Rp <?= number_format($kembali < 0 ? 0 : $kembali, 0, ',', '.') ?></p>
    </div>

    <p class="line">===============================================</p>
    <p style="text-align:center;">Terima kasih telah berbelanja!</p>

</body>
</html>
