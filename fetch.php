<?php
include 'db.php';

$q = mysqli_query($conn,"
SELECT sd.*, 
c.name AS country,
s.name AS state,
ci.name AS city
FROM student_details sd
LEFT JOIN countries c ON sd.country_id=c.id
LEFT JOIN states s ON sd.state_id=s.id
LEFT JOIN cities ci ON sd.city_id=ci.id
ORDER BY sd.id ASC
");

if(mysqli_num_rows($q)>0){
echo '
<table class="table table-bordered">
<tr>
<th>id</th>
<th>Name</th>
<th>Father Name</th>
<th>Mother Name</th>
<th>Email</th>
<th>Mobile</th>
<th>Country</th>
<th>State</th>
<th>City</th>
<th>College</th>
<th>Action</th>
</tr>';

$sn=1;
while($r=mysqli_fetch_assoc($q)){
echo "
<tr>
<td>".$sn++."</td>
<td>{$r['name']}</td>
<td>{$r['father_name']}</td>
<td>{$r['mother_name']}</td>
<td>{$r['email']}</td>
<td>{$r['mobile']}</td>
<td>{$r['country']}</td>
<td>{$r['state']}</td>
<td>{$r['city']}</td>
<td>{$r['college']}</td>
<td>
<button class='btn btn-success editBtn' data-id='{$r['id']}'>Edit</button>
<button class='btn btn-danger deleteBtn' data-id='{$r['id']}'>Delete</button>
</td>
</tr>";
}
echo "</table>";
}else{
    echo "No Records Found";
}
?>
