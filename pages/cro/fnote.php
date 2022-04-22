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
  $Table_Url = "pages/cro/tapply.php";
?>

<div class="tab-pane" id="note">
  <!-- Start Form -->
  <div class="card-body">

    <div class="row">
      <?PHP include_once("../component/fchat.php"); ?>

      <div class="col-12 col-md-12 col-lg-5 order-1 order-md-2">
        <div class="row">
          <div class="col-md-12">
            <h4 class="text-muted">Attachment</h4>
            <ul class="list-unstyled">
              <?PHP
                $sql_atc = "SELECT aa.attach_id,aa.data_id,aa.description,aa.attach_url,aa.data_update,gu.user_login 
                  FROM apply_attach aa 
                  LEFT JOIN gen_users gu ON aa.user_update = gu.user_id 
                  WHERE aa.data_id = '$_GET[appid]'";
                $xsql_atc = mysqli_query($koneksi, $sql_atc);
                while($arsql_atc = mysqli_fetch_array($xsql_atc)){
                  ?>
                  <li>
                    <a href="<?PHP echo $arsql_atc['attach_url']; ?>" class="btn-link text-secondary" target="_blank">
                      <?PHP
                        $exp_file = explode(".",$arsql_atc['attach_url']);
                        $extension = $exp_file[2];
                        if ($extension == "jpg" or $extension == "jpeg" or $extension == "png"){
                          $icon_file = "far fa-fw fa-image";
                        } 
                        else if ($extension == "pdf"){
                          $icon_file = "far fa-fw fa-file-pdf";
                        }
                        else{
                          $icon_file = "far fa-fw fa-file";
                        }
                      ?>
                      <i class="<?PHP echo $icon_file; ?>"></i> 
                      <?PHP echo $arsql_atc['description']; ?>
                    </a>
                  </li>
                  <?PHP
                }
              ?>
            </ul>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <h4 for="txtTeleponKontak" class="text-muted">Note</h4>
              <textarea class="textarea" placeholder="Place some text here" name="txtNote" 
                style="width: 100%; height: 400px; font-size: 14px; 
                line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>
          </div>
        </div>

        <div class="row mt-2">
          <div class="col-sm-12">
            <div class="form-group">              
              <label for="txtNamaKontak">Status</label>
              <input type="text" name="txtKeyRadio" value="1" hidden>
              <div class="form-group clearfix">
                <div class="icheck-info d-inline mr-3">
                  <input type="radio" name="rdoStatus" id="rdoStatus1" value="Recommended CRO">
                  <label for="rdoStatus1" class="font-weight-normal" >
                    Recommended 
                  </label>
                </div>
                <div class="icheck-info d-inline mr-3">
                  <input type="radio" name="rdoStatus" id="rdoStatus2" value="Send Back Analyst">
                  <label for="rdoStatus2" class="font-weight-normal">
                    Send Back Analyst
                  </label>
                </div>
                <div class="icheck-info d-inline mr-3">
                  <input type="radio" name="rdoStatus" id="rdoStatus3" value="Rejected">
                  <label for="rdoStatus3" class="font-weight-normal">
                    Rejected
                  </label>
                </div>
              </div>                    
            </div>
          </div>
        </div>

        <div class="text-center mt-5 mb-3">
          <button type="button" class="btn btn-sm btn-default" onClick="javascript:load_right('<?PHP echo $Parent_Url; ?>')">
            <i class="fa fa-arrow-alt-circle-left menu-icon mr-1"></i> Cancel</button>

          <button type="submit" class="btn btn-sm <?PHP echo $Btn_color; ?>"> 
            <i class="fas fa-edit menu-icon mr-1"></i> Submit</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End Form -->

  <div class="card-body">
    <div class="alert <?PHP echo $Alert_bg; ?> alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h6><i class="fa <?PHP echo $Alert_icon ?>"></i> <?PHP echo $Alert_head; ?></h6>
      <small><?PHP echo $Alert; ?></small>
    </div>
  </div>            

  <div class="modal-footer justify-content-between">
    <div class="spinner" style="display: none;" align="center">
      <img id="img-spinner" src="spiner.gif" style="width: 30px; height: 30px;" title="Process" >
    </div>
  </div>
</div>

<!-- Summernote -->
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>

