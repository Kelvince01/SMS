<?php
/*
	Contain the common functions
	required in pos and admin pages
*/
//no of records to show;
$rowsPerPage='100';

/**************************
	Paging Functions
***************************/
function getPagingQuery($sql, $itemPerPage = 10)
{
	if (isset($_GET['page']) && (int)$_GET['page'] > 0) {
		$page = (int)$_GET['page'];
	} else {
		$page = 1;
	}

	// start fetching from this row number
	$offset = ($page - 1) * $itemPerPage;

	return $sql . " LIMIT $offset, $itemPerPage";
}

/*
	Get the links to navigate between one result page to another.
	Supply a value for $strGet if the page url already contain some
	GET values for example if the original page url is like this :

	http://www.phpwebcommerce.com/plaincart/index.php?c=12

	use "c=12" as the value for $strGet. But if the url is like this :

	http://www.phpwebcommerce.com/plaincart/index.php

	then there's no need to set a value for $strGet


*/
function getPagingLink($sql, $itemPerPage = 10, $strGet = '')
{
	$con1=mysqli_connect("127.0.0.1:3306",'root','','sms');
	$result        = mysqli_query($con1,$sql);
	$pagingLink    = '';
	$totalResults  = mysqli_num_rows($result);
	$totalPages    = ceil($totalResults / $itemPerPage);

	// how many link pages to show
	$numLinks      = 10;


	// create the paging links only if we have more than one page of results
	if ($totalPages > 1) {

		$self = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ;


		if (isset($_GET['page']) && (int)$_GET['page'] > 0) {
			$pageNumber = (int)$_GET['page'];
		} else {
			$pageNumber = 1;
		}

		// print 'previous' link only if we're not
		// on page one
		if ($pageNumber > 1) {
			$page = $pageNumber - 1;
			if ($page > 1) {
				$prev = " <a href=\"$self?page=$page&$strGet&view=$view/\">[Prev]</a> ";
			} else {
				$prev = " <a href=\"$self?$strGet\">[Prev]</a> ";
			}

			$first = " <a href=\"$self?$strGet\">[First]</a> ";
		} else {
			$prev  = ''; // we're on page one, don't show 'previous' link
			$first = ''; // nor 'first page' link
		}

		// print 'next' link only if we're not
		// on the last page
		if ($pageNumber < $totalPages) {
			$page = $pageNumber + 1;
			$next = " <a href=\"$self?page=$page&$strGet\">[Next]</a> ";
			$last = " <a href=\"$self?page=$totalPages&$strGet\">[Last]</a> ";
		} else {
			$next = ''; // we're on the last page, don't show 'next' link
			$last = ''; // nor 'last page' link
		}

		$start = $pageNumber - ($pageNumber % $numLinks) + 1;
		$end   = $start + $numLinks - 1;

		$end   = min($totalPages, $end);

		$pagingLink = array();
		for($page = $start; $page <= $end; $page++)	{
			if ($page == $pageNumber) {
				$pagingLink[] = " $page ";   // no need to create a link to current page
			} else {
				if ($page == 1) {
					$pagingLink[] = " <a href=\"$self?$strGet\">$page</a> ";
				} else {
					$pagingLink[] = " <a href=\"$self?page=$page&$strGet\">$page</a> ";
				}
			}

		}

		$pagingLink = implode(' | ', $pagingLink);

		// return the page navigation link
		$pagingLink = $first . $prev . $pagingLink . $next . $last;
	}

	return $pagingLink;
}
/**************************
Common Variables
***************************/
/*-------------------------------------
 FILE UPLOAD 
-------------------------------------*/
//maximum upload size for files
// Maximum general upload file size. Defaults to 1MB
$maxsize = '1048576';

//maximum Project file size. Defaults to 4MB
$maxprojsize = '4194306';

// Maximum size of image that can be uploaded to Image Gallery. Defaults to 200Kb
$maximgsize = '204800';

//file upload locations
/*$destpath = './uploads/minutes/'; // folder path for minutes & meetings
$destnotes = './uploads/notes/';  // folder path for notes
$desttt = './uploads/timetable/';  // folder path for timetables
$destproj = './uploads/projects/';  // folder path for project files and presentations
$destdnld = './uploads/dnld/';  // folder path for general downloads
*/
$student_photo = '/sms/modules/admissions/students/student_photos/';  // folder path for images

/*********************
 This funtion is used to get the number of days a s
 *********************/
?>