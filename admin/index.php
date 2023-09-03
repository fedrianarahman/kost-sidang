<?php
session_start();
include './controller/conn.php';
// Cek apakah sesi login telah diatur
if (!isset($_SESSION['nama'])) {
    header("Location: ./auth/login.php");
    exit();
}

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
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
	<link rel="stylesheet" href="vendor/chartist/css/chartist.min.css">
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
	<link href="vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	
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
				<?php include './include/welcomeBack.php'?>
				<div class="row">
					<div class="col-xl-3 col-sm-6 m-t35">
						<div class="card card-coin">
							<div class="card-body text-center">
							<i class="fa fa-address-book-o " style="font-size: 40px; margin-bottom:10px;"></i>
								<?php
								$getRowDataPemesanan = mysqli_query($conn, "SELECT * FROM tb_pemesanan");
								$cekDataPEmesanan = mysqli_num_rows($getRowDataPemesanan);
								 ?>
								<h2 class="text-black mb-2 font-w600"><?php echo $cekDataPEmesanan ?></h2>
								<p class="mb-0 fs-14">
									
									<a href="dataPemesanan.php"><span class="text-success mr-1">Data Pemesanan</span></a>
								</p>	
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 m-t35">
						<div class="card card-coin">
							<div class="card-body text-center">
							<i class="fa fa-university" style="font-size: 40px; margin-bottom:10px;"></i>
								<?php
								$getDataBank = mysqli_query($conn, "SELECT * FROM bank");
								$dataBank = mysqli_num_rows($getDataBank);
								?>
								<h2 class="text-black mb-2 font-w600"><?php echo $dataBank?></h2>
								<p class="mb-0 fs-13">
									
									<a href="./dataAkunBank.php"><span class="text-success mr-1">Data Akun Bank</span></a>
								</p>	
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 m-t35">
						<div class="card card-coin">
							<div class="card-body text-center">
							<i class="flaticon-381-network" style="font-size: 40px; margin-bottom:10px;"></i>
								<?php
								$getDataFasilitas = mysqli_query($conn, "SELECT * FROM fasilitas");
								$dataFasilitas = mysqli_num_rows($getDataFasilitas);
								?>
								<h2 class="text-black mb-2 font-w600"><?php echo $dataFasilitas ?></h2>
								<p class="mb-0 fs-14">
									
									<a href="./dataFasilitas.php"><span class="text-success mr-1">Data Fasilitas Kost</span></a>
								</p>	
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 m-t35">
						<div class="card card-coin">
							<div class="card-body text-center">
							<i class="fa fa-tasks" style="font-size: 40px; margin-bottom:10px;"></i>
								<?php
								$getDataKost = mysqli_query($conn, "SELECT * FROM kost GROUP BY kost.nama");
								$dataKost = mysqli_num_rows($getDataKost)
								?>
								<h2 class="text-black mb-2 font-w600"><?php echo $dataKost?></h2>
								<p class="mb-0 fs-14">
									
									<a href="./dataKost.php"><span class="text-success mr-1">Data Kamar Kost</span></a>
								</p>	
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
		<?php include './include/footer.php'?>
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
    <!-- Required vendors -->
    <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="vendor/global/global.min.js"></script>
	<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="vendor/chart.js/Chart.bundle.min.js"></script>
	
	<!-- Chart piety plugin files -->
    <script src="vendor/peity/jquery.peity.min.js"></script>
	
	<!-- Apex Chart -->
	<script src="vendor/apexchart/apexchart.js"></script>
	
	<!-- Dashboard 1 -->
	<script src="js/dashboard/dashboard-1.js"></script>
	
	<script src="vendor/owl-carousel/owl.carousel.js"></script>
    <script src="js/custom.min.js"></script>
	<script src="js/deznav-init.js"></script>
    <script src="js/demo.js"></script>
    <script src="js/styleSwitcher.js"></script>

</body>
</html>