<?php
//SESSIONS AREA
/*This Function is used to create navigation links for ordered list and reports */
function getPagingNav($sql, $pageNum, $rowsPerPage, $queryString = '')
{
	$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
	$result  = mysqli_query($con1, $sql) or die('Error, query failed. ' . mysqli_error($con1));
	$row     = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$numrows = $row['numrows'];

	// how many pages we have when using paging?
	$maxPage = ceil($numrows / $rowsPerPage);

	$self = $_SERVER['PHP_SELF'];

	// creating 'previous' and 'next' link
	// plus 'first page' and 'last page' link

	// print 'previous' link only if we're not
	// on page one
	if ($pageNum > 1) {
		$page = $pageNum - 1;
		$prev = " <a href=\"$self?page=$page{$queryString}\">[Prev]</a> ";

		$first = " <a href=\"$self?page=1{$queryString}\">[First Page]</a> ";
	} else {
		$prev  = ' [Prev] ';       // we're on page one, don't enable 'previous' link
		$first = ' [First Page] '; // nor 'first page' link
	}

	// print 'next' link only if we're not
	// on the last page
	if ($pageNum < $maxPage) {
		$page = $pageNum + 1;
		$next = " <a href=\"$self?page=$page{$queryString}\">[Next]</a> ";

		$last = " <a href=\"$self?page=$maxPage{$queryString}{$queryString}\">[Last Page]</a> ";
	} else {
		$next = ' [Next] ';      // we're on the last page, don't enable 'next' link
		$last = ' [Last Page] '; // nor 'last page' link
	}

	// return the page navigation link
	return $first . $prev . " Showing page <strong>$pageNum</strong> of <strong>$maxPage</strong> pages " . $next . $last;
}
//human readable File size function
function getfilesize($size)
{
	$units = array(' B', ' KB', ' MB', ' GB', ' TB');
	for ($i = 0; $size > 1024; $i++) {
		$size /= 1024;
	}
	return round($size, 2) . $units[$i];
}

//function to create unique file names based on UNIX time() for uploading
function uniq($value)
{
	$tme1 = time('hms');
	$tme = date('Ymd');
	$newname = $tme . $tme1 . '_' . $value;
	return $newname;
}
class credential
{ //function to display school creds
	function creds()
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
		$sql = "Select * FROM school_credentials";
		$result     = mysqli_query($con1, $sql) or die(mysqli_error($con1));
		$creds = mysqli_fetch_assoc($result);
		extract($creds);
		return array('key1' => $name, 'key2' => $address, 'key3' => $motto, 'key4' => $logo, 'key5' => $intials, 'key6' => $MPESA_no, 'key7' => $Bank_account,);
	}
}
//function to display appropriate day time
function getDayTime()
{
	date_default_timezone_set('Africa/Nairobi');
	$now = date('H');
	if ($now >= 00 && $now < 12) {
		$dayTime = 'Good Morning';
	} elseif ($now >= 12 && $now < 14) {
		$dayTime = 'Good Afternoon';
	} elseif ($now >= 14 && $now < 20) {
		$dayTime = 'Good Evening';
	} else {
		$dayTime = 'Good Night';
	}
	return $dayTime;
}
//get the active term
function getActiveTerm()
{
	$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
	$sql_period = "SELECT * from term_period where active='1'";
	$result_period = mysqli_fetch_assoc(mysqli_query($con1, $sql_period)) or die(mysqli_error($con1));
	extract($result_period);
	return array('key1' => $year_name, 'key2' => $term_name, 'key3' => $term_id);
}
//check if user is logged in
function isLoggedIn()
{
	if (!isset($_SESSION['LoggedIn']) || $_SESSION['LoggedIn'] != 'True') {
		echo "<script language=javascript>alert('Login First!'); window.location = '/sms/modules/security/login.php'; </script>";
	}
}
//select appropriate grades table
function gradeTable($subject_id)
{
	$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
	$query = "SELECT special_grades.department_id FROM special_grades, departments, subject
  WHERE subject.department_id = departments.department_id AND special_grades.department_id = departments.department_id AND subject_id =  '$subject_id'";
	$result = mysqli_query($con1, $query);
	if (mysqli_num_rows($result) > 0) {
		$gradeTable = 'special_grades';
	} else {
		$gradeTable = 'grades';
	}
	return $gradeTable;
}
function genStudAdminNo()
{
	$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
	$query = "SELECT adminNo FROM student_details  ORDER BY stud_id DESC LIMIT 1";
	$result = mysqli_query($con1, $query) or die('error');
	$row = mysqli_fetch_array($result);
	if (mysqli_num_rows($result) > 0) {
		$adminNo = $row[0];
		//increament last adminNo for the current student
		$adminNo = $adminNo + 1;
	}
	$adminNo = intval($adminNo);
	//add leading zeros to the adminNo
	$adminNo = str_pad((int) $adminNo, 4, "0", STR_PAD_LEFT);
	return $adminNo;
}

