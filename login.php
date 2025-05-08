<?php 
include 'koneksi.php';
session_start();

$error = ''; // variabel error

if (isset($_POST['login'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $login = "SELECT * FROM akun WHERE nama_kasir = '$user' AND password = '$pass'";
    $perintah_login = mysqli_query($koneksi, $login);

    if (mysqli_num_rows($perintah_login) == 1) {
        $data_user = mysqli_fetch_assoc($perintah_login);
        $_SESSION['id_user'] = $data_user['id_user'];
        header('Location: ./home.php');
        exit();
    } else {
        $error = 'Username atau Password anda salah!';
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
        <?php if ($error): ?>
        <p><?= $error; ?></p>
    <?php endif; ?>
        <input class="username" type="text" name="user" placeholder="Username" required>
        <input class="password" type="password" name="pass" placeholder="Password" required>
        <button type="submit" name="login" class="submit">Submit</button>
        </div>
    </form>
</body>
</html>
