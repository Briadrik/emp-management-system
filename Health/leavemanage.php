<?php
session_start();
include '../Database/dbcon.php';
if(isset($_SESSION['supervisor']))
{
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img\logo\download.png" rel="icon">
  <title>Leave Management System</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
   <?php include "Navigation/sidebar.php";?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
           <?php include "Navigation/topbar.php";?>
        <!-- Topbar -->
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Leave Management System </h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <!-- <li class="breadcrumb-item active" aria-current="page">Dashboard</li> -->
            </ol>
          </div>

          <div class="row mb-3">
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1"><a href="accept.php">Accept/Reject Leave</a></div>
            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></div>
            <div class="mt-2 mb-0 text-muted text-xs">
              <!-- <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
              <span>Since last month</span> -->
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-users fa-2x text-info"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1"><a href="reports.php">Health leave Reports</a></div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
            <div class="mt-2 mb-0 text-muted text-xs">
              <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
              <span>Since last month</span> -->
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-chalkboard fa-2x text-primary"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</div>
          <!--Row-->

      

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <?php include 'Navigation/footer.php';?>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <script src="../vendor/chart.js/Chart.min.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>  
</body>

</html>
<?php
}
else
	{
	header('location:\Employee Management System\index.php?err='.urlencode('Please Login First To Access This Page!'));
	}
?>