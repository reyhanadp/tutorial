<?php
	session_start();
	require('koneksi.php');
	$link = koneksi_db();
	$id = $_GET['id'];
	$sql = "delete from status where id='$id';";
	$res = mysqli_query($link,$sql);
	echo( "<script> location.href ='beranda.php';</script>" );
?>