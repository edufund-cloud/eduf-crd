<?PHP 
	require_once('../../config/session.php'); 
	include_once("../../config/database.php");
	$sqldt = mysqli_query($koneksi,"SELECT now() AS tanggal");
	$xsqldt = mysqli_fetch_row($sqldt);
	$now = $xsqldt[0];

	function passAcak($panjang){
		$karakter = '';
		$karakter .= 'ABCDEFGHJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz'; // karakter alfabet
		$karakter .= '1234567890'; // karakter numerik

		$string = '';
		for ($i=0; $i < $panjang; $i++) { 
			$string .= $karakter[rand(0, strlen($karakter)-1)];
		}
		return $string;
	}

	$sql_grp = "SELECT gg.group_id,gg.description FROM gen_group gg 
		WHERE gg.data_active = '1' AND gg.group_id = '$_POST[cmbGroup]' ORDER BY gg.description ASC";
	$xsql_grp = mysqli_query($koneksi,$sql_grp);
	$arsql_grp = mysqli_fetch_array($xsql_grp);
	$group_name = $arsql_grp['description'];
	
	if ($_GET['act']=="addusr") {
		extract($_POST);
		$sql_src = "SELECT gu.user_login,gu.user_email FROM gen_users gu WHERE gu.user_email = '$txtEmail' 
			or gu.user_login = '$txtNickName'";
		$xsql_src = mysqli_query($koneksi, $sql_src);
		$nmsql_src = mysqli_num_rows($xsql_src);
		if ($nmsql_src < 1){
			if(!empty($txtEmail)){	
				//$SysPass = passAcak(8);
				$SysPass = "Indonesia,1745";
				$SysPass_Ori= $SysPass;
				$SysPass = hash('sha256',$SysPass);

				$sql = "INSERT INTO gen_users(user_login,user_email,sys_pass,user_level,group_id,
					data_active,data_create,user_create,data_update,user_update) VALUES
					('$txtNickName','$txtEmail','$SysPass','$cmbSysLevel','$cmbGroup',
					'$chkActive','$now','$user_id','$now','$user_id')";
				//echo"$sql";
				if(mysqli_query($koneksi, $sql)){
					$new_user_id = mysqli_insert_id($koneksi);
					include_once("xuser_meta.php");
					include_once("xsendmail_user.php");
					$modul = 'Master User';
					$action = 'Add';
					//include("../../api/logs/xlogs.php");
					echo 'Success, Data has been added, '.$Send;
				}
				else{
					echo 'Failed Add Data';
				}
			}
			else{
				echo 'Please complete the data';
			}
		}
		else{
			echo 'Username or Email already exists';
		}
	}
	else if ($_GET['act'] == "edtusr") {
		extract($_POST);
		if(!empty($txtEmail) && !empty($_GET['usrid'])){			
			$sql ="UPDATE gen_users SET 
				user_login 		= '$txtNickName',
				user_email 		= '$txtEmail',
				user_level 		= '$cmbSysLevel',
				group_id 		= '$cmbGroup',
				data_active 	= '$chkActive', 
				data_update 	= '$now',
				user_update 	= '$user_id' 
				WHERE user_id	= '$_GET[usrid]'
			";
			//echo"$sql";
			if(mysqli_query($koneksi, $sql)) {
				include_once("xuser_meta.php");
				$modul = 'Master User';
				$action = 'Edit';
				//include("../../api/logs/xlogs.php");
				echo 'Success, Data has been updated';
			}
			else {
				echo 'Failed update data';
			}
		}
		else echo 'Please complete the data';
	}
	else if ($_GET['act'] == "delusr") {
		extract($_POST);
		if(!empty($_GET['usrid'])){			
			$sql = "DELETE FROM gen_users 
				WHERE user_id = '$_GET[usrid]'
			";
			//echo"$sql";
			if(mysqli_query($koneksi, $sql)) {
				include_once("xuser_meta.php");
				$modul = 'Master User';
				$action = 'Delete';
				//include("../../api/logs/xlogs.php");
				echo 'Success, Data has been deleted';
			}
			else {
				echo 'Failed delete data';
			}
		}
		else echo 'Please complete the data';
	}

	/*--- Start Profile ---*/
	else if ($_GET['act'] == "updprf") {
		extract($_POST);		
		include_once("xuser_meta.php");
		if ($error < 1)	{
			echo 'Success, Data has been updated';
		}
		else{
			echo 'Failed update data';
		}
	}
	/*--- End Profile ---*/

	else{
		echo 'Operation not found';
	}
?>