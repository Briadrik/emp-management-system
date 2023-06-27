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

  $selectQuery ="SELECT department, emailAddress FROM supervisor";
  $result = mysqli_query($conn,$selectQuery);
  if(mysqli_num_rows($result) > 0){
		
  }else{
      $msg = "No Record found";
  }
session_start();
?>
<html>
<head>
<title>::Leave Management::</title>
</head>
<body>
<link rel = "stylesheet" href = "style.css">
<div class = "textview">
<?php
echo "<h1>Leave Management System</h1>";
//include 'mailer.php';

if(filter_var($_GET['id'],FILTER_VALIDATE_INT) && filter_var($_GET['empid'],FILTER_VALIDATE_INT))
	{
		$id =$_GET['id'];
		$empid =$_GET['empid'];
	}
else
	{
		header('location:leavemanage.php');
	}
if(isset($_SESSION['supervisor']))
	{
	$sql = "SELECT id,EmpName,LeaveType,RequestDate,Statusv,LeaveDays,StartDate,EndDate FROM emp_leaves WHERE id='".$id."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
		{
		while($row = $result->fetch_assoc())
			{
			$leavedays = $row["LeaveDays"];
			$sql2 = "SELECT Work_ID,SickLeave,AnnualLeave,MaternityLeave,ParternityLeave,StudyLeave,UnpaidLeave,EmpEmail FROM employees WHERE Work_ID = '".$empid."'";
			$result2 = $conn->query($sql2);
			if($result2->num_rows > 0)
				{
				while($row2 = $result2->fetch_assoc())
					{
						
					$earnleave = $row2["AnnualLeave"];
					$diff1 = $earnleave-$leavedays;
					$sickleave = $row2["SickLeave"];
					$diff2 = $sickleave-$leavedays;
					$casualleave = $row2["MaternityLeave"];
					$diff3 = $casualleave-$leavedays;
					$partleave = $row2["ParternityLeave"];
					$diff1 = $partleave-$leavedays;
					$studyleave = $row2["StudyLeave"];
					$diff2 = $studyleave-$leavedays;
					$unpaidleave = $row2["UnpaidLeave"];
					$diff3 = $unpaidleave-$leavedays;
					$email = $row2["EmpEmail"];
					
					if($row["LeaveType"] == "Annual Leave")
					{
					if($diff1 < 0)
						echo "Processing Error !";
					else
						$sql3 = "UPDATE emp_leaves SET Statusv = 'Waiting...' WHERE id = '".$id."'";
					}
				else if($row["LeaveType"] == "Sick Leave")
					{
					if($diff2 < 0)
						echo "Processing Error !";
					else
						$sql3 = "UPDATE emp_leaves SET Statusv = 'Waiting...' WHERE id = '".$id."'";
					}
				else if($row["LeaveType"] == "Maternity Leave")
					{
					if($diff3 < 0)
						echo "Processing Error !";
					else
						$sql3 = "UPDATE emp_leaves SET Statusv = 'Waiting...' WHERE id = '".$id."'";
					}
					if($row["LeaveType"] == "Parternity Leave")
					{
					if($diff1 < 0)
						echo "Processing Error !";
					else
						$sql3 = "UPDATE emp_leaves SET Statusv = 'Waiting...' WHERE id = '".$id."'";
					}
				else if($row["LeaveType"] == "Study Leave")
					{
					if($diff2 < 0)
						echo "Processing Error !";
					else
						$sql3 = "UPDATE emp_leaves SET Statusv = 'Waiting...' WHERE id = '".$id."'";
					}
				else if($row["LeaveType"] == "Unpaid Leave")
					{
					if($diff3 < 0)
						echo "Processing Error !";
					else
						$sql3 = "UPDATE emp_leaves SET Statusv = 'Waiting...' WHERE id = '".$id."'";
					}
							if($conn->query($sql3) === TRUE)
								{

								$msg="Your Leave Has Been Approved by the Supervisor,proceed to HR for Approval ! \nEmployee Name : ".$row['EmpName']."\nLeave Type : ".$row['LeaveType']."\nNo. Of Leave Days : ".$row['LeaveDays']."\nStarting Date : ".$row['StartDate']."\nEnd date : ".$row['EndDate']."\n\n\nThanks,\nwebadmin, Leave Management System";
								header('location:accept.php');
								// $status = mailer($email,$msg);
								// if($status === TRUE)
								// 	{
								// 	echo "The Leave Request Status mail For ".$row['EmpName']." Has been sent to his/her registered email address !<br/>";
								// 	}
								}
							}
					}
				}
			
			}
		}
	else
		{
			header('location:\Employee Management System\index.php?err='.urlencode('Please Login First To Access This Page !'));
		}
?>
</div>
</body>
</html>