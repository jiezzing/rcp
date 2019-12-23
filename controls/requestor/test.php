<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/univ/selects_for_all.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new U_Select($db);
	
    $key = $_POST['search'];
	$query = $sel->filterDepartment($key);
	if($query){
        $array = [];
		while ($row = $query->fetch(PDO::FETCH_ASSOC)){
			$array[] = $row['dept_name'];
		}
		echo json_encode($array);
	}
	else{
		echo json_encode('Fail');
	}
?>