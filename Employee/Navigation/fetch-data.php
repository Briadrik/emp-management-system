<?php
$selectQuery ="SELECT * FROM employees WHERE EmpEmail = '".$_SESSION['useremployee']."'";
$result = mysqli_query($conn,$selectQuery);
  if(mysqli_num_rows($result) > 0){
    while($row = $result->fetch_assoc()) {
    $query ="SELECT * FROM employees WHERE Dept = '".$row['Dept']."'";
			$result6 = $conn->query($query);
			if($result6->num_rows> 0){
				$options= mysqli_fetch_all($result6, MYSQLI_ASSOC);
      }else{
        $msg = "No Record found";
    }
  }
}
?>