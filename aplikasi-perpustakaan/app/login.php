<?php
include "../network/koneksi.php";
if (isset($_POST['username_email'])) {
	$email = $_POST['username_email'];
	$password = md5($_POST['password']);

	if (empty($email) || empty($password)) {
		echo '<script>alert("Form Login Belum Di Isi"); location.href="login.php";</script>';
	}else { 
		$query = mysqli_query($koneksi, "SELECT * FROM user WHERE (Email='$email' OR Username='$email' ) AND Password='$password'");
		$data = mysqli_num_rows($query);
		$data1 = mysqli_fetch_array($query);

		if ($data === 1) {
			$_SESSION['user'] = $data1;
			echo '<script>alert("Anda Berhasil Login"); location.href="../index.php";</script>';
		}else {
			echo '<script>alert("Username atau Password Salah"); location.href="login.php";</script>';
		}
	}
}
if (!empty($_SESSION['user'])) {
	header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="asset/img/icons/icon-48x48.png" />
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

	<title>Perpustakaan | Login</title>

	<link href="../asset/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h1"><strong>Login</strong></h1>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-3">
									<form method="post">
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="text" name="username_email" placeholder="Masukan Email" />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
												<div class="input-group">
													<input type="password" id="password" name="password" class="form-control">
													<span class="input-group-text" id="toggle-password">
													<i data-feather="eye"></i>
													</span>
												</div>
											</div>
											<script>
                                                    $(document).ready(function() {
                                                        $('#toggle-password').click(function() {
                                                            var passwordField = $('#password');
                                                            var icon = $(this).find('i');

                                                            if (passwordField.attr('type') === 'password') {
                                                                passwordField.attr('type', 'text');
                                                                icon.attr('data-feather', 'eye-off');
                                                            } else {
                                                                passwordField.attr('type', 'password');
                                                                icon.attr('data-feather', 'eye');
                                                            }

                                                            feather.replace();
                                                        });
                                                    });
                                                </script>
										<div>
										</div>
										<div class="d-grid gap-2 mt-3">
											<button class="btn btn-lg btn-primary">Login</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="text-center mb-3">
						<a href="daftar.php">Daftar</a> Menjadi Peminjam
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="../asset/js/app.js"></script>

</body>

</html>