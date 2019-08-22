<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/approver/update_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new ApproverUpdate($db);

	$sel->rcp_id = $_POST['rcp_id'];
	$sel->particulars = $_POST['particulars'];
	$sel->ref_code = $_POST['ref_codes'];
	$sel->amount = $_POST['currencyNoCommas'];

	$query = $sel->updateRcpParticulars();
	if($query){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>