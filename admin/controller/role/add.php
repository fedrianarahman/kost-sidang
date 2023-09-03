<?php
session_start();
include '../conn.php';

$role = trim(strtolower($_POST['role']));
$created_at = date('Y-m-d H:i:s');

// cek data
$cek = mysqli_query($conn, "SELECT * FROM role WHERE nama_role = '$role'");
$r = mysqli_fetch_array($cek);

if ($r) {
    $_SESSION['status-fail'] = "Nama Role Sudah Ada";
} else {
    $query = mysqli_query($conn, "INSERT INTO `role`(`id`, `nama_role`, `created_at`, `updated_at`) VALUES ('','$role','$created_at','')");
    
    if ($query) {
        $_SESSION['status-info'] = "Data Berhasil Ditambahkan";
    } else {
        $_SESSION['status-fail'] = "Data Gagal Ditambahkan";
    }
    
}

header("Location:../../dataRole.php");
?>