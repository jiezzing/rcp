<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/univ/selects_for_all.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new U_Select($db);

	$sel->approver_dept_code = $_POST['dept_code'];
	
	$query = $sel->getApproversId();
	if($query){ 
		$array = "";
		while ($row = $query->fetch(PDO::FETCH_ASSOC)){
			$array = array(
				$row['approver_prmy_id'], 
				$row['approver_alt_prmy_id'], 
				$row['approver_sec_id'], 
				$row['approver_alt_sec_id']);
		}
		echo json_encode($array);
	}
	else{
		echo json_encode('Fail');
	}
?>