<td width="80%" valign="top">
<script src="fetch.js"></script>
<div class="demo">
<div id="tabs-2">
	<p> <?php
$myclass =$_GET['class'];	
	
	//select no active term
$sql = "SELECT term_id,term_name,year_name FROM term_period WHERE active='1'";
$result = mysqli_query($con1,$sql) or die('Cannot get Info3.');
$row6    = mysqli_fetch_assoc($result);
extract($row6);	
//select no of students
$sql = "SELECT COUNT(*) as students FROM student_details WHERE active='1'";
$result = mysqli_query($con1,$sql) or die('Cannot get Info6.');
$row6    = mysqli_fetch_assoc($result);
extract($row6);	


$sql = "Select * FROM fee_types t inner join fee_periods p on t.feetype_id = p.feetype_id 
        WHERE p.term_name='".$term_name."' and p.class_for='".$myclass."' order by t.type_priority ASC ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));


?>
 <h2>Fees Item For <?php echo $term_name.' Year '. $year_name;?></h2>
 <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" id="theList" class="entryTable">
<tr align="center" class="entryTableHeader">
<th  align="center" width='20%'>Fee Name</th>
<th  align="center" width="10%">Amount Payable</th>
<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="clerk" ){ ?>	
<th  align="center" width="10%">Expected Amount</th>
</tr>
<?php
 } 
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

<tr class="<?php echo $class;?>">
<td align="center" width="20%"><?php echo $type;?></td>
<form action="" method="post" name="" id="">
<td align="center" width="10%"><input type="text" name="payamt[<?php echo $id;?>]" value="<?php echo $amount;?>" ></td>
<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" ){ ?>	
<td align="center" width="10%"><?php echo ($amount*$students); ?></td>
 
<?php
} 
}
$query="SELECT SUM(amount) as total1,count(distinct adminNo) as students  FROM fees_payment  WHERE term_id='$term_id'";
$row=mysqli_query($con1,$query);
$row=mysqli_fetch_assoc($row);
extract($row); 
/////
$query="SELECT SUM(amount) as total FROM fee_periods WHERE term_name='".$term_name."' and class_for='".$myclass."'";
$row=mysqli_query($con1,$query);
$row=mysqli_fetch_assoc($row);
extract($row); 
}
else{
echo 'No fees items for now.';
}
?>
</table>
<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" ){ ?>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="entryTable">

<tr id="content" align="center" colspan="2" align="center"> 

<th  align="center" width="10%">Expected Amount</th>
<th  align="center" width="10%">Student Paid</th>
<th  align="center" width="10%">Paid Amount</th>
<th  align="center" width="10%">Balance</th>


</tr>
  <td class="content" align="center">Ksh. <?php echo ($total*$students);?></td>
 <td class="content" align="center"><?php echo $students; ?></td>
 <td class="content" align="center"><?php echo $total1; ?></td>
 <td class="content" align="center"><?php echo(($total*$students)-$total1);?></td>

 </tr> <td colspan=""><td> <a href=" /sms/index.php?view=fees#tabs-2"><input type="button" value="Back"></a></td></td>
 <td align="center" width="10%"><input type="submit" name="submit" value="Submit" class="button"/></td>
</form></table>

</form>
</p>	
<?php } 
if(isset($_POST['submit'])) 
{
foreach( $_POST['payamt'] as $index => $val)
	{
		$query="update fee_periods set amount ='$val' WHERE id ='$index' ";
		$row=mysqli_query($con1,$query) or die(mysqli_error($con1));
		echo'<script>window.location=" /sms/index.php?info=success&view=fees#tab-2"</script>';
	}
}
?>
</div>

</div>