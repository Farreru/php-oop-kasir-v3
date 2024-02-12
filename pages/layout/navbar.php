<a href="../beranda" class="btn btn-outline-primary btn-sm">Beranda</a>
<?php if ($_SESSION['user']['Level'] == 1) : ?>
    <a href="../pengguna" class="btn btn-outline-primary btn-sm">Pengguna</a>
<?php endif; ?>
<a href="../produk" class="btn btn-outline-primary btn-sm">Produk</a>
<a href="index.php" class="btn btn-outline-primary btn-sm">Pelanggan</a>
<a href="index.php" class="btn btn-outline-primary btn-sm">Penjualan</a>
<a href="index.php" class="btn btn-outline-primary btn-sm">Laporan</a>