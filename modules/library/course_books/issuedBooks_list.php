<script type="text/javascript">
$().ready(function() {
	$("#theList tr").hover(function() {
	$(this).toggleClass("highlight")
	},function() {$(this).toggleClass("highlight")})
	});
	</script>
<td width="100%" valign="top" background="./mySchoolManager 1.0  School Information Management System_files/td_back.jpg">
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="" class="">
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
<h2>Issued Students Books</h2>

<DIV STYLE="overflow: auto; height: 500; 
            border-left: 1px gray solid; border-bottom: 1px gray solid; 
            padding:0px; margin: 0px">
<table width="98%" border="0" cellpadding="1" cellspacing="1" id="theList" class="entryTable">

<tr align="center" class="entryTableHeader">
<th width="" >#</th>
<th >BookNo</th>
<th>Book Title</th>
<th >Author</th>
<th  >Subject</th>
<th  >ISBN</th>
<th >Book Condition</th>
<th >Date Issued</th>
<th >Issued To</th>
</tr>

<?php
$sql = "Select * FROM issued_books ORDER by issue_id";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
if (mysql_num_rows($result) > 0) {
$i = 0;

while($row = mysqli_fetch_assoc($result)){
extract($row);
//book name
//$query1="SELECT book_no,book_title,ISBN,author,subject_id,class_id from books where`book_status`='issued' and book_id='$book_id'";
$query1="SELECT b.book_no,b.book_title,b.ISBN,b.author,s.subject_name,c.class_for FROM class c INNER JOIN books b USING(class_id) INNER JOIN subject s USING(subject_id)  where`book_status`='issued' and book_id='$book_id'";
$result1=mysqli_query($con1,$query1);
$row1 = mysqli_fetch_assoc($result1);
extract($row1);
$sql = "Select * FROM student_details where stud_id='$stud_id' ";
$student=mysqli_query($con1,$sql);
$row4=mysqli_fetch_assoc($student);
extract($row4);
?>
<tr class="<?php echo ($i%2 == 0)?'row1':'row2'; ?>">
<td align="center"><?php //echo $book_id;?> </td>
<td align=""><?php echo $book_no;?> </td>
<td align=""><?php echo $book_title;?> </td>
<td align=""><?php echo $author;?></td>
<td align=""><?php echo $subject_name;?> </td>
<td align=""><?php echo $ISBN;?> </td>
<td align=""><?php echo $book_condition;?> </td>
<td align="center"><?php echo $date_issued;?> </td>
<td align="center"><?php echo $fname. ' '.strtoupper($mname[0]).'. '.$lname;?></td>
</tr>
 <?php
 $i++;
}
}
else{
	echo 'No books for now.';
}
?></table>
<p> <a href="/sms/modules/library/print_issuestud.php" target="_blank">&nbsp;&nbsp;&nbsp;<u><button type="button" id ="print"> Printable Version</button></u></a></p>


</div>
</form>
</td>
