<?php
require_once 'network/koneksi.php';
require_once 'app/header.php';
?>
<body>
    <div class="wrapper">
    <?php
    include 'app/sidebar.php';
    ?>
        <div class="main">
		<?php
        include 'app/navbar.php';
        ?>
        <?php
        $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
        if (file_exists("app/{$page}.php")) {
            include "app/{$page}.php";
        } else {
            include "route/{$page}.php";
        }
        ?>
        <?php
        include 'app/footer.php';
        ?>
        </div>
	</div>
    
<script src="asset/js/app.js"></script>
<script src="asset/js/function.js"></script>


</body>

</html>