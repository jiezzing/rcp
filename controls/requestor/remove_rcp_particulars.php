<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/requestor/update_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new RequestorUpdate($db);

	$sel->rcp_id = $_POST['rcp_id'];

	$query = $sel->removeRcpParticulars();
	$query2 = $sel->removeRcpBackupParticulars();
	if($query && $query2){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>