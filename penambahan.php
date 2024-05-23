<?php
require 'function.php';

session_start();

$barang_barang = query('SELECT `id_barang`, `nama_barang`, `jumlah_barang` FROM barang');

// cek apakah tombol submit sudah diklik
if (isset($_POST["submit"])) {
    $id_barang = htmlspecialchars($_POST["nama_barang"]);
    $jumlah_tambahan = (int) $_POST['jumlah_barang'];

    $result = penambahan($id_barang, $jumlah_tambahan);
    if ($result) {
        updateStatus($id_barang);
        $_SESSION['message'] = "Jumlah barang berhasil ditambahkan.";
        $_SESSION['msg_type'] = "success";
    } else {
        $_SESSION['message'] = "Data gagal ditambahkan.";
        $_SESSION['msg_type'] = "danger";
    }

    header("Location: penambahan.php");
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
    <title>Penambahan Barang - Inventory Barang</title>
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
                    <h1 class="mt-4 mb-5">Penambahan Barang</h1>
                    <div class="card col-sm-6 mb-4">
                        <div class="card-body shadow">
                            <h4 class="mb-3">Form Penambahan Barang</h4>
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
                            <form class="row g-3" action="" method="post">
                                <div class="col col-sm-8">
                                    <label for="nama_barang" class="form-label">Nama Barang</label>
                                    <select id="nama_barang" name="nama_barang" class="form-select">
                                        <option value="" disabled selected>Pilih barang</option>
                                        <?php foreach ($barang_barang as $barang) : ?>
                                            <option value="<?= $barang["id_barang"]; ?>"><?= $barang["nama_barang"]; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col col-sm-4">
                                    <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
                                    <input type="number" class="form-control" placeholder="masukan jumlah" id="jumlah-input" name="jumlah_barang" min="1" disabled required>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit" name="submit" id="submit-btn" disabled>Tambah</button>
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

    <!-- untuk form handling -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const namaBarangSelect = document.getElementById('nama_barang');
            const submitBtn = document.getElementById('submit-btn');
            const inputJumlah = document.getElementById('jumlah-input');

            namaBarangSelect.addEventListener('change', function() {
                submitBtn.removeAttribute('disabled');
                inputJumlah.removeAttribute('disabled');
            });
        });
    </script>
</body>

</html>