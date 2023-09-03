<?php
session_start();
include '../conn.php';

$id = $_GET['id_pemesanan'];

$deleteData = mysqli_query($conn, "DELETE FROM tb_pemesanan WHERE id = '$id'");

if ($deleteData) {
    $_SESSION['status-info'] = "Pesanan Berhasil Dibatalkan";
} else {
    $_SESSION['status-fail'] = "Pesanan Gagal Dibatalkan";
}

header("Location:../../myHistory.php");