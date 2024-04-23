<?php
require_once "network/koneksi.php";
?>

<main class="content">
				<div class="container-fluid p-0">
					
					<h1 class="h1 mb-3"><strong>Dashboard</strong> Perpustakaan </h1>
					<h3>" Selamat Datang <strong><?= $_SESSION['nama']?></strong> Sebagai <strong><?= $_SESSION['level']?></strong> "</h3>
					<div class="row">
						<div class="col-12">
							<div class="w-100">
							<?php
							if (!empty($_SESSION['level'] === "Admin" || "Petugas")) {
							?>
							<div class="row">
									<div class="col-sm-3">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Total Admin</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="users"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"> 
													<?php
													$query = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM user WHERE Level='admin'");
													$data = mysqli_fetch_array($query);
													echo $data['total'];
													?>
												</h1>
											</div>
										</div>
                                    </div>
                                    <div class="col-sm-3">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Total Anggota</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="user"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">
												<?php
													$query = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM user WHERE Level='Peminjam'");
													$data = mysqli_fetch_array($query);
													echo $data['total'];
													?>
												</h1>
											</div>
										</div>
                                    </div>
                                    <div class="col-sm-3">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Total Buku</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="book-open"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">
												<?php
													$query = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM buku");
													$data = mysqli_fetch_array($query);
													echo $data['total'];
													?>
												</h1>
											</div>
										</div>
                                    </div> 
                                    <div class="col-sm-3">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Pinjaman</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="credit-card"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">
												<?php
													$query = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM peminjaman");
													$data = mysqli_fetch_array($query);
													echo $data['total'];
													?>
												</h1>
											</div>
										</div>
                                    </div> 
								</div>
							<?php
							}
							?>
							</div>
                        </div>
					<div class="row">
						<div class="col-12 col-md-12 col-xxl-9 d-flex order-3 order-xxl-2">
							<div class="card flex-fill w-100">
								<div class="card-header">
									<h5 class="card-title mb-0">Ulasan</h5>
								</div>
								<div class="card-body px-4">
									<br><br>
									<table id="ulasanhome" class="display cell-border">
										<thead>
											<tr>
												<th>No</th>
												<th>Buku</th>
												<th>Nama Pengguna</th>
												<th>Ulasan</th>
												<th>Rating</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$queryulasn = mysqli_query($koneksi, "SELECT * FROM ulasanbuku INNER JOIN buku ON buku.BukuID=ulasanbuku.BukuID INNER JOIN user ON user.UserID = ulasanbuku.UserID");            
												$i = 1;
												
												while($dataulasan = mysqli_fetch_array($queryulasn)) {
												?>
												<th scope="row"><?= "$i"; $i++?></th>
												<td><?= $dataulasan['Judul']?></td>
												<td><?= $dataulasan['NamaLengkap']?></td>
												<td><?= $dataulasan['Ulasan']?></td>
												<td><?= $dataulasan['Rating']?></td>
												<?php
												}
											?>
											<script>
												let table = new DataTable('#ulasanhome');
											</script>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-1">
							<div class="card flex-fill">
								<div class="card-header">

									<h5 class="card-title mb-0">Calendar</h5>
								</div>
								<div class="card-body d-flex">
									<div class="align-self-center w-100">
										<div class="chart">
											<div id="datetimepicker-dashboard"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>