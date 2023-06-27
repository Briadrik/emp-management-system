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
     
  // check admin
  $user_role = $_SESSION['supervisor'];
  $department=$_SESSION['dept'];
  if(isset($_GET['delete_task'])){
    $action_id = $_GET['task_id'];
    $sq = "DELETE FROM task_info WHERE task_id = $action_id";
    if ($conn->query($sq) === TRUE) {
			echo "<center>";
			echo "<strong> Task Deleted !</strong><br/><br/>";
      echo "</center>";
      header('location:scheduling.php');
    }else {
      echo "Error: " . $sql . "<br>" . $conn->error;
        }
$conn->close();
  }
  
  if(isset($_POST['add_task_post'])){
    $errmsg = $sql = "";
    $title= trim($_POST['task_title']);
    $describe= trim($_POST['task_description']);
    $start= trim($_POST['t_start_time']);
    $dos = strip_tags($start);
    $end= trim($_POST['t_end_time']);
    $doe= strip_tags($end);
    $user= trim($_POST['assign_to']);
    if(empty($title) || empty($describe) || empty($user) || empty($dos) || empty($doe))
	{
		$errmsg.="One or more fields are empty...";
	}
else{
if(empty($dos))
	{
		$errmsg.="Start Date is empty ! ";
	}
	if(empty($doe))
	{
		$errmsg.="End Date is empty ! ";
	}
  if(!empty($errmsg))
	{
	header('location:index.php?err='.htmlspecialchars(urlencode($errmsg)));
	}
else
	{
    $qle="INSERT INTO task_info (t_title, t_description, t_start_time, 	t_end_time, t_user_id) VALUES ('".$title."', '".$describe."', '".$dos."', '".$doe."', '".$user."') ";
    if ($conn->query($qle) === TRUE) {
			echo "<center>";
			echo "<strong> Task Added Successful !</strong><br/><br/>";
      echo "</center>";
      header('location:scheduling.php');
    }else {
      echo "Error: " . $sql . "<br>" . $conn->error;
        }
$conn->close();
      
  }
}
  }
    $selectQuery ="SELECT * FROM employees WHERE Dept = '".$_SESSION['dept']."'";
    $results = mysqli_query($conn,$selectQuery);
    if(mysqli_num_rows($results) > 0){
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
  <link href="img/logo/attnlg.jpg" rel="icon">
  <title>Dashboard</title>
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
         <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog add-category-modal">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title text-center" style="margin-left: 150px;">Assign New Task</h2>
          <button type="button" class="close" data-dismiss="modal" style="color: red;">&times;</button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <form role="form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" autocomplete="off">
                <div class="form-horizontal">
                  <div class="form-group">
                    <label class="control-label col-sm-5">Task Title</label>
                    <div class="col-sm-7">
                      <input type="text" placeholder="Task Title" id="task_title" name="task_title" list="expense" class="form-control" id="default" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-5">Task Description</label>
                    <div class="col-sm-7">
                      <textarea name="task_description" id="task_description" placeholder="Text Deskcription" class="form-control" rows="5" cols="5"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-5">Start Time</label>
                    <div class="col-sm-7">
                      <input type="date" name="t_start_time" id="t_start_time" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-5">End Time</label>
                    <div class="col-sm-7">
                      <input type="date" name="t_end_time" id="t_end_time" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-5">Assign To</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="assign_to" id="aassign_to" required>
                        <option value="">Select Employee...</option>

                        //<?php while($row_s = mysqli_fetch_assoc($results)){ ?>
                        <option value="<?php echo $row_s['Work_ID']; ?>"><?php echo $row_s['EmpName']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                   
                  </div>
                  <div class="form-group">
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-3">
                      <button type="submit" name="add_task_post" class="btn btn-success-custom" style="background-color: blue; color: white;">Assign Task</button>
                    </div>
                    <div class="col-sm-3">
                      <button type="submit" class="btn btn-danger-custom" data-dismiss="modal" style="background-color: red; color: white;">Cancel</button>
                    </div>
                  </div>
                </div>
              </form> 
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <div class="row">
      <div class="col-md-12">
        <div class="well well-custom">
          <div class="gap"></div>
          <div class="row">
            <class="col-md-8">
              <div class="btn-group">
              <div class="btn-group">
                  <button class="btn btn-warning btn-menu" data-toggle="modal" data-target="#myModal" style="background-color: blue;">Assign New Task</button>
                  </div>
              </div>

</div>
<!---Container Fluid-->
<div class="gap"></div>
<div class="gap"></div>
<div class="table-responsive">
<table class="table table-codensed table-custom">
<thead>
  <tr>
    <th>#</th>
    <th>Task Title</th>
    <th>Assigned To</th>
    <th>Start Time</th>
    <th>End Time</th>
    <th>Status</th>
    <th>Action</th>
  </tr>
</thead>
<tbody>

<?php 
        $serial  = 1;
        $sql = "SELECT a.*, b.*
        FROM task_info a
        INNER JOIN employees b ON(a.t_user_id = b.Work_ID) where b.Dept = '".$_SESSION['dept']."'
        ORDER BY a.task_id DESC";
        $result = mysqli_query($conn,$sql);
        while( $row = mysqli_fetch_assoc($result)){
?>
  <tr>
    <td><?php echo $serial; $serial++; ?></td>
    <td><?php echo $row['t_title']; ?></td>
    <td><?php echo $row['EmpName']; ?></td>
    <td><?php echo $row['t_start_time']; ?></td>
    <td><?php echo $row['t_end_time']; ?></td>
    <td>
      <?php  if($row['status'] == 1){
          echo "In Progress <span style='color:#d4ab3a;' class='fa fa-refresh' ></span>";
      }elseif($row['status'] == 2){
         echo "Completed <span style='color:#00af16;' class='fa fa-check-square-o' ></span>";
      }else{
        echo "Incomplete <span style='color:#d00909;' class='fa fa-remove' ></span>";
      } ?>
      
    </td>

   <td><a title="Update Task"  href="edit-task.php?task_id=<?php echo $row['task_id'];?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
  <a title="View" href="task-details.php?task_id=<?php echo $row['task_id']; ?>"><i class="fa fa-folder-open"></i></a>&nbsp;&nbsp;
    <a title="Delete" href="?delete_task=delete_task&task_id=<?php echo $row['task_id']; ?>" onclick=" return check_delete();"><i class="fa fa-trash"></i></a></td>
  </tr>
  <?php } ?>
  <?php } ?>
</tbody>
</table>
</div>
</div>
</div>
  </div>
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