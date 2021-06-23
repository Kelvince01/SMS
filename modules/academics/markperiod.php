<?php 
$yr= date('Y');
$sql = "SELECT m.marking_id,e.exam_code,t.term_name,m.date_from,m.date_to FROM marking_periods m inner join exams e on m.exam_id= e.exam_id inner join term_period t on t.term_id= m.term_id where t.year_name >='$yr'";
echo $sql;
break;
			$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));


if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="teacher"){ ?>			
 <h2>Mark Books</h2> <?php }?>
<form action="receipts/produce_receipt.php" method="post" name="" id="">
<table width="90%" border="0" cellpadding="1" cellspacing="1" id="theList" class="entryTable">

<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="teacher"){ ?>
<tr><td><a href="/sms/index.php?view=add_gradebk" class="add">New Mark Book</a></td>
<td><a href="/sms/index.php?view=markperiod" class="add">Adjust Mark Period</a></td>
</tr> 
<tr align="center" class="entryTableHeader">
<th>Mark BookID</th>
<th width="30%">Exam Name</th>
<th width="15%">Term Name</th>
<th width="15%" >Starts</th>
<th align="center">Ends</th>
<th align="center">Actions</th>  

</tr>
<?php
}
if (mysqli_num_rows($result) > 0) {
$i = 0;

while($row = mysqli_fetch_assoc($result)) {
extract($row);
//$now=$required_manpower-$allocated;
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
?> 
 
<tr class="<?php echo $class; ?>"> 
<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="teacher"){ echo '
<td align="center">'.$gradebk_id.'</td> 
<td align="center"><A HREF="/sms/index.php?view=add_marks&gradebk_id='.$gradebk_id.'">'.$gradebk.'</a> </td> 
<td align="center">'.$subject_name.' </td> 
<td align="center">'.$class_name.' </td> 
<td align="center">'.$term_name.' '.$year_name.' </td>  

<td align="center"><a href="/sms/index.php?view=edit_gradebk&gradebk_id='.$gradebk_id.'"><img src="/sms/images/update.png"/></a>Edit&nbsp;&nbsp;&nbsp;
<a href="/sms/index.php?view=delete_gradebk&gradebk_id='.$gradebk_id.'" onclick="return confirmSubmit();"><img src="/sms/images/delete.jpg"/>Delete</a></td></tr>
';} ?>
 <?php
}
}
else{
	echo 'No Grade Books for now.';
}
?>
</table>

 <p>&nbsp;</p>

</form></p>