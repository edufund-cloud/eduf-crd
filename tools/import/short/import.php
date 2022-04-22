<?php
    //if(isset($_POST["submit"])){
        require_once('../../../config/session.php');
        include_once("../../../config/database.php");

        $filename=$_FILES["file"]["name"];
        $ext=substr($filename,strrpos($filename,"."),(strlen($filename)-strrpos($filename,".")));

        
        //we check,file must be have csv extention
        if($ext=="csv"){
            $file = fopen($filename, "r");
            while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
            {
                
                $pic_name = $user_firstname.' '.$user_lastname;

                //Data Apply
                if (!empty($emapData[31])){
                    $txt_apply_date = $emapData[31];
                }
                else{
                    $txt_apply_date = '0000-00-00';
                }

                $sql_cpl = "INSERT INTO apply(ID, full_name, apply_date, 
                    product, pic, data_status, 
                    data_active, data_create, user_create, data_update, user_update) VALUES 
                    ('$emapData[2]', '$emapData[40]', '$txt_apply_date', 
                    '$emapData[14]', '$pic_name', 'New Loan',
                    '1', '$now', '$user_id', '$now', '$user_id')";
                if($xsql_cpl = mysqli_query($koneksi, $sql_cpl)){
                    $new_data_id = mysqli_insert_id($koneksi);
                }

            }
            fclose($file);
            echo "CS<div class='alert alert-success'>Data Berhasil Diimport. <br>Untuk kembali ke dashboard <a href='../../../''>Klik Disini</a></div>";
        }
        else {
            echo "Error: Please Upload only CSV File";
        }

    //}
?>