<td width="80%" valign="top">
<div class="demo">

<div id="tabs">
	<ul>
     <?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="clerk" ){?>
		<li><a href="#tabs-1">Collect Fees</a></li>
		<?php
		}
		?>
		<li><a href="#tabs-2">Fees Item</a></li>
		<li><a href="#tabs-3">Fees Statement</a></li>
	<?php if ( $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="clerk" ){?>
	   <li><a href="#tabs-4">Income &amp; Expenses A/Cs</a></li><?php } ?>
	        </ul>
     <?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="clerk" ){?>
		<div id="tabs-1" align="center">
		<p> <h2 class="title">Collect Fees</h2>
		<?php
			$sql = "Select * FROM class ORDER by class_id ASC ";
			$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));


			?>

<form action="/sms/index.php?view=fee_process" method="post" name="frmCollect" id="frmCollect">
    <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2">Payment Details</td>
        </tr>
		
		<tr>
            <td width="150" class="label">Enter AdminNo</td>
            <td class="content"><input name="adminNo" type="text" class="box" value = "" id="adminNo" size="30" maxlength="50" onChange="getStudent(this.value);" required><span class="required" title="This field is required.">*</span></td>
        </tr>
	
		 	<tr>
            <td width="150" class="label">Payment Mode</td> 
            <td class="content"><select name="mode" class="box" id="mode" required>
			<?php 
			
	$query="SELECT payment_mode FROM  payment_modes";
	$result=mysqli_query($con1,$query);
	$rowArray=array();
	$rowId=2;
	while($row=mysqli_fetch_array($result)){
		$rowArray[$rowId]=$row['payment_mode'];
		echo "<option selected>".$rowArray[2]."</option>";
		for($index=100;$index<=count($rowArray);$index++){
			echo "<option>".$rowArray[$index]."</option>";
		}
    }
	?>
  </select></td></td>
        </tr>
		<tr>
            <td width="150" class="label">Payment Mode No</td>
            <td class="content"><input name="mode_no" type="text" class="box"  id="mode_no" size="30" maxlength="50"></td>
        </tr>
		<tr>
            <td width="150" class="label">Bank</td>
            <td class="content"><input name="bank" type="text" class="box" id="bank" size="30" maxlength="50"><span class="required" title="This field is required.">*</span></td>
        </tr>
			<tr>
            <td width="150" class="label">Amount</td>
            <td class="content"><input name="amount" type="text" class="box" required id="amount" size="30" maxlength="50"><span class="required" title="This field is required.">*</span></td>
        </tr>
		
        
		     <tr>
      	<td colspan="2"><div align="center">
            <input type="submit" value="Process" onclick="return show_confirm(this);">
			<input type="Reset" value="Cancel">
			</div></td>
    </tr>	

    </table>

 <p>&nbsp;</p>

</form>
	</div>
			<?php
		}
		?>
	<div id="tabs-2">
	<p> <?php

	
	//select no active term
$sql = "SELECT term_id,term_name,year_name FROM term_period WHERE active='1'";
$result = mysqli_query($con1,$sql) or die('Cannot get Info3.');
$row6    = mysqli_fetch_assoc($result);
extract($row6);	
//select no of students

    $myclass ='Class 1';
    $total=0;
    $total1=0;
   if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){ 
   	$myclass = ($_POST['class']);
    }
$sql = "SELECT COUNT(*) as students1 FROM student_details Inner Join
  class On student_details.class_id = class.class_id Where student_details.active = '1'     
  AND Class_for ='".$myclass."'";
$result = mysqli_query($con1,$sql) or die('Cannot get Info6.');
$row6    = mysqli_fetch_assoc($result);
extract($row6);	

