<?php

	$sql = "SELECT transaksi.id_transaksi, tbanggota.nama, buku.judul_buku, transaksi.tanggal_pinjam, transaksi.tanggal_kembali, admin.nm_admin FROM 
		buku INNER JOIN transaksi ON transaksi.id_buku = buku.id_buku INNER JOIN tbanggota ON transaksi.id_anggota = tbanggota.idanggota INNER JOIN admin ON transaksi.id_admin = admin.id_admin WHERE transaksi.tanggal_kembali IS NOT NULL ORDER BY id_transaksi DESC;";
	$query = mysqli_query($db_conn, $sql);
	$row = $query->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cetak Daftar Pengembalian</title>
	<style>
		* { margin: 0; font-family: Arial, Helvetica, sans-serif; }
		h3 { text-align: center; margin: 15px; text-decoration: underline; }
		section { margin: 0 auto; width: 960px; }
		table { border-collapse: collapse; }
		table, table th, table td { padding: 5px; border: 1px solid #CCC; }
		.text-center { text-align: center; }
	</style>
</head>
<body>
	<section>
	<?php
		if($row > 0) {
	?>
		<h3>Daftar Transaksi Pengembalian</h3>

		<table class="table data-table">
			<thead class="thead-dark">
				<tr>
					<th>No.</th>
					<th>ID Transaksi</th>
					<th>Anggota</th>
					<th>Buku</th>
					<th>Tanggal Pinjam</th>
					<th>Tanggal Kembali</th>
					<th>Admin</th>
				</tr>
			</thead>
		<?php
			$i = 1;
			while($data = mysqli_fetch_array($query)) {
		?>
			<tbody>
				<tr>
					<td class="text-center"><?php echo $i++; ?></td>
					<td><?php echo $data['id_transaksi']; ?></td>
					<td><?php echo $data['nama']; ?></td>
					<td>
						<?php echo $data['judul_buku'] ?>
					</td>
					<td><?php echo date("d-m-Y", strtotime($data['tanggal_pinjam'])); ?></td>
					<td><?php echo date("d-m-Y",strtotime($data['tanggal_kembali'])); ?></td>
					<td class="text-center"><?php echo $data['nm_admin']; ?></td>
				</tr>
			</tbody>
		<?php
			}
		?>
		</table>
	</section>
	<script type="text/javascript">
		window.print();
	</script>
	<?php
		}
	?>
</body>
</html>