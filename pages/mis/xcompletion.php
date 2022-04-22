<?PHP 
	require_once('../../config/session.php'); 
	include_once("../../config/database.php");
	$sqldt = mysqli_query($koneksi,"SELECT now() AS tanggal");
	$xsqldt = mysqli_fetch_row($sqldt);
	$now = $xsqldt[0];
	
	if ($_GET['act']=="add") {
		extract($_POST);
		if ($nmsql_src < 1){
			if(!empty($txtID)){
				$replace_apply_date = str_replace(' ','',$txtApplyDate);
				$explode_apply_date = explode('/',$replace_apply_date);
				$apply_date = $explode_apply_date[2].'-'.$explode_apply_date[1].'-'.$explode_apply_date[0];

				$data_status = "Check Borrower";
				$data_active = 1;

				$sql = "INSERT INTO apply(ID,full_name,apply_date,product,pic,data_status,
					data_active,data_create,user_create,data_update,user_update) VALUES
					('$txtID','$txtFullName','$apply_date','$cmbProduct','$txtPic','$data_status',
					'$data_active','$now','$user_id','$now','$user_id')";
				//echo"$sql";
				if(mysqli_query($koneksi, $sql)){
					$new_menu_id = mysqli_insert_id($koneksi);
					$modul = 'Data Apply';
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
	else{
		echo 'Operation not found';
	}
?>