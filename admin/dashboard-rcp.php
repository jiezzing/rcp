<!doctype html>
<html lang="en">
<title>Dashboard</title>
	<?php
		$page = 'Dashboard';
		include '../controls/auth/auth_checker.php';
		include '../config/connection.php';
		include '../objects/admin/select_queries.php';
		include '../objects/admin/count_queries.php';
		include '../header/header.php';
		include '../assets/css/custom.css';

		$con = new connection();
		$db = $con->connect();

		$sel = new AdminSelect($db);
		$count = new AdminCount($db);


		$pendingCtr = 0;
		$approvedCtr = 0;
		$declinedCtr = 0;
		$total_rcp = 0;
		$adminCtr = 0;
		$requestorCtr = 0;
		$prmyApprvrCtr = 0;
		$altPrmyApprvrCtr = 0;
		$secApprvrCtr = 0;
		$altSecApprvrCtr = 0;
		$array = "";
	?>
<body>
	<div id="wrapper">
		<?php
			include '../navbar.php';
			include '../admin/menu.php';

			$count->rcp_employee_id = $_SESSION['user_id'];
			$pending_ctr = $count->countPendingRcp();
			while ($row = $pending_ctr->fetch(PDO::FETCH_ASSOC)) {
				extract($row);
				$pendingCtr = $row['TOTAL'];
			}

			$approved_ctr = $count->countApprovedRcp();
			while ($row = $approved_ctr->fetch(PDO::FETCH_ASSOC)) {
				extract($row);
				$approvedCtr = $row['TOTAL'];
			}

			$declined_ctr = $count->countDeclinedRcp();
			while ($row = $declined_ctr->fetch(PDO::FETCH_ASSOC)) {
				extract($row);
				$declinedCtr = $row['TOTAL'];
			}

			$total = $count->countAdmins();
			while ($row = $total->fetch(PDO::FETCH_ASSOC)) {
				extract($row);
				$adminCtr = $row['TOTAL'];
			}

			$total = $count->countRequestor();
			while ($row = $total->fetch(PDO::FETCH_ASSOC)) {
				extract($row);
				$requestorCtr = $row['TOTAL'];
			}

			$total = $count->countPrmyApprover();
			while ($row = $total->fetch(PDO::FETCH_ASSOC)) {
				extract($row);
				$prmyApprvrCtr = $row['TOTAL'];
			}

			$total = $count->countAltPrmyApprover();
			while ($row = $total->fetch(PDO::FETCH_ASSOC)) {
				extract($row);
				$altPrmyApprvrCtr = $row['TOTAL'];
			}

			$total = $count->countSecApprover();
			while ($row = $total->fetch(PDO::FETCH_ASSOC)) {
				extract($row);
				$secApprvrCtr = $row['TOTAL'];
			}

			$total = $count->countAltSecApprover();
			while ($row = $total->fetch(PDO::FETCH_ASSOC)) {
				extract($row);
				$altSecApprvrCtr = $row['TOTAL'];
			}

			$total_users = $adminCtr + $requestorCtr + $prmyApprvrCtr + $altPrmyApprvrCtr + $secApprvrCtr + $altSecApprvrCtr;
			$total_rcp = $pendingCtr + $approvedCtr + $declinedCtr;
		?>
		<div class="main">
			<div class="main-content">
				<div class="container-fluid">
					<div class="panel panel-headline">
						<div class="panel-heading">
							<nav aria-label="breadcrumb">
							  <ol class="breadcrumb">
							    <li class="breadcrumb-item"><a href="#" data-toggle="modal" data-target="#exampleModal"><?php echo $user_fullname; ?></a></li>
							    <li class="breadcrumb-item active" aria-current="page"><?php echo $user_type; ?></li>
							  </ol>
							</nav>
							<h3 class="panel-title">Request for Check Payment Overview</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-9">
									<div id="headline-chart" class="ct-chart"></div>
								</div>
								<div class="col-md-3">
									<div class="weekly-summary text-right">
										<span class="number"><?php echo $pendingCtr ?></span> <span class="percentage"><i class="fa fa-caret-up text-warning"></i></span>
										<span class="info-label">Pending RCP</span>
									</div>
									<div class="weekly-summary text-right">
										<span class="number"><?php echo $approvedCtr ?></span> <span class="percentage"><i class="fa fa-caret-up text-success"></i></span>
										<span class="info-label">Approved RCP</span>
									</div>
									<div class="weekly-summary text-right">
										<span class="number"><?php echo $declinedCtr ?></span> <span class="percentage"><i class="fa fa-caret-down text-danger"></i></span>
										<span class="info-label">Declined RCP</span>
									</div>
									<div class="weekly-summary text-right">
										<span class="number"><?php echo $total_rcp ?></span> <span class="percentage"><i class="fa fa-caret-down text-danger"></i></span>
										<span class="info-label">TOTAL RCP</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">Creation of RCP Activity</h3>
							<div class="right">
								<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
							</div>
						</div>
						<div class="panel-body" style="overflow-y: auto; height: 430px;">
							<ul class="list-unstyled activity-list">
								<?php
									$isEmpty = true;
				                    $select = $sel->getAllRcp();
				                    while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
				                        extract($row);
				                        $isEmpty = false;
				                        echo '
											<li>
												<span class="icon pull-left"><i class="fa fa-file-o fa-3x" style="color: #0081C2"></i></span>
												<p>RCP # <strong><a href="#" class="show-rcp-details" value="'.$row['rcp_no'].'">'.$row['rcp_no'].'</a></strong> has been created by '.$row['user_firstname'].' '.$row['user_lastname'].'</a> of '.$row['comp_name'].'.<span class="timestamp">Created at: '.$row['created_at'].'</span></p>
											</li>
				                        ';
				                    }
				                    if($isEmpty){
				                    	echo '
					                    	<div class="container-fluid text-center">
												<div class="panel panel-headline">
													<div class="panel-heading">
														<i class="fa fa-exclamation-circle fa-5x" style="color: #D9534F"></i>
														<br>
														<small>NO DATA</small>
													</div>
												</div>
											</div>
										';
				                    }
				                ?>
							</ul>
						</div>
					</div>
					</div>
					<div class="col-md-6">
						<div class="panel">
							<div class="panel-heading">
								<h3 class="panel-title">Approval of RCP Activity</h3>
								<div class="right">
									<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
								</div>
							</div>
							<div class="panel-body" style="overflow-y: auto; height: 430px;">
								<ul class="list-unstyled activity-list">
									<?php
										$isEmpty = true;
					                    $select = $sel->getAllApprove();
					                    while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
					                        extract($row);
					                        $isEmpty = false;
					                        echo '
												<li>
													<span class="icon pull-left"><i class="fa fa-file-text-o fa-3x" style="color: #0081C2"></i></span>
													<p>RCP # <strong><a href="#" class="show-rcp-details" value="'.$row['rcp_no'].'">'.$row['rcp_no'].'</a></strong> has been approved by '.$row['user_firstname'].' '.$row['user_lastname'].'</a> of '.$row['comp_name'].'.<span class="timestamp">Approval Date: '.$row['rcp_date_approved'].'</span></p>
												</li>
					                        ';
					                    }
					                    if($isEmpty){
					                    	echo '
						                    	<div class="container-fluid text-center">
													<div class="panel panel-headline">
														<div class="panel-heading">
															<i class="fa fa-exclamation-circle fa-5x" style="color: #D9534F"></i>
															<br>
															<small>NO DATA</small>
														</div>
													</div>
												</div>
											';
					                    }
					                ?>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="panel">
							<div class="panel-heading">
								<h3 class="panel-title">Disapproval of RCP Activity</h3>
								<div class="right">
									<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
								</div>
							</div>
							<div class="panel-body" style="overflow-y: auto; height: 430px;">
								<ul class="list-unstyled activity-list">
									<?php
										$isEmpty = true;
					                    $select = $sel->getAllDecline();
					                    while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
					                        extract($row);
					                        $isEmpty = false;
					                        echo '
												<li>
													<span class="icon pull-left"><i class="fa fa-trash fa-3x" style="color: #0081C2"></i></span>
													<p>RCP # <strong><a href="#" class="show-rcp-details" value="'.$row['rcp_no'].'">'.$row['rcp_no'].'</a></strong> has been declined by '.$row['user_firstname'].' '.$row['user_lastname'].'</a> of '.$row['comp_name'].' due to the following reason: <i>'.$row['rcp_reason'].'.</i><span class="timestamp">Date Declined: '.$row['rcp_date_declined'].'</span></p>
												</li>
					                        ';
					                    }
					                    if($isEmpty){
					                    	echo '
						                    	<div class="container-fluid text-center">
													<div class="panel panel-headline">
														<div class="panel-heading">
															<i class="fa fa-exclamation-circle fa-5x" style="color: #D9534F"></i>
															<br>
															<small>NO DATA</small>
														</div>
													</div>
												</div>
											';
					                    }
					                ?>
								</ul>
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
        $(document).on('click', '.show-more-details', function(e){
            e.preventDefault();

            var id = $(this).attr('value');

            $.ajax({
              type: "POST",
              url: "../controls/requestor/modal_body/show_detail_modal.php",
              data: {
              	id:id
              },
              cache: false,
              success: function(html)
              {
                $("#detail-body").html(html);
                $("#rcp-modal-details").modal('show');
              },
              error: function(xhr, ajaxOptions, thrownError)
              {
                  alert(thrownError);
              }
          });
        });
    </script>

	<script type="text/javascript">
        $(document).ready(function () {
        $('#all-table').DataTable();
        $('.dataTables_length').addClass('bs-select');
        });
    </script>

	<script type="text/javascript">
        $(document).ready(function () {
        $('#pending-table').DataTable();
        $('.dataTables_length').addClass('bs-select');
        });
    </script>

	<script type="text/javascript">
        $(document).ready(function () {
        $('#approved-table').DataTable();
        $('.dataTables_length').addClass('bs-select');
        });
    </script>

	<script type="text/javascript">
        $(document).ready(function () {
        $('#declined-table').DataTable();
        $('.dataTables_length').addClass('bs-select');
        });
    </script>

    <script>
	$(function() {
      	var total_rcp = "<?php echo $total_rcp; ?>";
      	var pendingCtr = "<?php echo $pendingCtr; ?>";
      	var declinedCtr = "<?php echo $declinedCtr; ?>";
      	var approvedCtr = "<?php echo $approvedCtr; ?>";
		var data, options;

		data = {
			labels: ['Pending', 'Approved', 'Declined', 'TOTAL'],
			series: [
				[total_rcp],
				[pendingCtr, approvedCtr, declinedCtr, total_rcp, 0],
			]
		};

		options = {
			height: 500,
			showArea: true,
			showLine: false,
			showPoint: true,
			fullWidth: true,
			axisX: {
				showGrid: false
			},
			lineSmooth: false,
		};

		new Chartist.Line('#headline-chart', data, options);
	});
	</script>
</body>
</html>
