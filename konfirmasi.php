<?php
	session_start();
	require('koneksi.php');
	$email = $_GET['id'];
	$link = koneksi_db();
	$sql = "update friend set konfirmasi='sudah' where email1='".$email."' and email2='".$_SESSION['s_email']."';";
	$sql2 = "insert into friend values ('".$_SESSION['s_email']."','$email','sudah');";
	$res = mysqli_query($link,$sql);
	$res2 = mysqli_query($link,$sql2);
	echo( "<script> location.href ='notifikasi.php';</script>" );
?>