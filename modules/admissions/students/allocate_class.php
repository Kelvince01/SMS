
	<p> <h2 class="title">Allocate Student A Class</h2>
         <?php
			
			$sql = "Select * FROM class ORDER by class_id ASC ";
			$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
            ?>
	<br>
<form action="/sms/index.php?view=allocate_class" method="post" name="frmClassAllocate" id="frmClassAllocate">
 <table width="70%" border="0"  cellpadding="1" cellspacing="1" id="theList" class="entryTable">
 <tr><td><select name="student_name">
         <?php
		 //get the student who was recently added and do not have a class yet
	$query1="SELECT fname,mname,lname FROM student_details WHERE class_id='0' ";
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
<th width="20%" >Class</th>
<th width="15%">Capacity</th>
<th width="15%">Girls</th>
<th width="15%" >Boys</th>
<th width="15%" >Remaning</th>
<th align="center">Allocate</th>
</tr>
<?php
if (mysqli_num_rows($result) > 0) {
$i = 0;

while($row = mysqli_fetch_assoc($result)) {
extract($row);
$query="SELECT count(gender) as girls from student_details where class_id='$class_id' and gender='female'";
$result1=mysqli_query($con1,$query);
$row1 = mysqli_fetch_array($result1);
$girls=$row1[0];
$query="SELECT count(gender) as boys from student_details where class_id='$class_id' and gender='male'";
$result1=mysqli_query($con1,$query);
$row1 = mysqli_fetch_array($result1);
$boys=$row1[0];
$now=$capacity-($girls+$boys);
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
?>
<tr class="<?php echo $class; ?>">
<td width="20%"><?php echo $class_name;?> </td>
<td align="center"><?php echo $capacity;?> </td>
<td align="center"><?php echo $girls;?> </td>
<td align="center"><?php echo $boys;?> </td>
<td align="center"><?php echo $now;?> </td>
<td align="center"><input type="radio" name="class_id" value="<?php echo $class_id?>"></td></tr>
 <?php
}
}
else{
	echo 'No classes for now.';
}
?>
<tr>
		<td height="43">&nbsp;</td>
		<td align="center">
		<p align="center">
        <input name="save" type="submit" id="save" value="Allocate Class">
    </p>
	</td>
	</tr>
</table>
</form>
 <p>&nbsp;</p>
</p>