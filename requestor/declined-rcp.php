<!doctype html>
<html lang="en">
<title>Declined RCP</title>
	<?php
		include '../controls/auth/auth_checker.php';
		include '../config/connection.php';
		include '../objects/requestor/select_queries.php';
		include '../objects/univ/count_for_all.php';
		include '../header/header.php';
		include '../assets/css/custom.css';

		$con = new connection();
		$db = $con->connect();

		$count = new Count($db);
		$sel = new Select($db);
	?>
<body>
	<div id="wrapper">
		<?php
			include '../navbar.php';
			include '../requestor/menu.php';
		?>
		<div class="main">
			<div class="main-content">
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
											<th>Payee</th>
											<th>Department</th>
											<th>Declined by</th>
											<th>Reason</th>
											<th>Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$sel->rcp_employee_id = $_SESSION['user_id'];
											$select = $sel->getDeclinedRcp();
											while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
												extract($row);
												echo '
													<tr>
														<td>'.$row['rcp_no'].'</td>
														<td>'.$row['rcp_payee'].'</td>
														<td>'.$row['dept_name'].'</td>
														<td>'.$row['user_firstname'].' '.$row['user_lastname'].'</td>
														<td>'.$row['rcp_reason'].'</td>
														<td>'.$row['rcp_date_declined'].'</td>
														<td>
															<button type="button" class="btn btn-warning form-control show-rcp-details" value="'.$row['rcp_no'].'" style="margin-left: -8px"><i class="fa fa-file"></i> Details</button>
														</td>
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
			$('#declinedTable').DataTable();
		} );
    </script>

    <script type="text/javascript">
        $(document).on('click', '.show-rcp-details', function(e){
            e.preventDefault();
			var rcp_no = $(this).attr('value');

            $.ajax({
              type: "POST",
              url: "../controls/requestor/modal_body/show_validated_details.php",
              data: {
              	rcp_no:rcp_no
              },
              cache: false,
              success: function(html)
              {
                $("#show-rcp-details-body").html(html);
                $("#show-rcp-details").modal('show');
              },
              error: function(xhr, ajaxOptions, thrownError)
              {
                  alert(thrownError);
              }
          });
        });
    </script>
</body>
</html>
