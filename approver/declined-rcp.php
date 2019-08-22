<!doctype html>
<html lang="en">
<title>Decline RCP</title>
	<?php
		include '../controls/auth/auth_checker.php';
		include '../config/connection.php';
		include '../objects/approver/select_queries.php';
		include '../header/header.php';
		include '../assets/css/custom.css';

		$con = new connection();
		$db = $con->connect();

		$sel = new ApproverSelect($db);
	?>
<body>
	<div id="wrapper">
		<?php
			include '../navbar.php';
			include '../approver/menu.php';
		?>
		<div class="main">
			<div class="main-content"  style="width: 130%">
				<div class="container-fluid">
				<div class="row">
						<div class="col-md-12">
						<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Request for Check Payment Declined Data</h3>
								</div>
								<div class="panel-body">
								<table id="declinedTable" class="table table-striped table-bordered" style="font-size: 13px">
									<thead>
										<tr>
											<th>RCP No</th>
											<th>Requestor</th>
											<th>Payee</th>
											<th>Company</th>
											<th>Project</th>
											<th>Department</th>
											<th>Reason</th>
											<th>Date</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$sel->rcp_approver_id = $_SESSION['user_id'];
											$select = $sel->getDeclinedRcp();
											while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
												extract($row);
												echo '
													<tr>
														<td>'.$row['rcp_no'].'</td>
														<td>'.$row['user_firstname'].' '.$row['user_middle_initial'].'. '.$row['user_lastname'].'</td>
														<td>'.$row['rcp_payee'].'</td>
														<td>'.$row['comp_name'].'</td>
														<td>'.$row['proj_name'].'</td>
														<td>'.$row['dept_name'].'</td>
														<td>'.$row['rcp_reason'].'</td>
														<td>'.$row['rcp_date_declined'].'</td>
													</tr>
												';
											}
										?>
									</tbody>
								</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		include '../scripts/js.php';
	?>

	<script type="text/javascript">
        $(document).ready(function() {
			$('#declinedTable').DataTable({
			    "bPaginate": true,
			    "bLengthChange": true,
			    "bFilter": true,
			    "bInfo": true,
			    "bSort": false,
			    "bAutoWidth": true });
		} );
    </script>
</body>
</html>
