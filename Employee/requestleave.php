<?php
session_start();
// First connect to the database via your connection insert file
$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "ncemsdb";
	
	$conn = mysqli_connect($host, $user, $pass, $db);
	if(mysqli_connect_errno()){
		echo mysqli_connect_error();
    exit();
	} 
  
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
  <title>Accept / Reject Leave</title>
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
        <?php
              if(isset($_SESSION['status']))
              {?>
              <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['status'];
                unset($_SESSION['status']);?>
              </div>
             <?php   
              }?>
              <?php
              if(isset($_SESSION['status_error']))
              {?>
              <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['status_error'];
                unset($_SESSION['status_error']);?>
              </div>
             <?php   
              }?>
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Request Leave</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <!-- <li class="breadcrumb-item active" aria-current="page">Dashboard</li> -->
            </ol>
</div>
</div>
<!---Container Fluid-->
  <?php

  if(isset($_SESSION['useremployee']))
	{
  
	echo "<link rel='stylesheet' type='text/css' href='css/style.css'>";
	echo "<center>";
	echo "<div class = 'textview'>";
	echo "<h1>Leave Management System</h1>";
	echo "<h2>Please Select Your Leave Type</h2>";
	if(isset($_GET['err']))
				{
				echo "<div class = 'error'><b><u>".htmlspecialchars($_GET['err'])."</u></b></div>";
				}
	echo "<form action = 'leaverequest.php' method = 'post'>";
  $selectQuery ="SELECT * FROM employees WHERE EmpEmail = '".$_SESSION['useremployee']."'";
  $result = mysqli_query($conn,$selectQuery);
  if(mysqli_num_rows($result) > 0){
    while($row = $result->fetch_assoc())
    {
      $USER=$_SESSION['useremployee'];
			if($row['SickLeave'] > 0 && $row['value_s'] ==0)
					{
					echo "<button type = 'submit' name = 'type' value = 'Sick Leave' class = 'login-button shadow' style='background-color: #303f9f;  margin-right: 5px;'>Sick Leave</button>";	
					}
          else{
            echo "<button type = 'submit' name = 'type' value = 'Sick Leave' style='margin-right: 5px;' class = 'error-button shadow' disabled>Sick Leave</button>";
          }
	
				if($row['AnnualLeave'] > 0 && $row['value_s'] ==0)
					{
					echo "<button type = 'submit' name = 'type' value = 'Annual Leave' style='background-color: #303f9f;margin-right: 5px;'  class = 'login-button shadow'>Annual Leave</button>";	
					}
				else
					{
						echo "<button type = 'submit' name = 'type' value = 'Annual Leave' style='margin-right: 5px;' class = 'error-button shadow' disabled>Annual Leave</button>";
					}
				if($row['Gender'] == 'Female' && $row['MaternityLeave'] > 0 && $row['value_s'] ==0)
					{
					echo "<button type = 'submit' name = 'type' value = 'Maternity Leave' style='background-color: #303f9f;margin-right: 5px;' class = 'login-button shadow'>Maternity Leave</button>";	
					}
				else
					{
						echo "<button type = 'submit' name = 'type' value = 'Maternity Leave' style='margin-right: 5px;' class = 'error-button shadow' disabled>Maternity Leave</button>";
					}
          if($row['Gender'] == 'Male' && $row['ParternityLeave'] > 0 && $row['value_s'] ==0)
					{
					echo "<button type = 'submit' name = 'type' value = 'Parternity Leave' style='background-color: #303f9f;margin-right: 5px;' class = 'login-button shadow'>Parternity Leave</button>";	
					}
				else
					{
						echo "<button type = 'submit' name = 'type' value = 'Parternity Leave' style='margin-right: 5px;' class = 'error-button shadow' disabled>Parternity Leave</button>";
					}
          if($row['StudyLeave'] > 0 && $row['value_s'] ==0)
					{
					echo "<button type = 'submit' name = 'type' value = 'Study Leave' style='background-color: #303f9f; margin-right: 5px;' class = 'login-button shadow'>Study Leave</button>";	
					}
				else
					{
						echo "<button type = 'submit' name = 'type' value = 'Study Leave' style=' margin-right: 5px;'  class = 'error-button shadow' disabled>Study Leave</button>";
					}
          if($row['UnpaidLeave'] >0 && $row['value_s'] ==0)
					{
					echo "<button type = 'submit' name = 'type' value = 'Unpaid Leave' style='background-color: #303f9f; margin-right: 5px;' class = 'login-button shadow'>Unpaid Leave</button>";	
					}
				else
					{
						echo "<button type = 'submit' name = 'type' value = 'Unpaid Leave' style=' margin-right: 5px;' class = 'error-button shadow' disabled>Unpaid Leave</button>";
					}
				}
      }
        else{
          $msg = "No Record found";
      }
		}
	echo "</form>";
?>

<script type="text/javascript">
        function noBack()
         {
             window.history.forward()
         }
        noBack();
        window.onload = noBack;
        window.onpageshow = function(evt) { if (evt.persisted) noBack() }
        window.onunload = function() { void (0) }
    </script>
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