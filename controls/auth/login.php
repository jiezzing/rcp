<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/requestor/select_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new Select($db);


	$sel->user_username = $_POST['username'];
	$sel->user_password = base64_encode($_POST['password']);
	$sel->user_status = "AC";
	
	$query = $sel->login();

	if($row = $query->fetch(PDO::FETCH_ASSOC))
	{ 
		echo  1;
		$_SESSION['user_id'] = $row['user_id'];
		$_SESSION['user_username'] = $row['user_username'];
		$_SESSION['user_password'] = $row['user_password'];
		$_SESSION['user_department'] = $row['user_dept_code'];
		$_SESSION['user_company'] = $row['user_comp_code'];
		$_SESSION['user_fullname'] = $row['user_fullname'];
		$_SESSION['user_email'] = $row['user_email'];
		$_SESSION['user_log_count'] = $row['user_log_count'];
		$_SESSION['user_type'] = $row['user_type'];
		$_SESSION['isLoggedIn'] = 1;
	}
	else{
		echo 0;
	}
?>