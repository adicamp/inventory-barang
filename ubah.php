<!-- Nama    : Adi Septiandi 
NIM     : 220401010197
Kelas   : IT401
Matkul  : Pemrograman Web II -->
<?php
require 'function.php';

session_start();

// ambil id dari url
$id = $_GET["id"];

if ($id) {
    // query data barang berdasarkan id
    $barang = query("SELECT * FROM barang WHERE id_barang = $id");
    if (count($barang) > 0) {
        $barang = $barang[0];
    } else {
        // Jika barang tidak ditemukan
        $_SESSION['message'] = "Data barang tidak ditemukan.";
        $_SESSION['msg_type'] = "danger";
        header("Location: index.php");
        exit;
    }
} else {
    // Jika id di url kosong
    $_SESSION['message'] = "ID barang tidak valid.";
    $_SESSION['msg_type'] = "danger";
    header("Location: index.php");
    exit;
}

// cek apakah tombol submit sudah diklik
if (isset($_POST["submit"])) {
    // cek apakah data berhasil diubah
    if (TambahUbah($_POST)) {
        updateStatus($id);
        $_SESSION['message'] = "Barang berhasil diubah.";
        $_SESSION['msg_type'] = "success";
    } else {
        $_SESSION['message'] = "Data gagal diubah.";
        $_SESSION['msg_type'] = "danger";
    }
    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Ubah Data Barang - Inventory Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Inventory Barang</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    </nav>
    <!-- Side Bar -->
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Barang</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Daftar Barang
                        </a>
                        <a class="nav-link" href="penambahan.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-truck-ramp-box"></i></div>
                            Penambahan Barang
                        </a>
                        <a class="nav-link" href="pemakaian.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-people-carry-box"></i></div>
                            Pemakaian Barang
                        </a>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Main -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4 mb-5">Ubah Data Barang</h1>
                    <div class="card col-sm-6 mb-4">
                        <div class="card-body shadow p-4">
                            <h4 class="mb-3">Form Ubah Data Barang</h4>
                            <form action="" method="post" class="row g-3">
                                <input type="hidden" name="id" value="<?= $barang["id_barang"] ?>">
                                <div class="mb-3">
                                    <label for="kode-barang" class="col-form-label">Kode Barang:</label>
                                    <input type="text" class="form-control" id="kode" name="kode" value="<?= $barang["kode_barang"] ?>" required>
                                </div>
                                <div class=" mb-3">
                                    <label for="nama-barang" class="col-form-label">Nama Barang:</label>
                                    <input type="text" class="form-control" name="nama" id="nama" value="<?= $barang["nama_barang"] ?>" required>
                                </div>
                                <div class=" mb-3 col col-sm-8">
                                    <div class="mb-3 col col-sm-8">
                                        <label for="jumlah-barang" class="col-form-label">Jumlah Barang:</label>
                                        <input type="number" class="form-control" name="jumlah" id="jumlah" value="<?= $barang["jumlah_barang"] ?>" required>
                                    </div>
                                </div>
                                <div class=" mb-3 col col-sm-4">
                                    <label for="satuan-barang" class="col-form-label">Satuan Barang:</label>
                                    <select name="satuan" id="satuan" class="form-select" value="<?= $barang["satuan_barang"] ?>" required>
                                        <option value="pcs" <?= $barang["satuan_barang"] == "pcs" ? "selected" : "" ?>>pcs</option>
                                        <option value="kg" <?= $barang["satuan_barang"] == "kg" ? "selected" : "" ?>>kg</option>
                                        <option value="liter" <?= $barang["satuan_barang"] == "liter" ? "selected" : "" ?>>liter</option>
                                        <option value="meter" <?= $barang["satuan_barang"] == "meter" ? "selected" : "" ?>>meter</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="col-form-label">Harga Beli:</label>
                                    <input type="number" class="form-control" name="harga" id="harga" value="<?= $barang["harga_beli"] ?>" required>
                                </div>
                                <div class=" footer">
                                    <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php'">Batal</button>
                                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Inventory Barang 2024</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>