//get no of grades
class subjectAnalysis
{

	function countGrade($subject_id, $grade, $term_id, $class_id, $gradeTable)
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
		$query = "SELECT grade as gradeE,subject_name,count(grade) as grade_count
FROM student_marks Inner Join
student_details On student_details.stud_id = student_marks.stud_id,$gradeTable,SUBJECT
WHERE (cat_1+cat_2+mid_term+end_term)/4<=max_mark AND (cat_1+cat_2+mid_term+end_term)/4>=min_mark
AND subject.subject_id=student_marks.subject_id  AND 
term_id='$term_id' and subject.subject_id='$subject_id' and grade= '$grade'
And student_details.class_id = '$class_id'
 group by grade,student_marks.subject_id";
		//echo $query;
		$result = mysqli_query($con1, $query);
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			extract($row);
		} else {
			$grade_count = 0;
		}
		return $grade_count;
	}
	//get total points
	function totalPoints($term_id, $subject_id, $class_id, $gradeTable)
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
		$query = "SELECT sum(points) as total_points,subject_name 
FROM student_marks Inner Join
student_details On student_details.stud_id = student_marks.stud_id,$gradeTable,SUBJECT WHERE (cat_1+cat_2+mid_term+end_term)/4<=max_mark AND 
(cat_1+cat_2+mid_term+end_term)/4>=min_mark AND subject.subject_id=student_marks.subject_id 
AND term_id='$term_id' and subject.subject_id='$subject_id'
And student_details.class_id = '$class_id'
 group by subject.subject_id";
		$result = mysqli_query($con1, $query);
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			extract($row);
		} else {
			$total_points = 0;
		}
		return $total_points;
	}
	//get total number of students
	function totalStudents($class_id)
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
		$query = "SELECT count(student_details.stud_id) as total_students 
FROM student_details
WHERE student_details.class_id='$class_id'";
		$result = mysqli_query($con1, $query);
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			extract($row);
		} else {
			$total_students = 0;
		}
		return $total_students;
	}
	function getMeanGrade($mean_points, $gradeTable)
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
		$query = "SELECT grade as mean_grade FROM $gradeTable WHERE '$mean_points'<=points_max AND '$mean_points'>=points_min";
		//echo $query;
		$result = mysqli_query($con1, $query);
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			extract($row);
			return $mean_grade;
		}
	}
	function getGrade($mean_score, $gradeTable)
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
		$query = "SELECT grade FROM $gradeTable WHERE '$mean_score'<=max_mark AND '$mean_score'>=min_mark";
		$result = mysqli_query($con1, $query);
		$row = mysqli_fetch_assoc($result);
		extract($row);

		return $grade;
	}
	function getMeanScore($subject_id, $term_id)
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
		$query = "SELECT (sum((cat_1+cat_2+mid_term+end_term)/4 ))/count(stud_id) AS mean_score
FROM student_marks,SUBJECT
WHERE term_id='$term_id' and subject.subject_id=student_marks.subject_id and subject.subject_id='$subject_id'group by student_marks.subject_id";
		$result = mysqli_query($con1, $query);

		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			extract($row);
		} else {
			$mean_score = 0.00;
		}
		return $mean_score;
	}
	function highestScore($subject_id, $term_id, $gradeTable)
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
		$query = "SELECT max((cat_1+cat_2+mid_term+end_term)/4) AS highest_mark
