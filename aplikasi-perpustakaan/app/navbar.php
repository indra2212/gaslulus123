<?php
require_once 'network/koneksi.php';

?>    
    <nav class="navbar navbar-expand navbar-light navbar-bg">
        <a class="sidebar-toggle js-sidebar-toggle">
            <i class="hamburger align-self-center"></i>
        </a>
        <?php
        $id = $_SESSION['id'];
        $query = mysqli_query($koneksi, "SELECT * FROM user WHERE UserID = $id");
        $data = mysqli_fetch_array($query);
        ?>        
        <div class="navbar-collapse collapse">
            <ul class="navbar-nav navbar-align">
                <li class="nav-item dropdown">
                    <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
        <i class="align-middle" data-feather="settings"></i>
        </a>

                    <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <span class="text-dark"><?= $_SESSION['nama']?></span>
        </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="?page=profile"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                        <a class="dropdown-item" href="?page=loginhistory"><i class="align-middle me-1" data-feather="pie-chart"></i>Riwayat Login</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="app/logout.php">Log out</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
