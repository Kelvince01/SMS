<?php
session_start();
ob_start();
require_once('connection/connect.php');
include_once ('common/functions.php');
include_once ('common/common.php');
isLoggedIn();
//set no of records per page

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	case 'home' :
		$content= 'home.php';

		break;

	case 'academics' :
		$content='modules/academics/academics.php';
		break;

	case 'admissions' :
		$content='modules/admissions/students/student.php';
      break;
	
	case 'add_student' :
		$content='modules/process/add_student.php';
		break;
	case 'add_teacher' :
		$content='modules/academics/add_teacher.php';
		break;		
	case 'delete_teacher' :
		$content='modules/process/delete_teacher.php';
		break;
	case 'edit_teacher' :
		$content='modules/process/edit_teacher.php';
		break;
	case 'teacher' :
		$content='modules/academics/teacher.php';
		break;
	case 'library' :
		$content='modules/library/index.php';
		break;
	case 'course_books' :
		$content= 'modules/library/course_books/course_books.php';
		
		break;
	case 'edit_student' :
		$content= 'modules/admissions/edit_student.php';
		
		break;	
	case 'delete_student' :
		$content= 'modules/admissions/students/delete_student.php';
		
		break;	
	case 'edit_classes' :
		$content= 'modules/academics/edit_classes.php';
		
		break;	
	case 'editperiod' :
		$content= 'modules/settings/editperiod.php';
		
		break;	
		
	case 'process_editClass' :
		$content= 'modules/academics/process_editClass.php';
		
		break;
	case 'edit_Classubject' :
		$content= 'modules/academics/edit_Classubject.php';
		
		break;	
	case 'delete_Classubject' :
		$content= 'modules/process/delete_ClassSubject.php';
		break;	
	
    case 'delete_class' :
		$content= 'modules/process/delete_class.php';
		
		break;	
	case 'edit_subject' :
		$content= 'modules/academics/edit_subject.php';
		
		break;	
	case 'delete_subject' :
		$content= 'modules/process/delete_subject.php';
		
		break;	
    case 'process_editSubject' :
		$content= 'modules/academics/process_editSubject.php';
		
		break;			

	case 'add_user' :
		$content= 'modules/accounts/user_account.php';
	
		break;	
		
	case 'fees' :
		$content= 'modules/accounts/fees/fees.php';
	
		break;
	case 'edit_fee' :
		$content= 'modules/accounts/fees/edit_fee.php';
	
		break;	
	case 'newfee' :
		$content= 'modules/accounts/fees/newfee.php';
	
		break;
	case 'edit_newfee' :
		$content= 'modules/accounts/fees/edit_newfee.php';
	
		break;
	case 'delete_newfee' :
		$content= 'modules/accounts/fees/delete_newfee.php';
	
		break;		
	case 'income' :
		$content= 'modules/accounts/income.php';
	
	break;	
	
	case 'special_grade' :
		$content= 'modules/academics/special_grade.php';
		break;

	case 'edit_exam' :
		$content= 'modules/academics/edit_exam.php';
		break;

	case 'process_editExam' :
		$content= 'modules/process/process_editExam.php';
		break;

	case 'settings' :
		$content='modules/settings/index.php';
		break;	
	case 'deleteperiod' :
		$content='modules/settings/deleteperiod.php';
		break;	
		
	case 'add_class' :
		$content= 'modules/academics/new_class.php';
		break;
	case 'move_class' :
		$content= 'modules/academics/move_class.php';
		break;	

	case 'add_subject' :
		$content= 'modules/academics/new_subject.php';
		break;	
	case 'add_subject_allocation' :
		$content= 'modules/academics/new_subject_allocation.php';
		break;	
	case 'process_editClass_subject' :
		$content= 'modules/process/process_editClass_subject.php';
		break;	
	case 'add_exam' :
		$content= 'modules/academics/new_exam.php';
		break;	
	case 'add_grade' :
		$content= '/modules/academics/new_grade.php';
	break;	
	case 'add_gradebk' :
		$content= 'modules/academics/add_gradebk.php';
		break;	
	case 'add_marks' :
		$content= 'modules/academics/add_marks.php';
		break;	
	case 'add_marks_process' :
		$content= 'modules/process/add_marks_process.php';
		break;
	case 'newperiod' :
		$content= 'modules/academics/newperiod.php';
		break;	
	case 'markperiod' :
		$content= 'modules/academics/markperiod.php';
		break;	
	case 'mark_sheet' :
		$content= 'modules/academics/mark_sheet.php';
		break;	
	case 'print_markSheet' :
		$content= 'modules/academics/print_markSheet.php';
		break;	
	case 'pre_reportCard' :
		$content= 'modules/academics/pre_reportCard.php';
		break;
	case 'pre_subanalysis' :
		$content= 'modules/academics/pre_subanalysis.php';
		break;	
	case 'pre_classanalysis' :
		$content= 'modules/academics/pre_classanalysis.php';
		break;		
	case 'subject_analysis' :
		$content= 'modules/academics/subject_analysis.php';
		break;
	case 'class_analysis' :
		$content= 'modules/academics/class_analysis.php';
		break;	
	case 'pre_academicProgress' :
		$content= 'modules/academics/pre_academicProgressReport.php';
		break;	
		
	case 'highest_mark' :
		$content= 'modules/academics/highest_marks.php';
		break;
	case 'prehighest_marks' :
		$content= 'modules/academics/pre_highestMark.php';
		break;	

    case 'process_addsubject' :
		$content= 'modules/process/process_addsubject.php';
		break;		
	case 'process_addClass_subject' :
		$content= 'modules/process/process_addClass_subject.php';
		break;	
	case 'process_addExam' :
		$content= 'modules/process/process_addExam.php';
	case 'fee_process' :
		$content= 'modules/process/fee_process.php';
		break;	
	case 'process_addGrade' :
		$content= 'modules/process/process_addGrade.php';
		break;		
	case 'process_addgradeBk' :
		$content= 'modules/process/add_gradebk_process.php';
		break;	
	case 'edit_gradebk' :
		$content= 'modules/academics/edit_gradebk.php';
		break;		
	case 'edit_gradebk_process' :
		$content= 'modules/process/edit_gradebk_process.php';
		break;	
	case 'delete_gradebk' :
		$content= 'modules/process/delete_gradebk.php';
		break;	
    case 'process_mpesa' :
		$content= 'modules/accounts/fees/process_message.php';
		break;
		
	case 'add_transaction' :
		$content= 'modules/process/add_trans.php';
		break;	
	case 'addbook' :
		$content= 'modules/process/addbook.php';
		break;	
	case 'select_book' :
		$content= 'modules/library/course_books/select_book.php';
		break;	
	case 'issue_process' :
		$content= 'modules/process/issue_process.php';
		break;
	case 'teacher_issue' :
		$content= 'modules/process/teacher_issue.php';
		break;	
	case 'clear_book' :
		$content= 'modules/process/clear.php';
		break; 
	case 'clear_book2' :
		$content= 'modules/process/clear2.php';
		break; 	
	case 'availableBooks' :
		$content= 'modules/library/course_books/availableBooks.php';
		break;	
	case 'issued_books' :
		$content= 'modules/library/course_books/issuedBooks_list.php';
		break;	
	case 'issued_teacher' :
		$content= 'modules/library/course_books/issuedTeacher_list.php';
		break;
   case 'books_count' :
		$content= 'modules/library/course_books/books_count.php';
		break;	
	case 'allocate_class' :
		$content= 'modules/process/add_class.php';
		break;	
	case 'allocate_subject' :
		$content= 'modules/process/add_subject.php';
		break;
	case 'allocate_hostel' :
		$content= 'modules/process/add_hostel.php';
		break;	
	case 'allocate_duty' :
		$content= 'modules/process/add_duty.php';
		break;	
	case 'process_add_moreinfo' :
		$content= 'modules/process/add_moreinfo.php';
		break;	
	default :
		$content 	= 'home.php';
		
}

include_once('index_.php');


//include 'header.php';
?>
