<head>
	<link rel="stylesheet" href="../../asset/css/app.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert"></script>
</head>

<?php
include '../../sessi/koneksi.php';

// Tambah Kategori
if (isset($_POST['tambah-kat'])) {
    $id = $_POST['id-kat'];
    $kategori = $_POST['kategori'];

    $query = mysqli_query($koneksi, "INSERT INTO kategoribuku (KategoriID, NamaKategori) VALUES ('$id','$kategori')");

    if ($query) {
        echo "<script>
			document.addEventListener('DOMContentLoaded', function() {
				swal('Berhasil!', 'Data Telah Ditambakan', 'success').then(function() {
					window.location = '../../?page=kategori';
				});
			});
		  </script>";
    }
}
// Edit Kategori
if (isset($_POST['edit-kat'])) {
    $id = $_POST['id-kat'];
    $kategori = $_POST['kategori'];

    $query = mysqli_query($koneksi, "UPDATE kategoribuku SET NamaKategori='$kategori' WHERE KategoriID='$id'");
	

    if ($query) {
        echo "<script>
			document.addEventListener('DOMContentLoaded', function() {
				swal('Berhasil!', 'Data Telah Edit', 'success').then(function() {
					window.location = '../../?page=kategori';
				});
			});
		  </script>";
    }
}
// Hapus Kategori
if (isset($_POST['hapus-kat'])) {
    $id = $_POST['id-kat'];

    $query = mysqli_query($koneksi, "DELETE FROM kategoribuku WHERE KategoriID='$id'");

    if ($query) {
        echo "<script>
			document.addEventListener('DOMContentLoaded', function() {
				swal('Berhasil!', 'Data Telah Dihapus', 'success').then(function() {
					window.location = '../../?page=kategori';
				});
			});
		  </script>";
    }
}

// Tambah Buku
if (isset($_POST['tambah-buku'])) {
	$judul = $_POST['judul'];
	$kategori = $_POST['kategori'];
	$penulis = $_POST['penulis'];
	$penerbit = $_POST['penerbit'];
	$tahun = $_POST['terbit'];
	$jumlah = $_POST['jumlah'];

	$query = mysqli_query($koneksi, "INSERT INTO buku(Judul, Penulis, Penerbit, TahunTerbit, Jumlah) VALUES ('$judul','$penulis','$penerbit','$tahun','$jumlah')");
	$getid = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY BukuID DESC LIMIT 1");
	$cek = mysqli_fetch_array($getid)[0];
	var_dump($cek);

	$ins = mysqli_query($koneksi, "INSERT INTO kategoribuku_relasi(BukuID, KategoriID) VALUES ($cek, $kategori)");

	if ($ins) {
		echo "<script>
			document.addEventListener('DOMContentLoaded', function() {
				swal('Berhasil!', 'Data Telah Ditambahkan', 'success').then(function() {
					window.location = '../../?page=buku';
				});
			});
		  </script>";
	}
}

// Edit Buku
if (isset($_POST['edit-buku'])) {
	$idbuku = $_POST['id-buku'];
	$judul = $_POST['judul'];
	$kategori = $_POST['kategori'];
	$penulis = $_POST['penulis'];
	$penerbit = $_POST['penerbit'];
	$tahun = $_POST['tahun'];

	$query = mysqli_query($koneksi, "UPDATE buku SET Judul='$judul', Penulis='$penulis', Penerbit='$penerbit', TahunTerbit='$tahun' WHERE BukuID='$idbuku' ");
	$getid = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY BukuID=$idbuku");
	$cek = mysqli_fetch_array($getid);
	$ins = mysqli_query($koneksi, "UPDATE kategoribuku_relasi SET KategoriID=$kategori WHERE BukuID=$idbuku AND KategoriID ");
	
	if ($ins) {
		echo "<script>
			document.addEventListener('DOMContentLoaded', function() {
				swal('Berhasil!', 'Data Telah Diubah', 'success').then(function() {
					window.location = '../../?page=buku';
				});
			});
		  </script>";
	}

};

