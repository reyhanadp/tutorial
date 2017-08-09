<nav class="navbar navbar-inverse">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#target-list">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
    		</button>
		
			<a href="index.php" class="navbar-brand">Sijaja</a>
		</div>

		<form class="navbar-form navbar-right" action="login.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<input type="email" class="form-control" name="email" placeholder="Email">
			</div>
			<div class="form-group">
				<input type="password" class="form-control" name="password" placeholder="Password">
			</div>
			<button type="submit" class="btn btn-default">Sign in</button>
		</form>
	</nav>
	<?php 
		if(isset($_SESSION['s_pesan'])){?>
	<div class="alert alert-warning" role="alert" align="center">
			<strong>Warning! </strong><?php echo $_SESSION['s_pesan']; ?>
		</div>
	<?php
		}
	?>
	<div class="container">
		<h1>Daftar sekarang!</h1>
		<form action="proses_daftar.php" enctype="multipart/form-data" method="post">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="namadepan"> Nama Lengkap : </label>
						<input type="text" class="form-control" name="nama_lengkap" placeholder="Nama lengkap"/>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-4">
					<div class="form-group">
						<label for="inputemail"> Email : </label>
						<input type="email" class="form-control" name="email" placeholder="Email"/>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-4">
					<div class="form-group">
						<label for="inputpassword"> Password : </label>
						<input type="password" class="form-control" name="password" placeholder="Password"/>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-4">
					<center>
						<button type="submit" name="submit" class="btn btn-primary btn-block" value="DAFTAR">DAFTAR</button> </center>
				</div>
			</div>
		</form>
	</div>