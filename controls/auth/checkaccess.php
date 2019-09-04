<?php
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/requestor/select_queries.php';


    $con = new connection();
    $db = $con->connect();

    $sel = new Select($db);

	$sel->user_username = $_SESSION['user_username'];
	$sel->user_password = base64_encode($_SESSION['user_password']);

	$type = $sel->checkUserType();
	if($row = $type->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		$user_type = $row['user_type'];
		if($user_type == 1){
			header("Location: ../../admin/dashboard-rcp.php");
			exit();
		}
		else if($user_type == 2){
			header("Location: ../../requestor/dashboard-rcp.php");
			die();
		}
		else{
			header("Location: ../../approver/dashboard-rcp.php");
			exit();
		}
	}
	else{
		header("Location: ../../admin/dashboard-rcp.php");
	}

?>