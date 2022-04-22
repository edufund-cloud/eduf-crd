<?PHP 
	include_once("../../config/config.php");
	$sqldt = mysqli_query($koneksi,"SELECT now() AS tanggal");
	$xsqldt = mysqli_fetch_row($sqldt);
	$now = $xsqldt[0];

	function passAcak($panjang){
		$karakter = '';
		$karakter .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; // karakter alfabet
		$karakter .= '1234567890'; // karakter numerik

		$string = '';
		for ($i=0; $i < $panjang; $i++) { 
			$pos = rand(0, strlen($karakter)-1);
			$string .= $karakter{$pos};
		}
		return $string;
	}
	
	if ($_GET[act] == "rstpsw") {
		extract($_POST);
		if(!empty($txtEmail)){
			$sql_src = "SELECT gu.user_email FROM gen_users gu WHERE gu.user_email = '$txtEmail'";
			$xsql_src = mysqli_query($koneksi, $sql_src);
			$nmsql_src = mysqli_num_rows($xsql_src);

			if ($nmsql_src > 0){
				$SysPass 	 = passAcak(8);
				$SysPass_Ori = $SysPass;
				$SysPass 	 = hash('sha256', $SysPass);

				$sql = "UPDATE gen_users SET 
					sys_pass = '$SysPass' 
					WHERE user_email = '$txtEmail'";				
				if(mysqli_query($koneksi, $sql)) {
					include_once("xsendmail_forgot.php");
					$modul = 'Reset password user';
					$action = 'Delete';
					//include("../../api/logs/xlogs.php");
					echo 'Success, Data telah direset, '.$Send;
				}
				else {
					echo 'Data gagal direset';
				}
			}
			else {
				echo 'Email tidak ditemukan';
			}
		}
		else echo 'Please complete the data';
	}
?>