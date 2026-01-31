<?php
include 'db.php';

$country_id = $_POST['country_id'];

$q = mysqli_query($conn,"SELECT id,name FROM states WHERE country_id='$country_id'");

echo '<option value="">Select State</option>';
while($r = mysqli_fetch_assoc($q)){
    echo '<option value="'.$r['id'].'">'.$r['name'].'</option>';
}
?>
