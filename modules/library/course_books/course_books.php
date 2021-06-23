<td width="80%" valign="top" background="./mySchoolManager 1.0  School Information Management System_files/td_back.jpg">
<script type="text/javascript" src="/sms/modules/library/course_books/getResults.js"></script> 

<div class="demo">

<div id="tabs">
	<ul>
		<li><a href="#tabs-1">New Book</a></li>
		<li><a href="#tabs-2">Student Issue</a></li>
		<li><a href="#tabs-3">Teacher Issue</a></li>
		<li><a href="#tabs-4">Clear Book</a></li>
		<li><a href="#tabs-5">Search Book</a></li>
		<li><a href="#tabs-6">Reports</a></li>

	</ul>
		<div id="tabs-1" >
	
		<p> <h2 class="title">Add a New Book</h2>


			<form action="/sms/index.php?view=addbook" method="post" name="frmAddBk" id="frmAddBk">
    <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2">Book Details</td>
        </tr>
		<tr>
            <td width="150" class="label">Book No</td>
            <td class="content"><input name="bkNo" type="text" class="box" value = "" id="bkNo" size="30" maxlength="50" class=" validate-alpha" required></td>
        </tr>

		        <tr>
            <td width="150" class="label">Book Title</td>
            <td class="content"><input name="bkTitle" type="text" class="box" value = "" id="bkTitle" size="30" maxlength="50" required><span class="" title="This field is required.">*</span></td>
        </tr>

			<tr>
            <td width="150" class="label">Subject</td>
            <td class="content"><select name="subject" class="box" id="subject" required>
			 <?php
	$query="SELECT subject_name FROM  subject";
	$result=mysqli_query($con1,$query);
	$rowArray=array();
	$rowId=2;
	while($row=mysqli_fetch_array($result)){
		$rowArray[$rowId]=$row['subject_name'];
		//$rowId=$rowId+1;
    //	$rowArray=getArray();
		echo "<option selected>".$rowArray[2]."</option>";
		for($index=100;$index<=count($rowArray);$index++){
			echo "<option>".$rowArray[$index]."</option>";
		}
    }
	?>
		   </select></td></td>
        </tr>
			<tr>
            <td width="150" class="label">ISBN No</td>
            <td class="content"><input name="isbnNO" type="text" class="box" value = "" id="isbnNO" size="30" maxlength="50" required><span class="" title="This field is required.">*</span></td>
        </tr>
		
        <tr>
            <td width="150" class="label">Author</td>
            <td class="content"><input name="author" type="text" class="box" value = "" id="author" size="30" maxlength="50" required><span class="" title="This field is required.">*</span></td>
        </tr>
       <tr>
            <td width="150" class="label">Book Condition</td>
			<td><select name="condtion" class="box" id="condition" required>
			<option value="Good">Good</option>
        <option value="Undesirable condition">Undesirable Condition</option>
		 <option value="Beyond Repair">Beyond Repair</option>
		  <option value="Some Pages Missing">Some Pages Missing</option>
		   </select></td>
             </tr>
		<tr>
            <td width="150" class="label">Class</td>
			<td><select name="class" class="box" id="class_id" required>
         <?php
	$query="SELECT DISTINCT class_id,class_name FROM  class ";
	$result=mysqli_query($con1,$query);
	while($nt=mysqli_fetch_array($result)){//Array or records stored in $nt
					echo "<option value=$nt[class_id]>$nt[class_name]</option>";
									}
	?>
</select></td>
             </tr>
		     <tr>
      	<td colspan="2"><div align="center">
            <input type="submit" value="Add" >
			<input type="Reset" value="Cancel">
			</div></td>
    </tr>	 
    </table>

 <p>&nbsp;</p>

</form></p>
	</div>

	<div id="tabs-2">
	<p> <h2 class="title" >Issue Books To Students</h2>
         
	<br>


			<form action="/sms/index.php?view=select_book" method="post" name="frmIssue" id="frmIssue">
    <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2"Details</td>
			</tr>
        <tr>
		<td height="24" width="150" class="label">Select Subject:</td>
			<td><select name="subject" class="box" id="subject" required>
         <?php
	$query="SELECT  subject_name FROM  subject ";
	$result=mysqli_query($con1,$query);
	$rowArray=array();
	$rowId=2;
	while($row=mysqli_fetch_array($result)){
		$rowArray[$rowId]=$row['subject_name'];
		//$rowId=$rowId+1;
    //	$rowArray=getArray();
		echo "<option selected>".$rowArray[2]."</option>";
		for($index=100;$index<=count($rowArray);$index++){
			echo "<option>".$rowArray[$index]."</option>";
		}
    }
	?>
