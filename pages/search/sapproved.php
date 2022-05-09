<?PHP
  require_once("../../config/session.php");
  require_once("../../config/database.php");
  require_once("../../com/home_map.php");
  
  switch ($_GET['page']){
    default:
      $Action     = "pages/search/rapproved.php";
      $Parent_Url = "pages/search/sapproved.php";
      $Head_bg    = "card-lightblue card-outline";      
      $Head_label = "Search Data Approved";
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
      <div class="col-md-12">
        <div class="card <?PHP echo $Head_bg; ?>" style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
          <div class="card-header">
            <h3 class="card-title text-navy font-weight-bold text-uppercase">
              <small><strong><i class="fa <?PHP echo $Head_icon; ?> menu-icon mr-2 text-navy"></i> <?PHP echo $Head_label; ?></strong></small>
            </h3>
          </div>

          <form role="form" name="finput" id="myForm" method="post" action="<?PHP echo $Action; ?>" >
            <!-- Start Form -->
            <div class="card-body">

              <div class="row">
                <div class="col-12 col-lg-12">

                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="txtStartDate">Start Date</label>
                        <label class="badge bg-danger" style="margin-left: 10px;"> Required</label>
                        <input type="date" class="form-control datetimepicker-input" 
                          style="background-color: #F6F6F6;" 
                          id="txtStartDate" name="txtStartDate" placeholder="Start date" />
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="txtEndDate">End Date</label>
                        <label class="badge bg-danger" style="margin-left: 10px;"> Required</label>
                        <input type="date" class="form-control datetimepicker-input" 
                          style="background-color: #F6F6F6;" 
                          id="txtEndDate" name="txtEndDate" placeholder="End date" />
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group" style="margin-top:32px;">
                        <button type="button" class="btn btn-success" id="btnSearch" 
                          onclick="javascript:cb_result('<?PHP echo $Action; ?>');">  
                        <i class="fa <?PHP echo $Btn_icon; ?> menu-icon mr-1"></i> <?PHP echo $Btn_label; ?></button>
                      </div>
                    </div>

                    <div class="col-md-1">
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
          </form>
          
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <!-- <div class="col-sm-6">
          <h3 class="card-title text-navy font-weight-bold text-uppercase">Result Query</h3>
        </div> -->
        <div id="result_query"></div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
  function cb_result(urlx,navx){
    var txtStartDate  = document.getElementById('txtStartDate').value;
    var txtEndDate    = document.getElementById('txtEndDate').value;
    $.ajax({
      url: urlx,
      data : {txtStartDate:txtStartDate, txtEndDate:txtEndDate},
      beforeSend:function(){$(".spinner").css("display","block");},
      success: function(html){
        $('#result_query').html(html);  
        $(".spinner").css("display","none");                   
      }
    });
  }
</script>