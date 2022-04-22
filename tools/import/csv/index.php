<?php
require_once('../../../config/session.php');
use Phppot\DataSource;

require_once 'DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();

$sqldt = mysqli_query($koneksi,"SELECT now() AS tanggal");
$xsqldt = mysqli_fetch_row($sqldt);
$now = $xsqldt[0];

$pic_name = $user_firstname.' '.$user_lastname;

if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            
            $join_ID = "";
            $BorrowerID = "";
            $AccountID = "";
            $Email = "";
            $Handphone = "";
            $Email_VerfiedStatus = "";
            $HP_VerifiedStatus = "";
            $ReferralCode = "";
            $SignUp_Date = "";
            $VA_Number = "";
            $Account_Params = "";
            $LoanID = "";
            $LenderID = "";
            $Lender_Email = "";
            $Product_Type = "";
            $Instituion = "";
            $Program = "";
            $Invoice_File = "";
            $LoanAmount = "";
            $DownPayment = "";
            $DisbursementAmount = "";
            $Installment_Amount = "";
            $Tenor = "";
            $InternalStatus = "";
            $BankName = "";
            $BankAccountNumber = "";
            $BankAccountName = "";
            $Applied = "";
            $Approved = "";
            $Rejected = "";
            $Paid_Off = "";
            $Applied_Date = "";
            $Approval_Date = "";
            $Disbursed_Date = "";
            $Aging_Apply_Date = "";
            $Aging_Approval_Date = "";
            $First_DueDate = "";
            $Last_DueDate = "";
            $IsInsured = "";
            $Loan_Params = "";
            $myself_FullName = "";
            $myself_DateOfBirth = "";
            $myself_PlaceOfBirth = "";
            $myself_Gender = "";
            $myself_Education = "";
            $myself_MothersName = "";
            $myself_IDCardNumber = "";
            $myself_ImageKTP = "";
            $myself_ImageSelfie = "";
            $myself_MarriageStatus = "";
            $spouse_FullName = "";
            $spouse_DateOfBirth = "";
            $spouse_PlaceOfBirth = "";
            $spouse_Gender = "";
            $spouse_Education = "";
            $spouse_MothersName = "";
            $spouse_IDCardNumber = "";
            $spouse_ImageKTP = "";
            $spouse_ImageSelfie = "";
            $spouse_MarriageStatus = "";
            $id_ktp_Jalan = "";
            $id_ktp_No = "";
            $id_ktp_RT = "";
            $id_ktp_RW = "";
            $id_ktp_Kelurahan = "";
            $id_ktp_Kecamatan = "";
            $id_ktp_Kota_Kabupaten = "";
            $id_ktp_Provinsi = "";
            $id_ktp_KodePos = "";
            $domisili_domicile_Jalan = "";
            $domisili_domicile_No = "";
            $domisili_domicile_RT = "";
            $domisili_domicile_RW = "";
            $domisili_domicile_Kelurahan = "";
            $domisili_domicile_Kecamatan = "";
            $domisili_domicile_Kota_Kabupaten = "";
            $domisili_domicile_Provinsi = "";
            $domisili_domicile_KodePos = "";
            $domisili_domicile_ResidentialStatus = "";
            $domisili_domicile_DurationOfStay = "";
            $OccupationName = "";
            $Fields = "";
            $Position = "";
            $LengthofWork = "";
            $Income = "";
            $myself_ImageTax = "";
            $PaySlip_File = "";
            $BankStatement_File = "";
            $ReferenceLetter_File = "";
            $CompanyName = "";
            $pekerjaan_Jalan = "";
            $pekerjaan_Kelurahan = "";
            $pekerjaan_Kecamatan = "";
            $pekerjaan_Kota_Kabupaten = "";
            $pekerjaan_Provinsi = "";
            $CP_Name = "";
            $CP_PhoneNumber = "";
            $EC_Name = "";
            $EC_PhoneNUmber = "";
            $EC_Relation = "";

            
            if (isset($column[0])) {  $join_ID = mysqli_real_escape_string($conn, $column[0]);  }
            if (isset($column[1])) {$BorrowerID = mysqli_real_escape_string($conn, $column[1]);  }
            if (isset($column[2])) {$AccountID = mysqli_real_escape_string($conn, $column[2]);  }
            if (isset($column[3])) {$Email = mysqli_real_escape_string($conn, $column[3]);  }
            if (isset($column[4])) {$Handphone = mysqli_real_escape_string($conn, $column[4]);  }
            if (isset($column[5])) {$Email_VerfiedStatus = mysqli_real_escape_string($conn, $column[5]);  }
            if (isset($column[6])) {$HP_VerifiedStatus = mysqli_real_escape_string($conn, $column[6]);  }
            if (isset($column[7])) {$ReferralCode = mysqli_real_escape_string($conn, $column[7]);  }
            if (isset($column[8])) {$SignUp_Date = mysqli_real_escape_string($conn, $column[8]);  }
            if (isset($column[9])) {$VA_Number = mysqli_real_escape_string($conn, $column[9]);  }
            if (isset($column[10])) {$Account_Params = mysqli_real_escape_string($conn, $column[10]);  }
            if (isset($column[11])) {$LoanID = mysqli_real_escape_string($conn, $column[11]);  }
            if (isset($column[12])) {$LenderID = mysqli_real_escape_string($conn, $column[12]);  }
            if (isset($column[13])) {$Lender_Email = mysqli_real_escape_string($conn, $column[13]);  }
            if (isset($column[14])) {$Product_Type = mysqli_real_escape_string($conn, $column[14]);  }
            if (isset($column[15])) {$Instituion = mysqli_real_escape_string($conn, $column[15]);  }
            if (isset($column[16])) {$Program = mysqli_real_escape_string($conn, $column[16]);  }
            if (isset($column[17])) {$Invoice_File = mysqli_real_escape_string($conn, $column[17]);  }
            if (isset($column[18])) {$LoanAmount = mysqli_real_escape_string($conn, $column[18]);  }
            if (isset($column[19])) {$DownPayment = mysqli_real_escape_string($conn, $column[19]);  }
            if (isset($column[20])) {$DisbursementAmount = mysqli_real_escape_string($conn, $column[20]);  }
            if (isset($column[21])) {$Installment_Amount = mysqli_real_escape_string($conn, $column[21]);  }
            if (isset($column[22])) {$Tenor = mysqli_real_escape_string($conn, $column[22]);  }
            if (isset($column[23])) {$InternalStatus = mysqli_real_escape_string($conn, $column[23]);  }
            if (isset($column[24])) {$BankName = mysqli_real_escape_string($conn, $column[24]);  }
            if (isset($column[25])) {$BankAccountNumber = mysqli_real_escape_string($conn, $column[25]);  }
            if (isset($column[26])) {$BankAccountName = mysqli_real_escape_string($conn, $column[26]);  }
            if (isset($column[27])) {$Applied = mysqli_real_escape_string($conn, $column[27]);  }
            if (isset($column[28])) {$Approved = mysqli_real_escape_string($conn, $column[28]);  }
            if (isset($column[29])) {$Rejected = mysqli_real_escape_string($conn, $column[29]);  }
            if (isset($column[30])) {$Paid_Off = mysqli_real_escape_string($conn, $column[30]);  }
            if (isset($column[31])) {$Applied_Date = mysqli_real_escape_string($conn, $column[31]);  }
            if (isset($column[32])) {$Approval_Date = mysqli_real_escape_string($conn, $column[32]);  }
            if (isset($column[33])) {$Disbursed_Date = mysqli_real_escape_string($conn, $column[33]);  }
            if (isset($column[34])) {$Aging_Apply_Date = mysqli_real_escape_string($conn, $column[34]);  }
            if (isset($column[35])) {$Aging_Approval_Date = mysqli_real_escape_string($conn, $column[35]);  }
            if (isset($column[36])) {$First_DueDate = mysqli_real_escape_string($conn, $column[36]);  }
            if (isset($column[37])) {$Last_DueDate = mysqli_real_escape_string($conn, $column[37]);  }
            if (isset($column[38])) {$IsInsured = mysqli_real_escape_string($conn, $column[38]);  }
            if (isset($column[39])) {$Loan_Params = mysqli_real_escape_string($conn, $column[39]);  }
            if (isset($column[40])) {$myself_FullName = mysqli_real_escape_string($conn, $column[40]);  }
            if (isset($column[41])) {$myself_DateOfBirth = mysqli_real_escape_string($conn, $column[41]);  }
            if (isset($column[42])) {$myself_PlaceOfBirth = mysqli_real_escape_string($conn, $column[42]);  }
            if (isset($column[43])) {$myself_Gender = mysqli_real_escape_string($conn, $column[43]);  }
            if (isset($column[44])) {$myself_Education = mysqli_real_escape_string($conn, $column[44]);  }
            if (isset($column[45])) {$myself_MothersName = mysqli_real_escape_string($conn, $column[45]);  }
            if (isset($column[46])) {$myself_IDCardNumber = mysqli_real_escape_string($conn, $column[46]);  }
            if (isset($column[47])) {$myself_ImageKTP = mysqli_real_escape_string($conn, $column[47]);  }
            if (isset($column[48])) {$myself_ImageSelfie = mysqli_real_escape_string($conn, $column[48]);  }
            if (isset($column[49])) {$myself_MarriageStatus = mysqli_real_escape_string($conn, $column[49]);  }
            if (isset($column[50])) {$spouse_FullName = mysqli_real_escape_string($conn, $column[50]);  }
            if (isset($column[51])) {$spouse_DateOfBirth = mysqli_real_escape_string($conn, $column[51]);  }
            if (isset($column[52])) {$spouse_PlaceOfBirth = mysqli_real_escape_string($conn, $column[52]);  }
            if (isset($column[53])) {$spouse_Gender = mysqli_real_escape_string($conn, $column[53]);  }
            if (isset($column[54])) {$spouse_Education = mysqli_real_escape_string($conn, $column[54]);  }
            if (isset($column[55])) {$spouse_MothersName = mysqli_real_escape_string($conn, $column[55]);  }
            if (isset($column[56])) {$spouse_IDCardNumber = mysqli_real_escape_string($conn, $column[56]);  }
            if (isset($column[57])) {$spouse_ImageKTP = mysqli_real_escape_string($conn, $column[57]);  }
            if (isset($column[58])) {$spouse_ImageSelfie = mysqli_real_escape_string($conn, $column[58]);  }
            if (isset($column[59])) {$spouse_MarriageStatus = mysqli_real_escape_string($conn, $column[59]);  }
            if (isset($column[60])) {$id_ktp_Jalan = mysqli_real_escape_string($conn, $column[60]);  }
            if (isset($column[61])) {$id_ktp_No = mysqli_real_escape_string($conn, $column[61]);  }
            if (isset($column[62])) {$id_ktp_RT = mysqli_real_escape_string($conn, $column[62]);  }
            if (isset($column[63])) {$id_ktp_RW = mysqli_real_escape_string($conn, $column[63]);  }
            if (isset($column[64])) {$id_ktp_Kelurahan = mysqli_real_escape_string($conn, $column[64]);  }
            if (isset($column[65])) {$id_ktp_Kecamatan = mysqli_real_escape_string($conn, $column[65]);  }
            if (isset($column[66])) {$id_ktp_Kota_Kabupaten = mysqli_real_escape_string($conn, $column[66]);  }
            if (isset($column[67])) {$id_ktp_Provinsi = mysqli_real_escape_string($conn, $column[67]);  }
            if (isset($column[68])) {$id_ktp_KodePos = mysqli_real_escape_string($conn, $column[68]);  }
            if (isset($column[69])) {$domisili_domicile_Jalan = mysqli_real_escape_string($conn, $column[69]);  }
            if (isset($column[70])) {$domisili_domicile_No = mysqli_real_escape_string($conn, $column[70]);  }
            if (isset($column[71])) {$domisili_domicile_RT = mysqli_real_escape_string($conn, $column[71]);  }
            if (isset($column[72])) {$domisili_domicile_RW = mysqli_real_escape_string($conn, $column[72]);  }
            if (isset($column[73])) {$domisili_domicile_Kelurahan = mysqli_real_escape_string($conn, $column[73]);  }
            if (isset($column[74])) {$domisili_domicile_Kecamatan = mysqli_real_escape_string($conn, $column[74]);  }
            if (isset($column[75])) {$domisili_domicile_Kota_Kabupaten = mysqli_real_escape_string($conn, $column[75]);  }
            if (isset($column[76])) {$domisili_domicile_Provinsi = mysqli_real_escape_string($conn, $column[76]);  }
            if (isset($column[77])) {$domisili_domicile_KodePos = mysqli_real_escape_string($conn, $column[77]);  }
            if (isset($column[78])) {$domisili_domicile_ResidentialStatus = mysqli_real_escape_string($conn, $column[78]);  }
            if (isset($column[79])) {$domisili_domicile_DurationOfStay = mysqli_real_escape_string($conn, $column[79]);  }
            if (isset($column[80])) {$OccupationName = mysqli_real_escape_string($conn, $column[80]);  }
            if (isset($column[81])) {$Fields = mysqli_real_escape_string($conn, $column[81]);  }
            if (isset($column[82])) {$Position = mysqli_real_escape_string($conn, $column[82]);  }
            if (isset($column[83])) {$LengthofWork = mysqli_real_escape_string($conn, $column[83]);  }
            if (isset($column[84])) {$Income = mysqli_real_escape_string($conn, $column[84]);  }
            if (isset($column[85])) {$myself_ImageTax = mysqli_real_escape_string($conn, $column[85]);  }
            if (isset($column[86])) {$PaySlip_File = mysqli_real_escape_string($conn, $column[86]);  }
            if (isset($column[87])) {$BankStatement_File = mysqli_real_escape_string($conn, $column[87]);  }
            if (isset($column[88])) {$ReferenceLetter_File = mysqli_real_escape_string($conn, $column[88]);  }
            if (isset($column[89])) {$CompanyName = mysqli_real_escape_string($conn, $column[89]);  }
            if (isset($column[90])) {$pekerjaan_Jalan = mysqli_real_escape_string($conn, $column[90]);  }
            if (isset($column[91])) {$pekerjaan_Kelurahan = mysqli_real_escape_string($conn, $column[91]);  }
            if (isset($column[92])) {$pekerjaan_Kecamatan = mysqli_real_escape_string($conn, $column[92]);  }
            if (isset($column[93])) {$pekerjaan_Kota_Kabupaten = mysqli_real_escape_string($conn, $column[93]);  }
            if (isset($column[94])) {$pekerjaan_Provinsi = mysqli_real_escape_string($conn, $column[94]);  }
            if (isset($column[95])) {$CP_Name = mysqli_real_escape_string($conn, $column[95]);  }
            if (isset($column[96])) {$CP_PhoneNumber = mysqli_real_escape_string($conn, $column[96]);  }
            if (isset($column[97])) {$EC_Name = mysqli_real_escape_string($conn, $column[97]);  }
            if (isset($column[98])) {$EC_PhoneNUmber = mysqli_real_escape_string($conn, $column[98]);  }
            if (isset($column[99])) {$EC_Relation = mysqli_real_escape_string($conn, $column[99]);  }

            
            $sqlInsert = "INSERT INTO apply(ID, full_name, apply_date, 
                product, pic, data_status, 
                data_active, data_create, user_create, data_update, user_update) 
                    VALUES (?,?,?,?,?,?,?,?,?,?,?)";
            $paramType = "issss";
            $paramArray = array(
                $LoanID,
                $myself_FullName,
                $Applied_Date,
                $Product_Type,
                $pic_name,
                'New Loan',
                '1',
                $now,
                $user_id,
                $now,
                $user_id

            );
            $insertId = $db->insert($sqlInsert, $paramType, $paramArray);
            
            if (! empty($insertId)) {
                $type = "success";
                $message = "CSV Data Imported into the Database";
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
<script src="jquery-3.2.1.min.js"></script>

<style>
body {
    font-family: Arial;
    width: 550px;
}

.outer-scontainer {
    background: #F0F0F0;
    border: #e0dfdf 1px solid;
    padding: 20px;
    border-radius: 2px;
}

.input-row {
    margin-top: 0px;
    margin-bottom: 20px;
}

.btn-submit {
    background: #333;
    border: #1d1d1d 1px solid;
    color: #f0f0f0;
    font-size: 0.9em;
    width: 100px;
    border-radius: 2px;
    cursor: pointer;
}

.outer-scontainer table {
    border-collapse: collapse;
    width: 100%;
}

.outer-scontainer th {
    border: 1px solid #dddddd;
    padding: 8px;
    text-align: left;
}

.outer-scontainer td {
    border: 1px solid #dddddd;
    padding: 8px;
    text-align: left;
}

#response {
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 2px;
    display: none;
}

