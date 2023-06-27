<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<?php
session_start();
include '../Database/dbcon.php';
//include 'mailer.php';
?>							
<link rel="stylesheet" href="style.css">
<title>::Leave Management::</title>
<?php
if(isset($_SESSION['emailAddress']))
{
	$sql = "SELECT firstName,emailAddress FROM adminstrator WHERE emailAddress = '".$_SESSION['emailAddress']."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
		{
			$row = $result->fetch_assoc();
		}
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
$gender=strip_tags(trim($_POST['gender']));
$pass = md5(trim($_POST['emppass']));
$department = strip_tags(trim($_POST['depart']));
$designation = strip_tags(trim($_POST['designate']));
$emptype = strip_tags(trim($_POST['factype']));
$AnnualLeave =0;
$sickleave =0;
$Maternityleave =0;
$Paternityleave = 0;
$Studyleave = 0;
$Unpaidleave = 0;
//$img=$_FILES["image"]["name"];
$tmp=$_FILES["image"]["name"];
$extension=pathinfo($tmp,PATHINFO_EXTENSION);
$newname=$empno.'.'.$extension;
$filename=$_FILES['image']['tmp_name'];
if(empty($empname) || empty($mailid) || empty($doj) || empty($dob) ||empty($pass) || empty($empno))
	{
		$errmsg.="One or more fields are empty...";
	}
else{
if(empty($doj))
	{
		$errmsg.="Date Of Joining is empty ! ";
	}
	if(empty($dob))
	{
		$errmsg.="Date Of Birth is empty ! ";
	}
if(strtotime($doj) > time())
	{
		$errmsg.=" Date Of Joining cannot be a future date..."; 
	}

$sql = "SELECT EmpEmail FROM employees";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
			if($mailid == $row["EmpEmail"])
				{
					$errmsg.=" Your Entered Email ID is already registered with another user...";
				}
		}
	}
	if (substr($empno, 1) == '0') {
    $errmsg.="Invalid work number"; 
}
if ((!filter_var($mailid, FILTER_VALIDATE_EMAIL)) || empty($mailid)) {
  $errmsg.="Invalid email ID...";
	}
}
$sql2 = "SELECT * FROM adminstrator WHERE emailAddress = '".$_SESSION['emailAddress']."'";
if($conn->query($sql2) == TRUE)
	{
		$result = $conn->query($sql2);
		if($result->num_rows > 0)
			{
				while($row2 = $result->fetch_assoc())
					{
						$AnnualLeave = $row2['SetAnnualLeave'];
						$sickleave = $row2['SetSickLeave'];
						$Maternityleave = $row2['SetMaternityLeave'];
						$Paternityleave = $row2['SetPaternityLeave'];
						$Studyleave = $row2['SetStudyLeave'];
						$Unpaidleave = $row2['SetUnpaidLeave'];
						
					}
			}
	}
if(!empty($errmsg))
	{
	header('location:register.php?err='.htmlspecialchars(urlencode($errmsg)));
	}
else
	{
		echo "<div class = 'reg-form'>";
		$sql = "INSERT INTO employees (Work_ID,Profiles,EmpPass,EmpName,Dept,SickLeave,AnnualLeave,MaternityLeave,ParternityLeave,StudyLeave,UnpaidLeave,EmpEmail,DateOfJoin,Designation,EmpType,DateOfBirth,Gender) VALUES ('".$empno."','".$newname."','".$pass."','".$empname."','".$department."','".$sickleave."','".$AnnualLeave."','".$Maternityleave."','".$Paternityleave."','".$Studyleave."','".$Unpaidleave."','".$mailid."','".$doj."','".$designation."','".$emptype."','".$dob."','".$gender."')";
		if ($conn->query($sql) === TRUE) {
			move_uploaded_file($filename,"C:/Users/BRIADVIC/PycharmProjects/NCEMS/ImagesAttendance/".$newname);
			echo "<center>";
			echo "<scripts>slert('Image has been uploaded to Folder')</scripts>";
			echo "<strong> Registration Successful !</strong><br/><br/>";
			echo "<u>Registration Details :</u><br/>";
			echo "Work Number : ".$empno."<br/>";
			echo "Employee Name : ".$empname."<br/>";
			echo "Department : ".$department."<br/>";
			echo "Email id : ".$mailid."<br/>";
			echo "Date Of Joining : ".$doj."<br/>";
			echo "Designation : ".$designation."<br/>";
			echo "Employment Type : ".$emptype." ; ".$empfee."<br/>";
			echo "Date Of Birth : ".$dob2."<br/>";
			$msg = "Registration Successful! \n\nWork ID: ".$empno."\nEmployee Name : ".$empname."\nPassword : ".$pass."\nDepartment : ".$department."\nEmail ID : ".$mailid."\nDate Of Joining (yyyy/mm/dd): ".$doj."\n\n\nThanks For Registering with us\n\n\n\nRegards,\nwebadmin, Leave Management System";
			$to = $mailid;
			header('location:employees.php');
			//$status = mailer($to,$msg);
			if($status == true)
				{
					echo "<br/>Please check the email ".$mailid." for the confirmation page.<br/>";
				}
			echo "</center>";
			echo "</div>";
		}
			else {
				echo "Error: " . $sql . "<br>" . $conn->error;
					}
$conn->close();
	}
}
else
{
	header('location:index.php?err='.urlencode('Please Login First To Access This Page !'));
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