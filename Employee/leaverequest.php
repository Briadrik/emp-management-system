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
  $selectQuery ="SELECT * FROM employees WHERE EmpEmail = '".$_SESSION['useremployee']."'";
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script>
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('clock').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};
    return i;
}
</script>
</head>

<body id="page-top" onload="startTime()">
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
            <h1 class="h3 mb-0 text-gray-800">Leave Application</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <!-- <li class="breadcrumb-item active" aria-current="page">Dashboard</li> -->
            </ol>
          </div>

        </div>
				<div id="profile" style=" margin-top:-40px; position: absolute;  right: 0;">
			 <table>
			<?php
			$select ="SELECT * FROM employees WHERE EmpEmail = '".$_SESSION['useremployee']."'";
			$result2 = $conn->query($select);
				if ($result2->num_rows > 0) {
						while($row1 = $result2->fetch_assoc()) {
							?>
							<tr><th>Profile Picture : </th><td><img src ='img/default-image.png' height = 200 width = 200><a href = 'change_pp.php'>Change</a>&nbsp;&nbsp;&nbsp;<a href = 'delete_pp.php'>Delete</a></td></tr>
							<tr><th>Email ID : </th><td><?php echo $row1["EmpEmail"]; ?></td></tr>
							<tr><th>Employee Name : </th><td><?php echo $row1["EmpName"]; ?></td></tr>
							<tr><th>Gender : </th><td><?php echo $row1["Gender"]; ?></td></tr>
							<tr><th>Department : </th><td><?php echo $row1["Dept"]; ?></td></tr>
							
							<tr><th>Annual Leave : </th><td><?php echo $row1["AnnualLeave"]; ?></td></tr>
							<tr><th>Sick Leave : </th><td><?php echo $row1["SickLeave"]; ?></td></tr>
							<tr><th>Maternity Leave: </th><td><?php echo $row1["MaternityLeave"]; ?></td></tr>
							<tr><th>Parternity Leave : </th><td><?php echo $row1["ParternityLeave"]; ?></td></tr>
							<tr><th>Study Leave : </th><td><?php echo $row1["StudyLeave"]; ?></td></tr>
							<tr><th>Unpaid Leave : </th><td><?php echo $row1["UnpaidLeave"]; ?></td></tr>
							<tr><th>Date Of Joining : </th><td><?php echo $row1["DateOfJoin"]; ?></td></tr>
						<tr><th>Current Time : </th><td><div id = 'clock'></div></td></tr>
					<?php		
							}
				}
			?>
			</table>
      </div>
       <center>
			 <div class = 'textview'>
				<?php
				
				if(isset($_SESSION['useremployee']))
	{
	$user = $_SESSION['useremployee'];
	$sql = "SELECT * FROM employees WHERE EmpEmail = '".$user."'";
	$result3 = $conn->query($sql);
	if($result3->num_rows > 0)
		{
		while($row3 = $result3->fetch_assoc())
			{
			echo "<h2>Request For A Leave for : ".$_POST['type']."</h2>";
			echo "<form action = 'request_confirm.php' method = 'post' style='margin-left: 36%;'>";
			echo "<table>";
			echo "<input type = 'hidden' name = 'empname' value = '".$row3["EmpName"]."'>";
			echo "<input type = 'hidden' name = 'designation' value = '".$row3["Designation"]."'>";
			echo "<input type = 'hidden' name = 'dept' value = '".$row3["Dept"]."'>";
			echo "<input type = 'hidden' name = 'emptype' value = '".$row3["EmpType"]."'>";
			echo "<input type = 'hidden' name = 'leavetype' value = '".$_POST['type']."'>";
			echo "<tr><th> *Starting Date : </th><td><input type = 'date' name = 'leavedate' class = 'textbox shadow selected' step = '1'></td></tr>";
			echo "<tr><th> * No Of Leave Days : </th><td><input type = 'number' min = '1' name = 'leavedays' class = 'textbox shadow selected' step = '1'></td></tr>";
			echo "<tr><th> * Reason For Leave : </th><td><input type = 'text' name = 'leavereason' class = 'textbox shadow selected'></td></tr>";?>
			<tr><th> * Replacement : </th><td>
				<select name='employee' style="width: 100%;">
				<?//php EmpName != '".$row3['EmpName']."'?>
				<option value="">Select Replacement</option>
				<?php
				$sql3 = "SELECT EmpName,Dept FROM employees WHERE  Dept= '".$row3['Dept']."' AND EmpEmail != '".
				$row3['EmpEmail']."'";
				$result8 = $conn->query($sql3);
				if($result8->num_rows > 0)
					{
					while($row9= $result8->fetch_assoc())
						{
                while ($category = mysqli_fetch_array(
									$result8,MYSQLI_ASSOC)):;
            ?>	
                <option value="<?php echo $category["EmpName"];
                    // The value set is the primary key
                ?>"><?php echo $category["EmpName"];
								// To show the category name to the user
						?>
                </option>
            <?php
                endwhile;
                // While loop must be terminated
							}
						}
            ?>
		}
   ?>
	 <?php	
		}
			echo "<br/><tr><td><input type = 'submit' value = 'Request a Leave' class = 'login-button shadow' style='background-color: #303f9f; width:100%; margin-left:50%;'></td></tr>";
			echo "</form>";
			echo "<table>";
			$user = $_SESSION['useremployee'];
			$sql="SELECT * FROM employees WHERE  EmpName = '".$user."'";
			$result = $conn->query($sql);

		}
	}

				?>
			 </div>
			 </center>
			</div>
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