.success {
    background: #c7efd9;
    border: #bbe2cd 1px solid;
}

.error {
    background: #fbcfcf;
    border: #f3c6c7 1px solid;
}

div#response.display-block {
    display: block;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
    $("#frmCSVImport").on("submit", function () {

	    $("#response").attr("class", "");
        $("#response").html("");
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if (!regex.test($("#file").val().toLowerCase())) {
        	    $("#response").addClass("error");
        	    $("#response").addClass("display-block");
            $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
            return false;
        }
        return true;
    });
});
</script>
</head>

<body>
    <h2>Import CSV file into Mysql using PHP</h2>

    <div id="response"
        class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
        <?php if(!empty($message)) { echo $message; } ?>
        </div>
    <div class="outer-scontainer">
        <div class="row">

            <form class="form-horizontal" action="" method="post"
                name="frmCSVImport" id="frmCSVImport"
                enctype="multipart/form-data">
                <div class="input-row">
                    <label class="col-md-4 control-label">Choose CSV
                        File</label> <input type="file" name="file"
                        id="file" accept=".csv">
                    <button type="submit" id="submit" name="import"
                        class="btn-submit">Import</button>
                    <br />

                </div>

            </form>

        </div>
               <?php
            $sqlSelect = "SELECT * FROM users";
            $result = $db->select($sqlSelect);
            if (! empty($result)) {
                ?>
            <table id='userTable'>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>First Name</th>
                    <th>Last Name</th>

                </tr>
            </thead>
<?php
                
                foreach ($result as $row) {
                    ?>
                    
                <tbody>
                <tr>
                    <td><?php  echo $row['userId']; ?></td>
                    <td><?php  echo $row['userName']; ?></td>
                    <td><?php  echo $row['firstName']; ?></td>
                    <td><?php  echo $row['lastName']; ?></td>
                </tr>
                    <?php
                }
                ?>
                </tbody>
        </table>
        <?php } ?>
    </div>

</body>

</html>