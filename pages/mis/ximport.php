<?PHP
	require_once("../../config/session.php"); 
	include_once("../../config/database.php");

	$sqldt = mysqli_query($koneksi,"SELECT now() AS tanggal");
	$xsqldt = mysqli_fetch_row($sqldt);
	$now = $xsqldt[0];

	if ($_GET['act']=="add") {
		echo "<pre>";
		print_r($_FILES['txtfile']);
		echo "</pre>";
	}
	else{
		echo "Operasi tidak ditemukan.";
	}
?>