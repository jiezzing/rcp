<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/univ/selects_for_all.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new U_Select($db);


	$sel->user_id = $_POST['user_id'];
	
	$query = $sel->getApproversData();
	if($query){ 
		$array = "";
		while ($row = $query->fetch(PDO::FETCH_ASSOC)){
			$array = array(
				$row['APP_NAME'],
				$row['user_email']
			);
		}
		echo  json_encode($array);
	}
	else{
		echo json_encode('Fail');
	}
?>
