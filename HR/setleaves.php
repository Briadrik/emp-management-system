<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img\logo\download.png" rel="icon">
  <title>Set Default Leave</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ncemsdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed ");
}
if(isset($_SESSION['hruser']))
	{
	$setsickleave = strip_tags(trim($_POST['setsickleave']));
	$setannualleave = strip_tags(trim($_POST['setannualleave'])); 
	$setmaternityleave = strip_tags(trim($_POST['setmaternityleave']));
	$setpaternityleave = strip_tags(trim($_POST['setpaternityleave']));
	$setstudyleave = strip_tags(trim($_POST['setstudyleave']));
	$setunpaidleave = strip_tags(trim($_POST['setunpaidleave']));
	
	$sql2 = "SELECT * FROM HR WHERE emailAddress = '".$_SESSION['hruser']."'";
	$result = $conn->query($sql2);
	if($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
				{
					$sql3 = "SELECT * FROM employees";
					$result2 = $conn->query($sql3);
					if($result2->num_rows > 0)
						{
							while($row2 = $result2->fetch_assoc())
								{
									if($row2["AnnualLeave"] == $row["SetAnnualLeave"])
										{
											$update = "UPDATE employees SET AnnualLeave = '".$setannualleave ."'";
											$conn->query($update);
										}
									if($row2["SickLeave"] == $row["SetSickLeave"])
										{
											$update = "UPDATE employees SET SickLeave = '".$setsickleave."'";
											$conn->query($update);
										}
									if($row2["MaternityLeave"] == $row["SetMaternityLeave"])
										{
											$update = "UPDATE employees SET MaternityLeave = '".$setmaternityleave."'";
											$conn->query($update);
										}
										if($row2["ParternityLeave"] == $row["SetPaternityLeave"])
										{
											$update = "UPDATE employees SET ParternityLeave = '".$setpaternityleave."'";
											$conn->query($update);
										}
									if($row2["StudyLeave"] == $row["SetStudyLeave"])
										{
											$update = "UPDATE employees SET StudyLeave = '".$setstudyleave."'";
											$conn->query($update);
										}
									if($row2["UnpaidLeave"] == $row["SetUnpaidLeave"])
										{
											$update = "UPDATE employees SET UnpaidLeave = '".$setunpaidleave."'";
											$conn->query($update);
										}
								}
						}
				}
		}
	
	$sql = "UPDATE hr SET SetSickLeave = '".$setsickleave."', SetAnnualLeave = '".$setannualleave."', SetMaternityLeave = '".$setmaternityleave."', SetPaternityLeave = '".$setpaternityleave."', SetStudyLeave = '".$setstudyleave."', SetUnpaidLeave = '".$setunpaidleave."' WHERE emailAddress = '".$_SESSION['hruser']."'";
	if($conn->query($sql) == TRUE)
		{
		header('location:setleave.php?msg='.urlencode('Leaves Were Set Succesfully!'));
		}
	else
		{
		header('location:setleave.php?msg='.urlencode('Setting Of Leaves Failed!'));
		}
	}
else
	{
	header('location:index.php?err='.urlencode('Please Login First To Access This Page!'));
	}
?>