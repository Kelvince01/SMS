<?php
session_start();
include('../../../connection/connect.php');

$adminNo=$_REQUEST['adminNo'];

?>
<select name="student">
<?php
	$query="SELECT fname,mname,lname FROM student_details WHERE adminNo='$adminNo'";
$result=mysqli_query($con1,$query) or die (mysqli_error($con1));
	$rowArray=array();
	$rowId=2;
	while($row=mysqli_fetch_array($result)){
		$rowArray[$rowId]=$row['fname'].' '.$row['mname'].' '.$row['lname'];
		//$rowId=$rowId+1;
    //	$rowArray=getArray();
		echo "<option selected>".$rowArray[2]."</option>";
		for($index=100;$index<=count($rowArray);$index++){
			echo "<option>".$rowArray[$index]."</option>";
		}
    }
	?>
</select>
