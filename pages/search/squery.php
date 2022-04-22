<?PHP
  require_once("../../config/session.php");
  require_once("../../config/database.php");
  require_once("../../com/home_map.php");
  
  switch ($_GET['page']){
    default:
      $Action     = "pages/search/rquery.php?act=src";
      $Parent_Url = "pages/search/rquery.php";
      $Head_bg    = "card-lightblue card-outline";      
      $Head_label = "Search By Query";
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
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="txtStartDate">Start Date</label>
                        <label class="badge bg-danger" style="margin-left: 10px;"> Required</label>
                        <input type="date" class="form-control datetimepicker-input" 
                          style="background-color: #F6F6F6;" 
                          id="txtStartDate" name="txtStartDate" placeholder="Start date" />
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="txtEndDate">End Date</label>
                        <label class="badge bg-danger" style="margin-left: 10px;"> Required</label>
                        <input type="date" class="form-control datetimepicker-input" 
                          style="background-color: #F6F6F6;" 
                          id="txtEndDate" name="txtEndDate" placeholder="End date" />
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="cmbQuery">Query</label>
                        <label class="badge bg-danger" style="margin-left: 10px;"> Required</label>
                        <select class="custom-select" style="width: 100%;" name="cmbQuery" id="cmbQuery">
                          <option value="0">- Pilih -</option>
                        </select>                        
                      </div>
                    </div>                    
                  </div>
                </div>
              </div>
            </div>
            <!-- End Form -->            

            <div class="modal-footer justify-content-between">
              <button type="button" class="btn <?PHP echo $Btn_color; ?>" onClick="javascript:result_query('<?PHP echo $Parent_Url; ?>')">  
                <i class="fa <?PHP echo $Btn_icon; ?> menu-icon mr-1"></i> <?PHP echo $Btn_label; ?></button>
              <div class="spinner" style="display: none;" align="center">
                <img id="img-spinner" src="spiner.gif" style="width: 30px; height: 30px;" title="Process" >
              </div>
            </div>
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
  $("#myForm").submit(function(event){ 
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
        $('#result_query').load("<?PHP echo $Parent_Url ; ?>");
        return false;
      } 
      else{
        toastr.error(response,'Confirm');
        $(".spinner").css("display","none");
      }
    });     
  });
</script>