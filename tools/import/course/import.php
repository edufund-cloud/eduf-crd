<?php
    require_once('../../../config/session.php');
    include_once("../../../config/database.php");

    if(isset($_POST["accountID"])){
        $sqldt = mysqli_query($koneksi,"SELECT now() AS tanggal");
        $xsqldt = mysqli_fetch_row($sqldt);
        $now = $xsqldt[0];
        
        $join_ID = $_POST["join_ID"];
        $borrowerID = $_POST["borrowerID"];
        $accountID = $_POST["accountID"];
        $email = $_POST["email"];
        $handphone = $_POST["handphone"];
        $email_VerfiedStatus = $_POST["email_VerfiedStatus"];
        $hP_VerifiedStatus = $_POST["hP_VerifiedStatus"];
        $referralCode = $_POST["referralCode"];
        $signUp_Date = $_POST["signUp_Date"];
        $vA_Number = $_POST["vA_Number"];
        $account_Params = $_POST["account_Params"];
        $loanID = $_POST["loanID"];
        $lenderID = $_POST["lenderID"];
        $lender_Email = $_POST["lender_Email"];
        $product_Type = $_POST["product_Type"];
        $instituion = $_POST["instituion"];
        $program = $_POST["program"];
        $invoice_File = $_POST["invoice_File"];
        $loanAmount = $_POST["loanAmount"];
        $downPayment = $_POST["downPayment"];
        $disbursementAmount = $_POST["disbursementAmount"];
        $installment_Amount = $_POST["installment_Amount"];
        $tenor = $_POST["tenor"];
        $internalStatus = $_POST["internalStatus"];
        $bankName = $_POST["bankName"];
        $bankAccountNumber = $_POST["bankAccountNumber"];
        $bankAccountName = $_POST["bankAccountName"];
        $applied = $_POST["applied"];
        $approved = $_POST["approved"];
        $rejected = $_POST["rejected"];
        $paid_Off = $_POST["paid_Off"];
        $applied_Date = $_POST["applied_Date"];
        $approval_Date = $_POST["approval_Date"];
        $disbursed_Date = $_POST["disbursed_Date"];
        $aging_Apply_Date = $_POST["aging_Apply_Date"];
        $aging_Approval_Date = $_POST["aging_Approval_Date"];
        $first_DueDate = $_POST["first_DueDate"];
        $last_DueDate = $_POST["last_DueDate"];
        $isInsured = $_POST["isInsured"];
        $loan_Params = $_POST["loan_Params"];
        $myself_FullName = $_POST["myself_FullName"];
        $myself_DateOfBirth = $_POST["myself_DateOfBirth"];
        $myself_PlaceOfBirth = $_POST["myself_PlaceOfBirth"];
        $myself_Gender = $_POST["myself_Gender"];
        $myself_Education = $_POST["myself_Education"];
        $myself_MothersName = $_POST["myself_MothersName"];
        $myself_IDCardNumber = $_POST["myself_IDCardNumber"];
        $myself_ImageKTP = $_POST["myself_ImageKTP"];
        $myself_ImageSelfie = $_POST["myself_ImageSelfie"];
        $myself_MarriageStatus = $_POST["myself_MarriageStatus"];
        $spouse_FullName = $_POST["spouse_FullName"];
        $spouse_DateOfBirth = $_POST["spouse_DateOfBirth"];
        $spouse_PlaceOfBirth = $_POST["spouse_PlaceOfBirth"];
        $spouse_Gender = $_POST["spouse_Gender"];
        $spouse_Education = $_POST["spouse_Education"];
        $spouse_MothersName = $_POST["spouse_MothersName"];
        $spouse_IDCardNumber = $_POST["spouse_IDCardNumber"];
        $spouse_ImageKTP = $_POST["spouse_ImageKTP"];
        $spouse_ImageSelfie = $_POST["spouse_ImageSelfie"];
        $spouse_MarriageStatus = $_POST["spouse_MarriageStatus"];
        $id_ktp_Jalan = $_POST["id_ktp_Jalan"];
        $id_ktp_No = $_POST["id_ktp_No"];
        $id_ktp_RT = $_POST["id_ktp_RT"];
        $id_ktp_RW = $_POST["id_ktp_RW"];
        $id_ktp_Kelurahan = $_POST["id_ktp_Kelurahan"];
        $id_ktp_Kecamatan = $_POST["id_ktp_Kecamatan"];
        $id_ktp_Kota_Kabupaten = $_POST["id_ktp_Kota_Kabupaten"];
        $id_ktp_Provinsi = $_POST["id_ktp_Provinsi"];
        $id_ktp_KodePos = $_POST["id_ktp_KodePos"];
        $domisili_domicile_Jalan = $_POST["domisili_domicile_Jalan"];
        $domisili_domicile_No = $_POST["domisili_domicile_No"];
        $domisili_domicile_RT = $_POST["domisili_domicile_RT"];
        $domisili_domicile_RW = $_POST["domisili_domicile_RW"];
        $domisili_domicile_Kelurahan = $_POST["domisili_domicile_Kelurahan"];
        $domisili_domicile_Kecamatan = $_POST["domisili_domicile_Kecamatan"];
        $domisili_domicile_Kota_Kabupaten = $_POST["domisili_domicile_Kota_Kabupaten"];
        $domisili_domicile_Provinsi = $_POST["domisili_domicile_Provinsi"];
        $domisili_domicile_KodePos = $_POST["domisili_domicile_KodePos"];
        $domisili_domicile_ResidentialStatus = $_POST["domisili_domicile_ResidentialStatus"];
        $domisili_domicile_DurationOfStay = $_POST["domisili_domicile_DurationOfStay"];
        $occupationName = $_POST["occupationName"];
        $fields = $_POST["fields"];
        $position = $_POST["position"];
        $lengthofWork = $_POST["lengthofWork"];
        $income = $_POST["income"];
        $myself_ImageTax = $_POST["myself_ImageTax"];
        $paySlip_File = $_POST["paySlip_File"];
        $bankStatement_File = $_POST["bankStatement_File"];
        $referenceLetter_File = $_POST["referenceLetter_File"];
        $companyName = $_POST["companyName"];
        $pekerjaan_Jalan = $_POST["pekerjaan_Jalan"];
        $pekerjaan_Kelurahan = $_POST["pekerjaan_Kelurahan"];
        $pekerjaan_Kecamatan = $_POST["pekerjaan_Kecamatan"];
        $pekerjaan_Kota_Kabupaten = $_POST["pekerjaan_Kota_Kabupaten"];
        $pekerjaan_Provinsi = $_POST["pekerjaan_Provinsi"];
        $cP_Name = $_POST["cP_Name"];
        $cP_PhoneNumber = $_POST["cP_PhoneNumber"];
        $eC_Name = $_POST["eC_Name"];
        $eC_PhoneNUmber = $_POST["eC_PhoneNUmber"];
        $eC_Relation = $_POST["eC_Relation"];
                
        for($count = 0; $count < count($accountID); $count++){

            $pic_name = $user_firstname.' '.$user_lastname;

            //Data Apply
            if (!empty($applied_Date[$count])){
                $txt_apply_date = $applied_Date[$count];
            }
            else{
                $txt_apply_date = '0000-00-00';
            }

            $sql_cpl = "INSERT INTO apply(ID, full_name, apply_date, 
                product, pic, data_status, 
                data_active, data_create, user_create, data_update, user_update) VALUES 
                ('$loanID[$count]', '$myself_FullName[$count]', '$txt_apply_date', 
                '$product_Type[$count]', '$pic_name', 'New Loan',
                '1', '$now', '$user_id', '$now', '$user_id')";
            if($xsql_cpl = mysqli_query($koneksi, $sql_cpl)){
                $new_data_id = mysqli_insert_id($koneksi);                

                 
            }
        }
    }

?>