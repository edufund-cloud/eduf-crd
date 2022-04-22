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
  $Parent_Url = "pages/mis/tapply.php";
  $Form_Url = "pages/mis/fapply.php";
  $Form_Url_Add = $Form_Url."?page=add";  
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a onClick="javascript:load_right('<?PHP echo $Home_Url; ?>')" style="cursor: pointer;" >Home</a></li>
          <li class="breadcrumb-item active">Credit - Data Center</li>
        </ol>
      </div>     
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="container-fluid">
    <div class="card card-lightblue card-outline" style="border-radius:12px;">
      <div class="card-header">
        <h3 class="card-title text-navy text-capitalize font-weight-bold"><i class="fa fa-list mr-2"></i>Credit - Data center</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-striped table-hover">
          <thead>
          <tr>
            <th>ID</th>
            <th>NIK</th>
            <th>Nama Lengkap</th>
            <th>Apply Date</th>
            <th>Product</th>
            <th>Status</th>
          </tr>
          </thead>
          <tbody>
            <?PHP
              $sql = "SELECT a.data_id,a.ID,a.full_name, 
                DATE_FORMAT(a.apply_date,'%d %M %Y') AS apply_date,
                a.product,a.pic,a.data_status,a.data_active,
                DATE_FORMAT(a.data_update,'%d %b %Y %r') AS data_update, 
                ap.nik 
                FROM apply a 
                LEFT JOIN apply_personal ap ON ap.data_id = a.data_id 
                WHERE a.data_id > 0  
                ORDER BY a.apply_date DESC";
              //echo $sql;
              $xsql = mysqli_query($koneksi,$sql);
              $no =1;
              while($arsql = mysqli_fetch_array($xsql)){
                //Bucket Pefindo
                if ($arsql['data_status'] == "New Loan"){
                  $Class_Status = "badge badge-secondary" ;
                  $Label_Status = "Pefindo";
                }

                //Bucket PV
                else if ($arsql['data_status'] == "Pefindo Done"){
                  $Class_Status = "badge badge-info" ;
                  $Label_Status = "PV";
                }                
                else if ($arsql['data_status'] == "Pending PV" or $arsql['data_status'] == "Send Back PV"){
                  $Class_Status = "badge bg-orange" ;
                  $Label_Status = "PV";
                } 

                //Bucket Analyst
                else if ($arsql['data_status'] == "PV Done"){
                  $Class_Status = "badge badge-info" ;
                  $Label_Status = "Analyst";
                }
                else if ($arsql['data_status'] == "Send Back Analyst"){
                  $Class_Status = "badge bg-orange" ;
                  $Label_Status = "Analyst";
                }

                //Bucket CRO
                else if ($arsql['data_status'] == "Recommended Analyst"){
                  $Class_Status = "badge badge-info" ;
                  $Label_Status = "CRO";
                }
                else if ($arsql['data_status'] == "Send Back CEO"){
                  $Class_Status = "badge bg-orange" ;
                  $Label_Status = "CRO";
                }

                //Bucket CEO
                else if ($arsql['data_status'] == "Recommended CRO"){
                  $Class_Status = "badge bg-info" ;
                  $Label_Status = "CEO";
                }
                else if ($arsql['data_status'] == "Approved"){
                  $Class_Status = "badge badge-primary" ;
                  $Label_Status = "Approved";
                }

                //Bucket Reject
                else if ($arsql['data_status'] == "Rejected"){
                  $Class_Status = "badge badge-danger" ;
                  $Label_Status = "Rejected";
                }

                $Form_Url_Update  = $Form_Url."?page=update&appid=".$arsql['data_id'];
                $Form_Url_Delete  = $Form_Url."?page=delete&appid=".$arsql['data_id'];
                ?>
                <tr style="cursor: pointer;">
                  <td>
                    <span class="text-uppercase font-weight-bold text-primary"><?PHP echo $arsql['ID']; ?></span> 
                  </td>
                  <td><?PHP echo $arsql['nik']; ?></td>
                  <td><?PHP echo $arsql['full_name']; ?></td>
                  <td><?PHP echo $arsql['apply_date']; ?></td>
                  <td><?PHP echo $arsql['product']; ?></td>
                  <td>
                    <label class="<?PHP echo $Class_Status; ?>"><?PHP echo $Label_Status; ?></label>
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