</select></td></tr>
   <tr>
			<td height="24" width="150" class="label">Select Class:</td>
			<td><select name="class_id" class="box" id="class_id" required>
         <?php
	$query="SELECT DISTINCT class_id,class_name FROM  class ";
	$result=mysqli_query($con1,$query);
	while($nt=mysqli_fetch_array($result)){//Array or records stored in $nt
					echo "<option value=$nt[class_id]>$nt[class_name]</option>";
					/* Option values are added by looping through the array */
				}
	?>
</select></td></tr>

        <tr>
      	<td colspan="2"><div align="center">
            <input type="submit" value="Continue" >
			<input type="Reset" value="Cancel">
			</div></td></tr>
			
			
			
</table></form>

 <p>&nbsp;</p>

</form></p>
		</div>
	<div id="tabs-3" >
	<p> <h2 class="title">Issue Books To Teacher</h2>


			<form action="/sms/index.php?view=teacher_issue" method="post" name="frmTeacherIssue" id="frmTeacherIssue">
    <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2">Books Details</td>
        </tr>
		

			<tr>
            <td width="150" class="label">Subject</td>
            <td class="content"><select name="subject" class="box" id="subject" required>
			 <?php
	$query="SELECT subject_name FROM  subject";
	$result=mysqli_query($con1,$query);
	$rowArray=array();
	$rowId=2;
	while($row=mysqli_fetch_array($result)){
		$rowArray[$rowId]=$row['subject_name'];
		//$rowId=$rowId+1;
    //	$rowArray=getArray();
		echo "<option selected>".$rowArray[2]."</option>";
		for($index=100;$index<=count($rowArray);$index++){
			echo "<option>".$rowArray[$index]."</option>";
		}
    }
	?>
		   </select></td></td>
        </tr>
			<tr>
            <td width="150" class="label">Teacher</td>
            <td class="content"><select name="name" class="box" id="name" required>
			 <?php
	$query="SELECT teacher_id,teacher_name FROM  teacher";
	$result=mysqli_query($con1,$query);
	$rowArray=array();
	$rowId=2;
	while($row=mysqli_fetch_array($result)){
		$rowArray[$rowId]=$row['teacher_name'];
		//$rowId=$rowId+1;
    //	$rowArray=getArray();
		echo "<option selected>".$rowArray[2]."</option>";
		for($index=100;$index<=count($rowArray);$index++){
			echo "<option>".$rowArray[$index]."</option>";
		}
    }
	?>
		   </select></td></td>
        </tr>
	
			<tr>
            <td width="150" class="label">No of Copies</td>
            <td class="content"><input name="copies" type="text" class="box" value = "" id="copies" size="30" maxlength="50" required><span class="" title="This field is required.">*</span></td>
        </tr>
		
        <tr>
            <td width="150" class="label">Book Name and Author</td>
            <td class="content"><input name="author" type="text" class="box" value = "" id="author" size="30" maxlength="50" required><span class="" title="This field is required.">*</span></td>
        </tr>
		<tr>
            <td width="150" class="label">Book Condition</td>
			<td><select name="condtion" class="box" id="condition" required>
			<option value="Good">Good</option>
        <option value="Undesirable condition">Undesirable Condition</option>
		 <option value="Beyond Repair">Beyond Repair</option>
		  <option value="Some Pages Missing">Some Pages Missing</option>
		   </select></td>
             </tr>
     		<tr>
            <td width="150" class="label">Class</td>
			<td><select name="class" class="box" id="class" required>
         <?php
	$query="SELECT DISTINCT class_id,class_name FROM  class ";
	$result=mysqli_query($con1,$query);
	while($nt=mysqli_fetch_array($result)){//Array or records stored in $nt
					echo "<option value=$nt[class_id]>$nt[class_name]</option>";
					/* Option values are added by looping through the array */
				}
	?>
</select></td>
             </tr>
		<tr>
      	<td colspan="2"><div align="center">
            <input type="submit" value="Issue" onclick="return show_confirm(this);">
			<input type="Reset" value="Cancel">
			</div></td>
    </tr>	 
    </table>

 <p>&nbsp;</p>

</form></p>
		</div>
