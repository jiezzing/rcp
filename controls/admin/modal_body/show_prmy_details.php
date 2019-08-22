<?php 
	session_start(); 
	include '../../../config/connection.php';
	include '../../../objects/admin/select_queries.php';
	include '../../../objects/univ/selects_for_all.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new AdminSelect($db);
	$sel2 = new U_Select($db);

	$dept_name = "";
	$fullname = "";
	$comp_name = "";

	$sel->approver_dept_code = $_POST['dept_code'];
	$sel->approver_prmy_id = $_POST['prmy_id'];
	$query = $sel->getPrmyApproversData();
	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$dept_name = $row['dept_name'];
		$fullname = $row['user_firstname'] . " " . $row['user_middle_initial'] . ". " . $row['user_lastname'];
		$comp_name = $row['comp_name'];
	}
	echo '
      	<ul class="list-unstyled list-justify">
        	<li><strong>Department</strong> <span id="requestor-name">'.$dept_name .'</span></li>
        	<li><strong>Approver Name</strong> <span id="requestor-company">'.$fullname .'</span></li>
        	<li><strong>Company </strong><span>'.$comp_name .'</span></li>
        	<li><i>New Primary Approver </i><span></span></li>
			<select class="form-control" id="primary-approver">
              	<option value="0">Remove Primary Approver</option>
	';
	?>
	<?php
		        $select = $sel2->getAllPrmyApprover();
		        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
		        	if($row['user_id'] == $_POST['prmy_id']){ 
		        		echo ' 
				        	<option value="'.$row['user_id'].'" selected>'.$row['user_firstname'].' '.$row['user_middle_initial'].'. '.$row['user_lastname'].'</option> 
				        ';
		        	}
		        	else{
		        		echo ' 
				        	<option value="'.$row['user_id'].'">'.$row['user_firstname'].' '.$row['user_middle_initial'].'. '.$row['user_lastname'].'</option> 
				        ';
		        	}
		        }
	?>
	<?php
	echo '
            </select>
      	</ul> 
	';
?>