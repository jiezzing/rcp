<?php 
	session_start(); 
	require_once '../../config/connection.php';
	require_once '../../objects/requestor/insert_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new RequestorInsert($db);

	$data = json_decode(json_encode($_POST['data']), true);

	$sel->rcp_no = $data['rcp_no'];
	$sel->rcp_justification = $data['justification'];
	$sel->rcp_due_date = $data['due_date'];
	$sel->rcp_status = 1;

	$query = $sel->createRushData();
	if($query){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>