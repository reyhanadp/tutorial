<?php 
	session_start();
	require('header.php'); 
	require('koneksi.php');
	$link = koneksi_db();

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
			<li><a href="pesan.php">Pesan <span class="badge"><?php echo $notif;?></span></a>
 			<li class="active"><a href="notifikasi.php">Notifikasi <span class="badge"><?php echo $notif_teman;?></span></a> 
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



<div class="container-fluid">
<div class="row">
	<?php
			while($data=mysqli_fetch_array($hasil_notif_teman)){
				$sql_ambil_foto = "select nama_lengkap,foto from profile where email='".$data['email1']."';";
				$result = mysqli_query($link,$sql_ambil_foto);
				$foto = mysqli_fetch_array($result);
		?>
		<table class="table table-condensed table-bordered">
			<tr>
				<td rowspan="2" class="col-md-1">
					<img src="gambar/<?php echo $foto['foto'];?>" class="img-circle" width="120" height="120">
				</td>
				<td class="danger">
					<strong><a href="profile.php?id=<?php echo $data['email2']; ?>&tampil=tentang"><?php echo $foto['nama_lengkap'] ?></a></strong>
					
					
				</td>
			</tr>
			<tr>
				<td>
					<button type="button" class="btn btn-default btn-sm">
  						<span class="glyphicon glyphicon-ok" aria-hidden="true"></span><a href="konfirmasi.php?id=<?php echo $data['email1']; ?>"> Konfirmasi</a>
					</button>
					<button type="button" class="btn btn-default btn-sm">
  						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span><a href="tolak.php?id=<?php echo $data['email1']; ?>"> Hapus Permintaan</a>
					</button>
				</td>
			</tr>
		</table>
		
		<?php
			
			}
		?>
</div>
</div>
<?php require('footer.php'); ?>