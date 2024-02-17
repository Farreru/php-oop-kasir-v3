<?php $title = "Beranda"; ?>
<?php require('../layout/header.php'); ?>

<?php


?>

<div class="container border rounded p-2 mb-5" style="margin-top:6rem;">
    <h2 class="text-primary text-center p-2">Selamat Datang <?= $_SESSION['user']['NamaLengkap'] ?>(<?= ($_SESSION['user']['Level'] == 1 ? "Administrator" : ($_SESSION['user']['Level'] == 2 ? "Petugas" : "")) ?>)</h2>
    <div class="p-2">
        <div class="row g-3">
            <?php if ($_SESSION['user']['Level'] == 1) : ?>
                <div class="col-lg-3">
                    <div class="card border-primary">
                        <div class="card-body">
                            Data Pengguna
                            <h3><?= $db->count('pengguna') ?></h3>
                            <a href="../pengguna" class="btn btn-outline-primary">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-lg-3">
                <div class="card border-primary">
                    <div class="card-body">
                        Data Produk
                        <h3><?= $db->count('produk') ?></h3>
                        <a href="../pengguna" class="btn btn-outline-primary">Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card border-primary">
                    <div class="card-body">
                        Data Pelanggan
                        <h3><?= $db->count('pelanggan') ?></h3>
                        <a href="../pengguna" class="btn btn-outline-primary">Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card border-primary">
                    <div class="card-body">
                        Data Penjualan
                        <h3><?= $db->count('penjualan') ?></h3>
                        <a href="../pengguna" class="btn btn-outline-primary">Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card border-primary">
                    <div class="card-body">
                        Penjualan Hari Ini
                        <h3 class="<?= ($db->totalPenjualanHariIni() == "" ? "text-muted h5 pb-2" : "") ?>"><?= ($db->totalPenjualanHariIni() != "" ? $db->totalPenjualanHariIni() : "Belum ada penjualan") ?></h3>
                        <a href="../pengguna" class="btn btn-outline-primary">Selengkapnya</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require('../layout/footer.php'); ?>