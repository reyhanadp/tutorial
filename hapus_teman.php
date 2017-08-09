<?php
	session_start();
	require('koneksi.php');
	$email = $_GET['id'];
	$link = koneksi_db();
	$sql = "delete from friend where email1='".$_SESSION['s_email']."' and email2='$email'";
	$sql2 = "delete from friend where email1='$email' and email2='".$_SESSION['s_email']."'";
	$res = mysqli_query($link,$sql);
	$res2 = mysqli_query($link,$sql2);
	echo ("<script> location.href ='profile.php?id=$email&tampil=tentang';</script>");


?>