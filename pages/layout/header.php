<!DOCTYPE html>
<html lang="en">

<?php
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Kasir <?= $title ?></title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>

<body>
    <header>

        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top border">
            <div class="container">
                <a href="../beranda" class="navbar-brand text-success">E-Kasir</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#isiNavbar" aria-controls="isiNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="isiNavbar">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php require('navbar.php'); ?>

                    </ul>
                    <a href="../../logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </nav>

    </header>