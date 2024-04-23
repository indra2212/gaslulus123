
<main class="content">
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-header">
            <h1><strong>Peminjaman</strong></h1>
            <div class="card-body">
            <?php
            if ($_SESSION['level'] == "Admin") {
            ?>
            <a class="btn btn-success" href="?page=laporan">
                <i class="align-middle" data-feather="printer"></i><span class="align-midle">Laporan</span>
            </a>
            <?php
            }
            ?>
                <br><br>
                <table id="peminjam" class="display cell-border">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Peminjam</th>
                        <th>Judul Buku</th>
                        <th>Jumlah Peminjaman</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Status Pinjaman</th>
                        <?php
                        if ($_SESSION['level'] === "Peminjam") {
                        ?>
                        <th>Action</th>
                        <?php
                        }
                        ?>
                    </tr>
                </thead>
                    <tbody>
                    <?php
                    $user = $_SESSION['id'];
                    $level = ($_SESSION['level'] === "Peminjam");
                    if (isset($_POST['peminjaman'])) {
                        $kategori = $_POST['KategoriID'];
                        $buku = $_POST['BukuID'];
                        
                        if ($level) {
                            $query = mysqli_query($koneksi, "SELECT * FROM peminjaman INNER JOIN user ON peminjaman.UserID=user.UserID INNER JOIN buku  ON peminjaman.BukuID=buku.BukuID WHERE NamaKategori='$kategori' AND JudulBuku='$buku' AND UserID ='$user' ");
                        }else {
                            $query = mysqli_query($koneksi, "SELECT * FROM peminjaman INNER JOIN user ON peminjaman.UserID=user.UserID INNER JOIN buku  ON peminjaman.BukuID=buku.BukuID ");
                        }
                    }else {
                        if ($level) {
                            $query = mysqli_query($koneksi, "SELECT * FROM peminjaman INNER JOIN user ON peminjaman.UserID=user.UserID INNER JOIN buku  ON peminjaman.BukuID=buku.BukuID WHERE user.UserID='$user' ");
                        }else {
                            $query = mysqli_query($koneksi, "SELECT * FROM peminjaman INNER JOIN user ON peminjaman.UserID=user.UserID INNER JOIN buku  ON peminjaman.BukuID=buku.BukuID ");
                        }
                    }
                    $i = 1;
                    while ($data = mysqli_fetch_array($query)) {
                    $_SESSION['idpeminjaman'] = $data['PeminjamanID'];
                    $_SESSION['namapeminjam'] = $data['NamaLengkap'];
                    $_SESSION['judul'] = $data['Judul'];
                    $_SESSION['jumlah'] = $data['JmlhBuku'];
                    $_SESSION['tgl_peminjaman'] = $data['TanggalPeminjaman'];
                    $_SESSION['tgl_pengembalian'] = $data['TanggalPengembalian'];
                    $_SESSION['status'] = $data['StatusPeminjaman'];
                    ?>
                        <tr>
                            <th scope="row"><?php echo "$i"; $i++
                            ?></th>
                            <td><?= $_SESSION['namapeminjam']?></td>
                            <td><?= $_SESSION['judul']?></td>
                            <td><?= $_SESSION['jumlah']?></td>
                            <td><?= $_SESSION['tgl_peminjaman']?></td>
                            <td><?= $_SESSION['tgl_pengembalian']?></td>
                            <td><?= $_SESSION['status']?></td>
                            <?php
                            if ($_SESSION['level'] === "Peminjam") {
                                ?>
                                <td><button type="button" class="btn btn-lg btn-success" data-bs-toggle="modal" data-bs-target="#kembalikan<?= $_SESSION['idpeminjaman']?>" <?php
                                if ($_SESSION['status'] === "Dikembalikan") {
                                    echo "disabled";
                                }
                                ?>><?php
                                if ($_SESSION['status'] === "Dipinjam") {
                                    echo "Kembalikan";
                                }else{
                                    echo "Dikembalikan";
                                }
                                ?></button></td>
                            <?php
                            }
                            ?>
                        </tr>

                        <!-- Modal Kembalikan -->
                        <div class="modal fade" id="kembalikan<?= $_SESSION['idpeminjaman']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="col-12">
                                            <div class="text-center">
                                                <h1 class="modal-title" id="staticBackdropLabel"><strong>Pengembalian Buku</strong></h1>
                                            </div>
                                        </div>
                                    </div>
                                    <form method="post" action="action/action.php">
                                        <input type="hidden" name="peminjamanid" value="<?= $_SESSION['idpeminjaman']?>">
                                        <div class="modal-body">
                                        <div class="row">
                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal Pengembalian Buku</label>
                                                    <input type="date" name="tgl_pengembalian" class="form-control">
                                                    <input type="text" value="Dikembalikan" name="status" hidden>
                                                    <input type="text" value="<?= $data['BukuID']?>" name="bukuid" hidden>
                                                    <input type="text" value="<?= $data['JmlhBuku']?>" name="jumlah" hidden>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-success" name="kembalikan">Kembalikan</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Hapus -->
                        <div class="modal fade" id="hapuskategori<?= $_SESSION['idpeminjam']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
            </div>
        </div>
    </div>
<script>
    let table = new DataTable('#peminjam');
</script>
</main>