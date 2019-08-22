<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/univ/selects_for_all.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new U_Select($db);

	$sel->rcp_no = $_POST['rcp_no'];
	
	$query = $sel->checkRcpNoExistence();
	if($query){
		while ($row = $query->fetch(PDO::FETCH_ASSOC)){
			if($row > 0){
			echo 1;
			}
			else{
				echo 0;
			}
		}
	}
	else{
		echo 'Fail';
	}
?>