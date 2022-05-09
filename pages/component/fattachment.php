<div class="col-12 col-lg-4">
  <div class="p-4 mb-3">
  <h5 class="text-muted font-weight-bold text-orange m-0">Attachment</h5>

  <ul class="list-unstyled" id="list-attachment">               
    <?PHP
      $sql_atc = "SELECT aa.attach_id,aa.data_id,aa.description,aa.attach_url,aa.data_update,gu.user_login 
        FROM apply_attach aa 
        LEFT JOIN gen_users gu ON aa.user_update = gu.user_id 
        WHERE aa.data_id = '$_GET[appid]' ORDER BY aa.data_update DESC";
      $xsql_atc = mysqli_query($koneksi, $sql_atc);
      while($arsql_atc = mysqli_fetch_array($xsql_atc)){
        $attach_url =  $arsql_atc['attach_url'];
        ?>
        <span class="badge bg-lightblue text-info mr-2">
          <a href="<?PHP echo $attach_url; ?>" class="btn-link" target="_blank" >
            <?PHP
              $exp_file = explode(".",$arsql_atc['attach_url']);
              $extension = $exp_file[2];
              if ($extension == "jpg" or $extension == "jpeg" or $extension == "png"){
                $icon_file = "far fa-fw fa-image";
              } 
              else if ($extension == "pdf"){
                $icon_file = "far fa-fw fa-file-pdf";
              }
              else if ($extension == "wav"){
                $icon_file = "far fa-fw fa-microphone";
              }
              else{
                $icon_file = "far fa-fw fa-file";
              }
            ?>
            <i class="<?PHP //echo $icon_file; ?>"></i> 
            <?PHP echo $arsql_atc['description']; ?>
          </a>
        </span>
        <?PHP
      }
    ?>
  </ul>
</div>
</div>