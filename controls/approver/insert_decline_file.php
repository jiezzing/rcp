<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/approver/insert_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new ApproverInsert($db);

	$sel->rcp_no = $_POST['rcp_no'];
	$sel->rcp_reason = $_POST['justification'];
	$sel->rcp_date_declined = date("Y-m-d H:i:s");

	$query = $sel->createDeclineFile();
	if($query){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>