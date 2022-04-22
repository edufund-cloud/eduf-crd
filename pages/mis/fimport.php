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
  $Parent_Url = "pages/apply/tapply.php";

  switch ($_GET['page']){
    default:  
      $Action     = "pages/apply/ximport.php?act=add";
      $Head_bg    = "card-lightblue card-outline";      
      $Head_label = "Import Data Credit";
      $Head_icon  = "fa-upload";
      $Btn_label  = "Upload";
      $Btn_color  = "btn-success";
      $Btn_icon   = "fa-upload";
      $Disabled   = "";
      $Alert_bg   = "alert-warning";
      $Alert_head = "Info!";
      $Alert_icon = "fa-info-circle";
      $Alert      = "Make sure the data uploaded is correct. Files with the extension *.xls and a maximum number of 100 lines.";
    break;
  }
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-12">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a onClick="javascript:load_right('<?PHP echo $Home_Url; ?>')" style="cursor: pointer;" >Home</a></li>
          <li class="breadcrumb-item active">Import Data</li>
        </ol>
      </div>      
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8">
        <div class="card <?PHP echo $Head_bg; ?>" style="border-radius:12px;">
          <div class="card-header">
            <h3 class="card-title text-uppercase font-weight-bold">
              <i class="fa <?PHP echo $Head_icon; ?> menu-icon mr-1"></i> <?PHP echo $Head_label; ?>
            </h3>
          </div>

          <form role="form" name="finput" id="myForm" method="post" action="<?PHP echo $Action; ?>" 
            enctype="multipart/form-data" >
            <div class="card-body">

              <div class="form-group row">
                <label for="cmbParent" class="col-sm-2 col-form-label">
                  File Data
                </label>
                <div class="col-sm-10">
                  <input type="file" class="form-control" id="txtfile" name="txtfile" 
                    placeholder="File Data Import"  <?PHP echo $Disabled; ?>>
                </div>
              </div>
              
            </div>

            <div class="card-body">
              <div class="alert <?PHP echo $Alert_bg; ?> alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6><i class="fa <?PHP echo $Alert_icon ?>"></i> <?PHP echo $Alert_head; ?></h6>
                <small><?PHP echo $Alert; ?></small>
              </div>
            </div>            

            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-lg btn-default" onClick="javascript:load_right('<?PHP echo $Home_Url; ?>')">
                <i class="fa fa-arrow-alt-circle-left menu-icon mr-1"></i> Close</button>              

              <div class="spinner" style="display: none;" align="center">
                <img id="img-spinner" src="spiner.gif" style="width: 30px; height: 30px;" title="Process" >
              </div>

              <button type="submit" class="btn btn-lg <?PHP echo $Btn_color; ?>"> 
                <i class="fa <?PHP echo $Btn_icon; ?> menu-icon mr-1"></i> <?PHP echo $Btn_label; ?></button>
            </div>
          </form>
          
        </div>
      </div>
    </div>
  </div>
</section>


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
      processData: false,
      contentType: false,
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