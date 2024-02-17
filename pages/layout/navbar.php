<li class="nav-item">
    <a href="../beranda/" class="nav-link">Beranda</a>
</li>
<?php if ($_SESSION['user']['Level'] == 1) : ?>
    <li class="nav-item active">
        <a href="../pengguna/" class="nav-link">Pengguna</a>
    </li>
<?php endif; ?>
<li class="nav-item">
    <a href="../produk/" class="nav-link">Produk</a>
</li>
<li class="nav-item">
    <a href="../pelanggan/" class="nav-link">Pelanggan</a>
</li>
<li class="nav-item">
    <a href="../penjualan/" class="nav-link">Penjualan</a>
</li>
<li class="nav-item">
    <a href="index.php" class="nav-link">Laporan</a>
</li>