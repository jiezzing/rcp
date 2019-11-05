<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/approver/update_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new ApproverUpdate($db);

	date_default_timezone_set('Asia/Manila');
	$sel->rcp_no = $_POST['rcp_no'];
	$sel->updated_at = date("Y-m-d H:i:s");


	if($_POST['rush'] == "Yes"){
		$query = $sel->approveRcpFileStatus();
		$query2 = $sel->approveParticularStatus();
		$query3 = $sel->approveRushStatus();
		$query4 = $sel->approveOrigParticularStatus();
		$query5 = $sel->approveOrigRcpFileStatus();

		if($query && $query2 && $query3 && $query4 && $query5){
			echo 'Success';
		}
		else{
			echo 'Error';
		}
	}
	else{
		$query = $sel->approveRcpFileStatus();
		$query2 = $sel->approveParticularStatus();
		$query3 = $sel->approveOrigParticularStatus();
		$query4 = $sel->approveOrigRcpFileStatus();

		
		if($query && $query2 && $query3 && $query4){
			echo 'Success';
		}
		else{
			echo 'Error';
		}
	}
?>