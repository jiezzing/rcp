<?php 
	session_start(); 
	include '../../../config/connection.php';
	include '../../../objects/univ/selects_for_all.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new U_Select($db);

	$sel->rcp_no = $_POST['rcp_no'];
	$query = $sel->getRcpDetails();
 	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
 		$rcp_no = $row['rcp_no'];
		$rcp_dept_code = $row['rcp_department'];
		$rcp_comp_code = $row['rcp_company'];
		$rcp_proj_code = $row['rcp_project'];
		$rcp_payee = $row['rcp_payee'];
		$rcp_words_amt = $row['rcp_amount_in_words'];
		$rcp_amt = $row['rcp_total_amount'];
		$apprvr_id = $row['rcp_approver_id'];
		$rcp_rush =  $row['rcp_rush'];
		$rcp_date_issued = $row['rcp_date_issued'];
		$expense_type = $row['rcp_expense_type'];
		$vat = json_decode($row['rcp_vat'], true);
		$supp_file = json_decode($row['rcp_supp_file'], true);
 	}

 	if($expense_type ==  'Project Expense'){
	 	$headers = [
	 		'<th>QTY</th>',
	 		'<th>Unit</th>', 
	 		'<th>Particulars</th>', 
	 		'<th>BOM Reference</th>', 
	 		'<th>Amount</th>'
	 	];
	 	$query = $sel->getRcpParticularDetails();
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$particulars[] = array(
				'qty' => $row['rcp_qty'],
				'unit' => $row['rcp_unit'],
				'particulars' => $row['rcp_particulars'],
				'reference' =>json_decode($row['rcp_ref_code'], true),
				'amount' => $row['rcp_amount']
			);
		}
 	}
 	else{
 		$headers = [
	 		'<th>QTY</th>',
	 		'<th>Unit</th>', 
	 		'<th>Particulars</th>', 
	 		'<th>BOM Reference</th>', 
	 		'<th>Acct Code</th>', 
	 		'<th>Amount</th>'
	 	];
	 	$query = $sel->getRcpParticularDetails();
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$particulars[] = array(
				'qty' => $row['rcp_qty'],
				'unit' => $row['rcp_unit'],
				'particulars' => $row['rcp_particulars'],
				'reference' =>json_decode($row['rcp_ref_code'], true),
				'amount' => $row['rcp_amount']
			);
		}
 	}

 	$sel->dept_code = $rcp_dept_code;
	$query = $sel->getSpecificDepartment();
 	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
 		$dept_name = $row['dept_name'];
 	}

 	$sel->rcp_no = $rcp_no;
	$query = $sel->getRcpRushData();
 	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$rcp_due_date = $row['rcp_due_date'];
		$rcp_justify = $row['rcp_justification'];
 	}

 	$sel->approver_dept_code = $rcp_dept_code;
	$select = $sel->getApproversId();
	while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
		if($row['approver_prmy_id'] == 0)
      		$prmy = '<option value="0" disabled>NO PRIMARY APPROVER</option>';
        else{
          	$sel->user_id = $row['approver_prmy_id'];
          	$select2 = $sel->getApproversData();
          	while ($row2 = $select2->fetch(PDO::FETCH_ASSOC)) {
            if($row['approver_prmy_id'] == $apprvr_id){
              	$prmy = '<option value="'.$row['approver_prmy_id'].'" selected>'.$row2['APP_NAME'].' - PRIMARY</option>
              	';
            }
            else
          		$prmy = '<option value="'.$row['approver_prmy_id'].'">'.$row2['APP_NAME'].' - PRIMARY</option>
              	';
          }
        }

        if($row['approver_alt_prmy_id'] == 0)
          	$alt_prmy = '<option value="0" disabled>NO ALTERNATE PRIMARY APPROVER</option>';
        else{
          	$sel->user_id = $row['approver_alt_prmy_id'];
          	$select2 = $sel->getApproversData();
          	while ($row2 = $select2->fetch(PDO::FETCH_ASSOC)) {
            if($row['approver_alt_prmy_id'] == $apprvr_id){
              	$alt_prmy = '<option value="'.$row['approver_alt_prmy_id'].'" selected>'.$row2['APP_NAME'].' - ALTERNATE PRIMARY</option>';
            }
         	else{
              	$alt_prmy = '<option value="'.$row['approver_alt_prmy_id'].'">'.$row2['APP_NAME'].' - ALTERNATE PRIMARY</option>';
            } 
          }
        }

        if($row['approver_sec_id'] == 0)
          $sec = '<option value="0" disabled>NO SECONDARY APPROVER YET</option>';
        else{
          	$sel->user_id = $row['approver_sec_id'];
          	$select2 = $sel->getApproversData();
          	while ($row2 = $select2->fetch(PDO::FETCH_ASSOC)) {
            if($row['approver_sec_id'] == $apprvr_id){
              	$sec = '<option value="'.$row['approver_sec_id'].'" selected>'.$row2['APP_NAME'].' - SECONDARY</option>
              	';
            }
         	else{
              	$sec = '<option value="'.$row['approver_sec_id'].'">'.$row2['APP_NAME'].' - ALTERNATE SECONDARY</option>';
            } 
          }
        }

        if($row['approver_alt_sec_id'] == 0)
          	$alt_sec = '<option value="0" disabled>NO ALTERNATE SECONDARY APPROVER YET</option>';
        else{
          	$sel->user_id = $row['approver_alt_sec_id'];
          	$select2 = $sel->getApproversData();
          	while ($row2 = $select2->fetch(PDO::FETCH_ASSOC)) {
            if($row['approver_alt_sec_id'] == $apprvr_id){
              	$alt_sec = '<option value="'.$row['approver_alt_sec_id'].'" selected>'.$row2['APP_NAME'].' - ALTERNATE SECONDARY</option>';
            }
         	else{
              	$alt_sec = '<option value="'.$row['approver_alt_sec_id'].'">'.$row2['APP_NAME'].' - ALTERNATE SECONDARY</option>';
            }
          }
        }
	}

	// $projects = array();
	$select = $sel->getAllProject();
	while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
		if($row['proj_code'] == $rcp_proj_code)
          	$projects[] = '<option value="'.$row['proj_code'].'" selected>'.$row['proj_name'].'</option>';
        else
         	$projects[] = '<option value="'.$row['proj_code'].'">'.$row['proj_name'].'</option>';
	}

	$select = $sel->getAllCompany();
	while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
		if($row['comp_code'] == $rcp_comp_code)
          	$companies[] = '<option value="'.$row['comp_code'].'" selected>'.$row['comp_name'].'</option>';
        else
         	$companies[] = '<option value="'.$row['comp_code'].'">'.$row['comp_name'].'</option>';
		}

 	$data = array(
 		'rcp_no' => $rcp_no,
 		'department_name' => $dept_name,
 		'payee' => $rcp_payee,
 		'words_amount' => $rcp_words_amt,
 		'dept_code' => $rcp_dept_code,
 		'approvers' => array($prmy, $alt_prmy, $sec, $alt_sec),
 		'projects' => $projects,
 		'companies' => $companies,
 		'particulars' => $particulars,
 		'headers' => $headers,
 		'type' => $expense_type
 	);

 	echo json_encode($data);
 ?>


