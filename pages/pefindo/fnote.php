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
  $Table_Url = "pages/pefindo/tapply.php";
?>

<div class="active tab-pane" id="note">
  <!-- Start Form -->
  <div class="card-body p-0">

    <div class="row">
      <?PHP include_once("../component/fchat.php"); ?>

      <div class="col-12 col-md-12 col-lg-6 order-1">
        <div class="row">
          <div class="col-md-12">            

            <?PHP include_once("../../pages/component/fnote_attach.php"); ?>

          </div>
        </div>

        <div class="p-4 mb-3" style="border-style:dashed; border-width: thin; border-radius: 15px; border-color: grey;">
          <form role="form" name="finput" id="myForm" method="post" action="<?PHP echo $Action; ?>" >
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <h5 for="label_note" class="text-muted font-weight-bold text-orange">Tambah Note</h5>
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
                    <div class="icheck-primary d-inline mr-4">
                      <input type="radio" name="rdoStatus" id="rdoStatus1" value="Pefindo Done">
                      <label for="rdoStatus1" class="font-weight-normal" >
                        Pefindo Done 
                      </label>
                    </div>
                    <div class="icheck-danger d-inline mr-2">
                      <input type="radio" name="rdoStatus" id="rdoStatus2" value="Rejected">
                      <label for="rdoStatus2" class="font-weight-normal">
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
          </form>
        </div>
        
      </div>
    </div>
  </div>
  <!-- End Form -->

  <div class="spinner" style="display: none;" align="center">
    <img id="img-spinner" src="spiner.gif" style="width: 30px; height: 30px;" title="Process" >
  </div>
</div>

<!-- Summernote -->
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>

