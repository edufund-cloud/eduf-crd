<?PHP
  require_once("config/database.php");
  require_once("com/home_map.php");
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a onClick="javascript:load_right('<?PHP echo $Home_Url; ?>')" style="cursor: pointer;" class="nav-link" role="button">
          <i class="fas fa-home "></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-card-widget="maximize">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-user-cog"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Panel User <?PHP echo $user_nickname; ?></span>
          <div class="dropdown-divider"></div>
          <a onclick="javascript:load_right('<?PHP echo'pages/user/fown_profile.php'; ?>');" 
            class="dropdown-item" style="cursor: pointer;">
            <i class="fa fa-id-card mr-2"></i> Profil
          </a>
          <div class="dropdown-divider"></div>
          <a onclick="javascript:load_right('<?PHP echo'pages/user/fown_password.php'; ?>');" 
            class="dropdown-item" style="cursor: pointer;">
            <i class="fa fa-key mr-2"></i> Ganti Password
          </a>
          <div class="dropdown-divider"></div>
          <a href="?act=logout" class="dropdown-item">
            <i class="fa fa-sign-out-alt mr-2"></i> Logout
          </a>
        </div>
      </li>
  </ul>
</nav>