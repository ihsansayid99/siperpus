<?php

	/* Kondisi jika tidak melakukan simpan/ submit, maka tampilkan formulir */
	if(!isset($_POST['simpan'])) {
		$sql = "SELECT transaksi.id_transaksi, transaksi.id_buku, tbanggota.nama, buku.judul_buku, transaksi.tanggal_pinjam, transaksi.tanggal_kembali, admin.nm_admin
			FROM buku INNER JOIN transaksi ON transaksi.id_buku = buku.id_buku INNER JOIN tbanggota ON transaksi.id_anggota = tbanggota.idanggota INNER JOIN admin ON transaksi.id_admin = admin.id_admin 
			WHERE transaksi.tanggal_kembali IS NULL ORDER BY transaksi.id_transaksi DESC;";
		$query = mysqli_query($db_conn, $sql);
		$row = $query->num_rows;
?>
<div id="container">
	<div class="page-title">
		<h3>Tambah Data Pengembalian</h3>
	</div>
	<div class="page-content">
		<?php 
			if($row > 0) {
		?>
		<form class="my-5" action="" method="post">
			<div class="form-row">
				<div class="form-group col-md-8 mx-auto">
					<label for="id_transaksi">Cari Data Yang ingin dikembalikan :</label>
					<select name="id_transaksi" class="form-control" style="font-size: 14px;">
						<?php 
							while($dt = mysqli_fetch_array($query)){
						?>
						<option class="text-small" value="<?php echo $dt['id_transaksi'] . '-' . $dt['id_buku']; ?>"><?php echo $dt['id_transaksi'] . ' - ' . $dt['nama'] . ' - ' . $dt['judul_buku']; ?></option>
						<?php } ?>
					</select>
					<input type="submit" class="btn btn-primary w-100 mt-3" name="simpan" value="Simpan" />
				</div>
			</div>
		</form>
			<?php } else { ?>
				<p class="text-center" style="margin-top: 20%;">Ups, Belum ada data Peminjaman Untuk Sekarang :(</p>
			<?php } ?>
		
	</div>
</div>
<?php
	} else {
		/* Proses Penyimpanan Data dari Form */
			$text_id 	= $_POST['id_transaksi'];
			$tanggal_kembali 		= date('Y-m-d');
			$explode 		= explode("-", $text_id);
			$id_buku 		= $explode[1];
			$id_transaksi 	= $explode[0];
		// Query
		$sql = "UPDATE transaksi
				SET tanggal_kembali = '{$tanggal_kembali}' WHERE id_transaksi = '{$id_transaksi}'";
		$sql_update_status_buku = "UPDATE buku
									SET status = 'Tersedia'
									WHERE id_buku = '{$id_buku}'";
		$query_update_buku = mysqli_query($db_conn, $sql_update_status_buku);
		$query = mysqli_query($db_conn, $sql);
		// mengalihkan halaman
		echo "<meta http-equiv='refresh' content='0; url=index.php?p=pengembalian'>";
	}
?>