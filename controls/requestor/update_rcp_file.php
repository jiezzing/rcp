<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/requestor/update_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new RequestorUpdate($db);

	$sel->rcp_no = $_POST['rcp_no'];
	$sel->apprvr_id = $_POST['rcp_approver_id'];
	$sel->comp_code = $_POST['comp_code'];
	$sel->proj_code = $_POST['proj_code'];
	$sel->payee = $_POST['payee'];
	$sel->amount_in_words = $_POST['amount_in_words'];
	$sel->total_amount = $_POST['currencyNoCommas'];

	$query = $sel->updateRcp();
	$query2 = $sel->updateOrigRcp();
	if($query && $query2){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>