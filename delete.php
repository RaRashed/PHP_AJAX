<?php 
include 'db.php';

$student_id = $_POST['id'];
$sql="DELETE FROM students where id =$student_id";
if(mysqli_query($conn,$sql)){
	echo 1;

}
else{
	echo 0;
}