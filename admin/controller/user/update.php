<?php
session_start();
include '../conn.php';
$id = $_POST['id'];
$created_at = $_POST['created_at'];
$nama = trim(strtolower($_POST['nama']));
$email = $_POST['email'];
$no_hp = $_POST['no_telpon'];
$role = $_POST['role'];
$username = $_POST['username'];
$password = $_POST['password'];
$updated_at = date('Y-m-d H:i:s');

$query = mysqli_query($conn, "UPDATE `user` SET `nama`='$nama',`email`='$email',`no_telpon`='$no_hp',`role_id`='$role',`username`='$username',`password`='$password',`created_at`='$created_at',`updated_at`='$updated_at' WHERE `id`='$id'");

if ($query) {
    $_SESSION['status-info'] = "Data Berhasil Ditambahkan";
} else {
    $_SESSION['status-fail'] = "Data Gagal Ditambahkan";
}


header("Location:../../dataUser.php");
?>