<?php
	/* Kondisi jika tidak melakukan simpan/ submit, maka tampilkan formulir */
	if(!isset($_POST['simpan'])) {
		// Mempersiapkan Kode Terbesar 
		$query2 = mysqli_query($db_conn, "SELECT max(id_kategori) as id_kategori FROM kategori");
		$data = mysqli_fetch_array($query2);
		$id_kategori_number = $data['id_kategori'];

		$urutan = (int) substr($id_kategori_number, 2, 3);
		$urutan++;

		$id_anggota_number = 'KT' . sprintf("%03s", $urutan);
?>
<div id="container">
	<div class="page-title">
		<h3>Tambah Data Kategori</h3>
	</div>
	<div class="page-content">
		<form class="my-4" enctype="multipart/form-data" action="" method="post">
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="id_anggota">ID Kategori</label>
					<input type="text" class="form-control" name="id_kategori" value="<?php echo $id_anggota_number; ?>" readonly>
				</div>
				<div class="form-group col-md-6">
					<label for="name_lengkap">Nama Lengkap</label>
					<input type="text" class="form-control" name="nama_kategori" placeholder="Masukan nama Kategori">
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
		$sql = "INSERT INTO kategori
				VALUES('{$id_kategori}', '{$nama_kategori}')";
		$query = mysqli_query($db_conn, $sql);
		// mengalihkan halaman
		echo "<meta http-equiv='refresh' content='0; url=index.php?p=kategori'>";
	}
?>