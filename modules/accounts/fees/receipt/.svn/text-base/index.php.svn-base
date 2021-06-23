<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/E-shop/modules/connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Shop/includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Shop/includes/common.php';

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	case 'post_receipt' :
		$content 	= 'prepost_receipt.php';		
		$pageTitle 	= 'E-Shop Monitor: Receipt';
		break;
	case 'post_receipt_process' :
		$content    = 'post_receipt_process.php';
		$pageTitle  = 'E-Shop Monitor: Receipt';
		break;
	
		
	default :
		$content 	= 'prepost_receipt.php';		
		$pageTitle 	= 'E-Shop Monitor: Receipt';
}




$script    = array('product.js');

require_once '../template.php';
//include 'header.php';
?>
