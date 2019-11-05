<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/admin/update_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new AdminUpdate($db);

	$sel->id = $_POST['user_id'];
	$sel->approver_dept_code = $_POST['dept_code'];

 	$query = $sel->updateAltPrmyApprover();
	if($query){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>