<?PHP
  require_once("../../config/session.php");
  require_once("../../config/database.php");
  require_once("../../com/home_map.php");
  
  $Parent_Url = "pages/user/tuser.php";

  $sql = "SELECT gu.user_id,gu.user_login,gu.user_email,gu.user_level,gu.group_id,gu.data_active
    FROM gen_users gu 
    WHERE gu.user_id = '$_GET[usrid]'";
  $xsql = mysqli_query($koneksi,$sql);
  $arsql = mysqli_fetch_array($xsql);

  switch ($_GET['page']){
    default:
      $Action     = "pages/user/xuser.php?act=addusr";
      $Head_bg    = "card-lightblue card-outline";      
      $Head_label = "Add User <small><i>(Login Info)</i></small>";
      $Head_icon  = "fa-plus";
      $Btn_label  = "Add New";
      $Btn_color  = "btn-success";
      $Btn_icon   = "fa-plus-circle";
      $Disabled   = "";
      $Alert_bg   = "alert-warning";
      $Alert_head = "Info!";
      $Alert_icon = "fa-info-circle";
      $Alert      = "Make sure the data has been filled in correctly.
        <br>If unchecked active data field, the data will not be display in other modules.";
    break;
    case "update";    
      $Action     = "pages/user/xuser.php?act=edtusr&usrid=$_GET[usrid]";
      $Head_bg    = "card-lightblue card-outline";
      $Head_label = "Update User <small><i>(Login Info)</i></small>";
      $Head_icon  = "fa-edit";
      $Btn_label  = "Update";
      $Btn_color  = "btn-success";
      $Btn_icon   = "fa-edit";
      $Disabled   = "";
      $Alert_bg   = "alert-warning";
      $Alert_head = "Info!";
      $Alert_icon = "fa-info-circle";
      $Alert      = "Make sure the data has been filled in correctly.
        <br>If unchecked active data field, the data will not be display in other modules.".$Action;
    break;
    case "delete";    
      $Action     = "pages/user/xuser.php?act=delusr&usrid=$_GET[usrid]";
      $Head_bg    = "card-lightblue card-outline";
      $Head_label = "Delete User <small><i>(Login Info)</i></small>";
      $Head_icon  = "fa-exclamation-circle";
      $Btn_label  = "Delete";
      $Btn_color  = "btn-danger";
      $Btn_icon   = "fa-trash-alt";
      $Disabled   = "disabled";
      $Alert_bg   = "alert-danger";
      $Alert_head = "Warning!";
      $Alert_icon = "fa-exclamation-triangle";
      $Alert      = "Data will be permanently deleted. Are you sure? <br> Click the Back button to cancel the process.";
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
          <li class="breadcrumb-item"><a onClick="javascript:load_right('<?PHP echo $Parent_Url; ?>')" style="cursor: pointer;" >Users</a></li>
          <li class="breadcrumb-item active"><?PHP echo $Btn_label; ?></li>
        </ol>
      </div>      
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card <?PHP echo $Head_bg; ?>" style="border-radius:10px;">
          <div class="card-header">
            <h3 class="card-title text-navy font-weight-bold text-uppercase">
              <i class="fa <?PHP echo $Head_icon; ?> menu-icon mr-2 text-navy"></i> <?PHP echo $Head_label; ?>
            </h3>
          </div>

          <form role="form" name="finput" id="myForm" method="post" action="<?PHP echo $Action; ?>" >
            <div class="card-body">

              <div class="form-group row">
                <label for="txtNickName" class="col-sm-2 col-form-label">
                  Username<label class="badge bg-danger" style="margin-left: 10px;"> Required</label>
                </label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="txtNickName" name="txtNickName"  
                    placeholder="Username" value="<?PHP echo $arsql['user_login']; ?>" <?PHP echo $Disabled; ?>>
                </div>
              </div>

              <div class="form-group row">
                <label for="txtEmail" class="col-sm-2 col-form-label">
                  Email<label class="badge bg-danger" style="margin-left: 10px;"> Required</label>
                </label>
                <div class="col-sm-10">
                  <input type="Email" class="form-control" id="txtEmail" name="txtEmail" 
                    placeholder="Email" value="<?PHP echo $arsql['user_email']; ?>" <?PHP echo $Disabled; ?>>
                </div>
              </div>

              <div class="form-group row">
                <label for="cmbSysLevel" class="col-sm-2 col-form-label">
                  Level<label class="badge bg-danger" style="margin-left: 10px;"> Required</label>
                </label>
                <div class="col-sm-10">
                  <select class="custom-select" style="width: 100%;" 
                    name="cmbSysLevel" <?PHP echo $Disabled; ?>>
                    <option value="user" <?PHP if ($arsql['user_level'] == "user"){ echo"selected"; } ?> >user</option>
                    <?PHP
                      if($user_level == "root"){
                        ?>
                        <option value="root" <?PHP if ($arsql['user_level'] == "root"){ echo"selected"; } ?> >root</option>
                        <?PHP
                      }                    
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label for="cmbGroup" class="col-sm-2 col-form-label">
                  Group<label class="badge bg-danger" style="margin-left: 10px;"> Required</label>
                </label>
                <div class="col-sm-10">
                  <select class="custom-select" style="width: 100%;" 
                    name="cmbGroup" <?PHP echo $Disabled; ?>>
                    <option value="0">-Select group-</option>
                    <?PHP
                      $sql_grp = "SELECT gg.group_id,gg.description FROM gen_group gg 
                        WHERE gg.data_active = '1' ORDER BY gg.description ASC";
                      $xsql_grp = mysqli_query($koneksi,$sql_grp);
                      while($arsql_grp = mysqli_fetch_array($xsql_grp)){
                        ?>
                        <option value="<?PHP echo $arsql_grp['group_id'] ?>" 
                          <?PHP if ($arsql_grp['group_id'] == $arsql['group_id']){ echo"selected"; } ?> >
                          <?PHP echo $arsql_grp['description']; ?>
                        </option>
                        <?PHP
                      }
                    ?>
                  </select>
                </div>
              </div>
              
              <div class="form-group row">
                <label for="cmbSysLevel" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                  <div class="icheck-success d-inline">
                    <input type="checkbox" id="chkActive" 
                      <?PHP if ($arsql['data_active'] == "1"){ echo"checked"; } ?> value="1" 
                      name="chkActive" <?PHP echo $Disabled; ?>>
                    <label for="chkActive" style="font-weight: normal;"> Active Data</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="card-body">
              <div class="alert <?PHP echo $Alert_bg; ?> alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6><i class="fa <?PHP echo $Alert_icon ?> mr-1"></i> <?PHP echo $Alert_head; ?></h6>
                <small><?PHP echo $Alert; ?></small>
              </div>
            </div>            

            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" onClick="javascript:load_right('<?PHP echo $Parent_Url; ?>')">
                <i class="fa fa-arrow-alt-circle-left menu-icon mr-1"></i> Back</button>              

              <div class="spinner" style="display: none;" align="center">
                <img id="img-spinner" src="spiner.gif" style="width: 30px; height: 30px;" title="Process" >
              </div>

              <button type="submit" class="btn <?PHP echo $Btn_color; ?>"> 
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