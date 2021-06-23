<script>
function confirmSubmit()
{
    if (confirm('Are you sure you want to delete this record?If so remember to delete from Teacher Subject allocation'))
    {
        return true;
    }
    return false;
}
</script>
<?php
	
$sql = "SELECT * FROM teacher order by teacher_id ASC";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));

?>
<td width="100%" valign="top">
 <h2>Teacher Details</h2>
<table width="90%" border="0" cellpadding="1" id="theList" cellspacing="1" class="entryTable">
<tr  class="entryTableHeader">
<th>#</th>
<th>Teacher Name</th>
<th >TSC. No</th>
<th >Initials</th>
<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" ){?> <th >Actions</th> <?php } ?>
</tr>
<?php
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
<td align="center"><?php echo $teacher_id;?></td>
<td align="center"><?php echo $teacher_name;?></td>
<td align="center"><?php echo $tscNo;?> </td>
<td align="center"><?php echo $intials;?> </td>
<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" ){ ?>
<td align="center">
<a href="/sms/index.php?&teacher_id=<?php echo $teacher_id;?>&view=edit_teacher"><img src="/sms/images/update.png"/>Edit </a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="/sms/index.php?&teacher_id=<?php echo $teacher_id;?>&view=delete_teacher" onclick="return confirmSubmit();"><img src="/sms/images/delete.jpg"/> Delete</a></td></tr>
<?php }?>
</tr>
 <?php
}
}
else{
echo 'No Subjects for now.';
}
?>
</td>