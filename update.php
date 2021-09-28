<?php
include 'db.php';

 $student_id = $_POST["id"]; 
      
$sql = "SELECT * FROM students where id ='$student_id'";

$result =mysqli_query($conn,$sql);
$output= "";

if (mysqli_num_rows($result)>0) {

                while($row = mysqli_fetch_assoc($result)){
                
              

                	$output .= "
                	  <div class='modal-body'>
       <table cellpadding='5px' width='100%'>  

                	 <tr>
            <td>First Name</td>


            <td><input type='text' name='edit-fname' id='edit-fname' value='{$row["fname"]}'></td>
            <td><input type='hidden' name='edit-id' id='edit-id' value='{$row["id"]}'></td>
            
        </tr>
       <tr>
            <td>Last Name</td>
            <td><input type='text' name='edit-lname' id='edit-lname' value='{$row["lname"]}'></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type='text' name='edit-email' id='edit-email' value='{$row["email"]}'></td>
        </tr>
        <tr>
            <td>Phone</td>
            <td><input type='text' name='edit-phone' id='edit-phone' value='{$row["phone"]}'></td>
        </tr>
        
       </table>
       </div>
                    <div class='modal-footer'>
  <input type='submit' id='edit-submit' class='btn btn-primary' value='Save Change'>
        
      </div>";
    

                }

                mysqli_close($conn);
                echo $output;

}
else{
echo "<h1>No record Found</h1>";

}


?>
