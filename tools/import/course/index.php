<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Edufund | Tool Import Data</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Favicon -->
  <link rel="shortcut icon" href="../../../dist/img/edufund-favicon.png">
</head>
<body class="hold-transition layout-top-nav">

<?PHP
  require_once("../../../config/session.php");
  require_once("../../../config/database.php");
  require_once("../../../com/home_map.php");
?>

<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="../../../" class="navbar-brand">
          <img src="../../../dist/img/edufund-logo-short-1.png" alt="Edufund Logo" class="brand-image"
              style="opacity: .8;">
          <span class="brand-text font-weight-bold text-primary">EDUFUND</span>
          <i class="fa-solid fa-pipe ml-1 mr-1"></i>
          <span class="brand-text font-weight-light" style="font-size:16px;">Tool Import Data CSV</span>
      </a>
      
      <a href="../../../" class="button navbar-toggler order-1">
        <span class="navbar-toggler-icon"></span>
      </a>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="../../../" role="button">
            <i class="fa-solid fa-xmark"></i>
          </a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Import Data From File *.csv</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../../">Home</a></li>
              <li class="breadcrumb-item active">Import Data</li>              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row pt-2 pb-2 mb-4" style="border-style: solid; border-width: thin; border-color: grey; border-radius:10px;">
          
          <form class="mb-3" id="upload_csv" method="post" enctype="multipart/form-data">
            <div class="form-group row ml-2">
              <label for="txtEmail" class="col-md-12 col-form-label">
                Select File CSV<label class="badge bg-danger" style="margin-left: 10px;"> Required</label>
              </label>
              <div class="col-md-8">
                <input type="file" name="csv_file" id="csv_file" accept=".csv" style="margin-top:15px;" />
              </div>
              <div class="col-md-4">
                <button type="submit" name="upload" id="upload" style="margin-top:10px;" class="btn btn-info" />
                  <i class="fa-solid fa-cloud-arrow-up mr-2"></i>Upload
                </button>
              </div>
            </div> 
            <div style="clear:both"></div>
          </form>
          <br>
        </div>

        <div class="row">
          <div class="col-lg-12" id="csv_file_data"></div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  

  <!-- Main Footer -->
  <footer class="main-footer">
    <small class="mr-2"><b>Version</b> 2.0.1</small><small>&copy; 2022 </small><a href="https://edufund.co.id/"> edufund.id</a>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.min.js"></script>

