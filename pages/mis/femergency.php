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
  $Table_Url = "pages/mis/tapply.php";

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
                placeholder="Nama lengkap" value="<?PHP echo $arsql['nama_lengkap']; ?>" <?PHP echo $Disabled; ?>>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label for="txtTeleponKontak">Nomor Telepon</label>
              <input type="text" class="form-control" id="txtTeleponKontak" name="txtTeleponKontak" 
                style="background-color: #F6F6F6;" 
                placeholder="Nomor telepon kontak" value="<?PHP echo $arsql['nomor_telepon']; ?>" <?PHP echo $Disabled; ?>>
            </div>
          </div>
        </div>  

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label for="cmbHubunganKontak">Hubungan</label>
              <input list="encodings" value="<?PHP echo $arsql['hubungan']; ?>" id="cmbHubunganKontak" name="cmbHubunganKontak" 
                class="form-control" style="background-color: #F6F6F6;" placeholder="Hubungan dengan kontak" >
              <datalist id="encodings">
                <?PHP 
                  $sql_data = "SELECT ae.hubungan FROM apply_emergency ae GROUP BY ae.hubungan ORDER BY ae.hubungan ASC";
                  $xsql_data = mysqli_query($koneksi,$sql_data);
                  while($arsql_data = mysqli_fetch_array($xsql_data)){
                    ?>
                    <option value="<?PHP echo $arsql_data['hubungan']; ?>">
                      <?PHP echo $arsql_data['hubungan']; ?>
                    </option>
                    <?PHP
                  }
                ?>
              </datalist>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-4">
        <div class="col-12">
          <div class="form-group">
            <button type="button" class="btn btn-success btn-sm mb-4 float-right" style="margin-right: 5px; border-radius: 3px;"
              onclick="javascript:load_right('tattachment.php?dtid=<?PHP echo $data_id; ?>');">
              <i class="fa fa-paperclip mr-1"></i>Attacment
            </button>
            <?PHP
              $sql_img = "SELECT aa.attach_id,aa.data_id,aa.description,aa.attach_url,aa.data_update,gu.user_login 
                FROM apply_attach aa 
                LEFT JOIN gen_users gu ON aa.user_update = gu.user_id 
                WHERE aa.data_id = '$_GET[appid]' ORDER BY aa.attach_id ASC LIMIT 0,1";
              $xsql_img = mysqli_query($koneksi, $sql_img);
              $arsql_img = mysqli_fetch_array($xsql_img);
            ?>
            <img src="<?PHP echo $arsql_img['attach_url']; ?>" class="product-image" alt="Attach Image" 
              style="border-radius: 10px; border:solid thin lightgray;">
          </div>
        </div>        
        <div class="col-12 product-image-thumbs ml-2">
          <?PHP
            $sql_atc = "SELECT aa.attach_id,aa.data_id,aa.description,aa.attach_url,aa.data_update,gu.user_login 
              FROM apply_attach aa 
              LEFT JOIN gen_users gu ON aa.user_update = gu.user_id 
              WHERE aa.data_id = '$_GET[appid]' ORDER BY aa.attach_id ASC";
            $xsql_atc = mysqli_query($koneksi, $sql_atc);
            $img_active = "active";
            while($arsql_atc = mysqli_fetch_array($xsql_atc)){
              ?>
              <div class="product-image-thumb" <?PHP echo $img_active; ?> >
                <img src="<?PHP echo $arsql_atc['attach_url']; ?>" alt="Attach Image">
              </div>
              <?PHP
              $img_active = "";
            }
          ?>
        </div>
      </div>
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

