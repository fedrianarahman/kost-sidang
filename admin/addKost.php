<?php
session_start();
include './controller/conn.php';
// Cek apakah sesi login telah diatur
if (!isset($_SESSION['nama'])) {
    header("Location: ./auth/login.php");
    exit();
}
// $harga_kamar = $_POST['harga_kamar'];
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
                <div class="col-12">
                <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Input Data Kamar Kost</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form method="POST" action="./controller/kost/add.php" enctype="multipart/form-data">
                                       <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Photo Kamar</label>
                                            <input type="file" class="form-control input-default " name="photo[]" multiple >
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Nama Kamar</label>
                                            <input type="text" class="form-control input-default " placeholder="Nama Kamar" name="nama_kamar" >
                                            <!-- lokasi -->
                                            <input type="text" class="form-control input-default " placeholder="Nama Kamar" name="latitude" id="latitude" hidden>
                                            <input type="text" class="form-control input-default " placeholder="Nama Kamar" name="longitude" id="longitude"  hidden>
                                            <!-- end lokasi -->
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Deskripsi Kamar</label>
                                            <input type="text" class="form-control input-default " placeholder="Deskripsi Kamar" name="deskripsi_kamar" >
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Harga Kamar</label>
                                            <input type="number" class="form-control input-default " name="harga_kamar" placeholder="0" name="harga_kamar" >
                                        </div>
                                        </div>
                                        <?php
                                        $getFasilitas = mysqli_query($conn, "SELECT * FROM fasilitas");
                                        while ($dataFasilitas = mysqli_fetch_array($getFasilitas)) {
                                        ?>
                                         <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Fasilitas</label>
                                            <input type="text" class="form-control input-default " placeholder="Nama Kamar" name="fasilitas_id[]" value="<?php echo $dataFasilitas['id'];?>" hidden>
                                            <input type="text" class="form-control input-default font-weight-bold" placeholder="Nama Kamar" name="fasilitas" value="<?php echo $dataFasilitas['nama_fasilitas'];?>" readonly>
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Jumlah Fasilitas</label>
                                            <input type="number" class="form-control input-default " placeholder="0" name="jumlah_fasilitas[]" >
                                        </div>
                                        </div>
                                        <?php }?>
                                       </div>
                                        <a class="btn btn-sm btn-warning text-white" href="./dataKost.php">Kembali</a>
                                        <button class="btn btn-sm btn-primary float-right text-white" name="submit" type="submit">Save</button>
                                    </form>
                                </div>
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
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
    <script>
    // Fungsi untuk menampilkan lokasi pengguna
    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else {
        alert("Geolocation is not supported by this browser.");
      }
    }

    // Fungsi untuk menangkap dan menampilkan latitude dan longitude pada form
    function showPosition(position) {
      var inputLatitude = document.getElementById("latitude");
      var inputLongitude = document.getElementById("longitude");

      // Mendapatkan nilai latitude dan longitude dari objek position
      var latitude = position.coords.latitude;
      var longitude = position.coords.longitude;
        console.log("line 203", latitude);
        console.log("line 204", longitude);
      // Memasukkan nilai latitude dan longitude ke dalam input pada form
      inputLatitude.value = latitude;
      inputLongitude.value = longitude;
    }

    // Panggil fungsi getLocation saat halaman dimuat
    getLocation();
    </script>
</body>
</html>