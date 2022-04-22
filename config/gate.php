<?PHP
	if ($_GET['page'] == "login") {
		require_once("pages/login/sign_area.php");
		//echo"jika tidak memenuhi";
	}
	if ($_GET['act'] == "login") {
		require_once("pages/login/xsignin.php");
		//echo"Jika memenuhi";
		//----Activity Log----//			
	}	
	else if ($_GET['act'] == "logout") {
		require_once("pages/login/xsignout.php");
		//echo"jika tidak memenuhi";
	}	
	if ($_GET['errlog'] == 1 or $_GET['errlog'] == 3) {
		//echo"Login Gagal!!<br/><br/>";
		require_once("pages/login/xsignin.php");
		//echo"jika tidak memenuhi";
	}
	else if ($_GET['errlog'] == 2) {
		include("pages/case/500.php");
	}
?>