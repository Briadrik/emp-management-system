<?php
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
  $selectQuery ="SELECT * FROM employees";
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
  <title>NCEMS EMPLOYEES</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/table.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
   <?php include "Includes/sidebar.php";?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
           <?php include "Includes/topbar.php";?>
        <!-- Topbar -->
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">County Employees  </h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <!-- <li class="breadcrumb-item active" aria-current="page">Dashboard</li> -->
            </ol>
          </div>

        </div>
        <a href="register.php"><div class='container2'>
        <div>
            <img src='img/adduser.png' class='iconDetails' width="50px" height="50px" style="margin-left: 90%;">
        </div>  
        <div style='margin-left:88%;'>
    <h6>Add Employee</h6>
    </div>
</div></a>
        <!---Container Fluid-->
       
      <?echo $msg;?>
        <table style="width: 100%;">
<thead>
        <tr>
          <th>Work id</th>
          <th>Full Name</th>
          <th>Employee Email</th>
          <th>Department</th>
          <th>Date of Join</th>
          <th>Employee Type</th>
        </tr>
</thead>
<tbody>
<?php
                while($row = mysqli_fetch_assoc($result)){?>
        <tr>
              <td><?php echo $row['Work_ID']; ?></td>
              <td><?php echo $row['EmpName']; ?></td>
              <td><?php echo $row['EmpEmail']; ?></td>
              <td><?php echo $row['Dept']; ?></td>
              <td><?php echo $row['DateOfJoin']; ?></td> 
              <td><?php echo $row['EmpType']; ?></td>
              <!-- <td><a href = 'update.php?id=<?php echo $row['Work_ID']; ?>'>Update</a></td> -->
              <td><a href = 'empdelete.php?id=<?php echo $row['Work_ID']; ?>'>Delete</a></td>
            </tr>
            <?php }?>
</tbody>
        </table>
      </div>
      <!-- Footer -->
      <?php include 'Includes/footer.php';?>
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