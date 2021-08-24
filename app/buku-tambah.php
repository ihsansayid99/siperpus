<?php
	/* Kondisi jika tidak melakukan simpan/ submit, maka tampilkan formulir */
	if(!isset($_POST['simpan'])) {
		// Mempersiapkan Kode Terbesar
		$query2 = mysqli_query($db_conn, "SELECT max(id_buku) as id_buku FROM buku");
		$data = mysqli_fetch_array($query2);
		$id_buku_number = $data['id_buku'];
		$urutan = (int) substr($id_buku_number, 2, 3);
		$urutan++;
		$id_buku_number = 'BK' . sprintf("%03s", $urutan);
?>
<div id="container">
	<div class="page-title">
		<h3>Tambah Data Buku</h3>
	</div>
	<div class="page-content">
		<form class="my-4" action="" method="post">
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="id_buku">ID Buku</label>
					<input type="text" class="form-control" name="id_buku" value="<?php echo $id_buku_number; ?>" readonly>
				</div>
				<div class="form-group col-md-6">
					<label for="judul_buku">Judul</label>
					<input type="text" class="form-control" name="judul_buku" placeholder="Masukan Judul Buku">
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
						<option value="<?=$data_kategori['id_kategori'] ?>"><?=$data_kategori['nama_kategori'] ?></option>
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
						<option value="<?=$data_penulis['id_penulis'] ?>"><?=$data_penulis['nama_penulis'] ?></option>
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
						<option value="<?=$data_penerbit['id_penerbit'] ?>"><?=$data_penerbit['nama_penerbit'] ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group col-md-6">
					<label>Status</label><br>
					<input type="radio" name="status" value="Tersedia" id="tersedia" required>
					<label for="tersedia">Tersedia</label>
					<input type="radio" name="status" value="Dipinjam" id="dipinjam" required>
					<label for="dipinjam">Dipinjam</label>
				</div>
			</div>
			<input type="submit" class="btn btn-primary w-100" name="simpan" value="Simpan" />
		</form>
	</div>
</div>
<?php
	} else {
		/* Proses Penyimpanan Data dari Form */
				$id_buku 		= $_POST['id_buku'];
				$judul_buku 	= $_POST['judul_buku'];
				$id_kategori	= $_POST['id_kategori'];
				$id_penulis		= $_POST['id_penulis'];
				$id_penerbit 	= $_POST['id_penerbit'];
				$status			= $_POST['status'];
		// Query
		$sql = "INSERT INTO buku
				VALUES('{$id_buku}', '{$judul_buku}', '{$id_kategori}',
						'{$id_penulis}','{$id_penerbit}', '{$status}')";
		$query = mysqli_query($db_conn, $sql);
		// mengalihkan halaman
		echo "<meta http-equiv='refresh' content='0; url=index.php?p=buku'>";
	}
?>