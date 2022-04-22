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

  $Parent_Url = "pages/user/tuser.php";
  $Form_Url = "pages/user/fuser.php";
  $Form_Url_Add = $Form_Url."?page=add";
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a onClick="javascript:load_right('<?PHP echo $Home_Url; ?>')" style="cursor: pointer;" >Home</a></li>
          <li class="breadcrumb-item active"><a onClick="javascript:load_right('<?PHP echo $Parent_Url; ?>')" style="cursor: pointer;" >Users</a></li>
        </ol>
      </div>     
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="container-fluid">
    <div class="card card-lightblue card-outline" style="border-radius:10px;">
      <div class="card-header">
        <h2 class="card-title text-navy text-uppercase font-weight-bold"><i class="fa fa-th mr-2 text-navy"></i>
          Result Query
        </h2>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-striped table-hover">
          <thead>
            <tr class="text-uppercase">
              <tr>
                <th>ID</th>
                <th>Nama Lengkap</th>
                <th>Apply Date</th>
                <th>Product</th>
                <th>PIC</th>
                <th>Status</th>
                <th>Panel</th>
              </tr>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="7">No Data</td>
            </tr>
          </tbody>
        </table>

        <div class="spinner" style="display: none;" align="center">
          <img id="img-spinner" src="spiner.gif" style="width: 30px; height: 30px;" title="Process" >
        </div>

      </div>
      <!-- /.card-body -->
    </div>
  </div>
</section>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

