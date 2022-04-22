<?PHP
session_start();
require_once("database.php");
if(isset($_SESSION['user_sn']) != "user___".$web_id){	
	include "pages/login/sign_area.php";
	exit;
}
else{
	$user_id 			= $_SESSION['user_id'];
	$user_email 		= $_SESSION['user_email'];
	$user_nickname 		= $_SESSION['user_nickname'];
	$user_firstname 	= $_SESSION['user_firstname'];
	$user_lastname 		= $_SESSION['user_lastname'];
	$user_level 		= $_SESSION['user_level'];
	$user_picture 		= $_SESSION['user_picture'];
	$user_group_name	= $_SESSION['user_group_name'];
	
	$timeout = 1; // setting timeout dalam menit

	$timeout = $timeout * 38000; // menit ke detik
	if(isset($_SESSION['start_session'])){
		$elapsed_time = time()-$_SESSION['start_session'];
		if($elapsed_time >= $timeout){
			session_destroy();
			include "pages/login/xsignout.php?errlog=3";
		}
	}

	$_SESSION['start_session']=time();
}
?>