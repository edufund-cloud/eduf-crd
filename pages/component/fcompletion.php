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
    $sql = "SELECT a.data_id,a.ID,a.full_name,a.apply_date,
      a.product,a.pic,a.data_status,a.data_active 
      FROM apply a 
      WHERE a.data_id = '$_GET[appid]'";
    $xsql = mysqli_query($koneksi,$sql);
    $arsql = mysqli_fetch_array($xsql);

    $Full_Name = $arsql['full_name'];
    $Product = $arsql['product'];
    $Status_Data = $arsql['data_status'];
  }
?>

<div class="tab-pane" id="completion">
  <!-- Start Form -->
  <div class="card-body">

    <div class="row">
      <div class="col-12 col-lg-12">
        
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtID">ID</label>
              <input type="text" class="form-control" id="txtID" name="txtID" required 
                style="background-color: #F6F6F6;" 
                placeholder="ID Debitur" value="<?PHP echo $arsql['ID']; ?>" 
                disabled>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtProduct">Product</label>
              <input type="text" class="form-control" id="txtProduct" name="txtProduct" 
                style="background-color: #F6F6F6;" 
                placeholder="Produk" value="<?PHP echo $arsql['Product']; ?>" disabled >
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtFullName">Full Name</label>
              <label class="badge bg-lightblue" style="margin-left: 10px;"> Skip</label>
              <input type="text" class="form-control" id="txtFullName" name="txtFullName" 
                style="background-color: #F6F6F6;" 
                placeholder="Nama lengkap" value="<?PHP echo $arsql['full_name']; ?>" disabled>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtPic">PIC</label>
              <input type="text" value="<?PHP echo $arsql['pic']; ?>" id="txtPic" name="txtPic"
                class="form-control" style="background-color: #F6F6F6;" disabled >           
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtApplyDate">Apply Date</label>
              <input type="date" class="form-control datetimepicker-input" 
                style="background-color: #F6F6F6;" 
                id="txtApplyDate" name="txtApplyDate" placeholder="Tanggal apply" 
                value="<?PHP echo $arsql['apply_date']; ?>" disabled />
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtStatus">Data Status</label>
              <label class="badge bg-lightblue" style="margin-left: 10px;"> Skip</label>
              <input type="text" class="form-control" id="txtStatus" name="txtStatus" 
                style="background-color: #F6F6F6;" 
                placeholder="Data status" value="<?PHP echo $arsql['data_status']; ?>" disabled="disabled" >
              <small class="text-muted font-italic">
                Note: Please skip this field.
              </small>
            </div>
          </div>
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