<?php
	include 'db.php';
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];

	$email=$_POST['email'];
	$phone=$_POST['phone'];
	
	$sql = "INSERT INTO `students`( `fname`, `lname`, `email`, `phone`) 
	VALUES ('$fname','$lname','$email','$phone')";
	if (mysqli_query($conn, $sql)) {
	echo 1;
	}
	else{
		echo 0;
	}
		


	/*	echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	} */
	//mysqli_close($conn);
?>