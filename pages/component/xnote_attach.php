<?php
	require_once('../../config/session.php'); 
	include_once("../../config/database.php");
  	$temp = "../../uploads/attachment";
  	$sqldt = mysqli_query($koneksi,"SELECT now() AS tanggal, DATE_FORMAT(now(),'%Y%m%d%k%i%s') AS date_label");
	$xsqldt = mysqli_fetch_row($sqldt);
	$now = $xsqldt[0];
	$date_label = $xsqldt[1];
  if (!file_exists($temp))
  //mkdir($temp);
  $txt_id          = $_POST['txt_id'];
  $txt_title       = $_POST['txt_title'];
  $fileupload      = $_FILES['fileupload']['tmp_name'];
  $ImageName       = $_FILES['fileupload']['name'];
  $ImageType       = $_FILES['fileupload']['type'];
  
  if (!empty($fileupload)){
    $ImageExt       = substr($ImageName, strrpos($ImageName, '.'));
    $ImageExt       = str_replace('.','',$ImageExt); // Extension
    $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
    $NewImageName   = str_replace(' ', '', $txt_title.'.'.$ImageExt);
    $Target 		= $temp.'/'.$date_label.'.'.$ImageExt;
    $Target_SQL = 'uploads/attachment/'.$date_label.'.'.$ImageExt;
  	  	
  	if (move_uploaded_file($_FILES['fileupload']['tmp_name'], $Target)) {
      $sql = "INSERT INTO apply_attach(data_id,description,attach_url,data_update,user_update) VALUES 
        ('$_POST[txt_id]','$txt_title', '$Target_SQL', '$now', '$user_id')";
      //echo"$sql";  
      if(mysqli_query($koneksi, $sql)){
        echo 'Success, File berhasil diupload';
      }
      else{
        echo 'Data tidak dapat disimpan!';
      }
      //echo 'Success, File berhasil diupload'.$sql.'----'.$_POST['txt_id'];
    }
  	else{
  		echo "File gagal diupload";
  	}
    
  } 
  else {
    echo "file Gagal Diupload";
  }
?>