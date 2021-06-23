<?php
session_start();
include '../../connection/connect.php';
include '../../common/functions.php';
$credit= new credential();
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>mySkulMate::Library</title>
<link rel="stylesheet" href="/sms/modules/academics/new_style.css" type="text/css" />
<script src="/sms/modules/admissions/jquery/development-bundle/jquery-1.9.1.js"></script>
<script> 
$(document).ready( function printpage() {  window.print();      });
</script>
</head>

<body>
<table width="720" border="1" align="center" cellpadding="5" cellspacing="0">
  <tr><td>
   <div  class="totalhead">
      <div class="logo_box"><img src="<?php $log = $credit->creds(); echo $log['key4'];?>" alt="logo" width="120" height="120" border="0" /></div>
      <div class="centreedge" align="center">
        <div class="schhead"><?php $nam = $credit->creds(); echo $nam['key1']; ?> </div>
        <div class="headother"> <?php $addres = $credit->creds(); echo $addres['key2']; ?><br /><br>
                           <b>Issued Teachers Books</b><br>
			  <b>Date:</b><em><strong><?php echo date('Y/m/d'); ?></strong></em><br>
		</div>
      </div>
      </div>
	    <table width="720" border="1" cellspacing="0" cellpadding="5" >
           <tr align="center" class="entryTableHeader">
<th >Teacher</th>
<th >Subject</th>
<th  >Class</th>
<th  >Book Details</th>
<th  >Copies</th>
<th  >Issue Date</th>
</tr>
<tr>
<?php
$sql = "SELECT t.subject,t.copies,t.author,t.class,t.date_issued,tr.teacher_name FROM teacher_issue t,teacher tr where t.teacher_id=tr.teacher_id";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
if (mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)) {
extract($row);
?>
<tr class="">
<td align="center"><?php echo $teacher_name;?> </td>
<td align="center"><?php echo $subject;?> </td>
<td align=""><?php echo $class;?> </td>
<td align=""><?php echo $author;?></td>
<td align=""><?php echo $copies;?> </td>
<td align=""><?php echo $date_issued;?> </td>
</tr>

<?php }
		}else{
	echo 'No books for now.';
}
?>  

 	</tr> 
</table>
</div><p>&copy;  <?php $nam = $credit->creds(); echo $nam['key1']; ?> <?php echo date('Y. '); ?> :powered by mySkulMate</p></td>
</td></tr>

</table>
</body>
</html>
