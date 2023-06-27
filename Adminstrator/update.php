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
  $task_id = $_GET['id'];
  
  if(isset($_POST['btn_update'])){
    $errmsg = $sql = "";
$empno=trim($_POST['empno']);
$empname = trim($_POST['empname']);
$mailid = trim($_POST['mailid']);
$doj = trim($_POST['dobjoin']);
$dob = trim($_POST['dob']);
$empname = strip_tags($empname);
$mailid = strip_tags($mailid);
$doj = strip_tags($doj);
$dob = strip_tags($dob);
$pass = md5(trim($_POST['emppass']));
$department = strip_tags(trim($_POST['depart']));
$emptype = strip_tags(trim($_POST['factype']));
    if(empty($empno) || empty($empname) || empty($mailid) || empty($doj) || empty($dob)|| empty($gender)||empty($pass)||empty($department)|| empty($emptype))
  {
    $errmsg.="One or more fields are empty...";
  }
  else{
    echo "makweli";
      $qle="UPDATE employees SET EmpName = '".$empname."',EmpPass='".$pass."',Dept='".$department."',EmpEmail='".$mailid."',WHERE Work_ID='".$task_id."'";
      if ($conn->query($qle) === TRUE) {
      echo "<center>";
      echo "<strong> Profile Account Updated Successful !</strong><br/><br/>";
      echo "</center>";
      header('location:index.php');
    }else {
      echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }
  }
  $sql ="SELECT * FROM employees WHERE Work_ID='$task_id'";
  $results = mysqli_query($conn,$sql);
  if(mysqli_num_rows($results) > 0){
    $row= mysqli_fetch_assoc($results);
    echo"aisiwfoeferogrog";
  }else{
      $msg = "No Record found";
  };
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
            <h1 class="h3 mb-0 text-gray-800">Update Employee Details</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <!-- <li class="breadcrumb-item active" aria-current="page">Dashboard</li> -->
            </ol>
          </div>

        </div>
       
        <div class="register">
        <div class="container-fuild" style="margin-top:30px">
      <div class="row">
          <div class="col-md-10 offset-md-1">
             <div class="card" style="border-color: blue ;">
              <div class="card-header bg-info text-white" >
                <h><b>Employees Form</b></h>
               </div>
               <div class="card-body" style="background-color: #e9ecef ;">
                <form action="" method="post" enctype="multipart/form-data" role="form">
                  <div class="row">
                    <div class="col-md-8">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="empno">Employee Work Number</label>
                            <input type="text" class="form-control" name="empno" id="empno" required="" value="<?php echo $row['Work_ID'];?>">
                            <span id="available"></span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="empname">Employee Full Name</label>
                            <input type="text" value="<?php echo $row['EmpName'];?>" class="form-control" name="empname" id="empname" required="">
                            <span id="available"></span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="mailid">Employee Email</label>
                            <input type="email" class="form-control" value="<?php echo $row['EmpEmail'];?>" name="mailid" id="mailid" required="">
                            <span id="available"></span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" class="form-control" value="<?php echo $row['DateOfBirth'];?>" name="dob" id="dob">
                            <span id="available"></span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="dobjoin">Date of Joining</label>
                            <input type="date" value="<?php echo $row['DateOfJoin'];?>" class="form-control" name="dobjoin" id="dobjoin">
                            <span id="available"></span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="depart">Department</label>
                            <select name = 'depart' class="form-control" id="depart">
                              <option value=''><?php echo $row['Dept'];?></option>
                              <option value='Finance and Economic Planning'>Finance and Economic Planning</option>
                              <option value='Education, ICT and e-Government Services'>Education, ICT and e-Government Services</option>
                              <option value='Trade,Industrialization and Innovation'>Trade,Industrialization and Innovation</option>
                              <option value='Public Service'>Public Service</option>
                              <option value='Water, Irrigation Environment and Neutral Resources'>Water, Irrigation Environment and Neutral Resources</option>
                              <option value='Tourism, Culture,Youth and Sports'>Tourism, Culture,Youth and Sports</option>
                              <option value='Health and Emergency Services'>Health and Emergency Services</option>
                              <option value='Land,Housing and Physical Planning'>Land,Housing and Physical Planning</option>
                            </select>
                            <span id="available"></span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="empname">Employee Type</label>
                            <select name = 'factype' class="form-control">
                              <?php if ($row['EmpType']=='Permanent'){
                            ?>
                              <option>Permanent</option>
                              <?php } else {?>
                              <option>Intern</option>
                              <?php }?>
                            </select>
                            <span id="available"></span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="emppass">Password</label>
                            <input type="password" value="<?php echo $row['EmpEmail'];?>" class="form-control" name="emppass" id="emppass">
                            <span id="available"></span>
                          </div>
                        </div>
                        <!--END-->
                      </div>
                    </div>
                  <!--display image-->
                  <div class="col-md-4">
                    <br class="row">
                      <div class="col-md-12">
                           <br style="text-align: center;">
                            <img id="img-upload">
                            
                            <div id="tem_img">
                              <img id="profile" src="img/avatar.webp"alt="" width="180px" height="170px">
                           </div>
                           <br></br>
                           <div class="input-group">
                            <span class="input-group-btn">
                            </span>
                        </span>
                        </div>
                      
                    </div>
                    <br></br>
                    <div class="col-md-12" style="text-align:centre ;">
                      <input type="submit" id="btn" name="btn_update" value="update" class="btn btn-primary" style="width:100px; border-radius:10px">
                      &nbsp;&nbsp;
                      <input type="reset" id="reset" name="btn_cancle" value="cancel" class="btn btn-warning" style="width:100px; border-radius:10px">
                      &nbsp;&nbsp;
                      <button onclick="window.location.reload(true)" class="btn btn-success" style="width:100px; border-radius:10px" > Refresh</button>


                    </div>
                           </div>

                      </div>

                    </div>

                  </div>
                  </div>
            </form>
            </div>
            </div>
            <script>
              var loadFile=function(event){
                var image = document.getElementById('profile');
                image.src=URL.createObjectURL(event.target.files[0]);
              };
            </script>
        </div>
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