<?php
session_start();
include '../controller/conn.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $cekDataUser = mysqli_query($conn, "SELECT user.id AS id_user, user.nama AS nama_user, user.email AS email_user, user.no_telpon AS no_hp_user, user.photo AS photo_user, user.username AS username_user, user.password AS password_user,user.created_at AS created_at ,role.nama_role AS role_user,role.id AS id_role FROM user INNER JOIN role ON role.id = user.role_id WHERE user.role_id != 3");

    $loggedIn = false; // Flag untuk menandakan status login

    while ($result = mysqli_fetch_array($cekDataUser)) {
        if ($username == $result['username_user'] && $password == $result['password_user']) {
            $loggedIn = true;
            $_SESSION['id_user'] = $result['id_user'];
            $_SESSION['nama'] = $result['nama_user'];
            $_SESSION['email'] = $result['email_user'];
            $_SESSION['no_hp'] = $result['no_hp_user'];
            $_SESSION['level'] = $result['role_user'];
            $_SESSION['username'] = $result['username_user'];
			$_SESSION['password'] = $result['password_user'];
			$_SESSION['photo'] = $result['photo_user'];
			$_SESSION['joined_at'] = $result['created_at'];
            $_SESSION['id_role'] = $result['id_role'];
            break; // Keluar dari loop jika data ditemukan
        }
    }
    
    if ($loggedIn) {
        header("Location: ../index.php");
        exit();
    } else {
        $error = true;
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
	<link href="../vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

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
										<img src="../../assets/img/logo.png" alt="">
									</div>
                                    <h4 class="text-center mb-4">Sign in your account</h4>
                                    <?php
                                    if (isset($error)) : ?>
                                        <p style="color:red; font-style: italic; text-align: center;">username / password salah </p>

                                    <?php endif; ?>
                                    <form method="POST">
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Username</strong></label>
                                            <input type="ext" class="form-control" name="username">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                        <!-- <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                               <div class="custom-control custom-checkbox ml-1">
													<input type="checkbox" class="custom-control-input" id="basic_checkbox_1">
													<label class="custom-control-label" for="basic_checkbox_1">Remember my preference</label>
												</div>
                                            </div>
                                            <div class="form-group">
                                                <a href="page-forgot-password.html">Forgot Password?</a>
                                            </div>
                                        </div> -->
                                        <div class="text-center">
                                            <button type="submit" name="login" class="btn btn-primary btn-block">Sign Me In</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <!-- <p>Don't have an account? <a class="text-primary" href="page-register.html">Sign up</a></p> -->
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
    <script src="../vendor/global/global.min.js"></script>
	<script src="../vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="../js/custom.min.js"></script>
	<script src="../js/deznav-init.js"></script>
    <script src="../js/demo.js"></script>
    <script src="../js/styleSwitcher.js"></script>
</body>
</html>