<?php
require_once "../network/koneksi.php"
?>

<script>
    window.print();
</script>
<main class="content">
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-header">
            <h1><center><strong>Riwayat Peminjaman</strong></center></h1>
            <div class="card-body">
                <br><br>
                <center><table class="table table-bordered table-striped table-hover cell-border" id="" ></center>
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

                        <?php
                        }
                        ?>
                        
                    </tbody>
                </table>
                <style>
                table {
                border-collapse: collapse; /* Menggabungkan border menjadi satu garis */
                }
                table, th, td {
                border: 2px solid black; /* Memberi border 1 piksel berwarna hitam */
                padding: 10px
                }
                </style>
            </div>
            </div>
        </div>
    </div>
    <style>
        @media print {
            a {
                display: none;
            }
            button {
                display: none;
            }
        }
    </style>
    <br><br>
    <center><a href="../index.php"><button>Kembali</button></a></center>
</main>