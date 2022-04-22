<div class="card-body login-card-body" style="border-radius: 20px;">      
  <p class="login-box-msg">Selamat datang<br>Masukan email dan password untuk login</p>

  <?PHP
    if (isset($_GET['errlog'])==1) {
      ?>
      <div class="alert bg-red alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Login Gagal,</strong>   <a href="?page=forgot" class="alert-link" 
                  style="color:#ffffff; font-weight:normal; text-decoration:underline;">klik disini</a> jika lupa pasaword.
      </div>
      <?PHP
    }
    else if (isset($_GET['errlog'])==3) {
      ?>
      <div class="alert bg-blue alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Sesi telah berakhir</strong>   <a href="?page=forgot" class="alert-link" 
                  style="color:#ffffff; font-weight:normal; text-decoration:underline;">klik disini</a> jika lupa pasaword.
      </div>
      <?PHP
    }

    if (isset($_GET['reset'])==1) {
      ?>
      <div class="alert bg-purple alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Password anda telah direset, cek email anda</strong>   <a href="?page=forgot" class="alert-link" 
                  style="color:#ffffff; font-weight:normal; text-decoration:underline;">klik disini</a> jika lupa pasaword.
      </div>
      <?PHP
    }
    if (isset($_GET['reset_err'])==1) {
      ?>
      <div class="alert bg-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Email tidak ditemukan</strong>   <a href="?page=forgot" class="alert-link" 
                  style="color:#ffffff; font-weight:normal; text-decoration:underline;">klik disini</a> jika lupa pasaword.
      </div>
      <?PHP
    }
    //phpinfo();    
  ?>

  <form method="post" action="pages/login/xsignin.php?act=login">
    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Username atau Email" name="txtLogin">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-envelope"></span>
        </div>
      </div>
    </div>
    <div class="input-group mb-3">
      <input type="password" class="form-control" placeholder="Password" id="txtPassword" name="txtPassword">
      <div class="input-group-prepend">
        <span id="mybutton" class="input-group-text" onclick="change()" 
          style="border-left: none; border-top-right-radius: 5px; border-bottom-right-radius: 5px;">
          <i class="fa fa-eye"></i>
        </span>
      </div>
    </div>
    <div class="row">
      <div class="col-8">
        <div class="icheck-primary">
          <input type="checkbox" id="remember">
          <label for="remember">
            Ingatkan saya
          </label>
        </div>
      </div>
      <!-- /.col -->
      <div class="col-4">
        <button type="submit" class="btn btn-success btn-block">&nbsp;&nbsp; Login &nbsp;&nbsp;</button>
      </div>
      <!-- /.col -->
    </div>
  </form>

  <div class="social-auth-links text-center mb-3" style="height: 50px;"></div>
  <!-- /.social-auth-links -->

  <p class="mb-1">
    <button type="button" class="btn btn-default" style="margin-right: 10px; border:none; background: none;"
        onclick="javascript:load_sign('pages/login/fforgot.php?act=forgot');">  
      Lupa password <i class="fa fa-question-circle"></i>
    </button>
  </p>
</div>