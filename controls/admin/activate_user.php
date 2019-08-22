<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/admin/update_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new AdminUpdate($db);

	$sel->user_id = $_POST['ids'];

 	$query = $sel->activateUserFileStatus();
 	$query2 = $sel->activateUserAccountStatus();
	if($query && $query2){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>