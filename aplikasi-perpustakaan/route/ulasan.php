<?php
if (!isset($_SESSION['level']) || ($_SESSION['level'] === "Admin" && $_SESSION['level'] === "Petugas")) {
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
            <h1><strong>Ulasan</strong></h1>
            <div class="card-body">

                <br><br>
                <table id="ulasanbuku" class="display cell-border">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Buku</th>
                        <th>Nama Pengguna</th>
                        <th>Ulasan</th>
                        <th>Rating</th>
                        <th>Action</th>
                    </tr>
                </thead>
                    <tbody>
                    <?php     
                    $query = mysqli_query($koneksi, "SELECT * FROM ulasanbuku INNER JOIN buku ON buku.BukuID=ulasanbuku.BukuID INNER JOIN user ON user.UserID = ulasanbuku.UserID");            
                    $i = 1;

                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo "$i"; $i++
                            ?></th>
                            <td><?= $data['Judul']?></td>
                            <td><?= $data['NamaLengkap']?></td>
                            <td><?= $data['Ulasan'] ?></td>
                            <td><?= $data['Rating'] ?></td>
                            <td>
                                <button type="button" class="btn btn-lg btn-danger" data-bs-toggle="modal" data-bs-target="#hapusulasan<?php echo $data['UlasanID']?>">Hapus</button>
                            </td>
                        </tr>
                        
                        <!-- Modal Hapus -->
                        <div class="modal fade" id="hapusulasan<?php echo $data['UlasanID']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="col-12">
                                            <div class="text-center">
                                                <h1 class="modal-title" id="staticBackdropLabel"><strong>Hapus Koleksi</strong></h1>
                                            </div>
                                        </div>
                                    </div>
                                    <form method="post" action="action/action.php">
                                        <input type="hidden" name="ulasan_id" value="<?php echo $data['UlasanID']?>">
                                        <div class="modal-body">
                                            <div class="row">
                                                <h5>Apakah Anda Yakin Menghapus Data Berikut</h5>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-success" name="hapusulasan">Simpan</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Edit -->
                        <div class="modal fade" id="editulasan<?php echo $data['UlasanID']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
    let table = new DataTable('#ulasanbuku');
</script>
</main>