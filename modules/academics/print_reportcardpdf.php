<?php
include '../../connection/connect.php';
$stud_id = '1';
$term_id = '1';
//generate reportcardNo no
$possible = '123456789BCDEFGHJKMNPQRSTVWXYZ';
$code = '';
$i = 0;

while ($i < 5) {
	$code .= substr($possible, mt_rand(0, strlen($possible) - 1), 1);
	$i++;
}
$stud_id = '2';
$sql = "SELECT SUM(((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/22))AS total,student_marks.stud_id,adminNo,fname,mname,lname
				FROM student_marks,student_details
				WHERE student_marks.stud_id=student_details.stud_id and student_details.stud_id='$stud_id'
				GROUP BY student_marks.stud_id ORDER BY total DESC ";
$result     = mysqli_query($con1, $sql) or die(mysqli_error($con1));
$row = mysqli_fetch_assoc($result);
extract($row);
$html = "";
$html .= '<p>&nbsp;</p>';
$html .= '<table width="100%" border="0" align="center" cellpadding="2">
        <tr><td id="coop_title" align="center"><b>' . nl2br(stripslashes($_SESSION['schoolname'])) . '</b></td></tr>
        <tr><td id="coop_title" align="center"><b>' . nl2br(stripslashes('P.O Box 60401 CHOGORIA-MAARA DISTRICT')) . '</b></td></tr>
<tr><td align="center" id="content"><b>Report Card</td></tr>
<tr></tr>
<tr><td align="center" id="content"><b>Report Card No:</b><em><strong>' .  $code . '</strong></em></td></tr>
<tr><td align="center" id="content"><b>Date/Time:</b>' .   date('d/m/Y h:i:s a') . '</td></tr>
<tr></tr>

<br>';

$stud_id = '1';
$sql = "SELECT SUM(((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/22))AS total,student_marks.stud_id,adminNo,fname,mname,lname
				FROM student_marks,student_details
				WHERE student_marks.stud_id=student_details.stud_id and student_details.stud_id='$stud_id'
				GROUP BY student_marks.stud_id ORDER BY total DESC ";
$result     = mysqli_query($con1, $sql) or die(mysqli_error($con1));
$row = mysqli_fetch_assoc($result);
extract($row);
//english

