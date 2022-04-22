
<div class="card-body login-card-body" style="border-radius: 120px;">
  <p class="login-box-msg">Anda lupa password? Silahkan masukan email anda untuk mendapatkan password sementara.</p>

  <?PHP
    $Parent_Url = "pages/login/fsignin.php?reset=1";
    $Error_Url  = "pages/login/fsignin.php?reset_err=1";
    $Action     = "pages/login/xforgot.php?act=rstpsw";
  ?>

  <form role="form" name="finput" id="myForm" method="post" action="<?PHP echo $Action; ?>">
    <div class="input-group mb-3">
      <input type="email" class="form-control" placeholder="Email" name="txtEmail">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-envelope"></span>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <button type="submit" class="btn btn-success btn-block">
          <i class="fa fa-paper-plane menu-icon" style="margin-right: 15px;"></i> Permintaan Password Baru
        </button>
      </div>
    </div>
  </form>

  <p class="mt-3 mb-1">
    <button type="button" class="btn btn-default" style="margin-right: 10px; border:none; background: none;"
        onclick="javascript:load_sign('pages/login/fsignin.php');">  
        <i class="fa fa-arrow-left menu-icon"></i> Back ke form login 
    </button>
  </p>
</div>

<div class="spinner" style="display: none;" align="center">
  <img id="img-spinner" src="spiner.gif" style="width: 30px; height: 30px;" title="Process" >
</div>
<!-- /.login-card-body -->

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
        $('#signcolumn').load("<?PHP echo $Parent_Url ; ?>");
        return false;
      } 
      else{
        $("#modal-add").modal("hide");
        toastr.error(response,'Confirm');
        $(".spinner").css("display","none");
        $('#signcolumn').load("<?PHP echo $Error_Url ; ?>");
        return false;
      }
    });     
  });
</script>

