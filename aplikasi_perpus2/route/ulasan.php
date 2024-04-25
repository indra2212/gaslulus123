<div class="container-fluid p-0">
		<h1><strong>Ulasan Buku</strong></h1>
		<div class="card">
			<div class="card-header">
				<!-- Button Modal  -->
				<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#tambahulasan">
				<strong>Beri Ulasan</strong>
				</button>
				<!-- Akhir Modal -->
			</div>
			<div class="card-body">
				<table id="ulasan" class="display cell-border" >
					<thead>
						<th width=8%>No</th>
						<th>Username</th>
						<th>Judul Buku</th>
						<th>Ulasan</th>
						<th>Rating</th>
						<th width=25%>Action</th>
					</thead>
					<tbody>
					<?php
					$i = 1;
					$query = mysqli_query($koneksi,"SELECT * FROM ulasanbuku INNER JOIN buku ON ulasanbuku.BukuID=buku.BukuID INNER JOIN user ON ulasanbuku.UserID=user.UserID");
					while ($data = mysqli_fetch_array($query)) {
						$_SESSION['nm'] = $data['NamaLengkap'];
						$_SESSION['jdl'] = $data['Judul'];
						$_SESSION['ulasan'] = $data['Ulasan'];
						$_SESSION['rating'] = $data['Rating'];
					?>
						<tr>
							<th scope="row"><?php echo "$i"; $i++?></th>
							<td><?= $_SESSION['nm']?></td>
							<td><?= $_SESSION['jdl']?></td>
							<td><?= $_SESSION['ulasan']?></td>
							<td>
                                <!-- Tampilkan Rating dengan Bintang RateYo -->
                                <div id="ratingDisplay<?= $data['UlasanID'] ?>"></div>
                                <script>
                                    $(function () {
                                        $("#ratingDisplay<?= $data['UlasanID'] ?>").rateYo({
                                            rating: <?= $_SESSION['rating'] ?>,
                                            readOnly: true,
                                            starWidth: "20px"
                                        });
                                    });
                                </script>
                            </td>
							<td>
                            	<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusulasan<?= $data['UlasanID']?>"><strong><i class="align-middle" data-feather="trash"></i> Hapus</strong></button>
                        	</td>

						</tr>
						<!-- Hapus Kategori Modal -->
						<div class="modal fade" id="hapusulasan<?= $data['UlasanID']?>" tabindex="-1" aria-labelledby="hapusulasanLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h1 class="modal-title" id="hapusulasanLabel"><strong>Hapus Ulasan</strong></h1>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<form method="post" action="route/action/controller.php">
										<div class="modal-body">
											<input type="hidden" name="idulasan" value="<?= $data['UlasanID']?>">
											<div class="row">
												<p>Apakah Anda yakin ingin menghapus ulasan ini ?</p>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
											<button type="submit" class="btn btn-danger" name="hapusulasan">Hapus</button>
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
			<!-- Tambah Ulasan Modal -->
			<div class="modal fade" id="tambahulasan" tabindex="-1" aria-labelledby="tambahulasanLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title" id="tambahulasanLabel"><strong>Tambah Ulasan</strong></h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form method="post" action="route/action/controller.php">
						<div class="modal-body">
							<div class="mb-3">
								<input type="hidden" name="idulasan" value="">
								<input type="hidden" name="iduser" value="<?= $_SESSION['id']?>">
								<label class="form-label">Judul</label>
                                <select name="judul" class="form-select">
                                    <?php
                                    $query = mysqli_query($koneksi, "SELECT * FROM kategoribuku_relasi INNER JOIN buku ON kategoribuku_relasi.BukuID=buku.BukuID");
                                    while($data = mysqli_fetch_array($query)){
                                    ?>
                                        <option value="<?= $data['BukuID']?>"><?= $data['Judul']?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
							</div>
                            <div class="mb-3">
                                <label class="form-label">Beri Ulasan</label>
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Beri Ulasan Disini" id="floatingTextarea" style="height: 100px;" name="ulasan"></textarea>
                                    <label for="floatingTextarea">Ulasan</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Beri Rating</label>
                                <div id="rateYo"></div>
								<input type="hidden" id="rating" name="rating" value="">
                            </div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
							<button type="submit" class="btn btn-success" name="tambahulasan">Simpan</button>
						</div>
					</form>
				</div>
			</div>
			<!-- Akhir Modal -->
		</div>
	</div>
<script>
	let table = new DataTable('#ulasan');

    $(function () {
 
        $("#rateYo").rateYo({
        fullStar: true,
		onSet:function(rating, rateYoInstance) {
			$("#rating").val(rating);
		}
        });
    });
</script>
