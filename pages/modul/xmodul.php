<?PHP 
	require_once('../../config/session.php'); 
	include_once("../../config/database.php");
	$sqldt = mysqli_query($koneksi,"SELECT now() AS tanggal");
	$xsqldt = mysqli_fetch_row($sqldt);
	$now = $xsqldt[0];

	if ($chkHomeMenu == '1'){
		$HomeMenu = 1;
	}
	else{
		$HomeMenu = 0;
	}
	
	if ($_GET['act']=="addmnu") {
		extract($_POST);
		$sql_src = "SELECT gm.menu_title FROM gen_menu gm 
			WHERE gm.menu_title = '$txtMenuTitle'";
		$xsql_src = mysqli_query($koneksi, $sql_src);
		$nmsql_src = mysqli_num_rows($xsql_src);
		if ($nmsql_src < 1){
			if(!empty($txtMenuTitle)){	
				$sql = "INSERT INTO gen_menu(parent_id,menu_title,menu_description,menu_order,
					menu_target,menu_file,menu_icon,menu_home,
					data_active,data_create,user_create,data_update,user_update) VALUES
					('$cmbParent','$txtMenuTitle','$txtDescription','$txtOrderNo',
					'$cmbTarget','$txtFileUrl','$txtMenuIcon','$HomeMenu',
					'$chkActive','$now','$user_id','$now','$user_id')";
				//echo"$sql";
				if(mysqli_query($koneksi, $sql)){
					$new_menu_id = mysqli_insert_id($koneksi);
					$modul = 'Master menu backend';
					$action = 'Add';
					//include("../../api/logs/xlogs.php");
					echo 'Success, Data has been added';
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
			echo 'Data sudah ada,...!!!';
		}
	}
	else if ($_GET['act'] == "edtmnu") {
		extract($_POST);
		if(!empty($txtMenuTitle) && !empty($_GET['mnuid'])){			
			$sql ="UPDATE gen_menu SET 
				parent_id		= '$cmbParent',
				menu_title		= '$txtMenuTitle',
				menu_description= '$txtDescription',
				menu_order 		= '$txtOrderNo',
				menu_target 	= '$cmbTarget',
				menu_file 		= '$txtFileUrl',
				menu_icon 		= '$txtMenuIcon',
				menu_home 		= '$HomeMenu',
				data_active 	= '$chkActive', 
				data_update 	= '$now',
				user_update 	= '$user_id' 
				WHERE menu_id	= '$_GET[mnuid]'
			";
			//echo"$sql";
			if(mysqli_query($koneksi, $sql)) {
				$modul = 'Master menu backend';
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
	else if ($_GET['act'] == "delmnu") {
		extract($_POST);
		if(!empty($_GET['mnuid'])){			
			$sql = "DELETE FROM gen_menu 
				WHERE menu_id = '$_GET[mnuid]'";
			//echo"$sql";
			if(mysqli_query($koneksi, $sql)) {
				$modul = 'Master menu backend';
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
?>