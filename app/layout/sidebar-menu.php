<div class="container-fluid">
	<div class="row">
		<div class="col-md-2 p-0 bg-dark text-white sidebar">
			<ul class="sidebar-menu">
				<li class="profile">
					<div class="profile-img bg-info rounded-circle mx-auto" style="width: 80px;height: 80px; background-image: url('./images/foto-default.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center;"></div>
					<p class="text-center" style="padding: 5px 10px;">Hai, <?php echo $_SESSION['sesi']; ?>!</p>
				</li>
				<hr class="border-light">
				<li class="sidebar-items <?php echo ($_GET['p'] == 'beranda') ? 'bg-info' : ''; ?>">
					<a href="index.php?p=beranda" class="sidebar-link">Homepage</a>
				</li>
				<li class="sidebar-items bg-secondary">Data Master</li>
                <li class="sidebar-items <?php echo ($_GET['p'] == 'anggota' || $_GET['p'] == 'anggota-tambah' || $_GET['p'] == 'anggota-ubah') ? 'bg-info' : ''; ?>">
                    <a href="index.php?p=anggota" class="sidebar-link">Data Anggota</a>
                </li>
                <li class="sidebar-items  <?php echo ($_GET['p'] == 'buku' || $_GET['p'] == 'buku-tambah' || $_GET['p'] == 'buku-ubah') ? 'bg-info' : ''; ?>">
                    <a href="index.php?p=buku" class="sidebar-link">Data Buku</a>
                </li>
                <li class="sidebar-items  <?php echo ($_GET['p'] == 'kategori' || $_GET['p'] == 'kategori-tambah' || $_GET['p'] == 'kategori-ubah') ? 'bg-info' : ''; ?>">
                    <a href="index.php?p=kategori" class="sidebar-link">Data Kategori</a>
                </li>
                <li class="sidebar-items  <?php echo ($_GET['p'] == 'penulis' || $_GET['p'] == 'penulis-tambah' || $_GET['p'] == 'penulis-ubah') ? 'bg-info' : ''; ?>">
                    <a href="index.php?p=penulis" class="sidebar-link">Data Penulis</a>
                </li>
                <li class="sidebar-items  <?php echo ($_GET['p'] == 'penerbit' || $_GET['p'] == 'penerbit-tambah' || $_GET['p'] == 'penerbit-ubah') ? 'bg-info' : ''; ?>">
                    <a href="index.php?p=penerbit" class="sidebar-link">Data Penerbit</a>
                </li>
                <li class="sidebar-items bg-secondary">Data Transaksi</li>
				<li class="sidebar-items <?php echo ($_GET['p'] == 'peminjaman' || $_GET['p'] == 'peminjaman-tambah' || $_GET['p'] == 'peminjaman-ubah') ? 'bg-info' : ''; ?>">
                    <a href="index.php?p=peminjaman" class="sidebar-link">Transaksi Peminjaman</a>
				</li>
				<li class="sidebar-items <?php echo ($_GET['p'] == 'pengembalian' || $_GET['p'] == 'pengembalian-tambah') ? 'bg-info' : ''; ?>">
					<a href="index.php?p=pengembalian" class="sidebar-link">Transaksi Pengembalian</a>
				</li>
				<hr style="border: 1px solid white;">
                <li class="sidebar-items">
                    <a href="logout.php" class="sidebar-link">Logout</a>
                </li>
			</ul>
		</div>