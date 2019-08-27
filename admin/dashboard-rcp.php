<!doctype html>
<html lang="en">
<title>Dashboard</title>
	<?php
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
							<h3 class="panel-title">Total No. of Request for Check Payment</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-3" >
									<a href="#" data-toggle="modal" data-target="#rcp-pending-modal">
										<div class="metric e">
											<span class="icon"><i class="fa fa-question"></i></span>
											<p>
												<span class="number"><?php echo $pendingCtr ?></span>
												<span class="title">Pending</span>
											</p>
										</div>
									</a>
								</div>
								<div class="col-md-3">
									<a href="#" data-toggle="modal" data-target="#rcp-approved-modal">
										<div class="metric e">
											<span class="icon"><i class="fa fa-check"></i></span>
											<p>
												<span class="number"><?php echo $approvedCtr ?></span>
												<span class="title">Approved</span>
											</p>
										</div>
									</a>
								</div>
								<div class="col-md-3">
									<a href="#" data-toggle="modal" data-target="#rcp-declined-modal">
										<div class="metric e">
											<span class="icon"><i class="fa fa-times"></i></span>
											<p>
												<span class="number"><?php echo $declinedCtr ?></span>
												<span class="title">Declined</span>
											</p>
										</div>
									</a>
								</div>
								<div class="col-md-3">
									<a href="#" data-toggle="modal" data-target="#rcp-all-modal">
										<div class="metric e">
											<span class="icon"><i class="fa fa-bar-chart"></i></span>
											<p>
												<span class="number"><?php echo $total_rcp ?></span>
												<span class="title">TOTAL</span>
											</p>
										</div>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<!-- VISIT CHART -->
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">Request for Check Payment Information</h3>
							<div class="right">
								<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
							</div>
						</div>
						<div class="panel-body">
							<div id="visits-chart" class="ct-chart"></div>
						</div>
					</div>
					<!-- END VISIT CHART -->
				</div>
				<div class="col-md-6">
					<!-- TIMELINE -->
					<div class="panel panel-scrolling">
						<div class="panel-heading">
							<h3 class="panel-title">Recent User Activity</h3>
							<div class="right">
								<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
							</div>
						</div>
						<div class="panel-body">
							<ul class="list-unstyled activity-list">
								<?php
				                    $select = $sel->getAllRcp();
				                    while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
				                        extract($row);
				                        echo '
											<li>
												<span class="icon pull-left"><i class="fa fa-file fa-3x" style="color: #0081C2"></i></span>
												<p>RCP # <strong><a href="#" class="show-rcp-details" value="'.$row['rcp_no'].'">'.$row['rcp_no'].'</a></strong> has been created by '.$row['user_firstname'].' '.$row['user_middle_initial'].'. '.$row['user_lastname'].'</a> of '.$row['comp_name'].'<span class="timestamp">Created at: '.$row['created_at'].'</span></p>
											</li>
				                        ';
				                    }
				                ?>
							</ul>
				                <button type="button" class="btn btn-primary btn-bottom center-block">Load More</button>
						</div>
					</div>
					<!-- END TIMELINE -->
				</div>
			</div>
		</div>
	</div>
	<?php
		include '../scripts/js.php';
	?>

	<script type="text/javascript">
        $(document).on('click', '.show-rcp-details', function(e){
            e.preventDefault();
            var rcp_no = $(this).attr('value');

            $.ajax({
              type: "POST",
              url: "../controls/admin/modal_body/rcp_details.php",
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

		// visits chart
		data = {
			labels: ['Pending', 'Declined', 'Approved', 'Total RCP'],
			series: [
				[pendingCtr, declinedCtr, approvedCtr, total_rcp]
			]
		};
		options = {
			height: 400,
			axisX: {
				showGrid: false
			},
		};
		new Chartist.Bar('#visits-chart', data, options);
	});
	</script>
</body>
</html>
