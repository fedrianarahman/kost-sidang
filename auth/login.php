<?php
session_start();
include '../controller/conn.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $cekDataUser = mysqli_query($conn, "SELECT user.id AS id_user, user.nama AS nama_user, user.email AS email_user, user.no_telpon AS no_hp_user, user.photo AS photo_user, user.username AS username_user, user.password AS password_user,user.created_at AS created_at ,user.alamat AS alamat,role.nama_role AS role_user FROM user INNER JOIN role ON role.id = user.role_id WHERE user.role_id  = 3");

    $loggedIn = false; // Flag untuk menandakan status login

    while ($result = mysqli_fetch_array($cekDataUser)) {
        if ($username == $result['username_user'] && $password == $result['password_user']) {
            $loggedIn = true;
            $_SESSION['nama'] = $result['nama_user'];
            $_SESSION['user_id'] = $result['id_user'];
            $_SESSION['email'] = $result['email_user'];
            $_SESSION['alamat'] = $result['alamat'];
            $_SESSION['no_hp'] = $result['no_hp_user'];
            $_SESSION['level'] = $result['role_user'];
            $_SESSION['username'] = $result['username_user'];
			$_SESSION['password'] = $result['password_user'];
			$_SESSION['photo'] = $result['photo_user'];
			$_SESSION['joined_at'] = $result['created_at'];
            break; // Keluar dari loop jika data ditemukan
        }
    }
    
    if ($loggedIn) {
        header("Location: ../profileUser.php");
        exit();
    } else {
        $_SESSION['status-fail'] = "username/password Salah";
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
										<img src="../assets/img/logo.png" alt="">
									</div>
                                    <h4 class="text-center mb-4">Sign in your account</h4>
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
                                            <label class="mb-1"><strong>Username</strong></label>
                                            <input type="text" class="form-control" name="username">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn  btn-custom" name="login" style="width: 100%;">Log In</button>
                                        </div>
                                    </form>
                                    <div class="new-account">
                                        <p>Don't have an account? <a class="text-sign-up" href="./regist.php">Sign up</a></p>
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
    <script src="../../admin/vendor/global/global.min.js"></script>
	<script src="../../admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="../../admin/js/custom.min.js"></script>
	<script src="../../admin/js/deznav-init.js"></script>
    <script src="../../admin/js/demo.js"></script>
    <script src="../../admin/js/styleSwitcher.js"></script>
</body>
</html>