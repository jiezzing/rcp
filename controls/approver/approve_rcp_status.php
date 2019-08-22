<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/approver/update_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new ApproverUpdate($db);

	$sel->rcp_no = $_POST['rcp_no'];


	if($_POST['rush'] == "Yes"){
		$query = $sel->approveRcpFileStatus();
		$query2 = $sel->approveParticularStatus();
		$query3 = $sel->approveRushStatus();

		if($query && $query2 && $query3){
			echo 'Success';
		}
		else{
			echo 'Error';
		}
	}
	else{
		$query = $sel->approveRcpFileStatus();
		$query2 = $sel->approveParticularStatus();
		
		if($query && $query2){
			echo 'Success';
		}
		else{
			echo 'Error';
		}
	}
?>