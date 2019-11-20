<?php 
	session_start(); 
	require_once '../../config/connection.php';
	require_once '../../objects/requestor/update_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new RequestorUpdate($db);
	date_default_timezone_set('Asia/Manila');

	$sel->rcp_no = $_POST['rcp'];
	if(isset($_FILES['file']['name'])){
		$path = '../assets/files/' . $_FILES['file']['name'];
		date_default_timezone_set('Asia/Manila');
		
		$file = array(
			'name' => $_FILES['file']['name'],
			'path' => $path
		);
		move_uploaded_file($_FILES["file"]["tmp_name"], '../../assets/files/' . $_FILES['file']['name']);
		print_r($file);
		$query = $sel->updateRcp(
			$_POST['approver'],
			$_POST['payee'],
			$_POST['company'],
			$_POST['project'],
			$_POST['amount-in-words'],
			$_POST['total'],
			$_POST['vat'],
			json_encode($file)
		);
	}
	// $query2 = $sel->updateOrigRcp();
	if($query){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>