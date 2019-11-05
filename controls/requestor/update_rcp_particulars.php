<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/requestor/update_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new RequestorUpdate($db);

	date_default_timezone_set('Asia/Manila');
	$sel->rcp_id = $_POST['rcp_id'];
	$sel->particulars = $_POST['particulars'];
	$sel->ref_code = $_POST['ref_codes'];
	$sel->amount = $_POST['amounts'];

	$query = $sel->updateRcpParticulars();
	$query2 = $sel->updateOrigRcpParticulars();
	if($query && $query2){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>