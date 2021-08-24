<?php
	/* Kondisi jika tidak melakukan simpan/ submit, maka tampilkan formulir */
	if(!isset($_POST['simpan'])) {
		// Mempersiapkan Kode Terbesar 
		$query2 = mysqli_query($db_conn, "SELECT max(id_transaksi) as id_transaksi FROM transaksi");
		$data = mysqli_fetch_array($query2);
		$id_transaksi_number = $data['id_transaksi'];

		$urutan = (int) substr($id_transaksi_number, 2, 3);
		$urutan++;

		$id_transaksi_number = 'TR' . sprintf("%03s", $urutan);

		//Get Anggota
		$query_anggota = mysqli_query($db_conn, "SELECT * FROM tbanggota");
		//Get buku yang sedang tidak dipinjam
		$query_buku = mysqli_query($db_conn, "SELECT * FROM buku where status='Tersedia'");
		//Admin Data
		$nama_admin = $_SESSION['sesi'];
		$date_now = date("Y-m-d");
?>
<div id="container">
	<div class="page-title">
		<h3>Tambah Data Peminjaman</h3>
	</div>
	<div class="page-content">
		<form class="my-4" enctype="multipart/form-data" action="" method="post">
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="id_transaksi">ID Transaksi</label>
					<input type="text" class="form-control" name="id_transaksi" value="<?php echo $id_transaksi_number; ?>" readonly>
				</div>
				<div class="form-group col-md-6">
					<label for="id_anggota">Anggota</label>
					<select name="id_anggota" class="form-control">
						<?php 
							while($data_anggota = mysqli_fetch_array($query_anggota)){
						?>
						<option value="<?=$data_anggota['idanggota'] ?>"><?=$data_anggota['nama'] ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="id_buku">Buku</label>
					<select name="id_buku" class="form-control">
						<?php 
							while($data_buku = mysqli_fetch_array($query_buku)){
						?>
						<option value="<?=$data_buku['id_buku'] ?>"><?=$data_buku['judul_buku'] ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group col-md-6">
					<label for="tanggal_pinjam">Tanggal Pinjam</label>
					<input type="date" name="tanggal_pinjam" class="form-control" value="<?php echo $date_now; ?>" readonly>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="nama_admin">Admin</label>
					<input type="text" name="nama_admin" value="<?php echo $nama_admin; ?>" class="form-control" readonly>
				</div>
			</div>
			<input type="submit" class="btn btn-primary w-100" name="simpan" value="Simpan" />
		</form>
	</div>
</div>
<?php
	} else {
		/* Proses Penyimpanan Data dari Form */
			$id_transaksi 	= $_POST['id_transaksi'];
			$id_anggota 	= $_POST['id_anggota'];
			$id_buku 		= $_POST['id_buku'];
			$tgl_pinjam		= $_POST['tanggal_pinjam'];
			$id_admin 		= $_SESSION['id_admin'];
		// Query
		$sql = "INSERT INTO transaksi
				VALUES('{$id_transaksi}', '{$id_anggota}', '{$id_buku}',
						'{$tgl_pinjam}',NULL, '{$id_admin}')";
		$sql_update_status_buku = "UPDATE buku
									SET status = 'Dipinjam'
									WHERE id_buku = '{$id_buku}'";
		$query_update_buku = mysqli_query($db_conn, $sql_update_status_buku);
		$query = mysqli_query($db_conn, $sql);
		// mengalihkan halaman
		echo "<meta http-equiv='refresh' content='0; url=index.php?p=peminjaman'>";
	}
?>