<?php
	error_reporting(0);
	$db_host 	= "localhost";
	$db_user 	= "root";
	$db_pass 	= "";
	$db_name 	= "edufund_crd";
	$web_id		= "eduh4n4";	
	$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	
	if(mysqli_connect_errno()){		
		$Notif = "Gagal melakukan koneksi ke Database<br><small>".mysqli_connect_error()."</small><br><br>Hubungi teknisi untuk dilakukan perbaikan.";
	}
?>