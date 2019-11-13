<?php 
	session_start(); 
	require_once '../../config/connection.php';
	require_once '../../objects/univ/update_for_all.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new U_Update($db);

	$sel->dept_code = $_POST['department_code'];
	
	$query = $sel->updateDeptRcpNo();
	if($query){
		echo 'Success';
	}
	else{
		echo 'Fail';
	}
?>