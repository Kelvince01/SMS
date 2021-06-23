<link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
<form action="checkbox.php" method="post" name="frmProduce" id="frmProduce">
<table width="70%" border="0" align="center" cellpadding="1" cellspacing="1" class="entryTable">
 <tr><td><select name="student_name">
         <?php
		 include '../../../connection/connect.php';
		 //get the student who was recently added and do not have a class yet
	$query1="SELECT stud_id,fname,mname,lname FROM student_details WHERE stud_id
             NOT IN (SELECT student_id FROM student_subject)";
	$result1=mysqli_query($con1,$query1);
	$rowArray=array();
	$rowId=2;
	while($row1=mysqli_fetch_array($result1)){
		$rowArray[$rowId]=$row1['fname'].' '.$row1['mname'].' '.$row1['lname'];
		//$rowId=$rowId+1;
    //	$rowArray=getArray();
		echo "<option selected>".$rowArray[2]."</option>";
		for($index=100;$index<=count($rowArray);$index++){
			echo "<option>".$rowArray[$index]."</option>";
		}
    }
	?>
</select></td></tr>
<tr align="center" class="entryTableHeader">
<th padding:2px align="center" >Subject ID</th>
<th padding:2px align="center">Subject Name</th>
<th padding:2px align="center">Allocate</th>
</tr>
<?php
include '../../../connection/connect.php';
$sql = "Select subject_id, subject_name FROM subject ORDER by subject_id ASC ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
if (mysqli_num_rows($result) > 0) {
	$i = 0;

	while($row = mysqli_fetch_assoc($result)) {
		extract($row);
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
?>
<tr class="<?php echo $class; ?>">
<td align="center"><?php echo $subject_id;?> </td>
<td align="center"><?php echo $subject_name;?></td>
<td align="center"><input type="checkbox" name="subject[]" value="<?php echo $subject_name?>"></td></tr>
 <?php
}
?>
<td align="center" valign="middle"><input name="submit" type="submit" value="Search" class="button"></td></form>

<?php
}
else{
echo 'No Subjects for now.';
}
?>
</table>
</form>