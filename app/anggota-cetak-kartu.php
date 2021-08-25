<?php
	include '../config/koneksi-db.php';
	use Dompdf\Dompdf; 
	require("../assets/vendor/autoload.php");
	if(isset($_GET['id'])) { // memperoleh anggota_id
		$id_anggota = $_GET['id'];

		if(!empty($id_anggota)) {
			// Query
			$sql = "SELECT * FROM tbanggota WHERE idanggota = '{$id_anggota}';";
			$query = mysqli_query($db_conn, $sql);
			$row = $query->num_rows;
			ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cetak Kartu Anggota</title>
	<style>
		* { margin: 0; font-family: Arial, Helvetica, sans-serif; }
		h3 { text-align: center; margin: 15px; text-decoration: underline; }
		#member-card { margin: 0 auto; width: 450px; }
		#member-photo { float: left; width: 120px; margin-right: 10px; }
		#member-data { float: left; width: 320px; }
		#member-data p { line-height: 24px; }
	</style>
</head>
<body>
		<?php
			if($row > 0) {
				$data = mysqli_fetch_array($query); // memperoleh data anggota
				$id_anggota = $data['idanggota'];
				$nama_lengkap = $data['nama'];
				$jenis_kelamin = $data['jeniskelamin'];
				$alamat = $data['alamat'];
				$data_foto = $data['foto'];
				if($data_foto == '-') {
					$data_foto = 'foto-default.jpg';
				}
				$path = "../images/" . $data_foto;
				$type = pathinfo($path, PATHINFO_EXTENSION);
				$data = file_get_contents($path);
				$base64 = 'data:image/' . $type . ';base64,'. base64_encode($data);
		?>
	<section id="member-card">
		<h3>Kartu Anggota</h3>

		<div id="member-photo">
			<img src="<?php echo $base64 ?>" width="120">
		</div>
		<div id="member-data">
			<p><strong>ID Anggota</strong>: <?php echo $id_anggota; ?></p>
			<p><strong>Nama Lengkap</strong>: <?php echo $nama_lengkap; ?></p>
			<p><strong>Jenis Kelamin</strong>: <?php echo ($jenis_kelamin == 'L') ? 'Pria' : 'Wanita'; ?></p>
			<p><strong>Alamat</strong>: <?php echo $alamat; ?></p>
		</div>
	</section>
		<?php
			}
		?>
</body>
</html>

<?php
			$html = ob_get_clean();

			$dompdf = new Dompdf();
			$dompdf->loadHtml($html); 
			$dompdf->setPaper('A6', 'landscape'); 
			$dompdf->render(); 
			$dompdf->stream("Kartu-Anggota-".$id_anggota);
			exit();
		}
	}
?>