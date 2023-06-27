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
  <title>Set Default Leave</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
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
            <h1 class="h3 mb-0 text-gray-800">Set Default Leaves For Your Employees</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <!-- <li class="breadcrumb-item active" aria-current="page">Dashboard</li> -->
            </ol>
          </div>
          <div class = "textview">
<center>
<?php
	if(isset($_GET['msg']))
		{
			echo "<div class = 'error'><b><u>".htmlspecialchars($_GET['msg'])."</u></b></div>";
		}
	echo "<form action = 'setleaves.php' method = 'post'>
			<table>
				<tr>
				<td>Sick Leave : </td>
				<td><input type = 'number' min = '0' name = 'setsickleave' class = 'textbox shadow selected'></td>
				</tr>
				<tr>
				<td>Annual Leave : </td>
				<td><input type = 'number' min = '0' name = 'setannualleave' class = 'textbox shadow selected'></td>
				</tr>
				<tr>
				<td>Maternity Leave : </td>
				<td><input type = 'number' min = '0' name = 'setmaternityleave' class = 'textbox shadow selected'></td>
				</tr>
        <tr>
				<td>Paternity Leave : </td>
				<td><input type = 'number' min = '0' name = 'setpaternityleave' class = 'textbox shadow selected'></td>
				</tr>
        <tr>
				<td>Study Leave : </td>
				<td><input type = 'number' min = '0' name = 'setstudyleave' class = 'textbox shadow selected'></td>
				</tr>
        <tr>
				<td>Unpaid Leave : </td>
				<td><input type = 'number' min = '0' name = 'setunpaidleave' class = 'textbox shadow selected'></td>
				</tr>
				<tr>
				<td><input type = 'submit' value = 'Set' class = 'login-button shadow' style='background-color: #303f9f; width:100%; margin-left:100%; margin-top:20%;'></td>
				</tr>
			</table>
		</form>";
?>
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