<?PHP 
	require_once('../../config/session.php'); 
	include_once("../../config/database.php");
	$sqldt = mysqli_query($koneksi,"SELECT now() AS tanggal");
	$xsqldt = mysqli_fetch_row($sqldt);
	$now = $xsqldt[0];
	
	$Nav_Done = 0;
	$Nav_Err = 0;
	if (($_GET['act']=="updacc") && !empty($_GET['usrid'])) {
		extract($_POST);
		/*Start Navigate*/
		for ($x=0;$x<count($txtNavigate);$x++){
			$sql_src = "SELECT gma.user_id 
				FROM gen_menu_access gma 
				WHERE gma.user_id = '$_GET[usrid]' AND gma.menu_id = '$txtNavigate[$x]'";
			$xsql_src = mysqli_query($koneksi, $sql_src);
			$nmsql_src = mysqli_num_rows($xsql_src);

			if ($chkNavigate[$x] == ""){ $Navigate_Active = 0; }
			else{ $Navigate_Active = $chkNavigate[$x]; }

			if ($nmsql_src >= 1){				
				$sql_nav = "UPDATE gen_menu_access SET 
					user_id 	= '$_GET[usrid]',
					menu_id 	= '$txtNavigate[$x]',
					data_active = '$Navigate_Active',
					data_update = '$now',
					user_update = '$user_id'
					WHERE user_id = '$_GET[usrid]' AND menu_id = '$txtNavigate[$x]'";
				if ($xsql_nav = mysqli_query($koneksi,$sql_nav)){
					$Nav_Done = $Nav_Done + 1;
				}
				else{
					$Nav_Err = $Nav_Err +1;
				}
			}
			else{
				$sql_nav = "INSERT INTO gen_menu_access(user_id,menu_id,data_active,data_create,user_create,data_update,user_update) VALUES 
					('$_GET[usrid]','$txtNavigate[$x]','$Navigate_Active','$now','$user_id','$now','$user_id')";
				if ($xsql_nav = mysqli_query($koneksi,$sql_nav)){
					$Nav_Done = $Nav_Done + 1;
				}
				else{
					$Nav_Err = $Nav_Err +1;
				}
			}
		}
		/*End Navigate*/

		/*Start Sub Navigate*/
		for ($y=0;$y<count($txtSubNavigate);$y++){
			$sql_src = "SELECT gma.user_id 
				FROM gen_menu_access gma 
				WHERE gma.user_id = '$_GET[usrid]' AND gma.menu_id = '$txtSubNavigate[$y]'";
			$xsql_src = mysqli_query($koneksi, $sql_src);
			$nmsql_src = mysqli_num_rows($xsql_src);

			if ($chkSubNavigate[$y] == ""){ $SubNavigate_Active = 0; }
			else{ $SubNavigate_Active = $chkSubNavigate[$y]; }

			if ($nmsql_src >= 1){				
				$sql_sub = "UPDATE gen_menu_access SET 
					user_id 	= '$_GET[usrid]',
					menu_id 	= '$txtSubNavigate[$y]',
					data_active = '$SubNavigate_Active',
					data_update = '$now',
					user_update = '$user_id'
					WHERE user_id = '$_GET[usrid]' AND menu_id = '$txtSubNavigate[$y]'";
				if ($xsql_sub = mysqli_query($koneksi,$sql_sub)){
					$Nav_Done = $Nav_Done + 1;
				}
				else{
					$Nav_Err = $Nav_Err +1;
				}
				
			}
			else{
				$sql_sub = "INSERT INTO gen_menu_access(user_id,menu_id,data_active,data_create,user_create,data_update,user_update) VALUES 
					('$_GET[usrid]','$txtSubNavigate[$y]','$SubNavigate_Active','$now','$user_id','$now','$user_id')";
				if ($xsql_sub = mysqli_query($koneksi,$sql_sub)){
					$Nav_Done = $Nav_Done + 1;
				}
				else{
					$Nav_Err = $Nav_Err +1;
				}
			}
		}
		/*End Sub Navigate*/
		
		if ($Nav_Done > 0){
			$modul = 'Akses User';
			$action = 'Update';
			//include("../../api/logs/xlogs.php");
			echo 'Success, User access has been updated. '.$Nav_Done. ' success, '.$Nav_Err. ' failed' ;
		}
		else{
			echo 'Failed update user access ';
		}
	}
	else{
		echo 'Please complete the data';
	}
?>