FROM student_marks,$gradeTable,SUBJECT
WHERE subject.subject_id=student_marks.subject_id AND term_id='$term_id' and student_marks.subject_id='$subject_id' group by student_marks.subject_id";
		$result = mysqli_query($con1, $query);
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			extract($row);
		} else {
			$highest_mark = 0.00;
		}
		return $highest_mark;
	}
	function getStudentWithHigestMark($mean_score, $subject_id, $term_id, $gradeTable)
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
		$query = "SELECT DISTINCT(student_marks.stud_id),fname,lname,mname FROM student_marks,$gradeTable,student_details
where student_marks.stud_id=student_details.stud_id and (cat_1+cat_2+mid_term+end_term)/4='$mean_score' 
and subject_id='$subject_id' and term_id='$term_id'";
		$result = mysqli_query($con1, $query);
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			extract($row);
			return $fname . ' ' . $mname . ' ' . $lname;
		} else {
			return 'NO STUDENT';
		}
	}
}
class classAnalysis
{
	function countGrade($term_id, $class_id, $grade)
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');

		$qry = "SELECT count(grade) as grade_count
FROM student_marks Inner Join
student_details On student_details.stud_id = student_marks.stud_id,grades,SUBJECT
WHERE (cat_1+cat_2+mid_term+end_term)/4<=max_mark AND (cat_1+cat_2+mid_term+end_term)/4>=min_mark
AND subject.subject_id=student_marks.subject_id  AND 
term_id='$term_id' and grade= '$grade'
And student_details.class_id = '$class_id'";

		//echo $query;
		$res = mysqli_query($con1, $qry) or die(mysqli_error($con1));
		if (mysqli_num_rows($res) > 0) {
			$row = mysqli_fetch_assoc($res);
			extract($row);
		} else {
			$grade_count = 0;
		}
		return $grade_count;
	}
	function totalPoints($term_id, $class_id)
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
		$query = "SELECT sum(points) AS total_points FROM stud_average, grades WHERE
stud_average.grade=grades.grade AND term_id = '$term_id' AND class_id = '$class_id' AND stud_average.grade=grades.grade";
		$result = mysqli_query($con1, $query);
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			extract($row);
		} else {
			$total_points = 0;
		}
		return $total_points;
	}
	function totalStudents($class_id)
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
		$query = "SELECT count(DISTINCT (student_details.stud_id)) AS total_students
FROM student_details WHERE student_details.class_id = '$class_id'";
		$result = mysqli_query($con1, $query);
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			extract($row);
		} else {
			$total_students = 0;
		}
		return $total_students;
	}
	function getMeanGrade($mean_points)
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
		$query = "SELECT grade as mean_grade FROM grades WHERE '$mean_points'<=points_max AND '$mean_points'>=points_min";
		$result = mysqli_query($con1, $query);
		$row = mysqli_fetch_assoc($result);
		extract($row);
		return $mean_grade;
	}
}

