<?php
	session_start();
	require('koneksi.php');
	$email = $_GET['id'];
	$link = koneksi_db();
	$sql = "insert into friend values ('".$_SESSION['s_email']."','$email','belum');";
	$res = mysqli_query($link,$sql);
	echo ("<script> location.href ='profile.php?id=$email&tampil=tentang';</script>");

?>