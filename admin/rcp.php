<!doctype html>
<html lang="en">
<title>RCP</title>
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
		$totalRcp = 0;
	?>
<body>
	<div id="wrapper">
		<?php
			include '../navbar.php';
			include '../admin/menu.php';


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

			$total = $count->totalRcp();
			while ($row = $total->fetch(PDO::FETCH_ASSOC)) {
				extract($row);
				$totalRcp = $row['TOTAL'];
			}
		?>
		<div class="main">
			<div class="main-content"  style="width: 130%">
				<div class="container-fluid" >
				<div class="row">
						<div class="col-md-12">
						<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Request for Check Payment Information</h3>
								</div>
								<div class="panel-body">
									<table id="allRcpTbl" class="table table-striped table-bordered" cellspacing="0" style="font-size: 13px;">
								        <thead>
								            <tr>	
								                <th class="th-lg">RCP No</th>
								                <th class="th-sm">Requestor</th>
								                <th class="th-sm">Approver</th>
								                <th class="th-sm">Payee</th>
								                <th class="th-sm">Department</th>
								                <th class="th-sm">Company</th>
								                <th class="th-sm">Project</th>
								                <th class="th-sm">Date</th>
								                <th class="th-sm">Amount</th>
								                <th class="th-sm">Rush</th>
								                <th class="th-sm">Status</th>
								                <th class="th-sm">Action</th>
								            </tr>
								        </thead>
								        <tbody>
								                <?php
								                    $index = 0;
								                    $mApprvr = array();
								                    $select = $sel->getAllApprover();
								                    while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
								                        extract($row);
								                        $mApprvr[] =$row['approver_name'];
								                    }

								                    $sel->rcp_employee_id = $_SESSION['user_id'];
								                    $select2 = $sel->getAllRcp();
								                    while ($row = $select2->fetch(PDO::FETCH_ASSOC)) {
								                        echo '
								                            <tr>
								                                <td>'.$row['rcp_no'].'</td>
								                                <td>'.$row['user_firstname'].' '.$row['user_middle_initial'].'. '.$row['user_lastname'].'</td>
								                                <td>'.$mApprvr[$index].'</td>
								                                <td>'.$row['rcp_payee'].'</td>
								                                <td>'.$row['dept_name'].'</td>
								                                <td>'.$row['comp_name'].'</td>
								                                <td>'.$row['proj_name'].'</td>
								                                <td>'.$row['rcp_date_issued'].'</td>
								                                <td>'.number_format($row['rcp_total_amount'], 2).'</td>
								                                <td>'.$row['rcp_rush'].'</td>
								                                <td>'.$row['rcp_status'].'</td>
								                                <td>
								                                    <button type="button" class="btn btn-success show-rcp-details" value="'.$row['rcp_no'].'"><i class="fa fa-eye"></i> Show</button>
															        <button type="button" class="btn btn-primary view-history" value="'.$row['rcp_no'].'" data-toggle="modal" data-target="#rcp-history-modal"><i class="fa fa-history" aria-hidden="true"></i> History
														          	</button>
								                                </td>
								                            </tr>
								                        ';
								                    }
								                ?>
								        </tbody>
								    </table>
								<!-- END TABBED CONTENT -->
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
        $(document).ready(function () {
        $('#allRcpTbl').DataTable({
			    "bPaginate": true,
			    "bLengthChange": true,
			    "bFilter": true,
			    "bInfo": true,
			    "bSort": false,
			    "bAutoWidth": true });
        $('.dataTables_length').addClass('bs-select');
        });
    </script>

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

	<script>
        $(document).on('click', '.view-history', function(e){
            e.preventDefault();
            var rcp_no = $(this).attr('value');

            $.ajax({
              type: "POST",
              url: "../controls/admin/modal_body/history_modal_body.php",
              data: {
              	rcp_no: rcp_no
              },
              cache: false,
              success: function(html)
              {
                $("#rcp-history-modal-body").html(html);
                $("#rcp-history-modal").modal('show');
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