$query = "SELECT cat_1 as catE,cat_2 AS cat2E,mid_term AS midE,end_term AS endE,((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averageE,grade as gradeE,fname,mname,lname,adminNo,subject_name
FROM student_marks,student_details,grades,SUBJECT
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='1' AND term_id='$term_id'";
$result1 = mysqli_query($con1, $query);
$row1 = mysqli_fetch_assoc($result1);
extract($row1);
//kiswahili
$query = "SELECT cat_1 as catS,cat_2 AS cat2S,mid_term AS midS,end_term AS endS,((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averageSW,grade as gradeSW,fname,mname,lname,adminNo,subject_name
FROM student_marks,student_details,grades,SUBJECT
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='2' AND term_id='$term_id'";
$result1 = mysqli_query($con1, $query);
if (mysqli_num_rows($result1) > 0) {
	$row1 = mysqli_fetch_assoc($result1);
	extract($row1);
} else {
	$averageSW = 0;
}
//mathematics
$query = "SELECT ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averageMT,grade as gradeMT,fname,mname,lname,adminNo,subject_name
FROM student_marks,student_details,grades,SUBJECT
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='3' AND term_id='$term_id'";
$result1 = mysqli_query($con1, $query);
if (mysqli_num_rows($result1) > 0) {
	$row1 = mysqli_fetch_assoc($result1);
	extract($row1);
} else {
	$averageMT = 0;
	$gradeMT = 'E';
}
//biology
$query = "SELECT ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averageBIO,grade as gradeBIO,fname,mname,lname,adminNo,subject_name
FROM student_marks,student_details,grades,SUBJECT
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='4' AND term_id='$term_id'";
$result1 = mysqli_query($con1, $query);
if (mysqli_num_rows($result1) > 0) {
	$row1 = mysqli_fetch_assoc($result1);
	extract($row1);
} else {
	$averageBIO = 0;
	$gradeBIO = 'E';
}
//chem
$query = "SELECT ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averageCHE,grade as gradeCHE,fname,mname,lname,adminNo,subject_name
FROM student_marks,student_details,grades,SUBJECT
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='5' AND term_id='$term_id'";
$result1 = mysqli_query($con1, $query);
if (mysqli_num_rows($result1) > 0) {
	$row1 = mysqli_fetch_assoc($result1);
	extract($row1);
} else {
	$averageCHE = 0;
	$gradeCHE = 'E';
}
//phy
$query = "SELECT ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averagePH,grade as gradePH,fname,mname,lname,adminNo,subject_name
FROM student_marks,student_details,grades,SUBJECT
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='6' AND term_id='$term_id'";
$result1 = mysqli_query($con1, $query);
if (mysqli_num_rows($result1) > 0) {
	$row1 = mysqli_fetch_assoc($result1);
	extract($row1);
} else {
	$averagePH = 0;
	$gradePH = 'E';
}
//geo
$query = "SELECT ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averageGE,grade as gradeGE,fname,mname,lname,adminNo,subject_name
FROM student_marks,student_details,grades,SUBJECT
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='7' AND term_id='$term_id'";
$result1 = mysqli_query($con1, $query);
if (mysqli_num_rows($result1) > 0) {
	$row1 = mysqli_fetch_assoc($result1);
	extract($row1);
} else {
	$averageGE = 0;
	$gradeGE = 'E';
}
//hist
$query = "SELECT ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averageHI,grade as gradeHI,fname,mname,lname,adminNo,subject_name
FROM student_marks,student_details,grades,SUBJECT
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='8' AND term_id='$term_id'";
$result1 = mysqli_query($con1, $query);
if (mysqli_num_rows($result1) > 0) {
	$row1 = mysqli_fetch_assoc($result1);
	extract($row1);
} else {
	$averageHI = 0;
	$gradeHI = 'E';
}
//cre
$query = "SELECT ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averageCR,grade as gradeCR,fname,mname,lname,adminNo,subject_name
FROM student_marks,student_details,grades,SUBJECT
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='9' AND term_id='$term_id'";
$result1 = mysqli_query($con1, $query);
if (mysqli_num_rows($result1) > 0) {
	$row1 = mysqli_fetch_assoc($result1);
	extract($row1);
} else {
	$averageCR = 0;
	$gradeCR = 'E';
}
//agri
$query = "SELECT ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averageAG,grade as gradeAG,fname,mname,lname,adminNo,subject_name
FROM student_marks,student_details,grades,SUBJECT
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='10' AND term_id='$term_id'";
$result1 = mysqli_query($con1, $query);
if (mysqli_num_rows($result1) > 0) {
	$row1 = mysqli_fetch_assoc($result1);
	extract($row1);
} else {
	$averageAG = 0;
	$gradeAG = 'E';
}
//b/s
$query = "SELECT ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averageBS,grade as gradeBS,fname,mname,lname,adminNo,subject_name
FROM student_marks,student_details,grades,SUBJECT
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND student_marks.stud_id='$stud_id'AND subject.subject_id='11' AND term_id='$term_id'";
$result1 = mysqli_query($con1, $query);
if (mysqli_num_rows($result1) > 0) {
	$row1 = mysqli_fetch_assoc($result1);
	extract($row1);
} else {
	$averageBS = 0;
	$gradeBS = 'E';
}
//total marks
$total = $averageSW + $averageE + $averageMT + $averageBIO + $averageCHE + $averagePH + $averagePH + $averageGE + $averageHI + $averageCR + $averageAG + $averageBS;
//average
$query = "SELECT COUNT(DISTINCT subject_id) AS total_sub FROM student_marks where stud_id='$stud_id'";
$rw = mysqli_query($con1, $query);
$re = mysqli_fetch_assoc($rw);
extract($re);
$average = $total / $total_sub;
//mean grade
$query = "SELECT grade FROM grades WHERE '$average'<=max_mark AND '$average'>=min_mark";
$rw = mysqli_query($con1, $query);
$re = mysqli_fetch_assoc($rw);
extract($re);
//get subjects
$sql = "SELECT subject_name,subject_id FROM subject ";
$result     = mysqli_query($con1, $sql) or die(mysqli_error($con1));

