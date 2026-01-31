<?php
include 'db.php';

$sql = "SELECT id,name FROM countries ORDER BY name ASC";
$result = mysqli_query($conn,$sql);

// $test=mysqli_fetch_assoc($result);
// print_r($test);
while($row = mysqli_fetch_assoc($result)){
    echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
}
?>
