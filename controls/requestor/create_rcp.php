<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/requestor/insert_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new RequestorInsert($db);

	date_default_timezone_set('Asia/Manila');
	$sel->rcp_no = $_POST['rcp_no'];
	$sel->rcp_employee_id = $_POST['user_id'];
	$sel->rcp_approver_id = $_POST['apprvr_id'];
	$sel->rcp_payee = $_POST['payee'];
	$sel->rcp_company = $_POST['comp_code'];
	$sel->rcp_project = $_POST['proj_code'];
    $sel->rcp_department = $_POST['dept_code'];
	$sel->rcp_date_issued = $_POST['current_date'];
	$sel->rcp_amount_in_words = $_POST['amount_in_words'];
	$sel->rcp_total_amount = $_POST['currencyNoCommas'];
	$sel->rcp_rush = $_POST['rush'];
	
	$sel->created_at = date("Y-m-d H:i:s");
	$sel->updated_at = date("Y-m-d H:i:s");

	$query = $sel->createRcp();
	$query2 = $sel->createOrigRcp();
	if($query && $query2){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>