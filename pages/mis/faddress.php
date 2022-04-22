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
  $Table_Url = "pages/apply/tapply.php";  

  if (!empty($_GET['appid'])){
    $sql = "SELECT aa.data_id,aa.alamat,aa.provinsi,aa.kota,aa.kecamatan,aa.kelurahan,aa.kode_pos,
      aa.status_tinggal,aa.lama_tinggal_tahun,aa.lama_tinggal_bulan
      FROM apply_address aa 
      WHERE aa.data_id = '$_GET[appid]'";
    $xsql = mysqli_query($koneksi,$sql);
    $arsql = mysqli_fetch_array($xsql);
  }
?>

<div class="tab-pane" id="alamat">
  <!-- Start Form -->
  <div class="card-body">

    <div class="row">
      <div class="col-12 col-lg-8">
        
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label for="txtAlamat">Alamat Tempat Tinggal</label>
              <input type="text" class="form-control" id="txtAlamat" name="txtAlamat" 
                style="background-color: #F6F6F6;" 
                placeholder="alamat tempat tinggal debitur" value="<?PHP echo $arsql['alamat']; ?>" 
                <?PHP echo $Disabled; ?>>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtProvinsi">Provinsi</label>
              <input type="text" class="form-control" id="txtProvinsi" name="txtProvinsi" 
                style="background-color: #F6F6F6;" 
                placeholder="Provinsi tempat tinggal" value="<?PHP echo $arsql['provinsi']; ?>" 
                <?PHP echo $Disabled; ?>>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtKota">Kota</label>
              <input type="text" class="form-control" id="txtKota" name="txtKota" 
                style="background-color: #F6F6F6;" 
                placeholder="Kota tempat tinggal" value="<?PHP echo $arsql['kota']; ?>" 
                <?PHP echo $Disabled; ?>>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtKecamatan">Kecamatan</label>
              <input type="text" class="form-control" id="txtKecamatan" name="txtKecamatan" 
                style="background-color: #F6F6F6;" 
                placeholder="Kecamatan tempat tinggal" value="<?PHP echo $arsql['kecamatan']; ?>" 
                <?PHP echo $Disabled; ?>>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtKelurahan">Kelurahan</label>
              <input type="text" class="form-control" id="txtKelurahan" name="txtKelurahan" 
                style="background-color: #F6F6F6;" 
                placeholder="Kelurahan tempat tinggal" value="<?PHP echo $arsql['kelurahan']; ?>" 
                <?PHP echo $Disabled; ?>>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtKodePos">Kode Pos</label>
              <input type="text" class="form-control" id="txtKodePos" name="txtKodePos" 
                style="background-color: #F6F6F6;" 
                placeholder="Kode Pos tempat tinggal" value="<?PHP echo $arsql['kode_pos']; ?>" 
                <?PHP echo $Disabled; ?>>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label for="cmbStatusTinggal">Status Tempat Tinggal</label>
              <select class="custom-select" style="width: 100%;" name="cmbStatusTinggal" <?PHP echo $Disabled; ?>>
                    <option value="0">- Pilih -</option>
                    <option value="Pribadi" 
                      <?PHP if ($arsql['status_tinggal']=="Pribadi"){ echo'selected'; } ?>>Milik Pribadi</option>
                    <option value="Keluarga" 
                      <?PHP if ($arsql['status_tinggal']=="Keluarga"){ echo'selected'; } ?>>Milik Keluarga</option>
                    <option value="Kontrak" 
                      <?PHP if ($arsql['status_tinggal']=="Kontrak"){ echo'selected'; } ?>>Kontrak</option>
                  </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtLamaTinggalTahun">Lama Tinggal (Tahun)</label>
              <input type="text" class="form-control" id="txtLamaTinggalTahun" name="txtLamaTinggalTahun" 
                style="background-color: #F6F6F6;" 
                placeholder="Lama menempati tempat tinggal (tahun)" value="<?PHP echo $arsql['lama_tinggal_tahun']; ?>" 
                <?PHP echo $Disabled; ?>>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtLamaTinggalBulan">Bulan</label>
              <input type="text" class="form-control" id="txtLamaTinggalBulan" name="txtLamaTinggalBulan" 
                style="background-color: #F6F6F6;" 
                placeholder="KLama menempati tempat tinggal (bulan)" value="<?PHP echo $arsql['lama_tinggal_bulan']; ?>" 
                <?PHP echo $Disabled; ?>>
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