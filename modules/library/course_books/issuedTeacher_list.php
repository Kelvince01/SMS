
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
<h2>Issued Teachers Books</h2>
<DIV STYLE="overflow: auto; height: 500; 
            border-left: 1px gray solid; border-bottom: 1px gray solid; 
            padding:0px; margin: 0px">
<table width="98%" border="0" cellpadding="1" cellspacing="1" id="theList" class="entryTable">

<tr align="center" class="entryTableHeader">
<th >Teacher</th>
<th >Subject</th>
<th  >Class</th>
<th  >Book Details</th>
<th  >Copies</th>
<th  >Issue Date</th>
</tr>

<?php

//$sql = "SELECT count(book_id) as copies,book_title,subject_id,class_id,author FROM `books` group by book_title,subject_id,class_id,author ";
$sql = "SELECT t.subject,t.copies,t.author,t.class,t.date_issued,tr.teacher_name FROM teacher_issue t,teacher tr where t.teacher_id=tr.teacher_id";
$result     = mysqli_query($con1,$sql) or die(mysqli_error($con1));
if (mysql_num_rows($result) > 0) {
$i = 0;

while($row = mysqli_fetch_assoc($result)) {
extract($row);
//print_r($row);
//
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
</form>
</table>
<p> <a href="/sms/modules/library/print_Tbooks.php" target="_blank">&nbsp;&nbsp;&nbsp;<u><button type="button" id ="print"> Printable Version</button></u></a></p>
</div>
</td>
