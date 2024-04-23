    
<main class="content">
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-header">
            <h1><strong>Koleksi Pribadi</strong></h1>
            <div class="card-body">
            <div class="mb-3">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahkoleksi"><strong>+ Tambah Koleksi</strong></button>
                </div>
                <br><br>
                <table id="koleksi" class="display cell-border">
                <thead>
                    <tr>
                        <th width=5%;>No</th>
                        <th width=80%>Buku</th>
                        <th width=30%>Action</th>
                    </tr>
                </thead>
                    <tbody>
                    <?php
                    $user = $_SESSION['id'];
                    if (isset($_POST['koleksi'])) {
                        $judul = $_POS['Judul'];

                        $query = mysqli_query($koneksi, "SELECT * FROM koleksipribadi INNER JOIN buku ON koleksipribadi.BukuID=buku.BukuID WHERE Judul=$judul AND UserID=$user");
                    }else {
                        $query = mysqli_query($koneksi, "SELECT * FROM koleksipribadi INNER JOIN buku ON koleksipribadi.BukuID=buku.BukuID");
                    }
                    $i = 1;
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo "$i"; $i++
                            ?></th>
                            <td><?= $data['Judul']?></td>
                            <td>
                            <button type="button" class="btn btn-lg btn-warning" data-bs-toggle="modal" data-bs-target="#editkoleksi<?php echo $data['KoleksiID']?>">Ubah</button>
                            <button type="button" class="btn btn-lg btn-danger" data-bs-toggle="modal" data-bs-target="#hapuskoleksi<?php echo $data['KoleksiID']?>">Hapus</button>
                            </td>
                        </tr>

                        <!-- Modal Ubah -->
                        <div class="modal fade" id="editkoleksi<?= $data['KoleksiID']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="col-12">
                                            <div class="text-center">
                                                <h1 class="modal-title" id="staticBackdropLabel"><strong>Ubah Koleksi Pribadi</strong></h1>
                                            </div>
                                        </div>
                                    </div>
                                    <form method="post" action="action/action.php">
                                        <input type="hidden" name="idkoleksi" value="<?php echo $data['KoleksiID']?>">
                                        <div class="modal-body">
                                        <div class="row">
                                                <div class="mb-3">
                                                    <label class="form-label">Koleksi Buku</label>
                                                    <select name="bukuid" class="form-select">
                                                        <option selected hidden>Pilih...</option>
                                                        <?php
                                                        $query_koleksi = mysqli_query($koneksi, "SELECT * FROM buku");
                                                        while ($data_koleksi = mysqli_fetch_array($query_koleksi)) {
                                                        ?>
                                                        <option value="<?php echo $data['KoleksiID'] ?>"
                                                        <?php
                                                        if ($data['BukuID'] == $data_koleksi['BukuID']) {
                                                            echo "selected";
                                                        }
                                                        ?>><?php echo $data_koleksi['Judul']?></option>
                                                        <?php
                                                        };
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                                                    <button type="submit" class="btn btn-success" name="editkoleksi">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Hapus -->
                        <div class="modal fade" id="hapuskoleksi<?= $data['KoleksiID']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                        <input type="hidden" name="id_kategori" value="<?= $data['KoleksiID']?>">
                                        <div class="modal-body">
                                            <div class="row">
                                                <h5>Apakah Anda Yakin Menghapus Data Berikut</h5>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-success" name="hapuskoleksi">Simpan</button>
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
            <!-- Tambah Koleksi -->
            <div class="modal fade" id="tambahkoleksi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="col-12">
                                <div class="text-center">
                                    <h1 class="modal-title" id="staticBackdropLabel"><strong>Tambah Koleksi</strong></h1>
                                </div>
                            </div>
                        </div>
                        <form method="post" action="action/action.php">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="mb-3">
                                        <input type="text" name="userid" value="<?= $_SESSION['id']?>" hidden>
                                        <label class="form-label">Nama Buku</label>
                                        <select name="bukuid" class="form-select">
                                            <option selected hidden>Pilih...</option>
                                            <?php
                                            $query_koleksi = mysqli_query($koneksi, "SELECT * FROM buku");
                                            while ($data_koleksi = mysqli_fetch_array($query_koleksi)) {
                                            ?>
                                            <option value="<?php echo $data_koleksi['BukuID'] ?>">
                                            <?php echo $data_koleksi['Judul']?></option>
                                            <?php
                                            };
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="col-12">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success" name="tambahkoleksi">Simpan</button>
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
    let table = new DataTable('#koleksi');

</script>
</main>