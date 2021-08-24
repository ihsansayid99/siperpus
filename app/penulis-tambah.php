<?php
	/* Kondisi jika tidak melakukan simpan/ submit, maka tampilkan formulir */
	if(!isset($_POST['simpan'])) {
		// Mempersiapkan Kode Terbesar 
		$query2 = mysqli_query($db_conn, "SELECT max(id_penulis) as id_penulis FROM penulis");
		$data = mysqli_fetch_array($query2);
		$id_penulis_number = $data['id_penulis'];

		$urutan = (int) substr($id_penulis_number, 2, 3);
		$urutan++;

		$id_penulis_number = 'PL' . sprintf("%03s", $urutan);
?>
<div id="container">
	<div class="page-title">
		<h3>Tambah Data Penulis</h3>
	</div>
	<div class="page-content">
		<form class="my-4" action="" method="post">
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="id_penulis">ID Penulis</label>
					<input type="text" class="form-control" name="id_penulis" value="<?php echo $id_penulis_number; ?>" readonly>
				</div>
				<div class="form-group col-md-6">
					<label for="nama_penulis">Nama Penulis</label>
					<input type="text" class="form-control" name="nama_penulis" placeholder="Masukan nama Penulis">
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
		$sql = "INSERT INTO penulis
				VALUES('{$id_penulis}', '{$nama_penulis}')";
		$query = mysqli_query($db_conn, $sql);
		// mengalihkan halaman
		echo "<meta http-equiv='refresh' content='0; url=index.php?p=penulis'>";
	}
?>