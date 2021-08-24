<?php
if(!isset($_POST['simpan'])) {
	if(isset($_GET['id'])) { // memperoleh buku_id
		$id_buku = $_GET['id'];
		if(!empty($id_buku)) {
			// Query
			$sql = "SELECT * FROM buku WHERE id_buku = '{$id_buku}';";
			$query = mysqli_query($db_conn, $sql);
			$row = $query->num_rows;
			if($row > 0) {
				$data = mysqli_fetch_array($query); // memperoleh data buku
			} else {
echo "<script>alert('ID buku tidak ditemukan!');</script>";
// mengalihkan halaman
echo "<meta http-equiv='refresh' content='0; url=index.php?p=buku'>";
exit;
}
} else {
echo "<script>alert('ID buku kosong!');</script>";
// mengalihkan halaman
echo "<meta http-equiv='refresh' content='0; url=index.php?p=buku'>";
exit;
}
} else {
echo "<script>alert('ID buku tidak didefinisikan!');</script>";
// mengalihkan halaman
echo "<meta http-equiv='refresh' content='0; url=index.php?p=buku'>";
exit;
}
?>
<div id="container">
	<div class="page-title">
		<h3>Ubah Data Buku</h3>
	</div>
	<div class="page-content">
		<form class="my-4" action="" method="post">
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="id_buku">ID Buku</label>
					<input type="text" class="form-control" name="id_buku" value="<?php echo $data['id_buku']; ?>" readonly>
				</div>
				<div class="form-group col-md-6">
					<label for="judul_buku">Judul</label>
					<input type="text" class="form-control" name="judul_buku" value="<?php echo $data['judul_buku'] ?>">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label>Kategori</label>
					<select name="id_kategori" class="form-control">
						<?php 
							$query_kategori = mysqli_query($db_conn, "SELECT * from kategori");
							while($data_kategori = mysqli_fetch_array($query_kategori)){
						?>
						<option value="<?=$data_kategori['id_kategori'] ?>" <?php echo ($data['id_kategori'] == $data_kategori['id_kategori'] ? 'selected' : '') ?>><?=$data_kategori['nama_kategori'] ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group col-md-6">
					<label>Penulis</label>
					<select name="id_penulis" class="form-control">
						<?php 
							$query_penulis = mysqli_query($db_conn, "SELECT * from penulis");
							while($data_penulis = mysqli_fetch_array($query_penulis)){
						?>
						<option value="<?=$data_penulis['id_penulis'] ?>" <?php echo ($data['id_penulis'] == $data_penulis['id_penulis'] ? 'selected' : '') ?>><?=$data_penulis['nama_penulis'] ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label>Penerbit</label>
					<select name="id_penerbit" class="form-control">
						<?php 
							$query_penerbit = mysqli_query($db_conn, "SELECT * from penerbit");
							while($data_penerbit = mysqli_fetch_array($query_penerbit)){
						?>
						<option value="<?=$data_penerbit['id_penerbit'] ?>" <?php echo ($data['id_penerbit'] == $data_penerbit['id_penerbit'] ? 'selected' : '') ?>><?=$data_penerbit['nama_penerbit'] ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group col-md-6">
					<label>Status</label><br>
					<input type="radio" name="status" value="Tersedia" id="tersedia" required <?php echo ($data['status'] == 'Tersedia' ? 'checked' : '') ?>>
					<label for="tersedia">Tersedia</label>
					<input type="radio" name="status" value="Dipinjam" id="dipinjam" required <?php echo ($data['status'] == 'Dipinjam' ? 'checked' : '') ?>>
					<label for="dipinjam">Dipinjam</label>
				</div>
			</div>
			<input type="submit" class="btn btn-primary w-100" name="simpan" value="Ubah" />
		</form>
	</div>
</div>
<?php
	} else {
		/* Proses Penyimpanan Data dari Form */
			$id_buku 	= $_POST['id_buku'];
			$judul_buku 	= $_POST['judul_buku'];
			$id_kategori 	= $_POST['id_kategori'];
			$id_penulis 	= $_POST['id_penulis'];
			$id_penerbit 	= $_POST['id_penerbit'];
			$status 	= $_POST['status'];
		// Query
		$sql = "UPDATE buku
						SET judul_buku 	= '{$judul_buku}',
							id_kategori = '{$id_kategori}',
							id_penulis = '{$id_penulis}',
							id_penerbit = '{$id_penerbit}',
							status = '{$status}'
						WHERE id_buku	='{$id_buku}'";
		$query = mysqli_query($db_conn, $sql);
		
		if(!$query) {
			echo "<script>alert('Data gagal diubah!');</script>";
		}
		// mengalihkan halaman
		echo "<meta http-equiv='refresh' content='0; url=index.php?p=buku'>";
	}
?>