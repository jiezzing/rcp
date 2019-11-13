<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/univ/selects_for_all.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new U_Select($db);
	$flag = false;

	$data = json_decode(json_encode($_POST['data']), true);

	$sel->user_id = $data['prmy_id'];
	$query = $sel->getApproversData();
	if($data['prmy_id'] == 0){
		$prmy_id = 0;
		$prmy_name = 'NO PRIMARY APPROVER';
		$prmy_email = null;
	}
	else{
		while ($row = $query->fetch(PDO::FETCH_ASSOC)){
			$prmy_id = $row['user_id'];
			$prmy_name = $row['APP_NAME'];
			$prmy_email = $row['user_email'];
		}	
	}
		

	$sel->user_id = $data['alt_prmy_id'];
	$query = $sel->getApproversData();
	if($data['alt_prmy_id'] == 0){
		$alt_prmy_id = 0;
		$alt_prmy_name = 'NO ALTERNATE PRIMARY APPROVER';
		$alt_prmy_email = null;
	}
	else{
		while ($row = $query->fetch(PDO::FETCH_ASSOC)){
			$alt_prmy_id = $row['user_id'];
			$alt_prmy_name = $row['APP_NAME'];
			$alt_prmy_email = $row['user_email'];
		}
	}

	$sel->user_id = $data['sec_id'];
	$query = $sel->getApproversData();
	if($data['sec_id'] == 0){
		$sec_id = 0;
		$sec_name = 'NO SECONDARY APPROVER';
		$sec_email = null;
	}
	else{
		while ($row = $query->fetch(PDO::FETCH_ASSOC)){
			$sec_id = $row['user_id'];
			$sec_name = $row['APP_NAME'];
			$sec_email = $row['user_email'];
		}
	}
	

	$sel->user_id = $data['alt_sec_id'];
	$query = $sel->getApproversData();
	if($data['alt_sec_id'] == 0){
		$alt_sec_id = 0;
		$alt_sec_name = 'NO ALTERNATE SECONDARY APPROVER';
		$alt_sec_email = null;
	}
	else{
		while ($row = $query->fetch(PDO::FETCH_ASSOC)){
			$alt_sec_id = $row['user_id'];
			$alt_sec_name = $row['APP_NAME'];
			$alt_sec_email = $row['user_email'];
		}
	}
	echo ' 
		<option disabled selected>SELECT APPROVER</option>
		<option name="'.$prmy_id.'" value="'.$prmy_id.'-'.$prmy_email.'">'.$prmy_name.' - PRIMARY</option>
		<option name="'.$alt_prmy_id.'" value="'.$alt_prmy_id.'-'.$alt_prmy_email.'">'.$alt_prmy_name.' - ALTERNATE PRIMARY</option>
		<option name="'.$sec_id.'" value="'.$sec_id.'-'.$sec_email.'">'.$sec_name.' - SECONDARY</option>
		<option name="'.$alt_sec_id.'" value="'.$alt_sec_id.'-'.$alt_sec_email.'">'.$alt_sec_name.' - ALTERNATE SECONDARY</option>
	';
?>
