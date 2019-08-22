<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/approver/insert_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new ApproverInsert($db);

	$sel->rcp_no = $_POST['rcp_no'];
	$sel->rcp_particulars = $_POST['particulars'];
	$sel->rcp_ref_code = $_POST['ref_codes'];
    $sel->rcp_amount = $_POST['currencyNoCommas'];
    $sel->updated_at = date("Y-m-d H:i:s");

	$query = $sel->createRcpParticularsEditHistory();
	if($query){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>