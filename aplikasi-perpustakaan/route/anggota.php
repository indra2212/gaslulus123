<?php

if (!isset($_SESSION['level']) || ($_SESSION['level'] !== "Admin" && $_SESSION['level'] !== "Petugas")) {
    // Jika tidak, arahkan ke halaman login atau tampilkan pesan kesalahan
    echo "<script>
            swal('Akses Ditolak', 'Anda tidak memiliki izin untuk mengakses halaman ini', 'error').then(function() {
                window.location = 'index.php';
            });
          </script>";
    exit;
}
?>

<main class="content">
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-header">
            <h1><strong>Anggota</strong></h1>
            <div class="card-body">
                <div class="mb-3">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahanggota"><strong>+ Tambah Pengguna</strong></button>
                </div>
                <br>
                <table id="anggota" class="display cell-border">
                    <thead>
                        <th width="5%">No</th>
                        <th width="18%">Nama Lengkap</th>
                        <th width="20%">Email</th>
                        <th width="15%">Username</th>
                        <th>Level</th>
                        <th width="20%">Alamat</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM user");
                        while ($data = mysqli_fetch_array($query)) {
                        $_SESSION['namaanggota'] = $data['NamaLengkap'];
                        $_SESSION['emailanggota'] = $data['Email'];
                        $_SESSION['usernameanggota'] = $data['Username'];
                        $_SESSION['levelanggota'] = $data['Level'];
                        $_SESSION['alamat'] = $data['Alamat'];
                            ?>
                        <tr>
                            <th scope="row"><?php echo "$i"; $i++
                            ?></th>
                            <td><?= $_SESSION['namaanggota']?></td>
                            <td><?= $_SESSION['emailanggota']?></td>
                            <td><?= $_SESSION['usernameanggota']?></td>
                            <td><?= $_SESSION['levelanggota']?></td>
                            <td><?= $_SESSION['alamat']?></td>
                            <td>
                                <button type="button" class="btn btn-lg btn-warning" data-bs-toggle="modal" data-bs-target="#editanggota<?php echo $data['UserID']?>">Edit</button>
                                <button type="button" class="btn btn-lg btn-danger" data-bs-toggle="modal" data-bs-target="#hapusanggota<?php echo $data['UserID']?>">Hapus</button>
                            </td>
                        </tr>

                        <!-- Modal Ubah -->
                        <div class="modal fade" id="editanggota<?php echo $data['UserID']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="col-12">
                                            <div class="text-center">
                                                <h1 class="modal-title" id="staticBackdropLabel"><strong>Edit Anggota</strong></h1>
                                            </div>
                                        </div>
                                    </div>
                                    <form method="post" action="action/action.php">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="mb-3">
                                                    <input type="hidden" name="id_anggota" value="<?= $data['UserID']?>">
                                                    <label class="form-label">Nama Lengkap</label>
                                                    <input type="text" name="namalngkp" class="form-control" value="<?= $data['NamaLengkap']?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input type="email" name="email" class="form-control" value="<?= $data['Email']?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Username</label>
                                                    <input type="text" name="username" class="form-control" value="<?= $data['Username']?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Level</label>
                                                    <select name="id_level" class="form-select">
                                                        <option selected value="<?php echo $data['Level'];?>"><?php echo $data['Level']?></option>
                                                        <option value="" hidden>Pilih ....</option>
                                                        <option value="Admin">Admin</option>
                                                        <option value="Petugas">Petugas</option>
                                                        <option value="Peminjam">Peminjam</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Alamat</label>
                                                    <input type="text" name="alamat" class="form-control" value="<?= $data['Alamat']?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-success" name="editanggota">Simpan</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Hapus -->
                        <div class="modal fade" id="hapusanggota<?php echo $data['UserID']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="col-12">
                                            <div class="text-center">
                                                <h1 class="modal-title" id="staticBackdropLabel"><strong>Hapus Anggota</strong></h1>
                                            </div>
                                        </div>
                                    </div>
                                    <form method="post" action="action/action.php">
                                        <input type="hidden" name="id_anggota" value="<?php echo $data['UserID']?>">
                                        <div class="modal-body">
                                            <div class="row">
                                                <h5>Apakah Anda Yakin Menghapus Data Berikut</h5>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-success" name="hapusanggota">Simpan</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                        
                    </tbody>
                </table>
            </div>
            <!-- Modal Tambah -->
            <div class="modal fade" id="tambahanggota" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="col-12">
                                <div class="text-center">
                                    <h1 class="modal-title" id="staticBackdropLabel"><strong>Tambah Anggota</strong></h1>
                                </div>
                            </div>
                        </div>
                        <form method="post" action="action/action.php">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" name="namalngkp" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Level</label>
                                        <select name="id_level" class="form-select" required>
                                            <option value="" hidden>Pilih ....</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Petugas">Petugas</option>
                                            <option value="Peminjam">Peminjam</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Alamat</label>
                                        <input type="text" name="alamat" class="form-control" required>
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
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="col-12">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success" name="tambahanggota">Simpan</button>
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
    </div>
<script>
    let table = new DataTable('#anggota');
</script>
</main>