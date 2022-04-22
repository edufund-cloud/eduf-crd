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
  $Parent_Url = "pages/modul/tmodul.php";

  $sql = "SELECT gm.menu_id,gm.parent_id,gm.menu_title,gm.menu_description,gm.menu_order,
    gm.menu_target,gm.menu_file,gm.menu_icon,gm.menu_home,gm.data_active
    FROM gen_menu gm 
    WHERE gm.menu_id = '$_GET[mnuid]'";
  $xsql = mysqli_query($koneksi,$sql);
  $arsql = mysqli_fetch_array($xsql);

  switch ($_GET['page']){
    default:  
      $Action     = "pages/modul/xmodul.php?act=addmnu";
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
      $Alert      = "Make sure the data has been filled in correctly.
        <br>If unchecked active data field, the data will not be display in other modules.";
    break;
    case "update";    
      $Action     = "pages/modul/xmodul.php?act=edtmnu&mnuid=$_GET[mnuid]";
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
      $Alert      = "Make sure the data has been filled in correctly.
        <br>If unchecked active data field, the data will not be display in other modules.";
    break;
    case "delete";    
      $Action     = "pages/modul/xmodul.php?act=delmnu&mnuid=$_GET[mnuid]";
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
          <li class="breadcrumb-item"><a onClick="javascript:load_right('<?PHP echo $Parent_Url; ?>')" style="cursor: pointer;" >Moduls</a></li>
          <li class="breadcrumb-item active">Modul</li>
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
            <h3 class="card-title text-uppercase font-weight-bold">
              <i class="fa <?PHP echo $Head_icon; ?> menu-icon"></i> <?PHP echo $Head_label; ?>
            </h3>
          </div>

          <form role="form" name="finput" id="myForm" method="post" action="<?PHP echo $Action; ?>" >
            <div class="card-body">

              <div class="form-group row">
                <label for="cmbParent" class="col-sm-2 col-form-label">
                  Parent
                </label>
                <div class="col-sm-10">
                  <select class="custom-select" style="width: 100%;" name="cmbParent" <?PHP echo $Disabled; ?>>
                    <option value="0">- Select parent -</option>
                    <?PHP
                      $query = mysqli_query($koneksi,"SELECT gm.menu_id,gm.menu_title,gm.menu_description 
                        FROM gen_menu gm
                        WHERE gm.data_active = '1' AND gm.parent_id = '0' AND gm.menu_home = '0' 
                        ORDER BY gm.menu_title ASC");
                      if($query && mysqli_num_rows($query) > 0){
                        while($row = mysqli_fetch_object($query)){
                          echo '<option value="'.$row->menu_id.'"';
                            if($row->menu_id == $arsql['parent_id']) echo ' selected';
                          echo '>'.$row->menu_title.'</option>';
                        }
                      }
                    ?>
                  </select>
                  <small class="text-muted font-italic">Note: leave blank if the menu is parent</small>
                </div>
              </div>

              <div class="form-group row">
                <label for="txtMenuTitle" class="col-sm-2 col-form-label">
                  Title<label class="badge bg-danger" style="margin-left: 10px;"> Required</label>
                </label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="txtMenuTitle" name="txtMenuTitle" 
                    placeholder="Modul name/title" value="<?PHP echo $arsql['menu_title']; ?>" 
                    <?PHP echo $Disabled; ?>>
                </div>
              </div>

              <div class="form-group row">
                <label for="txtDescription" class="col-sm-2 col-form-label">
                  Description<label class="badge bg-warning" style="margin-left: 10px;"> Suggested</label>
                </label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="txtDescription" name="txtDescription" 
                    placeholder="Description" value="<?PHP echo $arsql['menu_description']; ?>" 
                    <?PHP echo $Disabled; ?>>
                </div>
              </div>

              <div class="form-group row">
                <label for="txtOrderNo" class="col-sm-2 col-form-label">
                  Order<label class="badge bg-warning" style="margin-left: 10px;"> Suggested</label>
                </label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="txtOrderNo" name="txtOrderNo" 
                    placeholder="Order number" value="<?PHP echo $arsql['menu_order']; ?>" 
                    <?PHP echo $Disabled; ?>>
                </div>
              </div>

              <div class="form-group row">
                <label for="cmbTarget" class="col-sm-2 col-form-label">
                  Target<label class="badge bg-danger" style="margin-left: 10px;"> Required</label>
                </label>
                <div class="col-sm-10">
                  <select class="custom-select" style="width: 100%;" name="cmbTarget" <?PHP echo $Disabled; ?>>
                    <option value="self" 
                      <?PHP if ($arsql['menu_target']=='self'){ echo"selected"; } ?>>Self</option>
                    <option value="blank" 
                      <?PHP if ($arsql['menu_target']=='blank'){ echo"selected"; } ?>>Blank</option>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label for="txtFileUrl" class="col-sm-2 col-form-label">
                  File url<label class="badge bg-danger" style="margin-left: 10px;"> Required</label>
                </label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="txtFileUrl" name="txtFileUrl" 
                    placeholder="File url" value="<?PHP echo $arsql['menu_file']; ?>" 
                    <?PHP echo $Disabled; ?>>
                </div>
              </div>

              <div class="form-group row">
                <label for="txtMenuIcon" class="col-sm-2 col-form-label">
                  Icon Code<label class="badge bg-warning" style="margin-left: 10px;"> Suggested</label>
                </label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="txtMenuIcon" name="txtMenuIcon" 
                    placeholder="Icon menu" value="<?PHP echo $arsql['menu_icon']; ?>" 
                    <?PHP echo $Disabled; ?>>
                  <small class="text-muted font-italic">
                    Note: use the font Awesome code <a href="https://fontawesome.com/" target="_blank">www.fontawesome.com</a>
                  </small>
                </div>
              </div>
              
              <div class="form-group row">
                <label for="chkHomeMenu" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                  <div class="icheck-success d-inline">
                    <input type="checkbox" id="chkHomeMenu" 
                      <?PHP if ($arsql['menu_home'] == "1"){ echo"checked"; } ?> value="1" 
                      name="chkHomeMenu" <?PHP echo $Disabled; ?>>
                    <label for="chkHomeMenu" style="font-weight: normal;"> Make it the homepage</label>
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label for="chkActive" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                  <div class="icheck-success d-inline">
                    <input type="checkbox" id="chkActive" 
                      <?PHP if ($arsql['data_active'] == "1"){ echo"checked"; } ?> value="1" name="chkActive" <?PHP echo $Disabled; ?>>
                    <label for="chkActive" style="font-weight: normal;"> Active Data</label>
                  </div>
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
              <button type="button" class="btn btn btn-default" onClick="javascript:load_right('<?PHP echo $Parent_Url; ?>')">
                <i class="fa fa-arrow-alt-circle-left menu-icon mr-1"></i> Back</button>              

              <div class="spinner" style="display: none;" align="center">
                <img id="img-spinner" src="spiner.gif" style="width: 30px; height: 30px;" title="Process" >
              </div>

              <button type="submit" class="btn btn <?PHP echo $Btn_color; ?>"> 
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