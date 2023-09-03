<?php
session_start();
include '../conn.php';

$idPenyewa = $_GET['id_pemesanan'];
$namaKost = $_GET['nama_kost'];

$deleteData  = mysqli_query($conn, " DELETE FROM  tb_pemesanan WHERE id = '$idPenyewa'");

if ($deleteData) {
    $_SESSION['status-info'] = "Data Berhasil Dihapus";
} else {
    $_SESSION['status-fail'] = "Data Tidak Berhasil Dihapus";
}

header("Location:../../dataPemesanan.php");
?>