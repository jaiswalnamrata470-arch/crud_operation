<?php
include 'db.php';

$id=$_POST['id'];
$name=$_POST['name'];
$father=$_POST['father_name'];
$mother=$_POST['mother_name'];
$email=$_POST['email'];
$mobile=$_POST['mobile'];
$college=$_POST['college'];
$country=$_POST['country'];
$state=$_POST['state'];
$city=$_POST['city'];

$check_email=mysqli_query($conn,"SELECT id FROM student_details WHERE email='$email' AND id!='$id'");
if(mysqli_num_rows($check_email)>0){
    echo "Email already exists"; exit;
}

$check_mobile=mysqli_query($conn,"SELECT id FROM student_details WHERE mobile='$mobile' AND id!='$id'");
if(mysqli_num_rows($check_mobile)>0){
    echo "Mobile already exists"; exit;
}

$q="UPDATE student_details SET
name='$name',father_name='$father',mother_name='$mother',
email='$email',mobile='$mobile',college='$college',
country_id='$country',state_id='$state',city_id='$city'
WHERE id='$id'";

echo mysqli_query($conn,$q) ? "Updated Successfully" : "Update Failed";
?>
