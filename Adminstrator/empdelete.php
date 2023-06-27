<?php
session_start();
?>
<title>::Leave Management::</title>
<?php
include '../Database/dbcon.php';
echo "<h1>Leave Management System</h1>";

if(isset($_SESSION['adminuser']))
	{
	if(filter_var($_GET['id'],FILTER_VALIDATE_INT))
		{
			$id = $_GET['id'];
		}
	else
		{
			header('location:employees.php');
		}
	$user = filter_var($_GET['user'],FILTER_SANITIZE_STRING);
	$file = "../client/pro-pic/".$user.".jpg";
	if(file_exists($file))
		{
		unlink($file);
		}
	else
		{}
	$sql = "DELETE FROM employees WHERE id='".$id."'";
	echo "<center>";
	if ($conn->query($sql) === TRUE)
		{
		header('location:employees.php?msg='.urlencode('Employee Successfully Removed !'));
		}
	else
		{
		header('location:employees.php?msg='.urlencode('Error Removing Employee !'));
		}
	$conn->close();
	}
else
	{
	header('location:index.php?err='.urlencode('Please login first to access this page !'));
	}
?>