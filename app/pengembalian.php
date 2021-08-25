<?php
	$row = 0;
	$num = 0;
	$offset = 0;
	if(!isset($_POST['cari'])) { // Jika tidak melakukan pencarian anggota
		/*** Pagination ***/
		if(isset($_GET['num'])) { // Jika menggunakan pagination
			$num = (int)$_GET['num'];

			if($num > 0) {
				$offset = ($num * $_QUERY_LIMIT) - $_QUERY_LIMIT;
			}
		}

		/* Query Main */
		$sql = "SELECT transaksi.id_transaksi, tbanggota.nama, buku.judul_buku, transaksi.tanggal_pinjam, transaksi.tanggal_kembali, admin.nm_admin FROM 
		buku INNER JOIN transaksi ON transaksi.id_buku = buku.id_buku INNER JOIN tbanggota ON transaksi.id_anggota = tbanggota.idanggota INNER JOIN admin ON transaksi.id_admin = admin.id_admin WHERE transaksi.tanggal_kembali IS NOT NULL ORDER BY id_transaksi DESC LIMIT {$offset}, {$_QUERY_LIMIT};";
		$query = mysqli_query($db_conn, $sql);

		/* Query Count All */
		$sql_count = "SELECT id_transaksi FROM transaksi WHERE tanggal_kembali IS NOT NULL;";
		$query_count = mysqli_query($db_conn, $sql_count);
		$row = $query_count->num_rows;
	} else { // Jika melakukan pencarian anggota
		/*** Pencarian ***/
		$kata_kunci = $_POST['kata_kunci'];

		if(!empty($kata_kunci)) {
			/* Query Pencarian */
			$sql = "SELECT transaksi.id_transaksi, tbanggota.nama, buku.judul_buku, transaksi.tanggal_pinjam, transaksi.tanggal_kembali, admin.nm_admin 
			FROM buku INNER JOIN transaksi ON transaksi.id_buku = buku.id_buku INNER JOIN tbanggota ON transaksi.id_anggota = tbanggota.idanggota INNER JOIN admin ON transaksi.id_admin = admin.id_admin 
			WHERE transaksi.id_transaksi LIKE '%{$kata_kunci}%' OR tbanggota.nama LIKE '%{$kata_kunci}%' OR buku.judul_buku LIKE '%{$kata_kunci}%' OR transaksi.tanggal_pinjam LIKE '%{$kata_kunci}%' OR transaksi.tanggal_kembali LIKE '%{$kata_kunci}%' OR admin.nm_admin LIKE '%{$kata_kunci}%' AND transaksi.tanggal_kembali IS NOT NULL ORDER BY transaksi.id_transaksi DESC;";
			$query = mysqli_query($db_conn, $sql);
			$row = $query->num_rows;
		}
	}
?>

		<div id="container">
			<div class="page-title">
				<h3>Data Transaksi Pengembalian</h3>	
			</div>
			<div class="page-content">
				<div class="table-upper">
					<div class="table-upper-left">
						<a href="index.php?p=pengembalian-tambah" class="btn btn-success btn-medium">Tambah</a>
						<a href="./app/pengembalian-cetak-daftar.php" title="Cetak Anggota" target="_blank">
							<img src="./assets/img/print.png" width="50" class="btn-print">
						</a>
					</div>
					<div class="table-upper-right">
						<form name="pencarian_anggota" action="" method="post" class="mg-top-15 text-right">
							<input type="text" name="kata_kunci" class="input_search">
							<input type="submit" name="cari" value="Cari" class="btn btn-success">
						</form>
					</div>
				</div>

			<?php 
				if($row > 0) {
			?>
			<div class="table-responsive">
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
							<th>Aksi</th>
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
							<td class="text-center">
								<a href="index.php?p=pengembalian-hapus&id=<?php echo $data['id_transaksi']; ?>" class="btn btn-danger btn-sm confirm">Hapus</a>
							</td>
						</tr>
					</tbody>
				<?php
					}
				?>
				</table>
			</div>
				<div class="table-lower">
					<div class="table-lower-left mg-top-5">
						Jumlah Data: <span class="font-weight-bold"><?php echo $row; ?></span>
					</div>
					<div class="table-lower-right text-right">
					<?php if(!isset($_POST['cari'])) { // disable pagination untuk pencarian ?>
						<ul class="table-pagination">
						<?php
							pagination($row, $num, 'pengembalian');
						}
					?>
						</ul>
					</div>
				</div>
			<?php } else { ?>
				<p class="text-center">Data tidak tersedia.</p>
			<?php } ?>		
			</div>
		</div>