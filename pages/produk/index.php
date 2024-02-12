<?php $title = "Produk"; ?>
<?php require('../layout/header.php'); ?>
<?php require('../../function.php'); ?>

<?php
if (isset($_POST['simpan'])) {

    if ($_POST['ProdukID'] != "") {
        $result = $db->updateProduk($_POST['ProdukID'], $_POST['NamaProduk'], $_POST['Harga'], $_POST['Stok']);

        if ($result == 1) {
            $db->redirect("?pesan=berhasil_ubah");
        } else {
            $db->redirect("?pesan=gagal_ubah");
        }
    } else {
        $result = $db->simpanProduk($_POST['NamaProduk'], $_POST['Harga'], $_POST['Stok']);

        if ($result == 1) {
            $db->redirect("?pesan=berhasil");
        } else {
            $db->redirect("?pesan=gagal");
        }
    }
}

if (isset($_POST['hapus'])) {
    $result = $db->hapusProduk($_POST['ProdukID']);
    if ($result == 1) {
        $db->redirect("?pesan_table=berhasil_hapus");
    } else if ($result == "ERROR:BERKAITAN") {
        $db->redirect("?pesan_table=berkaitan");
    } else {
        $db->redirect("?pesan_table=gagal_hapus");
    }
}

if (isset($_POST['submitSearch'])) {
    if ($_POST['search'] != "") {
        $db->redirect("?search=" . $_POST['search']);
    } else {
        $db->redirect("?");
    }
}

?>

<div class="container border p-2 rounded mb-5" style="margin-top:6rem;">
    <div class="p-2">
        <div class="row g-3">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header"><?= (isset($_GET['edit']) ? 'Edit' : 'Input') ?> Produk</div>
                    <div class="card-body">
                        <form action="" method="post" class="">
                            <?php if (isset($_GET['pesan'])) : ?>

                                <?php if ($_GET['pesan'] == "berhasil") : ?>
                                    <div class="alert alert-success">
                                        Berhasil Disimpan!
                                    </div>
                                <?php endif; ?>

                                <?php if ($_GET['pesan'] == "berhasil_ubah") : ?>
                                    <div class="alert alert-success">
                                        Berhasil Diubah!
                                    </div>
                                <?php endif; ?>

                                <?php if ($_GET['pesan'] == "gagal_ubah") : ?>
                                    <div class="alert alert=danger">
                                        Gagal Diubah!
                                    </div>
                                <?php endif; ?>

                                <?php if ($_GET['pesan'] == "gagal") : ?>
                                    <div class="alert alert-danger">
                                        Gagal Disimpan!
                                    </div>
                                <?php endif; ?>

                            <?php endif; ?>
                            <div class="row g-1">
                                <?php if (isset($_GET['edit'])) : ?>
                                    <?php if (isset($_GET['id'])) : ?>
                                        <?php foreach ($db->showProduk($_GET['id']) as $value) : ?>
                                            <input type="hidden" name="ProdukID" value="<?= $value['ProdukID'] ?>">
                                            <div class="form-group">
                                                <label for="NamaProduk">Nama Produk</label>
                                                <input type="text" name="NamaProduk" value="<?= $value['NamaProduk'] ?>" id="NamaProduk" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Harga">Harga</label>
                                                <input type="number" name="Harga" value="<?= $value['Harga'] ?>" id="Harga" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Stok">Stok</label>
                                                <input type="number" name="Stok" value="<?= $value['Stok'] ?>" id="Stok" class="form-control" required>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <div class="form-group">
                                        <label for="NamaProduk">Nama Produk</label>
                                        <input type="text" name="NamaProduk" id="NamaProduk" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Harga">Harga</label>
                                        <input type="number" name="Harga" id="Harga" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Stok">Stok</label>
                                        <input type="number" name="Stok" id="Stok" class="form-control" required>
                                    </div>
                                <?php endif; ?>

                                <div class="form-group mt-2">
                                    <button type="submit" name="simpan" class="btn col-lg-12 btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">Data Produk</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <form action="" method="post">
                                <div class="ms-auto col-lg-3">
                                    <div class="d-flex gap-1 justify-content-end mb-2">
                                        <input type="text" name="search" class="form-control" id="search" placeholder="Cari disini">
                                        <button type="submit" name="submitSearch" class="btn btn-sm btn-primary">Cari</button>
                                    </div>
                                </div>
                            </form>
                            <table class="table table-striped table-bordered">
                                <?php if (isset($_GET['pesan_table'])) : ?>

                                    <?php if ($_GET['pesan_table'] == "berhasil_hapus") : ?>
                                        <div class="alert alert-success">
                                            Berhasil Dihapus!
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($_GET['pesan_table'] == "gagal_hapus") : ?>
                                        <div class="alert alert-danger">
                                            Gagal Dihapus!
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($_GET['pesan_table'] == "berkaitan") : ?>
                                        <div class="alert alert-danger">
                                            Tidak dapat dihapus, dikarekan data terikat dengan Penjualan!
                                        </div>
                                    <?php endif; ?>


                                <?php endif; ?>
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($_GET['search'])) : ?>
                                        <?php foreach ($db->searchProduk($_GET['search']) as $index => $value) : ?>
                                            <tr>
                                                <td><?= ($index + 1) ?></td>
                                                <td><?= $value['NamaProduk'] ?></td>
                                                <td>Rp. <?= $value['Harga'] ?></td>
                                                <td><?= $value['Stok'] ?></td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <a href="?edit&id=<?= $value['ProdukID'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="ProdukID" value="<?= $value['ProdukID'] ?>">
                                                            <button type="submit" name="hapus" class="btn btn-sm btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <?php if ($db->count('produk') < 1) : ?>
                                            <tr>
                                                <td colspan="5" class="text-center">Data kosong</td>
                                            </tr>
                                        <?php else : ?>
                                            <?php foreach ($db->dataProduk() as $index => $value) : ?>
                                                <tr>
                                                    <td><?= ($index + 1) ?></td>
                                                    <td><?= $value['NamaProduk'] ?></td>
                                                    <td>Rp. <?= $value['Harga'] ?></td>
                                                    <td><?= $value['Stok'] ?></td>
                                                    <td>
                                                        <div class="d-flex gap-1">
                                                            <a href="?edit&id=<?= $value['ProdukID'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                                            <form action="" method="post" onsubmit="return confirm('Anda yakin ingin menghapus data ini?')">
                                                                <input type="hidden" name="ProdukID" value="<?= $value['ProdukID'] ?>">
                                                                <button type="submit" name="hapus" class="btn btn-sm btn-danger">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require('../layout/footer.php'); ?>