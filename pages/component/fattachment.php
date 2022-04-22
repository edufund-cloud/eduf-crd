<div class="col-12 col-lg-4">
  <div class="col-12">
    <div class="form-group">
      <button type="button" class="btn btn-success btn-sm mb-4 float-right" style="margin-right: 5px; border-radius: 3px;"
        onclick="javascript:load_right('tattachment.php?dtid=<?PHP echo $data_id; ?>');">
        <i class="fa fa-paperclip mr-1"></i>Attacment
      </button>
      <?PHP
        $sql_img = "SELECT aa.attach_id,aa.data_id,aa.description,aa.attach_url,aa.data_update,gu.user_login 
          FROM apply_attach aa 
          LEFT JOIN gen_users gu ON aa.user_update = gu.user_id 
          WHERE aa.data_id = '$_GET[appid]' ORDER BY aa.attach_id ASC LIMIT 0,1";
        $xsql_img = mysqli_query($koneksi, $sql_img);
        $arsql_img = mysqli_fetch_array($xsql_img);
      ?>
      <img src="<?PHP echo $arsql_img['attach_url']; ?>" class="product-image" alt="Attach Image" 
        style="border-radius: 10px; border:solid thin lightgray;">
    </div>
  </div>        
  <div class="col-12 product-image-thumbs ml-2">
    <?PHP
      $sql_atc = "SELECT aa.attach_id,aa.data_id,aa.description,aa.attach_url,aa.data_update,gu.user_login 
        FROM apply_attach aa 
        LEFT JOIN gen_users gu ON aa.user_update = gu.user_id 
        WHERE aa.data_id = '$_GET[appid]' ORDER BY aa.attach_id ASC";
      $xsql_atc = mysqli_query($koneksi, $sql_atc);
      $img_active = "active";
      while($arsql_atc = mysqli_fetch_array($xsql_atc)){
        ?>
        <div class="product-image-thumb" <?PHP echo $img_active; ?> >
          <img src="<?PHP echo $arsql_atc['attach_url']; ?>" alt="Attach Image">
        </div>
        <?PHP
        $img_active = "";
      }
    ?>
  </div>
</div>