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
// auth check
$user_id = $_SESSION['supervisor'];
if (isset($_SESSION['supervisor'])){
	 $task_id = $_GET['task_id'];

if(isset($_POST['update_task_info'])){
  $errmsg = $sql = "";
	$title= trim($_POST['task_title']);
	$describe= trim($_POST['task_description']);
	$start= trim($_POST['t_start_time']);
	$dos = strip_tags($start);
	$end= trim($_POST['t_end_time']);
	$doe= strip_tags($end);
	$user= trim($_POST['assign_to']);
	$status=trim($_POST['status']);
	if(empty($title) || empty($describe) || empty($user) || empty($dos) || empty($doe)|| empty($status))
{
	$errmsg.="One or more fields are empty...";
}
else{
	echo "makweli";
		$qle="UPDATE task_info SET t_title = '".$title."', t_description = '".$describe."', t_start_time = '".$dos."', t_end_time = '".$doe."', t_user_id = '".$user."', status ='".$status."' WHERE task_id='".$task_id."'";
		if ($conn->query($qle) === TRUE) {
		echo "<center>";
		echo "<strong> Task Updated Successful !</strong><br/><br/>";
		echo "</center>";
		header('location:scheduling.php');
	}else {
		echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
}

$page_name="Edit Task";
$sql = "SELECT * FROM task_info WHERE task_id='$task_id' ";
$results = mysqli_query($conn,$sql);
if(mysqli_num_rows($results) > 0){
	$row= mysqli_fetch_assoc($results);
}else{
		$msg = "No Record found";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/attnlg.jpg" rel="icon">
  <title>Finance Scheduling</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="//code.ionicframework.com/nightly/js/ionic.min.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="//code.ionicframework.com/nightly/js/ionic.bundle.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
	
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
		
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
				<?php include "Navigation/topbar.php";?>
        <!-- Topbar -->
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Task Manager</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <!-- <li class="breadcrumb-item active" aria-current="page">Dashboard</li> -->
            </ol>
          </div>
        </div>
				<div class="row">
      <div class="col-md-12">
        <div class="well well-custom">
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <div class="well">
                <h3 class="text-center bg-primary" style="padding: 7px;">Edit Task </h3><br>

                      <div class="row">
                        <div class="col-md-12">
                          <form class="form-horizontal" role="form" action="" method="post" autocomplete="off">
                            <div class="form-group">
			                    <label class="control-label col-sm-5">Task Title</label>
			                    <div class="col-sm-7">
			                      <input type="text" placeholder="Task Title" id="task_title" name="task_title" list="expense" class="form-control" value="<?php echo $row['t_title']; ?>" readonly  val required>
			                    </div>
			                  </div>
			                  <div class="form-group">
			                    <label class="control-label col-sm-5">Task Description</label>
			                    <div class="col-sm-7">
			                      <textarea name="task_description" id="task_description" placeholder="Text Deskcription" class="form-control" rows="5" cols="5"><?php echo $row['t_description']; ?></textarea>
			                    </div>
			                  </div>
			                  <div class="form-group">
			                    <label class="control-label col-sm-5">Strat Time</label>
			                    <div class="col-sm-7">
			                      <input type="text" name="t_start_time" id="t_start_time"  class="form-control" value="<?php echo $row['t_start_time']; ?>">
			                    </div>
			                  </div>
			                  <div class="form-group">
			                    <label class="control-label col-sm-5">End Time</label>
			                    <div class="col-sm-7">
			                      <input type="text" name="t_end_time" id="t_end_time" class="form-control" value="<?php echo $row['t_end_time']; ?>">
			                    </div>
			                  </div>

												<div class="form-group">
			                    <label class="control-label col-sm-5">Assign To</label>
			                    <div class="col-sm-7">
			                      <?php 
			                        $slq = "SELECT * FROM employees WHERE Dept = '".$_SESSION['dept']."'";
															$resul= mysqli_query($conn,$slq);
															if(mysqli_num_rows($resul) > 0){
			                      ?>
			                      <select class="form-control" name="assign_to" id="aassign_to">
			                        <option value="">Select</option>

			                        <?php while($rows= mysqli_fetch_assoc($resul)){ ?>
			                        <option value="<?php echo $rows['Work_ID']; ?>" <?php
			                        	if($rows['Work_ID'] == $row['t_user_id']){
			                         ?> selected <?php } ?>><?php echo $rows['EmpName']; ?></option>
			                        <?php } ?>
			                      </select>
			                    </div>
			                   
			                  </div>

			                   <div class="form-group">
			                    <label class="control-label col-sm-5">Status</label>
			                    <div class="col-sm-7">
			                      <select class="form-control" name="status" id="status">
			                      	<option value="0" <?php if($row['status'] == 0){ ?>selected <?php } ?>>Incomplete</option>
			                      	<option value="1" <?php if($row['status'] == 1){ ?>selected <?php } ?>>In Progress</option>
			                      	<option value="2" <?php if($row['status'] == 2){ ?>selected <?php } ?>>Completed</option>
			                      </select>
			                    </div>
			                  </div>
                            
                            <div class="form-group">
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-3">
                                
                              </div>

                              <div class="col-sm-3">
                                <button type="submit" name="update_task_info" class="btn btn-success-custom">Update Now</button>
                              </div>
                            </div>
                          </form> 
                        </div>
                      </div>

              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
<?php }?>
<?php }?>

      </div>
      <!-- Footer -->

			<?php include "Navigation/footer.php";?>
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
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script type="text/javascript">
  flatpickr('#t_start_time', {
    enableTime: true
  });

  flatpickr('#t_end_time', {
    enableTime: true
  });

</script>
 
</body>

</html>