<?PHP
	$sql_home = "SELECT gm.menu_file 
		FROM gen_menu_access gma 
		LEFT JOIN gen_menu gm ON gma.menu_id = gm.menu_id  
		WHERE gma.user_id = '$user_id' AND gm.menu_home = '1' AND gma.data_active = '1'";
	//echo $sql_home;
	$xsql_home = mysqli_query($koneksi,$sql_home);
	$arsql_home = mysqli_fetch_array($xsql_home);

  	$Home_Url = $arsql_home['menu_file'];
?>