class studentProfile
{
	function getSubjectAverage($stud_id, $subject_id, $term_id, $gradeTable)
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
		$query = "SELECT (cat_1+cat_2+mid_term+end_term)/4 AS average,grade as grade,fname,mname,lname,adminNo,subject_name
		FROM student_marks,student_details,$gradeTable,SUBJECT
		WHERE student_marks.stud_id=student_details.stud_id AND (cat_1+cat_2+mid_term+end_term)/4<=max_mark AND (cat_1+cat_2+mid_term+end_term)/4>=min_mark
		AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='$subject_id' AND term_id='$term_id'";
		$result1 = mysqli_query($con1, $query);
		if (mysqli_num_rows($result1) > 0) {
			$row1 = mysqli_fetch_assoc($result1);
			extract($row1);
		} else {
			$average = 0;
			$grade = '';
		}
		return number_format($average, 0) . $grade;
	}
	function getStudentAverage($term_id, $stud_id)
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
		$sql = "SELECT avg( cat_1 + cat_2 + mid_term + end_term ) /4 AS average FROM student_marks WHERE term_id = '$term_id'
		 AND student_marks.stud_id = '$stud_id'";
		$result1 = mysqli_query($con1, $sql);
		if (mysqli_num_rows($result1) > 0) {
			$row1 = mysqli_fetch_assoc($result1);
			extract($row1);
		} else {
			$average = 00.00;
		}
		return number_format($average, 2);
	}
	function studentPosition($term_id, $stud_id)
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
		$sq = "SELECT SUM((cat_1+cat_2+mid_term+end_term)/4)AS total,student_marks.stud_id AS stud_a
		FROM student_marks,student_details
		WHERE student_marks.stud_id=student_details.stud_id AND term_id='$term_id'
		GROUP BY student_marks.stud_id ORDER BY total DESC ";
		$resu    = mysqli_query($con1, $sq) or die(mysqli_error($con1));
		//get total number of students in that class 
		$class = "SELECT class_id from student_details where stud_id='$stud_id'";
		$result_class = mysqli_fetch_assoc(mysqli_query($con1, $class));
		extract($result_class);
		$total_student = "SELECT COUNT( stud_id ) AS students FROM student_details where class_id='$class_id'";
		$re_total = mysqli_query($con1, $total_student);
		$ro_total = mysqli_fetch_assoc($re_total);
		extract($ro_total);

		if (mysqli_num_rows($resu) > 0) {
			$j = 0;
			while ($ro = mysqli_fetch_assoc($resu)) {
				extract($ro);

				if ($stud_a == $stud_id) {
					$j = $j + 1;
					$position = $j . '/' . $students;
				}
				$j += 1;
			}
		} else {
			$position = '--';
		}
		return $position;
	}
	function studMeanPoints($stud_id, $term_id)
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
		$sql = "SELECT DISTINCT (subject_name),subject.subject_id FROM subject,student_marks where student_marks.subject_id=subject.subject_id";
		$result1     = mysqli_query($con1, $sql) or die(mysqli_error($con1));
		if (mysqli_num_rows($result1) > 0) {
			$i = 0;
			$student_points = 0;
			while ($row1 = mysqli_fetch_assoc($result1)) {
				extract($row1);
				if ($i % 2) {
					$class = 'row1';
				} else {
					$class = 'row2';
				}
				$i += 1;
				$gradeTable = gradeTable($subject_id);
				$query = "SELECT points AS total_points FROM student_marks, $gradeTable WHERE (cat_1 + cat_2 + mid_term + end_term) / 4 <= max_mark
		  AND (cat_1 + cat_2 + mid_term + end_term) / 4 >= min_mark AND term_id = '$term_id' AND stud_id='$stud_id' AND subject_id='$subject_id'";
				$result = mysqli_query($con1, $query);
				$row = mysqli_fetch_assoc($result);
				if (mysqli_num_rows($result) > 0) {
					extract($row);
				} else {
					$total_points = 0;
				}
				$student_points = $student_points + $total_points;
			}
		}
		//total subjects
		$query = "SELECT COUNT(DISTINCT subject_id) AS total_sub FROM student_marks where term_id='$term_id' and stud_id='$stud_id'";
		$rw = mysqli_query($con1, $query);
		$re = mysqli_fetch_assoc($rw);
		extract($re);
		//get average
		$average = $student_points / $total_sub;
		$average = number_format($average, 2);
		//get grade
		$query = "SELECT grade as mean_grade FROM grades WHERE '$average'<=points_max AND '$average'>=points_min";
		$result = mysqli_query($con1, $query);
		//echo $query;
		$row = mysqli_fetch_assoc($result);
		if (mysqli_num_rows($result) > 0) {
			extract($row);
		} else {
		}

		$meanGrade = $average . ' ' . $mean_grade;
		return array('key1' => $student_points, 'key2' => $meanGrade);
	}
} //----------------------end class studentprofile ------------------------------------------------


