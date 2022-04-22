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

  if (!empty($_GET['appid'])){
    $sql = "SELECT ae.emergency_id,ae.nama_lengkap,ae.nomor_telepon,ae.hubungan 
      FROM apply_emergency ae 
      WHERE ae.data_id = '$_GET[appid]'";
      //echo $sql;
    $xsql = mysqli_query($koneksi,$sql);
    $arsql = mysqli_fetch_array($xsql);
  }
?>

<div class="tab-pane" id="kontak_darurat">
  <!-- Start Form -->
  <div class="card-body">

    <div class="row">
      <div class="col-12 col-lg-8">
        
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label for="txtNamaKontak">Nama Lengkap</label>
              <input type="text" class="form-control" id="txtNamaKontak" name="txtNamaKontak" 
                style="background-color: #F6F6F6;" tabindex="0" 
                placeholder="Nama lengkap" value="<?PHP echo $arsql['nama_lengkap']; ?>" disabled>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label for="txtTeleponKontak">Nomor Telepon</label>
              <input type="text" class="form-control" id="txtTeleponKontak" name="txtTeleponKontak" 
                style="background-color: #F6F6F6;" 
                placeholder="Nomor telepon kontak" value="<?PHP echo $arsql['nomor_telepon']; ?>" disabled>
            </div>
          </div>
        </div>  

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label for="txtHubunganKontak">Hubungan</label>
              <input type="text" value="<?PHP echo $arsql['hubungan']; ?>" id="txtHubunganKontak" name="txtHubunganKontak" 
                class="form-control" style="background-color: #F6F6F6;" placeholder="Hubungan dengan kontak" >
            </div>
          </div>
        </div>
      </div>

      <?PHP include('fattachment.php'); ?>
    </div>

  </div>

  <div class="card-body">
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

