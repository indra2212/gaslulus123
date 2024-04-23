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
            <h1><strong>Kategori Buku </strong></h1>
            <div class="card-body">
                <div class="mb-3">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahkategori"><strong>+ Tambah Kategori</strong></button>
                </div>
                <br>
                <table id="kategori" class="display cell-border">
                    <thead>
                        <th>No</th>
                        <th width="80%">Nama Kategori</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM kategoribuku");
                        while ($data = mysqli_fetch_array($query)) {
                        $_SESSION['namakategori'] = $data['NamaKategori'];
                            ?>
                        <tr>
                            <th scope="row"><?php echo "$i"; $i++
                            ?></th>
                            <td><?= $_SESSION['namakategori']?></td>
                            <td>
                                <button type="button" class="btn btn-lg btn-warning" data-bs-toggle="modal" data-bs-target="#editkategori<?php echo $data['KategoriID']?>">Edit</button>
                                <button type="button" class="btn btn-lg btn-danger" data-bs-toggle="modal" data-bs-target="#hapuskategori<?php echo $data['KategoriID']?>">Hapus</button>
                            </td>
                        </tr>

                        <!-- Modal Ubah -->
                        <div class="modal fade" id="editkategori<?php echo $data['KategoriID']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="col-12">
                                            <div class="text-center">
                                                <h1 class="modal-title" id="staticBackdropLabel"><strong>Edit Kategori</strong></h1>
                                            </div>
                                        </div>
                                    </div>
                                    <form method="post" action="action/action.php">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="mb-3">
                                                    <input type="hidden" name="id_kategori" value="<?= $data['KategoriID']?>">
                                                    <label class="form-label">Nama Kategori</label>
                                                    <input type="text" name="kategori" class="form-control" value="<?= $_SESSION['namakategori']?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-success" name="editkategori">Simpan</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Hapus -->
                        <div class="modal fade" id="hapuskategori<?php echo $data['KategoriID']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                        <input type="hidden" name="id_kategori" value="<?php echo $data['KategoriID']?>">
                                        <div class="modal-body">
                                            <div class="row">
                                                <h5>Apakah Anda Yakin Menghapus Data Berikut</h5>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-success" name="hapuskategori">Simpan</button>
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
            <div class="modal fade" id="tambahkategori" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                        <label class="form-label">Nama Kategori</label>
                                        <input type="text" name="kategori" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="col-12">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success" name="tambahkategori">Simpan</button>
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
    let table = new DataTable('#kategori');
</script>
</main>