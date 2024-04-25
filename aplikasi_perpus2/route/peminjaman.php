<div class="container-fluid p-0">
		<h1><strong>Peminjaman Buku</strong></h1>
		<div class="card">
			<div class="card-header">
				<!-- Button Modal  -->
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahpeminjaman">
				Tambah Peminjaman
				</button>
				<!-- Akhir Modal -->
			</div>
			<div class="card-body">
				<table id="peminjaman" class="display cell-border" >
					<thead>
						<th width=8%>No</th>
						<th>Nama</th>
						<th>Judul</th>
						<th>Tanggal Peminjaman</th>
						<th>Tanggal Pengembalian</th>
						<th>Status Peminjaman</th>
						<th width=10%>Action</th>
					</thead>
					<tbody>
					<?php
					$i = 1;
					$userid = $_SESSION['id'];
					$query = mysqli_query($koneksi,"SELECT * FROM peminjaman INNER JOIN user ON peminjaman.UserID=user.UserID INNER JOIN buku ON peminjaman.BukuID=buku.BukuID WHERE peminjaman.UserID='$userid'");
					while ($data = mysqli_fetch_array($query)) {
						$_SESSION['namalngkp'] = $data['NamaLengkap'];
                        $_SESSION['judul'] = $data['Judul'];	
                        $_SESSION['tglpinjam'] = $data['TanggalPeminjaman'];	
                        $_SESSION['tglkmbl'] = $data['TanggalPengembalian'];	
                        $_SESSION['status'] = $data['StatusPeminjaman'];	
					?>
						<tr>
							<th scope="row"><?php echo "$i"; $i++?></th>
							<td><?= $_SESSION['namalngkp']?></td>
							<td><?= $_SESSION['judul']?></td>
							<td><?= $_SESSION['tglpinjam']?></td>
							<td><?php if ($_SESSION['status'] == 'Dipinjam') {
								echo 'NULL';
							}else {
								echo date('d-m-Y', strtotime($_SESSION['tglkmbl']));
							}?></td>
							<td><?= $_SESSION['status']?></td>
							<td>
								<?php
								if ($_SESSION['level'] == 'admin') {
								?>
									<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapuspeminjaman<?= $data['PeminjamanID']?>"><strong><i class="align-middle" data-feather="trash"></i> Hapus</strong></button>
								<?php
								} else {
								?>
									<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#kembalikan<?= $data['PeminjamanID']?>"><strong>Kembalikan</strong></button>
								<?php
								}
								?>
                        	</td>

						</tr>
						<!-- Hapus Peminjaman Modal -->
						<div class="modal fade" id="hapuspeminjaman<?= $data['PeminjamanID']?>" tabindex="-1" aria-labelledby="hapuspeminjamanLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h1 class="modal-title" id="hapuspeminjamanLabel"><strong>Hapus Peminjaman</strong></h1>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<form method="post" action="route/action/controller.php">
										<div class="modal-body">
											<input type="hidden" name="idpeminjaman" value="<?= $data['PeminjamanID']?>">
											<div class="row">
												<p>Apakah Anda yakin ingin menghapus histori peminjaman dengan nama <?= $_SESSION['namalngkp']?>?</p>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
											<button type="submit" class="btn btn-danger" name="hapuspeminjaman">Hapus</button>
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
			<!-- Tambah Peminjaman Modal -->
			<div class="modal fade" id="tambahpeminjaman" tabindex="-1" aria-labelledby="tambahpeminjamanLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title" id="tambahpeminjamanLabel"><strong>Tambah Peminjaman</strong></h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form method="post" action="route/action/controller.php">
						<div class="modal-body">
							<div class="mb-3">
								<input type="hidden" name="idanggota" value="<?= $_SESSION['id']?>">
								<label class="form-label">Judul</label>
								<select class="form-select" name="judul">
									<?php
									$kat = mysqli_query($koneksi, "SELECT * FROM kategoribuku_relasi INNER JOIN buku ON kategoribuku_relasi.BukuID=buku.BukuID");
									while ($data1 = mysqli_fetch_array($kat)) {
									?>
									<option value="" hidden>-Pilih Buku-</option>
									<option value="<?= $data1['BukuID']?>"><?= $data1['Judul']?></option>
									<?php
									};
									?>
								</select>
							</div>
                            <div class="mb-3">
								<label class="form-label">Tanggal Peminjaman</label>
								<input type="date" class="form-control form-control-lg" name="tanggalpeminjaman">
								<input type="hidden" class="form-control form-control-lg" name="status" value="Dipinjam">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
							<button type="submit" class="btn btn-success" name="tambahpeminjaman">Simpan</button>
						</div>
					</form>
				</div>
			</div>
			<!-- Akhir Modal -->
		</div>
	</div>
<script>
	let table = new DataTable('#peminjaman')
</script>
