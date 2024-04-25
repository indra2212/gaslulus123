                <div class="container-fluid p-0">
					<?php
					if ($_SESSION['status'] == 'admin') {
					?>
						<h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>
					<?php
					}
					?>

					<div class="row">
						<div class="col-12">
							<div class="w-100">
								<div class="row">
									<?php
									if ($_SESSION['status'] == 'admin') {
									?>
									<div class="col-sm-3">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Total Buku</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="book"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?php
													$query = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM buku");
													$data = mysqli_fetch_array($query);
													echo $data['total'];
													?></h1>
											</div>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Pengguna</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="users"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?php
													$query = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM user WHERE Level='anggota'");
													$data = mysqli_fetch_array($query);
													echo $data['total'];
													?></h1>
											</div>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Buku Pinjaman</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="book-open"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?php
													$query = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM peminjaman WHERE StatusPeminjaman='dipinjam'");
													$data = mysqli_fetch_array($query);
													echo $data['total'];
													?></h1>
											</div>
										</div>
									</div>
									<?php
									}
									?>
									<div class="card">
										<div class="card-header">
											<h1>Selamat Datang Kembali <strong><?=$_SESSION['nama']?></strong></h1>
										</div>
										<div class="card-body">
											<table class="table">
												<tr>
													<td width=140>Nama Anggota</td>
													<td>:</td>
													<td><strong><?=$_SESSION['nama']?></strong></td>
												</tr>
												<tr>
													<td>Status</td>
													<td>:</td>
													<td><?=$_SESSION['status']?></td>
												</tr>
												<tr>
													<td>Terakhir Login</td>
													<td>:</td>
													<td>
														<?php
														date_default_timezone_set('Asia/Jakarta');
														setlocale(LC_TIME, 'id_ID');

														$hariinggris = date('l');
														$hariindo = [
															'Sunday' => 'Minggu',
															'Monday' => 'Senin',
															'Tuesday' => 'Selasa',
															'Wednesday' => 'Rabu',
															'Thursday' => 'Kamis',
															'Friday' => 'Jumat',
															'Saturday' => 'Sabtu',
														];

														$bulaninggris = date('F');
														$bulanindo = [
															'January' => 'Januari',
															'February' => 'Februari',
															'March' => 'Maret',
															'April' => 'April',
															'May' => 'Mei',
															'June' => 'Juni',
															'July' => 'Juli',
															'Agust' => 'Agustus',
															'September' => 'September',
															'October' => 'Oktober',
															'November' => 'November',
															'December' => 'Desember'
														];

														$hari = $hariindo[$hariinggris];
														$bulan = $bulanindo[$bulaninggris];
														$sekarang = $_SESSION['waktulogin'];
														$tanggal = date('d') . ' ' . $bulan . ' ' . date('Y') . ' ' . date('H:i:s', $sekarang) . ' WIB';
														echo $hari . ', ' . $tanggal;

														?>
													</td>
												</tr>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>