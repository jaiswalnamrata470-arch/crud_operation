<?php
include 'db.php';

$state_id = $_POST['state_id'];

$q = mysqli_query($conn,"SELECT id,name FROM cities WHERE state_id='$state_id'");

echo '<option value="">Select City</option>';
while($r = mysqli_fetch_assoc($q)){
    echo '<option value="'.$r['id'].'">'.$r['name'].'</option>';
}
?>
