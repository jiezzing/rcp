<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/requestor/insert_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new RequestorInsert($db);

	$sel->rcp_no = $_POST['rcp_no'];
	$sel->rcp_justification = $_POST['reason'];
	$sel->rcp_due_date = $_POST['due_date'];

	$query = $sel->createRushData();
	if($query){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>