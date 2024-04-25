	<div class="container-fluid p-0">
		<h1><strong>Kategori Buku</strong></h1>
		<div class="card">
			<div class="card-header">
				<!-- Button Modal  -->
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahkategori">
				Tambah Kategori
				</button>
				<!-- Akhir Modal -->
			</div>
			<div class="card-body">
				<table id="kategori" class="display cell-border" >
					<thead>
						<th width=8%>No</th>
						<th>Nama Kategori</th>
						<th width=25%>Action</th>
					</thead>
					<tbody>
					<?php
					$i = 1;
					$query = mysqli_query($koneksi,"SELECT * FROM kategoribuku");
					while ($data = mysqli_fetch_array($query)) {
						$_SESSION['kategori'] = $data['NamaKategori'];	
					?>
						<tr>
							<th scope="row"><?php echo "$i"; $i++?></th>
							<td><?= $_SESSION['kategori']?></td>
							<td>
								<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editkategori<?= $data['KategoriID']?>"><strong><i class="align-middle" data-feather="edit"></i> Edit</strong></button>
                            	<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapuskategori<?= $data['KategoriID']?>"><strong><i class="align-middle" data-feather="trash"></i> Hapus</strong></button>
                        	</td>

						</tr>
						<!-- Edit Kategori Modal -->
						<div class="modal fade" id="editkategori<?= $data['KategoriID']?>" tabindex="-1" aria-labelledby="editkategoriLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h1 class="modal-title" id="editkategoriLabel"><strong>Edit Kategori</strong></h1>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<form method="post" action="route/action/controller.php">
									<div class="modal-body">
										<div class="mb-3">
											<input type="hidden" name="id-kat" value="<?=$data['KategoriID']?>">
											<label class="form-label">Kategori Buku</label>
											<input class="form-control form-control-lg" type="text" name="kategori" value="<?=$_SESSION['kategori']?>" required />
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
										<button type="submit" class="btn btn-success" name="edit-kat">Simpan</button>
									</div>
									</form>
								</div>
							</div>
						</div>
						<!-- Akhir Modal -->
						<!-- Hapus Kategori Modal -->
						<div class="modal fade" id="hapuskategori<?= $data['KategoriID']?>" tabindex="-1" aria-labelledby="hapuskategoriLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h1 class="modal-title" id="hapuskategoriLabel"><strong>Hapus Kategori</strong></h1>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<form method="post" action="route/action/controller.php">
										<div class="modal-body">
											<input type="hidden" name="id-kat" value="<?= $data['KategoriID']?>">
											<div class="row">
												<p>Apakah Anda yakin ingin menghapus kategori <?= $_SESSION['kategori']?>?</p>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
											<button type="submit" class="btn btn-danger" name="hapus-kat">Hapus</button>
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
			<!-- Tambah Kategori Modal -->
			<div class="modal fade" id="tambahkategori" tabindex="-1" aria-labelledby="tambahkategoriLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title" id="exampleModalLabel"><strong>Tambah Kategori</strong></h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form method="post" action="route/action/controller.php">
						<div class="modal-body">
							<div class="mb-3">
								<input type="hidden" name="id-kat" value="">
								<label class="form-label">Kategori Buku</label>
								<input class="form-control form-control-lg" type="text" name="kategori" required />
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
							<button type="submit" class="btn btn-success" name="tambah-kat">Simpan</button>
						</div>
					</form>
				</div>
			</div>
			<!-- Akhir Modal -->
		</div>
	</div>
<script>
	let table = new DataTable('#kategori')
</script>
