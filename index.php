<?php
	include './config/konfigurasi-umum.php';
	include './config/koneksi-db.php';
	include './helpers/helper_umum.php';
	nama_d($_SESSION);
?>

<?php 
	include('app/layout/header.php');
	include('app/layout/sidebar-menu.php');
?>

<div class="col-md-10 bg-white py-3">
	<?php include('app/layout/container.php'); ?>
</div>

<?php include('app/layout/footer.php'); ?>
	