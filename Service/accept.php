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
 
  $selectQuery ="SELECT department, emailAddress FROM supervisor WHERE emailAddress = '".$_SESSION['supervisor']."'";
  $result = mysqli_query($conn,$selectQuery);
  if(mysqli_num_rows($result) > 0){
  }else{
      $msg = "No Record found";
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
  <link rel="stylesheet" type="text/css" href="css/table.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
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
            <h1 class="h3 mb-0 text-gray-800">View Employees Leaves </h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <!-- <li class="breadcrumb-item active" aria-current="page">Dashboard</li> -->
            </ol>
          </div>

        </div>
        <!---Container Fluid-->
        <div class = "textview">   
<center>
<?echo $msg;?>
<?php
$count = 0;
while($row = mysqli_fetch_assoc($result))
{
  $d=$row['department'];

  $select = "SELECT e.Work_ID,e.Dept,e.EmpName,el.EmpName,el.LeaveType,el.RequestDate,el.LeaveDays,el.StartDate,el.EndDate,el.id,el.Dept FROM employees e, emp_leaves el WHERE e.Dept = el.Dept AND el.Statusv = 'Requested' AND e.EmpName = el.EmpName";
  $result2 = mysqli_query($conn,$select);
    if(mysqli_num_rows($result2) > 0){
        echo "<table>";
        echo "<tr>";
        echo "<th>Employee Name</th>";
        echo "<th>Leave Type</th>";
        echo "<th>Request Date</th>";
        echo "<th>Leave Days</th>";
        echo "<th>Starting Date</th>";
        echo "<th>Ending Date</th>";
        echo "<th>Action</th>";
        echo "</tr>";
        while ($row2 = $result2->fetch_assoc())
          {
          echo "<tr>";
          echo "<td>";
          echo $row2['EmpName'];
          echo "</td>";
          echo "<td>";
          echo $row2['LeaveType'];
          echo "</td>";
          echo "<td>";
          echo $row2['RequestDate'];
          echo "</td>";
          echo "<td>";
          echo $row2['LeaveDays'];
          echo "</td>";
          echo "<td>";
          echo $row2['StartDate'];
          echo "</td>";
          echo "<td>";
          echo $row2['EndDate'];
          echo "</td>";
          echo "<td><a href = 'acceptleave.php?id=".$row2['id']."&empid=".$row2["Work_ID"]."'>Accept</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href = 'rejectleave.php?id=".$row2['id']."&empid=".$row2["Work_ID"]."'>Reject</a></td>";
        echo "</tr>";
        $count++;
        }
      echo $count." Leave(s)";
    }
  echo "</table>";
  }
?>
</center>
      </div>
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