//----------------------class examTypeMarks ------------------------------------------------
class examTypeMarks
{
	function cat1Marks($term_id, $stud_id, $subject_id)
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
		$query = "SELECT cat_1 from student_marks where term_id='$term_id' and stud_id='$stud_id' and subject_id='$subject_id'";
		//echo $query;
		$result = mysqli_query($con1, $query);
		if (mysqli_num_rows($result) > 0) {
			$row1 = mysqli_fetch_assoc($result);
			extract($row1);
		} else {
			$cat_1 = '--';
		}
		return $cat_1;
	}
	function cat2Marks($term_id, $stud_id, $subject_id)
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
		$query = "SELECT cat_2 from student_marks where term_id='$term_id' and stud_id='$stud_id' and subject_id='$subject_id'";
		$result = mysqli_query($con1, $query);
		if (mysqli_num_rows($result) > 0) {
			$row1 = mysqli_fetch_assoc($result);
			extract($row1);
		} else {
			$cat_2 = '--';
		}
		return $cat_2;
	}
	function midtermMarks($term_id, $stud_id, $subject_id)
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
		$query = "SELECT mid_term from student_marks where term_id='$term_id' and stud_id='$stud_id' and subject_id='$subject_id'";
		$result = mysqli_query($con1, $query);
		if (mysqli_num_rows($result) > 0) {
			$row1 = mysqli_fetch_assoc($result);
			extract($row1);
		} else {
			$mid_term = '--';
		}
		return $mid_term;
	}
	function endtermMarks($term_id, $stud_id, $subject_id)
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
		$query = "SELECT end_term from student_marks where term_id='$term_id' and stud_id='$stud_id' and subject_id='$subject_id'";
		$result = mysqli_query($con1, $query);
		if (mysqli_num_rows($result) > 0) {
			$row1 = mysqli_fetch_assoc($result);
			extract($row1);
		} else {
			$end_term = '--';
		}
		return $end_term;
	}
	function averageGrade($term_id, $stud_id, $subject_id)
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
		$gradeTable = gradeTable($subject_id);
		$query = "SELECT (cat_1+cat_2+mid_term+end_term)/4 AS averageE,grade AS gradeE
		FROM student_marks,$gradeTable,subject
		WHERE (cat_1+cat_2+mid_term+end_term)/4<=max_mark AND (cat_1+cat_2+mid_term+end_term)/4>=min_mark
		AND subject.subject_id=student_marks.subject_id AND subject.subject_id='$subject_id' AND term_id='$term_id' and student_marks.stud_id='$stud_id'";
		$result = mysqli_query($con1, $query) or die(mysqli_error($con1));
		if (mysqli_num_rows($result) > 0) {
			$row1 = mysqli_fetch_assoc($result);
			extract($row1);
		} else {
			$averageE = '0.00';
			$gradeE = '--';
		}
		return array('key1' => $averageE, 'key2' => $gradeE);
	}
	function totals($term_id, $stud_id, $exam)
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
		$query = "SELECT sum($exam) as totalexam from student_marks where term_id='$term_id' and stud_id='$stud_id'";
		$result = mysqli_query($con1, $query);
		if (mysqli_num_rows($result) > 0) {
			$row1 = mysqli_fetch_assoc($result);
			extract($row1);
		} else {
			$totalexam = '--';
		}
		return $totalexam;
	}

	function classPosition($term_id, $stud_id, $subject_id)
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
		$class_query = "SELECT class_id from student_details WHERE stud_id='$stud_id'";
		$class_results = mysqli_query($con1, $class_query) or die(mysqli_error($con1));
		$row_class = mysqli_fetch_assoc($class_results);
		extract($row_class);
		$sq = "SELECT (cat_1+cat_2+mid_term+end_term)/4 AS average, student_marks.stud_id AS stud_a,gradebk_id
		FROM student_marks,student_details,special_grades,SUBJECT
		WHERE student_marks.stud_id=student_details.stud_id AND (cat_1+cat_2+mid_term+end_term)/4<=max_mark AND (cat_1+cat_2+mid_term+end_term)/4>=min_mark
		AND subject.subject_id=student_marks.subject_id AND  subject.subject_id='$subject_id' AND term_id='$term_id' AND student_details.class_id='$class_id' ORDER BY (cat_1+cat_2+mid_term+end_term)/4 DESC   ";

		$resu    = mysqli_query($con1, $sq) or die(mysqli_error($con1));
		//get total number of students in that class 
		//$gradebk_id=$rw[2];
		$total_student = "SELECT COUNT( stud_id ) AS students FROM student_details where class_id='$class_id'";
		$re_total = mysqli_query($con1, $total_student) or die(mysqli_error($con1));
		$ro_total = mysqli_fetch_assoc($re_total);
		//echo $total_student;
		extract($ro_total);

		if (mysqli_num_rows($resu) > 0) {
			$j = 0;
			while ($ro = mysqli_fetch_assoc($resu)) {
				extract($ro);

				if ($stud_a == $stud_id) {
					$j = $j + 1;
					$position = $j . '/' . $students;
				}

				$j += 1;
			}
		} else {
			$position = '--';
		}
		return $position;
	}


	function Position($term_id, $stud_id, $subject_id, $exam)
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
		$class_query = "SELECT class_id from student_details WHERE stud_id='$stud_id'";
		$class_results = mysqli_query($con1, $class_query) or die(mysqli_error($con1));
		$row_class = mysqli_fetch_assoc($class_results);
		extract($row_class);
		$sq = "SELECT sum($exam) as total, student_marks.stud_id AS stud_a
		FROM student_marks,student_details,SUBJECT
		WHERE student_marks.stud_id=student_details.stud_id 
		AND subject.subject_id=student_marks.subject_id  AND term_id='$term_id' AND student_details.class_id='$class_id'
		GROUP BY stud_a
		ORDER BY total DESC ";
		$resu    = mysqli_query($con1, $sq) or die(mysqli_error($con1));
		//get total number of students in that class 
		//$gradebk_id=$rw[2];
		$total_student = "SELECT COUNT( stud_id ) AS students FROM student_details where class_id='$class_id'";
		$re_total = mysqli_query($con1, $total_student) or die(mysqli_error($con1));
		$ro_total = mysqli_fetch_assoc($re_total);
		//echo $total_student;
		extract($ro_total);

		if (mysqli_num_rows($resu) > 0) {
			$j = 0;
			while ($ro = mysqli_fetch_assoc($resu)) {
				$j += 1;
				extract($ro);
				if ($stud_a == $stud_id) {
					$position = $j . '/' . $students;
				}
			}
		} else {
			$position = '--';
		}
		return $position;
	}

	function PositionStream($term_id, $stud_id, $exam, $class_for)
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
		$sq = "SELECT sum($exam)AS total, student_marks.stud_id AS stud_a,gradebk_id
		FROM student_marks,student_details,SUBJECT
		WHERE student_marks.stud_id=student_details.stud_id 
		AND subject.subject_id=student_marks.subject_id  AND term_id='$term_id' AND student_details.class_id IN (select class_id from class where class_for='$class_for')
		GROUP BY stud_a
		ORDER BY total DESC ";

		$resu    = mysqli_query($con1, $sq) or die(mysqli_error($con1));
		//get total number of students in that class 
		//$gradebk_id=$rw[2];
		$total_student = "SELECT COUNT( stud_id ) AS students FROM student_details left join class on student_details.class_id=class.class_id where class_for='$class_for'";

		$re_total = mysqli_query($con1, $total_student) or die(mysqli_error($con1));
		$ro_total = mysqli_fetch_assoc($re_total);
		//echo $total_student;
		extract($ro_total);

		if (mysqli_num_rows($resu) > 0) {
			$j = 0;
			while ($ro = mysqli_fetch_assoc($resu)) {
				extract($ro);

				if ($stud_a == $stud_id) {
					$j = $j + 1;
					$position = $j . '/' . $students;
				}

				$j += 1;
			}
		} else {
			$position = '--';
		}
		return $position;
	}

	function PositionClass($term_id, $stud_id, $exam, $class_name)
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
		$sq = "SELECT sum($exam)AS total, student_marks.stud_id AS stud_a,gradebk_id
		FROM student_marks,student_details,SUBJECT
		WHERE student_marks.stud_id=student_details.stud_id 
		AND subject.subject_id=student_marks.subject_id  AND term_id='$term_id' AND student_details.class_id IN (select class_id from class where class_name='$class_name')
		GROUP BY stud_a
		ORDER BY total DESC ";

		$resu    = mysqli_query($con1, $sq) or die(mysqli_error($con1));
		//get total number of students in that class 
		//$gradebk_id=$rw[2];
		$total_student = "SELECT COUNT( stud_id ) AS students FROM student_details inner join class on student_details.class_id=class.class_id where class_name='$class_name'";

		$re_total = mysqli_query($con1, $total_student) or die(mysqli_error($con1));
		$ro_total = mysqli_fetch_assoc($re_total);
		//echo $total_student;
		extract($ro_total);

		if (mysqli_num_rows($resu) > 0) {
			$j = 0;
			while ($ro = mysqli_fetch_assoc($resu)) {
				extract($ro);

				if ($stud_a == $stud_id) {
					$j = $j + 1;
					$position = $j . '/' . $students;
				}

				$j += 1;
			}
		} else {
			$position = '--';
		}
		return $position;
	}



	function teacherComments($term_id, $stud_id, $subject_id)
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
		$sql = "SELECT teacher_comments FROM student_marks,student_details WHERE student_marks.stud_id=student_details.stud_id 
		AND term_id='$term_id' and student_marks.stud_id='$stud_id' and subject_id='$subject_id' ORDER BY student_marks.stud_id DESC";
		$result = mysqli_query($con1, $sql);
		if (mysqli_num_rows($result) > 0) {
			$ro_total = mysqli_fetch_assoc($result);
			extract($ro_total);
			return $teacher_comments;
		} else {
			return '--';
		}
	}
}

