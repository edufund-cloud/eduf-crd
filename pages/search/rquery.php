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
  $Parent_Url = "pages/search/squery.php";

  extract($_GET);
?>
<section class="content">
  <div>
    <div class="card">
      <!-- /.card-header -->
      <div class="card-body">
        <div class="col-lg-2 float-sm-right">
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
              $sql_id = "SELECT ap.nik,ap.nik_pasangan,ap.no_telepon,ap.no_telepon_pasangan 
                FROM apply a 
                LEFT JOIN apply_personal ap ON a.data_id = ap.data_id 
                WHERE a.ID = '$txt_id'";
              //echo $sql_id;
              $xsql_id = mysqli_query($koneksi,$sql_id);
              $arsql_id = mysqli_fetch_array($xsql_id);

              $nik = $arsql_id['nik'];
              $nik_pasangan = $arsql_id['nik_pasangan'];
              $no_telepon = $arsql_id['no_telepon'];
              $no_telepon_pasangan = $arsql_id['no_telepon_pasangan'];

              //Persamaan NIK
              if ($chk_id_reject == "1" and $nik != ""){
                ?>
                <tr class="bg-lightblue">
                  <th colspan="5">NIK ada di list reject</th>
                </tr>
                <?PHP
                  $sql = "SELECT a.data_id,a.ID,a.full_name, 
                    DATE_FORMAT(a.apply_date,'%d %M %Y') AS apply_date,
                    a.product,a.pic,a.data_status,a.data_active,
                    DATE_FORMAT(a.data_update,'%d %b %Y %r') AS data_update  
                    FROM apply a 
                    LEFT JOIN apply_personal ap ON a.data_id = ap.data_id
                    WHERE a.data_status = 'Rejected' AND a.ID <> '$txt_id' 
                    AND (ap.nik = '$nik' OR ap.nik_pasangan = '$nik') 
                    ORDER BY a.apply_date,a.data_update DESC";
                  //echo $sql;
                  $xsql = mysqli_query($koneksi,$sql);
                  $nmsql = mysqli_num_rows($xsql);

                  if ($nmsql > 0){
                    while($arsql = mysqli_fetch_array($xsql)){
                      ?>
                      <tr>
                        <td><?PHP echo $arsql['ID']; ?></td>
                        <td><?PHP echo $arsql['full_name']; ?></td>
                        <td><?PHP echo $arsql['apply_date']; ?></td>
                        <td><?PHP echo $arsql['product']; ?></td>                  
                        <td><?PHP echo $arsql['data_status']; ?></td>
                      </tr>
                      <?PHP
                    }
                  }
                  else{
                    ?>
                    <tr><td colspan="5">Tidak ditemukan data</td></tr>
                    <?PHP
                  }
              }

              //Persamaan NIK Pasangan
              if ($chk_id_pasangan_reject == "1" and $nik_pasangan != ""){
                ?>
                <tr class="bg-lightblue">
                  <th colspan="5">NIK pasangan ada di list reject</th>
                </tr>
                 <?PHP
                  $sql = "SELECT a.data_id,a.ID,a.full_name, 
                    DATE_FORMAT(a.apply_date,'%d %M %Y') AS apply_date,
                    a.product,a.pic,a.data_status,a.data_active,
                    DATE_FORMAT(a.data_update,'%d %b %Y %r') AS data_update  
                    FROM apply a 
                    LEFT JOIN apply_personal ap ON a.data_id = ap.data_id
                    WHERE a.data_status = 'Rejected' AND a.ID <> '$txt_id' 
                    AND (ap.nik_pasangan = '$nik_pasangan' OR ap.nik = '$nik_pasangan') 
                    ORDER BY a.apply_date,a.data_update DESC";
                  //echo $sql_nik;
                  $xsql = mysqli_query($koneksi,$sql);
                  $nmsql = mysqli_num_rows($xsql);

                  if ($nmsql > 0){
                    while($arsql = mysqli_fetch_array($xsql)){
                      ?>
                      <tr>
                        <td><?PHP echo $arsql['ID']; ?></td>
                        <td><?PHP echo $arsql['full_name']; ?></td>
                        <td><?PHP echo $arsql['apply_date']; ?></td>
                        <td><?PHP echo $arsql['product']; ?></td>                  
                        <td><?PHP echo $arsql['data_status']; ?></td>
                      </tr>
                      <?PHP
                    }
                  }
                  else{
                    ?>
                    <tr><td colspan="5">Tidak ditemukan data</td></tr>
                    <?PHP
                  }
              }

              //Persamaan No Telepon
              if ($chk_phone_reject == "1" && $no_telepon != ""){
                ?>
                <tr class="bg-lightblue">
                  <th colspan="5">No Telepon ada di list reject</th>
                </tr>
                 <?PHP
                  $sql = "SELECT a.data_id,a.ID,a.full_name, 
                    DATE_FORMAT(a.apply_date,'%d %M %Y') AS apply_date,
                    a.product,a.pic,a.data_status,a.data_active,
                    DATE_FORMAT(a.data_update,'%d %b %Y %r') AS data_update  
                    FROM apply a 
                    LEFT JOIN apply_personal ap ON a.data_id = ap.data_id
                    WHERE a.data_status = 'Rejected' AND a.ID <> '$txt_id' 
                    AND (ap.no_telepon = '$no_telepon' OR ap.no_telepon_pasangan = '$no_telepon') 
                    ORDER BY a.apply_date,a.data_update DESC";
                  //echo $sql_nik;
                  $xsql = mysqli_query($koneksi,$sql);
                  $nmsql = mysqli_num_rows($xsql);

                  if ($nmsql > 0){
                    while($arsql = mysqli_fetch_array($xsql)){
                      ?>
                      <tr>
                        <td><?PHP echo $arsql['ID']; ?></td>
                        <td><?PHP echo $arsql['full_name']; ?></td>
                        <td><?PHP echo $arsql['apply_date']; ?></td>
                        <td><?PHP echo $arsql['product']; ?></td>                  
                        <td><?PHP echo $arsql['data_status']; ?></td>
                      </tr>
                      <?PHP
                    }
                  }
                  else{
                    ?>
                    <tr><td colspan="5">Tidak ditemukan data</td></tr>
                    <?PHP
                  }
              }

              //Persamaan No Telepon Pasangan
              if ($chk_phone_pasangan_reject == "phone_pasangan" and $no_telepon_pasangan != ""){
                ?>
                <tr class="bg-lightblue">
                  <th colspan="5">No Telepon pasangan ada di list reject</th>
                </tr>
                 <?PHP
                  $sql = "SELECT a.data_id,a.ID,a.full_name, 
                    DATE_FORMAT(a.apply_date,'%d %M %Y') AS apply_date,
                    a.product,a.pic,a.data_status,a.data_active,
                    DATE_FORMAT(a.data_update,'%d %b %Y %r') AS data_update  
                    FROM apply a 
                    LEFT JOIN apply_personal ap ON a.data_id = ap.data_id
                    WHERE a.data_status = 'Rejected' AND a.ID <> '$txt_id' 
                    AND (ap.no_telepon_pasangan = '$no_telepon_pasangan' OR ap.no_telepon = '$no_telepon_pasangan') 
                    ORDER BY a.apply_date,a.data_update DESC";
                  //echo $sql_nik;
                  $xsql = mysqli_query($koneksi,$sql);
                  $nmsql = mysqli_num_rows($xsql);

                  if ($nmsql > 0){
                    while($arsql = mysqli_fetch_array($xsql)){
                      ?>
                      <tr>
                        <td><?PHP echo $arsql['ID']; ?></td>
                        <td><?PHP echo $arsql['full_name']; ?></td>
                        <td><?PHP echo $arsql['apply_date']; ?></td>
                        <td><?PHP echo $arsql['product']; ?></td>                  
                        <td><?PHP echo $arsql['data_status']; ?></td>
                      </tr>
                      <?PHP
                    }
                  }
                  else{
                    ?>
                    <tr><td colspan="5">Tidak ditemukan data</td></tr>
                    <?PHP
                  }
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