?>
 <h2>Fees Item For <?php echo $term_name.' Year '. $year_name;?></h2>
 <form method="post" action="/sms/index.php?view=fees#tabs-2" name="classfilter" id="classfilter">
 <span><select name="class" class="box" id="class_id" onchange="classfilter.submit();"  required>
  <?php

	$qry="SELECT DISTINCT class_for FROM  class ";
	$res=mysqli_query($con1,$qry);
	echo "<option selected>$myclass</option>";
	while($nt=mysqli_fetch_array($res)){//Array or records stored in $nt
		echo "<option>$nt[class_for]</option>";
		}
	$sql = "Select t.type,p.amount FROM fee_types t inner join fee_periods p on t.feetype_id = p.feetype_id 
        WHERE p.term_name='".$term_name."' and p.class_for='".$myclass."' order by t.type_priority ASC ";
	$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));	
	?>
</select></span>
</form> 
 <table width="100%" border="0" align="center" cellpadding="1" id="theList" cellspacing="1" class="entryTable">
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
<td align="center" width="20%"><?php echo $type; ?></td>
<td align="center" width="10%"><?php echo $amount;?></td>
<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="clerk" ){ ?>	
<td align="center" width="10%"><?php echo ($amount*$students1); ?></td>
<?php
} 
}
$query="SELECT SUM(amount) as total1  FROM fees_payment p inner join student_details s on p.adminNo= s.adminNo 
inner join class c on s.class_id=c.class_id and c.class_for='".$myclass."' and term_id='$term_id'";
$row=mysqli_query($con1,$query);
$row=mysqli_fetch_assoc($row);
extract($row); 


$query="SELECT count(distinct p.adminNo) as students FROM fees_payment p inner join student_details s on p.adminNo= s.adminNo 
inner join class c on s.class_id=c.class_id and c.class_for='".$myclass."' and term_id='$term_id'";
$row=mysqli_query($con1,$query);
$row=mysqli_fetch_assoc($row);
extract($row); 

/////
$query="SELECT SUM(amount) as total FROM fee_periods WHERE term_name='".$term_name."' and class_for='".$myclass."'";
$result=mysqli_query($con1,$query);
$row=mysqli_query($con1,$query);
$row=mysqli_fetch_assoc($row);
extract($row); 
}
else{
echo 'No fees items for now.';
$students=0; //no students in that class who have paid
}
?>
</table>
<?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="clerk" ){ ?>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="entryTable">
<tr id="content" align="center" colspan="2" align="center"> 

<th  align="center" width="10%">Expected Amount</th>
<th  align="center" width="10%">Student Paid</th>
<th  align="center" width="10%">Paid Amount</th>
<th  align="center" width="10%">Balance</th>


</tr>
  <td class="content" align="center">Ksh. <?php echo ($total*$students1);?></td>
 <td class="content" align="center"><?php echo $students; ?></td>
 <td class="content" align="center"><?php echo $total1; ?></td>
 <td class="content" align="center"><?php echo(($total*$students)-$total1);?></td>
 </tr>
 <td> <a href=" /sms/index.php?view=edit_fee&class=<?= $myclass; ?>"><input type="button" id="print" value="Edit Fee Structure"></a></td>
 <td><a href=" /sms/modules/accounts/fees/printfeestructure.php?class=<?= $myclass; ?>" target="_blank"><input type="button" id="print" value="Print Fee Structure"></a></td>
 <td><a href=" /sms/index.php?view=newfee"><input type="button" id="print" value="New Fee Item"></a></td>
 </table>
 
</form>
</p>	
<?php } ?>	
		</div>

	<div id="tabs-3" align="center">
	<p> <?php

if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="clerk" || $_SESSION['User_type']=="student" || $_SESSION['User_type']=="parent" ){ ?>
 
 <h2 align="center">Student Fees Statement</h2>
   <?php 
	if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="clerk" ){ ?>
		<div align="left">
			<a href= "/sms/modules/accounts/fees/receipt/fees_stateall.php" target="_blank"><button name="go"  id="print" value="">Print All Fee Statements</button></a>
			<a href= "/sms/modules/accounts/feesummary.php" target="_blank"><button name="go"  id="print" value="">Fee Summary</button></a>
		</div>


		<?php }?>
