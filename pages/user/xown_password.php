<?PHP 
	require_once('../../config/session.php'); 
	include_once("../../config/database.php");
	$sqldt = mysqli_query($koneksi,"SELECT now() AS tanggal");
	$xsqldt = mysqli_fetch_row($sqldt);
	$now = $xsqldt[0];

	/*--- Start Ganti ---*/
	if ($_GET['act'] == "edtpsw") {
		extract($_POST);
		$OldPass = hash('sha256',$txtPassword_Old);
		$SysPass = hash('sha256',$txtPassword_New);

		$sql_src = "SELECT gu.user_email 
			FROM gen_users gu 
			WHERE gu.sys_pass = '$OldPass' AND gu.data_active = '1' AND gu.user_id = '$_GET[usrid]'";
		$xsql_src = mysqli_query($koneksi, $sql_src);
		$nmsql_src = mysqli_num_rows($xsql_src);

		if ($nmsql_src > 0){
			if(!empty($txtPassword_Old) && !empty($txtPassword_New) && !empty($_GET['usrid'])){			
				if ($txtPassword_New == $txtRepassword_New){
					$sql ="UPDATE gen_users SET 
					sys_pass = '$SysPass'
					WHERE user_id='$_GET[usrid]'
					";
					//echo"$sql";
					if(mysqli_query($koneksi, $sql)) {
						$modul = 'Ganti Password';
						$action = 'Edit';
						//include("../../api/logs/xlogs.php");
						echo 'Success, Password has been changed';
					}
					else {
						echo 'Password failed to change';
					}
				}
				else echo 'Password does not match';
			}
			else echo 'Please complete the data';
		} 
		else echo 'Wrong previous password';
	}
	else echo 'Operation Failed';
	/*--- End Ganti ---*/
?>