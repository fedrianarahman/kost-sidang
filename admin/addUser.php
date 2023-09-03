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
                                <h4 class="card-title">Input Data User</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form method="POST" action="./controller/user/add.php">
                                       <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Nama</label>
                                            <input type="text" class="form-control input-default " placeholder="Name" name="nama" required>
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Email</label>
                                            <input type="email" class="form-control input-default " placeholder="Email" name="email" required>
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>No HP</label>
                                            <input type="text" class="form-control input-default " placeholder="NO HP" name="no_telpon">
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Role</label>
                                            <select name="role" id="role" class="form-control">
                                                <option>Pilih</option>
                                                <?php
                                                $getDataRole = mysqli_query($conn, "SELECT * FROM role");
                                                while ($dataRole = mysqli_fetch_array($getDataRole)) {
                                                ?>
                                                <option value="<?php echo $dataRole['id']?>"><?php echo $dataRole['nama_role']?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Username</label>
                                            <input type="text" class="form-control input-default " placeholder="Username" name="username">
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Password</label>
                                            <input type="password" class="form-control input-default " placeholder="Password" name="password">
                                        </div>
                                        </div>
                                       </div>
                                        <a class="btn btn-sm btn-warning text-white" href="./dataUser.php">Kembali</a>
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

</body>
</html>