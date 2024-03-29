<?php

class Koneksi
{
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=localhost;dbname=db_kasir_baru", "root", "");
        } catch (PDOException $e) {
            echo "Connection failed : " . $e->getMessage();
            exit;
        }
    }

    public function query($sql, $data = [], $fetch = false, $id = false)
    {
        $q = $this->conn->prepare($sql);

        if (!empty($data)) {
            $q->execute($data);
        } else {
            $q->execute();
        }

        if ($id) {
            return $this->conn->lastInsertId();
        }


        return $fetch ? $q->fetchAll(2) : $q;
    }

    public function register($nama_lengkap, $username, $email, $password, $level)
    {
        $sql = "INSERT INTO pengguna (NamaLengkap, Username, Email, Password, Level) VALUES (?, ?, ?, ?, ?)";
        try {
            $result = $this->query($sql, [$nama_lengkap, $username, $email, md5($password), $level]);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                return "ERROR:UNIQUE_USERNAME_EMAIL";
            }
        }

        return $result ? true : false;
    }

    public function login($email, $password)
    {
        $password = md5($password);

        $sql = "SELECT * FROM pengguna WHERE Email = ? AND Password = ?";

        $result = $this->query($sql, [$email, $password], true);

        if (!empty($result)) {
            $_SESSION['user'] = $result[0];
            return true;
        }

        return false;
    }

    public function redirect($string)
    {
        echo "<script> window.location.href = '$string' </script>";
    }

    public function checkDir()
    {
        return __DIR__;
    }

    public function checkSession()
    {
        if (isset($_SESSION['user'])) {
            return true;
        }

        return false;
    }

    public function dataPengguna()
    {
        return $this->query("SELECT * FROM pengguna", [], true);
    }

    public function simpanPengguna($nama_lengkap, $username, $email, $password, $alamat, $level)
    {
        $sql = "INSERT INTO pengguna (NamaLengkap, Username, Email, Password,Alamat, Level) VALUES (?,?, ?, ?, ?, ?)";
        try {
            $result = $this->query($sql, [$nama_lengkap, $username, $email, md5($password), $alamat, $level]);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                return "ERROR:UNIQUE_USERNAME_EMAIL";
            }
        }

        return $result ? true : false;
    }

    public function hapusPengguna($id)
    {
        $sql = "DELETE FROM pengguna WHERE PenggunaID LIKE ?";

        $result = $this->query($sql, [$id]);

        return $result ? true : false;
    }

    public function showPengguna($id)
    {
        $sql = "SELECT * FROM pengguna WHERE PenggunaID LIKE ?";

        $result = $this->query($sql, [$id], true);

        return $result;
    }

    public function updatePengguna($id, $nama_lengkap, $username, $email, $password, $alamat, $level)
    {
        if ($password != "") {
            $sql = "UPDATE pengguna SET NamaLengkap = ? , Username = ?, Email = ?, Password = ?, Alamat = ?, Level = ? WHERE PenggunaID LIKE ?";
            try {
                $result = $this->query($sql, [$nama_lengkap, $username, $email, md5($password), $alamat, $level, $id]);
            } catch (PDOException $e) {
                if ($e->getCode() == 23000) {
                    return "ERROR:UNIQUE_USERNAME_EMAIL";
                }
            }
        } else {
            $sql = "UPDATE pengguna SET NamaLengkap = ? , Username = ?, Email = ?, Alamat = ?, Level = ? WHERE PenggunaID LIKE ?";
            $result = $this->query($sql, [$nama_lengkap, $username, $email, $alamat, $level, $id]);
        }

        return $result ? true : false;
    }

    public function searchPengguna($keyword)
    {
        $sql = "SELECT * FROM pengguna";

        if (!empty($keyword)) {
            $sql .= " WHERE NamaLengkap LIKE ? OR Email LIKE ? OR Username LIKE ? OR Alamat LIKE ?";
            $keyword = "%$keyword%";
        }

        $result = $this->query($sql, [$keyword, $keyword, $keyword, $keyword], true);

        return $result;
    }

    public function count($table, $condition = "")
    {
        $sql = "SELECT COUNT(*) as count FROM $table";

        if ($condition !== "") {
            $sql .= " WHERE $condition";
        }

        $result = $this->query($sql, [], true);

        return $result[0]['count'];
    }

    public function totalPenjualanHariIni()
    {
        $sql = "SELECT SUM(TotalHarga) AS TotalPembelian FROM penjualan WHERE TanggalPenjualan = ?";

        $result = $this->query($sql, [date('Y-m-d')], true);

        return $result[0]['TotalPembelian'];
    }

    public function dataProduk()
    {
        $sql = "SELECT * FROM produk ORDER BY NamaProduk ASC";

        $result = $this->query($sql, [], true);

        return $result;
    }

    public function searchProduk($keyword)
    {
        $sql = "SELECT * FROM produk";

        if (!empty($keyword)) {
            $sql .= " WHERE NamaProduk LIKE ?";
            $keyword = "%$keyword%";
        }

        $result = $this->query($sql, [$keyword], true);

        return $result;
    }

    public function showProduk($id)
    {
        $sql = "SELECT * FROM produk WHERE ProdukID LIKE ?";

        $result = $this->query($sql, [$id], true);

        return $result;
    }

    public function simpanProduk($nama, $harga, $stok)
    {
        $sql = "INSERT INTO produk (NamaProduk, Harga, Stok) VALUE(? , ?, ?)";

        $result = $this->query($sql, [$nama, $harga, $stok]);

        return $result ? true : false;
    }

    public function updateProduk($id, $nama, $harga, $stok)
    {
        $sql = "UPDATE produk SET NamaProduk = ? , Harga = ?, Stok = ? WHERE ProdukID = ?";

        $result = $this->query($sql, [$nama, $harga, $stok, $id]);

        return $result ? true : false;
    }

    public function hapusProduk($id)
    {
        $sql = "DELETE FROM produk WHERE ProdukID LIKE ?";

        try {
            $result = $this->query($sql, [$id]);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                return "ERROR:BERKAITAN";
            }
        }

        return $result ? true : false;
    }

    public function dataPelanggan()
    {
        $sql = "SELECT * FROM pelanggan ORDER BY NamaPelanggan ASC";

        $result = $this->query($sql, [], true);

        return $result;
    }

    public function searchPelanggan($keyword)
    {
        $sql = "SELECT * FROM pelanggan";

        if (!empty($keyword)) {
            $sql .= " WHERE NamaPelanggan LIKE ?";
            $keyword = "%$keyword%";
        }

        $result = $this->query($sql, [$keyword], true);

        return $result;
    }

    public function showPelanggan($id)
    {
        $sql = "SELECT * FROM pelanggan WHERE PelangganID LIKE ?";

        $result = $this->query($sql, [$id], true);

        return $result;
    }

    public function simpanPelanggan($nama, $alamat, $no_telp)
    {
        $sql = "INSERT INTO pelanggan (NamaPelanggan, Alamat, NomorTelepon) VALUE(?,?,?)";

        $result = $this->query($sql, [$nama, $alamat, $no_telp]);

        return $result ? true : false;
    }

    public function updatePelanggan($id, $nama, $alamat, $no_telp)
    {
        $sql = "UPDATE pelanggan SET NamaPelanggan = ? , Alamat = ?, NomorTelepon = ? WHERE PelangganID = ?";

        $result = $this->query($sql, [$nama, $alamat, $no_telp, $id]);

        return $result ? true : false;
    }

    public function hapusPelanggan($id)
    {
        $sql = "DELETE FROM pelanggan WHERE PelangganID LIKE ?";

        try {
            $result = $this->query($sql, [$id]);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                return "ERROR:BERKAITAN";
            }
        }

        return $result ? true : false;
    }

    public function dataPenjualan()
    {
        $sql = "SELECT penjualan.*, pelanggan.NamaPelanggan FROM penjualan JOIN pelanggan ON pelanggan.PelangganID = penjualan.PelangganID ORDER BY TanggalPenjualan DESC";

        $result = $this->query($sql, [], true);

        return $result;
    }

    public function searchPenjualan($keyword)
    {
        $sql = "SELECT penjualan.*, pelanggan.NamaPelanggan FROM penjualan JOIN pelanggan ON pelanggan.PelangganID = penjualan.PelangganID ORDER BY TanggalPenjualan DESC";

        if (!empty($keyword)) {
            $sql .= " WHERE NamaPelanggan LIKE ?";
            $keyword = "%$keyword%";
        }

        $result = $this->query($sql, [$keyword], true);

        return $result;
    }

    public function showPenjualan($id)
    {
        $sql = "SELECT penjualan.*, pelanggan.NamaPelanggan FROM penjualan JOIN pelanggan ON pelanggan.PelangganID = penjualan.PelangganID WHERE PelangganID LIKE ?";

        $result = $this->query($sql, [$id], true);

        return $result;
    }

    public function simpanPenjualanMember($pelanggan_id, $tanggal_penjualan)
    {
        $sql = "INSERT INTO penjualan (PelangganID, TanggalPenjualan) VALUE(?,?)";

        $result = $this->query($sql, [$pelanggan_id, $tanggal_penjualan], false, true);

        if ($result) {
            return ['pesan' => 'berhasil', 'PenjualanID' => $result];
        }

        return false;
    }

    public function simpanPenjualanNonMember($nama_pelanggan, $alamat, $nomor_telepon, $tanggal_penjualan)
    {
        $pelanggan = $this->query("INSERT INTO pelanggan (NamaPelanggan, Alamat, NomorTelepon) VALUES(?, ?, ?)", [$nama_pelanggan, $alamat, $nomor_telepon], false, true);

        if ($pelanggan) {
            $sql = "INSERT INTO penjualan (PelangganID, TanggalPenjualan) VALUE(?,?)";

            $result = $this->query($sql, [$pelanggan, $tanggal_penjualan], false, true);

            if ($result) {
                return ['pesan' => 'berhasil', 'PenjualanID' => $result];
            }
        }

        return false;
    }

    public function updatePenjualan($id, $nama, $alamat, $no_telp)
    {
        $sql = "UPDATE pelanggan SET NamaPelanggan = ? , Alamat = ?, NomorTelepon = ? WHERE PelangganID = ?";

        $result = $this->query($sql, [$nama, $alamat, $no_telp, $id]);

        return $result ? true : false;
    }

    public function hapusPenjualan($id)
    {
        $sql = "DELETE FROM penjualan WHERE PenjualanID LIKE ?";

        try {
            $result = $this->query($sql, [$id]);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                return "ERROR:BERKAITAN";
            }
        }

        return $result ? true : false;
    }
}

$db = new Koneksi();
