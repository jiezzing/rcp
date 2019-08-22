<?php
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/approver/select_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new ApproverSelect($db);
	$sel->rcp_approver_id = $_POST['user_id'];
	$select = $sel->getPendingRcp();
	while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
		extract($row);
		$hasRcp = true;
		echo '
			<div class="col-md-4">
				<div class="panel">
		';
		if($row['rcp_rush'] == "Yes"){
			echo '
				<div class="panel-heading">
					<h3 class="panel-title"> <i class="fa fa-bolt" aria-hidden="true" style="color: #ff8000"></i> '.$row['rcp_no'].'</h3>
					<div class="right">
						<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
					</div>
				</div>
			';
		}
		else{
			echo '
				<div class="panel-heading">
					<h3 class="panel-title">'.$row['rcp_no'].'</h3>
					<div class="right">
						<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
					</div>
				</div>
			';
		}
		echo '
					<div class="panel-body" style="font-size: 13px">
						<ul class="list-unstyled list-justify">
							<li>Requestor <span>'.$row['user_firstname'].' '.$row['user_middle_initial'].'. '.$row['user_lastname'].'</span></li>
							<li>Department <span>'.$row['dept_name'].'</span></li>
							<li>Rush <span>'.$row['rcp_rush'].'</span></li>
						</ul>
					</div>
					<a href="##" data-toggle="modal" data-target="#rcp-modal-details-approver">
						<div class="panel-footer show-more-details" value="'.$row['rcp_id'].':'.$row['rcp_no'].':'.$row['rcp_employee_id'].':'.$row['rcp_rush'].':'.$row['user_email'].'">
							<h5>
								<ul class="list-unstyled list-justify">
									<li>CLICK TO VIEW DETAILS <i class="fa fa-eye pull-right"></i> </li>
								</ul>
							</h5>
						</div>
					</a>
				</div>
			</div>
		';
	}
?>