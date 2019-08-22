<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/univ/update_for_all.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new U_Update($db);

	$sel->user_id = $_POST['user_id'];
	$sel->firstname = $_POST['firstname'];
	$sel->lastname = $_POST['lastname'];
	$sel->middile_initial = $_POST['mi'];
	$sel->email = $_POST['email'];
	$sel->username = $_POST['username'];
	$sel->password = base64_encode($_POST['password']);

 	$query = $sel->updateUserDetails();
 	$query2 = $sel->updateUserAccountDetailsAndPassword();
	if($query && $query2){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>