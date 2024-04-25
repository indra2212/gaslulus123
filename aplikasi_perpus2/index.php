<?php
require_once 'sessi/koneksi.php';
include 'layout/header.php';
include 'layout/sidebar.php';
include 'layout/topbar.php';
?>
			<main class="content">
				<?php
				$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
				if (file_exists("route/{$page}.php")) {
					include "route/{$page}.php";
				}else{
					include "sessi/action/{$page}.php";
				}
				?>
			</main>

<?php
include 'layout/footer.php';
include 'layout/script.php';
?>
