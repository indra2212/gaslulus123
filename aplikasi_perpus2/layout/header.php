<?php
require_once 'sessi/koneksi.php';
if (empty($_SESSION['email'])) {
	header('location: sessi/action/login.php');
	exit;
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Resposive Perpustakaan &amp; Dashboard Perpustakaan SMK Negeri 3 Metro">
	<meta name="author" content="Kurnia Comp">
	<meta name="keywords" content="web perpus, web terbaik">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="asset/img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-kurnia-comp/" />
	<link rel="stylesheet" href="asset/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="asset/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<title>Perpustakaan Digital | 
		<?php
		$page = isset($_GET['page']) ? $_GET['page'] : 'Dashboard';
		$cek = preg_replace('/-/', ' ', $page);
		$title = ucwords($cek);
		echo $title
		?>
	</title>

	<link href="asset/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link href="asset/css/jquery.dataTables.min.css" rel="stylesheet">
	<link rel="stylesheet" href="asset/css/jquery.rateyo.min.css">
	<script src="asset/js/jquery.js"></script>
	<script src="asset/js/jquery.dataTables.min.js"></script>

	<script src="asset/js/jquery.rateyo.min.js"></script>
	<script src="asset/js/sweetalert.min.js"></script>
</head>