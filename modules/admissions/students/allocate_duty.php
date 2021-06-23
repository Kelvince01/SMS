<?php
			
			$sql = "Select * FROM duties ORDER by duty_id ASC ";
			$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));


			?>
 <h2>Duty and Current Allocation</h2>

 <br>
 <form action="/sms/index.php?view=allocate_duty" method="post" name="frmDuty" id="frmDuty">
<table width="50%" border="0" cellpadding="1" cellspacing="1" id="theList" class="entryTable">
<tr><td><select name="student_name">
         <?php
		 
		 //get the student who was recently added and do not have a class yet
	$query1="SELECT stud_id,fname,mname,lname FROM student_details WHERE duty_id=0";
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
<th width="20%" >Duty</th>
<th width="15%">Manpower</th>
<th width="15%">Current Allocation</th>
<th width="15%" >Required Manpower</th>
<th align="center">Allocate</th>
</tr>
<?php
if (mysqli_num_rows($result) > 0) {
$i = 0;

while($row = mysqli_fetch_assoc($result)) {
extract($row);
$query="SELECT count(duty_id)as total from student_details where duty_id='$duty_id'";
$result1=mysqli_query($con1,$query);
if (mysqli_num_rows($result1) > 0) {

$row1 = mysqli_fetch_array($result1);
$allocated=$row1[0];
}
else{
$allocated=0;
}
$now=$required_manpower-$allocated;
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
?>
<tr class="<?php echo $class; ?>">
<td width="20%"><?php echo $duty;?> </td>
<td align="center"><?php echo $required_manpower;?> </td>
<td align="center"><?php echo $allocated;?> </td>
<td align="center"><?php echo $now;?> </td>
<td align="center"><input type="radio" name="duty_id" value="<?php echo $duty_id?>"></td></tr>
 <?php
}
}
else{
	echo 'No duties for now.';
}
?>
<tr>
		<td height="43">&nbsp;</td>
		<td>
		<p align="left">
        <input name="save" type="submit" id="save" value="Allocate Duty"></p>
	
    </p>
	</td>
	<td>
		<p align="left">
        
		<p><input name="cancel" type="reset" id="cancel" value="Cancel Allocation"></p>
    </p>
	</td>
	</tr>
</table>

 <p>&nbsp;</p>

</form></p>