<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/admin/update_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new AdminUpdate($db);

	$sel->user_id = $_POST['user_id'];
	$sel->firstname = $_POST['firstname'];
	$sel->lastname = $_POST['lastname'];
	$sel->middile_initial = $_POST['mi'];
	$sel->user_type = $_POST['user_type'];
	$sel->dept_code = $_POST['dept_code'];
	$sel->comp_code = $_POST['comp_code'];
	$sel->email = $_POST['email'];
	$sel->username = $_POST['username'];
	$sel->password = base64_encode($_POST['password']);

 	$query = $sel->updateUserDetails();
 	$query2 = $sel->updateUserAccountDetails();
	if($query && $query2){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>