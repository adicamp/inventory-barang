<?php
require 'function.php';

session_start();

$id = $_GET["id"];

if ($id) {
    // query data barang berdasarkan id
    $barang = query("SELECT * FROM barang WHERE id_barang = $id");
    if (count($barang) < 1) {
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

if (hapus($id) > 0) {
    $_SESSION['message'] = "Barang berhasil dihapus.";
    $_SESSION['msg_type'] = "success";
} else {
    $_SESSION['message'] = "Data gagal dihapus.";
    $_SESSION['msg_type'] = "danger";
}
header("Location: index.php");
exit;
