<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/approver/update_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new ApproverUpdate($db);

	$sel->rcp_no = $_POST['rcp_no'];


	if($_POST['rush'] == "Yes"){
		$query = $sel->declineRcpFileStatus();
		$query2 = $sel->declineParticularStatus();
		$query3 = $sel->declineRushStatus();

		if($query && $query2 && $query3){
			echo 'Success';
		}
		else{
			echo 'Error';
		}
	}
	else{
		$query = $sel->declineRcpFileStatus();
		$query2 = $sel->declineParticularStatus();
		
		if($query && $query2){
			echo 'Success';
		}
		else{
			echo 'Error';
		}
	}
?>