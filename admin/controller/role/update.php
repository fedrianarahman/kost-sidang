<?php
session_start();
include '../conn.php';

$id = $_POST['id'];
$role = trim(strtolower($_POST['role']));
$created_at = $_POST['created_at'];
$updated_at = date('Y-m-d H:i:s');

// mengupdate data
$updateData = mysqli_query($conn, "UPDATE `role` SET `nama_role`='$role',`created_at`='$created_at',`updated_at`='$updated_at' WHERE `id`='$id'");

if ($updateData) {
    $_SESSION['status-info'] = "Data Berhasil Dirubah";
} else {
    $_SESSION['status-fail'] = "Data Tidak Berhasil dirubah";
}

header("Location:../../dataRole.php");

?>