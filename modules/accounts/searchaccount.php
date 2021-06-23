<?php
require_once "../../connection/connect.php";
$search_term = strtolower($_GET["q"]);
if (!$search_term) return;

$sql="SELECT account_name FROM tblaccount WHERE account_name LIKE '%".$search_term."%' ORDER BY account_name ASC";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));

while($row = mysqli_fetch_array($result)) {
$account_name = $row['account_name'];
	echo "$account_name\n";
}
