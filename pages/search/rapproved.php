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
  $Parent_Url = "pages/search/sapproved.php";

  extract($_GET);
?>
<section class="content">
  <div>
    <div class="card">
      <!-- /.card-header -->
      <div class="card-body">
        <div class="col-lg-2 float-sm-right">
          <?PHP
            $url_download = "download/csv-approved.php?start_date=".$txtStartDate."&end_date=".$txtEndDate;
          ?>
          <a href="<?PHP echo $url_download; ?>" target="_blank" class="btn btn-block btn-outline-success">
            <i class="fas fa-file-excel mr-2"></i><span style="font-size:16px;">Download</span>
          </a>
        </div>
        <table id="example1" class="table table-striped table-hover">
          <thead>
          <tr>
            <th>ID</th>
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
                gu.user_login AS admin  
                FROM apply a 
                LEFT JOIN gen_users gu ON a.user_update = gu.user_id
                WHERE a.data_status = 'Approved' AND a.data_update BETWEEN '$txtStartDate' AND '$txtEndDate' 
                ORDER BY a.apply_date,a.data_update DESC";
              //echo $sql;
              $xsql = mysqli_query($koneksi,$sql);
              $no =1;
              while($arsql = mysqli_fetch_array($xsql)){
                ?>
                <tr style="cursor: pointer;">
                  <td><?PHP echo $arsql['ID']; ?></td>
                  <td><?PHP echo $arsql['full_name']; ?></td>
                  <td><?PHP echo $arsql['apply_date']; ?></td>
                  <td><?PHP echo $arsql['product']; ?></td>                  
                  <td>
                    <?PHP echo $arsql['data_status']; ?></label>
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
      "responsive": false,
      "autoWidth": false,
      "searching": false,
      "paging": true,
      "scrollX": true,
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