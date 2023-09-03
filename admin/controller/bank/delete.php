<?php
session_start();
include '../conn.php';

$id = $_GET['id'];

// mengahpus data dari parameter id yang dilempar
$deleteData = mysqli_query($conn, "DELETE FROM `bank` WHERE id = '$id'");

if ($deleteData) {
    $_SESSION['status-info'] = "Data Role Berhasil Dihapus";
} else {
    $_SESSION['status-fail'] = "Data Role Tidak Berhasil Dihapus";
}

header("Location:../../dataAkunBank.php");

?>