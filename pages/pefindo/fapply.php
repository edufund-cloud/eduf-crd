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
  $Parent_Url = "pages/pefindo/tapply.php";

  switch ($_GET['page']){
    default:  
      $Action     = "pages/pefindo/xapply.php?act=add";
      $Head_bg    = "card-lightblue card-outline";      
      $Head_label = "Add Modul";
      $Head_icon  = "fa-plus";
      $Btn_label  = "Add New";
      $Btn_color  = "btn-success";
      $Btn_icon   = "fa-plus-circle";
      $Disabled   = "";
      $Alert_bg   = "alert-warning";
      $Alert_head = "Info!";
      $Alert_icon = "fa-info-circle";
      $Alert      = "Make sure the data has been filled in correctly.<br>
        And please skip the fields marked skip.";
    break;
    case "update";    
      $Action     = "pages/pefindo/xapply.php?act=edt&appid=$_GET[appid]";
      $Head_bg    = "card-lightblue card-outline";
      $Head_label = "Update Modul";
      $Head_icon  = "fa-edit";
      $Btn_label  = "Update";
      $Btn_color  = "btn-success";
      $Btn_icon   = "fa-edit";
      $Disabled   = "";
      $Alert_bg   = "alert-warning";
      $Alert_head = "Info!";
      $Alert_icon = "fa-info-circle";
      $Alert      = "Make sure the data has been filled in correctly.<br>
        And please skip the fields marked skip.";
    break;
    case "delete";    
      $Action     = "pages/pefindo/xapply.php?act=del&appid=$_GET[appid]";
      $Head_bg    = "card-pink card-outline";
      $Head_label = "Delete Modul";
      $Head_icon  = "fa-exclamation-circle";
      $Btn_label  = "Delete";
      $Btn_color  = "btn-danger";
      $Btn_icon   = "fa-trash-alt";
      $Disabled   = "disabled";
      $Alert_bg   = "alert-danger";
      $Alert_head = "Warning!";
      $Alert_icon = "fa-exclamation-triangle";
      $Alert      = "Data will be permanently deleted. Are you sure? <br> Click the Back button to cancel the process.<br>If unchecked active data field, the data will not be display in other modules.";
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
          <li class="breadcrumb-item"><a onClick="javascript:load_right('<?PHP echo $Parent_Url; ?>')" style="cursor: pointer;" >Credit</a></li>
          <li class="breadcrumb-item active">Data Credit</li>
        </ol>
      </div>      
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">

  <div class="col-md-12">
    <div class="card">
      <div class="card-header p-2">
        <ul class="nav nav-pills">
          <li class="nav-item" title="completion">
            <a class="nav-link active mr-1" href="#completion" data-toggle="tab" id="tab-completion">
              Completion
            </a>
          </li>
          <li class="nav-item" title="personal">
            <a class="nav-link mr-1" href="#personal" data-toggle="tab" id="tab-personal">
              Personal
            </a>
          </li>
          <li class="nav-item" title="Alamat">
            <a class="nav-link mr-1" href="#alamat" data-toggle="tab" id="tab-alamat">
              Alamat
            </a>
          </li>
          <li class="nav-item" title="Pekerjaan">
            <a class="nav-link mr-1" href="#pekerjaan" data-toggle="tab">
              Pekerjaan
            </a>
          </li>
          <li class="nav-item" title="Kontak Darurat">
            <a class="nav-link mr-1" href="#kontak_darurat" data-toggle="tab">
              Kontak Darurat
            </a>
          </li>
          <li class="nav-item" title="Pengajuan">
            <a class="nav-link mr-1" href="#pengajuan" data-toggle="tab">
              Pengajuan
            </a>
          </li>
        
          <li class="nav-item" title="Note">
            <a class="nav-link" href="#note" data-toggle="tab">
              <i class="fas fa-pen mr-1"></i>Note
            </a>
          </li>          
        </ul>
      </div>

      <div class="card-body">
        <form role="form" name="finput" id="myForm" method="post" action="<?PHP echo $Action; ?>" >
          <div class="tab-content" id="formcolumn">     

              <?PHP
                include_once('../component/fcompletion.php');
                include_once('../component/fpersonal.php');
                include_once('../component/faddress.php');
                include_once('../component/fprofession.php');
                include_once('../component/femergency.php');
                include_once('../component/fsubmission.php');
                include_once('fnote.php');                
              ?>

          </div>
        </form>

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