<?php	
	if ($_SESSION['User_type']=="student"){ 
	$query1= " SELECT adminNo FROM student_details WHERE concat(fname,' ',mname) like'%".$_SESSION['full_name']."%' ";
	$result = mysqli_query($con1,$query1);
	$nt=mysqli_fetch_assoc($result);
	extract($nt);
	?>		
<form action="/sms/modules/accounts/fees/receipt/fees_statement2.php?adminNo=<?php echo $adminNo;?>" target ="_blank" method="post" name="frmCollect" id="frmCollect">
<?php } ?>
   <div><?php include_once 'message.php'; ?></div>

<form action="/sms/modules/accounts/fees/receipt/fees_statement.php" method="post" name="frmCollect" target ="_blank" id="frmCollect">
    <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2">Student Details</td>
        </tr>
		<?php	
	if ($_SESSION['User_type']=="student"){ 
	
	?>
            <tr>
            <td width="150" class="label">Student AdminNo</td>
            <td class="content"><?php echo $adminNo;?></td>
        </tr>
      <?php }  
		
	else{ ?>
		<tr>
            <td width="150" class="label">Student AdminNo</td>
            <td class="content"><input name="adminNo" type="text" class="box" maxlength="4" onChange="getStudent(this.value);" ><span class="required" title="This field is required.">*</span></td>
        </tr>
       
<?php	}?>	
      	<td colspan="1"></td><td><div align="left">
            <input type="submit" value="Process">
			
			</div></td>
    </tr>	 
    </table>

 <p>&nbsp;</p>

</form>
     <?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="clerk" ){?>
<form action="/sms/modules/accounts/fees/receipt/fees_stateall.php" method="post" name="frmCollect" target ="_blank" id="frmCollect">
    <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2">Print Fee per Class</td>
        </tr>
		<?php	
	if ($_SESSION['User_type']!="student"){ ?>
 <tr>
        	<td width="150" class="label">Class</td> 
            <td class="content"><select name="class_id" class="box" id="mode" required>
			<?php 
			
	$query="SELECT class_id,class_name FROM class ORDER BY class_name";
	$result=mysqli_query($con1,$query);
	$rowArray=array();
	$rowId=2;
	while($row=mysqli_fetch_array($result)){
		$rowArray[$rowId]=$row['class_name'];
		echo "<option value='".$row[0]."' selected>".$rowArray[2]."</option>";
		for($index=100;$index<=count($rowArray);$index++){
			echo "<option value='".$row[0]."'>".$rowArray[$index]."</option>";
		}
    }
	?>
  </select></td>
        </tr>
       
<?php	}?>	
      	<td colspan="1"></td><td><div align="left">
            <input type="submit"  name ="byclass" value="Process">
			
			</div></td>
    </tr>	 
    </table>

 <p>&nbsp;</p>

</form>
<?php } ?>

 <p>&nbsp;</p>
</p>
		</div>
		<?php }?>
		<?php if ( $_SESSION['User_type']=="super_admin" || $_SESSION['User_type']=="clerk" ){?>	
		<div id="tabs-4">
<div class="menu_str"><a href="/sms/index.php?view=income">Add Accounts</a>
</div>
	<div class="menu_str">
	<a href="/sms/modules/accounts/trial_bal.php" target="_blank">Trial Balance</a></div>
	<div class="menu_str">
	<a href="/sms/modules/accounts/cashbook.php" target="_blank">Cash Book</a></div>

 <p>&nbsp;</p>
</p>
</div>
<?php }?>
</div>
</td>
<!--<script type="text/javascript">
var myval, dataString;
	$('#class_id').onChange({
		myval = $('#class_id').val();
		var dataString = 'search' + myval;
    $.ajax({
          type: "POST",
          url: "searchfees.php",
          data: dataString,
          cache: false,
          success: function(html)
          {
          $("#result").html(html).show();
          }
          });

	});

</script> -->
