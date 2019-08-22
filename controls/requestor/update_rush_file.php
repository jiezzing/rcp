<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/requestor/update_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new RequestorUpdate($db);

	$sel->rcp_no = $_POST['rcp_no'];
	$sel->due_date = date("Y-m-d", strtotime($_POST['due_date']));
	$sel->justification = $_POST['justification'];

	$query = $sel->updateRcpRushFile();
	if($query){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>