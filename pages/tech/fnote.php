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
  $Table_Url = "pages/tech/tapply.php";
?>

<div class="tab-pane active" id="note">
  <!-- Start Form -->
  <div class="card-body p-0">

    <div class="row">
      <?PHP include_once("../component/fchat.php"); ?>
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

