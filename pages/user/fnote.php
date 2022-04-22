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
?>

<div class="tab-pane" id="note">
  <!-- Start Form -->
  <div class="card-body">

    <div class="row">
      <div class="col-12 col-sm-12">
        
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label for="txtNamaKontak">Status Aplikasi</label>
              <select class="custom-select" style="width: 100%;" 
                    name="cmbSysLevel" <?PHP echo $Disabled; ?>>
                    <option value="0">- Pilih -</option>
                    <option value="Check Borrower" <?PHP if ($arsql['Check Borrower'] == "Check Borrower"){ echo"selected"; } ?> >Check Borrower</option>
                    <option value="PV Process" <?PHP if ($arsql['user_level'] == "PV Process"){ echo"selected"; } ?> >PV Process</option>
                    <option value="Incomplete" <?PHP if ($arsql['user_level'] == "Incomplete"){ echo"selected"; } ?> >Incomplete</option>
                    <option value="Reject" <?PHP if ($arsql['user_level'] == "Reject"){ echo"selected"; } ?> >Reject</option>
                    ?>
                  </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label for="txtTeleponKontak">Note</label>
              <textarea class="form-control" rows="10"></textarea>
            </div>
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
</div>

