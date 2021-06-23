<?php
			
			$sql = "Select * FROM hostel ORDER by hostel_id ASC ";
			$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));


			?>
 <h2>Hostels and The current occupancy</h2>
	<br>
<form action="/sms/index.php?view=allocate_hostel" method="post" name="frmHostel" id="frmHostel">
<table width="80%" border="0" cellpadding="1" cellspacing="1" id="theList" class="entryTable">
<tr><td><select name="student_name">
         <?php
		 
		 //get the student who was recently added and do not have a class yet
	$query1="SELECT stud_id,fname,mname,lname FROM student_details WHERE stud_id
             NOT IN (SELECT stud_id FROM student_details WHERE hostel_id!=0)";
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
<th padding:2px align="center" >Hostel</th>
<th width="20%" >Total Bed Capacity</th>
<th width="20%" >Gender</th>
<th width="15%">Form One</th>
<th width="15%">Form Two</th>
<th width="15%" >Form Three</th>
<th width="15%" >Form Four</th>
<th width="35%">Remaining Beds</th>
<th align="center">Allocate</th>
</tr>
<?php
if (mysqli_num_rows($result) > 0) {
$i = 0;

while($row = mysqli_fetch_assoc($result)) {
extract($row);
$query="SELECT count(hostel_id)as total from student_details where hostel_id='$hostel_id'  and (class_id='1'or class_id='5'or class_id='6') group by hostel_id";
$result1=mysqli_query($con1,$query) or die (mysqli_error($con1));
if (mysqli_num_rows($result1) > 0) {

$row1 = mysqli_fetch_array($result1);
$form_one=$row1[0];
}
else{
$form_one=0;
}
$query="SELECT count(hostel_id)as total from student_details where hostel_id='$hostel_id' and class_id='2' group by hostel_id,class_id";
$result1=mysqli_query($con1,$query)or die (mysqli_error($con1));
if (mysqli_num_rows($result1) > 0) {
$row1 = mysqli_fetch_array($result1);
$form_two=$row1[0];
}
else{
$form_two=0;
}
$query="SELECT count(hostel_id)as total from student_details where hostel_id='$hostel_id' and class_id='3' group by hostel_id,class_id";
$result1=mysqli_query($con1,$query);
if (mysqli_num_rows($result1) > 0) {

$row1 = mysqli_fetch_array($result1);
$form_three=$row1[0];
}
else{
$form_three=0;
}
$query="SELECT count(hostel_id)as total from student_details where hostel_id='$hostel_id' and class_id='4' group by hostel_id,class_id";
$result1=mysqli_query($con1,$query);
if (mysqli_num_rows($result1) > 0) {

$row1 = mysqli_fetch_array($result1);
$form_four=$row1[0];
}
else{
$form_four=0;
}
$now=$form_one+$form_two+$form_three+$form_four;
$balance=$capacity-$now;
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
?>
<tr class="<?php echo $class; ?>">
<td width="20%"><?php echo $hostel_name;?> </td>
<td align="center"><?php echo $capacity;?> </td>
<td align="center"><?php echo $hostel_gender;?> </td>
<td align="center"><?php echo $form_one;?> </td>
<td align="center"><?php echo $form_two;?> </td>
<td align="center"><?php echo $form_three;?> </td>
<td align="center"><?php echo $form_four;?> </td>
<td align="center"><?php echo $balance;?> </td>
<td align="center"><input type="radio" name="hostel_id" value="<?php echo $hostel_id?>"></td></tr>
 <?php
}
}
else{
	echo 'No hostels for now.';
}
?>
<tr>
		<td height="43">&nbsp;</td>
		<td>
		<p align="left">
        <input name="save" type="submit" id="save" value="Allocate Hostel"></p>
	
    </p>
	</td>
	<td>
		<p align="left">
        
		<p><input name="cancel" type="reset" id="cancel" value="Cancel Allocation"></p>
    </p>
	</td>
	</tr>
</form>
</table>

 <p>&nbsp;</p>

</p>