<?php
session_start();
include './controller/conn.php';
// Cek apakah sesi login telah diatur
if (!isset($_SESSION['nama'])) {
    header("Location: ./auth/login.php");
    exit();
}
$idPesanan = $_GET['id_pemesanan'];
$nama_kamar = $_GET['nama_kost'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
    <meta name="keywords" content="">
	<meta name="author" content="">
	<meta name="robots" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="Zenix - Crypto Admin Dashboard">
	<meta property="og:title" content="Zenix - Crypto Admin Dashboard">
	<meta property="og:description" content="Zenix - Crypto Admin Dashboard">
	<meta property="og:image" content="https://zenix.dexignzone.com/xhtml/social-image.png">
	<meta name="format-detection" content="telephone=no">
    <title>Zenix - Crypto Admin Dashboard </title>
    <!-- Favicon icon -->
    <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
	<link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<style>
        .img-bukti-tf {
    height: 200px;
    max-width: 200px;
    background: #000;
    position: relative;
    overflow: hidden;
}

.img-bukti-tf img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.modal-body img{
    width: 100%;
    margin-right: 500px;
}
    </style>
</head>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <?php include './include/navHeader.php'?>
        <!--**********************************
            Nav header end
        ***********************************-->
		
		<!--**********************************
            Header start
        ***********************************-->
       <?php include './include/navbar.php'?>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <?php
        include './include/sidebar.php';
        ?>
        <!--**********************************
            Sidebar end
        ***********************************-->
		
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
			<div class="container-fluid">
               <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                           <?php
                           $getdataPemesanan = mysqli_query($conn, "SELECT tb_pemesanan.id AS id_pemesanan,tb_pemesanan.nama_pemesan AS nama_pemesan,tb_pemesanan.email_pemesan AS email_pemesan,tb_pemesanan.total_bulan_sewa AS total_bulan_sewa,tb_pemesanan.harga_kost AS harga_kost,tb_pemesanan.no_hp_pemesan AS no_hp_pemesan,tb_pemesanan.tgk_dari AS tgk_dari,tb_pemesanan.tgl_hingga AS tgl_hingga,tb_pemesanan.nama_kost AS nama_kost,tb_pemesanan.jumlah AS jumlah,tb_pemesanan.sisa_bayar AS sisa_bayar,tb_pemesanan.bukti_tf AS bukti_tf,tb_pemesanan.asal_bank AS asal_bank,tb_pemesanan.nama_pengirim AS nama_pengirim,tb_pemesanan.created_at AS created_at,tb_pemesanan.status_pemesanan AS status_pemesanan,bank.nama_bank AS nama_bank,bank.nama_pemilik AS nama_pemilik FROM tb_pemesanan INNER JOIN bank ON bank.id = tb_pemesanan.via_bank WHERE tb_pemesanan.id = '$idPesanan' ");
                           while ($dataPemesanan = mysqli_fetch_array($getdataPemesanan)) {
                           ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <p>Nama Pemesan : <?php echo $dataPemesanan['nama_pemesan']?></p>
                                </div>
                                <div class="col-md-4">
                                    <p>Email Pemesan : <?php echo $dataPemesanan['email_pemesan']?></p>
                                </div>
                                <div class="col-md-4">
                                    <p>NO HP Pemesan : <?php echo $dataPemesanan['no_hp_pemesan']?></p>
                                </div>
                                <div class="col-md-4">
                                    <p>Tanggal Dari : <?php echo $dataPemesanan['tgk_dari']?></p>
                                </div>
                                <div class="col-md-4">
                                    <p>Tanggal Hingga : <?php echo $dataPemesanan['tgl_hingga']?></p>
                                </div>
                                <div class="col-md-4">
                                    <p>Nama Kamar : <?php echo $dataPemesanan['nama_kost']?></p>
                                </div>
                                <div class="col-md-4">
                                    <p>Harga Kamar : Rp. <?php echo number_format($dataPemesanan['harga_kost'], 0, ',', '.')?> / bulan</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Lama Sewa : <?php echo $dataPemesanan['total_bulan_sewa']?> bulan</p>
                                    
                                </div>

                                <div class="col-md-4">
                                    <p class="font-weight-bold">Total Bayar : Rp. <?php $totalBayar = $dataPemesanan['harga_kost'] * $dataPemesanan['total_bulan_sewa'];
                                    echo number_format($totalBayar, 0, ',', '.') ?></p>
                                </div>
                                <div class="col-md-4">
                                    <p class="font-weight-bold">Jumlah Transfer : Rp. <?php echo number_format($dataPemesanan['jumlah'], 0, ',', '.')?></p>
                                </div>
                                <div class="col-md-4">
                                    <p class="font-weight-bold">Sisa Bayar : Rp. <?php echo  number_format($dataPemesanan['sisa_bayar'], 0, ',', '.')?></p>
                                </div>
                                <div class="col-md-4">
                                    <p class="mb-2 font-weight-bold">Bukti Transfer :</p>
                                    <a href="" data-toggle="modal" data-target="#exampleModalCenter">
                                    <div class="img-bukti-tf mb-2">
                                    <img src="./images/image-content/<?php echo $dataPemesanan['bukti_tf']?>" alt="">
                                    </div>
                                    </a>
                                         <!-- Modal -->
                                    <div class="modal fade" id="exampleModalCenter">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <img src="./images/image-content/<?php echo $dataPemesanan['bukti_tf']?>" alt="">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-4">
                                    <p >Akun Bank Yang Dituju : <span class="font-weight-bold"><?php echo  $dataPemesanan['nama_bank']?>/<?php echo  $dataPemesanan['nama_pemilik']?></span> </p>
                                </div>
                                <div class="col-md-4">
                                    <p >Asal Bank : <span class="font-weight-bold"><?php echo  $dataPemesanan['asal_bank']?></span> </p>
                                </div>
                                <div class="col-md-4">
                                    <p >Nama Pengirim : <span class="font-weight-bold"><?php echo  $dataPemesanan['nama_pengirim']?></span> </p>
                                </div>
                                <div class="col-md-4">
                                    <p>Tanggal Pemesanan : <?php echo $dataPemesanan['created_at']?></p>
                                </div>
                                <div class="col-md-4">
                                    <p>Status Pemesanan : <span class=" <?php if ($dataPemesanan['status_pemesanan']=='P') {
                                        echo 'badge light badge-warning';
                                    } else {
                                        echo 'badge light badge-success';
                                    }
                                     ?>"><?php if ($dataPemesanan['status_pemesanan']=='P') {
                                        echo 'Pending';
                                    } else {
                                        echo 'Acepted';
                                    }
                                     ?></span></p>
                                    <a href="./controller/pemesanan/updateStatus.php?id=<?php echo $dataPemesanan['id_pemesanan']?>&nama_kost=<?php echo $dataPemesanan['nama_kost']?>" class="btn btn-primary btn-sm">Konfirmasi Pemesanan</a>
                                </div>
                            </div>
                           <?php }?>
                        </div>
                    </div>
                </div>
               </div>
			</div>
		</div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        <?php include './include/footer.php' ?>
        <!--**********************************
            Footer end
        ***********************************-->
		
		
		
		
		
		<!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="vendor/global/global.min.js"></script>
	<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <!-- Datatable -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins-init/datatables.init.js"></script>
    <script src="js/custom.min.js"></script>
	<script src="js/deznav-init.js"></script>
    <script src="js/demo.js"></script>
    <script src="js/styleSwitcher.js"></script>

</body>
</html>