<?php
$search_term=$_POST["search_term"];
$query="SELECT b.book_id,b.book_no,b.subject_id,b.author,b.ISBN,b.book_condition,b.class_id,b.book_status,b.book_title FROM books b inner join subject s on b.subject_id=s.subject_id where b.book_no like '%$search_term%' or b.book_title like '%$search_term%' or b.ISBN like '%$search_term%' or b.author like '%$search_term%'or b.book_condition like '%$search_term%' or s.subject_name like '%$search_term%' order by book_id asc";
$result=mysqli_query($con1,$query) or die(mysqli_error($con1));		   
 ?>
<tr align="center" class="entryTableHeader">
<th width="2%">#</th>
<th >BookNo</th>
<th>Book Title</th>
<th >Subject</th>
<th >Author</th>
<th  >ISBN</th>
<th >Book Condition</th>
<th >Class</th>
<th >book Status</th>

</tr>
<?php
if (mysql_num_rows($result) > 0) {
$i = 0;

while($row = mysqli_fetch_assoc($result)) {
extract($row);
if ($i%2) {
	$class = 'row1';
} else {
	$class = 'row2';
}
$i += 1;
$sql2="SELECT subject_name from subject where subject_id='$subject_id'";
//echo $sql;
$result2=mysqli_query($con1,$sql2);
while($row2=mysqli_fetch_array($result2)){
extract($row2);
$sql3="SELECT class_for from class where class_id='$class_id'";
$result3=mysqli_query($con1,$sql3);
while($row3=mysqli_fetch_assoc($result3)){
extract($row3);
?>
<tr class="<?php echo $class; ?>">
<td align="center"><?php echo $book_id;?> </td>
<td align="center"><?php echo $book_no;?> </td>
<td align="center"><?php echo $book_title;?> </td>
<td align="center"><?php echo $row2[0];?> </td>
<td align="center"><?php echo $author;?> </td>
<td align="center"><?php echo $ISBN;?> </td>
<td align="center"><?php echo $book_condition;?> </td>
<td align="center"><?php echo $class_for;?> </td>
<td align="center"><?php echo $book_status;?> </td>

</tr>
 <?php
}
}
}
?>
<tr>
<td colspan="5" align="center">
	<?php
   $count=mysql_num_rows($result);
	?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<font size='2.5'><em><strong> <?php echo $count.' Books found.';

?></em></strong></font></td>
</td></tr>
<?php
}?>