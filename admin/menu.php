<div id="sidebar-nav" class="sidebar">
	<div class="sidebar-scroll">
		<nav>
			<ul class="nav">
				<li><a href="../admin/dashboard-rcp.php" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
				<li><a href="../admin/rcp.php"><i class="lnr lnr-file-empty"></i> <span>RCP</span></a></li>
				<li>
					<a href="#approver" data-toggle="collapse" class="collapsed"><i class="lnr lnr-pencil"></i> <span>Approver</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
					<div id="approver" class="collapse ">
						<ul class="nav">
							<li><a href="../admin/primary-approver.php" class="">Primary</a></li>
							<li><a href="../admin/secondary-approver.php" class="">Secondary</a></li>
						</ul>
					</div>
				</li>
				<li><a href="#corporate" data-toggle="collapse" class="collapsed"><i class="lnr lnr-apartment"></i><span>Corporate</span> 
				<i class="icon-submenu lnr lnr-chevron-left"></i></a>
					<div id="corporate" class="collapse ">
						<ul class="nav">
							<li><a href="../admin/department.php" class="">Department</a></li>
							<li><a href="../admin/project.php" class="">Project</a></li>
							<li><a href="../admin/company.php" class="">Company</a></li>
						</ul>
					</div>
				</li>
				<li><a href="#" data-toggle="modal" data-target="#report-generation-modal"><i class="lnr lnr-chart-bars"></i> <span>Report Generation</span></a></li>
				<li><a href="../admin/users.php"><i class="lnr lnr-users"></i> <span>Users</span></a></li>
			</ul>
		</nav>
	</div>
	<footer>
		<div class="container-fluid ">
			<p class="copyright text-center">Copyright &copy;  2019 Innoland Development Corp. All Rights Reserved.</p>
		</div>
	</footer>
</div>
<?php include '../modal/admin-modals.php'; ?>

<script>
	$(document).ready(function (){
        $('#mDatePicker').datepicker({
        	startDate: "today"
        });
        $('#from-datepicker').datepicker();
     	$('#to-datepicker').datepicker();
	});
</script>

<script>
	$('#from-datepicker').change(function(){
		var start = $('#from').val();
		$('#to').val("");
        $('#to-datepicker').datepicker('destroy');
        $('#to-datepicker').datepicker({
        	startDate: start
        });
		$('#generate-btn-with-date-span').attr('disabled', false);
	});
</script>
