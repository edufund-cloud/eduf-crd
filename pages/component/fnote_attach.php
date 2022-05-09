<!-- Form Upload -->
<div class="p-4 mb-3" id="list_lampiran" 
  style="border-style:dashed; border-width: thin; border-radius: 15px; border-color: grey;">
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
        <small class="badge bg-lightblue font-italic text-info mr-2">
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
            <i class="<?PHP echo $icon_file; ?>"></i> 
            <?PHP echo $arsql_atc['description']; ?>
          </a>
        </small>
        <?PHP
      }
    ?>
  </ul>
</div>

<div class="p-4 mb-3" style="border-style:dashed; border-width: thin; border-radius: 15px; border-color: grey;">    
  <h5 class="text-muted font-weight-bold text-orange">Tambah Attachment</h5>
  <form id="form-data">
    <div class="form-group">
        <input type="text" name="txt_title" id="txt_title" class="form-control"  placeholder="File title" required />
        <input type="hidden" name="txt_id" id="txt_id" class="form-control" value="<?PHP echo $_GET['appid']; ?>" />
    </div>

    <div class="form-group">
      <div class="btn btn-default btn-file row ml-1">
        <i class="fas fa-paperclip"></i> Pilih Attachment
        <input type="file" id="fileupload" name="fileupload" required>
      </div>
      <p class="help-block ml-1">Max. 15MB</p>
    </div>

    <div class="text-left ml-1">
      <button type="button" name="upload" id="upload" class="btn btn-sm bg-pink"> 
        <i class="fas fa-edit menu-icon mr-1"></i> Upload</button>
    </div>
  </form>
</div>
<!-- END Form upload -->

<script>
  $(document).ready( function () {
    $("#upload").click(function(){
      const fileupload = $('#fileupload').prop('files')[0];
      var txt_title = $('#txt_title').val();
      var txt_id = $('#txt_id').val();

      if (txt_id!="" && txt_title!="" && fileupload!="") {
        var formData = new FormData();
        formData.append('txt_id', txt_id);        
        formData.append('txt_title', txt_title);
        formData.append('fileupload', fileupload);

        $.ajax({
          url : 'pages/component/xnote_attach.php',
          type: 'POST',
          data: formData,
          cache: false,
          processData: false,
          contentType: false,
          success: function (msg) {
              alert(msg);
              //$("#list_lampiran").load('<?PHP echo $Parent_Url; ?>');
              document.getElementById("form-data").reset();
          },
          error: function () {
              alert("-Data Gagal Diupload-");
          }
        });
      }
    });
  });
</script>