<div id="tabs-4">



			<form action="/sms/index.php?view=clear_book" method="post" name="frmClear" id="frmClear">
    <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
        <tr class="entryTableHeader">
            <td colspan="2">Clear Books</td>
        </tr>
		

			<tr>
            <td width="150" class="label">Subject</td>
            <td class="content"><select name="subject" class="box" id="subject" required>
			 <?php
	$query="SELECT distinct subject_name FROM books ,subject WHERE book_status='issued' and books.subject_id=subject.subject_id  ";
	$result=mysqli_query($con1,$query);
	$rowArray=array();
	$rowId=2;
	while($row=mysqli_fetch_array($result)){
		$rowArray[$rowId]=$row['subject_name'];
		//$rowId=$rowId+1;
    //	$rowArray=getArray();
		echo "<option selected>".$rowArray[2]."</option>";
		for($index=100;$index<=count($rowArray);$index++){
			echo "<option>".$rowArray[$index]."</option>";
		}
    }
	?>
		   </select></td></td>
        </tr>
		<tr>
            <td width="150" class="label">Class</td>
            <td class="content"><select name="class" class="box" id="class" required>
			 <?php
	$query="SELECT distinct class_name FROM books ,class WHERE book_status='issued' and books.class_id=class.class_id";
	$result=mysqli_query($con1,$query);
	$rowArray=array();
	$rowId=2;
	while($row=mysqli_fetch_array($result)){
		$rowArray[$rowId]=$row['class_name'];
		//$rowId=$rowId+1;
    //	$rowArray=getArray();
		echo "<option selected>".$rowArray[2]."</option>";
		for($index=100;$index<=count($rowArray);$index++){
			echo "<option>".$rowArray[$index]."</option>";
		}
    }
	?>
		   </select></td></td>
        </tr>
		<tr>
            <td width="150" class="label">Book</td>
            <td class="content"><select name="book_id" class="box" id="book_id" required>
			 <?php
	$query="SELECT book_no,book_id FROM books WHERE book_status='issued'";
	$result=mysqli_query($con1,$query);
	while($nt=mysqli_fetch_array($result)){//Array or records stored in $nt
					echo "<option value=$nt[book_id]>$nt[book_no]</option>";
					/* Option values are added by looping through the array */
				}
	?>
		   </select></td></td>
        </tr>
			<tr>
            <td width="150" class="label">Book Condition</td>
			<td><select name="condition" class="box" id="condition" required>
			<option value="Good">Good</option>
        <option value="Undesirable condition">Undesirable Condition</option>
		 <option value="Beyond Repair">Beyond Repair</option>
		  <option value="Some Pages Missing">Some Pages Missing</option>
		   </select></td>
             </tr>
		<tr>
      	<td colspan="2"><div align="center">
            <input type="submit" value="Clear" onclick="return show_confirm(this);">
			<input type="Reset" value="Cancel">
			</div></td>
    </tr>	 
    </table>

 <p>&nbsp;</p>

</form></p>
</div>
<div id="tabs-5">
<form action="" method="post" name="frmSearch" id="frmSearch">
    <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
      <td><img src="/sms/images/view.png"/>Search Book:<input name="search_term" type="text" class="box" value = "" id="search_term" size="20" maxlength="50" title="Enter your search term" onChange="">
<input type="submit" value="Search" name="frmSearch">
<input type="Reset" value="Cancel">
	</td></tr>		
 <tr><td id="search_results"><b>Current Search Results....</b></td></tr>
  </table>
  <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" id="theList" class="entryTable">
 <?php
 if (isset($_POST['frmSearch'])){
 include ('getResults.php');
 }
 ?>

 
</table>
 <p>&nbsp;</p>

</form>
</div>
<div id="tabs-6">
<div>
    <div class="menu_str">
	<a href="/sms/index.php?view=availableBooks">Available Books 
	</a></div>     
	<div class="menu_str">
	<a href="/sms/index.php?view=issued_books">Issued Books (students)</a></div>
	<div class="menu_str">
	<a href="/sms/index.php?view=issued_teacher">Issued Books (teachers)</a></div> 
	<div class="menu_str">
	<a href="/sms/index.php?view=books_count">Books Count
	</a></div>
	
  <?php
$query="SELECT subject_name, class_name, SUM( count ) 
FROM books_count b, subject s, class c
WHERE b.subject_id = s.subject_id
AND b.class_id = c.class_id
GROUP BY b.subject_id"; 

$result=mysqli_query($con1,$query);
	
?>
<br>
<h2>A count of Available Books</h2>
<table border="0" cellpadding="1" cellspacing="1" id="theList" class="entryTable">
<tr class="entryTableHeader" >

<td>Subject</td>
<td>Class</td>
<td>No of Copies</td>




</tr>
<?php
	//fetch each record in result set
	for($counter=0;
	$row=mysql_fetch_row($result);
	$counter++){
	print("<tr >");
	foreach($row as $key=>$value)
	print("<td>$value</td>");
	
	print("</tr>");
	}
	
	
	?>
</table>
	<br>
	<?php
	$sql = 'SELECT SUM(count) AS total FROM books_count';
	$result=mysqli_query($con1,$sql) or die('could not retrieve total');
	$row=mysqli_fetch_array($result);
	echo "The total no of Books is : $row[0]";
	?>
</div>

</div>
</td>

</div>
</div>
</div>

</td>