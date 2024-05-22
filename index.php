<?php
require 'function.php';

session_start();

$barang_barang = query('SELECT * FROM barang');

// cek apakah tombol submit sudah diklik
if (isset($_POST["submit"])) {
    // cek apakah data berhasil ditambahkan
    if (TambahUbah($_POST)) {
        $_SESSION['message'] = "Barang berhasil ditambahkan.";
        $_SESSION['msg_type'] = "success";
    } else {
        $_SESSION['message'] = "Data gagal ditambahkan.";
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
    <title>Daftar Barang - Inventory Barang</title>
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
                    <h1 class="mt-4 mb-5">Daftar Barang</h1>
                    <div class="card mb-4">
                        <div class="card-body shadow">
                            <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#tambahBarang"><i class="fa-solid fa-plus"></i> Tambah Barang</button>
                            <?php if (isset($_SESSION['message'])) : ?>
                                <div id="alert-message" class="alert alert-<?= $_SESSION['msg_type']; ?> alert-dismissible fade show" role="alert">
                                    <strong><?= $_SESSION['message']; ?></strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <?php
                                unset($_SESSION['message']);
                                unset($_SESSION['msg_type']);
                                ?>
                            <?php endif; ?>
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Jumlah</th>
                                        <th>Satuan</th>
                                        <th>Harga Beli</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Jumlah</th>
                                        <th>Satuan</th>
                                        <th>Harga Beli</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($barang_barang as $i => $barang) : ?>
                                        <tr>
                                            <td><?= $barang["kode_barang"]; ?></td>
                                            <td><?= $barang["nama_barang"]; ?></td>
                                            <td><?= $barang["jumlah_barang"]; ?></td>
                                            <td><?= $barang["satuan_barang"]; ?></td>
                                            <td><?= $barang["harga_beli"]; ?></td>
                                            <td>
                                                <span class="badge rounded-pill text-bg-<?= $barang["status_barang"] == true ? 'success' : 'danger'; ?>">
                                                    <?= $barang["status_barang"] == true ? 'Availabe' : 'Not Availabe'; ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="ubah.php?id=<?= $barang["id_barang"] ?>">
                                                    <button type="button" class="btn btn-warning btn-sm">Ubah</button>
                                                </a>
                                                <a href="hapus.php?id=<?= $barang["id_barang"] ?>" onclick="return confirm('Yakin Ingin Menghapus <?= $barang['nama_barang'] ?>?');">
                                                    <button type="button" class="btn btn-danger btn-sm">Hapus</button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Modal Form tambah barang -->
                <div class="modal fade" id="tambahBarang" tabindex="-1" aria-labelledby="tambahBarangLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="tambahBarangLabel">Form Tambah Barang</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" class="row g-3">
                                    <div class="mb-3">
                                        <label for="kode-barang" class="col-form-label">Kode Barang:</label>
                                        <input type="text" class="form-control" id="kode" name="kode" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama-barang" class="col-form-label">Nama Barang:</label>
                                        <input type="text" class="form-control" name="nama" id="nama" required>
                                    </div>
                                    <div class="mb-3 col col-sm-8">
                                        <div class="mb-3 col col-sm-8">
                                            <label for="jumlah-barang" class="col-form-label">Jumlah Barang:</label>
                                            <input type="number" class="form-control" name="jumlah" id="jumlah" min="0" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 col col-sm-4">
                                        <label for="satuan-barang" class="col-form-label">Satuan Barang:</label>
                                        <select name="satuan" id="satuan" class="form-select" required>
                                            <option value="pcs">pcs</option>
                                            <option value="kg">kg</option>
                                            <option value="liter">liter</option>
                                            <option value="meter">meter</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="harga" class="col-form-label">Harga Beli:</label>
                                        <input type="number" class="form-control" name="harga" id="harga" min="0" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
                                    </div>
                                </form>
                            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <!-- Untuk waktu alert -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var alertMessage = document.getElementById("alert-message");
            if (alertMessage) {
                setTimeout(function() {
                    var alert = new bootstrap.Alert(alertMessage);
                    alert.close();
                }, 5000);
            }
        });
    </script>
</body>

</html>