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
            <h1 class="h3 mb-0 text-gray-800">New Employee Registration</h1>
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
                <form action="confirm.php" method="post" enctype="multipart/form-data" role="form">
                  <div class="row">
                    <div class="col-md-8">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="empno">Employee Work Number</label>
                            <input type="text" class="form-control" name="empno" id="empno" required="">
                            <span id="available"></span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="empname">Employee Full Name</label>
                            <input type="text" class="form-control" name="empname" id="empname" required="">
                            <span id="available"></span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="mailid">Employee Email</label>
                            <input type="email" class="form-control" name="mailid" id="mailid" required="">
                            <span id="available"></span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <fieldset class="form-group">
                            <p>Gender</p>
                            <div class="form-check-inline">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="gender" value="Male">Male
                              </label>
                            </div>
                            <div class="form-check-inline">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="gender" value="Female">Female
                              </label>
                            </div>
                          </fieldset>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" class="form-control" name="dob" id="dob">
                            <span id="available"></span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="dobjoin">Date of Joining</label>
                            <input type="date" class="form-control" name="dobjoin" id="dobjoin">
                            <span id="available"></span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="depart">Department</label>
                            <select name = 'depart' class="form-control" id="depart">
                              <option value=''>--Select Department--</option>
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
                              <option>Permanent</option><option>Intern</option>
                            </select>
                            <span id="available"></span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="emppass">Password</label>
                            <input type="password" class="form-control" name="emppass" id="emppass">
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
                              <span class="btn btn-info btn-file">
                               Image<input class="file-upload-input" type="file" name="image" onchange="loadFile(event)" accept="Image/*">
                            </span>
                        </span>
                        </div>
                      
                    </div>
                    <br></br>
                    <div class="col-md-12" style="text-align:centre ;">
                      <input type="submit" id="btn" name="btn" value="insert" class="btn btn-primary" style="width:100px; border-radius:10px">
                      &nbsp;&nbsp;
                      <input type="reset" id="reset" name="btn" value="cancel" class="btn btn-warning" style="width:100px; border-radius:10px">
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