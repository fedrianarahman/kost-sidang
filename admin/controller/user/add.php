<?php
session_start();
include '../conn.php';

$nama = trim(strtolower($_POST['nama']));
$email = $_POST['email'];
$no_hp = $_POST['no_telpon'];
$role = $_POST['role'];
$username = $_POST['username'];
$password = $_POST['password'];
$created_at = date('Y-m-d H:i:s');

// cek data
$cek = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
$r = mysqli_fetch_array($cek);

if ($r) {
    $_SESSION['status-fail'] = "Username Sudah Ada";
} else {
    $query = mysqli_query($conn, "INSERT INTO `user`(`id`, `nama`, `email`, `no_telpon`, `role_id`, `username`, `password`, `created_at`, `updated_at`) VALUES ('','$nama','$email','$no_hp','$role','$username','$password','$created_at','')");
    
    if ($query) {
        $_SESSION['status-info'] = "Data Berhasil Ditambahkan";
    } else {
        $_SESSION['status-fail'] = "Data Gagal Ditambahkan";
    }
    
}

header("Location:../../dataUser.php");
?>