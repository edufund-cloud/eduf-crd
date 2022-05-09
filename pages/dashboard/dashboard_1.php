<?PHP
  require_once("../../config/session.php");
  require_once("../../config/database.php");
?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
      <div class="col-12 col-sm-6 col-md-4">
        <div class="info-box">
          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-clipboard-check"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Pefindo</span>
            <span class="info-box-number">
              <?PHP
                $sql_pef = "SELECT COUNT(a.data_id) AS jml_pef 
                    FROM apply a 
                    WHERE a.data_status = 'New Loan'";
                $xsql_pef = mysqli_query($koneksi, $sql_pef);
                $arsql_pef = mysqli_fetch_array($xsql_pef);

                $jml_pef = $arsql_pef['jml_pef'];
                $jml_pef = number_format($jml_pef);
                echo $jml_pef;
              ?>
              <small>File</small>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-4">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-info elevation-1"><i class="fas fa-phone-volume"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">PV Process</span>
            <span class="info-box-number">
              <?PHP
                $sql_pv = "SELECT COUNT(a.data_id) AS jml_pv 
                    FROM apply a 
                    WHERE (a.data_status = 'Pefindo Done' OR a.data_status = 'Pending PV' OR a.data_status = 'Send Back PV')";
                $xsql_pv = mysqli_query($koneksi, $sql_pv);
                $arsql_pv = mysqli_fetch_array($xsql_pv);

                $jml_pv = $arsql_pv['jml_pv'];
                $jml_pv = number_format($jml_pv);
                echo $jml_pv;
              ?>
              <small>File</small>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <div class="col-12 col-sm-6 col-md-4">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-orange elevation-1"><i class="fas fa-chart-simple"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Data Analyst</span>
            <span class="info-box-number">
              <?PHP
                $sql_anl = "SELECT COUNT(a.data_id) AS jml_anl 
                    FROM apply a 
                    WHERE (a.data_status = 'PV Done' OR a.data_status = 'Send Back Analyst')";
                $xsql_anl = mysqli_query($koneksi, $sql_anl);
                $arsql_anl = mysqli_fetch_array($xsql_anl);

                $jml_anl = $arsql_anl['jml_anl'];
                $jml_anl = number_format($jml_anl);
                echo $jml_anl;
              ?>
              <small>File</small>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-4">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-thumbs-up"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">CRO</span>
            <span class="info-box-number">
              <?PHP
                $sql_cro = "SELECT COUNT(a.data_id) AS jml_cro 
                    FROM apply a 
                    WHERE (a.data_status = 'Recommended Analyst' or a.data_status = 'Send Back CRO')";
                $xsql_cro = mysqli_query($koneksi, $sql_cro);
                $arsql_cro = mysqli_fetch_array($xsql_cro);

                $jml_cro = $arsql_cro['jml_cro'];
                $jml_cro = number_format($jml_cro);
                echo $jml_cro;
              ?>
              <small>File</small>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-4">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user-pen"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">CEO</span>
            <span class="info-box-number">
              <?PHP
                $sql_ceo = "SELECT COUNT(a.data_id) AS jml_ceo 
                    FROM apply a 
                    WHERE (a.data_status = 'Recommended CRO')";
                $xsql_ceo = mysqli_query($koneksi, $sql_ceo);
                $arsql_ceo = mysqli_fetch_array($xsql_ceo);

                $jml_ceo = $arsql_ceo['jml_ceo'];
                $jml_ceo = number_format($jml_ceo);
                echo $jml_ceo;
              ?>
              <small>File</small>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-4">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-trash-can"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Reject</span>
            <span class="info-box-number">
              <?PHP
                $sql_rjc = "SELECT COUNT(a.data_id) AS jml_rjc 
                    FROM apply a 
                    WHERE (a.data_status = 'Rejected')"; 
                $xsql_rjc = mysqli_query($koneksi, $sql_rjc);
                $arsql_rjc = mysqli_fetch_array($xsql_rjc);

                $jml_rjc = $arsql_rjc['jml_rjc'];
                $jml_rjc = number_format($jml_rjc);
                echo $jml_rjc;
              ?>
              <small>File</small>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

    </div>
    <!-- /.row -->

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Monthly Recap Report</h5>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <div class="btn-group">
                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                  <i class="fas fa-wrench"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" role="menu">
                  <a href="#" class="dropdown-item">Action</a>
                  <a href="#" class="dropdown-item">Another action</a>
                  <a href="#" class="dropdown-item">Something else here</a>
                  <a class="dropdown-divider"></a>
                  <a href="#" class="dropdown-item">Separated link</a>
                </div>
              </div>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>

          <!-- 
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <p class="text-center">
                  <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                </p>

                <div class="chart">
                  <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                </div>
              </div>
              <div class="col-md-4">
                <p class="text-center">
                  <strong>Goal Completion</strong>
                </p>

                <div class="progress-group">
                  Add Products to Cart
                  <span class="float-right"><b>160</b>/200</span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-primary" style="width: 80%"></div>
                  </div>
                </div>

                <div class="progress-group">
                  Complete Purchase
                  <span class="float-right"><b>310</b>/400</span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-danger" style="width: 75%"></div>
                  </div>
                </div>

                <div class="progress-group">
                  <span class="progress-text">Visit Premium Page</span>
                  <span class="float-right"><b>480</b>/800</span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-success" style="width: 60%"></div>
                  </div>
                </div>

                <div class="progress-group">
                  Send Inquiries
                  <span class="float-right"><b>250</b>/500</span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-warning" style="width: 50%"></div>
                  </div>
                </div>

              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                  <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                  <h5 class="description-header">$35,210.43</h5>
                  <span class="description-text">TOTAL REVENUE</span>
                </div>
              </div>
              <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                  <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                  <h5 class="description-header">$10,390.90</h5>
                  <span class="description-text">TOTAL COST</span>
                </div>
              </div>
              <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                  <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                  <h5 class="description-header">$24,813.53</h5>
                  <span class="description-text">TOTAL PROFIT</span>
                </div>
              </div>
              <div class="col-sm-3 col-6">
                <div class="description-block">
                  <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                  <h5 class="description-header">1200</h5>
                  <span class="description-text">GOAL COMPLETIONS</span>
                </div>
              </div>
            </div>
          </div>
          -->
          
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!--/. container-fluid -->
</section>
<!-- /.content -->