<?php
include 'koneksi.php';

$laporan = "SELECT * FROM laporan_bulanan";
$perintahlaporan = mysqli_query($koneksi, $laporan);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Laporan Bulanan</title>
    <style>
        h3 {
            justify-content: center;
            display: flex;
            margin-left: auto;
            margin-right: auto;
        }

        p {
            justify-content: center;
            display: flex;
            margin-left: auto;
            margin-right: auto;
        }

        .laporanharian {
            justify-content: center;
            display: flex;
            margin-left: auto;
            margin-right: auto;
        }

        h4 {
            display: block;
            margin-left: 120px;
        }
    </style>
</head>

<body onload="window.print()">
    <h3>Print Laporan Bulanan</h3>
    <p>POS UP RPL</p>
    <p>Jl. Villa Indah Permai</p>
    <p>= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =</p>
    <div class="laporanharian">
        <table>
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
                        <td>Rp. <?= $tampilkanlaporan['total_penjualan']; ?></td>
                        <td><?= $tampilkanlaporan['bulan_penjualan']; ?></td>
                        <td><?= $tampilkanlaporan['nama_kasir']; ?></td>
                </tr>
            </tbody>
        <?php } ?>
        </table>
    </div>
    <?php
    $subtotal = "SELECT SUM(total_penjualan) AS total FROM laporan_bulanan";
    $perintahsub = mysqli_query($koneksi, $subtotal);
    $mintasub = mysqli_fetch_assoc($perintahsub);

    ?>
    <!-- SubTotal Harga -->
    <p>= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =</p>
    <h4>Subtotal: Rp. <?= $mintasub['total'] ?></h4>

</body>

</html>