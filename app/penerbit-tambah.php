<?php
	/* Kondisi jika tidak melakukan simpan/ submit, maka tampilkan formulir */
	if(!isset($_POST['simpan'])) {
		// Mempersiapkan Kode Terbesar 
		$query2 = mysqli_query($db_conn, "SELECT max(id_penerbit) as id_penerbit FROM penerbit");
		$data = mysqli_fetch_array($query2);
		$id_penerbit_number = $data['id_penerbit'];

		$urutan = (int) substr($id_penerbit_number, 2, 3);
		$urutan++;

		$id_penerbit_number = 'PN' . sprintf("%03s", $urutan);
?>
<div id="container">
	<div class="page-title">
		<h3>Tambah Data Penerbit</h3>
	</div>
	<div class="page-content">
		<form class="my-4" action="" method="post">
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="id_penerbit">ID Penerbit</label>
					<input type="text" class="form-control" name="id_penerbit" value="<?php echo $id_penerbit_number; ?>" readonly>
				</div>
				<div class="form-group col-md-6">
					<label for="nama_penerbit">Nama Penerbit</label>
					<input type="text" class="form-control" name="nama_penerbit" placeholder="Masukan nama Penerbit">
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
		$sql = "INSERT INTO penerbit
				VALUES('{$id_penerbit}', '{$nama_penerbit}')";
		$query = mysqli_query($db_conn, $sql);
		// mengalihkan halaman
		echo "<meta http-equiv='refresh' content='0; url=index.php?p=penerbit'>";
	}
?>