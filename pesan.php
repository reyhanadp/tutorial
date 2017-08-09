<?php
	session_start();
	require( 'header.php' );
	require( 'koneksi.php' );
	$link = koneksi_db();

	$sql = "select * from pesan where email_penerima='".$_SESSION['s_email']."' order by id_pesan desc;";
	$res = mysqli_query($link,$sql);
	
	$sql_update = "update pesan set status='sudah' where email_penerima='".$_SESSION['s_email']."';";
	$update = mysqli_query($link,$sql_update);

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
			<li><a href="beranda.php">Beranda</a>
			</li>
			<li><a href="profile.php?id=<?php echo $_SESSION['s_email']; ?>&tampil=tentang">Profile</a>
			</li>
			<li class="active"><a href="pesan.php">Pesan <span class="badge"><?php echo $notif; ?></span></a>
			</li>
			<li><a href="notifikasi.php">Notifikasi <span class="badge"><?php echo $notif_teman;?></span></a> 
  			</li>
		</ul>
	</div>

	<div class="collapse navbar-collapse pull-right" id="target-list">
		<ul class="nav navbar-nav">
			<li><a href="logout.php">Logout</a>
			</li>
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

<div class="container">
	<h1>Pesan Masuk</h1>
</div>

<div class="container-fluid">
	<div class="row">
		<?php
			while($data=mysqli_fetch_array($res)){
				$sql_ambil_foto = "select nama_lengkap,foto from profile where email='".$data['email_pengirim']."';";
				$result = mysqli_query($link,$sql_ambil_foto);
				$foto = mysqli_fetch_array($result);
		?>
		<table class="table table-condensed table-bordered">
			<tr>
				<td rowspan="4" class="col-md-1">
					<img src="gambar/<?php echo $foto['foto'];?>" class="img-circle" width="120" height="120">
				</td>
				<td class="danger">
					<strong><a href="profile.php?id=<?php echo $data['email_pengirim']; ?>&tampil=tentang"><?php echo $foto['nama_lengkap'] ?></a></strong>
					
					<button type="button" class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target="#ModalBalas">
  						<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Balas
					</button>
					<!-- Modal -->
					<div class="modal fade" id="ModalBalas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Pesan</h4>
								</div>
								<div class="modal-body">
									<form action="kirim_pesan.php?id=<?php echo $data['email_pengirim']; ?>&dari=pesan" enctype="multipart/form-data" method="post">
										<label>Subjek Pesan : </label>
										<input type="text" class="form-control" name="subjek" placeholder="Subjek"><br>
										<label>Isi Pesan : </label>
										<textarea rows="10" class="form-control" name="isi_pesan" placeholder="Isi pesan"></textarea><br>
										<input type="submit" name="kirim"  class="btn btn-primary" value="Kirim">
									</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td class="info">
					Subjek : <?php echo $data['subjek']; ?>
				</td>
			</tr>
			<tr>
				<td class="warning">
					<?php echo $data['isi']; ?>
				</td>
			</tr>
			<tr>
				<td class="active">
					<h6><?php echo $data['tanggal'];?></h6>
				</td>
			</tr>
		</table>
		
		<?php
			}
		?>
	</div>
</div>

<?php
	require('footer.php');
?>