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
      <div class="logo_box"><img src="/sms/school_logo.jpg" alt="logo" width="80" height="80" border="0" /></div>
      <div class="centreedge" align="center">
        <b><?php $nam = $credit->creds(); echo  nl2br(stripslashes($nam['key1']));?> </b><br />
        <b><?php $addres = $credit->creds(); echo nl2br(stripslashes($addres['key2'])); ?><br />             
              <b>Books Count</b><br>
        <b>Date: <?php echo date('d/m/Y'); ?></b>          
      </div>
      </div>
	    <table width="720" border="1" cellspacing="0" cellpadding="5" >
           <tr align="center" class="entryTableHeader">
<th >Subject</th>
<th  >Book title</th>
<th  >Class</th>
<th  >Author</th>
<th  >Copies</th>
</tr>
<tr>
<?php
$sql = "SELECT count(book_id) as copies,book_title,subject_id,class_id,author FROM `books` group by book_title,subject_id,class_id,author ";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
if (mysqli_num_rows($result) > 0) {
$i = 0;

while($row = mysqli_fetch_assoc($result)) {
extract($row);
//book name
$query1="SELECT subject_name from subject where subject_id='$subject_id'";
$result1=mysqli_query($con1,$query1);
$row1 = mysqli_fetch_assoc($result1);
extract($row1);
$query1="SELECT class_name from class where class_id='$class_id'";
$result1=mysqli_query($con1,$query1);
$row1 = mysqli_fetch_assoc($result1);
extract($row1);
?>
<tr class="">
<td align="center"><?php echo $subject_name;?> </td>
<td align="center"><?php echo $book_title;?> </td>
<td align="center"><?php echo $class_name;?> </td>
<td align="center"><?php echo $author;?></td>
<td align="center"><?php echo $copies;?> </td>
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
