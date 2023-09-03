<?php
session_start();
include '../conn.php';

$nama_kost = trim(strtolower($_POST['nama_kamar']));
$namaKostForUpdate = trim(strtolower($_POST['nama_kamar_update']));
$deskripsi_kamar = $_POST['deskripsi_kamar'];
$harga_kamar = $_POST['harga_kamar'];
$fasilitas = $_POST['fasilitas_id'];
$jumlahFasilitas = $_POST['jumlah_fasilitas'];
$status = $_POST['status'];
$created_at = date('Y-m-d H:i:s');
$updated_at = date('Y-m-d H:i:s');

$isDataInserted = true; // Flag untuk menandakan apakah data telah berhasil dimasukkan

for ($i = 0; $i < count($fasilitas); $i++) {
    $current_fasilitas_id = $fasilitas[$i];
    $current_jumlahFasilitas = $jumlahFasilitas[$i];
    
    $query = mysqli_query($conn, "UPDATE `kost` SET `harga`='$harga_kamar',`nama`='$nama_kost',`tentang_kost`='$deskripsi_kamar',`fasilitas`='$current_fasilitas_id',`jumlah_fasilitas`='$current_jumlahFasilitas',`status`='$status',`updated_at`='$updated_at' WHERE nama = '$namaKostForUpdate'");

    if (!$query) {
        $isDataInserted = false;
        $_SESSION['status-fail'] = "Data Tidak Berhasil Ditambahkan";
        break; // Keluar dari loop jika ada kesalahan saat memasukkan nilai
    }
}

if ($isDataInserted) {
    // Cek apakah ada file gambar yang dipilih
    if ($_FILES['photo']['name']) {
        $fileCount = count($_FILES['photo']['name']);
    
        for ($i = 0; $i < $fileCount; $i++) {
            $filename = $_FILES['photo']['name'][$i];
            $tmpname = $_FILES['photo']['tmp_name'][$i];
    
            // Membuat ID unik menggunakan fungsi time()
            $uniqueId = time();
    
            // Menambahkan ID unik ke nama file
            $filenameWithId = $uniqueId . '_' . $filename;
    
            // Pindahkan gambar ke direktori yang diinginkan
            $destination = "../../images/imageKost/" . $filenameWithId;
            move_uploaded_file($tmpname, $destination);
    
            // Insert nama file gambar ke dalam tabel kost
            $queryImage = mysqli_query($conn, "INSERT INTO `gambar_kost`(`id`, `photo_kost`, `nama_kost`, `created_at`, `updated_at`) VALUES ('', '$filenameWithId', '$nama_kost', '$created_at', '')");
    
            if (!$queryImage) {
                $_SESSION['status-fail'] = "Gagal memasukkan gambar";
                break; // Keluar dari loop jika ada kesalahan saat memasukkan gambar
            } else {
                $_SESSION['status-info'] = "Data Berhasil Ditambahkan";
            }
        }
    } 
}else {
    // jika tidak ada photo
    $updatePhoto = mysqli_query($conn, "UPDATE `gambar_kost` SET `nama_kost`='$nama_kost',`updated_at`='$updated_at' WHERE nama_kost = '$namaKostForUpdate'");
    if ($updatePhoto) {
        $_SESSION['status-info'] = "Data Berhasil Dirubah";
    } else {
        $_SESSION['status-fail'] = "Data Tidak Berhasil Dirubah";
    }
}

header("Location:../../dataKost.php");

?>