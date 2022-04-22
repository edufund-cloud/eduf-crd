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
</head>
<body class="hold-transition layout-top-nav">

<?PHP
  require_once("../../../config/database.php");
  require_once("../../../com/home_map.php");
?>

<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="#" class="navbar-brand">
          <img src="../../../dist/img/edufund-logo-short-1.png" alt="Edufund Logo" class="brand-image"
              style="opacity: .8;">
          <span class="brand-text font-weight-bold text-primary">EDUFUND</span>
          <i class="fa-solid fa-pipe ml-1 mr-1"></i>
          <span class="brand-text font-weight-light" style="font-size:16px;">Tool Import Data CSV</span>
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
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
            <h1 class="m-0 text-dark"> Import Data - Uang Kursus</h1>
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

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

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
          }

          if(data.row_data){
            for(var count = 0; count < data.row_data.length; count++){
              html += '<tr>';
              html += '<td class="id_debitur" contenteditable>'+data.row_data[count].id_debitur+'</td>';
              html += '<td class="nama_debitur" contenteditable>'+data.row_data[count].nama_debitur+'</td>';
              html += '<td class="apply_date" contenteditable>'+data.row_data[count].apply_date+'</td>';
              html += '<td class="product" contenteditable>'+data.row_data[count].product+'</td>';
              
              //Data Personal 10
              html += '<td class="tempat_lahir" contenteditable>'+data.row_data[count].tempat_lahir+'</td>';
              html += '<td hidden class="tanggal_lahir" contenteditable>'+data.row_data[count].tanggal_lahir+'</td>';
              html += '<td hidden class="jenis_kelamin" contenteditable>'+data.row_data[count].jenis_kelamin+'</td>';
              html += '<td hidden class="status_perkawinan" contenteditable>'+data.row_data[count].status_perkawinan+'</td>';
              html += '<td hidden class="agama" contenteditable>'+data.row_data[count].agama+'</td>';
              html += '<td hidden class="pendidikan_terakhir" contenteditable>'+data.row_data[count].pendidikan_terakhir+'</td>';
              html += '<td hidden class="nik" contenteditable>'+data.row_data[count].nik+'</td>';
              html += '<td hidden class="npwp" contenteditable>'+data.row_data[count].npwp+'</td>';
              html += '<td hidden class="no_telepon" contenteditable>'+data.row_data[count].no_telepon+'</td>';
              html += '<td hidden class="email" contenteditable>'+data.row_data[count].email+'</td>';

              //Data Pasangan 11
              html += '<td hidden class="nama_pasangan" contenteditable>'+data.row_data[count].nama_pasangan+'</td>';
              html += '<td hidden class="tempat_lahir_pasangan" contenteditable>'+data.row_data[count].tempat_lahir_pasangan+'</td>';
              html += '<td hidden class="tanggal_lahir_pasangan" contenteditable>'+data.row_data[count].tanggal_lahir_pasangan+'</td>';
              html += '<td hidden class="agama_pasangan" contenteditable>'+data.row_data[count].agama_pasangan+'</td>';
              html += '<td hidden class="jenis_kelamin_pasangan" contenteditable>'+data.row_data[count].jenis_kelamin_pasangan+'</td>';
              html += '<td hidden class="pendidikan_terakhir_pasangan" contenteditable>'+data.row_data[count].pendidikan_terakhir_pasangan+'</td>';
              html += '<td hidden class="status_perkawinan_pasangan" contenteditable>'+data.row_data[count].status_perkawinan_pasangan+'</td>';
              html += '<td hidden class="nik_pasangan" contenteditable>'+data.row_data[count].nik_pasangan+'</td>';
              html += '<td hidden class="npwp_pasangan" contenteditable>'+data.row_data[count].npwp_pasangan+'</td>';
              html += '<td hidden class="no_telepon_pasangan" contenteditable>'+data.row_data[count].no_telepon_pasangan+'</td>';
              html += '<td hidden class="email_pasangan" contenteditable>'+data.row_data[count].email_pasangan+'</td>';

              //Data Alamat 9
              html += '<td hidden class="alamat" contenteditable>'+data.row_data[count].alamat+'</td>';
              html += '<td hidden class="provinsi" contenteditable>'+data.row_data[count].provinsi+'</td>';
              html += '<td hidden class="kota" contenteditable>'+data.row_data[count].kota+'</td>';
              html += '<td hidden class="kecamatan" contenteditable>'+data.row_data[count].kecamatan+'</td>';
              html += '<td hidden class="kelurahan" contenteditable>'+data.row_data[count].kelurahan+'</td>';
              html += '<td hidden class="kode_pos" contenteditable>'+data.row_data[count].kode_pos+'</td>';
              html += '<td hidden class="status_tempat_tinggal" contenteditable>'+data.row_data[count].status_tempat_tinggal+'</td>';
              html += '<td hidden class="lama_menempati_tahun" contenteditable>'+data.row_data[count].lama_menempati_tahun+'</td>';
              html += '<td hidden class="lama_menempati_bulan" contenteditable>'+data.row_data[count].lama_menempati_bulan+'</td>';

              //Data Pekerjaan 14
              html += '<td hidden class="pekerjaan" contenteditable>'+data.row_data[count].pekerjaan+'</td>';
              html += '<td hidden class="bidang" contenteditable>'+data.row_data[count].bidang+'</td>';
              html += '<td hidden class="jabatan" contenteditable>'+data.row_data[count].jabatan+'</td>';
              html += '<td hidden class="status_pekerjaan" contenteditable>'+data.row_data[count].status_pekerjaan+'</td>';
              html += '<td hidden class="lama_bekerja_tahun" contenteditable>'+data.row_data[count].lama_bekerja_tahun+'</td>';
              html += '<td hidden class="lama_bekerja_bulan" contenteditable>'+data.row_data[count].lama_bekerja_bulan+'</td>';
              html += '<td hidden class="penghasilan" contenteditable>'+data.row_data[count].penghasilan+'</td>';
              html += '<td hidden class="nama_kantor" contenteditable>'+data.row_data[count].nama_kantor+'</td>';
              html += '<td hidden class="alamat_kantor" contenteditable>'+data.row_data[count].alamat_kantor+'</td>';
              html += '<td hidden class="telepon_kantor" contenteditable>'+data.row_data[count].telepon_kantor+'</td>';
              html += '<td hidden class="provinsi_kantor" contenteditable>'+data.row_data[count].provinsi_kantor+'</td>';
              html += '<td hidden class="kota_kantor" contenteditable>'+data.row_data[count].kota_kantor+'</td>';
              html += '<td hidden class="kecamatan_kantor" contenteditable>'+data.row_data[count].kecamatan_kantor+'</td>';
              html += '<td hidden class="kelurahan_kantor" contenteditable>'+data.row_data[count].kelurahan_kantor+'</td>';

              //Data Kontak Darurat 3
              html += '<td hidden class="nama_kontak" contenteditable>'+data.row_data[count].nama_kontak+'</td>';
              html += '<td hidden class="telepon_kontak" contenteditable>'+data.row_data[count].telepon_kontak+'</td>';
              html += '<td hidden class="hubungan_kontak" contenteditable>'+data.row_data[count].hubungan_kontak+'</td>';

              //Data Pengajuan 13
              html += '<td hidden class="total_pembiayaan" contenteditable>'+data.row_data[count].total_pembiayaan+'</td>';
              html += '<td hidden class="tenor" contenteditable>'+data.row_data[count].tenor+'</td>';
              html += '<td hidden class="uang_muka" contenteditable>'+data.row_data[count].uang_muka+'</td>';
              html += '<td hidden class="cicilan_per_bulan" contenteditable>'+data.row_data[count].cicilan_per_bulan+'</td>';
              
              html += '<td hidden class="total_pencairan" contenteditable>'+data.row_data[count].total_pencairan+'</td>';
              
              html += '<td hidden class="bank_tujuan" contenteditable>'+data.row_data[count].bank_tujuan+'</td>';
              html += '<td hidden class="nama_rekening" contenteditable>'+data.row_data[count].nama_rekening+'</td>';
              html += '<td hidden class="nomor_rekening" contenteditable>'+data.row_data[count].nomor_rekening+'</td>';

              html += '<td hidden class="nama_penyelenggara" contenteditable>'+data.row_data[count].nama_penyelenggara+'</td>';
              html += '<td hidden class="nama_program" contenteditable>'+data.row_data[count].nama_program+'</td>';
              html += '<td hidden class="alamat_penyelenggara" contenteditable>'+data.row_data[count].alamat_penyelenggara+'</td>';
              html += '<td hidden class="telepon_penyelenggara" contenteditable>'+data.row_data[count].telepon_penyelenggara+'</td>';
              html += '<td hidden class="tanggal_pembayaran" contenteditable>'+data.row_data[count].tanggal_pembayaran+'</td>';
              
              //Data Attachment 5
              html += '<td hidden class="lampiran_ktp" contenteditable>'+data.row_data[count].lampiran_ktp+'</td>';
              html += '<td hidden class="lampiran_npwp" contenteditable>'+data.row_data[count].lampiran_npwp+'</td>';
              html += '<td hidden class="lampiran_gaji" contenteditable>'+data.row_data[count].lampiran_gaji+'</td>';
              html += '<td hidden class="lampiran_kk" contenteditable>'+data.row_data[count].lampiran_kk+'</td>';
              html += '<td hidden class="lampiran_ktp_pasangan" contenteditable>'+data.row_data[count].lampiran_ktp_pasangan+'</td>';

              html += '</tr>';              
              
            }
          }
          html += '<table>';
          html += '<div class="spinner" style="display: none; margin-bottom:20px;" align="center"><img id="img-spinner" src="../../../spiner.gif" style="width: 30px; height: 30px;" title="Process" ></div>';
          html += '<div align="center"><button type="button" id="import_data" class="btn btn-success"><i class="fa-solid fa-file-import mr-2"></i>Import</button></div>';

          $('#csv_file_data').html(html);
          $('#upload_csv')[0].reset();
        }
      })
    });

    $(document).on('click', '#import_data', function(){
      var id_debitur = [];
      var nama_debitur = [];
      var apply_date = [];
      var product = [];

      //Data Personal
      var tempat_lahir = [];
      var tanggal_lahir = [];
      var jenis_kelamin = [];
      var status_perkawinan = [];
      var agama = [];
      var pendidikan_terakhir = [];
      var nik = [];
      var npwp = [];
      var no_telepon = [];
      var email = [];

      //Data Pasangan
      var nama_pasangan = [];
      var tempat_lahir_pasangan = [];
      var tanggal_lahir_pasangan = [];
      var jenis_kelamin_pasangan = [];
      var status_perkawinan_pasangan = [];
      var agama_pasangan = [];
      var pendidikan_terakhir_pasangan = [];
      var nik_pasangan = [];
      var npwp_pasangan = [];
      var no_telepon_pasangan = [];
      var email_pasangan = []; 

      //Data Alamat
      var alamat = [];
      var provinsi = [];
      var kota = [];
      var kecamatan = [];
      var kelurahan = [];
      var kode_pos = [];
      var status_tempat_tinggal = [];
      var lama_menempati_tahun = [];
      var lama_menempati_bulan = [];  

      //Data Pekerjaan
      var pekerjaan = [];
      var bidang = [];
      var jabatan = [];
      var status_pekerjaan = [];
      var lama_bekerja_tahun = [];
      var lama_bekerja_bulan = [];
      var penghasilan = [];
      var nama_kantor = [];
      var alamat_kantor = [];
      var telepon_kantor = [];
      var provinsi_kantor = [];
      var kota_kantor = [];
      var kecamatan_kantor = [];
      var kelurahan_kantor = [];  

      //Data Kontak Darurat
      var nama_kontak = [];
      var telepon_kontak = [];
      var hubungan_kontak = [];  

      //Data Pengajuan
      var total_pembiayaan = [];
      var tenor = [];
      var uang_muka = [];
      var cicilan_per_bulan = [];

      var total_pencairan = [];

      var bank_tujuan = [];
      var nama_rekening = [];
      var nomor_rekening = [];

      var nama_penyelenggara = [];
      var nama_program = [];
      var alamat_penyelenggara = [];
      var telepon_penyelenggara = [];
      var tanggal_pembayaran = [];
      
      //Data Lampiran
      var lampiran_ktp = [];
      var lampiran_npwp = [];
      var lampiran_gaji = [];
      var lampiran_kk = [];
      var lampiran_ktp_pasangan = [];
      

      $('.id_debitur').each(function(){id_debitur.push($(this).text());});
      $('.nama_debitur').each(function(){nama_debitur.push($(this).text());});
      $('.apply_date').each(function(){apply_date.push($(this).text());});
      $('.product').each(function(){product.push($(this).text());});

      //Data Personal
      $('.tempat_lahir').each(function(){tempat_lahir.push($(this).text());});
      $('.tanggal_lahir').each(function(){tanggal_lahir.push($(this).text());});
      $('.jenis_kelamin').each(function(){jenis_kelamin.push($(this).text());});
      $('.status_perkawinan').each(function(){status_perkawinan.push($(this).text());});
      $('.agama').each(function(){agama.push($(this).text());});
      $('.pendidikan_terakhir').each(function(){pendidikan_terakhir.push($(this).text());});
      $('.nik').each(function(){nik.push($(this).text());});
      $('.npwp').each(function(){npwp.push($(this).text());});
      $('.no_telepon').each(function(){no_telepon.push($(this).text());});
      $('.email').each(function(){email.push($(this).text());});

      //Data Pasangan
      $('.nama_pasangan').each(function(){nama_pasangan.push($(this).text());});
      $('.tempat_lahir_pasangan').each(function(){tempat_lahir_pasangan.push($(this).text());});
      $('.tanggal_lahir_pasangan').each(function(){tanggal_lahir_pasangan.push($(this).text());});
      $('.jenis_kelamin_pasangan').each(function(){jenis_kelamin_pasangan.push($(this).text());});
      $('.status_perkawinan_pasangan').each(function(){status_perkawinan_pasangan.push($(this).text());});
      $('.agama_pasangan').each(function(){agama_pasangan.push($(this).text());});
      $('.pendidikan_terakhir_pasangan').each(function(){pendidikan_terakhir_pasangan.push($(this).text());});
      $('.nik_pasangan').each(function(){nik_pasangan.push($(this).text());});
      $('.npwp_pasangan').each(function(){npwp_pasangan.push($(this).text());});
      $('.no_telepon_pasangan').each(function(){no_telepon_pasangan.push($(this).text());});
      $('.email_pasangan').each(function(){email_pasangan.push($(this).text());});

      //Data Alamat
      $('.alamat').each(function(){alamat.push($(this).text());});
      $('.provinsi').each(function(){provinsi.push($(this).text());});
      $('.kota').each(function(){kota.push($(this).text());});
      $('.kecamatan').each(function(){kecamatan.push($(this).text());});
      $('.kelurahan').each(function(){kelurahan.push($(this).text());});
      $('.kode_pos').each(function(){kode_pos.push($(this).text());});
      $('.status_tempat_tinggal').each(function(){status_tempat_tinggal.push($(this).text());});
      $('.lama_menempati_tahun').each(function(){lama_menempati_tahun.push($(this).text());});
      $('.lama_menempati_bulan').each(function(){lama_menempati_bulan.push($(this).text());});

      //Data Pekerjaan
      $('.pekerjaan').each(function(){pekerjaan.push($(this).text());});
      $('.bidang').each(function(){bidang.push($(this).text());});
      $('.jabatan').each(function(){jabatan.push($(this).text());});
      $('.status_pekerjaan').each(function(){status_pekerjaan.push($(this).text());});
      $('.lama_bekerja_tahun').each(function(){lama_bekerja_tahun.push($(this).text());});
      $('.lama_bekerja_bulan').each(function(){lama_bekerja_bulan.push($(this).text());});
      $('.penghasilan').each(function(){penghasilan.push($(this).text());});
      $('.nama_kantor').each(function(){nama_kantor.push($(this).text());});
      $('.alamat_kantor').each(function(){alamat_kantor.push($(this).text());});
      $('.telepon_kantor').each(function(){telepon_kantor.push($(this).text());});
      $('.provinsi_kantor').each(function(){provinsi_kantor.push($(this).text());});
      $('.kota_kantor').each(function(){kota_kantor.push($(this).text());});
      $('.kecamatan_kantor').each(function(){kecamatan_kantor.push($(this).text());});
      $('.kelurahan_kantor').each(function(){kelurahan_kantor.push($(this).text());});

      //Data Kontak
      $('.nama_kontak').each(function(){nama_kontak.push($(this).text());});
      $('.telepon_kontak').each(function(){telepon_kontak.push($(this).text());});
      $('.hubungan_kontak').each(function(){hubungan_kontak.push($(this).text());});

      //Data Pengajuan
      $('.total_pembiayaan').each(function(){total_pembiayaan.push($(this).text());});
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
      $('.tanggal_pembayaran').each(function(){tanggal_pembayaran.push($(this).text());});

      //Data Lampiran
      $('.lampiran_ktp').each(function(){lampiran_ktp.push($(this).text());});
      $('.lampiran_npwp').each(function(){lampiran_npwp.push($(this).text());});
      $('.lampiran_gaji').each(function(){lampiran_gaji.push($(this).text());});
      $('.lampiran_kk').each(function(){lampiran_kk.push($(this).text());});
      $('.lampiran_ktp_pasangan').each(function(){lampiran_ktp_pasangan.push($(this).text());});

      $.ajax({        
        url:"import.php",
        method:"post",
        data:{
          id_debitur:id_debitur, 
          nama_debitur:nama_debitur,
          apply_date:apply_date,
          product:product,

          tempat_lahir:tempat_lahir,
          tanggal_lahir:tanggal_lahir,
          jenis_kelamin:jenis_kelamin,
          status_perkawinan:status_perkawinan,
          agama:agama,
          pendidikan_terakhir:pendidikan_terakhir,
          nik:nik,
          npwp:npwp,
          no_telepon:no_telepon,
          email:email,

          nama_pasangan:nama_pasangan,
          tempat_lahir_pasangan:tempat_lahir_pasangan,
          tanggal_lahir_pasangan:tanggal_lahir_pasangan,
          jenis_kelamin_pasangan:jenis_kelamin_pasangan,
          status_perkawinan_pasangan:status_perkawinan_pasangan,
          agama_pasangan:agama_pasangan,
          pendidikan_terakhir_pasangan:pendidikan_terakhir_pasangan,
          nik_pasangan:nik_pasangan,
          npwp_pasangan:npwp_pasangan,
          no_telepon_pasangan:no_telepon_pasangan,
          email_pasangan:email_pasangan,

          alamat:alamat,
          provinsi:provinsi,
          kota:kota,
          kecamatan:kecamatan,
          kelurahan:kelurahan,
          kode_pos:kode_pos,
          status_tempat_tinggal:status_tempat_tinggal,
          lama_menempati_tahun:lama_menempati_tahun,
          lama_menempati_bulan:lama_menempati_bulan,

          pekerjaan:pekerjaan,
          bidang:bidang,
          jabatan:jabatan,
          status_pekerjaan:status_pekerjaan,
          lama_bekerja_tahun:lama_bekerja_tahun,
          lama_bekerja_bulan:lama_bekerja_bulan,
          penghasilan:penghasilan,
          nama_kantor:nama_kantor,
          alamat_kantor:alamat_kantor,
          telepon_kantor:telepon_kantor,
          provinsi_kantor:provinsi_kantor,
          kota_kantor:kota_kantor,
          kecamatan_kantor:kecamatan_kantor,
          kelurahan_kantor:kelurahan_kantor,

          nama_kontak:nama_kontak,
          telepon_kontak:telepon_kontak,
          hubungan_kontak:hubungan_kontak,

          
          total_pembiayaan:total_pembiayaan,
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
          tanggal_pembayaran:tanggal_pembayaran,

          lampiran_ktp:lampiran_ktp,
          lampiran_npwp:lampiran_npwp,
          lampiran_gaji:lampiran_gaji,
          lampiran_kk:lampiran_kk,
          lampiran_ktp_pasangan:lampiran_ktp_pasangan
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
