<?php

if(!isset($_POST['simpan'])) {
	if(isset($_GET['id'])) { // memperoleh penulis_id
		$id_penulis = $_GET['id'];
		if(!empty($id_penulis)) {
			// Query
			$sql = "SELECT * FROM penulis WHERE id_penulis = '{$id_penulis}';";
			$query = mysqli_query($db_conn, $sql);
			$row = $query->num_rows;
			if($row > 0) {
				$data = mysqli_fetch_array($query); // memperoleh data penulis
			} else {
echo "<script>alert('ID penulis tidak ditemukan!');</script>";
// mengalihkan halaman
echo "<meta http-equiv='refresh' content='0; url=index.php?p=penulis'>";
exit;
}
} else {
echo "<script>alert('ID penulis kosong!');</script>";
// mengalihkan halaman
echo "<meta http-equiv='refresh' content='0; url=index.php?p=penulis'>";
exit;
}
} else {
echo "<script>alert('ID penulis tidak didefinisikan!');</script>";
// mengalihkan halaman
echo "<meta http-equiv='refresh' content='0; url=index.php?p=kategori'>";
exit;
}
?>
<div id="container">
	<div class="page-title">
		<h3>Ubah Data Penulis</h3>
	</div>
	<div class="page-content">
		<form class="my-4" action="" method="post">
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="id_penulis">ID Penulis</label>
					<input type="text" class="form-control" name="id_penulis" value="<?php echo $data['id_penulis']; ?>" readonly>
				</div>
				<div class="form-group col-md-6">
					<label for="nama_penulis">Nama Penulis</label>
					<input type="text" class="form-control" name="nama_penulis" value="<?php echo $data['nama_penulis']; ?>">
				</div>
			</div>
			<input type="submit" class="btn btn-primary w-100" name="simpan" value="Simpan" />
		</form>
	</div>
</div>
<?php
	} else {
		/* Proses Penyimpanan Data dari Form */
			$id_penulis 	= $_POST['id_penulis'];
			$nama_penulis 	= $_POST['nama_penulis'];
		// Query
		$sql = "UPDATE penulis
						SET nama_penulis 	= '{$nama_penulis}'
						WHERE id_penulis	='{$id_penulis}'";
		$query = mysqli_query($db_conn, $sql);
		
		if(!$query) {
			echo "<script>alert('Data gagal diubah!');</script>";
		}
		// mengalihkan halaman
		echo "<meta http-equiv='refresh' content='0; url=index.php?p=penulis'>";
	}
?>