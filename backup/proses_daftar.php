<?php 
session_start();
require( 'header.php' ); ?>
<nav class="navbar navbar-inverse">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#target-list">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
    		</button>
	

		<a href="index.php" class="navbar-brand">Sijaja</a>
	</div>
</nav>


<?php

require( 'koneksi.php' );
$link = koneksi_db();
$sql_cek_email = "select email from profile where email='" . $_POST[ 'email' ] . "';";
$hasil = mysqli_query( $link, $sql_cek_email );
$ketemu = mysqli_num_rows( $hasil );
$email = $_POST[ 'email' ];
$nama_lengkap = $_POST[ 'nama_lengkap' ];
$password = $_POST[ 'password' ];
$hitung_pass = strlen( $password );
if ( empty( $_POST[ 'email' ] ) ) {
	$_SESSION[ 's_pesan' ] = "Email tidak boleh kosong!";
	echo( "<script> location.href ='index.php';</script>" );
} else if ( $hitung_pass < 8 ) {
	$_SESSION[ 's_pesan' ] = "Password minimal 8 karakter!";
	echo( "<script> location.href ='index.php';</script>" );
} else if ( empty( $_POST[ 'nama_lengkap' ] ) ) {
	$_SESSION[ 's_pesan' ] = "Nama tidak boleh kosong!";
	echo( "<script> location.href ='index.php';</script>" );
} else if ( $ketemu > 0 ) {
	$_SESSION[ 's_pesan' ] = "Email sudah terdaftar!";
	echo( "<script> location.href ='index.php';</script>" );
} else {
	$_SESSION[ 's_email' ] = $email;
	$_SESSION[ 's_password' ] = $password;
	$sql = "insert into profile values('$email','$password','$nama_lengkap','','','','','foto-default.jpg');";
	$res = mysqli_query( $link, $sql );
	$sql_insert = "insert into friend values ('$email','$email','sudah');";
	$insert = mysqli_query( $link, $sql_insert );
?>

	<div class="container">
		<?php
		if ( $res ) {
			echo "<center><h1>Pendaftaran akun telah berhasil!</h1><br>";
			echo "Klik lanjut untuk ke beranda <br>";
			?>
		<form role="search" class="navbar-form navbar-right" action="beranda.php">
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Lanjut Beranda</button>
			</div>
		</form>
		<?php
			}
		}
		?>
	</div>
	<?php
	require( 'footer.php' );
	?>