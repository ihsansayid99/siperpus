<?php

	$row = 0;
	$num = 0;
	$offset = 0;
	if(!isset($_POST['cari'])) { // Jika tidak melakukan pencarian buku
		/*** Pagination ***/
		if(isset($_GET['num'])) { // Jika menggunakan pagination
			$num = (int)$_GET['num'];

			if($num > 0) {
				$offset = ($num * $_QUERY_LIMIT) - $_QUERY_LIMIT;
			}
		}

		/* Query Main */
		$sql = "SELECT buku.id_buku, buku.judul_buku, kategori.nama_kategori, penulis.nama_penulis, penerbit.nama_penerbit, buku.status FROM kategori INNER JOIN buku ON kategori.id_kategori = buku.id_kategori INNER JOIN penulis ON penulis.id_penulis = buku.id_penulis INNER JOIN penerbit ON penerbit.id_penerbit = buku.id_penerbit ORDER BY buku.id_buku DESC LIMIT {$offset}, {$_QUERY_LIMIT};";
		$query = mysqli_query($db_conn, $sql);

		/* Query Count All */
		$sql_count = "SELECT id_buku FROM buku;";
		$query_count = mysqli_query($db_conn, $sql_count);
		$row = $query_count->num_rows;
	} else { // Jika melakukan pencarian buku
		/*** Pencarian ***/
		$kata_kunci = $_POST['kata_kunci'];

		if(!empty($kata_kunci)) {
			/* Query Pencarian */
			$sql = "SELECT buku.id_buku, buku.judul_buku, kategori.nama_kategori, penulis.nama_penulis, penerbit.nama_penerbit, buku.status FROM kategori INNER JOIN buku ON kategori.id_kategori = buku.id_kategori INNER JOIN penulis ON penulis.id_penulis = buku.id_penulis INNER JOIN penerbit ON penerbit.id_penerbit = buku.id_penerbit 
					WHERE buku.id_buku LIKE '%{$kata_kunci}%'
						OR buku.judul_buku LIKE '%{$kata_kunci}%'
						OR kategori.nama_kategori LIKE '%{$kata_kunci}%'
						OR penulis.nama_penulis LIKE '%{$kata_kunci}%'
						OR penerbit.nama_penerbit LIKE '%{$kata_kunci}%'
						OR buku.status LIKE '%{$kata_kunci}%'
					ORDER BY buku.id_buku DESC;";
			$query = mysqli_query($db_conn, $sql);
			$row = $query->num_rows;
		}
	}
?>

		<div id="container">
			<div class="page-title">
				<h3>Data Buku</h3>	
			</div>
			<div class="page-content">
				<div class="table-upper">
					<div class="table-upper-left">
						<a href="index.php?p=buku-tambah" class="btn btn-success btn-medium">Tambah</a>
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
				<table class="table data-table">
					<thead class="thead-dark">
						<tr>
							<th>No.</th>
							<th>ID Buku</th>
							<th>Judul Buku</th>
							<th>Kategori</th>
							<th>Penulis</th>
							<th>Penerbit</th>
							<th>Status</th>
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
							<td><?php echo $data['id_buku']; ?></td>
							<td><?php echo $data['judul_buku']; ?></td>
							<td>
								<?php 
									echo $data['nama_kategori'];
								?>
							</td>
							<td>
								<?php
									echo $data['nama_penulis'];
								?>	
							</td>
							<td>
								<?php
									echo $data['nama_penerbit'];
								?>	
							</td>
							<td class="text-center"><?php echo $data['status']; ?></td>
							<td class="text-center">
								<a href="index.php?p=buku-ubah&id=<?php echo $data['id_buku']; ?>" class="btn btn-warning btn-sm">Ubah</a>
								<a href="index.php?p=buku-hapus&id=<?php echo $data['id_buku']; ?>" class="btn btn-danger btn-sm confirm">Hapus</a>
							</td>
						</tr>
					</tbody>
				<?php
					}
				?>
				</table>
				<div class="table-lower">
					<div class="table-lower-left mg-top-5">
						Jumlah Data: <span class="font-weight-bold"><?php echo $row; ?></span>
					</div>
					<div class="table-lower-right text-right">
					<?php if(!isset($_POST['cari'])) { // disable pagination untuk pencarian ?>
						<ul class="table-pagination">
						<?php
							pagination($row, $num, 'buku');
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