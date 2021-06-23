
<td width="100%" valign="top" background="./mySchoolManager 1.0  School Information Management System_files/td_back.jpg">
<table width="100%" border="0" cellpadding="0" cellspacing="0"  class="">
	<td><div class="menu_str">
	<a href="/sms/index.php?view=availableBooks">Available Books 
	</a></div> </td>    
	<td><div class="menu_str">
	<a href="/sms/index.php?view=issued_books">Issued Books (students)</a></div>
	</td><td><div class="menu_str">
	<a href="/sms/index.php?view=issued_teacher">Issued Books (teachers)</a></div> 
	</td><td><div class="menu_str">
	<a href="/sms/index.php?view=books_count">Books Count
	</a></div></td>
	</table>
<h2>Books Count</h2>
<DIV STYLE="overflow: auto; height: 500; 
            border-left: 1px gray solid; border-bottom: 1px gray solid; 
            padding:0px; margin: 0px">
<table width="98%" border="0" cellpadding="1" cellspacing="1" id="theList" class="entryTable">

<tr align="center" class="entryTableHeader">
<th >Subject</th>
<th  >Book title</th>
<th  >Class</th>
<th  >Author</th>
<th  >Copies</th>
</tr>

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

//
if ($i%2) {
	$classe = 'row1';
} else {
	$classe = 'row2';
}
$i += 1;
?>
<tr class="<?php echo $classe; ?>">
<td align="center"><?php echo $subject_name;?> </td>
<td align="center"><?php echo $book_title;?> </td>
<td align="center"><?php echo $class_name;?> </td>
<td align="center"><?php echo $author;?></td>
<td align="center"><?php echo $copies;?> </td>
</tr>


 <?php
}
}
else{
	echo 'No books for now.';
}
?>
<?php
	$sql = 'SELECT SUM(count) AS total FROM books_count';
	$result=mysqli_query($con1,$sql) or die('could not retrieve total');
	$row=mysqli_fetch_array($result);
	echo "The total no of Books is : $row[0]";
	?>
</form>	
</table>
 <a href="/sms/modules/library/print_count.php" target="_blank">&nbsp;&nbsp;&nbsp;<u><button type="button" id ="print"> Printable Version</button></u></a></div>
</td>
