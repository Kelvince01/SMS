<?php
require_once "../../../connection/connect.php";
$search_term = strtolower($_GET["q"]);
if (!$search_term) return;

$sql="SELECT fname,mname,lname FROM student_details left join class on student_details.class_id=class.class_id WHERE fname LIKE '%".$search_term."%' OR mname 
LIKE '%".$search_term."%' or lname LIKE '%".$search_term."%' OR adminNo = '".$search_term."' OR class.class_name LIKE '".$search_term."'  ORDER BY stud_id ASC";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));

while($row = mysqli_fetch_array($result)) {
$fname = $row['fname'];
$mname = $row['mname'];
$lname = $row['lname'];
	echo "$fname $mname $lname\n";
}
