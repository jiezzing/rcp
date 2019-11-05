<!doctype html>
<html lang="en">
<title>RCP</title>
	<?php
		$page = 'RCP';
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
			<div class="main-content" style="width: 140%">
				<div class="container-fluid">
				<div class="row">
						<div class="col-md-12">
						<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Request for Check Payment Information</h3>
								</div>
								<div class="panel-body">
									<div class="custom-tabs-line tabs-line-bottom left-aligned">
	  									<ul class="nav" role="tablist">
	  										<li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">All RCP</a></li>
	  										<li><a href="#tab-bottom-left2" role="tab" data-toggle="tab">Pending RCP</a></li>
	  										<li><a href="#tab-bottom-left3" role="tab" data-toggle="tab">Approved RCP</a></li>
	  										<li><a href="#tab-bottom-left4" role="tab" data-toggle="tab">Declined RCP</a></li>
	  									</ul>
                  					</div>
				                  	<?php
				                      	include '../admin/tab-content/rcp-tabs.php';
				                  	?>
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
        $('#all-rcp-table').DataTable({
        	sort: false
        });
        $('.dataTables_length').addClass('bs-select');
        });
    </script>

	<script type="text/javascript">
        $(document).ready(function () {
        $('#pending-rcp-table').DataTable({
        	sort: false
        });
        $('.dataTables_length').addClass('bs-select');
        });
    </script>

	<script type="text/javascript">
        $(document).ready(function () {
        $('#approved-rcp-table').DataTable({
        	sort: false
        });
        $('.dataTables_length').addClass('bs-select');
        });
    </script>

	<script type="text/javascript">
        $(document).ready(function () {
        $('#declined-rcp-table').DataTable({
        	sort: false
        });
        $('.dataTables_length').addClass('bs-select');
        });
    </script>

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
</body>
</html>
