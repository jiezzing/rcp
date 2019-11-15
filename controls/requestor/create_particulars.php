<?php 
	session_start(); 
	require_once '../../config/connection.php';
	require_once '../../objects/requestor/insert_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new RequestorInsert($db);

	date_default_timezone_set('Asia/Manila');
	$data = json_decode(json_encode($_POST['data']), true);
	$sel->rcp_no = $data['rcp_no'];
	$sel->rcp_qty = $data['qty'];
	$sel->rcp_unit = $data['unit'];
	$sel->rcp_particulars = $data['particulars'];
	$sel->rcp_ref_code = json_encode($data['reference']);
    $sel->rcp_amount = $data['amount'];
    $sel->rcp_status = 1;
    
	$sel->created_at = date("Y-m-d H:i:s");
	$sel->updated_at = date("Y-m-d H:i:s");

	// $query = $sel->createRcpParticulars();
	// $query2 = $sel->createOrigRcpParticulars();
	// if($query && $query2){
	// 	echo 'Success';
	// }
	// else{
	// 	echo 'Error';
	// }
	$query = $sel->createRcpParticulars();
	if($query){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>