<?php
session_start();
include '../conn.php';

$userId = $_POST['user_id'];
$namaKamar = $_POST['nama_kost'];
$hargaKamar = $_POST['harga_kost'];
$namaPenyewa = $_POST['nama_penyewa'];
$emailPenyewa = $_POST['email_penyewa'];
$noHpPenyewa = $_POST['no_hp_penyewa'];
$sewaDari = $_POST['sewa_dari'];
$sewaHingga = $_POST['sewa_hingga'];
$created_at = date('Y-m-d H:i:s');
$statusPemesanan = "Y";
$totalBulan = 1;
// tambahan
date_default_timezone_set('Asia/Jakarta'); // Atur zona waktu ke WIB (Waktu Indonesia Bagian Barat)
$expireTime = date(" Y-m-d H:i:s");
$satuJamDariSekarang =  date(" Y-m-d H:i:s", strtotime("+1 hour"));
// end tambahan
$selisih_detik = strtotime($sewaDari) - strtotime($sewaHingga);

$jumlahTotalHari = $selisih_detik / (60 * 60 * 24); // Menghitung jumlah total hari
$validDay = abs($jumlahTotalHari);
if ($validDay > 31) {
    $totalBulan++; // Menghitung jumlah bulan dengan pembulatan ke atas
}

// Mengubah format tanggal menjadi format yang cocok untuk query SQL
$sewaDariSQL = date('Y-m-d', strtotime($sewaDari));
$sewaHinggaSQL = date('Y-m-d', strtotime($sewaHingga));

// Query untuk mengecek rentang tanggal yang beririsan
$cek = mysqli_query($conn, "SELECT * FROM tb_pemesanan WHERE ('$sewaDariSQL' BETWEEN tgk_dari AND tgl_hingga OR '$sewaHinggaSQL' BETWEEN tgk_dari AND tgl_hingga) AND nama_kost = '$namaKamar' AND status_pemesanan = 'P' ");
$result = mysqli_fetch_array($cek);

// Jika tanggal yang dipilih beririsan dengan tanggal yang sudah ada 
if ($result != null) {
    $_SESSION['status-fail'] = "Kamar Sudah Terpesan";
    header("Location:../../bookingPage.php?nama_kost=$namaKamar&harga_kost=$hargaKamar");
} else {
    // Menambahkan data ke tb_pemesanan
    // $query = mysqli_query($conn, "INSERT INTO `tb_pemesanan`(`id`, `userId`, `nama_pemesan`, `email_pemesan`, `no_hp_pemesan`, `tgk_dari`, `tgl_hingga`, `total_bulan_sewa`,`nama_kost`, `harga_kost`, `via_bank`, `nama_pengirim`, `bukti_tf`, `jumlah`, `asal_bank`, `sisa_bayar`, `status_pemesanan`, `created_at`, `updated_at`) VALUES ('','$userId','$namaPenyewa','$emailPenyewa','$noHpPenyewa','$sewaDari','$sewaHingga','$totalBulan','$namaKamar','$hargaKamar','','','','','','','W','$created_at','')");
    $query = mysqli_query($conn,"INSERT INTO `tb_pemesanan`(`id`, `userId`, `nama_pemesan`, `email_pemesan`, `no_hp_pemesan`, `tgk_dari`, `tgl_hingga`, `total_bulan_sewa`, `nama_kost`, `harga_kost`, `via_bank`, `nama_pengirim`, `bukti_tf`, `jumlah`, `asal_bank`, `sisa_bayar`, `status_pemesanan`, `expire_start`, `expire_end`, `created_at`, `updated_at`) VALUES ('','$userId','$namaPenyewa','$emailPenyewa','$noHpPenyewa','$sewaDari','$sewaHingga','$totalBulan','$namaKamar','$hargaKamar','','','','','','','W','$expireTime','$satuJamDariSekarang','$created_at','')");
    $idPemesanan = mysqli_insert_id($conn);
    if ($query) {
        $_SESSION['status-info'] = "Silahkan Lakukan Pembayaran";
        $_SESSION['id_pemesanan'] = $idPemesanan;
        $_SESSION['harga'] = $hargaKamar;
        header("Location:../../paymentPage.php?id_pemesanan=$idPemesanan");
    }
}

?>