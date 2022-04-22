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
            //for(var count = 0; count < data.column.length; count++){
              html += '<th>'+data.column[10]+'</th>'; //id_debitur
              html += '<th>'+data.column[44]+'</th>'; //nik
              html += '<th>'+data.column[39]+'</th>'; //nama_debitur
              html += '<th>'+data.column[30]+'</th>'; //apply_date
              html += '<th>'+data.column[13]+'</th>'; //product
              html += '<th>'+data.column[17]+'</th>'; //total_pembiayaan

              html += '<th hidden>'+data.column[40]+'</th>'; //tempat_lahir
              html += '<th hidden>'+data.column[41]+'</th>'; //jenis_kelamin
              html += '<th hidden>'+data.column[47]+'</th>'; //status_perkawinan
              html += '<th hidden>'+data.column[42]+'</th>'; //pendidikan_terakhir
              html += '<th hidden>'+data.column[3]+'</th>';  //no_telepon
              html += '<th hidden>'+data.column[2]+'</th>';  //email

              html += '<th hidden>'+data.column[48]+'</th>'; //nama_pasangan
              html += '<th hidden>'+data.column[49]+'</th>'; //tempat_lahir_pasangan
              html += '<th hidden>'+data.column[50]+'</th>'; //jenis_kelamin_pasangan
              html += '<th hidden>'+data.column[56]+'</th>'; //status_perkawinan_pasangan
              html += '<th hidden>'+data.column[51]+'</th>'; //pendidikan_terakhir_pasangan
              html += '<th hidden>'+data.column[53]+'</th>'; //nik_pasangan

              html += '<th hidden>'+data.column[66]+'</th>'; //domisili
              html += '<th hidden>'+data.column[67]+'</th>'; //domisili_no
              html += '<th hidden>'+data.column[68]+'</th>'; //domisili_rt
              html += '<th hidden>'+data.column[69]+'</th>'; //domisili_rw
              html += '<th hidden>'+data.column[70]+'</th>'; //domisili_kelurahan
              html += '<th hidden>'+data.column[71]+'</th>'; //domisili_kecamatan
              html += '<th hidden>'+data.column[72]+'</th>'; //domisili_kota
              html += '<th hidden>'+data.column[73]+'</th>'; //domisili_provinsi
              html += '<th hidden>'+data.column[74]+'</th>'; //domisili_zipcode
              html += '<th hidden>'+data.column[75]+'</th>'; //status_tempat_tinggal
              html += '<th hidden>'+data.column[76]+'</th>'; //lama_menempati_hari

              html += '<th hidden>'+data.column[77]+'</th>'; //pekerjaan
              html += '<th hidden>'+data.column[78]+'</th>'; //bidang
              html += '<th hidden>'+data.column[79]+'</th>'; //jabatan
              html += '<th hidden>'+data.column[80]+'</th>'; //lama_bekerja_hari
              html += '<th hidden>'+data.column[81]+'</th>'; //penghasilan
              html += '<th hidden>'+data.column[86]+'</th>'; //nama_kantor
              html += '<th hidden>'+data.column[87]+'</th>'; //alamat_kantor
              html += '<th hidden>'+data.column[88]+'</th>'; //alamat_kantor_kelurahan
              html += '<th hidden>'+data.column[89]+'</th>'; //alamat_kantor_kecamatan
              html += '<th hidden>'+data.column[90]+'</th>'; //alamat_kantor_kota
              html += '<th hidden>'+data.column[91]+'</th>'; //alamat_kantor_provinsi
              html += '<th hidden>'+data.column[93]+'</th>'; //telepon_kantor

              html += '<th hidden>'+data.column[94]+'</th>'; //nama_kontak_darurat
              html += '<th hidden>'+data.column[95]+'</th>'; //telepon_kontak_darurat
              html += '<th hidden>'+data.column[96]+'</th>'; //hubungan_kontak_darurat

              html += '<th hidden>'+data.column[21]+'</th>'; //tenor
              html += '<th hidden>'+data.column[18]+'</th>'; //uang_muka
              html += '<th hidden>'+data.column[20]+'</th>'; //cicilan_per_bulan
              html += '<th hidden>'+data.column[19]+'</th>'; //total_pencairan
              html += '<th hidden>'+data.column[23]+'</th>'; //bank_tujuan
              html += '<th hidden>'+data.column[24]+'</th>'; //nomor_rekening
              html += '<th hidden>'+data.column[25]+'</th>'; //nama_rekening
              
              html += '<th hidden>'+data.column[14]+'</th>'; //nama_penyelenggara
              html += '<th hidden>'+data.column[15]+'</th>'; //nama_program
              html += '<th hidden>'+data.column[60]+'</th>'; //alamat_penyelenggara
              html += '<th hidden>'+data.column[61]+'</th>'; //telepon_penyelenggara


              html += '<th hidden>'+data.column[35]+'</th>'; //tanggal_pembayaran_awal
              html += '<th hidden>'+data.column[36]+'</th>'; //tanggal_pembayaran_akhir


              html += '<th hidden>'+data.column[45]+'</th>'; //lampiran_ktp
              html += '<th hidden>'+data.column[46]+'</th>'; //lampiran_selfie
              html += '<th hidden>'+data.column[82]+'</th>'; //lampiran_npwp
              html += '<th hidden>'+data.column[65]+'</th>'; //lampiran_gaji

              html += '<th hidden>'+data.column[54]+'</th>'; //lampiran_ktp_pasangan
              html += '<th hidden>'+data.column[55]+'</th>'; //lampiran_selfie_pasangan
            //}
            html += '</tr>';

            if(data.row_data){
              for(var count = 0; count < data.row_data.length; count++){
                html += '<tr>';
                html += '<td class="id_debitur" contenteditable>'+data.row_data[count].id_debitur+'</td>';
                html += '<td class="nik" contenteditable>'+data.row_data[count].nik+'</td>';
                html += '<td class="nama_debitur" contenteditable>'+data.row_data[count].nama_debitur+'</td>';
                html += '<td class="apply_date" contenteditable>'+data.row_data[count].apply_date+'</td>';
                html += '<td class="product" contenteditable>'+data.row_data[count].product+'</td>';
                html += '<td class="total_pembiayaan" align="right" contenteditable>'+data.row_data[count].total_pembiayaan+'</td>';               
                html += '<td hidden class="tempat_lahir" contenteditable>'+data.row_data[count].tempat_lahir+'</td>';
                //html += '<td hidden class="jenis_kelamin" contenteditable>'+data.row_data[count].jenis_kelamin+'</td>';
                html += '<td hidden class="status_perkawinan" contenteditable>'+data.row_data[count].status_perkawinan+'</td>';
                html += '<td hidden class="pendidikan_terakhir" contenteditable>'+data.row_data[count].pendidikan_terakhir+'</td>';
                html += '<td hidden class="no_telepon" contenteditable>'+data.row_data[count].no_telepon+'</td>';
                html += '<td hidden class="email" contenteditable>'+data.row_data[count].email+'</td>';

                //html += '<td hidden class="nama_pasangan" contenteditable>'+data.row_data[count].nama_pasangan+'</td>';
                html += '<td hidden class="tempat_lahir_pasangan" contenteditable>'+data.row_data[count].tempat_lahir_pasangan+'</td>';
                html += '<td hidden class="jenis_kelamin_pasangan" contenteditable>'+data.row_data[count].jenis_kelamin_pasangan+'</td>';
                html += '<td hidden class="status_perkawinan_pasangan" contenteditable>'+data.row_data[count].status_perkawinan_pasangan+'</td>';
                html += '<td hidden class="pendidikan_terakhir_pasangan" contenteditable>'+data.row_data[count].pendidikan_terakhir_pasangan+'</td>';
                html += '<td hidden class="nik_pasangan" contenteditable>'+data.row_data[count].nik_pasangan+'</td>';

                html += '<td hidden class="domisili" contenteditable>'+data.row_data[count].domisili+'</td>';
                html += '<td hidden class="domisili_no" contenteditable>'+data.row_data[count].domisili_no+'</td>';
                html += '<td hidden class="domisili_rt" contenteditable>'+data.row_data[count].domisili_rt+'</td>';
                html += '<td hidden class="domisili_rw" contenteditable>'+data.row_data[count].domisili_rw+'</td>';
                html += '<td hidden class="domisili_kelurahan" contenteditable>'+data.row_data[count].domisili_kelurahan+'</td>';
                html += '<td hidden class="domisili_kecamatan" contenteditable>'+data.row_data[count].domisili_kecamatan+'</td>';
                html += '<td hidden class="domisili_kota" contenteditable>'+data.row_data[count].domisili_kota+'</td>';
                html += '<td hidden class="domisili_provinsi" contenteditable>'+data.row_data[count].domisili_provinsi+'</td>';
                html += '<td hidden class="domisili_zipcode" contenteditable>'+data.row_data[count].domisili_zipcode+'</td>';
                html += '<td hidden class="status_tempat_tinggal" contenteditable>'+data.row_data[count].status_tempat_tinggal+'</td>';
                html += '<td hidden class="lama_menempati_hari" contenteditable>'+data.row_data[count].lama_menempati_hari+'</td>';

                html += '<td hidden class="pekerjaan" contenteditable>'+data.row_data[count].pekerjaan+'</td>';
                html += '<td hidden class="bidang" contenteditable>'+data.row_data[count].bidang+'</td>';
                html += '<td hidden class="jabatan" contenteditable>'+data.row_data[count].jabatan+'</td>';
                html += '<td hidden class="lama_bekerja_hari" contenteditable>'+data.row_data[count].lama_bekerja_hari+'</td>';
                html += '<td hidden class="penghasilan" contenteditable>'+data.row_data[count].penghasilan+'</td>';
                html += '<td hidden class="nama_kantor" contenteditable>'+data.row_data[count].nama_kantor+'</td>';
                html += '<td hidden class="alamat_kantor" contenteditable>'+data.row_data[count].alamat_kantor+'</td>';
                html += '<td hidden class="alamat_kantor_kelurahan" contenteditable>'+data.row_data[count].alamat_kantor_kelurahan+'</td>';
                html += '<td hidden class="alamat_kantor_kecamatan" contenteditable>'+data.row_data[count].alamat_kantor_kecamatan+'</td>';
                html += '<td hidden class="alamat_kantor_kota" contenteditable>'+data.row_data[count].alamat_kantor_kota+'</td>';
                html += '<td hidden class="alamat_kantor_provinsi" contenteditable>'+data.row_data[count].alamat_kantor_provinsi+'</td>';
                html += '<td hidden class="telepon_kantor" contenteditable>'+data.row_data[count].telepon_kantor+'</td>';

                html += '<td hidden class="nama_kontak_darurat" contenteditable>'+data.row_data[count].nama_kontak_darurat+'</td>';
                html += '<td hidden class="telepon_kontak_darurat" contenteditable>'+data.row_data[count].telepon_kontak_darurat+'</td>';
                html += '<td hidden class="hubungan_kontak_darurat" contenteditable>'+data.row_data[count].hubungan_kontak_darurat+'</td>';

                html += '<td hidden class="tenor" contenteditable>'+data.row_data[count].tenor+'</td>';
                html += '<td hidden class="uang_muka" contenteditable>'+data.row_data[count].uang_muka+'</td>';
                html += '<td hidden class="cicilan_per_bulan" contenteditable>'+data.row_data[count].cicilan_per_bulan+'</td>';
                html += '<td hidden class="total_pencairan" contenteditable>'+data.row_data[count].total_pencairan+'</td>';
                html += '<td hidden class="bank_tujuan" contenteditable>'+data.row_data[count].bank_tujuan+'</td>';
                html += '<td hidden class="nomor_rekening" contenteditable>'+data.row_data[count].nomor_rekening+'</td>';
                html += '<td hidden class="nama_rekening" contenteditable>'+data.row_data[count].nama_rekening+'</td>';

                html += '<td hidden class="nama_penyelenggara" contenteditable>'+data.row_data[count].nama_penyelenggara+'</td>';
                html += '<td hidden class="nama_program" contenteditable>'+data.row_data[count].nama_program+'</td>';
                html += '<td hidden class="alamat_penyelenggara" contenteditable>'+data.row_data[count].alamat_penyelenggara+'</td>';
                html += '<td hidden class="telepon_penyelenggara" contenteditable>'+data.row_data[count].telepon_penyelenggara+'</td>';

                html += '<td hidden class="tanggal_pembayaran_awal" contenteditable>'+data.row_data[count].tanggal_pembayaran_awal+'</td>';
                html += '<td hidden class="tanggal_pembayaran_akhir" contenteditable>'+data.row_data[count].tanggal_pembayaran_akhir+'</td>';

                html += '<td hidden class="lampiran_ktp" contenteditable>'+data.row_data[count].lampiran_ktp+'</td>';
                html += '<td hidden class="lampiran_selfie" contenteditable>'+data.row_data[count].lampiran_selfie+'</td>';
                html += '<td hidden class="lampiran_npwp" contenteditable>'+data.row_data[count].lampiran_npwp+'</td>';
                html += '<td hidden class="lampiran_gaji" contenteditable>'+data.row_data[count].lampiran_gaji+'</td>';

                html += '<td hidden class="lampiran_ktp_pasangan" contenteditable>'+data.row_data[count].lampiran_ktp_pasangan+'</td>';
                html += '<td hidden class="lampiran_selfie_pasangan" contenteditable>'+data.row_data[count].lampiran_selfie_pasangan+'</td>';

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
      //jml4
      var id_debitur = [];
      var nik = [];
      var nama_debitur = [];
      var apply_date = [];
      var product = [];
      var total_pembiayaan  = [];

      //Data Personal jml7
      var tempat_lahir = [];      
      var jenis_kelamin = [];
      var status_perkawinan = [];      
      var pendidikan_terakhir = [];
      
      var no_telepon = [];
      var email = [];

      //Data Pasangan jml6
      var nama_pasangan = [];
      var tempat_lahir_pasangan = [];
      var jenis_kelamin_pasangan = [];
      var status_perkawinan_pasangan = [];
      var pendidikan_terakhir_pasangan = [];
      var nik_pasangan = [];

      //Data Alamat jml11
      var domisili              = [];
      var domisili_no           = [];
      var domisili_rt           = [];
      var domisili_rw           = [];
      var domisili_kelurahan    = [];
      var domisili_kecamatan    = [];
      var domisili_kota         = [];
      var domisili_provinsi     = [];
      var domisili_zipcode      = [];
      var status_tempat_tinggal = [];
      var lama_menempati_hari   = [];  

      //Data Pekerjaan jml12
      var pekerjaan         = [];
      var bidang            = [];
      var jabatan           = [];
      var lama_bekerja_hari = [];
      var penghasilan       = [];

      var nama_kantor             = [];
      var alamat_kantor           = [];
      var alamat_kantor_kelurahan = [];
      var alamat_kantor_kecamatan = [];
      var alamat_kantor_kota      = [];
      var alamat_kantor_provinsi  = [];
      var telepon_kantor          = [];

      //Data Kontak Darurat jml3
      var nama_kontak_darurat     = [];
      var telepon_kontak_darurat  = [];
      var hubungan_kontak_darurat = [];  

      //Data Pengajuan jml14
      var tenor             = [];
      var uang_muka         = [];
      var cicilan_per_bulan = [];
      var total_pencairan   = [];

      var bank_tujuan = [];
      var nama_rekening = [];
      var nomor_rekening = [];

      var nama_penyelenggara        = [];
      var nama_program              = [];
      var alamat_penyelenggara      = [];
      var telepon_penyelenggara     = [];
      var tanggal_pembayaran_awal   = [];
      var tanggal_pembayaran_akhir  = [];
      
      //Data Lampiran jml6
      var lampiran_ktp    = [];
      var lampiran_selfie = [];
      var lampiran_npwp   = [];
      var lampiran_gaji   = [];

      var lampiran_ktp_pasangan     = [];
      var lampiran_selfie_pasangan  = [];
      
      $('.id_debitur').each(function(){id_debitur.push($(this).text());});
      $('.nik').each(function(){nik.push($(this).text());});
      $('.nama_debitur').each(function(){nama_debitur.push($(this).text());});
      $('.apply_date').each(function(){apply_date.push($(this).text());});
      $('.product').each(function(){product.push($(this).text());});
      $('.total_pembiayaan').each(function(){total_pembiayaan.push($(this).text());});


      //Data Personal
      $('.tempat_lahir').each(function(){tempat_lahir.push($(this).text());});
      $('.jenis_kelamin').each(function(){jenis_kelamin.push($(this).text());});
      $('.status_perkawinan').each(function(){status_perkawinan.push($(this).text());});
      $('.pendidikan_terakhir').each(function(){pendidikan_terakhir.push($(this).text());});      
      $('.no_telepon').each(function(){no_telepon.push($(this).text());});
      $('.email').each(function(){email.push($(this).text());});

      //Data Pasangan
      $('.nama_pasangan').each(function(){nama_pasangan.push($(this).text());});
      $('.tempat_lahir_pasangan').each(function(){tempat_lahir_pasangan.push($(this).text());});
      $('.jenis_kelamin_pasangan').each(function(){jenis_kelamin_pasangan.push($(this).text());});
      $('.status_perkawinan_pasangan').each(function(){status_perkawinan_pasangan.push($(this).text());});
      $('.pendidikan_terakhir_pasangan').each(function(){pendidikan_terakhir_pasangan.push($(this).text());});
      $('.nik_pasangan').each(function(){nik_pasangan.push($(this).text());});

      //Data Alamat
      $('.domisili').each(function(){domisili.push($(this).text());});
      $('.domisili_no').each(function(){domisili_no.push($(this).text());});
      $('.domisili_rt').each(function(){domisili_rt.push($(this).text());});
      $('.domisili_rw').each(function(){domisili_rw.push($(this).text());});
      $('.domisili_kelurahan').each(function(){domisili_kelurahan.push($(this).text());});
      $('.domisili_kecamatan').each(function(){domisili_kecamatan.push($(this).text());});
      $('.domisili_kota').each(function(){domisili_kota.push($(this).text());});
      $('.domisili_provinsi').each(function(){domisili_provinsi.push($(this).text());});
      $('.domisili_zipcode').each(function(){domisili_zipcode.push($(this).text());});
      $('.status_tempat_tinggal').each(function(){status_tempat_tinggal.push($(this).text());});
      $('.lama_menempati_hari').each(function(){lama_menempati_hari.push($(this).text());});

      //Data Pekerjaan
      $('.pekerjaan').each(function(){pekerjaan.push($(this).text());});
      $('.bidang').each(function(){bidang.push($(this).text());});
      $('.jabatan').each(function(){jabatan.push($(this).text());});
      $('.lama_bekerja_hari').each(function(){lama_bekerja_hari.push($(this).text());});
      $('.penghasilan').each(function(){penghasilan.push($(this).text());});
      $('.nama_kantor').each(function(){nama_kantor.push($(this).text());});
      $('.alamat_kantor').each(function(){alamat_kantor.push($(this).text());});
      $('.alamat_kantor_kelurahan').each(function(){alamat_kantor_kelurahan.push($(this).text());});
      $('.alamat_kantor_kecamatan').each(function(){alamat_kantor_kecamatan.push($(this).text());});
      $('.alamat_kantor_kota').each(function(){alamat_kantor_kota.push($(this).text());});
      $('.alamat_kantor_provinsi').each(function(){alamat_kantor_provinsi.push($(this).text());});
      $('.telepon_kantor').each(function(){telepon_kantor.push($(this).text());});

      //Data Kontak
      $('.nama_kontak_darurat').each(function(){nama_kontak_darurat.push($(this).text());});
      $('.telepon_kontak_darurat').each(function(){telepon_kontak_darurat.push($(this).text());});
      $('.hubungan_kontak_darurat').each(function(){hubungan_kontak_darurat.push($(this).text());});

      //Data Pengajuan      
      $('.tenor').each(function(){tenor.push($(this).text());});
      $('.uang_muka').each(function(){uang_muka.push($(this).text());});
      $('.cicilan_per_bulan').each(function(){cicilan_per_bulan.push($(this).text());});
      $('.total_pencairan').each(function(){total_pencairan.push($(this).text());});
      $('.bank_tujuan').each(function(){bank_tujuan.push($(this).text());});
      $('.nama_rekening').each(function(){nama_rekening.push($(this).text());});
      $('.nomor_rekening').each(function(){nomor_rekening.push($(this).text());});
      $('.nama_penyelenggara').each(function(){nama_penyelenggara.push($(this).text());});
      $('.nama_program').each(function(){nama_program.push($(this).text());});
      $('.alamat_penyelenggara').each(function(){alamat_penyelenggara.push($(this).text());});
      $('.telepon_penyelenggara').each(function(){telepon_penyelenggara.push($(this).text());});
      
      $('.tanggal_pembayaran_awal').each(function(){tanggal_pembayaran_awal.push($(this).text());});
      $('.tanggal_pembayaran_akhir').each(function(){tanggal_pembayaran_akhir.push($(this).text());});

      //Data Lampiran
      $('.lampiran_ktp').each(function(){lampiran_ktp.push($(this).text());});
      $('.lampiran_selfie').each(function(){lampiran_selfie.push($(this).text());});
      $('.lampiran_npwp').each(function(){lampiran_npwp.push($(this).text());});
      $('.lampiran_gaji').each(function(){lampiran_gaji.push($(this).text());});

      $('.lampiran_ktp_pasangan').each(function(){lampiran_ktp_pasangan.push($(this).text());});
      $('.lampiran_selfie_pasangan').each(function(){lampiran_selfie_pasangan.push($(this).text());});

      $.ajax({
        beforeSend:function(){$(".spinner").css("display","block");},
        url:"import.php",
        method:"post",
        data:{
          id_debitur:id_debitur, 
          nik:nik,
          nama_debitur:nama_debitur,
          apply_date:apply_date,
          product:product,
          total_pembiayaan:total_pembiayaan,
          tempat_lahir:tempat_lahir,
          jenis_kelamin:jenis_kelamin,
          status_perkawinan:status_perkawinan,
          pendidikan_terakhir:pendidikan_terakhir,          
          no_telepon:no_telepon,
          email:email,
          nama_pasangan:nama_pasangan,
          tempat_lahir_pasangan:tempat_lahir_pasangan,
          jenis_kelamin_pasangan:jenis_kelamin_pasangan,
          status_perkawinan_pasangan:status_perkawinan_pasangan,
          pendidikan_terakhir_pasangan:pendidikan_terakhir_pasangan,
          nik_pasangan:nik_pasangan,
          domisili:domisili,
          domisili_no:domisili_no,
          domisili_rt:domisili_rt,
          domisili_rw:domisili_rw,
          domisili_kelurahan:domisili_kelurahan,
          domisili_kecamatan:domisili_kecamatan,
          domisili_kota:domisili_kota,
          domisili_provinsi:domisili_provinsi,
          domisili_zipcode:domisili_zipcode,
          status_tempat_tinggal:status_tempat_tinggal,
          lama_menempati_hari:lama_menempati_hari,
          pekerjaan:pekerjaan,
          bidang:bidang,
          jabatan:jabatan,
          lama_bekerja_hari:lama_bekerja_hari,
          penghasilan:penghasilan,
          nama_kantor:nama_kantor,
          alamat_kantor:alamat_kantor,
          alamat_kantor_kelurahan:alamat_kantor_kelurahan,
          alamat_kantor_kecamatan:alamat_kantor_kecamatan,
          alamat_kantor_kota:alamat_kantor_kota,
          alamat_kantor_provinsi:alamat_kantor_provinsi,
          telepon_kantor:telepon_kantor,
          nama_kontak_darurat:nama_kontak_darurat,
          telepon_kontak_darurat:telepon_kontak_darurat,
          hubungan_kontak_darurat:hubungan_kontak_darurat,
          tenor:tenor,
          uang_muka:uang_muka,
          cicilan_per_bulan:cicilan_per_bulan,
          total_pencairan:total_pencairan,
          bank_tujuan:bank_tujuan,
          nama_rekening:nama_rekening,
          nomor_rekening:nomor_rekening,
          nama_penyelenggara:nama_penyelenggara,
          nama_program:nama_program,
          alamat_penyelenggara:alamat_penyelenggara,
          telepon_penyelenggara:telepon_penyelenggara,
          tanggal_pembayaran_awal:tanggal_pembayaran_awal,
          tanggal_pembayaran_akhir:tanggal_pembayaran_akhir,
          lampiran_ktp:lampiran_ktp,
          lampiran_selfie:lampiran_selfie,
          lampiran_npwp:lampiran_npwp,
          lampiran_gaji:lampiran_gaji,
          lampiran_ktp_pasangan:lampiran_ktp_pasangan,
          lampiran_selfie_pasangan:lampiran_selfie_pasangan
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
