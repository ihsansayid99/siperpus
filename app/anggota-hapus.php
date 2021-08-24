<?php

	if(isset($_GET['id'])) { // memperoleh anggota_id
		$id_anggota = $_GET['id'];

		if(!empty($id_anggota)) {
			// Query
			$sql3 = "SELECT foto FROM tbanggota WHERE idanggota = '{$id_anggota}';";	
			$query3 = mysqli_query($db_conn, $sql3);
			$data3 = mysqli_fetch_array($query3);
			$nama_file = $data3['foto'];
			$dir_images = './images/';
			$path_image = $dir_images . $nama_file;
			unlink($path_image);
			$sql = "DELETE FROM tbanggota WHERE idanggota = '{$id_anggota}';";
			$query = mysqli_query($db_conn, $sql);

			if(!$query) {
				echo "<script>alert('Data gagal dihapus!');</script>";
			}
		} else {
			echo "<script>alert('ID Anggota kosong!');</script>";
		}
	} else {
		echo "<script>alert('ID Anggota tidak didefinisikan!');</script>";		
	}

	// mengalihkan halaman
	echo "<meta http-equiv='refresh' content='0; url=index.php?p=anggota'>";
?>