<?php
if(!isset($_POST['simpan'])) {
	if(isset($_GET['id'])) { // memperoleh penerbit_id
		$id_penerbit = $_GET['id'];
		if(!empty($id_penerbit)) {
			// Query
			$sql = "SELECT * FROM penerbit WHERE id_penerbit = '{$id_penerbit}';";
			$query = mysqli_query($db_conn, $sql);
			$row = $query->num_rows;
			if($row > 0) {
				$data = mysqli_fetch_array($query); // memperoleh data penerbit
			} else {
echo "<script>alert('ID penerbit tidak ditemukan!');</script>";
// mengalihkan halaman
echo "<meta http-equiv='refresh' content='0; url=index.php?p=penerbit'>";
exit;
}
} else {
echo "<script>alert('ID penerbit kosong!');</script>";
// mengalihkan halaman
echo "<meta http-equiv='refresh' content='0; url=index.php?p=penerbit'>";
exit;
}
} else {
echo "<script>alert('ID penerbit tidak didefinisikan!');</script>";
// mengalihkan halaman
echo "<meta http-equiv='refresh' content='0; url=index.php?p=kategori'>";
exit;
}
?>
<div id="container">
	<div class="page-title">
		<h3>Ubah Data Penerbit</h3>
	</div>
	<div class="page-content">
		<form class="my-4" action="" method="post">
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="id_penerbit">ID Penerbit</label>
					<input type="text" class="form-control" name="id_penerbit" value="<?php echo $data['id_penerbit']; ?>" readonly>
				</div>
				<div class="form-group col-md-6">
					<label for="nama_penerbit">Nama Penerbit</label>
					<input type="text" class="form-control" name="nama_penerbit" value="<?php echo $data['nama_penerbit']; ?>">
				</div>
			</div>
			<input type="submit" class="btn btn-primary w-100" name="simpan" value="Simpan" />
		</form>
	</div>
</div>
<?php
	} else {
		/* Proses Penyimpanan Data dari Form */
			$id_penerbit 	= $_POST['id_penerbit'];
			$nama_penerbit 	= $_POST['nama_penerbit'];
		// Query
		$sql = "UPDATE penerbit
						SET nama_penerbit 	= '{$nama_penerbit}'
						WHERE id_penerbit	='{$id_penerbit}'";
		$query = mysqli_query($db_conn, $sql);
		
		if(!$query) {
			echo "<script>alert('Data gagal diubah!');</script>";
		}
		// mengalihkan halaman
		echo "<meta http-equiv='refresh' content='0; url=index.php?p=penerbit'>";
	}
?>