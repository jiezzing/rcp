<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/univ/update_for_all.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new U_Update($db);

	$sel->user_id = $_POST['user_id'];
	$sel->password = base64_encode($_POST['password']);

 	$query = $sel->updatePassword();
	if($query){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>