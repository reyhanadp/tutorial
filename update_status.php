<?php
	session_start();
	require('koneksi.php');
	$link = koneksi_db();
	if(isset($_POST['submit'])){
		if($_POST['status']==""){
			echo ("<script> location.href ='beranda.php';</script>");
		}else{
			$status = $_POST['status'];
			$email = $_SESSION['s_email'];
			$sql_cari_nama = "select nama_lengkap from profile where email='".$email."';";
			$res = mysqli_query($link,$sql_cari_nama);
			$data = mysqli_fetch_array($res);

			$sql = "insert into status values (NULL,'".$email."','".$data['nama_lengkap']."','".$status."',NULL);";
			$insert = mysqli_query($link,$sql);
			echo ("<script> location.href ='beranda.php';</script>");
		}
	}
?>