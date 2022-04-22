<?PHP 
	if ($new_user_id >= 1){
		$new_user_id = $new_user_id;
	}
	else{
		$new_user_id = $_GET['usrid'];
	}

	if (!empty($txtPictureUrl) && $_GET['act'] == "updprf"){
		$meta_key_data = array(
			'first_name=='.$txtFirstName,
			'last_name=='.$txtLastName,
			'user_phone=='.$txtPhone,
			'user_biography=='.$txtBiography,
			'user_picture=='.$txtPictureUrl
		);
	}
	else if (empty($txtPictureUrl) && $_GET['act'] == "updprf"){
		$meta_key_data = array(
			'first_name=='.$txtFirstName,
			'last_name=='.$txtLastName,
			'user_phone=='.$txtPhone,
			'user_biography=='.$txtBiography
		);
	}
	else{
		$meta_key_data = array(
			'nick_name=='.$txtNickName,
			'user_level=='.$cmbSysLevel,
			'group_id=='.$group_name
		);
	}

	$response = 0;
	$error = 0;

	for($x=0;$x<count($meta_key_data);$x++){	
		$exp_array = explode("==", $meta_key_data[$x]);
		$meta_key = $exp_array[0];
		$meta_value = $exp_array[1];

		$sql_src = "SELECT go.meta_id 
			FROM gen_usermeta go
			WHERE go.meta_key = '$meta_key' AND go.user_id = '$_GET[usrid]'";
		//echo $sql_src;	
		$xsql_src = mysqli_query($koneksi,$sql_src);
		$nmsql_src = mysqli_num_rows($xsql_src);
		$arsql_src = mysqli_fetch_array($xsql_src);

		if ($nmsql_src < 1){
			$sql = "INSERT INTO gen_usermeta(user_id,meta_key,meta_value,
				data_create,user_create,data_update,user_update) VALUES
				('$new_user_id','$meta_key','$meta_value',
				'$now','$user_id','$now','$user_id')";
			//echo $sql;
			if ($xsql = mysqli_query($koneksi,$sql)){
				$response = $response + 1;
			}
			else{
				$error = $error + 1;
			}
		}
		else if (($nmsql_src >= 1) && (($_GET['act'] == "edtusr") or ($_GET['act'] == "updprf"))){
			$option_id = $arsql_src['meta_id'];

			$sql = "UPDATE gen_usermeta SET 
				meta_value = '$meta_value',
				data_update = '$now',
				user_update = '$user_id' 
				WHERE meta_id = '$option_id' AND user_id = '$_GET[usrid]' 
				AND meta_key = '$meta_key'";

			if ($xsql = mysqli_query($koneksi,$sql)){
				$response = $response + 1;
			}
			else{
				$error = $error + 1;
			}
		}
		else if (($nmsql_src >= 1) && ($_GET['act'] == "delusr")){
			$option_id = $arsql_src['meta_id'];

			$sql = "DELETE FROM gen_usermeta 
				WHERE meta_id = '$option_id' AND user_id = '$_GET[usrid]' 
				AND meta_key = '$meta_key'";
			if ($xsql = mysqli_query($koneksi,$sql)){
				$response = $response + 1;
			}
			else{
				$error = $error + 1;
			}
		}
	}
	//echo 'Respon : '.$response.' meta data berhasil diupdate. '.$error.' Failed update data<br><br>';
?>