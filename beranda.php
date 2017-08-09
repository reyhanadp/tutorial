<?php 
	session_start();
	require('header.php'); 
	require('koneksi.php');
	$link = koneksi_db();
	$sql = "select nama_lengkap,foto from profile where email='".$_SESSION['s_email']."';";
	$res = mysqli_query($link,$sql);
	$data = mysqli_fetch_array($res);
	
		
	$sql_ambil_status = "SELECT * FROM status INNER JOIN friend on status.email = friend.email2 where friend.email1='".$_SESSION['s_email']."' and konfirmasi='sudah' order by status.id_status desc;";
	$hasil = mysqli_query($link,$sql_ambil_status);

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
			<li class="active"><a href="beranda.php">Beranda</a></li>
			<li><a href="profile.php?id=<?php echo $_SESSION['s_email']; ?>&tampil=tentang">Profile</a></li>
			<li><a href="pesan.php">Pesan <span class="badge"><?php echo $notif;?></span></a>
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
	
	<!-- Modal -->
					
</nav>
<br>
<br>
<br>
<br>



<div class="container">
<div class="row">
	<div class="col-md-4">
	 	<table class="table table-bordered">
	 		<tr>
		 		<td rowspan="3"><img class="img-rounded" src="gambar/<?php echo $data['foto']; ?>" width="150" height="150"></td>
		 		<td>
					<?php echo "<label>".$data['nama_lengkap']."</label>"; ?>
		 		</td>
		 	</tr>
		 	<tr>
		 		<td><button class="btn btn-info btn-block"><span class="glyphicon glyphicon-user" aria-hidden="true"></span><a href="profile.php?id=<?php echo $_SESSION['s_email']; ?>&tampil=tentang"> Lihat Profil</a></button></td>
		 	</tr>
		 	<tr>
		 		<td><button class="btn btn-info btn-block"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span><a href="edit_profil.php"> Edit Profil</a></button></td>
		 	</tr>
		 	
		</table>
	</div>
	
	<div class="col-md-6">
	 <form enctype="multipart/form-data" method="post" action="update_status.php">
		 <table class="table table-bordered">
		 	<tr>
		 		<td rowspan="2" class="col-md-2"><img class="img-rounded" src="gambar/<?php echo $data['foto']; ?>" width="100" height="100"></td>
		 		<td class="col-md-10">
		 			<textarea class="form-control" rows="4" name="status" autofocus placeholder="Apa yang anda pikirkan?"></textarea>
		 		</td>
		 	</tr>
		 	<tr>
		 		<td >
		 			<input type="submit" name="submit" class="btn btn-primary pull-right" value="Update">
		 		</td>
		 	</tr>
		 </table>
		 </form>
		 
		<?php 
			while($array_status = mysqli_fetch_array($hasil)){
				$sql_ambil_gambar = "select foto from profile where email='".$array_status['email']."';";
				$result = mysqli_query($link, $sql_ambil_gambar);
				$array_gambar = mysqli_fetch_array($result);
		?>		
		<table class="table table-condensed">
			<tr>
				<td rowspan="3" class="col-md-2"><img class="img-rounded" src="gambar/<?php echo $array_gambar['foto']; ?>" width="100" height="100"></td>
				<td class="danger">
					<label>
						<?php echo $array_status['nama_lengkap']; ?>
					</label>
					<?php if($_SESSION['s_email']==$array_status['email']){ ?>
					<a href="hapus_status.php?id=<?php echo $array_status['id_status']; ?>"><img src="gambar/hapus.gif" class="pull-right"></a>
					<?php } ?>
				</td>
			</tr>
			<tr>
				<td><?php echo $array_status['status']; ?></td>
			</tr>
			<tr>
				<td><h6><?php echo $array_status['waktu']; ?></h6></td>
			</tr>
		</table>
		<?php
			}
		?>
	</div>
</div>
</div>
<?php require('footer.php'); ?>