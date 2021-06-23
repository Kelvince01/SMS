<?php 
$current_term = getActiveTerm();
$start="";

	if ($_SESSION['User_type'] <> "admin" && $_SESSION['User_type']<>"super_admin" ){   
		echo "<script language=javascript>window.location = '/sms/index.php?view=home';</script>";
		}?>
<td width="80%" valign="top">
<!--insert data page-->

<div class="demo">

<div id="tabs">
	<ul>
	    <li><a href="#tabs-1">Move To Next Term</a></li>
	 	<li><a href="#tabs-2">Period Details</a></li>
		<li><a href="#tabs-3">Add Term Period</a></li>
	</ul>

	<div id="tabs-1" ><?php echo $start; ?>
			<?php
			$next_term_id =0;
		    $query = "SELECT term_id as next_termid,term_name,start_date,end_date,year_name FROM term_period where start_date>(select end_date from term_period where active =1) order by start_date asc limit 1 ";
			$result     = mysqli_query($con1, $query) or die(mysqli_error($con1));
			if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_assoc($result)) {
					extract($row);
				$next_term_id = $next_termid;	
			?>
 <h2 class="title">Move To Next Term</h2>
<table align="center" cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader"> 
            <td colspan="2">Current Term</td>
            <th colspan="4">Next Term</th>
        </tr>
		<tr> 
            <td  class="label">Term Name</td>
            <td class="content"><?= $current_term['key2']; ?></td>
            <td  class="label">Term Name</td>
            <td class="content"><?= $term_name; ?></td>
            <td  class="label">Start Date</td>
            <td class="content"><?= $start_date; ?></td>
        </tr>
		        <tr> 
            <td  class="label">Year</td>
			<td><?= $current_term['key1']; ?></td>
			<td  class="label">Year</td>
			<td><?= $year_name; ?></td>
			 <td  class="label">End Date</td>
            <td class="content"><?= $end_date; ?></td>
             </tr> 
             <tr><td></td><td><form method="post" action=""><input name="moveperiod" type="submit" id="moveperiod" onclick="return changeTerm();"value="Change Period"></form></td>
             </tr>
         </table> 
	
<?php 
		}
	}

	if(isset($_POST['moveperiod'])){
$term_id= $current_term['key3'];
$term_name=$current_term['key2'];
$start = "Starting export this may take a while...";
$output=array();
$command= "C:\\wamp\\bin\\mysqli\\mysqli5.6.12\\bin\\mysqlidump.exe --user root SMS fees_payment >C:\\SMSfees_payment". date("d-m-Y").".sql";
exec($command,$output,$worked);
switch($worked){
case 0:
$start = 'Database <b>SMS</b> successfully exported to <b>C:\\SMS</b> Proceeding to post payments..';
break;
case 1:
$start = 'There was a warning during the export of <b>SMS fees_payment</b> to <b>C:\\SMS</b>';
break;
case 2:
$start =  'There was an error during export.';
break;
	}
  $sqll="select adminNo,stud_id,class.class_for,admission_year from student_details inner join class on student_details.class_id=class.class_id where active =1";
  $ret= mysqli_query($con1, $sqll) or die(mysqli_error($con1));
  if(mysqli_num_rows($ret) < 1) {
    echo "No Student records to transfer";
  }
  while($rwz = mysqli_fetch_assoc($ret)){
    extract($rwz);

    $sql 	 = "SELECT SUM(amount) as amount FROM fees_payment WHERE adminNo =  '$adminNo' AND term_id = '$term_id' ORDER BY pay_id DESC ";
	$result  = mysqli_query($con1,$sql) or die(mysqli_error($con1));
	$ct		 = mysqli_num_rows($result);
	// SUM(amount) AS total_fee_paid
	
	if($ct > 0){
		while($row = mysqli_fetch_assoc($result)){
			$total_fee_paid =  $row['amount'];
			
		}
	}
	//echo '#'.$adminNo.'-> '.$total_fee_paid. '-'.$term_id.';' ;
	//get new students and chek payment status
	$sql 		= "SELECT term_id as active_term  FROM paid WHERE stud_id='$stud_id'";
    $result		= mysqli_query($con1,$sql) or die('Cannot get Info7.');
    $row7		= mysqli_fetch_assoc($result);
    if($row7 == null){
    $paidstudent ="never";
    $active_term="";	
   }else{
   	extract($row7);
   	if($active_term==$term_id) $paidstudent ="paid";
   	else $paidstudent ="not";	
   }
	// GET PAYMENT TYPES FOR THAT TERM ID
	$sql 	  = "SELECT tb1.* , tb2.amount FROM fee_types AS tb1 INNER JOIN fee_periods AS tb2 ON tb2.feetype_id = tb1.feetype_id WHERE
	 term_name = '$term_name' AND class_for = '$class_for' ORDER BY tb1.type_priority DESC ";
	$resultx  = mysqli_query($co1,$sql) or die('Cannot get Info.');
	$gawa			=	$total_fee_paid;
	$payable		=	0;
	 while($row1  = mysqli_fetch_assoc($resultx)): 
						$balance = 0;
						$paid    = 0;
						//if new student & term he paid is this show 7540
						if($row1['type']=='UNIFORM' && $admission_year == date('Y')  && $active_term ==$term_id)
							$row1['amount']=  7540;
						//if new student & has never paid show 7540
						if(strtoupper($row1['type'])=='UNIFORM' && $admission_year == date('Y')  &&  $paidstudent =="never")
							$row1['amount']=  7540;

						$payable = $payable + $row1['amount'];

	endwhile; 
 $balance = $total_fee_paid - $payable;

 if ($balance!=0){
 	$insertarray = array();
 	$adminNo ="'".$adminNo."'";
 	$date = "'".date('y-m-d')."'";
 	$no= "'1'";
 	$bank="'system'";
 	$receiptno="'MBPS-SYS101'";
 	$payment_mode="'fee_c/d'";
 	$insertarray = array('adminno'=>$adminNo,'amount'=>$balance,'pay_date'=>$date,
 		'payment_mode'=>$payment_mode,'no'=>$no,'user_id'=>'1','bank'=>$bank,'term_id'=>$next_term_id,
 		'receipt_no'=>$receiptno,);
 	$columns=implode(",", array_keys($insertarray));
 	$escaped_values = array_map('mysqli_real_escape_string', array_values($insertarray));
 	$values =implode(",", $insertarray);
 	//insert fee balances
 	$sql2 ="INSERT INTO fees_payment($columns) values($values)";
 	//echo $columns.  '->'.$values;return;
 	 $result2  = mysqli_query($con1,$sql2) or die(mysqli_error($con1)); 

 }
  }//students
//set current term as active 
 	 $sql3 ="UPDATE term_period set active =0 WHERE active=1";
 	 $result3  = mysqli_query($con1,$sql3) or die(mysqli_error($con1)); 
//set next term as active 
 	 $sql4 ="UPDATE term_period set active =1 WHERE term_id = $next_term_id";
 	 $result4  = mysqli_query($con1,$sql4) or die(mysqli_error($con1)); 
 	 //force logout to set term details
echo "<script language=javascript>alert('Login to reset term data!'); window.location = '/sms/modules/security/login.php'; </script>";
 	 
}

