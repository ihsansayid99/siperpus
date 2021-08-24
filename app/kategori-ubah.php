<?php
if(!isset($_POST['simpan'])) {
	if(isset($_GET['id'])) { // memperoleh kategori_id
		$id_kategori = $_GET['id'];
		if(!empty($id_kategori)) {
			// Query
			$sql = "SELECT * FROM kategori WHERE id_kategori = '{$id_kategori}';";
			$query = mysqli_query($db_conn, $sql);
			$row = $query->num_rows;
			if($row > 0) {
				$data = mysqli_fetch_array($query); // memperoleh data kategori
			} else {
echo "<script>alert('ID Kategori tidak ditemukan!');</script>";
// mengalihkan halaman
echo "<meta http-equiv='refresh' content='0; url=index.php?p=kategori'>";
exit;
}
} else {
echo "<script>alert('ID kategori kosong!');</script>";
// mengalihkan halaman
echo "<meta http-equiv='refresh' content='0; url=index.php?p=kategori'>";
exit;
}
} else {
echo "<script>alert('ID Kategori tidak didefinisikan!');</script>";
// mengalihkan halaman
echo "<meta http-equiv='refresh' content='0; url=index.php?p=kategori'>";
exit;
}
?>
<div id="container">
	<div class="page-title">
		<h3>Ubah Data Kategori</h3>
	</div>
	<div class="page-content">
		<form class="my-4" action="" method="post">
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="id_kategori">ID Kategori</label>
					<input type="text" class="form-control" name="id_kategori" value="<?php echo $data['id_kategori']; ?>" readonly>
				</div>
				<div class="form-group col-md-6">
					<label for="nama_kategori">Nama Kategori</label>
					<input type="text" class="form-control" name="nama_kategori" value="<?php echo $data['nama_kategori']; ?>">
				</div>
			</div>
			<input type="submit" class="btn btn-primary w-100" name="simpan" value="Simpan" />
		</form>
	</div>
</div>
<?php
	} else {
		/* Proses Penyimpanan Data dari Form */
			$id_kategori 	= $_POST['id_kategori'];
			$nama_kategori 	= $_POST['nama_kategori'];
		// Query
		$sql = "UPDATE kategori
						SET nama_kategori 	= '{$nama_kategori}'
						WHERE id_kategori	='{$id_kategori}'";
		$query = mysqli_query($db_conn, $sql);
		
		if(!$query) {
			echo "<script>alert('Data gagal diubah!');</script>";
		}
		// mengalihkan halaman
		echo "<meta http-equiv='refresh' content='0; url=index.php?p=kategori'>";
	}
?>