<?php
	session_start();
	require('koneksi.php');
	$link = koneksi_db();
	if(!empty($_POST['kirim'])){
		$dari = $_GET['dari'];
		$penerima = $_GET['id'];
		$pengirim = $_SESSION['s_email'];
		$subjek = $_POST['subjek'];
		$isi_pesan = $_POST['isi_pesan'];
		$status = "belum";
		$sql = "insert into pesan values (NULL,'$pengirim','$penerima','$subjek','$isi_pesan',CURDATE(),'$status');";
		$insert = mysqli_query($link,$sql);
		if($dari == "profile"){
			echo ("<script> location.href ='profile.php?id=$penerima&tampil=tentang';</script>");
		}else{
			echo ("<script> location.href ='pesan.php';</script>");
		}
	}
?>