

<main class="content">
				<div class="container-fluid p-0">

					<div class="mb-3">
						<h1 class="h3 d-inline align-middle">Profile</h1>
					</div>
					<div class="row">
                        <div class="container-fluid p-0">
                            <div class="card">
                                <div class="card-header">
                                <table class="table">
                                    <?php
                                    $query = mysqli_query($koneksi,"SELECT * FROM user");
                                    $data = mysqli_fetch_array($query);
                                    ?>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Username</th>
                                            <td><?= $_SESSION['username']?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Nama Lengkap</th>
                                            <td><?= $_SESSION['nama']?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Email</th>
                                            <td><?= $_SESSION['email']?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Alamat</th>
                                            <td><?= $_SESSION['alamat']?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Status</th>
                                            <td><?= $_SESSION['level']?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-lg btn-warning" data-bs-toggle="modal" data-bs-target="#ubah">Ubah</button>
                                </div>
                            </div>
                            <!-- Modal ubah -->
                            <div class="modal fade" id="ubah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <h1 class="modal-title" id="staticBackdropLabel"><strong>Ubah Profile</strong></h1>
                                                </div>
                                            </div>
                                        </div>
                                        <form method="post" action="action/action.php">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="mb-3">
                                                        <input type="hidden" name="id_user" value="<?= $data['UserID']?>">
                                                        <label class="form-label">Username</label>
                                                        <input type="text" name="username" class="form-control" value="<?=$_SESSION['username']?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Nama Lengkap</label>
                                                        <input type="text" name="namalngkp" class="form-control" value="<?= $_SESSION['nama']?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Email</label>
                                                        <input type="email" name="email" class="form-control" value="<?= $_SESSION['email']?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Alamat</label>
                                                        <input type="text" name="alamat" class="form-control" value="<?= $_SESSION['alamat']?>">
                                                    </div>
                                                        <input type="hidden" name="id_level" class="form-control" value="<?= $_SESSION['level']?>">
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
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="col-12">
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-success" name="ubahprofile">Simpan</button>
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
