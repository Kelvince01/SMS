<link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
<form action="checkbox.php" method="post" name="frmProduce" id="frmProduce">
<table width="70%" border="0" align="center" cellpadding="1" cellspacing="1" class="entryTable">
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