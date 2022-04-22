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
    $sql = "SELECT apd.personal_id,apd.tempat_lahir,apd.tanggal_lahir,apd.jenis_kelamin,apd.status_perkawinan,
      apd.agama,apd.pendidikan_terakhir,apd.nik,apd.npwp,apd.no_telepon,apd.email,
      apd.nama_pasangan,apd.tempat_lahir_pasangan, apd.tanggal_lahir_pasangan, apd.agama_pasangan, 
      apd.jenis_kelamin_pasangan, apd.pendidikan_terakhir_pasangan, apd.status_perkawinan_pasangan, 
      apd.nik_pasangan, apd.npwp_pasangan, apd.no_telepon_pasangan, apd.email_pasangan, 
      a.ID
      FROM apply_personal apd 
      LEFT JOIN apply a ON apd.data_id = a.data_id 
      WHERE apd.data_id = '$_GET[appid]'";
      //echo $sql;
    $xsql = mysqli_query($koneksi,$sql);
    $arsql = mysqli_fetch_array($xsql);
  }
?>

<div class="tab-pane" id="personal">
  <!-- Start Form -->
  <div class="card-body">

    <div class="row">
      <div class="col-12 col-lg-8">

        <!-- Start data Debitur -->
        <div class="row">          
          <div class="card col-sm-12 elevation-0">
            <div class="card-header bg-lightgray" style="margin-top:-12px;" data-card-widget="collapse">
              <h3 class="card-title font-weight-bold text-lightblue" style="cursor:pointer;">
                <i class="far fa-circle mr-1"></i>Data Pribadi
              </h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus text-lightblue"></i>
                </button>
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="txtFullName">Nama Lengkap</label>
                    <input type="text" class="form-control" id="txtFullName" name="txtFullName" 
                      style="background-color: #F6F6F6;" tabindex="0" 
                      placeholder="Nama lengkap" value="<?PHP echo $Full_Name; ?>" <?PHP echo $Disabled; ?> disabled>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="cmbGraduate">Pendidikan Terakhir</label>
                    <input type="text" class="form-control" id="cmbGraduate" name="cmbGraduate" 
                      style="background-color: #F6F6F6;" tabindex="7" 
                      placeholder="Pendidikan terakhir" value="<?PHP echo $arsql['pendidikan_terakhir']; ?>" <?PHP echo $Disabled; ?>>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="txtBornPlace">Tempat Lahir</label>
                    <input type="text" class="form-control" id="txtBornPlace" name="txtBornPlace" 
                      style="background-color: #F6F6F6;" 
                      placeholder="Tempat lahir" value="<?PHP echo $arsql['tempat_lahir']; ?>" <?PHP echo $Disabled; ?>>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="txtNIK">Nomor Identitas (KTP)</label>
                    <input type="text" class="form-control" id="txtNIK" name="txtNIK" 
                      style="background-color: #F6F6F6;" 
                      placeholder="Nomor identitas KTP" value="<?PHP echo $arsql['nik']; ?>" <?PHP echo $Disabled; ?>>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="txtBornDate">Tanggal Lahir</label>
                    <input type="text" class="form-control" id="txtBornDate" name="txtBornDate" 
                      style="background-color: #F6F6F6;" 
                      placeholder="Tanggal lahir" value="<?PHP echo $arsql['tanggal_lahir']; ?>" <?PHP echo $Disabled; ?>>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="txtNPWP">Nomor Pokok Wajib Pajak (NPWP)</label>
                    <input type="text" class="form-control" id="txtNPWP" name="txtNPWP" 
                      style="background-color: #F6F6F6;" 
                      placeholder="Nomor NPWP" value="<?PHP echo $arsql['npwp']; ?>" <?PHP echo $Disabled; ?>>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="cmbGender">Jenis Kelamin</label>
                    <input type="text" class="form-control" id="cmbGender" name="cmbGender" 
                      style="background-color: #F6F6F6;" 
                      placeholder="Jenis kelamin" value="<?PHP echo $arsql['jenis_kelamin']; ?>" <?PHP echo $Disabled; ?>>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="txtEmail">Alamat Email</label>
                    <input type="email" class="form-control" id="txtEmail" name="txtEmail" 
                      style="background-color: #F6F6F6;" 
                      placeholder="Alamat email" value="<?PHP echo $arsql['email']; ?>" <?PHP echo $Disabled; ?>>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="cmbMartial">Status Pernikahan</label>
                    <input type="text" class="form-control" id="cmbMartial" name="cmbMartial" 
                      style="background-color: #F6F6F6;" 
                      placeholder="Status pernikahan" value="<?PHP echo $arsql['status_perkawinan']; ?>" <?PHP echo $Disabled; ?>>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="txtPhone">Nomor Telepon</label>
                    <input type="text" class="form-control" id="txtPhone" name="txtPhone" 
                      style="background-color: #F6F6F6;" 
                      placeholder="nomor telepon" value="<?PHP echo $arsql['no_telepon']; ?>" <?PHP echo $Disabled; ?>>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="cmbReligion">Agama</label>
                    <input type="text" class="form-control" id="cmbReligion" name="cmbReligion" 
                      style="background-color: #F6F6F6;" 
                      placeholder="Agama" value="<?PHP echo $arsql['agama']; ?>" <?PHP echo $Disabled; ?>>
                  </div>
                </div>
              </div>

            </div>            
          </div>
        </div>
        <!-- End Data Debitur -->

        <!-- Start Data Pasangan -->
        <div class="row">          
          <div class="card col-sm-12 elevation-0 collapsed-card">
            <div class="card-header bg-lightgray" style="margin-top:-12px;" data-card-widget="collapse">
              <h3 class="card-title font-weight-bold text-lightblue" style="cursor:pointer;">
                <i class="far fa-circle mr-1"></i>Data Pasangan
              </h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-plus text-lightblue"></i>
                </button>
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="txtMartialName">Nama Pasangan</label>
                    <input type="text" class="form-control" id="txtMartialName" name="txtMartialName" 
                      style="background-color: #F6F6F6;" tabindex="0" 
                      placeholder="Nama lengkap pasangan" value="<?PHP echo $arsql['nama_pasangan']; ?>" <?PHP echo $Disabled; ?>>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="cmbMartialGraduate">Pendidikan Terakhir </label>
                    <input type="text" class="form-control" id="cmbMartialGraduate" name="cmbMartialGraduate" 
                      style="background-color: #F6F6F6;" tabindex="7" 
                      placeholder="Pendidikan terakhir pasangan" 
                      value="<?PHP echo $arsql['pendidikan_terakhir_pasangan']; ?>" <?PHP echo $Disabled; ?>>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="txtMartialBornPlace">Tempat Lahir </label>
                    <input type="text" class="form-control" id="txtMartialBornPlace" name="txtMartialBornPlace" 
                      style="background-color: #F6F6F6;" 
                      placeholder="Tempat lahir pasangan" 
                      value="<?PHP echo $arsql['tempat_lahir_pasangan']; ?>" <?PHP echo $Disabled; ?>>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="txtMartialNIK">Nomor Identitas (KTP) </label>
                    <input type="text" class="form-control" id="txtMartialNIK" name="txtMartialNIK" 
                      style="background-color: #F6F6F6;" 
                      placeholder="Nomor identitas KTP pasangan" 
                      value="<?PHP echo $arsql['nik_pasangan']; ?>" <?PHP echo $Disabled; ?>>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="txtMartialBornDate">Tanggal Lahir </label>
                    <input type="text" class="form-control" id="txtMartialBornDate" name="txtMartialBornDate" 
                      style="background-color: #F6F6F6;" 
                      placeholder="Tanggal lahir pasangan" 
                      value="<?PHP echo $arsql['tanggal_lahir_pasangan']; ?>" <?PHP echo $Disabled; ?>>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="txtMartialNPWP">Nomor Pokok Wajib Pajak (NPWP)</label>
                    <input type="text" class="form-control" id="txtMartialNPWP" name="txtMartialNPWP" 
                      style="background-color: #F6F6F6;" 
                      placeholder="Nomor NPWP pasangan" value="<?PHP echo $arsql['npwp_pasangan']; ?>" <?PHP echo $Disabled; ?>>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="cmbMartialGender">Jenis Kelamin </label>
                    <input type="text" class="form-control" id="cmbMartialGender" name="cmbMartialGender" 
                      style="background-color: #F6F6F6;" 
                      placeholder="Jenis kelamin pasangan" value="<?PHP echo $arsql['jenis_kelamin_pasangan']; ?>" 
                      <?PHP echo $Disabled; ?>>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="txtMartialEmail">Alamat Email </label>
                    <input type="email" class="form-control" id="txtMartialEmail" name="txtMartialEmail" 
                      style="background-color: #F6F6F6;" 
                      placeholder="Alamat email pasangan" 
                      value="<?PHP echo $arsql['email_pasangan']; ?>" <?PHP echo $Disabled; ?>>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="cmbMartialStatus">Status Pernikahan </label>
                    <input type="text" class="form-control" id="cmbMartialStatus" name="cmbMartialStatus" 
                      style="background-color: #F6F6F6;" 
                      placeholder="Status pernikahan pasangan" 
                      value="<?PHP echo $arsql['status_perkawinan_pasangan']; ?>" <?PHP echo $Disabled; ?>>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="txtMartialPhone">Nomor Telepon</label>
                    <input type="text" class="form-control" id="txtMartialPhone" name="txtMartialPhone" 
                      style="background-color: #F6F6F6;" 
                      placeholder="nomor telepon pasangan" 
                      value="<?PHP echo $arsql['no_telepon_pasangan']; ?>" <?PHP echo $Disabled; ?>>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="cmbMartialReligion">Agama</label>
                    <input type="text" class="form-control" id="cmbMartialReligion" name="cmbMartialReligion" 
                      style="background-color: #F6F6F6;" 
                      placeholder="Agama pasangan" value="<?PHP echo $arsql['agama_pasangan']; ?>" <?PHP echo $Disabled; ?>>
                  </div>
                </div>
              </div>

            </div>            
          </div>
        </div>
        <!-- End Data Pasangan -->

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

