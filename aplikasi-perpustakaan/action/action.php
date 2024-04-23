<?php
include "../network/koneksi.php";
#Buku Masuk
if (isset($_POST['bukumasuk'])) {
    $id_tambah = $_POST['id_tambah'];
    $jumlah = $_POST['jumlah'];

    $query_buku = mysqli_query($koneksi, "SELECT JumlahBuku FROM buku WHERE BukuID='$id_tambah'");
    $data_buku = mysqli_fetch_array($query_buku)[0];
    var_dump($data_buku);

    $jumlah_buku = $data_buku + $jumlah;

    $query = mysqli_query($koneksi,"UPDATE buku SET JumlahBuku='$jumlah_buku' WHERE BukuID=$id_tambah");
    if ($query) {
        echo "<script>alert('Data Berhasil Di Tambahkan'); location.href ='../index.php?page=buku';</script>";
    }
}
#Tambah Anggota
if (isset($_POST['tambahanggota'])) {
    $namalngkp = $_POST['namalngkp'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $level = $_POST['id_level'];
    $alamat = $_POST['alamat'];
    $password = md5($_POST['password']);
    $query = mysqli_query($koneksi,"INSERT INTO user (Username, Password, Email, NamaLengkap, Alamat, Level) VALUES ('$username','$password','$email','$namalngkp','$alamat','$level')");
    if ($query) {
        echo "<script>alert('Data Berhasil Di Tambahkan'); location.href ='../index.php?page=anggota';</script>";
    }
}
#Edit Anggota
if (isset($_POST['editanggota'])) {
    $id = $_POST['id_anggota'];
    $namalngkp = $_POST['namalngkp'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $level = $_POST['id_level'];
    $alamat = $_POST['alamat'];
    $query = mysqli_query($koneksi,"UPDATE user SET NamaLengkap='$namalngkp', Email='$email', Username='$username', Level='$level', Alamat='$alamat' WHERE UserID='$id'");
    if ($query) {
        echo "<script>alert('Data Berhasil Di Edit'); location.href = '../index.php?page=anggota';</script>";
    }

}
#Hapus Anggota
if (isset($_POST['hapusanggota'])) {
    $id = $_POST['id_anggota'];
    $query = mysqli_query($koneksi, "DELETE FROM user WHERE UserID='$id'");
    if ($query) {
         echo "<script>alert('Data Berhasil Dihapus'); location.href ='../index.php?page=anggota';</script>";
    }
}

#Tambah Buku
if (isset($_POST['tambahbuku'])) {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $terbit = $_POST['terbit'];
    $kategori = $_POST['id_Kategori'];
    $jumlah_buku = $_POST['jumlahbuku'];

    $querybuku = mysqli_query($koneksi, "INSERT INTO buku(Judul, Penulis, Penerbit, TahunTerbit, JumlahBuku) VALUES ('$judul','$penulis','$penerbit','$terbit','$jumlah_buku')");
    $getidbuku = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY BukuID DESC LIMIT 1");
    $cek = mysqli_fetch_array($getidbuku)[0];
    var_dump($cek);
    $ins = mysqli_query($koneksi, "INSERT INTO kategoribuku_relasi(BukuID,KategoriID) VALUES ($cek, $kategori)");

    if ($ins) {
        echo "<script>alert('Data Berhasil Di Tambahkan'); location.href ='../index.php?page=buku';</script>";
    }
}

#Edit Buku
if (isset($_POST['editbuku'])) {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $terbit = $_POST['terbit'];
    $kategori = $_POST['id_Kategori'];
    $buku = $_POST['id_buku'];

    $querybuku = mysqli_query($koneksi, "UPDATE buku SET Judul='$judul', Penulis='$penulis', Penerbit='$penerbit', TahunTerbit='$terbit' WHERE BukuID = $buku");
    $getidbuku = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY BukuID = $buku");
    $cek = mysqli_fetch_array($getidbuku);
    $ins = mysqli_query($koneksi, "UPDATE kategoribuku_relasi SET KategoriID = $kategori WHERE BukuID = $buku AND KategoriID ");

    if ($ins) {
        echo "<script>alert('Data Berhasil Di Tambahkan'); location.href ='../index.php?page=buku';</script>";
    }
}
#Hapus Buku
if (isset($_POST['hapusbuku'])) {
    $id = $_POST['id_buku'];
    $query = mysqli_query($koneksi,"DELETE FROM buku WHERE BukuID='$id'");
    echo "<script>alert('Data Berhasil Di Hapus'); location.href ='../index.php?page=buku';</script>";
}

#Tambah Kategori
if (isset($_POST['tambahkategori'])) {
    $kategori = $_POST['kategori'];
    $query = mysqli_query($koneksi, "INSERT INTO kategoribuku (NamaKategori) VALUES ('$kategori')");
    echo "<script>alert('Data Berhasil Di Tambahkan'); location.href ='../index.php?page=kategoribuku';</script>";
}

#Edit Kategori
if (isset($_POST['editkategori'])) {
    $id = $_POST['id_kategori'];
    $ktgri = $_POST['kategori'];
    $query = mysqli_query($koneksi, "UPDATE kategoribuku SET NamaKategori='$ktgri' WHERE KategoriID='$id'");
    if ($query) {
        echo "<script>alert('Kategori Berhasil Di Edit'); location.href ='../index.php?page=kategoribuku';</script>";
    }

}

#Hapus Kategori
if (isset($_POST['hapuskategori'])) {
    $id = $_POST['id_kategori'];
    $query = mysqli_query($koneksi, "DELETE FROM kategoribuku WHERE KategoriID='$id'");
    if ($query) {
        echo "<script>alert('Kategori Berhasil DiHapus'); location.href ='../index.php?page=kategoribuku';</script>";
    }
}

#Ubah Profil
if (isset($_POST['ubahprofile'])) {
    $id = $_POST['id_user'];
    $username = $_POST['username'];
    $nama = $_POST['namalngkp'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $level = $_POST['id_level'];
    $password = md5($_POST['password']);
    
    $query = mysqli_query($koneksi, "UPDATE user SET Username='$username', NamaLengkap='$nama', Email='$email', Alamat='$alamat', Level='$level', Password='$password' WHERE UserID='$id'");
    if (empty($query)) {
        echo '<script>alert("Data Belum Lengkap, Lengkapi Data Terlebih Dahulu Sebelum Di Ubah"); location.href="?page=profile"</script>';
    } else {
        echo '<script>alert("Data Berhasil DiUbah"); location.href="../index.php?page=profile"</script>';
    }
}

#Pinjam Buku
if (isset($_POST['pinjambuku'])) {
    $userid = $_POST['userid'];
    $bukuid = $_POST['bukuid'];
    $jumlahbuku = $_POST['jumlahbuku'];
    $tgl_pinjam = $_POST['tanggalpinjam'];
    $status = $_POST['status'];
    
    $query = mysqli_query($koneksi, "INSERT INTO peminjaman (PeminjamanID, UserID, BukuID, TanggalPeminjaman, TanggalPengembalian, StatusPeminjaman, JmlhBuku) VALUES ('', '$userid', '$bukuid', '$tgl_pinjam', '', '$status', '$jumlahbuku')");
    $query1 = mysqli_query($koneksi, "SELECT JumlahBuku FROM buku WHERE BukuID='$bukuid'");
    $ambil = mysqli_fetch_array($query1);
    $kurang = $ambil['JumlahBuku'] - $jumlahbuku;
    $data = mysqli_query($koneksi, "UPDATE buku SET JumlahBuku='$kurang' WHERE BukuID=$bukuid");

    if ($query || $data) {
        echo '<script>alert("Anda Berhasil Meminjam"); location.href="../?page=peminjaman"</script>';
    }

}

#Pengembalian Buku
if (isset($_POST['kembalikan'])) {
    $id = $_POST['peminjamanid'];
    $bukuid = $_POST['bukuid'];
    $tglpengembalian = $_POST['tgl_pengembalian'];
    $jumlah = $_POST['jumlah'];
    $status = $_POST['status'];

    $query = mysqli_query($koneksi, "UPDATE peminjaman SET TanggalPengembalian='$tglpengembalian', StatusPeminjaman='$status' WHERE PeminjamanID = '$id' ");
    $query1 = mysqli_query($koneksi, "SELECT JumlahBuku FROM buku WHERE BukuID='$bukuid'");
    $kembali = mysqli_fetch_array($query1);
    $tambah = $jumlah + $kembali['JumlahBuku'];
    $data = mysqli_query($koneksi,"UPDATE buku SET JumlahBuku='$tambah' WHERE BukuID='$bukuid'");

    if ($query || $data) {
        echo '<script>alert("Anda Berhasil Mengembalikan"); location.href="../?page=peminjaman"</script>';
    }

}

#Ulasan
if (isset($_POST['ulasan'])) {
    $user = $_POST['userid'];
    $peminjam = $_POST['peminjamanid'];
    $r = mysqli_fetch_array(mysqli_query($koneksi, "SELECT BukuID FROM peminjaman WHERE PeminjamanID = '$peminjam' "));
    $bukuid = $r['BukuID'];
    $rating = $_POST['rating'];
    $ulasan = $_POST['ulasan'];
    $query = mysqli_query($koneksi, "INSERT INTO ulasanbuku (UlasanID, UserID, BukuID, PeminjamanID, Ulasan, Rating) VALUES (' ','$user','$bukuid','$peminjam','$ulasan','$rating')");
    if ($query) {
        echo '<script>alert("Terimakasih Atas Ulasannya :-)"); location.href="../index.php";</script>';
    }
}  

#Koleksi Pribadi
if (isset($_POST['tambahkoleksi'])) {
    $user = $_POST['userid'];
    $buku = $_POST['bukuid'];
    $query = mysqli_query($koneksi, "INSERT INTO koleksipribadi (KoleksiID, UserID, BukuID) VALUES ('','$user','$buku')");
    if ($query) {
        echo '<script>alert("Ya... Anda Berhasil Menambah Buku Anda Ke Koleksi Pribadi"); location.href="../?page=koleksi"</script>';
    }
}

#Edit Koleksi Pribadi
if (isset($_POST['editkoleksi'])) {
    $koleksi = $_POST['idkoleksi']
    $user = $_POST['userid'];
    $buku = $_POST['bukuid'];
    $query = mysqli_query($koneksi, "INSERT INTO koleksipribadi (KoleksiID, UserID, BukuID) VALUES ('','$user','$buku')");
    if ($query) {
        echo '<script>alert("Ya... Anda Berhasil Menambah Buku Anda Ke Koleksi Pribadi"); location.href="../?page=koleksi"</script>';
    }
}

?>


