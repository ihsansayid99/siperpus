<?php
	include './config/konfigurasi-umum.php';
	session_start();
	include './config/koneksi-db.php';
	include './helpers/helper_umum.php';
	if(isset($_SESSION['sesi'])){
?>

<?php 
	include('app/layout/header.php');
	include('app/layout/sidebar-menu.php');
?>

<div class="col-md-10 bg-white py-3">
	<?php include('app/layout/container.php'); ?>
</div>

<?php include('app/layout/footer.php'); ?>
		
<?php 
}else{
    echo "<meta http-equiv='refresh' content='0; url=login.php'>";
} 
?>