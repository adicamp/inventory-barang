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

// Query
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) :
        $rows[] = $row;
    endwhile;
    return $rows;
}

// Tambah barang
function tambah($data)
{
    global $conn;
    $kode = htmlspecialchars($data["kode"]);
    $nama = htmlspecialchars($data["nama"]);
    $jumlah = htmlspecialchars($data["jumlah"]);
    $satuan = htmlspecialchars($data["satuan"]);
    $harga = htmlspecialchars($data["harga"]);
    $status = true;

    // query insert data
    $query = "INSERT INTO barang
                VALUES
                ('', '$kode', '$nama', '$jumlah', '$satuan', '$harga', '$status')
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Hapus barang
function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM barang WHERE id_barang = $id");
    return mysqli_affected_rows($conn);
}

function ubah($data)
{
    global $conn;
    // ambildata daro toap elemen dalam form
    $id = $data["id"];
    $nim = htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambar = htmlspecialchars($data["gambar"]);

    // query update data
    $query = "UPDATE mahasiswa SET
                nama = '$nama', 
                nim = '$nim', 
                email = '$email', 
                jurusan = '$jurusan', 
                gambar = '$gambar'
                WHERE id = $id
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
