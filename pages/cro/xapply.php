<?PHP 
	require_once('../../config/session.php'); 
	include_once("../../config/database.php");
	$sqldt = mysqli_query($koneksi,"SELECT now() AS tanggal");
	$xsqldt = mysqli_fetch_row($sqldt);
	$now = $xsqldt[0];

	$sql_grp = "SELECT gg.description AS group_name 
		FROM gen_users gu 
		LEFT JOIN gen_group gg ON gu.group_id = gg.group_id 
		WHERE gu.user_id = '$user_id'";
	$xsql_grp = mysqli_query($koneksi,$sql_grp);
	$arsql_grp = mysqli_fetch_array($xsql_grp);
	$group_name = $arsql_grp['description'];
	
	if ($_GET['act'] == "edt") {
		extract($_POST);
		if(!empty($_GET['appid'])){	
			//Data Note				
			$user_note_group = "$user_group_name";
			$key_radio_status = $txtKeyRadio;

			if ($key_radio_status == '1'){
				$note_status = "$rdoStatus";
				//Tambah Note
				$sql_note = "INSERT INTO apply_note(data_id,status,note,data_update,user_update,user_group) VALUES 
					('$_GET[appid]','$note_status','$txtNote','$now','$user_id','$user_note_group')";
				if ($xsql_note = mysqli_query($koneksi, $sql_note)){
					//Update Status
					$sql_sts = "UPDATE apply SET 
						data_status = '$note_status',
						data_update = '$now',
						user_update = '$user_id'  
						WHERE data_id = '$_GET[appid]'";
					$xsql_sts = mysqli_query($koneksi, $sql_sts);

					$modul = 'Update Apply';
					$action = 'Edit';
					//include("../../api/logs/xlogs.php");
					echo 'Success, Data has been updated';
				}
				else {
					echo 'Failed update data';
				}
			}
			else{
				$note_status = "Update Data";

				$sql_note = "INSERT INTO apply_note(data_id,status,note,data_update,user_update,user_group) VALUES 
					('$_GET[appid]','$note_status','$txtNote','$now','$user_id','$user_note_group')";
				if ($xsql_note = mysqli_query($koneksi, $sql_note)){
					$modul = 'Update Apply';
					$action = 'Edit';
					//include("../../api/logs/xlogs.php");
					echo 'Success, Data has been updated';
				}
				else {
					echo 'Failed update data';
				}
			}

		}
		else echo 'Please complete the data';
	}

	else{
		echo 'Operation not found';
	}
?>