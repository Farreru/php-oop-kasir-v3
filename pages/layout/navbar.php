<?php
function checkPages($get)
{
    if (isset($_GET[$get])) {
        return true;
    }
    return false;
}
?>

<li class="nav-item">
    <a href="../beranda/?beranda" class="nav-link <?= (checkPages('beranda') ? 'active' : '') ?>">Beranda</a>
</li>
<?php if ($_SESSION['user']['Level'] == 1) : ?>
    <li class="nav-item active">
        <a href="../pengguna/?pengguna" class="nav-link <?= (checkPages('pengguna') ? 'active' : '') ?>">Pengguna</a>
    </li>
<?php endif; ?>
<li class="nav-item">
    <a href="../produk/?produk" class="nav-link <?= (checkPages('produk') ? 'active' : '') ?>">Produk</a>
</li>
<li class="nav-item">
    <a href="../pelangan/?pelanggan" class="nav-link" <?= (checkPages('pelanggan') ? 'active' : '') ?>>Pelanggan</a>
</li>
<li class="nav-item">
    <a href="index.php" class="nav-link <?= (checkPages('penjualan') ? 'active' : '') ?>">Penjualan</a>
</li>
<li class="nav-item">
    <a href="index.php" class="nav-link <?= (checkPages('laporan') ? 'active' : '') ?>">Laporan</a>
</li>