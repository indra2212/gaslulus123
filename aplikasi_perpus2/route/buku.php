<div class="container-fluid p-0">
		<h1><strong>Buku</strong></h1>
		<div class="card">
			<div class="card-header">
				<!-- Tambah Buku Modal  -->
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahbuku">
				<strong>Tambah Buku</strong>
				</button>
				<!-- Akhir Modal -->
				<!-- Buku Baru Modal  -->
				<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#bukumasuk">
				<strong>Buku Masuk</strong>
				</button>
				<!-- Akhir Modal -->
				<!-- Buku Baru Modal  -->
				<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#bukurusak">
				<strong>Buku Rusak</strong>
				</button>
				<!-- Akhir Modal -->
			</div>
			<div class="card-body">
				<table id="kategori" class="display cell-border" >
					<thead>
						<th width=8%>No</th>
						<th>Judul</th>
						<th>Kategori</th>
						<th>Penulis</th>
						<th>Penerbit</th>
						<th>Tahun Terbit</th>
						<th>Jumlah</th>
						<th width=25%>Action</th>
					</thead>
					<tbody>
					<?php
					$i = 1;
					$query = mysqli_query($koneksi,"SELECT * FROM kategoribuku_relasi INNER JOIN kategoribuku ON kategoribuku_relasi.KategoriID = kategoribuku.KategoriID INNER JOIN buku ON kategoribuku_relasi.BukuID = buku.BukuID");
					while ($data = mysqli_fetch_array($query)) {
						$_SESSION['judul'] = $data['Judul'];	
						$_SESSION['kategoribuku'] = $data['NamaKategori'];	
						$_SESSION['penulis'] = $data['Penulis'];	
						$_SESSION['penerbit'] = $data['Penerbit'];	
						$_SESSION['tahun'] = $data['TahunTerbit'];	
						$_SESSION['jumlah'] = $data['Jumlah'];	
					?>
						<tr>
							<th scope="row"><?php echo "$i"; $i++?></th>
							<td><?= $_SESSION['judul']?></td>
							<td><?= $_SESSION['kategoribuku']?></td>
							<td><?= $_SESSION['penulis']?></td>
							<td><?= $_SESSION['penerbit']?></td>
							<td><?= $_SESSION['tahun']?></td>
							<td><?= $_SESSION['jumlah']?></td>
							<td>
								<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editbuku<?= $data['KategoriBukuID']?>"><strong><i class="align-middle" data-feather="edit"></i> Edit</strong></button>
                            	<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusbuku<?= $data['KategoriBukuID']?>"><strong><i class="align-middle" data-feather="trash"></i> Hapus</strong></button>
                        	</td>

						</tr>
						<!-- Edit Modal -->
						<div class="modal fade" id="editbuku<?= $data['KategoriBukuID']?>" tabindex="-1" aria-labelledby="editbukuLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h1 class="modal-title" id="editbukuLabel"><strong>Edit Buku</strong></h1>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<form method="post" action="route/action/controller.php">
									<div class="modal-body">
										<div class="mb-3">
											<input type="hidden" name="id-buku" value="<?=$data['BukuID']?>">
											<input type="hidden" name="id-kategori" value="<?=$data['KategoriID']?>">
											<label class="form-label">Judul</label>
											<input class="form-control form-control-lg" type="text" name="judul" value="<?=$_SESSION['judul']?>" required />
										</div>
										<div class="mb-3">
											<label class="form-label">Kategori Buku</label>
											<select class="form-select" name="kategori">
												<?php
												$kat = mysqli_query($koneksi, "SELECT * FROM kategoribuku");
												while ($data1 = mysqli_fetch_array($kat)) {
												?>
												<option value="<?= $data1['KategoriID']?>" selected><?= $data1['NamaKategori']?></option>
												<?php
												};
												?>
											</select>
										</div>
										<div class="mb-3">
											<label class="form-label">Penulis</label>
											<input class="form-control form-control-lg" type="text" name="penulis" value="<?=$_SESSION['penulis']?>" required />
										</div>
										<div class="mb-3">
											<label class="form-label">Penerbit</label>
											<input class="form-control form-control-lg" type="text" name="penerbit" value="<?=$_SESSION['penerbit']?>" required />
										</div>
										<div class="mb-3">
											<label class="form-label">Tahun Terbit</label>
											<input class="form-control form-control-lg" type="text" name="tahun" value="<?=$_SESSION['tahun']?>" required />
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
										<button type="submit" class="btn btn-success" name="edit-buku">Simpan</button>
									</div>
									</form>
								</div>
							</div>
						</div>
						<!-- Akhir Modal -->
						<!-- Hapus Modal -->
						<div class="modal fade" id="hapusbuku<?= $data['KategoriBukuID']?>" tabindex="-1" aria-labelledby="hapusbukuLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h1 class="modal-title" id="hapusbukuLabel"><strong>Hapus Buku</strong></h1>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<form method="post" action="route/action/controller.php">
										<div class="modal-body">
											<input type="hidden" name="id-buku" value="<?= $data['KategoriBukuID']?>">
											<div class="row">
												<p>Apakah Anda yakin ingin menghapus buku <?= $_SESSION['judul']?>?</p>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
											<button type="submit" class="btn btn-danger" name="hapus-buku">Hapus</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- Akhir Modal -->
					<?php
					};?>
					</tbody>
				</table>
			</div>
			<!-- Tambah Modal -->
			<div class="modal fade" id="tambahbuku" tabindex="-1" aria-labelledby="tambahbukuLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title" id="tambahbukuLabel"><strong>Tambah Buku</strong></h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form method="post" action="route/action/controller.php">
						<div class="modal-body">
							<div class="mb-3">
								<input type="hidden" name="id-buku" value="">
								<label class="form-label">Judul Buku</label>
								<input class="form-control form-control-lg" type="text" name="judul" required />
							</div>
							<div class="mb-3">
								<label class="form-label">Kategori Buku</label>
								<select class="form-select" name="kategori">
									<?php
									$kat = mysqli_query($koneksi, "SELECT * FROM kategoribuku");
									while ($data1 = mysqli_fetch_array($kat)) {
									?>
									<option value="" hidden>-Pilih Kategori-</option>
									<option value="<?= $data1['KategoriID']?>"><?= $data1['NamaKategori']?></option>
									<?php
									};
									?>
								</select>
							</div>
							<div class="mb-3">
								<label class="form-label">Penulis</label>
								<input type="text" class="form-control form-control-lg" name="penulis" required>
							</div>
							<div class="mb-3">
								<label class="form-label">Penerbit</label>
								<input type="text" class="form-control form-control-lg" name="penerbit" required>
							</div>
							<div class="mb-3">
								<label class="form-label">Tahun Terbit</label>
								<input type="text" class="form-control form-control-lg" name="terbit" required>
							</div>
							<div class="mb-3">
								<label class="form-label">Jumlah</label>
								<input type="text" class="form-control form-control-lg" name="jumlah" required>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
							<button type="submit" class="btn btn-success" name="tambah-buku">Simpan</button>
						</div>
					</form>
					</div>
				</div>
			</div>
			<!-- Akhir Modal -->
			<!-- Buku Masuk Modal -->
			<div class="modal fade" id="bukumasuk" tabindex="-1" aria-labelledby="bukumasukLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title" id="bukumasukLabel"><strong>Buku Masuk</strong></h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form method="post" action="route/action/controller.php">
						<div class="modal-body">
							<div class="mb-3">
								<label class="form-label">Judul</label>
								<select class="form-select" name="judul">
									<option value="" selected hidden>-Pilih Judul Buku-</option>
									<?php
									$kat = mysqli_query($koneksi, "SELECT * FROM kategoribuku_relasi INNER JOIN buku ON kategoribuku_relasi.BukuID=buku.BukuID");
									while ($data1 = mysqli_fetch_array($kat)) {
									?>
									<option value="<?= $data1['BukuID']?>"><?= $data1['Judul']?></option>
									<?php
									};
									?>
								</select>
							</div>
							<div class="mb-3">
								<label class="form-label">Jumlah Buku</label>
								<input type="text" class="form-control form-control-lg" name="jumlah" required>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
							<button type="submit" class="btn btn-success" name="bukumasuk">Simpan</button>
						</div>
					</form>
					</div>
				</div>
			</div>
			<!-- Akhir Modal -->
			<!-- Buku Rusak Modal -->
			<div class="modal fade" id="bukurusak" tabindex="-1" aria-labelledby="bukurusakLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title" id="bukurusakLabel"><strong>Buku Rusak</strong></h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form method="post" action="route/action/controller.php">
						<div class="modal-body">
							<div class="mb-3">
								<label class="form-label">Judul</label>
								<select class="form-select" name="judul">
									<option value=""selected hidden>-Pilih Judul-</option>
									<?php
									$kat = mysqli_query($koneksi, "SELECT * FROM kategoribuku_relasi INNER JOIN buku ON kategoribuku_relasi.BukuID=buku.BukuID");
									while ($data1 = mysqli_fetch_array($kat)) {
									?>
									<option value="<?= $data1['BukuID']?>"><?= $data1['Judul']?></option>
									<?php
									};
									?>
								</select>
							</div>
							<div class="mb-3">
								<label class="form-label">Jumlah Buku</label>
								<input type="text" class="form-control form-control-lg" name="jumlah" required>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
							<button type="submit" class="btn btn-success" name="bukurusak">Simpan</button>
						</div>
					</form>
					</div>
				</div>
			</div>
			<!-- Akhir Modal -->
		</div>
	</div>
<script>
	let table = new DataTable('#kategori')
</script>
