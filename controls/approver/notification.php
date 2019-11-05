<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/approver/update_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new ApproverUpdate($db);

	$sel->rcp_no = $_POST['rcp_no'];


	$query = $sel->readNotification();

	if($query){
		echo '
			<i class="lnr lnr-alarm"></i>
			<span class="badge bg-danger"></span>
		';
	}
	else{
		echo 'Error';
	}
?>