<!DOCTYPE html>
<html lang="en">

<?php
require('function.php');

if (isset($_POST['Signup'])) {
    $result = $db->register($_POST['pengguna_nama'], $_POST['pengguna_username'], $_POST['pengguna_email'], $_POST['pengguna_password'], $_POST['pengguna_level']);

    if ($result == 1) {
        $db->redirect("login.php?pesan=berhasil");
    } else if ($result === "ERROR:UNIQUE_USERNAME_EMAIL") {
        $db->redirect("?pesan=telah-diambil");
    } else {
        $db->redirect("?pesan=gagal");
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Kasir Register</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <div class="container text-center" style="margin-top:5rem">
        <h1 class="text-success mb-4">E-KASIR</h1>
        <h3 class="text-primary mb-4">Silahkan <b>Daftar</b></h3>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-sm-7">
                <?php if (isset($_GET['pesan'])) : ?>

                    <?php if ($_GET['pesan'] == "telah-diambil") : ?>
                        <div class="alert alert-danger">
                            Username atau Email tidak Tersedia!
                        </div>
                    <?php endif; ?>

                <?php endif; ?>
                <form action="" method="post" class="row g-2">
                    <div class="form-group">
                        <input type="text" name="pengguna_nama" id="pengguna_nama" placeholder="Nama Lengkap" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="pengguna_username" id="pengguna_username" placeholder="Username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="pengguna_email" id="pengguna_email" placeholder="Email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="pengguna_password" id="pengguna_password" placeholder="Password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <select name="pengguna_level" id="pengguna_level" class="form-select" required>
                            <option value="">-- Pilih Level --</option>
                            <option value="1">Administrator</option>
                            <option value="2">Petugas</option>
                        </select>
                    </div>
                    <div class="form-group ">
                        <button type="submit" name="Signup" class="btn btn-primary col-lg-12">Signup</button>
                    </div>
                    <a href="login.php">Login</a>
                </form>
            </div>
        </div>
    </div>

</body>

</html>