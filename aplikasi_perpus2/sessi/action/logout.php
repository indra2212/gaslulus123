<?php 
require_once '../koneksi.php';
session_destroy();
header("location:login.php"); 
exit; 
?>
