<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>edufund.id</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">  
  <!-- /.login-logo -->  
  <div class="login-logo" align="center">    
    <a href="https://edufund.co.id/" target="_blank">
      <img src="dist/img/edufund-logo-1.svg" alt="Logo" class="brand-image" style="width:250px;">
    </a>
  </div>
  <div class="card card-primary card-outline" id="signcolumn">        
    <!-- /.login-card-body -->
    <?PHP 
      if ($_GET['act'] == "forgot"){
        include_once("fforgot.php");
      }
      else{
        include_once("fsignin.php");
      }
    ?>    
  </div>
</div>

<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>

<!-- Show/hide password -->
<script type="text/javascript">
  function change(){
    var x = document.getElementById('txtPassword').type;

    if (x == 'password')
    {
       document.getElementById('txtPassword').type = 'text';
       document.getElementById('mybutton').innerHTML = '<i class="fa fa-eye-slash"></i>';
    }
    else
    {
       document.getElementById('txtPassword').type = 'password';
       document.getElementById('mybutton').innerHTML = '<i class="fa fa-eye"></i>';
    }
  }
</script>

<script type="text/javascript">
  function load_sign(urlx){
    $.ajax({
      url: urlx,
      success: function(html){
        $('#signcolumn').html(html);
      }
    });
  }
</script>

</body>
</html>