$html .= '<tr><td align="center"><table width="650" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
<TR class="entryTableHeader"><TD align="center">' .  $fname . ' ' . $mname . ' ' . $lname . '</td>
<td align="center">' .  $adminNo . '</td>
<td align=""> Form 1</td>
<td align="center">Term 1 2011</td>
</tr>
</table>
<tr><td align="center"><table width="650" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
		<tr>
		<th width="20%">Subject</th>
		<th width="5%">CAT 1 </th>
		<th width="5%">CAT 2</th>
		<th width="5%">MID-TERM</th>
		<th width="5%">END_TERM</th>
		<th width="5%">AVRG</th>
		<th width="1%">M.GRADE</th>
		<th width="5%">CLASS PSTN</th>
		<th width="5%">LAST TERM</th>
		<th width="40%">TRS.COMMENTS</th>
		<th width="5%">TRS INTIALS</th>
		
		</tr>';

if (mysqli_num_rows($result) > 0) {
	$i = 0;

	while ($row = mysqli_fetch_assoc($result)) {
		extract($row);
		if ($i % 2) {
			$class = 'row1';
		} else {
			$class = 'row2';
		}
		$i += 1;

		$html .= '<tr>
<td class="content" align="center">' . $subject_name . '</td>';

		$query = "SELECT cat_1,cat_2,mid_term ,end_term,((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averageE,grade AS gradeE,fname,mname,lname,adminNo,subject_name,teacher_comments
FROM student_marks,student_details,grades,subject
WHERE student_marks.stud_id=student_details.stud_id AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)<=max_mark AND ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2)>=min_mark
AND subject.subject_id=student_marks.subject_id AND subject.subject_id='$subject_id' AND term_id='$term_id' and student_marks.stud_id='$stud_id'";
		$re = mysqli_query($con1, $query);
		if (mysqli_num_rows($re) > 0) {
			$rw = mysqli_fetch_assoc($re);
			extract($rw);
		} else {
			$cat_1 = 0;
			$cat_2 = 0;
			$mid_term = 0;
			$end_term = 0;
			$averageE = 0;
			$gradeE = '--';
		}
		//get class position



		$html .= '<td class="content" align="center">' .  $cat_1 . '</td>
<td class="content" align="center">' .  $cat_2 . '</td>
<td class="content" align="center">' .  $mid_term . '</td>
<td class="content" align="center">' .  $end_term . '</td>
<td class="content" align="center">' .  $averageE . '</td>
<td class="content" align="center">' .  $gradeE . '</td>
<td class="content" align="center">';

		$sq = "SELECT ((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/2) AS averageE,stud_id AS stud_a FROM student_marks WHERE
subject_id='$subject_id' AND term_id='$term_id' group by stud_id ORDER BY averageE DESC ";
		$resu    = mysqli_query($con1, $sq) or die(mysqli_error($con1));
		if (mysqli_num_rows($resu) > 0) {
			$j = 0;
			while ($ro = mysqli_fetch_assoc($resu)) {
				extract($ro);

				if ($stud_a == $stud_id) {
					$j = $j + 1;
					echo $j;
				}
				$j += 1;
			}
		} else {
			echo '--';
		}

		$html .= '</td>
<td class="content" align="right"></td>
<td class="content" align="right" width="40%">' . $teacher_comments . '</td>
<td class="content" align="center">';

		$q = "SELECT intials FROM teacher,class_subject_teacher WHERE 
