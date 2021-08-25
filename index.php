<?php
	include './config/konfigurasi-umum.php';
	include './config/koneksi-db.php';
	include './helpers/helper_umum.php';
	include('app/layout/header.php');
	session_start();
	include('app/layout/sidebar-menu.php');
	if(!isset($_SESSION['sesi'])){
		header('location:login.php');
	} 
?>
<div class="col-md-10 bg-white py-3">
	<?php include('app/layout/container.php'); ?>
</div>
<?php include('app/layout/footer.php'); ?>
		