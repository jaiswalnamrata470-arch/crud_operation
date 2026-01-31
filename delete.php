<?php
include 'db.php';

$id=$_POST['id'];
echo mysqli_query($conn,"DELETE FROM student_details WHERE id='$id'")
? "Deleted Successfully" : "Delete Failed";
?>
