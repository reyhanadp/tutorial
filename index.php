<?php 
	session_start();
	if(isset($_SESSION['s_email'])){
		echo ("<script> location.href ='beranda.php';</script>");
	}else if(isset($_SESSION['s_pesan'])){
		require('header.php'); 
		require('isi_index.php'); 
		require('footer.php');
		unset($_SESSION['s_pesan']);
	}else{
		require('header.php'); 
		require('isi_index.php'); 
		require('footer.php');
	}?>