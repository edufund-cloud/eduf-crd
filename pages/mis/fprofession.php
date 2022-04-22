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
    $sql = "SELECT ap.profession_id,ap.pekerjaan,ap.bidang,ap.jabatan,ap.status,ap.lama_bekerja_tahun,ap.lama_bekerja_bulan,
      ap.penghasilan,ap.nama_kantor,ap.alamat,ap.telepon,ap.provinsi,ap.kota,ap.kecamatan,ap.kelurahan,ap.kode_pos 
      FROM apply_profession ap 
      WHERE ap.data_id = '$_GET[appid]'";
    $xsql = mysqli_query($koneksi,$sql);
    $arsql = mysqli_fetch_array($xsql);
  }
?>

<div class="tab-pane" id="pekerjaan">
  <!-- Start Form -->
  <div class="card-body">

    <div class="row">
      <div class="col-12 col-lg-8">
        
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="cmbPekerjaan">Pekerjaan</label>
              <input list="encodings" value="<?PHP echo $arsql['pekerjaan']; ?>" id="cmbPekerjaan" name="cmbPekerjaan" 
                class="form-control" style="background-color: #F6F6F6;" >
              <datalist id="encodings">
                <?PHP 
                  $sql_data = "SELECT ap.pekerjaan FROM apply_profession ap GROUP BY ap.pekerjaan ORDER BY ap.pekerjaan ASC";
                  $xsql_data = mysqli_query($koneksi,$sql_data);
                  while($arsql_data = mysqli_fetch_array($xsql_data)){
                    ?>
                    <option value="<?PHP echo $arsql_data['pekerjaan']; ?>">
                      <?PHP echo $arsql_data['pekerjaan']; ?>
                    </option>
                    <?PHP
                  }
                ?>
              </datalist>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label for="cmbBidang">Bidang</label>
              <input list="encodings" value="<?PHP echo $arsql['bidang']; ?>" id="cmbBidang" name="cmbBidang" 
                class="form-control" style="background-color: #F6F6F6;" >
              <datalist id="encodings">
                <?PHP 
                  $sql_data = "SELECT ap.bidang FROM apply_profession ap GROUP BY ap.bidang ORDER BY ap.bidang ASC";
                  $xsql_data = mysqli_query($koneksi,$sql_data);
                  while($arsql_data = mysqli_fetch_array($xsql_data)){
                    ?>
                    <option value="<?PHP echo $arsql_data['bidang']; ?>">
                      <?PHP echo $arsql_data['bidang']; ?>
                    </option>
                    <?PHP
                  }
                ?>
              </datalist>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="cmbJabatan">Jabatan</label>
              <input list="encodings" value="<?PHP echo $arsql['jabatan']; ?>" id="cmbJabatan" name="cmbJabatan" 
                class="form-control" style="background-color: #F6F6F6;" >
              <datalist id="encodings">
                <?PHP 
                  $sql_data = "SELECT ap.jabatan FROM apply_profession ap GROUP BY ap.jabatan ORDER BY ap.jabatan ASC";
                  $xsql_data = mysqli_query($koneksi,$sql_data);
                  while($arsql_data = mysqli_fetch_array($xsql_data)){
                    ?>
                    <option value="<?PHP echo $arsql_data['jabatan']; ?>">
                      <?PHP echo $arsql_data['jabatan']; ?>
                    </option>
                    <?PHP
                  }
                ?>
              </datalist>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label for="cmbStatusKerja">Status</label>
              <select class="custom-select" style="width: 100%;" name="cmbStatusKerja" <?PHP echo $Disabled; ?>>
                <option value="0">- Pilih -</option>
                <option value="Tetap" 
                  <?PHP if ($arsql['status']=="Tetap"){ echo'selected'; } ?>>Pegawai Tetap</option>
                <option value="Kontrak" 
                  <?PHP if ($arsql['status']=="Kontrak"){ echo'selected'; } ?>>Pegawai Kontrak</option>
                <option value="Honorer" 
                  <?PHP if ($arsql['status']=="Honorer"){ echo'selected'; } ?>>Pegawai Honorer</option>
                <option value="Magang" 
                  <?PHP if ($arsql['status']=="Magang"){ echo'selected'; } ?>>Pegawai Magang</option>
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-3">
            <div class="form-group">
              <label for="txtLamaBekerjaTahun">Lama Bekerja (Tahun)</label>
              <input type="text" class="form-control" id="txtLamaBekerjaTahun" name="txtLamaBekerjaTahun" 
                style="background-color: #F6F6F6;" 
                placeholder="Tahun bekerja" value="<?PHP echo $arsql['lama_bekerja_tahun']; ?>" 
                <?PHP echo $Disabled; ?>>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="txtLamaBekerjaBulan">(Bulan)</label>
              <input type="text" class="form-control" id="txtLamaBekerjaBulan" name="txtLamaBekerjaBulan" 
                style="background-color: #F6F6F6;" 
                placeholder="Bulan bekerja" value="<?PHP echo $arsql['lama_bekerja_bulan']; ?>" 
                <?PHP echo $Disabled; ?>>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtPenghasilan">Penghasilan per Bulan</label>
              <input type="text" class="form-control" id="txtPenghasilan" name="txtPenghasilan" 
                style="background-color: #F6F6F6;" 
                placeholder="Penghasilan per bulan" value="<?PHP echo $arsql['penghasilan']; ?>" 
                <?PHP echo $Disabled; ?>>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label for="txtNamaKantor">Nama Kantor/Usaha</label>
              <input type="text" class="form-control" id="txtNamaKantor" name="txtNamaKantor" 
                style="background-color: #F6F6F6;" 
                placeholder="Nama kantor/usaha" value="<?PHP echo $arsql['nama_kantor']; ?>" 
                <?PHP echo $Disabled; ?>>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label for="txtAlamatKantor">Alamat Kantor/Usaha</label>
              <input type="text" class="form-control" id="txtAlamatKantor" name="txtAlamatKantor" 
                style="background-color: #F6F6F6;" 
                placeholder="Alamat kantor/usaha" value="<?PHP echo $arsql['alamat']; ?>" 
                <?PHP echo $Disabled; ?>>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtProvinsiKantor">Provinsi</label>
              <input type="text" class="form-control" id="txtProvinsiKantor" name="txtProvinsiKantor" 
                style="background-color: #F6F6F6;" 
                placeholder="Provinsi alamat kantor" value="<?PHP echo $arsql['provinsi']; ?>" 
                <?PHP echo $Disabled; ?>>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtKotaKantor">Kota</label>
              <input type="text" class="form-control" id="txtKotaKantor" name="txtKotaKantor" 
                style="background-color: #F6F6F6;" 
                placeholder="Kota tempat tinggal" value="<?PHP echo $arsql['kota']; ?>" 
                <?PHP echo $Disabled; ?>>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtKecamatanKantor">Kecamatan</label>
              <input type="text" class="form-control" id="txtKecamatanKantor" name="txtKecamatanKantor" 
                style="background-color: #F6F6F6;" 
                placeholder="Kecamatan alamat kantor" value="<?PHP echo $arsql['kecamatan']; ?>" 
                <?PHP echo $Disabled; ?>>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtKelurahanKantor">Kelurahan</label>
              <input type="text" class="form-control" id="txtKelurahanKantor" name="txtKelurahanKantor" 
                style="background-color: #F6F6F6;" 
                placeholder="Kelurahan alamat kantor" value="<?PHP echo $arsql['kelurahan']; ?>" 
                <?PHP echo $Disabled; ?>>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtKodePosKantor">Kode Pos</label>
              <input type="text" class="form-control" id="txtKodePosKantor" name="txtKodePosKantor" 
                style="background-color: #F6F6F6;" 
                placeholder="Kode Pos kantor" value="<?PHP echo $arsql['kode_pos']; ?>" 
                <?PHP echo $Disabled; ?>>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtTeleponKantor">Nomor Telepon Kantor</label>
              <input type="text" class="form-control" id="txtTeleponKantor" name="txtTeleponKantor" 
                style="background-color: #F6F6F6;" 
                placeholder="Nomor telepon kantor" value="<?PHP echo $arsql['telepon']; ?>" 
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