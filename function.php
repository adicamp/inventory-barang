<?php
// variables for connection to database
$host = "localhost";
$user = "root";
$pass = "";
$db = "inventory";

// connect to database
$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Gagal terkoneksi ke database");
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Query
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// Tambah Ubah barang
function TambahUbah($data)
{
    global $conn;
    $id = isset($data["id"]) ? $data["id"] : null;
    $kode = htmlspecialchars(trim($data["kode"]));
    $nama = htmlspecialchars(trim($data["nama"]));
    $jumlah = htmlspecialchars(trim($data["jumlah"]));
    $satuan = htmlspecialchars(trim($data["satuan"]));
    $harga = htmlspecialchars(trim($data["harga"]));
    $status = true;

    // Validasi input tidak boleh kosong
    if (empty($kode) || empty($nama) || empty($jumlah) || empty($satuan) || empty($harga)) {
        return false;
    }

    if ($id) {
        // query update data
        $query = "UPDATE barang SET
                kode_barang = '$kode', 
                nama_barang = '$nama', 
                jumlah_barang = $jumlah, 
                satuan_barang = '$satuan', 
                harga_beli = $harga
                WHERE id_barang = $id
                ";
    } else {
        // query insert data
        $query = "INSERT INTO barang 
                (kode_barang, nama_barang, jumlah_barang, satuan_barang, harga_beli, status_barang)
                VALUES
                ('$kode', '$nama', $jumlah, '$satuan', $harga, '$status')
            ";
    }

    try {
        $result = mysqli_query($conn, $query);
        return $result;
    } catch (mysqli_sql_exception $e) {
        return false;
    }
}

// Hapus barang
function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM barang WHERE id_barang = $id");
    return mysqli_affected_rows($conn);
}

// Penambahan barang
function penambahan($id_barang, $jumlah_tambahan)
{
    global $conn;

    $query = "UPDATE barang SET jumlah_barang = jumlah_barang + $jumlah_tambahan WHERE id_barang = '$id_barang'";

    try {
        $result = mysqli_query($conn, $query);
        return $result;
    } catch (mysqli_sql_exception $e) {
        return false;
    }
}

// Pemakaian barang
function pemakaian($id_barang, $jumlah_dipakai)
{
    global $conn;

    $query = "UPDATE barang SET jumlah_barang = jumlah_barang - $jumlah_dipakai WHERE id_barang = '$id_barang'";

    try {
        $result = mysqli_query($conn, $query);
        updateStatus($id_barang);
        return $result;
    } catch (mysqli_sql_exception $e) {
        return false;
    }
}

// update status barang
function updateStatus($id_barang)
{
    global $conn;

    // Dapatkan jumlah_barang saat ini
    $query = "SELECT jumlah_barang FROM barang WHERE id_barang = '$id_barang'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row['jumlah_barang'] <= 0) {
        // Jika jumlah_barang <= 0 status false
        $updateQuery = "UPDATE barang SET status_barang = false WHERE id_barang = '$id_barang'";
    } else {
        // Jika jumlah_barang > 0 status true
        $updateQuery = "UPDATE barang SET status_barang = true WHERE id_barang = '$id_barang'";
    }

    return mysqli_query($conn, $updateQuery);
}
