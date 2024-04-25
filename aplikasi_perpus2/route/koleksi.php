<div class="container-fluid p-0">
		<h1><strong>Koleksi Pribadi </strong></h1>
		<div class="card">
			<div class="card-header">
				<!-- Button Modal  -->
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahkoleksi">
				Tambah Koleksi
				</button>
				<!-- Akhir Modal -->
			</div>
			<div class="card-body">
				<table id="koleksi" class="display cell-border" >
					<thead>
						<th width=8%>No</th>
						<th>Nama Pengguna</th>
						<th>Judul Buku</th>
						<th width=25%>Action</th>
					</thead>
					<tbody>
					<?php
					$i = 1;
                    $userid =$_SESSION['id'];
					$query = mysqli_query($koneksi,"SELECT * FROM koleksipribadi INNER JOIN user ON koleksipribadi.UserID=user.UserID INNER JOIN buku ON koleksipribadi.BukuID=buku.BukuID WHERE koleksipribadi.UserID='$userid'");
					while ($data = mysqli_fetch_array($query)) {
						$_SESSION['nama'] = $data['NamaLengkap'];	
						$_SESSION['judul'] = $data['Judul'];	
					?>
						<tr>
							<th scope="row"><?php echo "$i"; $i++?></th>
							<td><?= $_SESSION['nama']?></td>
							<td><?= $_SESSION['judul']?></td>
							<td>
								<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editkoleksi<?= $data['KoleksiID']?>"><strong><i class="align-middle" data-feather="edit"></i> Edit</strong></button>
                            	<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapuskoleksi<?= $data['KoleksiID']?>"><strong><i class="align-middle" data-feather="trash"></i> Hapus</strong></button>
                        	</td>

						</tr>
						<!-- Edit Kategori Modal -->
						<div class="modal fade" id="editkoleksi<?= $data['KoleksiID']?>" tabindex="-1" aria-labelledby="editkoleksiLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h1 class="modal-title" id="editkoleksiLabel"><strong>Edit Koleksi</strong></h1>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<form method="post" action="route/action/controller.php">
									<div class="modal-body">
										<div class="mb-3">
											<input type="hidden" name="idkoleksi" value="<?=$data['KoleksiID']?>">
											<input type="hidden" name="nama" value="<?=$_SESSION['nama']?>" required />
											<label class="form-label">Judul</label>
                                            <input class="form-control form-control-lg" type="text" name="judul" value="<?=$_SESSION['judul']?>" required>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
										<button type="submit" class="btn btn-success" name="editkoleksi">Simpan</button>
									</div>
									</form>
								</div>
							</div>
						</div>
						<!-- Akhir Modal -->
						<!-- Hapus Kategori Modal -->
						<div class="modal fade" id="hapuskoleksi<?= $data['KoleksiID']?>" tabindex="-1" aria-labelledby="hapuskoleksiLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h1 class="modal-title" id="hapuskoleksiLabel"><strong>Hapus Koleksi</strong></h1>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<form method="post" action="route/action/controller.php">
										<div class="modal-body">
											<input type="hidden" name="idkoleksi" value="<?= $data['KoleksiID']?>">
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
			<div class="modal fade" id="tambahkoleksi" tabindex="-1" aria-labelledby="tambahkoleksiLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title" id="tambahkoleksiLabel"><strong>Tambah Koleksi Pribadi</strong></h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form method="post" action="route/action/controller.php">
						<div class="modal-body">
							<div class="mb-3">
								<input type="hidden" name="idkoleksi" value="">
								<input type="hidden" name="idanggota" value="<?=$_SESSION['id']?>">
								<label class="form-label">Judul Buku</label>
								<select name="buku" class="form-select">
                                    <?php
                                    $query = mysqli_query($koneksi, "SELECT * FROM kategoribuku_relasi INNER JOIN buku ON kategoribuku_relasi.BukuID=buku.BukuID");
                                    while ($data=mysqli_fetch_array($query)) {
                                        $_SESSION['judul'] = $data['Judul'];
                                    ?>
                                    <option value="<?= $data['BukuID']?>"><?= $_SESSION['judul']?></option>
                                    <?php
                                    };
                                    ?>
                                </select>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
							<button type="submit" class="btn btn-success" name="tambahkoleksi">Simpan</button>
						</div>
					</form>
				</div>
			</div>
			<!-- Akhir Modal -->
		</div>
	</div>
<script>
	let table = new DataTable('#koleksi')
</script>
