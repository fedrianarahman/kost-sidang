<?php
session_start();
include '../conn.php';

$idPemesanan = $_POST['id_pemesanan'];
$photo = upload();
$akunTujuan = $_POST['akun_tujuan'];
$asalBank = $_POST['asal_bank'];
$jumlah = $_POST['jumlah_tf'];
$namaPengirim = $_POST['nama_pengirim'];
$created_at = date('Y-m-d H:i:s');
$hargaKamar = $_POST['jumlah_bayar'];
$cek = mysqli_query($conn, "SELECT * FROM tb_pemesanan WHERE id='$idPemesanan'");
$rpemesanan = mysqli_fetch_array($cek);
$totalBulan = $rpemesanan['total_bulan_sewa'];
$totalBayar = $hargaKamar * $totalBulan;
$sisaBayar = $totalBayar - $jumlah;
$diskon = 50/100;
$resultHarga = $totalBayar  * (1 - $diskon);

// tambahan
$statusPembayaran = "";

if ($jumlah == $hargaKamar) {
    $statusPembayaran = "L";
} else {
    $statusPembayaran = "D";
}



if ($jumlah < $resultHarga) {
    echo '<script>
    alert("Nominal Tidak Sesuai");
    window.location.href = "../../paymentPage.php?id_pemesanan='.$idPemesanan.'";
    </script>';
}elseif($jumlah > $hargaKamar){
    echo '<script>
    alert("Nominal Tidak Sesuai");
    window.location.href = "../../paymentPage.php?id_pemesanan='.$idPemesanan.'";
    </script>';
}
 else {
    // mengupdate data
    $query = mysqli_query($conn, "UPDATE `tb_pemesanan` SET `via_bank` = '$akunTujuan', `nama_pengirim` = '$namaPengirim', `bukti_tf` = '$photo', `jumlah` = '$jumlah', `asal_bank` = '$asalBank', `sisa_bayar` = '$sisaBayar', `status_pemesanan` = 'P', `status_pembayaran` = '$statusPembayaran',`expire_start` = '',`expire_end` = '' WHERE `tb_pemesanan`.`id` = '$idPemesanan'");
    if ($query) {
        header("Location:../../seuccessPaymentPage.php");
        exit();
    } else {
        $_SESSION['status-fail'] = "Jumlah Nominal Tidak Sesuai";
    }
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

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'svg', 'JPG', 'JPEG', 'PNG'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        $_SESSION['status-fail'] = "Yang Anda Upload Bukan Gambar";
        return false;
    }

    // cek ukuran gambar jika terlalu besar

    if ($ukuranFile > 1000000) {
        $_SESSION['status-fail'] = "Ukuran Gambar Terlalu Besar";
        return false;
    }

    // lolos pengecekan
    move_uploaded_file($tmpName, "../../admin/images/image-content/" . $namaFile);

    return $namaFile;
}
?>

?>