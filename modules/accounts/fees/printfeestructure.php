<?php
session_start();
include '../../../connection/connect.php';
include '../../../common/functions.php';
$credit= new credential();
//generate reportcardNo no
$myclass =$_GET['class'];	

$sql_period="SELECT * from term_period where active='1'";
$result_period=mysqli_fetch_assoc(mysqli_query($con1,$sql_period)) or die(mysqli_error($con1). "no active term");
extract($result_period);


?>



<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>mySkulMate::Fees Structure</title>
<link rel="stylesheet" href="/sms/modules/academics/new_style.css" type="text/css" />
<style type="text/css" media="print">
	#noprint
{
display:none;
}

</style>
</head>

<body>

<table width="100%" border="1" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td><div  class="totalhead">
      <div class="logo_box"><img src="/sms/school_logo.jpg" alt="logo" width="80" height="80" border="0" /></div>
      <div class="centreedge" align="center">
        <b><?php $nam = $credit->creds(); echo  nl2br(stripslashes($nam['key1']));?> </b><br />
        <b><?php $addres = $credit->creds(); echo nl2br(stripslashes($addres['key2'])); ?><br />             
              <b>Fee Structure</b><br>
			  <b><?php echo $term_name.' :'.$year_name;?></b> </br> 
        <b>Date: <?php echo date('d/m/Y'); ?></b>          
      </div>
    </div>
        <!--student result data-->
        <div>
        <input name="save" type="button" id="save" value="Print" onclick="printpage();">
        </div>
		<hr  noshade="noshade"/>

<!--gggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg-->
        <!--end student bio data-->
		<?php

		$query="SELECT SUM(p.amount) as total FROM fee_types  t inner join fee_periods p on t.feetype_id = p.feetype_id 
        WHERE p.term_name='".$term_name."' and p.class_for='".$myclass."'";
$result=mysqli_query($con1,$query);
$row=mysqli_fetch_assoc($result);
extract($row); 
		$sql = "Select t.type,p.amount FROM fee_types t inner join fee_periods p on t.feetype_id = p.feetype_id 
        WHERE p.term_name='".$term_name."' and p.class_for='".$myclass."' order by t.type_priority ASC ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));	
?>
 <table width="100%" border="0" align="center" cellpadding="1" id="theList" cellspacing="1" class="entryTable">
<tr align="center" class="entryTableHeader">
<th  align="center" width='20%'>Fee Name</th>
<th  align="center" width="10%">Amount Payable</th>
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

<tr class="<?php echo $class;?>">
<td align="center" width="20%"><?php echo $type; ?></td>
<td align="center" width="10%"><?php echo $amount;?></td>
<?php } ?>
</tr>
<?php

?>
<tr><td></td><td><hr/></td></tr>
<tr class="<?php echo $class;?>"><td align="center" width="20%"><b>Total</b></td><td align="center" width="10%"><b><?php echo $total;?></b></td></tr>
<?php }
else{
echo 'No fees items for now.';
}
?>


</table>

	   
		<hr  noshade="noshade"/>
      <div class="div_pad"><strong>School Principal's Comment:</strong></div><br><br>
	  
          <hr  noshade="noshade"/>
      <!--ggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg-->
		
		
		
		        <div class="div_pad fullhead">
				<?php
$sql = "Select end_date FROM term_period where`active`='1'";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
$rw = mysqli_fetch_array($result);
$sql2 = "Select min(start_date) FROM term_period where end_date >'$rw[0]' ";
$resul     = mysqli_query($con1,$sql2) or die(mysqli_error($con1));
$rwz = mysqli_fetch_array($resul);

				?>
				<p align="left"><b>School Opens on: <?php echo $rwz[0]; ?></b></p>
				

          <div class="signbox" align="center"> <img src="/sms/images/signature.jpg" width="100" height="50" /><br />
              <hr/>
            Authorizing Signature </div>
        </div><p>&copy;  <?php $nam = $credit->creds(); echo $nam['key1']; ?> <?php echo date('Y. '); ?> :powered by mySkulMate</p></td>
  </tr>
</table>
<p style="page-break-after:always;"></p>
</body>
</html>
<script>function printpage() {	window.print();	}</script>