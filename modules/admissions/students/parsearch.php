<?php
require_once "../../../connection/connect.php";
$search_term = strtolower($_GET["q"]);
if (!$search_term) return;

$sql="SELECT * FROM parent_details WHERE concat(fname,' ',mname,' ',lname) LIKE '%".$search_term."%' OR spouse_name LIKE '%".$search_term."%'  ORDER BY parent_id ASC";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
while($row = mysqli_fetch_array($result)) {
$fname = $row['fname'];
$mname = $row['mname'];
$lname = $row['lname'];
	echo "$fname $mname $lname\n";
}
