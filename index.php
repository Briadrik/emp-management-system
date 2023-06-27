
<?php 
include 'Database/dbcon.php';
session_start();
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
  <title>NCEMS - Login</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-login" style="background-image: url('img/logo/loral1.jpe00g');">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                <h5 align="center">EMPLOYEE MANAGEMENT SYSTEM</h5>
                  <div class="text-center">
                    <img src="img\logo\download.png" style="width:100px;height:100px">
                    <br><br>
                    <h1 class="h4 text-gray-900 mb-4"><b>Login</b></h1>
                  </div>
                  <form class="user" method="Post" action="">
                  <div class="form-group">
                    <!-- Login Content -->
            
                <select required id="userselect" name="userType" class="form-control mb-3" onchange="listSelect()">
                          <option value="">--Select User Roles--</option>
                          <option value="Administrator">Administrator</option>
                          <option value="humanresource">HR</option>
                          <option value="supervisor">Supervisor</option>
                          <option value="employee">COUNTY EMPLOYEE</option>
                  </select>
                    </div>
                    <script>
                      function listSelect(){
              var x = document.getElementById("deptselect");
              var thelist = document.getElementById("userselect");
              var theValue=thelist.options[thelist.selectedIndex].value;
              if(theValue.includes('supervisor')){
                x.style.display="block";
              }else{
                x.style.display="none";
              }

                    }
            </script>
                <div class='form-group'>
                  <select  id="deptselect" name='deptType' class='form-control mb-3' style="display:none;">
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
                </div>
                 
                    <div class="form-group">
                      <input type="text" class="form-control" required name="username" id="exampleInputEmail" placeholder="Enter Email Address">
                    </div>
                    <div class="form-group">
                      <input type="password" name = "password" required class="form-control" id="exampleInputPassword" placeholder="Enter Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <!-- <label class="custom-control-label" for="customCheck">Remember
                          Me</label> -->
                      </div>
                    </div>
                    <div class="form-group">
                        <input type="submit"  class="btn btn-success btn-block" value="Login" name="login" />
                    </div>
                     </form>
<?php

  if(isset($_POST['login'])){

    $userType = $_POST['userType'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $department = $_POST['deptType'];
    $password = md5($password);

    if($userType == "Administrator"){

      $query = "SELECT * FROM adminstrator WHERE emailAddress = '$username' AND password = '$password'";
      $rs = $conn->query($query);
      $num = $rs->num_rows;
      $rows = $rs->fetch_assoc();

      if($num > 0){

        $_SESSION['adminuser'] = $rows['Id'];
        $_SESSION['firstName'] = $rows['firstName'];
        $_SESSION['lastName'] = $rows['lastName'];
        $_SESSION['emailAddress'] = $rows['emailAddress'];
      
        echo "<script type = \"text/javascript\">
        window.location = (\"Adminstrator/index.php\")
        </script>";
      }

      else{

        echo "<div class='alert alert-danger' role='alert'>
        Invalid Username/Password/select Department!
        </div>";

      }
    }
    else if($userType == "humanresource"){

      $query = "SELECT * FROM hr WHERE emailAddress = '$username' AND password = '$password'";
      $rs = $conn->query($query);
      $num = $rs->num_rows;
      $rows = $rs->fetch_assoc();

      if($num > 0){

        $_SESSION['user'] = $rows['Id'];
        $_SESSION['firstName'] = $rows['firstName'];
        $_SESSION['lastName'] = $rows['lastName'];
        $_SESSION['hruser'] =$username ;
      $_SESSION['dept'] = $row['Dept'];
       

        echo "<script type = \"text/javascript\">
        window.location = (\"HR/index.php\")
        </script>";
      }

      else{

        echo "<div class='alert alert-danger' role='alert'>
        Invalid Username/Password!
        </div>";

      }
    }
    else if($userType == "employee"){

      $query = "SELECT * FROM employees WHERE EmpEmail = '$username' AND EmpPass = '$password'";
      $rs = $conn->query($query);
      $num = $rs->num_rows;
      $rows = $rs->fetch_assoc();

      if($num > 0){

        $_SESSION['useremployee'] = $username;
			  $_SESSION['dept'] = $row['Dept'];
        $_SESSION['name'] = $row['EmpName'];

        echo "<script type = \"text/javascript\">
        window.location = (\"Employee/index.php\")
        </script>";
      }

    }
    else if($userType == "supervisor"){

      $query = "SELECT * FROM supervisor WHERE emailAddress = '$username' AND passwords = '$password' AND department='$department'";
      $rs = $conn->query($query);
      $num = $rs->num_rows;
      $rows = $rs->fetch_assoc();
      if($num > 0){
        $_SESSION['supervisor'] = $username;
			  $_SESSION['dept'] = $department;
        if($department == "Finance and Economic Planning"){
       
        echo "<script type = \"text/javascript\">
        window.location = (\"Finance/index.php\")
        </script>";

      }else if($department == "Education, ICT and e-Government Services"){
        echo "<script type = \"text/javascript\">
        window.location = (\"Education/index.php\")
        </script>";
      }else if($department == "Public Service"){
        echo "<script type = \"text/javascript\">
        window.location = (\"Service/index.php\")
        </script>";
      }else if($department == "Water, Irrigation Environment and Neutral Resources"){
        echo "<script type = \"text/javascript\">
        window.location = (\"Water/index.php\")
        </script>";
      }else if($department == "Tourism, Culture,Youth and Sports"){
        echo "<script type = \"text/javascript\">
        window.location = (\"Tourism/index.php\")
        </script>";
      }else if($department == "Health and Emergency Services"){
        echo "<script type = \"text/javascript\">
        window.location = (\"Health/index.php\")
        </script>";
      }else if($department == "Land,Housing and Physical Planning"){
        echo "<script type = \"text/javascript\">
        window.location = (\"Land/index.php\")
        </script>";
      }else if($department == "Trade,Industrialization and Innovation"){
         echo "<script type = \"text/javascript\">
        window.location = (\"Trade/index.php\")
        </script>";
      }
      } else{

        echo "<div class='alert alert-danger' role='alert'>
        Invalid Username/Password/Department!
        </div>";

      }
    }
    else{

        echo "<div class='alert alert-danger' role='alert'>
        Invalid Username/Password/Department!
        </div>";

    }
}
?>


                
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
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
</body>

</html>