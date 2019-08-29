<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/approver/insert_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new ApproverInsert($db);

	date_default_timezone_set('Asia/Manila');
	$sel->rcp_no = $_POST['rcp_no'];
	$sel->rcp_comp_code = $_POST['comp_code'];
	$sel->rcp_proj_code = $_POST['proj_code'];
	$sel->rcp_payee = $_POST['payee'];
	$sel->rcp_amt_in_words = $_POST['amount_in_words'];
	$sel->rcp_total_amt = $_POST['currencyNoCommas'];
    $sel->rcp_approver_id = $_POST['apprvr_id'];
	$sel->updated_at = date("Y-m-d H:i:s");

	$query = $sel->createRcpEditHistory();
	if($query){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>