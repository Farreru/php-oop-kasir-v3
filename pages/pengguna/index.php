<?php $title = "Pengguna"; ?>
<?php require('../layout/header.php'); ?>
<?php require('../../function.php'); ?>

<?php
if (isset($_POST['simpan'])) {

    if ($_POST['PenggunaID'] != "") {
        if ($_POST['Password'] != "") {
            $result = $db->updatePengguna($_POST['PenggunaID'], $_POST['NamaLengkap'], $_POST['Username'], $_POST['Email'], $_POST['Password'], $_POST['Alamat'], $_POST['Level']);
        } else {
            $result = $db->updatePengguna($_POST['PenggunaID'], $_POST['NamaLengkap'], $_POST['Username'], $_POST['Email'], "", $_POST['Alamat'], $_POST['Level']);
        }

        if ($result == 1) {
            $db->redirect("?pesan=berhasil_ubah");
        } else if ($result === "ERROR:UNIQUE_USERNAME_EMAIL") {
            $db->redirect("?pesan=telah-diambil");
        } else {
            $db->redirect("?pesan=gagal_ubah");
        }
    } else {
        $result = $db->simpanPengguna($_POST['NamaLengkap'], $_POST['Username'], $_POST['Email'], $_POST['Password'], $_POST['Alamat'], $_POST['Level']);

        if ($result == 1) {
            $db->redirect("?pesan=berhasil");
        } else if ($result === "ERROR:UNIQUE_USERNAME_EMAIL") {
            $db->redirect("?pesan=telah-diambil");
        } else {
            $db->redirect("?pesan=gagal");
        }
    }
}

if (isset($_POST['hapus'])) {
    $result = $db->hapusPengguna($_POST['PenggunaID']);
    if ($result) {
        $db->redirect("?pesan_table=berhasil_hapus");
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
                    <div class="card-header"><?= (isset($_GET['edit']) ? 'Edit' : 'Input') ?> Pengguna</div>
                    <div class="card-body">
                        <form action="" method="post" class="">
                            <?php if (isset($_GET['pesan'])) : ?>

                                <?php if ($_GET['pesan'] == "telah-diambil") : ?>
                                    <div class="alert alert-danger">
                                        Username atau Email tidak Tersedia!
                                    </div>
                                <?php endif; ?>

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
                                        <?php foreach ($db->showPengguna($_GET['id']) as $value) : ?>
                                            <input type="hidden" name="PenggunaID" value="<?= $value['PenggunaID'] ?>">
                                            <div class="form-group">
                                                <label for="NamaLengkap">Nama Lengkap</label>
                                                <input type="text" name="NamaLengkap" value="<?= $value['NamaLengkap'] ?>" id="NamaLengkap" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Username">Username</label>
                                                <input type="text" readonly name="Username" value="<?= $value['Username'] ?>" id="Username" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Email">Email</label>
                                                <input type="email" readonly name="Email" value="<?= $value['Email'] ?>" id="Email" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Password">Password</label>
                                                <input type="password" name="Password" placeholder="Isi jika perlu perubahan" id="Password" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="Alamat">Alamat</label>
                                                <textarea name="Alamat" id="Alamat" <?= ($value['Alamat'] == "" ? "placeholder='Belum diinput'" : "Alamat") ?> value="<?= $value['Alamat'] ?>" class="form-control" required><?= $value['Alamat'] ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="Level">Level</label>
                                                <select name="Level" id="Level" class="form-select">
                                                    <option value="">-- Pilih Level --</option>
                                                    <option value="1" <?= ($value['Level'] == "1" ? "selected" : "") ?>>Administrator</option>
                                                    <option value="2" <?= ($value['Level'] == "2" ? "selected" : "") ?>>Petugas</option>
                                                </select>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <div class="form-group">
                                        <label for="NamaLengkap">Nama Lengkap</label>
                                        <input type="text" name="NamaLengkap" id="NamaLengkap" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Username">Username</label>
                                        <input type="text" name="Username" id="Username" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Email">Email</label>
                                        <input type="email" name="Email" id="Email" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Password">Password</label>
                                        <input type="password" name="Password" id="Password" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Alamat">Alamat</label>
                                        <textarea name="Alamat" id="Alamat" class="form-control" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="Level">Level</label>
                                        <select name="Level" id="Level" class="form-select">
                                            <option value="">-- Pilih Level --</option>
                                            <option value="1">Administrator</option>
                                            <option value="2">Petugas</option>
                                        </select>
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
                    <div class="card-header">Data Pengguna</div>
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


                                <?php endif; ?>
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Lengkap</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Alamat</th>
                                        <th>Level</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($_GET['search'])) : ?>
                                        <?php foreach ($db->searchPengguna($_GET['search']) as $index => $value) : ?>
                                            <tr>
                                                <td><?= ($index + 1) ?></td>
                                                <td><?= $value['NamaLengkap'] ?></td>
                                                <td><?= $value['Username'] ?></td>
                                                <td><?= $value['Email'] ?></td>
                                                <td class="<?= ($value['Alamat'] == "" ? "text-muted" : "") ?>"><?= ($value['Alamat'] == "" ? "Belum diinput" : $value['Alamat']) ?></td>
                                                <td><?= ($value['Level'] == "1" ? "Admin" : ($value['Level'] == "2" ? "Petugas" : "")) ?></td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <a href="?edit&id=<?= $value['PenggunaID'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="PenggunaID" value="<?= $value['PenggunaID'] ?>">
                                                            <button type="submit" name="hapus" class="btn btn-sm btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <?php if ($db->count('pengguna') < 1) : ?>
                                            <tr>
                                                <td colspan="7" class="text-center">Data kosong</td>
                                            </tr>
                                        <?php else : ?>
                                            <?php foreach ($db->dataPengguna() as $index => $value) : ?>
                                                <tr>
                                                    <td><?= ($index + 1) ?></td>
                                                    <td><?= $value['NamaLengkap'] ?></td>
                                                    <td><?= $value['Username'] ?></td>
                                                    <td><?= $value['Email'] ?></td>
                                                    <td class="<?= ($value['Alamat'] == "" ? "text-muted" : "") ?>"><?= ($value['Alamat'] == "" ? "Belum diinput" : $value['Alamat']) ?></td>
                                                    <td><?= ($value['Level'] == "1" ? "Admin" : ($value['Level'] == "2" ? "Petugas" : "")) ?></td>
                                                    <td>
                                                        <div class="d-flex gap-1">
                                                            <a href="?edit&id=<?= $value['PenggunaID'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                                            <form action="" method="post">
                                                                <input type="hidden" name="PenggunaID" value="<?= $value['PenggunaID'] ?>">
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