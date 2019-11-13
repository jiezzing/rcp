<?php 
	session_start(); 
	require_once '../../config/connection.php';
	require_once '../../objects/requestor/insert_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new RequestorInsert($db);

	$data = json_decode(json_encode($_POST['data']), true);

	date_default_timezone_set('Asia/Manila');
	$sel->rcp_no = $data['rcp_no'];
	$sel->rcp_employee_id = $data['user_id'];
	$sel->rcp_approver_id = $data['approver_id'];
	$sel->rcp_payee = $data['payee'];
	$sel->rcp_company = $data['company_code'];
	$sel->rcp_project = $data['project_code'];
    $sel->rcp_department = $data['department_code'];
	$sel->rcp_date_issued = $data['current_date'];
	$sel->rcp_amount_in_words = $data['amount_in_words'];
	$sel->rcp_total_amount = $data['total_amount'];
	$sel->rcp_vat = json_encode($data['vat']);
	$sel->rcp_rush = $data['rush'];
	$sel->edited_by_app = 'no';
	$sel->created_at = date("Y-m-d H:i:s");
	$sel->updated_at = date("Y-m-d H:i:s");
	$sel->rcp_status = 1;

	$query = $sel->createRcp();
	// $query2 = $sel->createOrigRcp();
	// $query3 = $sel->createNotification();
	// if($query && $query2 && $query3){
	// 	echo 'Success';
	// }
	// else{
	// 	echo 'Error';
	// }
	if($query){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>