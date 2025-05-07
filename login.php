<?php 
include 'koneksi.php';
session_start();

if (isset($_POST['login'])) {
    // Ambil data login dari input form
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    // Query untuk memeriksa user dan password
    $login = "SELECT * FROM akun WHERE nama_kasir = '$user' AND password = '$pass'";
    $perintah_login = mysqli_query($koneksi, $login);

    if (mysqli_num_rows($perintah_login) == 1) {
        // Ambil data user dari hasil query
        $data_user = mysqli_fetch_assoc($perintah_login);

        // Set session id_user berdasarkan data yang ditemukan
        $_SESSION['id_user'] = $data_user['id_user'];

        // Redirect ke halaman home setelah login berhasil
        header('Location: ./home.php');
        exit();
    } else {
        echo '<p>Username atau Password salah!</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <form action="" method="post">
        <div class="container">
        <h3>Login</h3> 
        <input class="username" type="text" name="user" placeholder="Username" required>
        <input class="password" type="password" name="pass" placeholder="Password" required>
        <button type="submit" name="login" class="submit">Submit</button>
        </div>
    </form>
</body>
</html>
