<?php
	session_start();
	require('header.php');
	require('koneksi.php');
	$link = koneksi_db();
	$sql = "select * from profile where email='".$_SESSION['s_email']."';";
	$res = mysqli_query($link,$sql);
	$data = mysqli_fetch_array($res);

	if(isset($_POST['submit'])){
		$nama = $_POST['nama_lengkap'];
		$sql_update = "update profile set nama_lengkap='$nama' where email='".$_SESSION['s_email']."';";
		$update = mysqli_query($link,$sql_update);
		echo( "<script> location.href ='edit_profil.php';</script>" );
	}else if(isset($_POST['cancel'])){
		echo( "<script> location.href ='edit_profil.php';</script>" );
	}

	$sql_notifikasi = "select * from pesan where email_penerima='".$_SESSION['s_email']."' and status='belum';";
	$hasil_notif = mysqli_query($link,$sql_notifikasi);
	$notif = mysqli_num_rows($hasil_notif);

	$sql_notif_teman = "SELECT * FROM friend where email2='".$_SESSION['s_email']."' and konfirmasi='belum';";
	$hasil_notif_teman = mysqli_query($link,$sql_notif_teman);
	$notif_teman = mysqli_num_rows($hasil_notif_teman);
?>


<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#target-list">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
    	</button>
		
		<a href="beranda.php" class="navbar-brand">Sijaja</a>
	</div>
	
	<div class="collapse navbar-collapse navbar-left" id="target-list">
		<ul class="nav navbar-nav">
			<li><a href="beranda.php">Beranda</a></li>
			<li><a href="profile.php?id=<?php echo $_SESSION['s_email']; ?>&tampil=tentang">Profile</a></li>
			<li><a href="pesan.php">Pesan <span class="badge"><?php echo $notif ?></span></a>
  			</li>
  			<li><a href="notifikasi.php">Notifikasi <span class="badge"><?php echo $notif_teman;?></span></a> 
  			</li>
		</ul>
	</div>
	
	<div class="collapse navbar-collapse pull-right" id="target-list">
		<ul class="nav navbar-nav">
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>

	<form role="search" class="navbar-form navbar-right" action="cari.php" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Cari . . ." name="cari">
			<button type="submit" name="tombol" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Cari</button>
		</div>
	</form>
</nav>
<br>
<br>
<br>
<br>


<div class="container">
	<h2>Edit Profil</h2>
	<table class="table">
		<tr>
			<td class="col-md-4"><strong>Nama Lengkap</strong></td>
				<form action="" enctype="multipart/form-data" method="post">
					<td class="col-md-6">
						<input type="text" class="form-control" name="nama_lengkap" value="<?php echo $data['nama_lengkap']; ?>" placeholder="Nama lengkap"/>
					</td>
					<td class="col-md-2">
						<input type="submit" class="btn btn-primary" name="submit" value="simpan">
						<?php echo " ";?>
						<input type="submit" class="btn btn-primary" name="cancel" value="cancel">
					</td>
				</form>
		</tr>
		<tr>
			<td class="col-md-4"><strong>Password</strong></td>
			<td class="col-md-6"><?php echo $data['password']; ?></td>
			<td class="col-md-2"><a href="edit_password.php">Suting</a></td>
		</tr>
		<tr>
			<td class="col-md-4"><strong>Jenis Kelamin</strong></td>
			<td class="col-md-6"><?php echo $data['jenis_kelamin']; ?></td>
			<td class="col-md-2"><a href="edit_jk.php">Suting</a></td>
		</tr>
		<tr>
			<td class="col-md-4"><strong>Tanggal Lahir</strong></td>
			<td class="col-md-6"><?php echo $data['tgl_lahir']; ?></td>
			<td class="col-md-2"><a href="edit_tgl_lahir.php">Suting</a></td>
		</tr>
		<tr>
			<td class="col-md-4"><strong>Agama</strong></td>
			<td class="col-md-6"><?php echo $data['agama']; ?></td>
			<td class="col-md-2"><a href="edit_agama.php">Suting</a></td>
		</tr>
		<tr>
			<td class="col-md-4"><strong>Alamat</strong></td>
			<td class="col-md-6"><?php echo $data['alamat']; ?></td>
			<td class="col-md-2"><a href="edit_alamat.php">Suting</a></td>
		</tr>
		<tr>
			<td class="col-md-4"><strong>Foto</strong></td>
			<td class="col-md-6"><img src="gambar/<?php echo $data['foto']; ?>" width="100" height="100"></td>
			<td class="col-md-2"><a href="edit_foto.php">Suting</a></td>
		</tr>
	</table>
</div>


<?php require('footer.php'); ?>