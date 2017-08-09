<?php
session_start();
require( 'header.php' );
require( 'koneksi.php' );
$email = $_GET[ 'id' ];
$tampil = $_GET[ 'tampil' ];
$sql = "select * from profile where email='$email' ;";
$link = koneksi_db();
$res = mysqli_query( $link, $sql );
$data = mysqli_fetch_array( $res );

$sql_friend = "select * from friend where email1='".$_SESSION['s_email']."' and email2 ='".$email."';";
$result = mysqli_query($link,$sql_friend);
$data_valid = mysqli_num_rows($result);
$data_konfirmasi = mysqli_fetch_array($result);

$sql_ambil_teman = "SELECT * FROM profile INNER JOIN friend on profile.email = friend.email2 where friend.email1='$email' and konfirmasi ='sudah' order by profile.email desc;";
$hasil = mysqli_query( $link, $sql_ambil_teman );

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
			<li class="active"><a href="profile.php?id=<?php echo $_SESSION['s_email']; ?>&tampil=tentang">Profile</a>
			</li>
			<li><a href="pesan.php">Pesan <span class="badge"><?php echo $notif ?></span></a>
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
	<div class="row">
		<?php
		if ( strcmp( $data[ 'email' ], $_SESSION[ 's_email' ] ) == 0 ) {
			?>
		<button type="button" class="btn btn-default">
  			<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
			<a href="edit_profil.php"> 
				Edit Profile
			</a>
		</button>
		<?php
		} else if ( strcmp( $data[ 'email' ], $_SESSION[ 's_email' ] ) != 0 ) {
			
			if($data_valid>0 && $data_konfirmasi['konfirmasi']=='sudah'){ ?>
			<button type="button" class="btn btn-default">
			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
			<a href="hapus_teman.php?id=<?php echo $email; ?>"> Hapus Teman
			</a>
		</button>
		
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal1">
			<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Kirim Pesan
		</button>
		
		<!-- Modal -->
		<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Pesan</h4>
					</div>
					<div class="modal-body">
						<form action="kirim_pesan.php?id=<?php echo $email; ?>&dari=profile" enctype="multipart/form-data" method="post">
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
			
			<?php
			}else if($data_valid>0 && $data_konfirmasi['konfirmasi']=='belum'){ ?>
			<button type="button" class="btn btn-default">
			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
			<a href="hapus_teman.php?id=<?php echo $email; ?>"> Batalkan Permintaan
			</a>
		</button>
		
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal1">
			<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Kirim Pesan
		</button>
		
		<!-- Modal -->
		<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Pesan</h4>
					</div>
					<div class="modal-body">
						<form action="kirim_pesan.php?id=<?php echo $email; ?>&dari=profile" enctype="multipart/form-data" method="post">
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
			<?php
			} else if($data_valid==0){
			?>
		<button type="button" class="btn btn-default">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
			<a href="tambah_teman.php?id=<?php echo $email; ?>"> Tambah Teman
			</a>
		</button>
	

		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal1">
			<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Kirim Pesan
		</button>
		
		<!-- Modal -->
		<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Pesan</h4>
					</div>
					<div class="modal-body">
						<form action="kirim_pesan.php?id=<?php echo $email; ?>&dari=profile" enctype="multipart/form-data" method="post">
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
	
		<?php
			}
		}
		?>
	</div>
</div>


<div class="container-fluid">
	<div class="row" align="center">

		<img src="gambar/<?php echo $data['foto'];?>" class="img-circle" width="150" height="150" data-toggle="modal" data-target="#myModal"/><br>

		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Foto</h4>
					</div>
					<div class="modal-body">
						<img src="gambar/<?php echo $data['foto'];?>" width="550">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

		<h2><strong> <?php echo $data['nama_lengkap'];?></strong></h2>

	</div>
</div>
<?php
if ( $tampil == "tentang" ) {
	?>
	<ul class="nav nav-tabs nav-justified">
		<li role="presentation" class="active">
			<a href="profile.php?id=<?php echo $email;?>&tampil=tentang"><strong>Tentang</strong></a>
		</li>
		<li role="presentation">
			<a href="profile.php?id=<?php echo $email;?>&tampil=teman"><strong>Teman</strong></a>
		</li>
	</ul>
	<br>

	<div class="container">
		<div class="row">
			<table class="table table-condensed">
				<tr>
					<td class="col-md-6"><strong>Jenis Kelamin</strong>
					</td>
					<td class="col-md-1"><strong> : </strong>
					</td>
					<td class="col-md-5">
						<?php echo $data['jenis_kelamin'];?>
					</td>
				</tr>
				<tr>
					<td><strong>Tanggal Lahir</strong>
					</td>
					<td><strong> : </strong>
					</td>
					<td>
						<?php echo $data['tgl_lahir'];?>
					</td>
				</tr>
				<tr>
					<td><strong>Agama</strong>
					</td>
					<td><strong> : </strong>
					</td>
					<td>
						<?php echo $data['agama'];?>
					</td>
				</tr>
				<tr>
					<td><strong>Alamat</strong>
					</td>
					<td><strong> : </strong>
					</td>
					<td>
						<?php echo $data['alamat'];?>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<?php
} else if ( $tampil == "teman" ) {
	?>
	<ul class="nav nav-tabs nav-justified">
		<li role="presentation">
			<a href="profile.php?id=<?php echo $email;?>&tampil=tentang"><strong>Tentang</strong></a>
		</li>
		<li role="presentation" class="active">
			<a href="profile.php?id=<?php echo $email;?>&tampil=teman"><strong>Teman</strong></a>
		</li>
	</ul>
	<div class="container">
		<div class="row">
			<?php while($data_teman = mysqli_fetch_array($hasil)){ 
				if($data_teman['email']==$email){
					
				}else if($data_teman['email']!=$_SESSION['s_email']){
		?><br>
			<br>

			<img src="gambar/<?php echo $data_teman['foto']; ?>" class="img-thumbnail" width="100" height="100">
			<strong>
			<a href="profile.php?id=<?php echo $data_teman['email'];?>&tampil=tentang"> <?php echo "  ".$data_teman['nama_lengkap'];?></a></strong>
			<?php
			}
			}
			?>
		</div>
	</div>
	<?php
}
?>
<?php
require( 'footer.php' );
?>