// Hapus Buku
if (isset($_POST['hapus-buku'])) {
	$idbuku = $_POST['id-buku'];
	
	$query = mysqli_query($koneksi, "DELETE FROM kategoribuku_relasi WHERE KategoriBukuID='$idbuku'");

	if ($query) {
		echo "<script>
			document.addEventListener('DOMContentLoaded', function() {
				swal('Berhasil!', 'Data Hapus', 'success').then(function() {
					window.location = '../../?page=buku';
				});
			});
		  </script>";
	}
}

// Buku Masuk
if (isset($_POST['bukumasuk'])) {
	$idbuku = $_POST['judul'];
	$jumlah = $_POST['jumlah'];

	$query = mysqli_query($koneksi, "SELECT Jumlah FROM buku WHERE BukuID='$idbuku'");
	$jumlahlama = mysqli_fetch_array($query)[0];
	var_dump($jumlahlama);

	$jumlahbaru = $jumlahlama + $jumlah;

	$data1 = mysqli_query($koneksi, "SELECT * FROM kategoribuku_relasi WHERE BukuID=$idbuku");
	$hasil = mysqli_query($koneksi, "UPDATE buku SET Jumlah=$jumlahbaru WHERE BukuID=$idbuku ");

	if ($hasil) {
		echo "<script>
			document.addEventListener('DOMContentLoaded', function() {
				swal('Berhasil!', 'Buku Berhasil Ditambahkan', 'success').then(function() {
					window.location = '../../?page=buku';
				});
			});
		  </script>";
	}
}
// Buku Rusak
if (isset($_POST['bukurusak'])) {
	$idbuku = $_POST['judul'];
	$jumlah = $_POST['jumlah'];

	$query = mysqli_query($koneksi, "SELECT Jumlah FROM buku WHERE BukuID='$idbuku'");
	$jumlahlama = mysqli_fetch_array($query)[0];
	if ($jumlah > $jumlahlama) {
		echo "<script>
			document.addEventListener('DOMContentLoaded', function() {
				swal('Gagal!', 'Jumlah Buku Rusak tidak sesuai dengan buku sebelumnya', 'error').then(function() {
					window.location = '../../?page=buku';
				});
			});
		  </script>";
		exit;
	}

	$jumlahbaru = $jumlahlama - $jumlah;

	$data1 = mysqli_query($koneksi, "SELECT * FROM kategoribuku_relasi WHERE BukuID=$idbuku");
	$hasil = mysqli_query($koneksi, "UPDATE buku SET Jumlah=$jumlahbaru WHERE BukuID=$idbuku ");

	if ($hasil) {
		echo "<script>
			document.addEventListener('DOMContentLoaded', function() {
				swal('Berhasil!', 'Buku Berhasil Dibuang', 'success').then(function() {
					window.location = '../../?page=buku';
				});
			});
		  </script>";
	}else{
		echo "<script>
			document.addEventListener('DOMContentLoaded', function() {
				swal('Gagal!', 'Buku Rusak Gagal', 'error').then(function() {
					window.location = '../../?page=buku';
				});
			});
		  </script>";
	}

}

// Tambah Peminjaman
if (isset($_POST['tambahpeminjaman'])) {
	$anggota = $_POST['idanggota']; 
	$judul = $_POST['judul']; 
	$peminjaman = $_POST['tanggalpeminjaman']; 
	$status = $_POST['status'];

	$query = mysqli_query($koneksi, "INSERT INTO peminjaman(UserID, BukuID, TanggalPeminjaman, StatusPeminjaman) VALUES ('$anggota','$judul','$peminjaman','$status')");
	
	if ($query) {
		echo "<script>
			document.addEventListener('DOMContentLoaded', function() {
				swal('Berhasil!', 'Buku di Pinjam', 'success').then(function() {
					window.location = '../../?page=peminjaman';
				});
			});
		  </script>";
	}
}
// Hapus Peminjaman
if (isset($_POST['hapuspeminjaman'])) {
	$peminjaman = $_POST['idpeminjaman']; 

	$query = mysqli_query($koneksi, "DELETE FROM peminjaman WHERE PeminjamanID=$peminjaman");
	
	if ($query) {
		echo "<script>
			document.addEventListener('DOMContentLoaded', function() {
				swal('Berhasil!', 'Histori Peminjaman Dihapus', 'success').then(function() {
					window.location = '../../?page=peminjaman';
				});
			});
		  </script>";
	}
}

