<?php
	session_start();
	require('header.php');
	require('koneksi.php');
	$link = koneksi_db();
	
	if(!isset($_POST['cari'])){
		$_POST['cari'] = "";
	}

	$sql_cari = "select * from profile where email like '%".$_POST['cari']."%' or nama_lengkap like '%".$_POST['cari']."%';";
	$hasil_cari = mysqli_query($link,$sql_cari);
	$kolom_cari = mysqli_num_rows($hasil_cari);

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

	<div class="row">
	<h2>Hasil Pencarian : </h2>
	<?php if($kolom_cari==0){ ?>
	<h3><strong>Tidak Ditemukan...</strong></h3>
	<?php
}else if($kolom_cari>0){ ?>
		<table class="table table-condensed">
		<?php while($cari = mysqli_fetch_array($hasil_cari)){ ?>
		<tr>
			<td class="col-md-1"><img class="img-thumbnail" src="gambar/<?php echo $cari['foto']; ?>" width="140" height="140"></td>
			<td class="col-md-6"><strong><label><a href="profile.php?id=<?php echo $cari['email']; ?>&tampil=tentang"><?php echo $cari['nama_lengkap']; ?></a></label></strong><br><br></td>
		</tr>

		<?php
			}
					   }
		?>
		</table>
	</div>
</div>
<?php
	require('footer.php');
?>