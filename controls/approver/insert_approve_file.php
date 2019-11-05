<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/approver/insert_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new ApproverInsert($db);

	date_default_timezone_set('Asia/Manila');
	$sel->rcp_no = $_POST['rcp_no'];
	$sel->rcp_date_approved = date("Y-m-d H:i:s");

	$query = $sel->createApproveFile();
	if($query){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>