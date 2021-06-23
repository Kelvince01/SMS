<td width="80%" valign="top" background="./mySchoolManager 1.0  School Information Management System_files/td_back.jpg">
<div>
	<div class="menu_str">
	<a href="/sms/index.php?view=course_books">Library Books</a></div>

</div>

</div>
<br><h2 align="center">Library Book Reports</h2>
<p><div id="tabs">
	<ul>
	     
		<li><a href="#tabs-1">Available Books</a></li>
		<li><a href="#tabs-2">Issued Teachers Books</a></li>
		<li><a href="#tabs-3">Books Count</a></li>
		<li><a href="#tabs-4">Issued Students Book</a></li>

	</ul>
		<div id="tabs-1" >
<h2>Available Books</h2>

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

</tr>

<?php
$sql = "Select * FROM books where`book_status`='available' ORDER by book_id";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
if (mysqli_num_rows($result) > 0) {
$i = 0;

while($row = mysqli_fetch_assoc($result)){
extract($row);
//book name
$query1="SELECT b.book_no,b.book_title,b.ISBN,b.author,s.subject_name FROM books b INNER JOIN subject s USING(subject_id)  where book_id='$book_id'";
$result1=mysqli_query($con1,$query1);
$row1 = mysqli_fetch_assoc($result1);
extract($row1);
?>
<tr class="<?php echo ($i%2 == 0)?'row1':'row2';$i++; ?>">
<td align="center"><?php echo $book_id;?> </td>
<td align=""><?php echo $book_no;?> </td>
<td align=""><?php echo $book_title;?> </td>
<td align=""><?php echo $author;?></td>
<td align=""><?php echo $subject_name;?> </td>
<td align=""><?php echo $ISBN;?> </td>
<td align=""><?php echo $book_condition;?> </td>
</tr>
 <?php
 }
}
else{
	echo 'No books for now.';
}
?>
</table>
<p> <a href="/sms/modules/library/print_available.php" target="_blank">&nbsp;&nbsp;&nbsp;<u><button type="button" id ="print"> Printable Version</button></u></a></p>
</div></form>
</div>

	<div id="tabs-2">
<h2>Issued Teachers Books</h2>
<DIV STYLE="overflow: auto; height: auto; 
            border-left: 1px gray solid; border-bottom: 1px gray solid; 
            padding:0px; margin: 0px">
<table id="theList" width="98%" border="0" cellpadding="1" cellspacing="1" class="entryTable">

<tr align="center" class="entryTableHeader">
<th >Teacher</th>
<th >Subject</th>
<th  >Class</th>
<th  >Book Details</th>
<th  >Copies</th>
<th  >Issue Date</th>
</tr>

<?php
$sql = "SELECT t.subject,t.copies,t.author,t.class,t.date_issued,tr.teacher_name FROM teacher_issue t,teacher tr where t.teacher_id=tr.teacher_id";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
if (mysqli_num_rows($result) > 0) {
$i = 0;

while($row = mysqli_fetch_assoc($result)) {
extract($row);
if ($i%2) {
	$classe = 'row1';
} else {
	$classe = 'row2';
}
$i += 1;
?>
<tr class="<?php echo $classe; ?>">
<td align="center"><?php echo $teacher_name;?> </td>
<td align="center"><?php echo $subject;?> </td>
<td align=""><?php echo $class;?> </td>
<td align=""><?php echo $author;?></td>
<td align=""><?php echo $copies;?> </td>
<td align=""><?php echo $date_issued;?> </td>
</tr>


 <?php
}
}
else{
	echo 'No books for now.';
}
?>
</table><p> <a href="/sms/modules/library/print_Tbooks.php" target="_blank">&nbsp;&nbsp;&nbsp;<u><button type="button" id ="print"> Printable Version<img src='/sms/images/printButton.png'></button></u></a></p>
</div>
</form>
	
	</div>
    <div id="tabs-3">
	<h2>Books Count</h2>
<DIV STYLE="overflow: auto; height: auto; 
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
</table><div id="print"> <a href="/sms/modules/library/print_count.php" target="_blank">&nbsp;&nbsp;&nbsp;<u><button type="button" id ="print"> Printable Version<img src='/sms/images/printButton.png'></button></u></a></div>
</div>
</form>
</div>
<div id="tabs-4" >
<h2>Issued Students Books</h2>
<form action="" method="post">
<table border="0" cellspacing="1" cellpadding="4" class="entryTable">
</tr>
</table>
</form>
<DIV STYLE="overflow: auto; height: auto; 
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
<th >Action</th>
</tr>

<?php
$sql = "Select * FROM issued_books ORDER by issue_id";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
if (mysqli_num_rows($result) > 0) {
$i = 0;

while($row = mysqli_fetch_assoc($result)){
extract($row);
//book name
//$query1="SELECT book_no,book_title,ISBN,author,subject_id,class_id from books where`book_status`='issued' and book_id='$book_id'";
$query1="SELECT b.book_no,b.book_title,b.ISBN,b.author,s.subject_name,c.class_for FROM class c INNER JOIN books b USING(class_id) INNER JOIN subject s USING(subject_id)  where`book_status`='issued' and book_id='$book_id' ORDER by book_id asc";
$result1=mysqli_query($con1,$query1);
$row1 = mysqli_fetch_assoc($result1);
extract($row1);
$sql = "Select * FROM student_details where stud_id='$stud_id' ";
$student=mysqli_query($con1,$sql);
$row4=mysqli_fetch_assoc($student);

extract($row4);
?>
<tr class="<?php echo ($i%2 == 0)?'row1':'row2'; ?>">
<td align="center"><?php echo $book_id;?> </td>
<td align=""><?php echo $book_no;?> </td>
<td align=""><?php echo $book_title;?> </td>
<td align=""><?php echo $author;?></td>
<td align=""><?php echo $subject_name;?> </td>
<td align=""><?php echo $ISBN;?> </td>
<td align=""><?php echo $book_condition;?> </td>
<td align="center"><?php echo $date_issued;?> </td>
<td align="center"><?php echo $fname. ' '.strtoupper($mname[0]).'. '.$lname;?></td>
<td align="center"><a href= "/sms/index.php?view=clear_book2&book_id=<?php echo $book_id;?>">Return</a></td>
</tr>
 <?php
 $i++;
}
}
else{
	echo 'No books for now.';
}
?>
</table><p> <a href="/sms/modules/library/print_issuestud.php" target="_blank">&nbsp;&nbsp;&nbsp;<u><button type="button" id ="print"> Printable Version<img src='/sms/images/printButton.png'></button></u></a></p>
</div>
</form>
</div>
</div> </p>
</td>
