<?php
session_start();
include '../conn.php';

$id = $_GET['id'];

$cek = mysqli_query($conn, "SELECT * FROM tb_pemesanan WHERE id = '$id'");
$r = mysqli_fetch_array($cek);
$nama_kost = $r['nama_kost'];
if ($r['status_pemesanan']== 'P') {
    $updateStatus = mysqli_query($conn, "UPDATE `tb_pemesanan` SET `status_pemesanan` = 'A' WHERE `tb_pemesanan`.`id` = $id");


if ($updateStatus) {
    $updateStatusKost = mysqli_query($conn, "UPDATE kost SET status = 'P' WHERE kost.nama = '$nama_kost' ");
    
    if ($updateStatusKost) {
        $_SESSION['status-info'] = "Pemesanan Terkonfirmasi";    
    }else{
        $_SESSION['status-fail'] = "Pemesanan GagalTerkonfirmasi";    
    }
} else {
    $_SESSION['status-fail'] = "Pemesanan GagalTerkonfirmasi";
    
}
}



header("Location:../../dataPemesanan.php");
?>