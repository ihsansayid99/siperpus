<?php
if(!isset($_POST['simpan'])) {
	if(isset($_GET['id'])) { // memperoleh anggota_id
		$id_anggota = $_GET['id'];
		if(!empty($id_anggota)) {
			// Query
			$sql = "SELECT * FROM tbanggota WHERE idanggota = '{$id_anggota}';";
			$query = mysqli_query($db_conn, $sql);
			$row = $query->num_rows;
			if($row > 0) {
				$data = mysqli_fetch_array($query); // memperoleh data anggota
// echo '<pre>';
	// var_dump($data);
				// echo '</pre>';
			} else {
echo "<script>alert('ID Anggota tidak ditemukan!');</script>";
// mengalihkan halaman
echo "<meta http-equiv='refresh' content='0; url=index.php?p=anggota'>";
exit;
}
} else {
echo "<script>alert('ID Anggota kosong!');</script>";
// mengalihkan halaman
echo "<meta http-equiv='refresh' content='0; url=index.php?p=anggota'>";
exit;
}
} else {
echo "<script>alert('ID Anggota tidak didefinisikan!');</script>";
// mengalihkan halaman
echo "<meta http-equiv='refresh' content='0; url=index.php?p=anggota'>";
exit;
}
?>
<div id="container">
	<div class="page-title">
		<h3>Ubah Data Anggota</h3>
	</div>
	<div class="page-content">
		<form class="my-4" enctype="multipart/form-data" action="" method="post">
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="id_anggota">ID Anggota</label>
					<input type="text" class="form-control" name="id_anggota" value="<?php echo $data['idanggota']; ?>" readonly>
				</div>
				<div class="form-group col-md-6">
					<label for="name_lengkap">Nama Lengkap</label>
					<input type="text" class="form-control" name="nama_lengkap" value="<?php echo $data['nama']; ?>">
				</div>
			</div>
			<div class="form-group col-md-12">
				<input type="radio" name="jenis_kelamin" value="L" id="jk_pria" required <?php echo ($data['jeniskelamin'] == 'L') ? 'checked' : ''; ?>>
				<label for="jk_pria">Pria</label>
				<input type="radio" name="jenis_kelamin" value="P" id="jk_wanita" required <?php echo ($data['jeniskelamin'] == 'P') ? 'checked' : ''; ?>>
				<label for="jk_wanita">Wanita</label>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="foto">Upload Foto</label>
					<input type="file" name="foto" id="foto" class="form-control">
					<input type="hidden" name="foto_tmp" id="foto_tmp" value="<?php echo $data['foto']; ?>">
				</div>
				<div class="form-group col-md-6">
					<label for="alamat">Alamat</label>
					<textarea rows="3" cols="40" name="alamat" class="form-control" required><?php echo $data['alamat']; ?></textarea>
				</div>
			</div>
			<div class="form-row">
				<label>Status Aktif</label>
				<div class="form-group col-md-12">
					<input type="radio" name="status_aktif" value="Y" id="status_true" <?php echo ($data['status'] == 'Y') ? 'checked' : ''; ?> required>
					<label for="status_true">Ya</label>
					<input type="radio" name="status_aktif" value="T" id="status_false" <?php echo ($data['status'] == 'T') ? 'checked' : ''; ?> required>
					<label for="status_false">Tidak</label>
				</div>
			</div>
			<input type="submit" class="btn btn-primary w-100" name="simpan" value="Simpan" />
		</form>
	</div>
</div>
<?php
	} else {
		/* Proses Penyimpanan Data dari Form */
			$id_anggota 	= $_POST['id_anggota'];
			$nama_lengkap 	= $_POST['nama_lengkap'];
			$jenis_kelamin	= $_POST['jenis_kelamin'];
			$alamat			= $_POST['alamat'];
			$file_foto 		= $_FILES['foto']['name'];
			$file_foto_tmp	= $_POST['foto_tmp'];
			$status_aktif	= $_POST['status_aktif'];
		if(!empty($file_foto)) {
			// Rename file foto. Contoh: foto-AG007.jpg
			$ext_file = pathinfo($file_foto, PATHINFO_EXTENSION);
			$file_foto_rename = 'foto-' . $id_anggota . '.' . $ext_file;
			$dir_images = './images/';
			$path_image = $dir_images . $file_foto_rename;
			$file_foto = $file_foto_rename; // untuk keperluan Query UPDATE
			// Jika file foto sudah tersedia
			if(file_exists($path_image)) {
				unlink($path_image); // file foto dihapus
			}
			move_uploaded_file($_FILES['foto']['tmp_name'], $path_image);
		} else {
			$file_foto = $file_foto_tmp; // jika tidak diubah gunakan yang sudah ada sebelumnya
		}
		// Query
		$sql = "UPDATE tbanggota
						SET nama 	= '{$nama_lengkap}',
							jeniskelamin 	= '{$jenis_kelamin}',
							alamat 			= '{$alamat}',
							foto			= '{$file_foto}',
							status	= '{$status_aktif}'
						WHERE idanggota	='{$id_anggota}'";
		$query = mysqli_query($db_conn, $sql);
		
		if(!$query) {
echo "<script>alert('Data gagal diubah!');</script>";
}
// mengalihkan halaman
echo "<meta http-equiv='refresh' content='0; url=index.php?p=anggota'>";
}
?>