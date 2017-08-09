<?php
		session_start();
		echo "";
		require ('koneksi.php');
		
		$link = koneksi_db();
		$sql="select email,password from profile where email='".$_POST['email']."' and password='".$_POST['password']."'";
		$res = mysqli_query($link,$sql);
		$ketemu = mysqli_num_rows($res);
		while($data = mysqli_fetch_array($res)){
			$email = $data['email'];
			$password = $data['password'];
		}
		
		if($ketemu > 0)
		{
			$_SESSION['s_email']= $email;
			$_SESSION['s_password']= $password;
			echo ("<script> location.href ='beranda.php';</script>");
			
		}
		else
		{
			$_SESSION['s_pesan'] = "Email atau Password Salah";
			echo ("<script> location.href ='index.php';</script>");
		}
	?>