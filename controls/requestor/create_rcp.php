<?php 
	session_start(); 
	require_once '../../config/connection.php';
	require_once '../../objects/requestor/insert_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new RequestorInsert($db);

	if(isset($_FILES['file']['name'])){
		$path = '../assets/files/' . $_FILES['file']['name'];
		date_default_timezone_set('Asia/Manila');
		
		$supp_file = array(
			'name' => $_FILES['file']['name'],
			'path' => $path
		);
		move_uploaded_file($_FILES["file"]["tmp_name"], '../../assets/files/' . $_FILES['file']['name']);
		$sel->rcp_no = $_POST['rcp_no'];
		$sel->rcp_employee_id = $_POST['user_id'];
		$sel->rcp_approver_id = $_POST['approver'];
		$sel->rcp_payee = $_POST['payee'];
		$sel->rcp_company = $_POST['company'];
		$sel->rcp_project = $_POST['project'];
		$sel->rcp_department = $_POST['department'];
		$sel->rcp_date_issued = date("Y-m-d");
		$sel->rcp_amount_in_words = $_POST['amount_in_words'];
		$sel->rcp_total_amount = $_POST['total'];
		$sel->rcp_vat = $_POST['vat'];
		$sel->rcp_supp_file = json_encode($supp_file);
		$sel->rcp_expense_type = $_POST['expense'];
		$sel->rcp_rush = $_POST['rush'];
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
	}
?>