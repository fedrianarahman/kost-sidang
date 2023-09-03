<?php
session_start();
include '../conn.php';

$idUser= $_SESSION['user_id'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];
$alamat = $_POST['alamat'];
$updated_at = date('Y-m-d H:i:s');
$username = $_POST['username'];
$password = $_POST['password'];
// Cek apakah gambar baru dipilih
if (!empty($_FILES['photo']['name'])) {
    $photo = upload();
    if (!$photo) {
        return false;
    }
} else {
    $photo = $_POST['old_photo'];
}
// tambahan

if (!empty($_FILES['photo_ktp']['name'])) {
    $ktp = uploadKTP();
    if (!$ktp) {
        return false;
    }
} else {
    $ktp = $_POST['old_ktp'];
}

$updateData = mysqli_query($conn, "UPDATE `user` SET `nama`='$nama',`email`='$email',`no_telpon`='$no_hp',`alamat`='$alamat',`username`='$username',`password`='$password',`photo`='$photo',`photo_ktp` = '$ktp',`updated_at`='$updated_at' WHERE `id`='$idUser'");

if ($updateData) {
    $_SESSION['status-info'] = "Data Berhasil Dirubah";
} else {
    $_SESSION['status-fail'] = "Data Gagagl Dirubah";
}

function upload()
{
    $namaFile = $_FILES['photo']['name'];
    $ukuranFile = $_FILES['photo']['size'];
    $error =  $_FILES['photo']['error'];
    $tmpName = $_FILES['photo']['tmp_name'];

    if ($error === 4) {
        $_SESSION['status-fail'] = "Pilih Gambar Dulu";
        return false;
    }

    //cek apakah yang diupload Adalah Gambar

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png','svg'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array( $ekstensiGambar,$ekstensiGambarValid)) {
        $_SESSION['status-fail'] = "Yang Anda Upload Bukan Gambar";
        return false;
    }

    // cek ukuran gambar jika terlalu besar

    if ($ukuranFile > 1000000) {
        $_SESSION['status-fail'] = "Ukuran GAmbar Terlalu Besar";
        return false;
    }

    // lolos pengecekan
    move_uploaded_file($tmpName, "../../assets/img/imageProfile/" . $namaFile);

	return $namaFile;
}

function uploadKTP()
{
    $namaFileKTP = $_FILES['photo_ktp']['name'];
    $ukuranFileKTP = $_FILES['photo_ktp']['size'];
    $errorKTP =  $_FILES['photo_ktp']['error'];
    $tmpNameKTP = $_FILES['photo_ktp']['tmp_name'];

    if ($errorKTP === 4) {
        $_SESSION['status-fail'] = "Pilih Gambar Dulu";
        return false;
    }

    //cek apakah yang diupload Adalah Gambar

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png','svg'];
    $ekstensiGambar = explode('.', $namaFileKTP);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array( $ekstensiGambar,$ekstensiGambarValid)) {
        $_SESSION['status-fail'] = "Yang Anda Upload Bukan Gambar";
        return false;
    }

    // cek ukuran gambar jika terlalu besar

    if ($ukuranFileKTP > 1000000) {
        $_SESSION['status-fail'] = "Ukuran GAmbar Terlalu Besar";
        return false;
    }

    // lolos pengecekan
    move_uploaded_file($tmpNameKTP, "../../assets/img/imageKtp/" . $namaFileKTP);

	return $namaFileKTP;
}
header("Location:../../profileUser.php");
?>