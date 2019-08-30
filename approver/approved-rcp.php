<!doctype html>
<html lang="en">
<title>Approved RCP</title>
	<?php
		include '../controls/auth/auth_checker.php';
		include '../config/connection.php';
		include '../objects/approver/select_queries.php';
		include '../objects/approver/count_queries.php';
		include '../header/header.php';
		include '../assets/css/custom.css';

		$con = new connection();
		$db = $con->connect();

		$sel = new ApproverSelect($db);
		$count = new ApproverCount($db);
	?>
<body>
	<div id="wrapper">
		<?php
			include '../navbar.php';
			include '../approver/menu.php';
		?>
		<div class="main">
			<div class="main-content"  style="width: 150%">
				<div class="container-fluid">
				<div class="row">
						<div class="col-md-12">
						<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Request for Check Payment Approved Data</h3>
								</div>
								<div class="panel-body">
								<table id="approveTable" class="table table-striped table-bordered" style="font-size: 13px">
									<thead>
										<tr>
											<th>RCP No</th>
											<th>Requested By</th>
											<th>Payee</th>
											<th>Company</th>
											<th>Project</th>
											<th>Department</th>
											<th>Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$sel->rcp_approver_id = $_SESSION['user_id'];
											$select = $sel->getApprovedRcp();
											while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
												extract($row);
												echo '
													<tr>
														<td>'.$row['rcp_no'].'</td>
														<td>'.$row['user_firstname'].' '.$row['user_lastname'].'</td>
														<td>'.$row['rcp_payee'].'</td>
														<td>'.$row['comp_name'].'</td>
														<td>'.$row['proj_name'].'</td>
														<td>'.$row['dept_name'].'</td>
														<td>'.$row['rcp_date_approved'].'</td>
						                                <td>
													        <a href="../tcpdf/rcp_pdf.php?rcp_no='.$row['rcp_no'].'" target="new" class="pdf_view" type="view">
													          <button type="button" class="btn btn-warning view-print" value="'.$row['rcp_no'].'"><i class="fa fa-print" aria-hidden="true"></i> View / Print
													          </button>
													        </a>
												        ';
												        ?>
												        <?php
												        	if($row['edited_by_app'] == 'Yes'){
												          			echo '
												          				<button type="button" class="btn btn-danger show-old-details" value="'.$row['rcp_no'].'"><i class="fa fa-copy"></i> Original Details</button>
																        <button type="button" class="btn btn-primary view-history" value="'.$row['rcp_no'].'" data-toggle="modal" data-target="#view-history-modal"><i class="fa fa-history" aria-hidden="true"></i> Edit History
															          	</button>
												          			';	
												          		}
												          		else{
												          			echo '
												          				<button type="button" class="btn btn-danger" disabled><i class="fa fa-copy"></i> Original Details</button>
																        <button type="button" class="btn btn-primary" disabled><i class="fa fa-history" aria-hidden="true"></i> Edit History
															          	</button>
															          	
												          			';	
												          		}
												        ?>
												        <?php
												        echo '
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



	<script>
        $(document).on('click', '.view-history', function(e){
            e.preventDefault();
            var rcp_no = $(this).attr('value');
            var apprvr_id = <?php echo $_SESSION['user_id'];?>;

            $.ajax({
              type: "POST",
              url: "../controls/requestor/modal_body/history_modal_body.php",
              data: {
              	rcp_no: rcp_no,
              	apprvr_id: apprvr_id
              },
              cache: false,
              success: function(html)
              {
                $("#view-history-modal-body").html(html);
                $("#view-history-modal").modal('show');
              },
              error: function(xhr, ajaxOptions, thrownError)
              {
                  alert(thrownError);
              }
          });
        });
    </script>

    <script type="text/javascript">
        $(document).on('click', '.show-old-details', function(e){
            e.preventDefault();
			var rcp_no = $(this).attr('value');

            $.ajax({
              type: "POST",
              url: "../controls/requestor/modal_body/show_old_data.php",
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
	    $(document).on('click', '.history', function(e){
	        e.preventDefault();
	        var rcp_id = $(this).attr('value');

	        $.ajax({
	          type: "POST",
	          url: "../controls/requestor/modal_body/history_details.php",
	          data: {
	            rcp_id:rcp_id
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
        $(document).ready(function() {
			$('#approveTable').DataTable();
		} );
    </script>
</body>
</html>
