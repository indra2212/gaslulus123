<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'Dashboard';
?>
<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.html">
					<span class="align-middle">Perpustakaan</span>
				</a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Home
					</li>
					<li class="sidebar-item <?php if (empty($_GET['page'])) {echo 'active';}?>">
						<a class="sidebar-link" href="index.php">
							 <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
						</a>
					</li>
					<?php
					if ($_SESSION['status'] == 'admin' || $_SESSION['status'] == 'petugas') {
					?>

					<li class="sidebar-item <?php if ($page == "kategori") {echo 'active';}?>">
						<a class="sidebar-link" href="?page=kategori">
							<i class="align-middle" data-feather="list"></i> <span class="align-middle">Kategori Buku</span>
						</a>
					</li>

					<li class="sidebar-item <?php if ($page == "buku") {echo 'active';}?>">
						<a class="sidebar-link" href="?page=buku">
							<i class="align-middle" data-feather="book-open"></i> <span class="align-middle">Buku</span>
						</a>
					</li>

					<?php
					}
					?>

					<li class="sidebar-item <?php if ($page == "peminjaman") {echo 'active';}?>">
						<a class="sidebar-link" href="?page=peminjaman">
							<i class="align-middle" data-feather="archive"></i> <span class="align-middle">Peminjaman</span>
						</a>
					</li>
					<li class="sidebar-item <?php if ($page == "koleksi") {echo 'active';}?>">
						<a class="sidebar-link" href="?page=koleksi">
							<i class="align-middle" data-feather="bookmark"></i> <span class="align-middle">Koleksi Pribadi</span>
						</a>
					</li>
					<?php
					if ($_SESSION['status'] == 'admin' || $_SESSION['status'] == 'petugas') {
					?>
					<li class="sidebar-item <?php if ($page == "user") {echo 'active';}?>">
						<a class="sidebar-link" href="?page=user">
							<i class="align-middle" data-feather="users"></i> <span class="align-middle">Anggota</span>
						</a>
					</li>
					<?php
					}
					?>
					<li class="sidebar-item <?php if ($page == "ulasan") {echo 'active';}?>">
						<a class="sidebar-link" href="?page=ulasan">
							<i class="align-middle" data-feather="star"></i> <span class="align-middle">Ulasan Buku</span>
						</a>
					</li>

					
					<li class="sidebar-header">
						Riwayat
					</li>

					<li class="sidebar-item <?php if ($page == "rwpeminjaman") {echo 'active';}?>">
						<a class="sidebar-link" href="?page=rwpeminjaman">
              				<i class="align-middle" data-feather="list"></i> <span class="align-middle">Riwayat Peminjaman</span>
            			</a>
					</li>

				</ul>

				<div class="sidebar-cta">
					<div class="sidebar-cta-content">
						<div class="d-grid">
							<a href="upgrade-to-pro.html" class="btn btn-primary">Cetak</a>
						</div>
					</div>
				</div>
			</div>
		</nav>
