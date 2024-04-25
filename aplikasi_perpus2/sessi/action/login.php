<?php
require_once '../koneksi.php';
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
	<link rel="shortcut icon" href="../../asset/img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-kurnia-comp/" />
	<link rel="stylesheet" href="../../asset/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="../../asset/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<title>Perpustakaan Digital | Login</title>

	<link href="../../asset/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link href="../../asset/css/jquery.dataTables.min.css" rel="stylesheet">
	<script src="../../asset/js/jquery.js"></script>
	<script src="../../asset/js/jquery.dataTables.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert"></script>
</head>

<?php
if (isset($_POST['username_email'])) {
    
    $email = $_POST['username_email'];
    $password = md5($_POST['password']);

    if (empty($email) || empty($password)) {
        echo "<script>
			document.addEventListener('DOMContentLoaded', function() {
				swal('Akses Dilarang!', 'Harap Login Terlebih Dahulu', 'error').then(function() {
					window.location = 'login.php';
				});
			});
		  </script>";
    } else {
        $query = mysqli_query($koneksi, "SELECT * FROM user WHERE (Email='$email' OR Username='$email') AND Password='$password'");
        $data = mysqli_num_rows($query);
        $cek = mysqli_fetch_array($query);

        if ($data === 1) {
            $_SESSION['id'] = $cek['UserID'];
            $_SESSION['email'] = $cek['Email'];
            $_SESSION['nama'] = $cek['NamaLengkap'];
            $_SESSION['alamat'] = $cek['Alamat'];
            $_SESSION['username'] = $cek['Username'];
            $_SESSION['status'] = $cek['Level'];
			$_SESSION['waktulogin'] = time();
            echo "<script>
			document.addEventListener('DOMContentLoaded', function() {
				swal('Berhasil!', 'Selamat Datang Kembali', 'success').then(function() {
					window.location = '../../index.php';
				});
			});
		  </script>";
        } else {
            if (empty($cek)) {
                echo "<script>
				document.addEventListener('DOMContentLoaded', function() {
					swal('Username Atau Password Salah', 'Harap Login Kembali', 'error');
				});
			  </script>";
            } else {
                echo '<script>alert("Password salah");</script>';
            }
        }
    }
}
?>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2"><strong>Login</strong></h1>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-3">
									<form method="post">
										<div class="mb-3">
											<label class="form-label">Email dan Username</label>
											<input class="form-control form-control-lg" type="text" name="username_email" placeholder="Masukan Email Atau Username" required />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Masukan Password" required />
										</div>
										<div class="d-grid gap-2 mt-3">
                                            <button class="btn btn-lg btn-primary">login</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="text-center mb-3">
							Don't have an account? <a href="pages-sign-up.html">Sign up</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="../../asset/js/app.js"></script>

</body>

</html>
