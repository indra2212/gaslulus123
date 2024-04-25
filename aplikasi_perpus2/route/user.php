<div class="container-fluid p-0">
		<h1><strong>Anggota</strong></h1>
		<div class="card">
			<div class="card-header">
				<!-- Button Modal  -->
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahuser">
				Tambah Anggota
				</button>
				<!-- Akhir Modal -->
			</div>
			<div class="card-body">
				<table id="anggota" class="display cell-border" >
					<thead>
						<th width=8%>No</th>
						<th>Nama Lengkap</th>
						<th>Username</th>
						<th>Email</th>
						<th>Alamat</th>
                        <th>Status</th>
						<th width=18%>Action</th>
					</thead>
					<tbody>
					<?php
					$i = 1;
					$query = mysqli_query($koneksi,"SELECT * FROM user");
					while ($data = mysqli_fetch_array($query)) {	
                        $_SESSION['nm'] = $data['NamaLengkap'];
                        $_SESSION['un'] = $data['Username'];
                        $_SESSION['mail'] = $data['Email'];
                        $_SESSION['almt'] = $data['Alamat'];
                        $_SESSION['sts'] = $data['Level'];
                    ?>
						<tr>
							<th scope="row"><?php echo "$i"; $i++?></th>
							<td><?= $_SESSION['nm']?></td>
							<td><?= $_SESSION['un']?></td>
							<td><?= $_SESSION['mail']?></td>
							<td><?= $_SESSION['almt']?></td>
							<td><?= $_SESSION['sts']?></td>
							<td>
								<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edituser<?= $data['UserID']?>"><strong><i class="align-middle" data-feather="edit"></i> Edit</strong></button>
                            	<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapususer<?= $data['UserID']?>"><strong><i class="align-middle" data-feather="trash"></i> Hapus</strong></button>
                        	</td>

						</tr>
						<!-- Edit Modal -->
						<div class="modal fade" id="edituser<?= $data['UserID']?>" tabindex="-1" aria-labelledby="edituserLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h1 class="modal-title" id="edituserLabel"><strong>Edit User</strong></h1>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<form method="post" action="route/action/controller.php">
									<div class="modal-body">
										<div class="mb-3">
											<input type="hidden" name="iduser" value="<?=$data['UserID']?>">
											<label class="form-label">Nama Lengkap</label>
											<input class="form-control form-control-lg" type="text" name="nama" value="<?=$_SESSION['nm']?>" required />
										</div>
										<div class="mb-3">
											<label class="form-label">Usename</label>
											<input class="form-control form-control-lg" type="text" name="username" value="<?=$_SESSION['un']?>" required />
										</div>
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="text" name="email" value="<?=$_SESSION['mail']?>" required />
										</div>
										<div class="mb-3">
											<label class="form-label">Alamat</label>
											<input class="form-control form-control-lg" type="text" name="alamat" value="<?=$_SESSION['almt']?>" required />
										</div>
										<div class="mb-3">
											<label class="form-label">Status</label>
											<input class="form-control form-control-lg" type="text" name="status" value="<?=$_SESSION['sts']?>" required />
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
										<button type="submit" class="btn btn-success" name="edituser">Simpan</button>
									</div>
									</form>
								</div>
							</div>
						</div>
						<!-- Akhir Modal -->
						<!-- Hapus Modal -->
						<div class="modal fade" id="hapususer<?= $data['UserID']?>" tabindex="-1" aria-labelledby="hapususerLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h1 class="modal-title" id="hapususerLabel"><strong>Hapus User</strong></h1>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<form method="post" action="route/action/controller.php">
										<div class="modal-body">
											<input type="hidden" name="iduser" value="<?= $data['UserID']?>">
											<div class="row">
												<p>Apakah Anda yakin ingin menghapus akun <?= $_SESSION['nm']?>?</p>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
											<button type="submit" class="btn btn-danger" name="hapususer">Hapus</button>
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
			<div class="modal fade" id="tambahuser" tabindex="-1" aria-labelledby="tambahuserLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title" id="tambahuserLabel"><strong>Tambah User</strong></h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form method="post" action="route/action/controller.php">
						<div class="modal-body">
							<div class="mb-3">
								<input type="hidden" name="iduser" value="">
								<label class="form-label">Nama Lengkap</label>
								<input class="form-control form-control-lg" type="text" name="nama" required />
							</div>
							<div class="mb-3">
								<label class="form-label">Username</label>
								<input class="form-control form-control-lg" type="text" name="username" required />
							</div>
							<div class="mb-3">
								<label class="form-label">Email</label>
								<input class="form-control form-control-lg" type="text" name="email" required />
							</div>
							<div class="mb-3">
								<label class="form-label">Alamat</label>
								<input class="form-control form-control-lg" type="text" name="alamat" required />
							</div>
							<div class="mb-3">
								<label class="form-label">Status</label>
								<select name="status" class="form-select">
                                    <option value="admin">Admin</option>
                                    <option value="petugas">Petugas</option>
                                    <option value="anggota">Anggota</option>
                                </select>
							</div>
							<div class="mb-3">
								<label class="form-label">Password</label>
								<input class="form-control form-control-lg" type="text" name="password" required />
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
							<button type="submit" class="btn btn-success" name="tambahuser">Simpan</button>
						</div>
					</form>
                    </div>
				</div>
			</div>
			<!-- Akhir Modal -->
		</div>
	</div>
<script>
	let table = new DataTable('#anggota')
</script>