// Tambah Koleksi
if (isset($_POST['tambahkoleksi'])) {
	$id = $_POST['idanggota'];
	$judul = $_POST['buku'];

	$query = mysqli_query($koneksi, "INSERT INTO koleksipribadi(BukuID, UserID) VALUES ('$judul', '$id')");

	if ($query) {
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
			swal('Berhasil', 'Buku Telah Di Tambahkan Di Koleksi Pribadi Anda', 'success').then(function() {
				window.location= '../../?page=koleksi';
			});
		});
		</script>";
	}
}

// Tambah Anggota
if (isset($_POST['tambahuser'])) {
	$nm = $_POST['nama'];
	$user = $_POST['username'];
	$email = $_POST['email'];
	$alamat = $_POST['alamat'];
	$status = $_POST['status'];
	$password = md5( $_POST['password']);

	$query = mysqli_query($koneksi, "INSERT INTO user(Username, Password, Email, NamaLengkap, Alamat, Level) VALUES ('$user', '$password', '$email', '$nm', '$alamat', '$status')");

	if ($query) {
		echo "<script>
		document.addEventListener('DOMContentLoaded', function(){
			swal('Berhasil', 'Tambah Anggota Berhasil', 'success').then(function() {
				window.location = '../../?page=anggota';
			});
		});
	</script>";
	}
}
// Edit Anggota
if (isset($_POST['edituser'])) {
	$id = $_POST['iduser'];
	$nm = $_POST['nama'];
	$user = $_POST['username'];
	$email = $_POST['email'];
	$alamat = $_POST['alamat'];
	$status = $_POST['status'];

	$query = mysqli_query($koneksi, "UPDATE user SET NamaLengkap='$nm', Username='$user', Email='$email', Alamat='$alamat', Level='$status' WHERE UserID='$id'");

	if ($query) {
		echo "<script>
		document.addEventListener('DOMContentLoaded', function(){
			swal('Berhasil', 'Ubah Anggota Berhasil', 'success').then(function() {
				window.location = '../../?page=user';
			});
		});
	</script>";
	}
}
// Hapus Anggota
if (isset($_POST['hapususer'])) {
	$id = $_POST['iduser'];

	$query = mysqli_query($koneksi, "DELETE FROM user WHERE UserID=$id");

	if ($query) {
		echo "<script>
		document.addEventListener('DOMContentLoaded', function(){
			swal('Berhasil', 'Hapus Anggota Berhasil', 'success').then(function() {
			window.location = '../../?page=user';
			});
		});
		</script>";
	}
}
// Tambah Ulasan
if (isset($_POST['tambahulasan'])) {
	$id = $_POST['iduser'];
	$judul = $_POST['judul'];
	$ulasan = $_POST['ulasan'];
	$rating = $_POST['rating'];

	$query = mysqli_query($koneksi, "INSERT INTO ulasanbuku(UserID, BukuID, Ulasan, Rating) VALUES ('$id','$judul','$ulasan','$rating')");

	if ($query) {
		echo "<script>
		document.addEventListener('DOMContentLoaded', function(){
			swal('Berhasil', 'Terimakasih Telah Memberi Ulasan', 'success').then(function() {
			window.location = '../../?page=ulasan';
			});
		});
		</script>";
	}
}

// Hapus Ulasan
if (isset($_POST['hapusulasan'])) {
	$id = $_POST['idulasan'];

	$query = mysqli_query($koneksi, "DELETE FROM ulasanbuku WHERE UlasanID=$id");

	if ($query) {
		echo "<script>
			document.addEventListener('DOMContentLoaded', function() {
				swal('Berhasil', 'Hapus Ulasan, Jika Kurang Lebihnya Silahkan Beri Kami Ulasan Kembali', 'success').then(function() {
				window.location = '../../?page=ulasan';
				});
			});
		</script>";
	}

}
?>