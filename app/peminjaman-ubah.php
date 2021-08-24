<?php
if(!isset($_POST['simpan'])) {
	if(isset($_GET['id'])) { // memperoleh transaksi_id
		$id_transaksi = $_GET['id'];
		if(!empty($id_transaksi)) {
			// Query
			$sql = "SELECT * FROM transaksi WHERE id_transaksi = '{$id_transaksi}';";
			$query = mysqli_query($db_conn, $sql);
			$row = $query->num_rows;
			if($row > 0) {
				$data = mysqli_fetch_array($query); // memperoleh data transaksi
				//Get Anggota
				$query_anggota = mysqli_query($db_conn, "SELECT * FROM tbanggota");
				//Get buku yang sedang tidak dipinjam
				$query_buku = mysqli_query($db_conn, "SELECT * FROM buku where status='Tersedia'");
				$query_buku_sendiri = mysqli_query($db_conn, "SELECT * FROM buku where id_buku = '{$data['id_buku']}'");
				$data_buku_sendiri = mysqli_fetch_array($query_buku_sendiri);
				//Admin Data
				$nama_admin = $_SESSION['sesi'];
			} else {
echo "<script>alert('ID Transaksi peminjaman tidak ditemukan!');</script>";
// mengalihkan halaman
echo "<meta http-equiv='refresh' content='0; url=index.php?p=peminjaman'>";
exit;
}
} else {
echo "<script>alert('ID Transaksi peminjaman kosong!');</script>";
// mengalihkan halaman
echo "<meta http-equiv='refresh' content='0; url=index.php?p=peminjaman'>";
exit;
}
} else {
echo "<script>alert('ID Transaksi peminjaman tidak didefinisikan!');</script>";
// mengalihkan halaman
echo "<meta http-equiv='refresh' content='0; url=index.php?p=peminjaman'>";
exit;
}
?>
<div id="container">
	<div class="page-title">
		<h3>Ubah Data Peminjaman</h3>
	</div>
	<div class="page-content">
		<form class="my-4" enctype="multipart/form-data" action="" method="post">
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="id_transaksi">ID Transaksi</label>
					<input type="text" class="form-control" name="id_transaksi" value="<?php echo $data['id_transaksi']; ?>" readonly>
				</div>
				<div class="form-group col-md-6">
					<label for="id_anggota">Anggota</label>
					<select name="id_anggota" class="form-control">
						<?php 
							while($data_anggota = mysqli_fetch_array($query_anggota)){
						?>
						<option value="<?=$data_anggota['idanggota'] ?>" <?php echo ($data['id_anggota'] == $data_anggota['idanggota'] ? 'selected' : '') ?>><?=$data_anggota['nama'] ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="id_buku">Buku</label>
					<select name="id_buku" class="form-control">
						<option value="<?php echo $data_buku_sendiri['id_buku']; ?>" selected><?php echo $data_buku_sendiri['judul_buku']; ?></option>
						<?php 
							while($data_buku = mysqli_fetch_array($query_buku)){
						?>
						<option value="<?=$data_buku['id_buku'] ?>"><?=$data_buku['judul_buku'] ?></option>
						<?php } ?>
					</select>
					<input type="hidden" name="id_buku_tmp" value="<?php echo $data['id_buku']; ?>">
				</div>
				<div class="form-group col-md-6">
					<label for="tanggal_pinjam">Tanggal Pinjam</label>
					<input type="date" name="tanggal_pinjam" class="form-control" value="<?php echo $data['tanggal_pinjam']; ?>" readonly>
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
		$id_transaksi 		= $_POST['id_transaksi'];
		$id_anggota 		= $_POST['id_anggota'];
		$id_buku 			= $_POST['id_buku'];
		$tanggal_pinjam 	= $_POST['tanggal_pinjam'];
		$id_admin 			= $_SESSION['id_admin'];
		$id_buku_tmp		= $_POST['id_buku_tmp'];
		if($id_buku_tmp != $id_buku){
			$sql = "UPDATE buku SET status = 'Tersedia' WHERE id_buku = '{$id_buku_tmp}'";
			$query = mysqli_query($db_conn, $sql);
			$sql2 = "UPDATE buku SET status = 'Dipinjam' WHERE id_buku = '{$id_buku}'";
			$query2 = mysqli_query($db_conn, $sql2);
			if(!$query){
				echo "<script>alert('ID BUKU TIDAK BERHASIL DIUBAH');</script>";
			}
		}
		// Query
		$sql = "UPDATE transaksi
						SET id_transaksi 	= '{$id_transaksi}',
							id_anggota = '{$id_anggota}',
							id_buku = '{$id_buku}',
							tanggal_pinjam = '{$tanggal_pinjam}',
							id_admin = '{$id_admin}'
						WHERE id_transaksi	='{$id_transaksi}'";
		$query = mysqli_query($db_conn, $sql);
		
		if(!$query) {
			echo "<script>alert('Data gagal diubah!');</script>";
		}
		// mengalihkan halaman
		echo "<meta http-equiv='refresh' content='0; url=index.php?p=peminjaman'>";
	}
?>