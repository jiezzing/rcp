<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/univ/update_for_all.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new U_Update($db);

	$sel->dept_code = $_POST['dept_code'];
	
	$query = $sel->updateDeptRcpNo();
	if($query){
		echo 'Success';
	}
	else{
		echo 'Fail';
	}
?>