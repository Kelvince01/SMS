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
              <b>Available Books</b><br>
        <b>Date: <?php echo date('d/m/Y'); ?></b>          
      </div>
      </div>
	    <table width="720" border="1" cellspacing="0" cellpadding="5" >
           <tr align="center" class="entryTableHeader">
<th width="" >#</th>
<th >BookNo</th>
<th>Book Title</th>
<th >Author</th>
<th  >Subject</th>
<th  >ISBN</th>
<th >Book Condition</th>
</tr>
<tr>
<?php
$sql = "Select * FROM books where`book_status`='available' ORDER by book_id";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
if (mysqli_num_rows($result) > 0) {
$i = 0;

while($row = mysqli_fetch_assoc($result)){
extract($row);

//book name
//$query1="SELECT book_no,book_title,ISBN,author,subject_id,class_id from books where`book_status`='issued' and book_id='$book_id'";
$query1="SELECT b.book_no,b.book_title,b.ISBN,b.author,s.subject_name FROM books b INNER JOIN subject s USING(subject_id)  where book_id='$book_id'";
$result1=mysqli_query($con1,$query1);
$row1 = mysqli_fetch_assoc($result1);
extract($row1);
?>
<tr class="<?php echo ($i%2 == 0)?'row1':'row2'; ?>">
<td align="center"><?php echo $book_id;?> </td>
<td align=""><?php echo $book_no;?> </td>
<td align=""><?php echo $book_title;?> </td>
<td align=""><?php echo $author;?></td>
<td align=""><?php echo $subject_name;?> </td>
<td align=""><?php echo $ISBN;?> </td>
<td align=""><?php echo $book_condition;?> </td>
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
