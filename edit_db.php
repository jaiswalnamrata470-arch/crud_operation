<?php
include 'db.php';

$id=$_POST['id'];
$q=mysqli_query($conn,"SELECT * FROM student_details WHERE id='$id'");
echo json_encode(mysqli_fetch_assoc($q));
?>
