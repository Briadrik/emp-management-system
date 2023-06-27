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
<html>
<head>
<title>::Leave Management::</title>
</head>
<body>
<link rel = "stylesheet" href = "css/style.css">
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
		header('location:leavepage.php');
	}
if(isset($_SESSION['hruser']))
	{
	$sql = "SELECT id,EmpName,LeaveType,RequestDate,Statusv,LeaveDays,StartDate,EndDate FROM emp_leaves WHERE id='".$id."'";
	$result = mysqli_query($conn,$sql);
  if(mysqli_num_rows($result) > 0)
		{
		while($row = mysqli_fetch_assoc($result))
			{
			$leavedays = $row["LeaveDays"];
			$sql2 = "SELECT Work_ID,SickLeave,AnnualLeave,MaternityLeave,ParternityLeave,StudyLeave,UnpaidLeave,EmpEmail FROM employees WHERE Work_ID = '".$empid."'";
			$result2 = $conn->query($sql2);
			if(mysqli_num_rows($result2) > 0)
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
							$sql3 = "UPDATE employees SET AnnualLeave = '".$diff1."' WHERE Work_ID = '".$empid."'";
						}
					else if($row["LeaveType"] == "Sick Leave")
						{
						if($diff2 < 0)
							echo "Processing Error !";
						else
							$sql3 = "UPDATE employees SET SickLeave = '".$diff2."' WHERE Work_ID = '".$empid."'";
						}
					else if($row["LeaveType"] == "Maternity Leave")
						{
						if($diff3 < 0)
							echo "Processing Error !";
						else
							$sql3 = "UPDATE employees SET MaternityLeave = '".$diff3."' WHERE Work_ID = '".$empid."'";
						}
						else if($row["LeaveType"] == "Parternity Leave")
						{
						if($diff2 < 0)
							echo "Processing Error !";
						else
							$sql3 = "UPDATE employees SET ParternityLeave = '".$diff2."' WHERE Work_ID = '".$empid."'";
						}
						else if($row["LeaveType"] == "Study Leave")
						{
						if($diff2 < 0)
							echo "Processing Error !";
						else
							$sql3 = "UPDATE employees SET StudyLeave = '".$diff2."' WHERE Work_ID = '".$empid."'";
						}
						else if($row["LeaveType"] == "Unpaid Leave")
						{
						if($diff2 < 0)
							echo "Processing Error !";
						else
							$sql3 = "UPDATE employees SET UnpaidLeave = '".$diff2."' WHERE Work_ID = '".$empid."'";
						}
					if($conn->query($sql3) === TRUE)
							{
							$sql4 = "UPDATE emp_leaves SET Statusv = 'Granted' WHERE id = '".$id."'";
							if($conn->query($sql4) === TRUE)
								{
								echo "Your Leave Has Been Granted Successfully ! \nEmployee Name : ".$row['EmpName']."\nLeave Type : ".$row['LeaveType']."\nNo. Of Leave Days : ".$row['LeaveDays']."\nStarting Date : ".$row['StartDate']."\nEnd date : ".$row['EndDate']."\n\n\nThanks,\nwebadmin, Leave Management System";
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
	}
	else
		{
			header('location:index.php?err='.urlencode('Please Login First To Access This Page !'));
		}
?>
</div>
</body>
</html>