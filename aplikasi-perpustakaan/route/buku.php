<?php
if (!isset($_SESSION['level']) || ($_SESSION['level'] !== "Admin" && $_SESSION['level'] !== "Petugas")) {
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
            <h1><strong>Buku</strong></h1>
            <div class="card-body">
                <div class="mb-3">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahbuku"><strong>+ Tambah Buku</strong></button> 
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#bukumasuk"><strong>Buku Masuk</strong></button>
                </div>
                <br>
                <table id="buku" class="display cell-border table-bordered">
                <thead>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Penulis Buku</th>
                        <th>Kategori Buku</th>
                        <th>Penerbit</th>
                        <th>Tahun Terbit</th>
                        <th>Jumlah Buku</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_POST['buku'])) {
                            $kategori = $_POST['KategoriID'];
                            $query = mysqli_query($koneksi, "SELECT * FROM buku INNER JOIN kategoribuku_relasi ON buku.BukuID=kategoribuku_relasi.BukuID INNER JOIN kategoribuku ON kategoribuku_relasi.KategoriID=kategoribuku.KategoriID WHERE NamaKategori='$kategori'");
                        }else {
                            $query = mysqli_query($koneksi, "SELECT * FROM buku INNER JOIN kategoribuku_relasi ON buku.BukuID=kategoribuku_relasi.BukuID INNER JOIN kategoribuku ON kategoribuku_relasi.KategoriID=kategoribuku.KategoriID");
                        }
                        $i = 1;

                        while ($data = mysqli_fetch_array($query)) {
                        $_SESSION['judul'] = $data['Judul'];
                        $_SESSION['penulis'] = $data['Penulis'];
                        $_SESSION['kategori'] = $data['NamaKategori'];
                        $_SESSION['penerbit'] = $data['Penerbit'];
                        $_SESSION['tahun'] = $data['TahunTerbit'];
                        $_SESSION['jumlah'] = $data['JumlahBuku'];
                            ?>
                        <tr>
                            <th scope="row"><?php echo "$i"; $i++
                            ?></th>
                            <td><?= $_SESSION['judul']?></td>
                            <td><?= $_SESSION['penulis']?></td>
                            <td><?= $_SESSION['kategori']?></td>
                            <td><?= $_SESSION['penerbit']?></td>
                            <td><?= $_SESSION['tahun']?></td>
                            <td><?= $_SESSION['jumlah']?></td>
                            <td>
                                <button type="button" class="btn btn-lg btn-warning" data-bs-toggle="modal" data-bs-target="#editbuku<?php echo $data['BukuID']?>">Edit</button>
                                <button type="button" class="btn btn-lg btn-danger" data-bs-toggle="modal" data-bs-target="#hapusbuku<?php echo $data['BukuID']?>">Hapus</button>
                            </td>
                        </tr>
                        
                        <!-- Modal Ubah -->
                        <div class="modal fade" id="editbuku<?php echo $data['BukuID']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                    <input type="hidden" name="id_buku" value="<?= $data['BukuID']?>" >
                                                    <label class="form-label">Judul Buku</label>
                                                    <input type="text" name="judul" class="form-control" value="<?= $_SESSION['judul']?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Penulis</label>
                                                    <input type="text" name="penulis" class="form-control" value="<?= $_SESSION['penulis']?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Kategori</label>
                                                    <select name="id_Kategori" class="form-select">
                                                        <?php
                                                        $query_kategori = mysqli_query($koneksi, "SELECT * FROM kategoribuku");
                                                        while ($data_kategori = mysqli_fetch_array($query_kategori)) {
                                                        ?>
                                                        <option value="<?php echo $data_kategori['KategoriID'] ?>"
                                                        <?php
                                                        if ($_SESSION['kategori'] == $data_kategori['KategoriID']) {
                                                            echo "selected";
                                                        }
                                                        ?>><?php echo $data_kategori['NamaKategori']?></option>
                                                        <?php
                                                        };
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Penerbit</label>
                                                    <input type="text" name="penerbit" class="form-control" value="<?= $_SESSION['penerbit']?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Tahun Terbit</label>
                                                    <input type="text" name="terbit" class="form-control" value="<?= $_SESSION['tahun']?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-success" name="editbuku">Simpan</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Hapus -->
                        <div class="modal fade" id="hapusbuku<?php echo $data['BukuID']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="col-12">
                                            <div class="text-center">
                                                <h1 class="modal-title" id="staticBackdropLabel"><strong>Hapus Buku</strong></h1>
                                            </div>
                                        </div>
                                    </div>
                                    <form method="post" action="action/action.php">
                                        <input type="hidden" name="id_buku" value="<?php echo $data['BukuID']?>">
                                        <div class="modal-body">
                                            <div class="row">
                                                <h5>Apakah Anda Yakin Menghapus Data Berikut</h5>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-success" name="hapusbuku">Simpan</button>
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
            <div class="modal fade" id="tambahbuku" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="col-12">
                                <div class="text-center">
                                    <h1 class="modal-title" id="staticBackdropLabel"><strong>Tambah Buku</strong></h1>
                                </div>
                            </div>
                        </div>
                        <form method="post" action="action/action.php">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="mb-3">
                                        <label class="form-label">Judul Buku</label>
                                        <input type="text" name="judul" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Penulis Buku</label>
                                        <input type="text" name="penulis" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Kategori Buku</label>
                                        <select name="id_Kategori" class="form-select">
                                            <option value="" selected hidden>Pilih ....</option>
                                            <?php
                                            $query = mysqli_query($koneksi, "SELECT * FROM kategoribuku");
                                            while ($data = mysqli_fetch_array($query)) {
                                            ?>
                                            <option value="<?php echo $data['KategoriID'] ?>"><?php echo $data['NamaKategori']?></option>
                                            <?php
                                            };
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Penerbit</label>
                                        <input type="text" name="penerbit" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tahun Terbit</label>
                                        <input type="text" name="terbit" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jumlah Buku</label>
                                        <input type="text" name="jumlahbuku" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="col-12">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success" name="tambahbuku">Simpan</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Buku Masuk -->
            <div class="modal fade" id="bukumasuk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="col-12">
                                <div class="text-center">
                                    <h1 class="modal-title" id="staticBackdropLabel"><strong>Buku Masuk</strong></h1>
                                </div>
                            </div>
                        </div>
                        <form method="post" action="action/action.php">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="mb-3">
                                        <label class="form-label">Judul Buku</label>
                                        <select name="id_tambah" class="form-select">
                                            <option value="" selected hidden>Pilih ....</option>
                                            <?php
                                            $query = mysqli_query($koneksi, "SELECT * FROM buku");
                                            while ($data = mysqli_fetch_array($query)) {
                                            ?>
                                            <option value="<?php echo $data['BukuID'] ?>"><?php echo $data['Judul']?></option>
                                            <?php
                                            };
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jumlah Buku</label>
                                        <input type="text" name="jumlah" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="col-12">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success" name="bukumasuk">Simpan</button>
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
    let table = new DataTable('#buku');
</script>
</main>

