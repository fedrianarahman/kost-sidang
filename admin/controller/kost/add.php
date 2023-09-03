<?php
session_start();
include '../conn.php';

$nama_kost = trim(strtolower($_POST['nama_kamar']));
$deskripsi_kamar = $_POST['deskripsi_kamar'];
$harga_kamar = $_POST['harga_kamar'];
$fasilitas = $_POST['fasilitas_id'];
$jumlahFasilitas= $_POST['jumlah_fasilitas'];
$created_at = date('Y-m-d H:i:s');
$status = "Y";
$latitude = "-6.8888033";
$longitude = "107.6197685";
// mengecek data Kamar
$cek = mysqli_query($conn, "SELECT * FROM kost WHERE nama = '$nama_kost'");
$r = mysqli_fetch_array($cek);

// $photo = $_FILES['photo'];
if ($r) {
    $_SESSION['status-fail'] = "Kamar Kost Sudah Tersedia";
} else {
    $isDataInserted = true; // Flag untuk menandakan apakah data telah berhasil dimasukkan

    for ($i = 0; $i < count($fasilitas); $i++) {
        $current_fasilitas_id = $fasilitas[$i];
        $current_jumlahFasilitas = $jumlahFasilitas[$i];
        
        // $query = mysqli_query($conn, "INSERT INTO `kost`(`id`, `harga`, `nama`, `tentang_kost`, `fasilitas`, `jumlah_fasilitas`, `status`, `diskon`, `created_at`, `updated_at`) VALUES ('', '$harga_kamar', '$nama_kost', '$deskripsi_kamar', '$current_fasilitas_id', '$current_jumlahFasilitas', '$status', '0', '$created_at', '$created_at')");

        $query = mysqli_query($conn, "INSERT INTO `kost`(`id`, `harga`, `nama`, `tentang_kost`, `fasilitas`, `jumlah_fasilitas`, `status`, `diskon`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('','$harga_kamar','$nama_kost','$deskripsi_kamar','$current_fasilitas_id','$current_jumlahFasilitas','$status','0','$latitude','$longitude','$created_at','')");

        if (!$query) {
            $isDataInserted = false;
            $_SESSION['status-fail'] = "Data Tidak Berhasil Ditambahkan";
            break; // Keluar dari loop jika ada kesalahan saat memasukkan nilai
        }
    }
    
    if ($isDataInserted) {
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
    
}

header("Location:../../dataKost.php");

?>