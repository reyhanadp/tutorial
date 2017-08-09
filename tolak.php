<?php
	session_start();
	require('koneksi.php');
	$email = $_GET['id'];
	$link = koneksi_db();
	$sql = "delete from friend where email1='".$email."' and email2='".$_SESSION['s_email']."';";
	$res = mysqli_query($link,$sql);
	echo( "<script> location.href ='notifikasi.php';</script>" );
?>