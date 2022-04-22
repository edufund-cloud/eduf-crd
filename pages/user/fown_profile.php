<?PHP
  require_once("../../config/session.php");
  require_once("../../config/database.php");
  require_once("../../com/home_map.php");

  $Parent_Url = "pages/user/fown_profile.php";

  $sql = "SELECT go.meta_id,go.meta_key,go.meta_value 
    FROM gen_usermeta go
    WHERE go.user_id = '$user_id' 
    ORDER BY go.meta_id ASC";
  $xsql = mysqli_query($koneksi,$sql);
  while($arsql = mysqli_fetch_array($xsql)){
    $meta_key = $arsql['meta_key'];
    switch ($meta_key) {
      case 'first_name':
        $First_Name = $arsql['meta_value'];
      break;
      
      case 'last_name':
        $Last_Name = $arsql['meta_value'];
      break;

      case 'user_phone':
        $Phone = $arsql['meta_value'];
      break;

      case 'user_biography':
        $Biography_Info = $arsql['meta_value'];
      break;

      case 'user_picture':
        $Picture_Url = $arsql['meta_value'];
      break;
    }
  }

  if ($nmsql < 1){
      $Action     = "pages/user/xuser.php?act=updprf&usrid=$user_id";
      $Head_bg    = "card-lightblue card-outline";      
      $Head_label = "Profil Pengguna <small><i>(Informasi Profil)</i></small>";
      $Head_icon  = "fa-edit";
      $Btn_label  = "Submit";
      $Btn_color  = "btn-success";
      $Btn_icon   = "fa-edit";
      $Disabled   = "";
      $Alert_bg   = "alert-warning";
      $Alert_head = "Info!";
      $Alert_icon = "fa-info-circle";
      $Alert      = "Make sure the data has been filled in correctly.
        <br>If unchecked active data field, the data will not be display in other modules.";
  }
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a onClick="javascript:load_right('<?PHP echo $Home_Url; ?>')" style="cursor: pointer;" >Home</a></li>
          <li class="breadcrumb-item active">Profil Pengguna</li>
        </ol>
      </div>      
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  <div class="container-fluid">
    <form role="form" name="finput" id="myForm" method="post" action="<?PHP echo $Action; ?>" >
      <div class="row">
        <div class="col-md-8">
          <div class="card <?PHP echo $Head_bg; ?>" style="border-radius:10px;">
            <div class="card-header">
              <h3 class="card-title text-navy font-weight-bold text-uppercase">
                <i class="fa <?PHP echo $Head_icon; ?> menu-icon mr-1"></i> 
                <?PHP echo $Head_label; ?>
              </h3>
            </div>
            
            <div class="card-body">
              <div class="form-group row">
                <label for="txtFirstName" class="col-sm-2 col-form-label">
                  First Name
                </label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="txtFirstName" name="txtFirstName" 
                    placeholder="First name" value="<?PHP echo $First_Name; ?>" <?PHP echo $Disabled; ?>>
                </div>
              </div>

              <div class="form-group row">
                <label for="txtLastName" class="col-sm-2 col-form-label">
                  Last Name
                </label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="txtLastName" name="txtLastName" 
                    placeholder="Last name" value="<?PHP echo $Last_Name; ?>" <?PHP echo $Disabled; ?>>
                </div>
              </div>

              <div class="form-group row">
                <label for="txtPhone" class="col-sm-2 col-form-label">
                  Phone
                </label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="txtPhone" name="txtPhone" 
                    placeholder="Phone/mobile number" value="<?PHP echo $Phone; ?>" <?PHP echo $Disabled; ?>>
                </div>
              </div>

              <div class="form-group row">
                <label for="txtBiography" class="col-sm-2 col-form-label">
                  Biographical
                </label>
                <div class="col-sm-10">
                  <textarea class="form-control" placeholder="Biographical info" id="txtBiography" 
                    name="txtBiography" <?PHP echo $Disabled; ?>><?PHP echo $Biography_Info ?></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-2" style="align-content: center;">
          <div class="card <?PHP echo $Head_bg; ?>" style="border-radius:10px;">
            <div class="card-header">
              <h3 class="card-title text-navy font-weight-bold text-uppercase">
                <i class="fa fa-image menu-icon mr-1"></i> 
                Profile Picture
              </h3>
            </div>
            
            <div class="card-body">
              <div class="form-group">              
                <div class="col-sm-12">
                  <div id="uploaded_image" style="border-radius: 20px; margin-top: 5px;" >
                    <img src="<?PHP echo $Picture_Url; ?>" class="img-thumbnail" 
                      style="border-style: none; border-color: transparent; border-radius: 5px;" />
                  </div>
                  <div class="custom-file" style="max-width: 218px;">
                    <input type="file" class="custom-file-input" name="upload_image" id="upload_image">
                    <label class="custom-file-label" for="upload_image">Pilih Gambar</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-10">
          <div class="card" style="border-radius:10px;">
            <div class="card-body">
              <div class="alert <?PHP echo $Alert_bg; ?> alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6><i class="fa <?PHP echo $Alert_icon ?>"></i> <?PHP echo $Alert_head; ?></h6>
                <small><?PHP echo $Alert; ?></small>
              </div>
            </div>

            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" onClick="javascript:load_right('<?PHP echo $Home_Url; ?>')">
                <i class="fa fa-arrow-alt-circle-left menu-icon"></i> Back</button>
              
              <div class="spinner" style="display: none;" align="center">
                <img id="img-spinner" src="spiner.gif" style="width: 30px; height: 30px;" title="Process" >
              </div>

              <button type="submit" class="btn <?PHP echo $Btn_color; ?>"> 
                <i class="fa <?PHP echo $Btn_icon; ?> menu-icon"></i> <?PHP echo $Btn_label; ?></button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>

