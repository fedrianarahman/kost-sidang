<?php


session_start();
$_SESSION = ['id_role'];
session_unset();
session_destroy();

	header("Location: index.php");
	exit;
 ?>
