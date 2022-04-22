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

  $Parent_Url = "pages/group/tgroup.php";
  $Form_Url = "pages/group/fgroup.php";
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
      <div class="col-sm-6">
        <div class="float-sm-right">
          <button type="button" class="btn btn-success mr-2" onClick="javascript:load_right('<?PHP echo $Form_Url_Add; ?>');">
            <i class="fa fa-plus-circle menu-icon mr-1"></i>
            Add New
          </button>
        </div>
      </div>      
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="container-fluid">
    <div class="card card-lightblue card-outline" style="border-radius:10px;">
      <div class="card-header">
        <h2 class="card-title text-navy text-uppercase font-weight-bold"><i class="fa fa-flag mr-2 text-navy"></i>
          Group User
        </h2>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-striped table-hover">
          <thead>
          <tr class="text-uppercase">
            <th>Description</th>
            <th>Data Active</th>
            <th>Data Update</th>
            <th>Panels</th>
          </tr>
          </thead>
          <tbody>
            <?PHP
              $sql = "SELECT gg.group_id,gg.description,gg.data_active,
                DATE_FORMAT(gg.data_create,'%d %b %Y %r') AS data_create,
                DATE_FORMAT(gg.data_update,'%d %b %Y %r') AS data_update,gn.user_login AS admin  
                FROM gen_group gg 
                LEFT JOIN gen_users gn ON gg.user_update = gn.user_id 
                WHERE gg.group_id > 0";
              $xsql = mysqli_query($koneksi,$sql);
              $no =1;
              while($arsql = mysqli_fetch_array($xsql)){
                if ($arsql['data_active'] == "1"){
                  $Class_Active = "badge badge-primary" ;
                  $Label_Active = "Active";
                }
                else{
                  $Class_Active = "badge badge-danger" ;
                  $Label_Active = "Non-Active";
                }
                $Form_Url_Update  = $Form_Url."?page=update&grpid=".$arsql['group_id'];
                $Form_Url_Delete  = $Form_Url."?page=delete&grpid=".$arsql['group_id'];
                ?>
                <tr ondblclick="javascript:load_right('<?PHP echo $Form_Url_Update; ?>');" style="cursor: pointer;">
                  <td><?PHP echo $arsql['description']; ?></td>
                  <td>
                    <label class="<?PHP echo $Class_Active; ?>"><?PHP echo $Label_Active; ?></label>
                  </td>
                  <td>
                    <span style="font-style: italic;">
                    <?PHP echo $arsql['data_update']."  "; ?>
                    <?PHP echo $arsql['admin']; ?>
                    </span>
                  </td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-success btn-xs" style="margin-right: 5px; border-radius: 5px;"
                        onclick="javascript:load_right('<?PHP echo $Form_Url_Update; ?>');"><i class="fa fa-edit mr-1"></i>Update</button>
                    </div>
                  </td>
                </tr>

                <?PHP
                $no++;
              }              
            ?>
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

