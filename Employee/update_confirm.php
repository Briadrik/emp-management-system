<?php session_start();?>
<html>
<head>
<title>::Leave Request Confirmation::</title>
<?php
include '../Database/dbcon.php';

//include 'leave_mailer.php';


$user = $_SESSION['useremployee'];
echo "<link rel='stylesheet' type='text/css' href='css/style.css'>";
echo "<div class = 'textview'>";
echo "<center>";
if(isset($user))
	{
	$leavetype = $_POST['leavetype'];
	$leavedays = $_POST['leavedays'];
	$leavedate =  $_POST['leavedate'];;
	$duration = $leavedays." days";
	$user = $_SESSION['useremployee'];
	$interval = date_interval_create_from_date_string($duration);
	$time=date_create($leavedate);
	$enddate = date_add($time,$interval);
	$end = date_format($enddate,"Y-m-d");
	$empname = $_POST['empname'];
	$emptype = $_POST['emptype'];
	$designation = $_POST['designation'];
	$leavereason = $_POST['leavereason'];
	$dept = $_POST['dept'];
	$status="Waiting";
	$replace=strip_tags(trim($_POST['employee']));

		if(!empty($leavedays))

			{
				if(strtotime($leavedate) > time())
				{
				$sql = "SELECT * FROM employees WHERE EmpEmail='".$user."'";
				$result = mysqli_query($conn,$sql);
      
				if(mysqli_num_rows($result) > 0){
           while($row = $result->fetch_assoc()) {
						if($row["EmpEmail"] == $user)
							{
								
								
								if($leavetype === "Sick Leave")
								{
									
									if(($leavedays <= $row["SickLeave"]) || $leavedays < 0)
										{
											
										$empname = $row["EmpName"];
										$to = $row["EmpEmail"];
										$sql2 = "INSERT INTO emp_leaves(EmpName,EmpEmail,Statusv,LeaveType,LeaveDays,StartDate,EndDate,Dept,Reason,Replaces) VALUES('".$empname."','".$user."','".$status."','".$leavetype."','".$leavedays."','".$leavedate."','".$end."','".$row['Dept']."','".$leavereason."','".$replace."')";
											if (mysqli_query($conn, $sql2))
											{
												
											$msg = "The Leave Request generated by you is as follows : \nEmployee Name : ".$empname."\nLeave Days Requested : ".$leavedays."\nType of leave : ".$leavetype."\nStarting Date of Leave : ".$leavedate."\n\n\nThank You,\nwebadmin,Leave Management System.";
							
											$_SESSION['status']="Request Has Been Sucessfully Submitted";
											header('location: requestleave.php');
											
											// $status = mailer($to,$msg,$empname);
											// 	if($status == true)
											// 		echo "Request Has Been Sucessfully Submitted.<br/>Please Check Your email for your leave request<br/>";
											}
											else
											{
											echo "Error: " . $sql . "<br>" . mysqli_error($conn);
											}
										}
									else
									{
										$_SESSION['status_error']="You cannot ask for Sick Leave more than that of your account !";
									header('location:requestleave.php');
									}
								}
								if($leavetype === "Annual Leave")
								{
									if(($leavedays <= $row["AnnualLeave"]) || $leavedays < 0)
										{
										$empname = $row["EmpName"];
										$to = $row["EmpEmail"];
										$sql2 = "INSERT INTO emp_leaves(EmpName,EmpEmail,LeaveType,LeaveDays,Statusv,StartDate,EndDate,Dept,Reason,Replaces) VALUES('".$empname."','".$user."','".$status."','".$leavetype."','".$leavedays."','".$leavedate."','".$end."','".$row['Dept']."','".$leavereason."','".$replace."')";
											if (mysqli_query($conn, $sql2))
											{
											$msg = "The Leave Request generated by you is as follows : \nEmployee Name : ".$empname."\nLeave Days Requested : ".$leavedays."\nType of leave : ".$leavetype."\nStarting Date of Leave : ".$leavedate."\n\n\nThank You,\nwebadmin,Leave Management System.";
											$_SESSION['status']="Request Has Been Sucessfully Submitted";
											header('location:requestleave.php');
											//$status = mailer($to,$msg,$empname);
												//if($status == true)
													//echo "Request Has Been Sucessfully Submitted.<br/>Please Check Your email for your leave request<br/>";
												
											}
											else
											{
											echo "Error: " . $sql . "<br>" . mysqli_error($conn);
											}
										}
									else
									{
										$_SESSION['status_error']="You cannot ask for Annual Leave more than that of your account !";
									header('location:requestleave.php');
									}
								}
								if($leavetype === "Maternity Leave")
								{
									if(($leavedays <= $row["MaternityLeave"]) || $leavedays < 0)
										{
										$empname = $row["EmpName"];
										$to = $row["EmpEmail"];
										$sql2 = "INSERT INTO emp_leaves(EmpName,EmpMail,Statusv,LeaveType,LeaveDays,StartDate,EndDate,Dept,Reason,Replaces) VALUES('".$empname."','".$user."','".$status."','".$leavetype."','".$leavedays."','".$leavedate."','".$end."','".$row['Dept']."','".$leavereason."','".$replace."')";
											if (mysqli_query($conn, $sql2))
											{
											$msg = "The Leave Request generated by you is as follows : \nEmployee Name : ".$empname."\nLeave Days Requested : ".$leavedays."\nType of leave : ".$leavetype."\nStarting Date of Leave : ".$leavedate."\n\n\nThank You,\nwebadmin,Leave Management System.";
											$_SESSION['status']="Request Has Been Sucessfully Submitted";
											header('location:requestleave.php');
											//$status = mailer($to,$msg,$empname);
												//if($status == true)
													//echo "Request Has Been Sucessfully Submitted.<br/>Please Check Your email for your leave request<br/>";
											}
											else
											{
											echo "Error: " . $sql . "<br>" . mysqli_error($conn);
											}
											
										}
									else
									{
										$_SESSION['status_error']="You cannot ask for Maternity Leave more than that of your account !";
									header('location:requestleave.php');
									}
								}
								
								if($leavetype === "Parternity Leave")
								{
									if(($leavedays <= $row["ParternityLeave"]) || $leavedays < 0)
										{
										$empname = $row["EmpName"];
										$to = $row["EmpEmail"];
										$sql2 = "INSERT INTO emp_leaves(EmpName,EmpMail,StatusvLeaveType,LeaveDays,StartDate,EndDate,Dept,Reason,Replaces) VALUES('".$empname."','".$user."','".$status."','".$leavetype."','".$leavedays."','".$leavedate."','".$end."','".$row['Dept']."','".$leavereason."','".$replace."')";
											if (mysqli_query($conn, $sql2))
											{
											$msg = "The Leave Request generated by you is as follows : \nEmployee Name : ".$empname."\nLeave Days Requested : ".$leavedays."\nType of leave : ".$leavetype."\nStarting Date of Leave : ".$leavedate."\n\n\nThank You,\nwebadmin,Leave Management System.";
											$_SESSION['status']="Request Has Been Sucessfully Submitted";
											header('location:requestleave.php');
								
											//$status = mailer($to,$msg,$empname);
												//if($status == true)
													//echo "Request Has Been Sucessfully Submitted.<br/>Please Check Your email for your leave request<br/>";
											}
											else
											{
											echo "Error: " . $sql . "<br>" . mysqli_error($conn);
											}
											
										}
									else
									{
										$_SESSION['status_error']="You cannot ask for Parternity Leave more than that of your account !";
									header('location:requestleave.php');
									}
								}
								
								if($leavetype === "Study Leave")
								{
									if(($leavedays <= $row["StudyLeave"]) || $leavedays < 0)
										{
										$empname = $row["EmpName"];
										$to = $row["EmpEmail"];
										$sql2 = "INSERT INTO emp_leaves(EmpName,EmpMail,Statusv,LeaveType,LeaveDays,StartDate,EndDate,Dept,Reason,Replaces) VALUES('".$empname."','".$user."','".$status."','".$leavetype."','".$leavedays."','".$leavedate."','".$end."','".$row['Dept']."','".$leavereason."','".$replace."')";
											if (mysqli_query($conn, $sql2))
											{
											$msg = "The Leave Request generated by you is as follows : \nEmployee Name : ".$empname."\nLeave Days Requested : ".$leavedays."\nType of leave : ".$leavetype."\nStarting Date of Leave : ".$leavedate."\n\n\nThank You,\nwebadmin,Leave Management System.";
											$_SESSION['status']="Request Has Been Sucessfully Submitted";
											header('location:requestleave.php');
								
											//$status = mailer($to,$msg,$empname);
												//if($status == true)
													//echo "Request Has Been Sucessfully Submitted.<br/>Please Check Your email for your leave request<br/>";
											}
											else
											{
											echo "Error: " . $sql . "<br>" . mysqli_error($conn);
											}
											
										}
									else
									{
										$_SESSION['status_error']="You cannot ask for Study Leave more than that of your account !";
									header('location:requestleave.php');
									}
								}
								
								if($leavetype === "Unpaid Leave")
								{
									if(($leavedays <= $row["UnpaidLeave"]) || $leavedays < 0)
										{
										$empname = $row["EmpName"];
										$to = $row["EmpEmail"];
										$sql2 = "INSERT INTO emp_leaves(EmpName,EmpEmail,Statusv,LeaveType,LeaveDays,StartDate,EndDate,Dept,Reason,Replaces) VALUES('".$empname."','".$user."','".$status."',".$leavetype."','".$leavedays."','".$leavedate."','".$end."','".$row['Dept']."','".$leavereason."','".$replace."')";
											if (mysqli_query($conn, $sql2))
											{
											$msg = "The Leave Request generated by you is as follows : \nEmployee Name : ".$empname."\nLeave Days Requested : ".$leavedays."\nType of leave : ".$leavetype."\nStarting Date of Leave : ".$leavedate."\n\n\nThank You,\nwebadmin,Leave Manage mentSystem.";
											$_SESSION['status']="Request Has Been Sucessfully Submitted";
											header("location:requestleave.php");
								
											//$status = mailer($to,$msg,$empname);
												//if($status == true)
													//echo "Request Has Been Sucessfully Submitted.<br/>Please Check Your email for your leave request<br/>";
											}
											else
											{
											echo "Error: " . $sql . "<br>" . mysqli_error($conn);
											}
											
										}
									else
									{
										$_SESSION['status_error']="You cannot ask for Unpaid Leave more than that of your account !";
									header('location:requestleave.php');
									}
								}
							}
						}
					}
error_reporting(0);
require_once ('dompdf_config.inc.php');
$pdf_content='
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			</head>
		
			<style type="text/css">							
				#pdf_header, #pdf_container{ border: 1px solid #CCCCCC; padding:10px; }				
				#pdf_header{ margin:10px auto 0px; border-bottom:none; }				
				table{ width:580px; }				
				#pdf_container{margin:0px auto; }
				.rpt_title{ background:#99CCFF; }															
			</style>
							
			<body>
			<div id="pdf_header" >
			<table border="0" cellspacing="1" cellpadding="2">
			<tr id="hdRow">
				</tr>
			</table>
			</div>
			<div id="pdf_container" >
			<table border="0" cellspacing="1" cellpadding="2">
			<tr bgcolor="#006" style="color:#FFF"><td colspan="3" align="left">Leave Request Copy Of : '.$empname.'</td></tr>
	 		</table>
			<table>
			<tr><th>Employee Name : </th><td>'.$empname.'</td></tr>
			<tr><th>Employee Designation : </th><td>'.$designation.'</td></tr>
			<tr><th>Employment Type : </th><td>'.$emptype.'</td></tr>
			<tr><th>Employee Department : </th><td>'.$dept.'</td></tr>
			<tr><th>Employee Fee Structure : </th><td>'.$empfee.'</td></tr>
			<tr><th>Starting Date Of Leave (yyyy-mm-dd): </th><td>'.$leavedate.'</td></tr>
			<tr><th>No. Of Leave Days : </th><td>'.$leavedays.'</td></tr>
			<tr><th>Reason For Leave : </th><td>'.$leavereason.'</td></tr>
			<tr><th>Type Of Leave : </th><td>'.$leavetype.'</td></tr>
			</table></div></body></html>'
			;
			$name = $user.$leavedate.$leavetype.$end.'.pdf';
			$reportPDF = createPDF($pdf_content, $name);
				}
				else
					{
					header('location:requestleave.php?err='.urlencode('Start Date is invalid !'));
					}
			}
		
		else
			{
			header('location:requestleave.php?err='.urlencode('Pl. Enter some details !'));
			}
	}
	else
	{
	header('location:index.php?err='.urlencode('Please Login first to access this page'));
	}
echo "</center>";
echo "</div>";
$conn->close();
function createPDF($pdf_content, $filename){
	
	$path='leaves/';
	$dompdf=new DOMPDF();
	$dompdf->load_html($pdf_content);
	$dompdf->render();
	$output = $dompdf->output();
	file_put_contents($path.$filename, $output);
	return $filename;		
	}
?>

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
</head>
</html>