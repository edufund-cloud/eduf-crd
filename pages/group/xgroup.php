<?PHP 
	require_once('../../config/session.php'); 
	include_once("../../config/database.php");
	$sqldt = mysqli_query($koneksi,"SELECT now() AS tanggal");
	$xsqldt = mysqli_fetch_row($sqldt);
	$now = $xsqldt[0];
	
	if ($_GET['act']=="addgrp") {
		extract($_POST);
		$sql_src = "SELECT gg.description FROM gen_group gg WHERE gg.description = '$txtDescription'";
		$xsql_src = mysqli_query($koneksi, $sql_src);
		$nmsql_src = mysqli_num_rows($xsql_src);
		if ($nmsql_src < 1){
			if(!empty($txtDescription)){	
				$sql = "INSERT INTO gen_group(description,
					data_active,data_create,user_create,data_update,user_update) VALUES
					('$txtDescription',
					'$chkActive','$now','$user_id','$now','$user_id')";
				//echo"$sql";
				if(mysqli_query($koneksi, $sql)){
					$new_group_id = mysqli_insert_id($koneksi);
					$modul = 'Master Group';
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
			echo 'Data already exists';
		}
	}
	else if ($_GET['act'] == "edtgrp") {
		extract($_POST);
		if(!empty($txtDescription) && !empty($_GET['grpid'])){			
			$sql ="UPDATE gen_group SET 
				description		= '$txtDescription',
				data_active 	= '$chkActive', 
				data_update 	= '$now',
				user_update 	= '$user_id' 
				WHERE group_id	= '$_GET[grpid]'
			";
			//echo"$sql";
			if(mysqli_query($koneksi, $sql)) {
				$modul = 'Master Group';
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
	else if ($_GET['act'] == "delgrp") {
		extract($_POST);
		if(!empty($_GET['grpid'])){			
			$sql = "DELETE FROM gen_group 
				WHERE group_id = '$_GET[grpid]'
			";
			//echo"$sql";
			if(mysqli_query($koneksi, $sql)) {
				$modul = 'Master Group';
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