?>

	</div>
		<div id="tabs-2" >
	

	<p> <h2 class="title">Period Details</h2>
		<?php
		    $sql = "SELECT * FROM  `term_period` ORDER BY  `term_period`.`year_name` ASC  ";
			$result     = mysqli_query($co1,$sql) or die(mysqli_error($con1));
			?>

<table width="90%" border="0" cellpadding="1" cellspacing="1" id="theList" class="entryTable">
<tr align="center" class="entryTableHeader">
<th width="20%" >Term_Name</th>
<th width="10%">Year</th>
<th width="10%">Active Period</th>
<th width="10%" >Term Starts</th>
<th width="15%" >Term Ends</th>
<th>Action</th>
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
<td align="center"><?php echo $term_name; ?></td>
<td align="center"><?php echo $year_name;?> </td>
<td align="center"><input type="radio"  disabled name ="<?php echo $i;?>" <?php if ($active=="1"){echo 'checked="checked"';} ?> /></td>
<td align="center"><?php echo $start_date;?> </td>
<td align="center"><?php echo $end_date;?> </td>
<td align="center"><a href="/sms/index.php?&term_id= '<?php echo $term_id;?>' &view=editperiod"><img src="/sms/images/update.png"/>Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="/sms/index.php?&term_id='<?php echo $term_id;?>'&view=deleteperiod" onclick="return confirmSubmit();"><img src="/sms/images/delete.jpg"/>Delete</a></td></tr>
</tr>
 <?php
}
}
else{
	echo 'No Period for now.';
}
?>
</table>

 <p>&nbsp;</p>

	</div>

	<div id="tabs-3">
	<div id="addform">
					<form action="" method="post" name="frmaddterm" id="frmaddterm"  >
    <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader"> 
            <td colspan="2">Period Details</td>
        </tr>
		<tr> 
            <td width="150" class="label">Term Name</td>
            <td class="content"><select name="term_name" class="box" id="term_name" required>
			 <option value="" selected>-.- Select -.-</option>
			<option value="Term 1">Term 1</option>
			<option value="Term 2">Term 2</option>
			<option value="Term 3">Term 3</option>
		   </select><span class="required" title="This field is required.">*</span></td>
        </tr>
		        <tr> 
            <td width="150" class="label">Year</td>
			<td><input name="year_name" type="text" class="box"  id="yearpicker" required><span class="required" title="This field is required.">*</span></td>
             </tr>
             <tr> 
            <td width="150" class="label">Active Period</td>
			<td><select name="active" class="box" id="active" required>
			 <option value="" selected>-.- Select -.-</option>
			<option value="1">Yes</option>
			<option value="0">No</option>
		 </select><span class="required" title="This field is required.">*</span></td>
             </tr>
