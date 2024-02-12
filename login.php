<!DOCTYPE html>
<html lang="en">

<?php
session_start();
require('function.php');

if (isset($_POST['Login'])) {

    $result = $db->login($_POST['pengguna_email'], $_POST['pengguna_password']);

    if ($result == 1) {
        $db->redirect("pages/beranda");
    } else {
        $db->redirect("?pesan=gagal");
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Kasir Login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <div class="container text-center" style="margin-top:5rem">
        <h1 class="text-success mb-4">E-KASIR</h1>
        <h3 class="text-primary mb-4">Silahkan <b>Login</b></h3>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-sm-7">
                <form action="" method="post" class="row g-2">
                    <div class="form-group">
                        <input type="email" name="pengguna_email" id="pengguna_email" placeholder="Email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="pengguna_password" id="pengguna_password" placeholder="Password" class="form-control" required>
                    </div>
                    <div class="form-group ">
                        <button type="submit" name="Login" class="btn btn-primary col-lg-12">Login</button>
                    </div>
                    <a href="register.php">Signup</a>
                </form>
            </div>
        </div>
    </div>

</body>

</html>