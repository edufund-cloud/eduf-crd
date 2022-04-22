<?PHP
  require_once("../../config/session.php");
  require_once("../../config/database.php");

  $sql_home = "SELECT gm.menu_file 
    FROM gen_menu_access gma 
    LEFT JOIN gen_menu gm ON gma.menu_id = gm.menu_id  
    WHERE gma.user_id = '$user_id' AND gm.menu_home = '1' AND gma.data_active = '1'";
    //echo $sql_home;
  $xsql_home = mysqli_query($koneksi,$sql_home);
  $arsql_home = mysqli_fetch_array($xsql_home);

  $Home_Url = $arsql_home['menu_file'];
  $Table_Url = "pages/analyst/tapply.php";  

  if (!empty($_GET['appid']) && $Product == "Uang Kursus"){
    $sql = "SELECT ac.course_id,ac.nama_penyelenggara,ac.nama_program,ac.alamat,ac.telepon,ac.tanggal_pembayaran,
      ac.total_pembiayaan,ac.uang_muka,ac.tenor,ac.cicilan_bulan,ac.bank_tujuan,ac.nama_rekening,ac.nomor_rekening 
      FROM apply_course ac 
      WHERE ac.data_id = '$_GET[appid]'";
    $xsql = mysqli_query($koneksi,$sql);
    $arsql = mysqli_fetch_array($xsql);
  }
  else if (!empty($_GET['appid']) && $Product == "Kredit Tanpa Agunan"){
    $sql = "SELECT ak.data_id, ak.total_pembiayaan, ak.tenor, ak.biaya_admin, 
      ak.total_pencairan, ak.cicilan_bulan, ak.bank_tujuan, ak.nama_rekening, ak.nomor_rekening 
      FROM apply_kta ak 
      WHERE ak.data_id = '$_GET[appid]'";
    $xsql = mysqli_query($koneksi,$sql);
    $arsql = mysqli_fetch_array($xsql);
  }
?>

<div class="tab-pane" id="pengajuan">
  <!-- Start Form -->
  <div class="card-body">

    <div class="row">
      <div class="col-12 col-lg-8">
        <?PHP 
          if ($Product == "Uang Kursus"){
            include_once('fcourse.php');
          }
          else if ($Product == "Kredit Tanpa Agunan"){
            include_once('fkta.php');
          }
          else{
            include_once('fcourse.php');
            include_once('fkta.php');
          }
        ?>
      </div>

      <?PHP include('fattachment.php'); ?>
    </div>
  </div>

  <div class="card-body" style="margin-top:-20px;">
    <div class="alert <?PHP echo $Alert_bg; ?> alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h6><i class="fa <?PHP echo $Alert_icon ?>"></i> <?PHP echo $Alert_head; ?></h6>
      <small><?PHP echo $Alert; ?></small>
    </div>
  </div>
  <!-- End Form -->

  <div class="modal-footer justify-content-between">
    <div class="spinner" style="display: none;" align="center">
      <img id="img-spinner" src="spiner.gif" style="width: 30px; height: 30px;" title="Process" >
    </div>
  </div>
</div>