<?PHP
  require_once("../../config/session.php");
  require_once("../../config/database.php");
  require_once("../../com/home_map.php");

  $Parent_Url = "pages/user/fown_password.php";

  $Action     = "pages/user/xown_password.php?act=edtpsw&usrid=$user_id";
  $Head_bg    = "card-lightblue card-outline";      
  $Head_label = "Change Password";
  $Head_icon  = "fa-key";
  $Btn_label  = "Change Password";
  $Btn_color  = "btn-success";
  $Btn_icon   = "fa-key";
  $Disabled   = "";
  $Alert_bg   = "alert-warning";
  $Alert_head = "Info!";
  $Alert_icon = "fa-info-circle";
  $Alert      = "Make sure the data has been filled in correctly.
    <br>If unchecked active data field, the data will not be display in other modules.";
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a onClick="javascript:load_right('<?PHP echo $Home_Url; ?>')" style="cursor: pointer;" >Home</a></li>
          <li class="breadcrumb-item active">Change Password</li>
        </ol>
      </div>      
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card <?PHP echo $Head_bg; ?>" style="border-radius:10px;">
          <div class="card-header">
            <h3 class="card-title text-navy font-weight-bold text-uppercase">
              <i class="fa <?PHP echo $Head_icon; ?> menu-icon mr-2 text-navy"></i> <?PHP echo $Head_label; ?>
            </h3>
          </div>

          <form role="form" name="finput" id="myForm" method="post" action="<?PHP echo $Action; ?>" >
            <div class="card-body">
              <div class="input-group mb-3">
                <label for="txtPassword_Old" class="col-sm-3 col-form-label">
                  Previous Password
                </label>
                <input type="password" class="form-control col-sm-9" placeholder="Your previous password" 
                  id="txtPassword_Old" name="txtPassword_Old">
                <div class="input-group-prepend">
                  <span id="mypass_old" class="input-group-text" onclick="change_x()" 
                    style="border-left: none; border-top-right-radius: 5px; border-bottom-right-radius: 5px;">
                    <i class="fa fa-eye"></i>
                  </span>
                </div>
              </div>

              <div class="input-group mb-3">
                <label for="txtPassword_New" class="col-sm-3 col-form-label">
                  New Password
                </label>
                <input type="password" class="form-control col-sm-9" placeholder="Your new password" 
                  id="txtPassword_New" name="txtPassword_New">
                <div class="input-group-prepend">
                  <span id="mypass_new" class="input-group-text" onclick="change_y()" 
                    style="border-left: none; border-top-right-radius: 5px; border-bottom-right-radius: 5px;">
                    <i class="fa fa-eye"></i>
                  </span>
                </div>
              </div>

              <div class="input-group mb-3">
                <label for="txtRepassword_New" class="col-sm-3 col-form-label">
                  Repeat New Password
                </label>
                <input type="password" class="form-control col-sm-9" placeholder="Repeat your new password" 
                  id="txtRepassword_New" name="txtRepassword_New">
                <div class="input-group-prepend">
                  <span id="myrepass_new" class="input-group-text" onclick="change_z()" 
                    style="border-left: none; border-top-right-radius: 5px; border-bottom-right-radius: 5px;">
                    <i class="fa fa-eye"></i>
                  </span>
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
              <button type="button" class="btn btn-default" onClick="javascript:load_right('<?PHP echo $Home_Url; ?>')">
                <i class="fa fa-arrow-alt-circle-left menu-icon mr-1"></i> Close</button>              

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

<!-- Show/hide password -->
<script type="text/javascript">
  function change_x(){
    var x = document.getElementById('txtPassword_Old').type;    

    if (x == 'password')
    {
       document.getElementById('txtPassword_Old').type = 'text';
       document.getElementById('mypass_old').innerHTML = '<i class="fa fa-eye-slash"></i>';
    }
    else
    {
       document.getElementById('txtPassword_Old').type = 'password';
       document.getElementById('mypass_old').innerHTML = '<i class="fa fa-eye"></i>';
    }
  }

  function change_y(){
    var y = document.getElementById('txtPassword_New').type;

    if (y == 'password')
    {
       document.getElementById('txtPassword_New').type = 'text';
       document.getElementById('mypass_new').innerHTML = '<i class="fa fa-eye-slash"></i>';
    }
    else
    {
       document.getElementById('txtPassword_New').type = 'password';
       document.getElementById('mypass_new').innerHTML = '<i class="fa fa-eye"></i>';
    }
  }

  function change_z(){
    var z = document.getElementById('txtRepassword_New').type;

    if (z == 'password')
    {
       document.getElementById('txtRepassword_New').type = 'text';
       document.getElementById('myrepass_new').innerHTML = '<i class="fa fa-eye-slash"></i>';
    }
    else
    {
       document.getElementById('txtRepassword_New').type = 'password';
       document.getElementById('myrepass_new').innerHTML = '<i class="fa fa-eye"></i>';
    }
  }
</script>

<script type="text/javascript">
  function myFunction() {
    document.getElementById('txtPassword_Old').value = '';
  }
</script>