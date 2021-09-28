<?php 
include 'db.php';

$student_id = $_POST['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$sql="UPDATE students SET fname='$fname',lname='$lname',email='$email',phone='$phone' where id =$student_id";
if(mysqli_query($conn,$sql)){
	echo 1;

}
else{
	echo 0;
}