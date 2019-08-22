<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/univ/selects_for_all.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new U_Select($db);

	$sel->user_id = $_POST['user_id'];
	$sel->user_password = base64_encode($_POST['password']);

	$query = $sel->checkPassword();
	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		if($row > 0){
			echo 'Password Exist';
		}
		else{
			echo 'Password Not Exist';
		}
 	}
?>