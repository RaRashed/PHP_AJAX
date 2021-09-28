<?php
include 'db.php';

$sql = "SELECT * FROM students";
$result =mysqli_query($conn,$sql);
$output = "";
if (mysqli_num_rows($result)>0) {
	$output = '
                                <table>
                                    
                                    <tr>
                                    <th>ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th width="100px">Edit</th>
                                        <th width="100px">Delete</th>
                                        
                                    </tr>';
                while($row = mysqli_fetch_assoc($result)){
                	$output .= "<tr><td>{$row['id']}</td><td>{$row['fname']}</td><td>{$row['lname']}</td><td>{$row['email']}</td><td>{$row['phone']}</td><td><button class='edit-btn' data-eid='{$row["id"]}'>Edit</button></td><td><button class='delete-btn' data-id='{$row["id"]}'>Delete</button></td></tr>";
                }
                $output .= "            
                                </table>";
                mysqli_close($conn);
                echo $output;

}
else{
echo "<h1>No record Found</h1>";

}
?>