teacher.teacher_id=class_subject_teacher.teacher_id AND class_id='1' AND
subject_id='$subject_id'";
		$resu    = mysqli_query($con1, $q) or die(mysqli_error($con1));
		if (mysqli_num_rows($resu) > 0) {
			$rw = mysqli_fetch_assoc($resu);
			extract($rw);
		} else {
			$intials = ' ';
		}
		echo $intials;

		$html .= '</td>
</tr>';
	}
} else {
	echo 'No Subjects for now.';
}

$html .= '<tr class="content"> 
    <td colspan="4" align="right"><b>Total</b> </td>
<td align="center">' . number_format($total, 2) . '</td>
<td align="center">' . number_format($average, 2) . '</td>
<td align="center">' . $grade . '</td>
<td align="center">';

$sq = "SELECT SUM(((((((cat_1+cat_2)/2)+mid_term)/2)+end_term)/22))AS total,student_marks.stud_id AS stud_a
FROM student_marks,student_details
WHERE student_marks.stud_id=student_details.stud_id AND term_id='$term_id'
GROUP BY student_marks.stud_id ORDER BY total DESC ";
$resu    = mysqli_query($con1, $sq) or die(mysqli_error($con1));
if (mysqli_num_rows($resu) > 0) {
	$j = 0;
	while ($ro = mysqli_fetch_assoc($resu)) {
		extract($ro);

		if ($stud_a == $stud_id) {
			$j = $j + 1;
			echo $j;
		}
		$j += 1;
	}
} else {
	echo '--';
}

$html .= '</td>
</tr> 

</table></td></tr><tr></tr>
<tr align="center"><td><table width="650" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
<tr class="entryTableHeader"> 
<td colspan="4" align="center">Comments</td>
</tr>
<tr>
<th width="20%">Teacher Name</th>
<th>Comment</th>
<th width="15%">Date/Time</th>
<th width="15%">Signature</th>
</tr>
<tr>
<td class="content" align="center">J.Kamau</td>
<td class="content" align="center">This is a good begining, keep it up!</td>
<td class="content" align="center">12-04-2011</td>
<td class="content" align="right">J.K</td>
</tr>
<tr>
<td class="content" align="center">P.Kamau</td>
<td class="content" align="center">This is a good begining, keep it up!</td>
<td class="content" align="center">12-04-2011</td>
<td class="content" align="right">J.K</td>
</tr>
<tr>
<td class="content" align="center"></td>
<td class="content" align="center"></td>
<td class="content" align="center"></td>
<td class="content" align="right">sign here</td>
</tr>
<tr class="content"> 
<td colspan="3" align="right"><b>School Opens on: 12:12:2011</b> </td>
<td align="right"></td></tr> 
<tr class="content"> 
<td colspan="4" align="right"><div id="footer">
&copy;  NYANDARUA HIGH SCHOOL ' . date('Y') . ':powered by mySkulMate

</div></td>

</table></td></tr>		
<tr><td height="10"></td></tr>
<tr><td align="center" id="noprint">
	
	</td></tr>
	</td>
	</tr>
</table>';

create($html);
function create($data)
{
	require_once('tcpdf/config/lang/eng.php');
	require_once('tcpdf/tcpdf.php');

	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Report Card');
	$pdf->SetTitle('Report');
	$pdf->SetSubject('PDF Report');
	$pdf->SetKeywords('Report, PDF');

	// set default header data
	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Report Card', PDF_HEADER_STRING);

	// set header and footer fonts
	$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	//set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	//set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	//set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	//set some language-dependent strings
	$pdf->setLanguageArray($l);

	// ---------------------------------------------------------

	// set font
	$pdf->SetFont('dejavusans', '', 10);

	// add a page
	$pdf->AddPage();

	// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
	// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

	// output the HTML content
	$pdf->writeHTML($data, true, false, true, false, '');
	$pdf->Output('report_card.pdf', 'I');
}
