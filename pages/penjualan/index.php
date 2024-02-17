<?php $title = "Penjualan"; ?>
<?php require('../layout/header.php'); ?>

<?php

if (isset($_POST['simpan'])) {

    if (isset($_GET['member'])) {
        $result = $db->simpanPenjualanMember($_POST['PelangganID'], $_POST['TanggalPenjualan']);

        if ($result['pesan'] == "berhasil") {
            $db->redirect('detail.php?PenjualanID=' . $result['PenjualanID']);
        }
    } else {
    }

    // if ($_POST['PelangganID'] != "") {
    //     $result = $db->updatePelanggan($_POST['PelangganID'], $_POST['NamaPelanggan'], $_POST['Alamat'], $_POST['NomorTelepon']);

    //     if ($result == 1) {
    //         $db->redirect("?pesan=berhasil_ubah");
    //     } else {
    //         $db->redirect("?pesan=gagal_ubah");
    //     }
    // } else {
    //     $result = $db->simpanPelanggan($_POST['NamaPelanggan'], $_POST['Alamat'], $_POST['NomorTelepon']);

    //     if ($result == 1) {
    //         $db->redirect("?pesan=berhasil");
    //     } else {
    //         $db->redirect("?pesan=gagal");
    //     }
    // }
}

if (isset($_POST['hapus'])) {
    $result = $db->hapusPelanggan($_POST['PelangganID']);
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
                    <div class="card-header"><?= (isset($_GET['edit']) ? 'Edit' : 'Input') ?> Penjualan</div>
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
                                        <?php foreach ($db->showPelanggan($_GET['id']) as $value) : ?>
                                            <input type="hidden" name="PelangganID" value="<?= $value['PelangganID'] ?>">
                                            <div class="form-group">
                                                <label for="NamaPelanggan">Nama Pelanggan</label>
                                                <input type="text" name="NamaPelanggan" value="<?= $value['NamaPelanggan'] ?>" id="NamaPelanggan" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Alamat">Alamat</label>
                                                <textarea name="Alamat" id="Alamat" value="<?= $value['Alamat'] ?>" class="form-control" required><?= $value['Alamat'] ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="NomorTelepon">Nomor Telepon</label>
                                                <input type="number" name="NomorTelepon" value="<?= $value['NomorTelepon'] ?>" id="NomorTelepon" class="form-control" required>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <ul class="nav nav-tabs mb-2">
                                        <li class="nav-item">
                                            <a href="?member" class="nav-link <?= (isset($_GET['member']) ? 'active' : "") ?>">Member</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="?" class="nav-link <?= (!isset($_GET['member']) ? 'active' : "") ?>">Non Member</a>
                                        </li>
                                    </ul>

                                    <?php if (!isset($_GET['member'])) : ?>
                                        <div class="form-group">
                                            <label for="NamaPelanggan">Nama Pelanggan</label>
                                            <input type="text" name="NamaPelanggan" id="NamaPelanggan" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Alamat">Alamat</label>
                                            <textarea name="Alamat" id="Alamat" class="form-control" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="NomorTelepon">Nomor Telepon</label>
                                            <input type="number" name="NomorTelepon" id="NomorTelepon" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="TanggalPenjualan">Tanggal</label>
                                            <input type="date" name="TanggalPenjualan" id="TanggalPenjualan" value="<?= date('Y-m-d') ?>" class="form-control">
                                        </div>
                                    <?php else : ?>
                                        <div class="form-group">
                                            <label for="PelangganID">Pelanggan</label>
                                            <select name="PelangganID" id="PelangganID" class="form-select">
                                                <option value=""></option>
                                                <?php foreach ($db->dataPelanggan() as $value) : ?>
                                                    <option value="<?= $value['PelangganID'] ?>"><?= $value['NamaPelanggan'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="TanggalPenjualan">Tanggal</label>
                                            <input type="date" name="TanggalPenjualan" id="TanggalPenjualan" value="<?= date('Y-m-d') ?>" class="form-control">
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <div class="form-group mt-2">
                                    <button type="submit" name="simpan" class="btn col-lg-12 btn-primary">Proses</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">Data Penjualan</div>
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
                                        <th>Tanggal</th>
                                        <th>Pelanggan</th>
                                        <th>Total Pembelian</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($_GET['search'])) : ?>
                                        <?php foreach ($db->searchPenjualan($_GET['search']) as $index => $value) : ?>
                                            <tr>
                                                <td><?= ($index + 1) ?></td>
                                                <td><?= $value['TanggalPenjualan'] ?></td>
                                                <td><?= $value['NamaPelanggan'] ?></td>
                                                <td><?= $value['TotalHarga'] ?></td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <a href="?edit&id=<?= $value['PenjualanID'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="PenjualanID" value="<?= $value['PenjualanID'] ?>">
                                                            <button type="submit" name="hapus" class="btn btn-sm btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <?php if ($db->count('penjualan') < 1) : ?>
                                            <tr>
                                                <td colspan="5" class="text-center">Data kosong</td>
                                            </tr>
                                        <?php else : ?>
                                            <?php foreach ($db->dataPenjualan() as $index => $value) : ?>
                                                <tr>
                                                    <td><?= ($index + 1) ?></td>
                                                    <td><?= $value['TanggalPenjualan'] ?></td>
                                                    <td><?= $value['NamaPelanggan'] ?></td>
                                                    <td><?= $value['TotalHarga'] ?></td>
                                                    <td>
                                                        <div class="d-flex gap-1">
                                                            <a href="?edit&id=<?= $value['PenjualanID'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                                            <form action="" method="post" onsubmit="return confirm('Anda yakin ingin menghapus data ini?')">
                                                                <input type="hidden" name="PenjualanID" value="<?= $value['PenjualanID'] ?>">
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