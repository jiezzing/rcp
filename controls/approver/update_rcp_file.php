<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/approver/update_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new ApproverUpdate($db);

	$sel->rcp_id = $_POST['rcp_id'];
	$sel->comp_code = $_POST['comp_code'];
	$sel->proj_code = $_POST['proj_code'];
	$sel->payee = $_POST['payee'];
	$sel->amount_in_words = $_POST['amount_in_words'];
	$sel->total_amount = $_POST['currencyNoCommas'];

	$query = $sel->updateRcp();
	if($query){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>