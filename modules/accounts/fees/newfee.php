<td width="80%" valign="top">
<div class="demo">

<div id="tabs">
	<ul>
		<li><a href="#tabs-1">New Fee Item</a></li>
		<li><a href="#tabs-2">Assign Fee Item to Class</a></li>
		<li><a href="#tabs-3">New Student Fee Items</a></li>
		
	</ul>
		<div id="tabs-1">
		<p> <h2 class="title">New Fee Item</h2>

<form action="" method="post" name="frmCollect" id="frmCollect">
    <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2">Fee Item</td>
        </tr>
		
		<tr>
            <td width="150" class="label">Fee name</td>
            <td class="content"><input name="type" type="text" class="box" placeholder="eg. Tuition" id="type" size="30" maxlength="50" required><span class="required" title="This field is required.">*</span></td>
        </tr>
	   <tr>
        <td width="150" class="label">Priority</td>
        <td class="content"><input name="type_priority" type="text" placeholder="eg.range(1-20)" id="type_priority" size="30" maxlength="2" required><span class="required">*</span></td>
  	</tr>
        
		<tr>
      	<td colspan="2"><div align="center">
            <input type="submit" name ="save" value="Save">
			<input type="Reset" value="Cancel">
			</div></td>
   		</tr>
    </table>
  </form>
    </div>


	<div id="tabs-2" >
   <p> <h2>Assign Fee Item to Class</h2></p>
   <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
   <form method="post" action="" name="frmassign">
   <tr class="entryTableHeader">
            <td colspan="2">Fee Item</td>
        </tr>
     	<tr>
            <td width="150" class="label">Fee Type</td> 
            <td class="content"><select name="type" class="box" id="mode" required>
			<?php 
			
	$query="SELECT feetype_id,type FROM fee_types";
	$result=mysqli_query($con1,$query);
	$rowArray=array();
	$rowId=2;
	while($row=mysqli_fetch_array($result)){
		$rowArray[$rowId]=$row['type'];
		//$rowId=$rowId+1;
    //	$rowArray=getArray();
		echo "<option value='".$row[0]."' selected>".$rowArray[2]."</option>";
		for($index=100;$index<=count($rowArray);$index++){
			echo "<option value='".$row[0]."' >".$rowArray[$index]."</option>";
		}
    }
	?>
  </select></td>
  </tr>
       	<tr>
            <td width="150" class="label">Class</td> 
            <td class="content"><select name="class_for" class="box" id="mode" required>
			<?php 
			
	$query="SELECT distinct class_for FROM class ORDER BY class_for";
	$result=mysqli_query($con1,$query);
	$rowArray=array();
	$rowId=2;
	while($row=mysqli_fetch_array($result)){
		$rowArray[$rowId]=$row['class_for'];
		echo "<option selected>".$rowArray[2]."</option>";
		for($index=100;$index<=count($rowArray);$index++){
			echo "<option>".$rowArray[$index]."</option>";
		}
    }
	?>
  </select></td></td>
  </tr>
       	<tr>
            <td width="150" class="label">Term</td> 
            <td class="content"><select name="term_name" class="box" id="mode" required>
			<?php 
	$query="SELECT distinct term_name FROM term_period ORDER BY term_name ASC";
	$result=mysqli_query($con1,$query);
	$rowArray=array();
	$rowId=2;
	while($row=mysqli_fetch_array($result)){
		$rowArray[$rowId]=$row['term_name'];
		//$rowId=$rowId+1;
    //	$rowArray=getArray();
		echo "<option selected>".$rowArray[2]."</option>";
		for($index=100;$index<=count($rowArray);$index++){
			echo "<option>".$rowArray[$index]."</option>";
		}
    }
	?>
  </select></td>
  </tr>
  <tr>
        <td width="150" class="label">Amount</td>
        <td class="content"><input name="amount" type="text" required id="amount" size="30" maxlength="30"><span class="required" title="This field is required.">*</span></td>
  </tr>

  <tr>
      	<td></td><td><input type="submit" name="Assign" value="Assign"></td>
    </tr>
</form>
  </table>
	</div>
	<div id="tabs-3">
		   <p> <h2>New Student Fee Amounts</h2></p>
   <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
   <form method="post" action="" name="frmmarkup">
   <tr class="entryTableHeader">
            <td colspan="2">Fee Items Marked Up By:</td>
        </tr>
     	<tr>
            <td width="150" class="label">Admission</td> 
            <td class="content"><input type="text" name="admission" placeholder="eg.200" required></td>
  </tr>
       	<tr>
            <td width="150" class="label">Uniform</td> 
            <td class="content"><input type="text" name="uniform" placeholder="eg.200" required></td>
  </tr>
       	<tr>
            <td width="150" class="label">Term</td> 
            <td class="content"><select name="termname" class="box" id="mode" required>
			<?php 
	$query="SELECT distinct term_name FROM term_period ORDER BY term_name ASC";
	$result=mysqli_query($con1,$query);
	$rowArray=array();
	$rowId=2;
	while($row=mysqli_fetch_array($result)){
		$rowArray[$rowId]=$row['term_name'];
		echo "<option selected>".$rowArray[2]."</option>";
		for($index=100;$index<=count($rowArray);$index++){
			echo "<option>".$rowArray[$index]."</option>";
		}
    }
	?>
  </select></td>
  </tr>
  <tr>
        <td width="150" class="label">Year</td>
        <td class="content"><input name="year" type="text" placeholder="2015" required><span class="required" title="This field is required.">*</span></td>
  </tr>

  <tr>
      	<td></td><td><input type="submit" name="Create" value="Create" ></td>
    </tr>
