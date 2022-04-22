<?php
    //fetch.php
    if(!empty($_FILES['csv_file']['name'])){
        $file_data = fopen($_FILES['csv_file']['tmp_name'], 'r');
        $column = fgetcsv($file_data);
        while($row = fgetcsv($file_data)){
            $row_data[] = array(
                'join_ID' => $row[0],
                'borrowerID' => $row[1],
                'accountID' => $row[2],
                'email' => $row[3],
                'handphone' => $row[4],
                'email_VerfiedStatus' => $row[5],
                'hP_VerifiedStatus' => $row[6],
                'referralCode' => $row[7],
                'signUp_Date' => $row[8],
                'vA_Number' => $row[9],
                'account_Params' => $row[10],
                'loanID' => $row[11],
                'lenderID' => $row[12],
                'lender_Email' => $row[13],
                'product_Type' => $row[14],
                'instituion' => $row[15],
                'program' => $row[16],
                'invoice_File' => $row[17],
                'loanAmount' => $row[18],
                'downPayment' => $row[19],
                'disbursementAmount' => $row[20],
                'installment_Amount' => $row[21],
                'tenor' => $row[22],
                'internalStatus' => $row[23],
                'bankName' => $row[24],
                'bankAccountNumber' => $row[25],
                'bankAccountName' => $row[26],
                'applied' => $row[27],
                'approved' => $row[28],
                'rejected' => $row[29],
                'paid_Off' => $row[30],
                'applied_Date' => $row[31],
                'approval_Date' => $row[32],
                'disbursed_Date' => $row[33],
                'aging_Apply_Date' => $row[34],
                'aging_Approval_Date' => $row[35],
                'first_DueDate' => $row[36],
                'last_DueDate' => $row[37],
                'isInsured' => $row[38],
                'loan_Params' => $row[39],
                'myself_FullName' => $row[40],
                'myself_DateOfBirth' => $row[41],
                'myself_PlaceOfBirth' => $row[42],
                'myself_Gender' => $row[43],
                'myself_Education' => $row[44],
                'myself_MothersName' => $row[45],
                'myself_IDCardNumber' => $row[46],
                'myself_ImageKTP' => $row[47],
                'myself_ImageSelfie' => $row[48],
                'myself_MarriageStatus' => $row[49],
                'spouse_FullName' => $row[50],
                'spouse_DateOfBirth' => $row[51],
                'spouse_PlaceOfBirth' => $row[52],
                'spouse_Gender' => $row[53],
                'spouse_Education' => $row[54],
                'spouse_MothersName' => $row[55],
                'spouse_IDCardNumber' => $row[56],
                'spouse_ImageKTP' => $row[57],
                'spouse_ImageSelfie' => $row[58],
                'spouse_MarriageStatus' => $row[59],
                'id_ktp_Jalan' => $row[60],
                'id_ktp_No' => $row[61],
                'id_ktp_RT' => $row[62],
                'id_ktp_RW' => $row[63],
                'id_ktp_Kelurahan' => $row[64],
                'id_ktp_Kecamatan' => $row[65],
                'id_ktp_Kota_Kabupaten' => $row[66],
                'id_ktp_Provinsi' => $row[67],
                'id_ktp_KodePos' => $row[68],
                'domisili_domicile_Jalan' => $row[69],
                'domisili_domicile_No' => $row[70],
                'domisili_domicile_RT' => $row[71],
                'domisili_domicile_RW' => $row[72],
                'domisili_domicile_Kelurahan' => $row[73],
                'domisili_domicile_Kecamatan' => $row[74],
                'domisili_domicile_Kota_Kabupaten' => $row[75],
                'domisili_domicile_Provinsi' => $row[76],
                'domisili_domicile_KodePos' => $row[77],
                'domisili_domicile_ResidentialStatus' => $row[78],
                'domisili_domicile_DurationOfStay' => $row[79],
                'occupationName' => $row[80],
                'fields' => $row[81],
                'position' => $row[82],
                'lengthofWork' => $row[83],
                'income' => $row[84],
                'myself_ImageTax' => $row[85],
                'paySlip_File' => $row[86],
                'bankStatement_File' => $row[87],
                'referenceLetter_File' => $row[88],
                'companyName' => $row[89],
                'pekerjaan_Jalan' => $row[90],
                'pekerjaan_Kelurahan' => $row[91],
                'pekerjaan_Kecamatan' => $row[92],
                'pekerjaan_Kota_Kabupaten' => $row[93],
                'pekerjaan_Provinsi' => $row[94],
                'cP_Name' => $row[95],
                'cP_PhoneNumber' => $row[96],
                'eC_Name' => $row[97],
                'eC_PhoneNUmber' => $row[98],
                'eC_Relation' => $row[99]
            );
        }
        $output = array(
            'column'  => $column,
            'row_data'  => $row_data
        );

        echo json_encode($output);

    }

?>