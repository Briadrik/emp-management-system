<?php
include '../Database/dbcon.php';
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
  <title>Leave Management Report</title>
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
            <h1 class="h3 mb-0 text-gray-800">Leave Management Report </h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <!-- <li class="breadcrumb-item active" aria-current="page">Dashboard</li> -->
            </ol>
          </div>
          <div class = 'textview'>
	<?php
	if(isset($_GET['msg']))
		{
			echo htmlspecialchars($_GET['msg']);
		}
	?>
	<form action = 'clientnavi.php' method = 'post' style="text-align:center; margin-left:30%; margin-top:10%; width:500%; height:1000px; font-size:20px;">
		<table>
			<tr><td><input type = 'submit' value = 'Extract' class = 'login-button shadow' style="background-color: #4c60da; width:200px; color:rgba(255,255,255,0.9); margin-top:20px; text-align:center; margin-left: 100px;"></td></tr>
		</table>
	</form>
	</center>
</div>
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