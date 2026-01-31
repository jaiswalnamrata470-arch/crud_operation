<?php
include 'db.php';

$name=$_POST['name'];
$father=$_POST['father_name'];
$mother=$_POST['mother_name'];
$email=$_POST['email'];
$mobile=$_POST['mobile'];
$college=$_POST['college'];
$country=$_POST['country'];
$state=$_POST['state'];
$city=$_POST['city'];

$check_email=mysqli_query($conn,"SELECT id FROM student_details WHERE email='$email'");
if(mysqli_num_rows($check_email)>0){
    echo "Email already exists"; exit;
}

$check_mobile=mysqli_query($conn,"SELECT id FROM student_details WHERE mobile='$mobile'");
if(mysqli_num_rows($check_mobile)>0){
    echo "Mobile already exists"; exit;
}

$q="INSERT INTO student_details
(name,father_name,mother_name,email,mobile,college,country_id,state_id,city_id)
VALUES
('$name','$father','$mother','$email','$mobile','$college','$country','$state','$city')";

echo mysqli_query($conn,$q) ? "Inserted Successfully" : "Insert Failed";
?>