function sendSMS($number, $message) //sends specified SMS message to the specified recipient
{
	$Namba = urlencode($number);
	$Message = urlencode($message);
	file("http://localhost:7070/send/sms/" . $Namba . "/" . $Message . "/");
}

class getUpperClassMarks
{
	function getGroup2subjects($stud_id)
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
		$sql = "SELECT  `biology` ,  `chemistry` ,  `physics` FROM  `student_subjects` where student_id='$stud_id'";
		$result = mysqli_query($con1, $sql);
		if (mysqli_num_rows($result) > 0) {
			$row_subject = mysqli_fetch_assoc($result);
			extract($row_subject);

			if ($biology == 0 || $chemistry == 0 || $physics == 0) {
			} //student doing two sciences
			//select all 

			else {
			} //student doing all sciences
			//select top 2 sciences
		}
	}

	function studentPosition($term_id, $stud_id)
	{
		$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
		$sq = "SELECT SUM((cat_1+cat_2 +mid_term+end_term)/4))AS total,student_marks.stud_id AS stud_a
	FROM student_marks,student_details
	WHERE student_marks.stud_id=student_details.stud_id AND term_id='$term_id'
	GROUP BY student_marks.stud_id ORDER BY total DESC ";
		$resu    = mysqli_query($con1, $sq) or die(mysqli_error($con1));
		//get total number of students in that class 
		$class = "SELECT class_id from student_details where stud_id='$stud_id'";
		$result_class = mysqli_fetch_assoc(mysqli_query($con1, $class));
		extract($result_class);
		$total_student = "SELECT COUNT( stud_id ) AS students FROM student_details where class_id='$class_id'";
		$re_total = mysqli_query($con1, $total_student);
		$ro_total = mysqli_fetch_assoc($re_total);
		extract($ro_total);

		if (mysqli_num_rows($resu) > 0) {
			$j = 0;
			while ($ro = mysqli_fetch_assoc($resu)) {
				extract($ro);

				if ($stud_a == $stud_id) {
					$j = $j + 1;
					$position = $j . '/' . $students;
				}
				$j += 1;
			}
		} else {
			$position = '--';
		}
		return $position;
	}
}

