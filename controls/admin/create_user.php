<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/admin/insert_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new AdminInsert($db);

	$sel->user_lastname = $_POST['lastname'];
	$sel->user_firstname = $_POST['firstname'];
	if($_POST['middle_initial'] == ""){
		$sel->user_middle_initial = null;
	}
	else{
		$sel->user_middle_initial = $_POST['middle_initial'];
	}
	
	$sel->user_comp_code = $_POST['comp_code'];
	$sel->user_dept_code = $_POST['dept_code'];
	$sel->user_type = $_POST['user_type'];

	$sel->user_username = $_POST['username'];
	$sel->user_password = base64_encode($_POST['password']);
	$sel->user_email = $_POST['email'];

	$query = $sel->createUser();
	$query2 = $sel->createUserAccount();
	if($query && $query2){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>