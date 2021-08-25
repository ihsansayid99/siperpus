<?php
session_start();

if(isset($_SESSION['sesi'])){
    header('location:index.php?p=beranda');
}

include 'config/koneksi-db.php';

if(isset($_POST['submit'])){
    $user = isset($_POST['user']) ? $_POST['user'] : "";
    $pass = isset($_POST['pass']) ? $_POST['pass'] : "";

    $query = mysqli_query($db_conn, "SELECT * FROM admin WHERE username = '$user'");
    $sesi = mysqli_num_rows($query);
    $data_admin = mysqli_fetch_array($query);
    if($sesi > 0){
        $pass_hash = $data_admin['password'];
        if(password_verify($pass, $pass_hash)){
            $_SESSION['id_admin'] = $data_admin['id_admin'];
            $_SESSION['sesi'] = $data_admin['nm_admin'];

            header('location: index.php?p=beranda');
            die();
        } else {
            echo "<script>alert('Username Dan Password Salah!!');</script>";
            echo "<meta http-equiv='refresh' content='0; url=login.php'>";
        }
    } else {
        echo "<script>alert('Username Dan Password Salah!');</script>";
        echo "<meta http-equiv='refresh' content='0; url=login.php'>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SIPERPUS</title>
    <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<!-- Font styles -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="bg-overlay-login">
        <img src="assets/img/bg-login.jpg" alt="perpus" class="img-overlay">
    </div>
    <div class="bg-login">
        <div class="container text-white center-horizontal">
            <div class="title">
                <div class="col-6 mx-auto text-center">
                   <img src="assets/img/LOGO-PERPUSNAS.svg" alt="Perpusnas" class="bg-white rounded-circle p-3" width="80">
                </div>
                <h1 class="text-center">ADMIN PERPUSTAKAAN</h1>
            </div>
            <div class="form-login container">
                <h2 class="text-center">Login</h2>
                <hr style="border: 3px solid white;width:45%;">
                <form action="" method="POST">
                    <div class="form-login-box col-12 col-md-6 mx-auto px-4 py-3">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Username</label>
                            <input type="text" class="form-control form-login-input" name="user">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Password</label>
                            <input type="password" class="form-control form-login-input" name="pass">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary col-12" value="Login" name="submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="assets/vendor/bootstrap/js/jquery-3.3.1.slim.min.js"></script>
	<script src="assets/vendor/bootstrap/js/popper.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