<div id="uploadimageModal" class="modal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 10px;">
      <div class="modal-header">
        <p class="modal-title text-uppercase font-weight-bold"><i class="fa fa-crop-alt mr-1"></i> Crop & Upload</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="row" style="align-content: center;">
          <div class="col-md-12 text-center">
            <div id="image_demo" style="margin-top:30px"></div>
          </div>
        </div>
      </div>

      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">
          <i class="fa fa-arrow-alt-circle-left menu-icon mr-1"></i> Close
        </button>
        <button class="btn btn-success crop_image">
          <i class="fa fa-cloud-upload-alt menu-icon mr-1"></i> Crop & Upload
        </button>
      </div>
    </div>
  </div>
</div>

<script>  
  $(document).ready(function(){
    $image_crop = $('#image_demo').croppie({
      enableExif: true,
      viewport: {
        width:215,
        height:215,
        type:'square'
      },
      boundary:{
        width:315,
        height:315
      }
    });

    $('#upload_image').on('change', function(){
      var reader = new FileReader();
      reader.onload = function (event) {
        $image_crop.croppie('bind', {
          url: event.target.result
        }).then(function(){
          console.log('jQuery bind complete');
        });
      }
      reader.readAsDataURL(this.files[0]);
      $('#uploadimageModal').modal('show');
    });

    $('.crop_image').click(function(event){
      $image_crop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
      }).then(function(response){
        $.ajax({
          url:"pages/user/xupload.php",
          type: "POST",
          data:{"image": response},
          success:function(data)
          {
            $('#uploadimageModal').modal('hide');
            $('#uploaded_image').html(data);
          }
        });
      })
    });

  });  
</script>

<script type="text/javascript">
  $("#myForm").submit(function(event){ 
    toastr.options = {
      "debug": false,
      "positionClass": "toast-top-center",
      "onclick": null,
      "fadeIn": 300,
      "fadeOut": 1000,
      "timeOut": 5000,
      "extendedTimeOut": 1000,
      "closeButton": true
    }

    event.preventDefault(); //prevent default action 
    var post_url        = $(this).attr("action"); //get form action url
    var request_method  = $(this).attr("method"); //get form GET/POST method
    var form_data       = $(this).serialize(); //Encode form elements for submission    
    $.ajax({
      url : post_url,
      type: request_method,
      data : form_data,
      beforeSend:function(){$(".spinner").css("display","block");}
    }).done(function(response){
      if(response.indexOf('Success') > -1){
        $("#modal-add").modal("hide");
        toastr.success(response,'Confirm');       
        $('#rightcolumn').load("<?PHP echo $Parent_Url ; ?>");
        return false;
      } 
      else{
        toastr.error(response,'Confirm');
        $(".spinner").css("display","none");
      }
    });     
  });
</script>