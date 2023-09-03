<?php
session_start();
include '../conn.php';

$id = $_GET['id'];
$nama_kost = $_GET['nama_kost'];

// mengahpus data dari parameter id yang dilempar
$deleteData = mysqli_query($conn, "DELETE FROM `kost` WHERE nama = '$nama_kost'");

if ($deleteData) {
    // menghapus gambar
    $deleteGambar = mysqli_query($conn, "DELETE FROM gambar_kost WHERE nama_kost = '$nama_kost'");
    if ($deleteGambar) {
        $_SESSION['status-info'] = "Data Berhasil Dihapus";
    } else {
        $_SESSION['status-fail'] = "Data Gagal Dihapus";
    }
    
}

header("Location:../../dataKost.php");

?>