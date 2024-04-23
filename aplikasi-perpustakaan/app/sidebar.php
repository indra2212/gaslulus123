<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'Dashboard';


?>

<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.php">
    <span class="align-middle"><?= $_SESSION['level']?> Perpus</span>
</a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Main
            </li>

            <li class="sidebar-item <?php if (empty($_GET['page'])) {
                echo 'active';
            }?>">
                <a class="sidebar-link" href="index.php">
        <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
    </a>
            </li>
            <?php
            if ($_SESSION['level'] === 'Admin' || $_SESSION['level'] === 'Petugas') {
            ?>
            <li class="sidebar-item <?php if ($page == "anggota") {
                echo 'active';
            }?>">
                <a class="sidebar-link" href="?page=anggota">
                <i class="align-middle" data-feather="user"></i> <span class="align-middle">Data Anggota</span>
            </a>
            </li>

            <li class="sidebar-item <?php if ($page == "kategoribuku") {
                echo 'active';
            }?>">
                <a class="sidebar-link" href="?page=kategoribuku">
                    <i class="align-middle" data-feather="bookmark"></i> <span class="align-middle">Kategori Buku</span>
                </a>
            </li>

            <li class="sidebar-item <?php if ($page == "buku") {
                echo 'active';
            }?>">
                <a class="sidebar-link" href="?page=buku">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Buku</span>
                </a>
            </li>
            <li class="sidebar-item <?php if ($page == "ulasan") {
                echo 'active';
            }?>">
                <a class="sidebar-link" href="?page=ulasan">
                    <i class="align-middle" data-feather="star"></i> <span class="align-middle">Ulasan</span>
                </a>
            </li>
            <?php
            }
            ?>
            <li class="sidebar-item <?php if ($page == "peminjaman") {
                echo 'active';
            }?>">
                <a class="sidebar-link" href="?page=peminjaman">
                    <i class="align-middle" data-feather="archive"></i> <span class="align-middle">Peminjaman</span>
                </a>
            </li>
            <?php
            if ($_SESSION['level'] === 'Peminjam') {
            ?>
            <li class="sidebar-item <?php if ($page == "koleksi") {
                echo 'active';
            }?>">
                <a class="sidebar-link" href="?page=koleksi">
                    <i class="align-middle" data-feather="box"></i> <span class="align-middle">Koleksi Pribadi</span>
                </a>
            </li>
            <?php 
            }
            ?>

        <?php
        if ($_SESSION['level'] === 'Peminjam') {
        ?>
        <div class="sidebar-cta">
            <div class="sidebar-cta-content d-grid">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#pinjambuku"><strong>Pinjam</strong></button> 
            <br>
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ratingbuku"><strong>Rating</strong></button>
            </div>
        </div>
        <?php
        }

        if ($_SESSION['level'] === 'Admin' || $_SESSION['level'] === 'Petugas') {
        ?>
        <div class="sidebar-cta">
            <div class="sidebar-cta-content d-grid">
                <a class="btn btn-primary" href="route/laporan.php" role="button">Laporan</a>
            </div>
        </div>
        <?php
        }
        ?>
        </ul>
    </div>
    <!-- pinjam buku -->
            <div class="modal fade" id="pinjambuku" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="col-12">
                                <div class="text-center">
                                    <h1 class="modal-title" id="staticBackdropLabel"><strong>Pinjam Buku</strong></h1>
                                </div>
                            </div>
                        </div>
                        <form method="post" action="action/action.php">
                            <div class="modal-body">
                                <div class="row">
                                <input type="text" value="<?= $_SESSION['id']?>" name="userid" hidden>
                                    <div class="mb-3">
                                        <label class="form-label">Judul Buku</label>
                                            <select name="bukuid" class="form-select" required>
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
                                        <input type="text" name="jumlahbuku" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Peminjaman</label>
                                        <input type="date" name="tanggalpinjam" class="form-control" required>
                                        <input type="text" value="Dipinjam" name="status" hidden>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="col-12">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success" name="pinjambuku">Simpan</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Rating Buku -->

            <div class="modal fade" id="ratingbuku" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="col-12">
                                <div class="text-center">
                                    <h1 class="modal-title" id="staticBackdropLabel"><strong>Rating Buku</strong></h1>
                                </div>
                            </div>
                        </div>
                        <form method="post" action="action/action.php">
                            <div class="modal-body">
                                <div class="row">
                                <input type="hidden" value="<?= $_SESSION['id']?>" name="userid">
                                <input type="hidden" name="peminjamanid" value="<?= $_SESSION['idpeminjaman']?>">
                                    <div class="mb-3">
                                        <label class="form-label">Judul Buku</label>
                                            <select name="bukuid" class="form-select">
                                                <option value="" selected hidden>Pilih ....</option>
                                                <?php
                                                $user = $_SESSION['id'];
                                                $query = mysqli_query($koneksi, "SELECT peminjaman.PeminjamanID, buku.Judul FROM peminjaman INNER JOIN buku ON peminjaman.BukuID = buku.BukuID WHERE peminjaman.UserID = $user");
                                                while ($data = mysqli_fetch_array($query)) {
                                                ?>
                                                <option value="<?php echo $data['PeminjamanID']?>"><?php echo $data['Judul']?></option>
                                                <?php
                                                };
                                                ?>
                                            </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Rating Buku</label>
                                        <select name="rating" class="form-select">
                                           <option value="" selected hidden>Pilih 1-5 Jelek-Bagus</option> 
                                           <option value="1">1</option> 
                                           <option value="2">2</option> 
                                           <option value="3">3</option> 
                                           <option value="4">4</option> 
                                           <option value="5">5</option> 
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Ulasan</label>
                                        <textarea class="form-control" placeholder="" id="ulasan" style="height: 100px" name="ulasan"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="col-12">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success" name="ulasan">Simpan</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
</nav>