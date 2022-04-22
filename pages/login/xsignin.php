<?PHP
	include_once("../../config/database.php");
	if (isset($_GET['act']) == "login") {
		$email = $_POST['txtLogin'];
		$sys_pass = hash('sha256',$_POST['txtPassword']);
		$sql = "SELECT gu.user_id,gu.user_login,gu.sys_pass,gu.user_email,gg.description AS group_name 
			FROM gen_users gu 
			LEFT JOIN gen_group gg ON gu.group_id = gg.group_id 
			WHERE (gu.user_email = '$email' OR gu.user_login = '$email') 
			AND gu.sys_pass = '$sys_pass' AND gu.data_active = '1'";
		//echo"$sql";
		$xsql = mysqli_query($koneksi, $sql);
		$nmsql = mysqli_num_rows($xsql);
		$arsql = mysqli_fetch_array($xsql);					   
		if ($nmsql >= 1 ) {
			$user_id = $arsql['user_id'];
			$sql_meta = "SELECT gum.user_id,
				(
					SELECT meta_value 
					from gen_usermeta 
					WHERE meta_key = 'nick_name' AND user_id = gum.user_id
				) AS nick_name,
				(
					SELECT meta_value 
					FROM gen_usermeta 
					WHERE meta_key = 'first_name' AND user_id = gum.user_id
				) AS first_name,
				(
					SELECT meta_value 
					FROM gen_usermeta 
					WHERE meta_key = 'last_name' AND user_id = gum.user_id
				) AS last_name,
				(
					SELECT meta_value 
					FROM gen_usermeta 
					WHERE meta_key = 'user_level' AND user_id = gum.user_id
				) AS user_level,
				(
					SELECT meta_value 
					FROM gen_usermeta 
					WHERE meta_key = 'user_picture' AND user_id = gum.user_id
				) AS user_picture
				FROM gen_usermeta gum 
				WHERE gum.user_id = '$user_id'
				GROUP BY gum.user_id";
			$xsql_meta = mysqli_query($koneksi,$sql_meta);
			$arsql_meta = mysqli_fetch_array($xsql_meta);


            $user_id 			= $arsql['user_id'];			
			$user_email 		= $arsql['user_email'];

			$user_nickname 		= $arsql_meta['nick_name'];
			$user_firstname 	= $arsql_meta['first_name'];
			$user_lastname 		= $arsql_meta['last_name'];
			$user_level 		= $arsql_meta['user_level'];
			$user_picture		= $arsql_meta['user_picture'];	
			$user_group_name	= $arsql['group_name'];	

			session_start();
			$_SESSION['user_id'] 			= $user_id;			
			$_SESSION['user_email'] 		= $user_email;
			$_SESSION['user_nickname'] 		= $user_nickname;
			$_SESSION['user_firstname'] 	= $user_firstname;
			$_SESSION['user_lastname'] 		= $user_lastname;
			$_SESSION['user_level'] 		= $user_level;
			$_SESSION['user_picture']		= $user_picture;
			$_SESSION['user_group_name']	= $user_group_name;	
			$_SESSION['user_sn'] 		= 'user___'.$web_id;
			header('location:../../');
		}
		else if ($xsql && $nmsql < 1 ){
			header('location:../../?&errlog=1');
		}
		else{
			header('location:../../?&errlog=2');
		}
	}
?>