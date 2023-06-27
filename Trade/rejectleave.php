<link rel="shortcut icon" type="image/png" href="favicon.png"/>
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
<link rel = "stylesheet" href = "style.css">
<div class = "textview">
<?php
echo "<h1>Leave Management System</h1>";


if(filter_var($_GET['id'],FILTER_VALIDATE_INT) && filter_var($_GET['empid'],FILTER_VALIDATE_INT))
	{
		$id =$_GET['id'];
		$empid =$_GET['empid'];
	}
else
	{
		header('location:index.php');
	}
if(isset($_SESSION['supervisor']))
	{
	
	$sql = "SELECT * FROM emp_leaves WHERE id='".$id."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
		{
		while($row = $result->fetch_assoc())
			{
				$sql2 = "SELECT id,EmpEmail FROM employees WHERE id = '".$empid."'";
				$result2 = $conn->query($sql2);
				if($result2->num_rows > 0)
				{
					while($row2 = $result2->fetch_assoc())
						{
						$email = $row2['EmpEmail'];
						$sql3 = "UPDATE emp_leaves SET Statusv = 'Rejected' WHERE id = '".$id."'";
						if($conn->query($sql3) === TRUE)
								{
								$msg = "Your Leave Has Been Rejected ! \nEmployee Name : ".$row['EmpName']."\nLeave Type : ".$row['LeaveType']."\nNo. Of Leave Days : ".$row['LeaveDays']."\nStarting Date : ".$row['StartDate']."\nEnd date : ".$row['EndDate']."\n\n\nThanks,\nwebadmin, Leave Management System";
								$sql3 = "UPDATE employees SET value_s = 0 WHERE Work_ID  = '".$empid."'";
										if($conn->query($sql3) === TRUE)
										{

											echo "The Leave Request Status Rejected!";
											header("location:accept.php");
										}
								//$status = mailer($email,$msg);
								if($status === TRUE)
									{
										$sql3 = "UPDATE employees SET value_s = 0 WHERE Work_ID  = '".$empid."'";
										if($conn->query($sql3) === TRUE)
										{

											echo "The Leave Request Status Mail For ".$row['EmpName']." Has been sent to his/her registered email address !<br/>";
										}
									
									}
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
