<?php

	if(isset($_GET['id'])) { // memperoleh transaksi id
		$id_transaksi = $_GET['id'];

		if(!empty($id_transaksi)) {
			// Query
			$sql3 = "SELECT id_buku FROM transaksi WHERE id_transaksi = '{$id_transaksi}';";	
			$query3 = mysqli_query($db_conn, $sql3);
			$data3 = mysqli_fetch_array($query3);
			$id_buku = $data3['id_buku'];
			$query_update_buku = mysqli_query($db_conn, "UPDATE buku SET status = 'Dipinjam' WHERE id_buku = '{$id_buku}' ");
			$sql = "UPDATE transaksi SET tanggal_kembali = NULL WHERE id_transaksi = '{$id_transaksi}';";
			$query = mysqli_query($db_conn, $sql);

			if(!$query) {
				echo "<script>alert('Data gagal dihapus!');</script>";
			}
		} else {
			echo "<script>alert('ID Transaksi kosong!');</script>";
		}
	} else {
		echo "<script>alert('ID Transaksi tidak didefinisikan!');</script>";		
	}

	// mengalihkan halaman
	echo "<meta http-equiv='refresh' content='0; url=index.php?p=pengembalian'>";
?>