<?php
session_start();
include '../conn.php';

$idPemesanan = $_GET['id_pemesanan'];

$updatePemesanan = mysqli_query($conn, "UPDATE  tb_pemesanan SET status_pemesanan = 'B' WHERE id = '$idPemesanan'");

if ($updatePemesanan) {
    $_SESSION['status-info'] = "Pesanan Berhasil Dibatalkan";
} else {
    $_SESSION['status-fail'] = "Pesanan Tidak Berhasil Dibatalkan";
}

header("Location:../../myHistory.php");
?>