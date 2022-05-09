<?PHP
  require_once("../../config/session.php");
  require_once("../../config/database.php");
  require_once("../../com/home_map.php");
  
  switch ($_GET['page']){
    default:
      $Action     = "pages/search/rquery.php";
      $Parent_Url = "pages/search/squery.php";
      $Head_bg    = "card-lightblue card-outline";      
      $Head_label = "Search by Query";
      $Head_icon  = "fa-magnifying-glass";
      $Btn_label  = "Search";
      $Btn_color  = "btn-success";
      $Btn_icon   = "fa-magnifying-glass";
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
      <div class="col-md-12">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a onClick="javascript:load_right('<?PHP echo $Home_Url; ?>')" style="cursor: pointer;" >Home</a></li>
          <li class="breadcrumb-item active"><?PHP echo $Btn_label; ?></li>
        </ol>
      </div>      
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <div class="card <?PHP echo $Head_bg; ?>" style="border-top-left-radius: 5px; border-top-right-radius: 5px;">
          <div class="card-header">
            <h3 class="card-title text-navy font-weight-bold text-uppercase">
              <small><strong><i class="fa <?PHP echo $Head_icon; ?> menu-icon mr-2 text-navy"></i> <?PHP echo $Head_label; ?></strong></small>
            </h3>
          </div>

          <!-- Start Form -->
          <div class="card-body">

            <div class="row">
              <div class="col-12 col-lg-12">

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="txt_id">ID</label>
                      <input type="text" class="form-control" 
                        style="background-color: #F6F6F6;" 
                        id="txt_id" name="txt_id" placeholder="ID debitur" />
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="cmbQuery">Query</label>
                      <div class="row">
                        <div class="col-sm-12">
                          <!-- checkbox -->
                          <div class="form-group clearfix">
                            <div class="icheck-primary">
                              <input type="checkbox" id="chk_id_reject" name="chk_id_reject" value="1">
                              <label for="chk_id_reject" class="font-weight-normal">
                                KTP ada di list reject
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <!-- checkbox -->
                          <div class="form-group clearfix">
                            <div class="icheck-primary">
                              <input type="checkbox" id="chk_id_pasangan_reject" name="chk_id_pasangan_reject" 
                                value="1">
                              <label for="chk_id_pasangan_reject" class="font-weight-normal">
                                KTP Pasangan ada di list reject
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <!-- checkbox -->
                          <div class="form-group clearfix">
                            <div class="icheck-primary">
                              <input type="checkbox" id="chk_phone_reject" name="chk_phone_reject" value="1">
                              <label for="chk_phone_reject" class="font-weight-normal">
                                No Telepon ada di list reject
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <!-- checkbox -->
                          <div class="form-group clearfix">
                            <div class="icheck-primary">
                              <input type="checkbox" id="chk_phone_pasangan_reject" name="chk_phone_pasangan_reject" 
                                value="1">
                              <label for="chk_phone_pasangan_reject" class="font-weight-normal">
                                No Telepon Pasangan di list Reject
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div class="form-group" style="margin-top:10px;">
                      <button type="button" class="btn btn-success" id="btnSearch" 
                        onclick="javascript:cb_result('<?PHP echo $Action; ?>');">  
                      <i class="fa <?PHP echo $Btn_icon; ?> menu-icon mr-1"></i> <?PHP echo $Btn_label; ?></button>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="spinner" hidden>Loading</label>
                      <div class="spinner" style="display: none;" align="center">
                        <img id="img-spinner" src="spiner.gif" style="width: 30px; height: 30px;" title="Process" >
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <!-- End Form -->
          
        </div>
      </div>

      <!-- result -->
      <div class="col-md-9" >
        <div style="min-height: 97%;" id="result_query">
          
        </div>
      </div>
    </div>

  </div>
</section>

<script type="text/javascript">
  function cb_result(urlx,navx){
    var txt_id  = document.getElementById('txt_id').value;
    
    if (document.getElementById('chk_id_reject').checked == true){
      var chk_id_reject = document.getElementById('chk_id_reject').value;
    }
    if (document.getElementById('chk_id_pasangan_reject').checked == true){
      var chk_id_pasangan_reject = document.getElementById('chk_id_pasangan_reject').value;
    }
    if (document.getElementById('chk_phone_reject').checked == true){
      var chk_phone_reject = document.getElementById('chk_phone_reject').value;
    }
    if (document.getElementById('chk_phone_pasangan_reject').checked == true){
      var chk_phone_pasangan_reject = document.getElementById('chk_phone_pasangan_reject').value;
    }
    
    $.ajax({
      url: urlx,
      data : {txt_id:txt_id, chk_id_reject:chk_id_reject, chk_id_pasangan_reject:chk_id_pasangan_reject, chk_phone_reject: chk_phone_reject, chk_phone_pasangan_reject:chk_phone_pasangan_reject},
      beforeSend:function(){$(".spinner").css("display","block");},
      success: function(html){
        $('#result_query').html(html);  
        $(".spinner").css("display","none");                   
      }
    });
  }
</script>