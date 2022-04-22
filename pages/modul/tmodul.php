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
  $Parent_Url = "pages/modul/tmodul.php";
  $Form_Url = "pages/modul/fmodul.php";
  $Form_Url_Add = $Form_Url."?page=add";  
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a onClick="javascript:load_right('<?PHP echo $Home_Url; ?>')" style="cursor: pointer;" >Home</a></li>
          <li class="breadcrumb-item active">Modul</li>
        </ol>
      </div>
      <div class="col-sm-6">
        <div class="float-sm-right">
          <button type="button" class="btn btn-success mr-2" onclick="javascript:load_right('<?PHP echo $Form_Url_Add; ?>');">
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
        <h3 class="card-title text-navy text-uppercase font-weight-bold"><i class="fa fa-list mr-2"></i>Modul</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-striped table-hover">
          <thead>
          <tr>
            <th>Parent</th>
            <th>Modul Name</th>
            <th>Description</th>
            <th>Target</th>
            <th>Order</th>
            <th>Status</th>
            <th>Data Update</th>
            <th>Panel</th>
          </tr>
          </thead>
          <tbody>
            <?PHP
              if ($user_level != "root"){
                $Kondisi = "AND gu.user_level <> 'root'";
              }
              $sql = "SELECT gm.menu_id,gm.menu_title,gm.menu_description,gm.menu_order,gm.menu_icon,gm.menu_target,
                DATE_FORMAT(gm.data_create,'%d %b %Y %r') AS data_create,
                DATE_FORMAT(gm.data_update,'%d %b %Y %r') AS data_update,gm.data_active,
                gp.menu_title AS menu_parent,gu.user_login AS admin  
                FROM gen_menu gm  
                LEFT JOIN gen_menu gp ON gm.parent_id = gp.menu_id 
                LEFT JOIN gen_users gu ON gm.user_update = gu.user_id
                WHERE gm.menu_id > 0  
                ORDER BY gm.parent_id,gm.menu_id ASC";
              //echo $sql;
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
                $Form_Url_Update  = $Form_Url."?page=update&mnuid=".$arsql['menu_id'];
                $Form_Url_Delete  = $Form_Url."?page=delete&mnuid=".$arsql['menu_id'];
                ?>
                <tr ondblclick="javascript:load_right('<?PHP echo $Form_Url_Update; ?>');" style="cursor: pointer;">                  
                  <td><?PHP echo $arsql['menu_parent']; ?></td>
                  <td><?PHP echo $arsql['menu_title']; ?></td>
                  <td><?PHP echo $arsql['menu_description']; ?></td>
                  <td><?PHP echo $arsql['menu_target']; ?></td>
                  <td><?PHP echo $arsql['menu_order']; ?></td>
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
                      <button type="button" class="btn btn-danger btn-xs" style="margin-right: 5px; border-radius: 5px;"
                        onclick="javascript:load_right('<?PHP echo $Form_Url_Delete; ?>');"><i class="fa fa-trash-alt mr-1"></i>Delete</button>
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