<tr> 
            <td width="150" class="label">Term Starts</td>
            <td class="content"><input name="start_date" type="text" class="box"  id="datepicker" required><span class="required" title="This field is required.">*</span></td>
        </tr>
        <tr> 
            <td width="150" class="label">Term Ends</td>
            <td class="content"><input name="end_date" type="text" class="box" id="datepicker2" required><span class="required" title="This field is required.">*</span></td>
        </tr>
			
        <tr> 
		<td width="150" class="label"></td>
            <td class="content"><label >Fields Marked with<span class="required" title="This field is required.">*</span> are required.</td>
        </tr>
		<tr>
		<td height="43">&nbsp;</td>
		<td>
		<p align="left"> 
        <input name="saveperiod" type="submit" id="saveterm" value="Save">
    </p>
	</td>
	</tr>
    </table> 
	
 <p>&nbsp;</p>
 </form>
	
</div>
</div>
</div><!-- end div specific -->




<div style="clear: both;">&nbsp;</div>
</div>
<!--wrapper table-->
</td>
<script>

function confirmSubmit()
{
    if (confirm('Are you sure you want to delete this record?'))
    {
        return true;
    }
    return false;
}
function changeTerm()
{
    if (confirm('Confirm move to next period?All fee balances will be posted to next term.This may take some time'))
    {
        return true;
    }
    return false;
}
</script>
<?php 
if(isset($_POST['saveperiod'])){
    extract ($_POST);
    if($active=="1"){
$sql="update term_period set active= 0 where active= 1"; 
$result=mysqli_query($co1,$sql) or die(mysqli_error($con1));
    }
$sql="insert into term_period (term_name,year_name,active,start_date,end_date) values('$term_name','$year_name','$active','$start_date','$end_date')";
$result=mysqli_query($con1,$sql) or die(mysqli_error($con1));

echo'<script>window.location=" /sms/index.php?info=edited&view=settings"</script>';
}

?>  