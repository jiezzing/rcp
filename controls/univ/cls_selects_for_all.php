<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/univ/selects_for_all.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new U_Select($db);


	$sel->rcp_employee_id = $_POST['user_id'];
	$sel->rcp_department = $_POST['dept_code'];
	
	$query = $sel->getAllDeptReports();
	if($query)
	{ 
		$array = "";
		while ($row = $sel->fetch(PDO::FETCH_ASSOC)) 
		{
			$array = array(
				$row['rcp_no'], 
				$row['user_firstname'], 
				$row['dept_name'], 
				$row['comp_name'],
				$row['proj_name'], 
				$row['rcp_date_issued'], 
				number_format($row['rcp_total_amount'], 2), 
				$row['rcp_status']);
		}
		echo  json_encode($array);
	}
	else
	{
		echo json_encode('Fail');
	}
?>