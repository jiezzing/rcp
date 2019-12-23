<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/univ/selects_for_all.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new U_Select($db);
    $sel->dept_name = $_POST['data'];
    
	$query = $sel->getDepartmentCode();
	if($query){
        $data = [];
		while ($row = $query->fetch(PDO::FETCH_ASSOC)){
			$data[] = $row['dept_code'];
		}
		echo json_encode($data);
	}
	else{
		echo json_encode('Fail');
	}
?>