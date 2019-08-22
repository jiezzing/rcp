<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/univ/selects_for_all.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new U_Select($db);

	$sel->dept_code = $_POST['dept_code'];
	
	$query = $sel->getSpecificDepartment();
	if($query){
		$array = "";
		while ($row = $query->fetch(PDO::FETCH_ASSOC)){
			$array = array($row['dept_no_of_rcp']);
		}
		echo json_encode($array);
	}
	else{
		echo  json_encode('Fail');
	}
?>