function CompSubjstudMeanPoints($stud_id, $term_id)
{
	$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
	//select complusary subjects
	$sql = "SELECT DISTINCT (subject_name), subject.subject_id FROM subject, student_marks WHERE student_marks.subject_id = subject.subject_id
AND subject.subject_id IN 
(SELECT subject.subject_id FROM subject WHERE subject_name = 'English' OR subject_name = 'Kiswahili'OR subject_name = 'Mathematics')";
	$result1     = mysqli_query($con1, $sql) or die(mysqli_error($con1));
	if (mysqli_num_rows($result1) > 0) {
		$i = 0;
		$student_points = 0;
		while ($row1 = mysqli_fetch_assoc($result1)) {
			extract($row1);
			if ($i % 2) {
				$class = 'row1';
			} else {
				$class = 'row2';
			}
			$i += 1;
			$gradeTable = gradeTable($subject_id);
			$query = "SELECT points AS total_points FROM student_marks, $gradeTable WHERE (cat_1 + cat_2 + mid_term + end_term) / 4 <= max_mark
  AND (cat_1 + cat_2 + mid_term + end_term) / 4 >= min_mark AND term_id = '$term_id' AND stud_id='$stud_id' AND subject_id='$subject_id'";
			$result = mysqli_query($con1, $query);
			$row = mysqli_fetch_assoc($result);
			extract($row);
			$student_pointscomp = $student_points + $total_points;
		}
	}
}
function getGroup2subjects($stud_id)
{
	$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
	$sql = "SELECT  `biology` ,  `chemistry` ,  `physics` FROM  `student_subjects` where student_id='$stud_id'";
	$result = mysqli_query($con1, $sql);
	if (mysqli_num_rows($result) > 0) {
		$row_subject = mysqli_fetch_assoc($result);
		extract($row_subject);

		if ($biology == 0 || $chemistry == 0 || $physics == 0) { //student doing two sciences
			$sql = "SELECT DISTINCT (subject_name), subject.subject_id FROM subject, student_marks WHERE student_marks.subject_id = subject.subject_id
			AND subject.subject_id IN 
			(SELECT subject.subject_id FROM subject WHERE subject_name = 'Biology' OR subject_name = 'Chemistry'OR subject_name = 'Physics') and stud_id='1'";
		} else { //student doing all sciences
			//select top 2 sciences
			$sql = "SELECT DISTINCT (subject_name), subject.subject_id FROM subject, student_marks WHERE student_marks.subject_id = subject.subject_id
			AND subject.subject_id IN 
			(SELECT subject.subject_id FROM subject WHERE subject_name = 'Biology' OR subject_name = 'Chemistry'OR subject_name = 'Physics') and
			 stud_id='2' order by ((cat_1+cat_2+mid_term+end_term)/4) DESC LIMIT 2";
		}
		$result1     = mysqli_query($con1, $sql) or die(mysqli_error($con1));
		if (mysqli_num_rows($result1) > 0) {
			$i = 0;
			$student_points = 0;
			while ($row1 = mysqli_fetch_assoc($result1)) {
				extract($row1);
				if ($i % 2) {
					$class = 'row1';
				} else {
					$class = 'row2';
				}
				$i += 1;
				$gradeTable = gradeTable($subject_id);
				$query = "SELECT points AS total_points FROM student_marks, $gradeTable WHERE (cat_1 + cat_2 + mid_term + end_term) / 4 <= max_mark
				  AND (cat_1 + cat_2 + mid_term + end_term) / 4
				   >= min_mark AND term_id = '$term_id' AND stud_id='$stud_id' AND subject_id='$subject_id'";
				$result = mysqli_query($con1, $query);
				$row = mysqli_fetch_assoc($result);
				extract($row);
				$student_pointsSCI = $student_points + $total_points;
			}
		}
	}
}

function cleanup()
{
	$con1 = mysqli_connect("127.0.0.1:3306", 'root', '', 'sms');
	$sql = "DELETE FROM student_marks WHERE gradebk_id NOT IN (SELECT gradebk_id FROM gradebk)";
	$query = mysqli_query($con1, $sql) or die(mysqli_error($con1));
}
