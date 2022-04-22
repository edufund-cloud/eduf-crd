<?PHP
	ob_start("ob_gzhandler");
	require_once("config/database.php");
	require_once("config/gate.php");
	require_once('config/session.php');
	$h4n4id 	= $_SESSION['h4n4id'];
	$h4n4name 	= $_SESSION['h4n4name'];
	$h4n4email 	= $_SESSION['h4n4email'];
	$h4n4type	= $_SESSION['h4n4type'];
	$h4n4level 	= $_SESSION['h4n4level'];
	require_once('home.php');
?>