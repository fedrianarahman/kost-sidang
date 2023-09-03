<?php
session_start();
include '../conn.php';

$id = $_POST['id'];
$namaPemilik = trim(strtolower($_POST['nama_pemilik']));
$noRekening = $_POST['no_rekening'];
$namaBank = $_POST['nama_bank'];
$created_at = $_POST['created_at'];
$updated_at = date('Y-m-d H:i:s');

// Cek apakah gambar baru dipilih
if (!empty($_FILES['photo']['name'])) {
    $photo = upload();
    if (!$photo) {
        return false;
    }
} else {
    $photo = $_POST['old_photo'];
}

$updateDataBank = mysqli_query($conn,"UPDATE `bank` SET `photo`='$photo',`nama_bank`='$namaBank',`nama_pemilik`='$namaPemilik',`no_rek`='$noRekening',`created_at`='$created_at',`updated_at`='$updated_at' WHERE `id`='$id'");

if ($updateDataBank) {
    $_SESSION['status-info'] = "Data Berhasil dimasukan";
} else {
    $_SESSION['status-fail'] = "Data Tidak Berhasil Ditambahkan";
}


function upload (){
    $namaFile = $_FILES['photo']['name'];
    $ukuranFile = $_FILES['photo']['size'];
    $error =  $_FILES['photo']['error'];
    $tmpName = $_FILES['photo']['tmp_name'];

    if ($error === 4) {
        $_SESSION['status-fail'] = "Pilih Gambar Dulu";
        return false;
    }

    //cek apakah yang diupload Adalah Gambar

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png','svg','JPG','JPEG','PNG'];
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
    move_uploaded_file($tmpName, "../../images/image-content/" . $namaFile);

	return $namaFile;

}

header("Location:../../dataAkunBank.php");
?>