<script>
  $(document).ready(function(){
    $('#upload_csv').on('submit', function(event){
      event.preventDefault();
      $.ajax({        
        url:"fetch.php",
        method:"POST",
        data:new FormData(this),
        dataType:'json',
        contentType:false,
        cache:false,
        processData:false,
        success:function(data){
          var html = '<table class="table table-striped table-bordered">';
          if(data.column){
            html += '<tr>';
            for(var count = 0; count < data.column.length; count++){
              if(count > 4){
                html += '<th hidden>'+data.column[count]+'</th>';
              }
              else{
                html += '<th>'+data.column[count]+'</th>';
              }
            }
            html += '</tr>';
          
            if(data.row_data){
              for(var count = 0; count < data.row_data.length; count++){
                html += '<tr>';
                  html += '<td class="join_ID" contenteditable>'+data.row_data[count].join_ID+'</td>';                  
                  html += '<td class="borrowerID" contenteditable>'+data.row_data[count].borrowerID+'</td>';
                  html += '<td class="accountID" contenteditable>'+data.row_data[count].accountID+'</td>';
                  html += '<td class="email" contenteditable>'+data.row_data[count].email+'</td>';
                  html += '<td class="handphone" contenteditable>'+data.row_data[count].handphone+'</td>';
                  html += '<td hidden class ="email_VerfiedStatus" contenteditable>'+data.row_data[count].email_VerfiedStatus+'</td>';
                  html += '<td hidden class ="hP_VerifiedStatus" contenteditable>'+data.row_data[count].hP_VerifiedStatus+'</td>';
                  html += '<td hidden class ="referralCode" contenteditable>'+data.row_data[count].referralCode+'</td>';
                  html += '<td hidden class ="signUp_Date" contenteditable>'+data.row_data[count].signUp_Date+'</td>';
                  html += '<td hidden class ="vA_Number" contenteditable>'+data.row_data[count].vA_Number+'</td>';
                  html += '<td hidden class ="account_Params" contenteditable>'+data.row_data[count].account_Params+'</td>';
                  html += '<td hidden class ="loanID" contenteditable>'+data.row_data[count].loanID+'</td>';
                  html += '<td hidden class ="lenderID" contenteditable>'+data.row_data[count].lenderID+'</td>';
                  html += '<td hidden class ="lender_Email" contenteditable>'+data.row_data[count].lender_Email+'</td>';
                  html += '<td hidden class ="product_Type" contenteditable>'+data.row_data[count].product_Type+'</td>';
                  html += '<td hidden class ="instituion" contenteditable>'+data.row_data[count].instituion+'</td>';
                  html += '<td hidden class ="program" contenteditable>'+data.row_data[count].program+'</td>';
                  html += '<td hidden class ="invoice_File" contenteditable>'+data.row_data[count].invoice_File+'</td>';
                  html += '<td hidden class ="loanAmount" contenteditable>'+data.row_data[count].loanAmount+'</td>';
                  html += '<td hidden class ="downPayment" contenteditable>'+data.row_data[count].downPayment+'</td>';
                  html += '<td hidden class ="disbursementAmount" contenteditable>'+data.row_data[count].disbursementAmount+'</td>';
                  html += '<td hidden class ="installment_Amount" contenteditable>'+data.row_data[count].installment_Amount+'</td>';
                  html += '<td hidden class ="tenor" contenteditable>'+data.row_data[count].tenor+'</td>';
                  html += '<td hidden class ="internalStatus" contenteditable>'+data.row_data[count].internalStatus+'</td>';
                  html += '<td hidden class ="bankName" contenteditable>'+data.row_data[count].bankName+'</td>';
                  html += '<td hidden class ="bankAccountNumber" contenteditable>'+data.row_data[count].bankAccountNumber+'</td>';
                  html += '<td hidden class ="bankAccountName" contenteditable>'+data.row_data[count].bankAccountName+'</td>';
                  html += '<td hidden class ="applied" contenteditable>'+data.row_data[count].applied+'</td>';
                  html += '<td hidden class ="approved" contenteditable>'+data.row_data[count].approved+'</td>';
                  html += '<td hidden class ="rejected" contenteditable>'+data.row_data[count].rejected+'</td>';
                  html += '<td hidden class ="paid_Off" contenteditable>'+data.row_data[count].paid_Off+'</td>';
                  html += '<td hidden class ="applied_Date" contenteditable>'+data.row_data[count].applied_Date+'</td>';
                  html += '<td hidden class ="approval_Date" contenteditable>'+data.row_data[count].approval_Date+'</td>';
                  html += '<td hidden class ="disbursed_Date" contenteditable>'+data.row_data[count].disbursed_Date+'</td>';
                  html += '<td hidden class ="aging_Apply_Date" contenteditable>'+data.row_data[count].aging_Apply_Date+'</td>';
                  html += '<td hidden class ="aging_Approval_Date" contenteditable>'+data.row_data[count].aging_Approval_Date+'</td>';
                  html += '<td hidden class ="first_DueDate" contenteditable>'+data.row_data[count].first_DueDate+'</td>';
                  html += '<td hidden class ="last_DueDate" contenteditable>'+data.row_data[count].last_DueDate+'</td>';
                  html += '<td hidden class ="isInsured" contenteditable>'+data.row_data[count].isInsured+'</td>';
                  html += '<td hidden class ="loan_Params" contenteditable>'+data.row_data[count].loan_Params+'</td>';
                  html += '<td hidden class ="myself_FullName" contenteditable>'+data.row_data[count].myself_FullName+'</td>';
                  html += '<td hidden class ="myself_DateOfBirth" contenteditable>'+data.row_data[count].myself_DateOfBirth+'</td>';
                  html += '<td hidden class ="myself_PlaceOfBirth" contenteditable>'+data.row_data[count].myself_PlaceOfBirth+'</td>';
                  html += '<td hidden class ="myself_Gender" contenteditable>'+data.row_data[count].myself_Gender+'</td>';
                  html += '<td hidden class ="myself_Education" contenteditable>'+data.row_data[count].myself_Education+'</td>';
                  html += '<td hidden class ="myself_MothersName" contenteditable>'+data.row_data[count].myself_MothersName+'</td>';
                  html += '<td hidden class ="myself_IDCardNumber" contenteditable>'+data.row_data[count].myself_IDCardNumber+'</td>';
                  html += '<td hidden class ="myself_ImageKTP" contenteditable>'+data.row_data[count].myself_ImageKTP+'</td>';
                  html += '<td hidden class ="myself_ImageSelfie" contenteditable>'+data.row_data[count].myself_ImageSelfie+'</td>';
                  html += '<td hidden class ="myself_MarriageStatus" contenteditable>'+data.row_data[count].myself_MarriageStatus+'</td>';
                  html += '<td hidden class ="spouse_FullName" contenteditable>'+data.row_data[count].spouse_FullName+'</td>';
                  html += '<td hidden class ="spouse_DateOfBirth" contenteditable>'+data.row_data[count].spouse_DateOfBirth+'</td>';
                  html += '<td hidden class ="spouse_PlaceOfBirth" contenteditable>'+data.row_data[count].spouse_PlaceOfBirth+'</td>';
                  html += '<td hidden class ="spouse_Gender" contenteditable>'+data.row_data[count].spouse_Gender+'</td>';
                  html += '<td hidden class ="spouse_Education" contenteditable>'+data.row_data[count].spouse_Education+'</td>';
                  html += '<td hidden class ="spouse_MothersName" contenteditable>'+data.row_data[count].spouse_MothersName+'</td>';
                  html += '<td hidden class ="spouse_IDCardNumber" contenteditable>'+data.row_data[count].spouse_IDCardNumber+'</td>';
                  html += '<td hidden class ="spouse_ImageKTP" contenteditable>'+data.row_data[count].spouse_ImageKTP+'</td>';
                  html += '<td hidden class ="spouse_ImageSelfie" contenteditable>'+data.row_data[count].spouse_ImageSelfie+'</td>';
                  html += '<td hidden class ="spouse_MarriageStatus" contenteditable>'+data.row_data[count].spouse_MarriageStatus+'</td>';
                  html += '<td hidden class ="id_ktp_Jalan" contenteditable>'+data.row_data[count].id_ktp_Jalan+'</td>';
                  html += '<td hidden class ="id_ktp_No" contenteditable>'+data.row_data[count].id_ktp_No+'</td>';
                  html += '<td hidden class ="id_ktp_RT" contenteditable>'+data.row_data[count].id_ktp_RT+'</td>';
                  html += '<td hidden class ="id_ktp_RW" contenteditable>'+data.row_data[count].id_ktp_RW+'</td>';
                  html += '<td hidden class ="id_ktp_Kelurahan" contenteditable>'+data.row_data[count].id_ktp_Kelurahan+'</td>';
                  html += '<td hidden class ="id_ktp_Kecamatan" contenteditable>'+data.row_data[count].id_ktp_Kecamatan+'</td>';
                  html += '<td hidden class ="id_ktp_Kota_Kabupaten" contenteditable>'+data.row_data[count].id_ktp_Kota_Kabupaten+'</td>';
                  html += '<td hidden class ="id_ktp_Provinsi" contenteditable>'+data.row_data[count].id_ktp_Provinsi+'</td>';
                  html += '<td hidden class ="id_ktp_KodePos" contenteditable>'+data.row_data[count].id_ktp_KodePos+'</td>';
                  html += '<td hidden class ="domisili_domicile_Jalan" contenteditable>'+data.row_data[count].domisili_domicile_Jalan+'</td>';
                  html += '<td hidden class ="domisili_domicile_No" contenteditable>'+data.row_data[count].domisili_domicile_No+'</td>';
                  html += '<td hidden class ="domisili_domicile_RT" contenteditable>'+data.row_data[count].domisili_domicile_RT+'</td>';
                  html += '<td hidden class ="domisili_domicile_RW" contenteditable>'+data.row_data[count].domisili_domicile_RW+'</td>';
                  html += '<td hidden class ="domisili_domicile_Kelurahan" contenteditable>'+data.row_data[count].domisili_domicile_Kelurahan+'</td>';
                  html += '<td hidden class ="domisili_domicile_Kecamatan" contenteditable>'+data.row_data[count].domisili_domicile_Kecamatan+'</td>';
                  html += '<td hidden class ="domisili_domicile_Kota_Kabupaten" contenteditable>'+data.row_data[count].domisili_domicile_Kota_Kabupaten+'</td>';
                  html += '<td hidden class ="domisili_domicile_Provinsi" contenteditable>'+data.row_data[count].domisili_domicile_Provinsi+'</td>';
                  html += '<td hidden class ="domisili_domicile_KodePos" contenteditable>'+data.row_data[count].domisili_domicile_KodePos+'</td>';
                  html += '<td hidden class ="domisili_domicile_ResidentialStatus" contenteditable>'+data.row_data[count].domisili_domicile_ResidentialStatus+'</td>';
                  html += '<td hidden class ="domisili_domicile_DurationOfStay" contenteditable>'+data.row_data[count].domisili_domicile_DurationOfStay+'</td>';
                  html += '<td hidden class ="occupationName" contenteditable>'+data.row_data[count].occupationName+'</td>';
                  html += '<td hidden class ="fields" contenteditable>'+data.row_data[count].fields+'</td>';
                  html += '<td hidden class ="position" contenteditable>'+data.row_data[count].position+'</td>';
                  html += '<td hidden class ="lengthofWork" contenteditable>'+data.row_data[count].lengthofWork+'</td>';
                  html += '<td hidden class ="income" contenteditable>'+data.row_data[count].income+'</td>';
                  html += '<td hidden class ="myself_ImageTax" contenteditable>'+data.row_data[count].myself_ImageTax+'</td>';
                  html += '<td hidden class ="paySlip_File" contenteditable>'+data.row_data[count].paySlip_File+'</td>';
                  html += '<td hidden class ="bankStatement_File" contenteditable>'+data.row_data[count].bankStatement_File+'</td>';
                  html += '<td hidden class ="referenceLetter_File" contenteditable>'+data.row_data[count].referenceLetter_File+'</td>';
                  html += '<td hidden class ="companyName" contenteditable>'+data.row_data[count].companyName+'</td>';
                  html += '<td hidden class ="pekerjaan_Jalan" contenteditable>'+data.row_data[count].pekerjaan_Jalan+'</td>';
                  html += '<td hidden class ="pekerjaan_Kelurahan" contenteditable>'+data.row_data[count].pekerjaan_Kelurahan+'</td>';
                  html += '<td hidden class ="pekerjaan_Kecamatan" contenteditable>'+data.row_data[count].pekerjaan_Kecamatan+'</td>';
                  html += '<td hidden class ="pekerjaan_Kota_Kabupaten" contenteditable>'+data.row_data[count].pekerjaan_Kota_Kabupaten+'</td>';
                  html += '<td hidden class ="pekerjaan_Provinsi" contenteditable>'+data.row_data[count].pekerjaan_Provinsi+'</td>';
                  html += '<td hidden class ="cP_Name" contenteditable>'+data.row_data[count].cP_Name+'</td>';
                  html += '<td hidden class ="cP_PhoneNumber" contenteditable>'+data.row_data[count].cP_PhoneNumber+'</td>';
                  html += '<td hidden class ="eC_Name" contenteditable>'+data.row_data[count].eC_Name+'</td>';
                  html += '<td hidden class ="eC_PhoneNUmber" contenteditable>'+data.row_data[count].eC_PhoneNUmber+'</td>';
                  html += '<td hidden class ="eC_Relation" contenteditable>'+data.row_data[count].eC_Relation+'</td>';
                html += '</tr>';                            
              }
            }

          }
          
          html += '<table>';
          html += '<div class="spinner" style="display: none; margin-bottom:20px;" align="center"><img id="img-spinner" src="../../../spiner.gif" style="width: 30px; height: 30px;" title="Process" ></div>';
          html += '<div align="center"><button type="button" id="import_data" class="btn btn-success"><i class="fa-solid fa-file-import mr-2"></i>Import</button></div><br><br>';

          $('#csv_file_data').html(html);
          $('#upload_csv')[0].reset();
        }
      })
    });

    $(document).on('click', '#import_data', function(){
      var join_ID = [];
      var borrowerID = [];
      var accountID = [];
      var email = [];
      var handphone = [];
      var email_VerfiedStatus = [];
      var hP_VerifiedStatus = [];
      var referralCode = [];
      var signUp_Date = [];
      var vA_Number = [];
      var account_Params = [];
      var loanID = [];
      var lenderID = [];
      var lender_Email = [];
      var product_Type = [];
      var instituion = [];
      var program = [];
      var invoice_File = [];
      var loanAmount = [];
      var downPayment = [];
      var disbursementAmount = [];
      var installment_Amount = [];
      var tenor = [];
      var internalStatus = [];
      var bankName = [];
      var bankAccountNumber = [];
      var bankAccountName = [];
      var applied = [];
      var approved = [];
      var rejected = [];
      var paid_Off = [];
      var applied_Date = [];
      var approval_Date = [];
      var disbursed_Date = [];
      var aging_Apply_Date = [];
      var aging_Approval_Date = [];
      var first_DueDate = [];
      var last_DueDate = [];
      var isInsured = [];
      var loan_Params = [];
      var myself_FullName = [];
      var myself_DateOfBirth = [];
      var myself_PlaceOfBirth = [];
      var myself_Gender = [];
      var myself_Education = [];
      var myself_MothersName = [];
      var myself_IDCardNumber = [];
      var myself_ImageKTP = [];
      var myself_ImageSelfie = [];
      var myself_MarriageStatus = [];
      var spouse_FullName = [];
      var spouse_DateOfBirth = [];
      var spouse_PlaceOfBirth = [];
      var spouse_Gender = [];
      var spouse_Education = [];
      var spouse_MothersName = [];
      var spouse_IDCardNumber = [];
      var spouse_ImageKTP = [];
      var spouse_ImageSelfie = [];
      var spouse_MarriageStatus = [];
      var id_ktp_Jalan = [];
      var id_ktp_No = [];
      var id_ktp_RT = [];
      var id_ktp_RW = [];
      var id_ktp_Kelurahan = [];
      var id_ktp_Kecamatan = [];
      var id_ktp_Kota_Kabupaten = [];
      var id_ktp_Provinsi = [];
      var id_ktp_KodePos = [];
      var domisili_domicile_Jalan = [];
      var domisili_domicile_No = [];
      var domisili_domicile_RT = [];
      var domisili_domicile_RW = [];
      var domisili_domicile_Kelurahan = [];
      var domisili_domicile_Kecamatan = [];
      var domisili_domicile_Kota_Kabupaten = [];
      var domisili_domicile_Provinsi = [];
      var domisili_domicile_KodePos = [];
      var domisili_domicile_ResidentialStatus = [];
      var domisili_domicile_DurationOfStay = [];
      var occupationName = [];
      var fields = [];
      var position = [];
      var lengthofWork = [];
      var income = [];
      var myself_ImageTax = [];
      var paySlip_File = [];
      var bankStatement_File = [];
      var referenceLetter_File = [];
      var companyName = [];
      var pekerjaan_Jalan = [];
      var pekerjaan_Kelurahan = [];
      var pekerjaan_Kecamatan = [];
      var pekerjaan_Kota_Kabupaten = [];
      var pekerjaan_Provinsi = [];
      var cP_Name = [];
      var cP_PhoneNumber = [];
      var eC_Name = [];
      var eC_PhoneNUmber = [];
      var eC_Relation = [];
      
      $('.join_ID').each(function(){join_ID.push($(this).text());});
      $('.borrowerID').each(function(){borrowerID.push($(this).text());});
      $('.accountID').each(function(){accountID.push($(this).text());});
      $('.email').each(function(){email.push($(this).text());});
      $('.handphone').each(function(){handphone.push($(this).text());});
      $('.email_VerfiedStatus').each(function(){email_VerfiedStatus.push($(this).text());});
      $('.hP_VerifiedStatus').each(function(){hP_VerifiedStatus.push($(this).text());});
      $('.referralCode').each(function(){referralCode.push($(this).text());});
      $('.signUp_Date').each(function(){signUp_Date.push($(this).text());});
      $('.vA_Number').each(function(){vA_Number.push($(this).text());});
      $('.account_Params').each(function(){account_Params.push($(this).text());});
      $('.loanID').each(function(){loanID.push($(this).text());});
      $('.lenderID').each(function(){lenderID.push($(this).text());});
      $('.lender_Email').each(function(){lender_Email.push($(this).text());});
      $('.product_Type').each(function(){product_Type.push($(this).text());});
      $('.instituion').each(function(){instituion.push($(this).text());});
      $('.program').each(function(){program.push($(this).text());});
      $('.invoice_File').each(function(){invoice_File.push($(this).text());});
      $('.loanAmount').each(function(){loanAmount.push($(this).text());});
      $('.downPayment').each(function(){downPayment.push($(this).text());});
      $('.disbursementAmount').each(function(){disbursementAmount.push($(this).text());});
      $('.installment_Amount').each(function(){installment_Amount.push($(this).text());});
      $('.tenor').each(function(){tenor.push($(this).text());});
      $('.internalStatus').each(function(){internalStatus.push($(this).text());});
      $('.bankName').each(function(){bankName.push($(this).text());});
      $('.bankAccountNumber').each(function(){bankAccountNumber.push($(this).text());});
      $('.bankAccountName').each(function(){bankAccountName.push($(this).text());});
      $('.applied').each(function(){applied.push($(this).text());});
      $('.approved').each(function(){approved.push($(this).text());});
      $('.rejected').each(function(){rejected.push($(this).text());});
      $('.paid_Off').each(function(){paid_Off.push($(this).text());});
      $('.applied_Date').each(function(){applied_Date.push($(this).text());});
      $('.approval_Date').each(function(){approval_Date.push($(this).text());});
      $('.disbursed_Date').each(function(){disbursed_Date.push($(this).text());});
      $('.aging_Apply_Date').each(function(){aging_Apply_Date.push($(this).text());});
      $('.aging_Approval_Date').each(function(){aging_Approval_Date.push($(this).text());});
      $('.first_DueDate').each(function(){first_DueDate.push($(this).text());});
      $('.last_DueDate').each(function(){last_DueDate.push($(this).text());});
      $('.isInsured').each(function(){isInsured.push($(this).text());});
      $('.loan_Params').each(function(){loan_Params.push($(this).text());});
      $('.myself_FullName').each(function(){myself_FullName.push($(this).text());});
      $('.myself_DateOfBirth').each(function(){myself_DateOfBirth.push($(this).text());});
      $('.myself_PlaceOfBirth').each(function(){myself_PlaceOfBirth.push($(this).text());});
      $('.myself_Gender').each(function(){myself_Gender.push($(this).text());});
      $('.myself_Education').each(function(){myself_Education.push($(this).text());});
      $('.myself_MothersName').each(function(){myself_MothersName.push($(this).text());});
      $('.myself_IDCardNumber').each(function(){myself_IDCardNumber.push($(this).text());});
      $('.myself_ImageKTP').each(function(){myself_ImageKTP.push($(this).text());});
      $('.myself_ImageSelfie').each(function(){myself_ImageSelfie.push($(this).text());});
      $('.myself_MarriageStatus').each(function(){myself_MarriageStatus.push($(this).text());});
      $('.spouse_FullName').each(function(){spouse_FullName.push($(this).text());});
      $('.spouse_DateOfBirth').each(function(){spouse_DateOfBirth.push($(this).text());});
      $('.spouse_PlaceOfBirth').each(function(){spouse_PlaceOfBirth.push($(this).text());});
      $('.spouse_Gender').each(function(){spouse_Gender.push($(this).text());});
      $('.spouse_Education').each(function(){spouse_Education.push($(this).text());});
      $('.spouse_MothersName').each(function(){spouse_MothersName.push($(this).text());});
      $('.spouse_IDCardNumber').each(function(){spouse_IDCardNumber.push($(this).text());});
      $('.spouse_ImageKTP').each(function(){spouse_ImageKTP.push($(this).text());});
      $('.spouse_ImageSelfie').each(function(){spouse_ImageSelfie.push($(this).text());});
      $('.spouse_MarriageStatus').each(function(){spouse_MarriageStatus.push($(this).text());});
      $('.id_ktp_Jalan').each(function(){id_ktp_Jalan.push($(this).text());});
      $('.id_ktp_No').each(function(){id_ktp_No.push($(this).text());});
      $('.id_ktp_RT').each(function(){id_ktp_RT.push($(this).text());});
      $('.id_ktp_RW').each(function(){id_ktp_RW.push($(this).text());});
      $('.id_ktp_Kelurahan').each(function(){id_ktp_Kelurahan.push($(this).text());});
      $('.id_ktp_Kecamatan').each(function(){id_ktp_Kecamatan.push($(this).text());});
      $('.id_ktp_Kota_Kabupaten').each(function(){id_ktp_Kota_Kabupaten.push($(this).text());});
      $('.id_ktp_Provinsi').each(function(){id_ktp_Provinsi.push($(this).text());});
      $('.id_ktp_KodePos').each(function(){id_ktp_KodePos.push($(this).text());});
      $('.domisili_domicile_Jalan').each(function(){domisili_domicile_Jalan.push($(this).text());});
      $('.domisili_domicile_No').each(function(){domisili_domicile_No.push($(this).text());});
      $('.domisili_domicile_RT').each(function(){domisili_domicile_RT.push($(this).text());});
      $('.domisili_domicile_RW').each(function(){domisili_domicile_RW.push($(this).text());});
      $('.domisili_domicile_Kelurahan').each(function(){domisili_domicile_Kelurahan.push($(this).text());});
      $('.domisili_domicile_Kecamatan').each(function(){domisili_domicile_Kecamatan.push($(this).text());});
      $('.domisili_domicile_Kota_Kabupaten').each(function(){domisili_domicile_Kota_Kabupaten.push($(this).text());});
      $('.domisili_domicile_Provinsi').each(function(){domisili_domicile_Provinsi.push($(this).text());});
      $('.domisili_domicile_KodePos').each(function(){domisili_domicile_KodePos.push($(this).text());});
      $('.domisili_domicile_ResidentialStatus').each(function(){domisili_domicile_ResidentialStatus.push($(this).text());});
      $('.domisili_domicile_DurationOfStay').each(function(){domisili_domicile_DurationOfStay.push($(this).text());});
      $('.occupationName').each(function(){occupationName.push($(this).text());});
      $('.fields').each(function(){fields.push($(this).text());});
      $('.position').each(function(){position.push($(this).text());});
      $('.lengthofWork').each(function(){lengthofWork.push($(this).text());});
      $('.income').each(function(){income.push($(this).text());});
      $('.myself_ImageTax').each(function(){myself_ImageTax.push($(this).text());});
      $('.paySlip_File').each(function(){paySlip_File.push($(this).text());});
      $('.bankStatement_File').each(function(){bankStatement_File.push($(this).text());});
      $('.referenceLetter_File').each(function(){referenceLetter_File.push($(this).text());});
      $('.companyName').each(function(){companyName.push($(this).text());});
      $('.pekerjaan_Jalan').each(function(){pekerjaan_Jalan.push($(this).text());});
      $('.pekerjaan_Kelurahan').each(function(){pekerjaan_Kelurahan.push($(this).text());});
      $('.pekerjaan_Kecamatan').each(function(){pekerjaan_Kecamatan.push($(this).text());});
      $('.pekerjaan_Kota_Kabupaten').each(function(){pekerjaan_Kota_Kabupaten.push($(this).text());});
      $('.pekerjaan_Provinsi').each(function(){pekerjaan_Provinsi.push($(this).text());});
      $('.cP_Name').each(function(){cP_Name.push($(this).text());});
      $('.cP_PhoneNumber').each(function(){cP_PhoneNumber.push($(this).text());});
      $('.eC_Name').each(function(){eC_Name.push($(this).text());});
      $('.eC_PhoneNUmber').each(function(){eC_PhoneNUmber.push($(this).text());});
      $('.eC_Relation').each(function(){eC_Relation.push($(this).text());});
      $.ajax({
        beforeSend:function(){$(".spinner").css("display","block");},
        url:"import.php",
        method:"post",
        data:{
          join_ID:join_ID,
          borrowerID:borrowerID,
          accountID:accountID,
          email:email,
          handphone:handphone,
          email_VerfiedStatus:email_VerfiedStatus,
          hP_VerifiedStatus:hP_VerifiedStatus,
          referralCode:referralCode,
          signUp_Date:signUp_Date,
          vA_Number:vA_Number,
          account_Params:account_Params,
          loanID:loanID,
          lenderID:lenderID,
          lender_Email:lender_Email,
          product_Type:product_Type,
          instituion:instituion,
          program:program,
          invoice_File:invoice_File,
          loanAmount:loanAmount,
          downPayment:downPayment,
          disbursementAmount:disbursementAmount,
          installment_Amount:installment_Amount,
          tenor:tenor,
          internalStatus:internalStatus,
          bankName:bankName,
          bankAccountNumber:bankAccountNumber,
          bankAccountName:bankAccountName,
          applied:applied,
          approved:approved,
          rejected:rejected,
          paid_Off:paid_Off,
          applied_Date:applied_Date,
          approval_Date:approval_Date,
          disbursed_Date:disbursed_Date,
          aging_Apply_Date:aging_Apply_Date,
          aging_Approval_Date:aging_Approval_Date,
          first_DueDate:first_DueDate,
          last_DueDate:last_DueDate,
          isInsured:isInsured,
          loan_Params:loan_Params,
          myself_FullName:myself_FullName,
          myself_DateOfBirth:myself_DateOfBirth,
          myself_PlaceOfBirth:myself_PlaceOfBirth,
          myself_Gender:myself_Gender,
          myself_Education:myself_Education,
          myself_MothersName:myself_MothersName,
          myself_IDCardNumber:myself_IDCardNumber,
          myself_ImageKTP:myself_ImageKTP,
          myself_ImageSelfie:myself_ImageSelfie,
          myself_MarriageStatus:myself_MarriageStatus,
          spouse_FullName:spouse_FullName,
          spouse_DateOfBirth:spouse_DateOfBirth,
          spouse_PlaceOfBirth:spouse_PlaceOfBirth,
          spouse_Gender:spouse_Gender,
          spouse_Education:spouse_Education,
          spouse_MothersName:spouse_MothersName,
          spouse_IDCardNumber:spouse_IDCardNumber,
          spouse_ImageKTP:spouse_ImageKTP,
          spouse_ImageSelfie:spouse_ImageSelfie,
          spouse_MarriageStatus:spouse_MarriageStatus,
          id_ktp_Jalan:id_ktp_Jalan,
          id_ktp_No:id_ktp_No,
          id_ktp_RT:id_ktp_RT,
          id_ktp_RW:id_ktp_RW,
          id_ktp_Kelurahan:id_ktp_Kelurahan,
          id_ktp_Kecamatan:id_ktp_Kecamatan,
          id_ktp_Kota_Kabupaten:id_ktp_Kota_Kabupaten,
          id_ktp_Provinsi:id_ktp_Provinsi,
          id_ktp_KodePos:id_ktp_KodePos,
          domisili_domicile_Jalan:domisili_domicile_Jalan,
          domisili_domicile_No:domisili_domicile_No,
          domisili_domicile_RT:domisili_domicile_RT,
          domisili_domicile_RW:domisili_domicile_RW,
          domisili_domicile_Kelurahan:domisili_domicile_Kelurahan,
          domisili_domicile_Kecamatan:domisili_domicile_Kecamatan,
          domisili_domicile_Kota_Kabupaten:domisili_domicile_Kota_Kabupaten,
          domisili_domicile_Provinsi:domisili_domicile_Provinsi,
          domisili_domicile_KodePos:domisili_domicile_KodePos,
          domisili_domicile_ResidentialStatus:domisili_domicile_ResidentialStatus,
          domisili_domicile_DurationOfStay:domisili_domicile_DurationOfStay,
          occupationName:occupationName,
          fields:fields,
          position:position,
          lengthofWork:lengthofWork,
          income:income,
          myself_ImageTax:myself_ImageTax,
          paySlip_File:paySlip_File,
          bankStatement_File:bankStatement_File,
          referenceLetter_File:referenceLetter_File,
          companyName:companyName,
          pekerjaan_Jalan:pekerjaan_Jalan,
          pekerjaan_Kelurahan:pekerjaan_Kelurahan,
          pekerjaan_Kecamatan:pekerjaan_Kecamatan,
          pekerjaan_Kota_Kabupaten:pekerjaan_Kota_Kabupaten,
          pekerjaan_Provinsi:pekerjaan_Provinsi,
          cP_Name:cP_Name,
          cP_PhoneNumber:cP_PhoneNumber,
          eC_Name:eC_Name,
          eC_PhoneNUmber:eC_PhoneNUmber,
          eC_Relation:eC_Relation

        },
        success:function(data){
            $('#csv_file_data').html('<div class="alert alert-success">Data Berhasil Diimport. <br>Untuk kembali ke dashboard <a href="../../../">Klik Disini</a></div>');
        }
      })
    });
  });
</script>
</body>
</html>
