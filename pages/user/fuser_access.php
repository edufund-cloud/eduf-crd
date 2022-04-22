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
  $Parent_Url = "pages/user/tuser.php";

  $sql = "SELECT gu.user_email, DATE_FORMAT(gu.data_create,'%d %b %Y') AS data_create 
    FROM gen_users gu WHERE gu.user_id = '$_GET[usrid]'";
  $xsql = mysqli_query($koneksi,$sql);
  $arsql = mysqli_fetch_array($xsql);

  $User_Email = $arsql['user_email'];
  $User_Create = $arsql['data_create'];
  
  $sql = "SELECT go.meta_id,go.meta_key,go.meta_value 
    FROM gen_usermeta go
    WHERE go.user_id = '$_GET[usrid]' 
    ORDER BY go.meta_id ASC";
  $xsql = mysqli_query($koneksi,$sql);
  while($arsql = mysqli_fetch_array($xsql)){
    $meta_key = $arsql['meta_key'];
    switch ($meta_key) {
      case 'first_name':
        $First_Name = ucwords($arsql['meta_value']);
      break;
      
      case 'last_name':
        $Last_Name = ucwords($arsql['meta_value']);
      break;

      case 'user_phone':
        $Phone = ucwords($arsql['meta_value']);
      break;

      case 'user_biography':
        $Biography_Info = $arsql['meta_value'];
      break;

      case 'user_picture':
        $Picture_Url = $arsql['meta_value'];
      break;

      case 'user_level':
        $User_Level = ucwords($arsql['meta_value']);
      break;
    }
  }

  if (empty($Picture_Url)){
    $Picture_Url = "dist/img/blank-m.png";
  }

  switch ($_GET['page']){
    default:  
      $Action     = "pages/user/xuser_access.php?act=updacc&usrid=$_GET[usrid]";
      $Head_bg    = "card-lightblue card-outline";      
      $Head_label = "User Access <small><i>(user access setting)</i></small>";
      $Head_icon  = "fa-list";
      $Btn_label  = "Submit";
      $Btn_color  = "btn-success";
      $Btn_icon   = "fa-save";
      $Disabled   = "";
      $Alert_bg   = "alert-warning";
      $Alert_head = "Info!";
      $Alert_icon = "fa-info-circle";
      $Alert      = "Make sure the data has been filled in correctly.
        <br>If unchecked active data field, the data will not be display in other modules.";
    break;
  }
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a onClick="javascript:load_right('<?PHP echo $Home_Url; ?>')" style="cursor: pointer;" >Home</a></li>
          <li class="breadcrumb-item"><a onClick="javascript:load_right('<?PHP echo $Parent_Url; ?>')" style="cursor: pointer;" >Users</a></li>
          <li class="breadcrumb-item active">User Access</li>
        </ol>
      </div>      
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">      
      <!-- /.col -->
      <div class="col-md-8">
        <div class="card <?PHP echo $Head_bg; ?>" style="border-radius:10px;">
          <div class="card-header p-2">
            <h3 class="card-title text-navy font-weight-bold text-uppercase">
              <i class="fa <?PHP echo $Head_icon; ?> menu-icon mr-2 ml-1 text-navy"></i>
              <?PHP echo $Head_label; ?>
            </h3>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <form role="form" name="finput" id="myForm" method="post" action="<?PHP echo $Action; ?>" >
                <!-- /.tab-pane -->
                <div class="active tab-pane" id="timeline">
                  <!-- The timeline -->
                  <div class="timeline timeline-inverse">
                      <!-- START Akses Navigasi -->
                      <?PHP
                      $sql_nav = "SELECT gm.menu_id,gm.menu_title,gm.menu_description,gm.menu_file,gm.menu_icon 
                        FROM gen_menu gm 
                        WHERE gm.parent_id = 0 AND gm.data_active = '1' AND (gm.menu_home != '1') 
                        ORDER BY gm.menu_home,gm.menu_order ASC";
                      //echo $sql_nav;                        
                      $xsql_nav = mysqli_query($koneksi, $sql_nav);
                      if ($x==0){$x=0;} else{$x=$x;}
                      while($arsql_nav = mysqli_fetch_array($xsql_nav)){
                        $ColorArray = array('bg-pink','bg-purple','bg-blue','bg-orange','bg-info','bg-warning','bg-danger');
                        shuffle($ColorArray);
                        $iColor = array_shift($ColorArray);

                        $Nav_Label        = $arsql_nav['menu_title'];
                        $Nav_Description  = $arsql_nav['menu_description'];
                        $Nav_Icon         = $arsql_nav['menu_icon'];
                        $Nav_Url          = $arsql_nav['menu_file'];

                        $sql_nav_val = "SELECT gma.data_active 
                          FROM gen_menu_access gma 
                          WHERE gma.user_id = '$_GET[usrid]' AND gma.menu_id = '$arsql_nav[menu_id]'";
                        //echo $sql_nav_val;
                        $xsql_nav_val = mysqli_query($koneksi,$sql_nav_val);
                        $arsql_nav_val = mysqli_fetch_array($xsql_nav_val);

                        $Navigate_ID          = $arsql_nav['menu_id'];
                        $Navigate_Label       = $arsql_nav['menu_title'];
                        $Navigate_Description = $arsql_nav['menu_description'];
                        $Navigate_Value       = $arsql_nav_val['data_active'];
                        ?>
                        <div>
                          <i class="fa <?PHP echo $arsql_nav['menu_icon']; ?> <?PHP //echo $iColor; ?> bg-dark"></i>
                          <div class="timeline-item  col-md-6" style="border: none; background: transparent;">
                            <div class="card card-light">
                              <div class="card-header">
                                <div class="icheck-orange d-inline">
                                  <input type="checkbox" id="chkNavigate[<?PHP echo $x; ?>]" 
                                    <?PHP if ($Navigate_Value == "1"){ echo"checked"; } ?> value="1" 
                                    name="chkNavigate[<?PHP echo $x; ?>]">
                                  <label for="chkNavigate[<?PHP echo $x; ?>]"> 
                                    <strong><?PHP echo $Nav_Label; ?></strong>
                                    <small><i> <?PHP echo $Description; ?></i></small>
                                  </label>
                                  <input type="text" name="txtUser[<?PHP echo $x; ?>]" hidden 
                                    value="<?PHP echo $_GET['usrid']; ?>">
                                  <input type="text" name="txtNavigate[<?PHP echo $x; ?>]" hidden 
                                    value="<?PHP echo $Navigate_ID; ?>">
                                </div>
                                
                                <?PHP
                                  $sql_sub = "SELECT gm.menu_id,gm.menu_title,gm.menu_description,
                                    gm.menu_file,gm.menu_icon 
                                    FROM gen_menu gm 
                                    WHERE gm.parent_id = '$arsql_nav[menu_id]' 
                                    AND gm.data_active = '1' AND (gm.menu_home != '1') 
                                    ORDER BY gm.menu_order ASC";
                                  //echo $sql_sub;
                                  $xsql_sub = mysqli_query($koneksi, $sql_sub);
                                  $nmsql_sub = mysqli_num_rows($xsql_sub);

                                  if ($nmsql_sub > 0){
                                    ?>
                                    <div class="card-tools">
                                      <button type="button" class="btn btn-tool" data-card-widget="collapse" 
                                        data-toggle="tooltip" title="Collapse">
                                      <i class="fas fa-minus"></i></button>
                                    </div>
                                    <?PHP
                                  }
                                ?>
                              </div>
                              <?php
                                if ($nmsql_sub > 0){
                                  ?>
                                  <div class="card-body">
                                    <div class="form-group">
                                      <?PHP
                                        if ($y==0){$y=0;} else{$y=$y;}                                  
                                        while($arsql_sub = mysqli_fetch_array($xsql_sub)){
                                          $Sub_Label        = $arsql_sub['menu_title'];
                                          $Sub_Description  = "(".$arsql_sub['menu_description'].")";
                                          $Sub_Icon         = $arsql_sub['menu_icon'];
                                          $Sub_Url          = $arsql_sub['menu_file'];

                                          $sql_sub_val = "SELECT gma.data_active 
                                            FROM gen_menu_access gma 
                                            WHERE gma.user_id = '$_GET[usrid]' AND gma.menu_id = '$arsql_sub[menu_id]'";
                                          $xsql_sub_val = mysqli_query($koneksi,$sql_sub_val);
                                          $arsql_sub_val = mysqli_fetch_array($xsql_sub_val);

                                          $Sub_Navigate_ID          = $arsql_sub['menu_id'];
                                          $Sub_Navigate_Label       = $arsql_sub['menu_title'];
                                          $Sub_Navigate_Description = $arsql_sub['menu_description'];
                                          $Sub_Navigate_Value       = $arsql_sub_val['data_active'];

                                          ?>
                                          <div class="form-group" style="margin-left: 30px;">
                                            <div class="icheck-lightblue d-inline">
                                              <input type="checkbox" id="chkSubNavigate[<?PHP echo $y; ?>]" 
                                                <?PHP if ($Sub_Navigate_Value == "1"){ echo"checked"; } ?> value="1" 
                                                name="chkSubNavigate[<?PHP echo $y; ?>]">
                                              <label for="chkSubNavigate[<?PHP echo $y; ?>]"> 
                                                <?PHP echo $Sub_Label; ?>
                                                <small><i> <?PHP echo $Sub_Description; ?></i></small>
                                              </label>
                                              <input type="text" name="txtSubUser[<?PHP echo $y; ?>]" hidden 
                                                value="<?PHP echo $_GET['usrid']; ?>">
                                              <input type="text" name="txtSubNavigate[<?PHP echo $y; ?>]" hidden 
                                                value="<?PHP echo $Sub_Navigate_ID; ?>">
                                            </div>
                                          </div>
                                          <?PHP
                                          $y++;
                                        }
                                      ?>
                                    </div>
                                  </div>
                                  <?php                                  
                                }
                              ?>
                            </div>
                          </div>
                        </div>  
                        <?PHP
                        $x++;
                      }
                      ?>
                      <!-- End Akses Navigasi -->
                    <div>
                      <i class="far fa-clock bg-dark"></i>
                    </div>
                  </div>
                </div>
                <!-- /.tab-pane -->

                <div class="card-body">
                  <div class="alert <?PHP echo $Alert_bg; ?> alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h6><i class="fa <?PHP echo $Alert_icon ?>"></i> <?PHP echo $Alert_head; ?></h6>
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
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>

      <div class="col-md-3">

        <!-- About Me Box -->
        <div class="card <?PHP echo $Head_bg; ?>" style="border-radius:10px;">
          <div class="card-header">
            <h3 class="card-title text-navy text-uppercase font-weight-bold">
              <i class="fa fa-id-card mr-2 text-navy"></i>User Profile
            </h3>
          </div>
          <div class="card-body">
            <div class="text-center mb-4">
              <?PHP
                if (!empty($Picture_Url)){
                  $Profile_Picture = $Picture_Url;
                }
                else{
                  $Profile_Picture = "dist/img/blank-m.png";
                }
              ?>
              <img class="profile-user-img img-fluid img-circle" src="<?PHP echo $Profile_Picture; ?>" alt="User profile picture">
            </div>

            <span class="text-navy"><i class="fa fa-user mr-1 text-navy"></i> Name</span>
            <p class="text-muted"><?PHP echo $First_Name." ".$Last_Name; ?></p>

            <hr>

            <span class="text-navy"><i class="fa fa-crown mr-1 text-navy"></i> Level</span>
            <p class="text-muted"><?PHP echo $User_Level; ?></p>

            <hr>

            <span class="text-navy"><i class="fa fa-envelope mr-1 text-navy"></i> Email</span>
            <p class="text-muted"><?PHP echo $User_Email; ?></p>

            <hr>

            <span class="text-navy"><i class="fa fa-calendar-alt mr-1 text-navy"></i> Registered Since</span>
            <p class="text-muted"><?PHP echo $User_Create; ?></p>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
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