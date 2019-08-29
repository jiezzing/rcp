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
		$query4 = $sel->declineOrigRcpFileStatus();
		$query5 = $sel->declineOrigParticularStatus();

		if($query && $query2 && $query3 && $query4 && $query5){
			echo 'Success';
		}
		else{
			echo 'Error';
		}
	}
	else{
		$query = $sel->declineRcpFileStatus();
		$query2 = $sel->declineParticularStatus();
		$query3 = $sel->declineOrigRcpFileStatus();
		$query4 = $sel->declineOrigParticularStatus();
		
		if($query && $query2 && $query3 && $query4){
			echo 'Success';
		}
		else{
			echo 'Error';
		}
	}
?>