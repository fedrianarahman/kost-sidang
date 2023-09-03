<?php
session_start();
include '../controller/conn.php';

if (isset($_POST['login'])) {
    $nama = trim(strtolower($_POST['nama']));
    $email = $_POST['email'];
    $no_hp = $_POST['no_telpon'];
    $role = 3;
    $username = $_POST['username'];
    $password = $_POST['password'];
    $created_at = date('Y-m-d H:i:s');

    // menambahkan data penyewa
    $query = mysqli_query($conn, "INSERT INTO `user`(`id`, `nama`, `email`, `no_telpon`, `alamat`, `role_id`, `username`, `password`, `photo`, `created_at`, `updated_at`) VALUES ('','$nama','$email','$no_hp','','$role','$username','$password','','$created_at','')");

    if ($query) {
        $_SESSION['status-info'] = "Silahkan Masuk";
        header("Location:./login.php");
    }else{
        $_SESSION['status-fail'] = "Registrasi Gagal";
    }

}
?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
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
    <title>Zenix -  Crypto Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
	<link href="../admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="../admin/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<img src="./assets/img/logo.png" alt="">
									</div>
                                    <h4 class="text-center mb-4">Regist your account</h4>
                                    <?php
                                      if (isset($_SESSION['status-fail'])) {
                                        echo '<div class="alert alert-danger alert-dismissible fade show">
                                        <svg viewbox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                        <strong>Error!</strong> '.$_SESSION['status-fail'].'.
                                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                        </button>
                                    </div>';
                                        unset($_SESSION['status-fail']);
                                    }
                                    ?>
                                    <form method="POST">
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Nama </strong></label>
                                            <input type="text" class="form-control" placeholder="Nama" name="nama" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Email </strong></label>
                                            <input type="email" class="form-control" placeholder="Email" name="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>NO HP</strong></label>
                                            <input type="text" class="form-control" placeholder="NO HP" name="no_telpon" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Username</strong></label>
                                            <input type="text" class="form-control" placeholder="Username" name="username" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" class="form-control" placeholder="Password" name="password" required>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn  btn-custom" style="width: 100%;" name="login">Log In</button>
                                        </div>
                                    </form>
                                    <div class="new-account">
                                        <p>Already have an account? <a class="text-sign-up" href="login.php">Sign up</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
	<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="js/custom.min.js"></script>
	<script src="js/deznav-init.js"></script>
    <script src="js/demo.js"></script>
    <script src="js/styleSwitcher.js"></script>
</body>
</html>