</form>
  </table>
	  

	  <h2 class="title">New Student Fee MarkUp</h2>
		<?php
		    $sql = "SELECT fees_newstudent.*,t.term_name,t.year_name FROM  fees_newstudent inner join term_period t ON fees_newstudent.period_id =t.term_id ORDER BY  period_id ASC  ";
			$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
			?>

<table width="90%" border="0" cellpadding="1" cellspacing="1" id="theList" class="entryTable">
<tr align="center" class="entryTableHeader">
<th width="20%" >Admission</th>
<th width="10%">Uniform</th>
<th width="10%">Term</th>
<th width="10%" >Year</th>
<th>Action</th>
</tr>
<?php
if (mysql_num_rows($result) > 0)
{
	$i = 0;
	while($row = mysqli_fetch_assoc($result))
	{
		extract($row);

		if ($i%2){
			$class = 'row1';
		} else {
			$class = 'row2';
		}
		$i += 1;
?>
<tr class="<?php echo $class; ?>">
<td align="center"><?php echo $admission;?> </td>
<td align="center"><?php echo $uniform;?> </td>
<td align="center"><?php echo $term_name; ?></td>
<td align="center"><?php echo $year_name;?> </td>
<td align="center"><a href="/sms/index.php?&id= '<?php echo $id;?>' &view=edit_newfee"><img src="/sms/images/update.png"/>Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="/sms/index.php?&id='<?php echo $id;?>'&view=delete_newfee" onclick="return confirmSubmit();"><img src="/sms/images/delete.jpg"/>Delete</a></td></tr>
</tr>
 <?php
	}
}
else
{
	echo 'No Fee Mark Ups for now.';
}
?>
</table>

	</div>


  </div>

</td>
    <?php 
if(isset($_POST['save']))
{
	$type = $_POST['type'];
	$type_priority = $_POST['type_priority'];
	$sql="select type as mytype from fee_types where type ='$type' limit 1";
	$re=mysqli_query($con1,$sql);
	if(mysql_num_rows($re) > 0)
	{
		echo'<script>window.location=" /sms/index.php?view=newfee#tabs-1&info=duplicate"</script>';
	}
	else
	{
		$type= strtoupper($type);
		$query="INSERT INTO fee_types values('','$type','$type_priority') ";
		$row=mysqli_query($con1,$query) or die("insert error :" .mysqli_error($con1));
		echo'<script>window.location=" /sms/index.php?view=newfee#tabs-2&info=success"</script>';
	}
}

if(isset($_POST['Assign']))
{
	extract($_POST);
	$sql	=	"select type as mytype from fee_periods where class_for ='$class_for' and term_name='$term_name' and feetype_id=$type limit 1";
	$re		=	mysqli_query($con1,$sql);
	if(mysql_num_rows($re) > 0)
	{
		echo'<script>window.location=" /sms/index.php?view=newfee#tabs-2&info=duplicate"</script>';
	}
	else
	{
		$query="INSERT INTO fee_periods values('',$type,$amount,'$class_for','$term_name') ";
		$row=mysqli_query($con1,$query) or die(mysqli_error($con1));
		echo'<script>window.location=" /sms/index.php?view=newfee&info=success"</script>';
	}
}

if(isset($_POST['Create']))
{
	extract($_POST);
	$sql="SELECT term_id FROM term_period  WHERE term_name='$termname' and year_name='$year'";
	$re=mysqli_query($con1,$sql) or die(mysqli_error($con1));
	if(mysql_num_rows($re) > 0)
	{
		while($row = mysqli_fetch_assoc($re))
		{
			extract($row);
		}
		$sql="SELECT * FROM fees_newstudent  WHERE period_id=$term_id";

		$re=mysqli_query($con1,$sql);
		if(mysql_num_rows($re) > 0)
		{ //fee exists
			echo'<script>alert("Fee item already exists!")</script>';
		}
		else
		{
			$query="INSERT INTO fees_newstudent values('','$admission','$uniform','$term_id') ";
			$row=mysqli_query($con1,$query) or die("insert error :" .mysqli_error($con1));
			echo'<script>window.location=" /sms/index.php?view=newfee#tabs-1&info=duplicate"</script>';
		}
	
	}
	else
	{
		echo 'Period does not exist in the database records';
	}
}
?>