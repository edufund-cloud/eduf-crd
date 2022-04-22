<?PHP
	session_start();
	session_destroy();
	if ($_GET['errlog'] == "3"){
		header("location:?errlog=3");
	}
	else{
		header("location:?");
	}
?>