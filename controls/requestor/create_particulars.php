<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/requestor/insert_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new RequestorInsert($db);

	date_default_timezone_set('Asia/Manila');
	$sel->rcp_no = $_POST['rcp_no'];
	$sel->rcp_particulars = $_POST['arraytd1'];
	$sel->rcp_ref_code = $_POST['arraytd2'];
    $sel->rcp_amount = $_POST['arraytd3'];
    
	$sel->created_at = date("Y-m-d H:i:s");
	$sel->updated_at = date("Y-m-d H:i:s");

	$query = $sel->createRcpParticulars();
	$query2 = $sel->createOrigRcpParticulars();
	if($query && $query2){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>